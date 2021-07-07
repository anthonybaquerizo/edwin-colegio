<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'user';

    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'status' => 'boolean',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function info(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(UserInfo::class, 'user_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(UserType::class, 'user_type_id', 'id');
    }

    /**
     * @param $type
     * @param $names
     * @param $username
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function search($type, $names, $username): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return DB::table('user')
            ->select('user.*', 'user_info.*')
            ->join('user_info', 'user.id', '=', 'user_info.user_id', 'inner')
            ->where('user.user_type_id', '=', $type)
            ->where(function ($query) use ($names, $username) {
                $query->where('user_info.names', 'like', "%{$names}%")
                    ->orWhere('user.username', 'like', "%{$username}%");
            })
            ->orderBy('user.id', 'DESC')
            ->paginate();
    }

    /**
     * @param $userId
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function searchAlumnCourses($userId)
    {
        return DB::table('user_course')
            ->select(
                'user_course.id',
                'user_course.status',
                DB::raw('user_course.course_id AS course_id'),
                DB::raw('user_course.user_id AS user_id'),
                'course.code',
                'course.name',
                DB::raw("CONCAT(user_info.last_name, ',', user_info.names) as teacher"),
                DB::raw('course_grade.name AS grade'),
                DB::raw('course_section.name AS section'),
                DB::raw('course_period.name AS period'),
                'course.description'
            )
            ->join('course', 'user_course.course_id', '=', 'course.id', 'inner')
            ->join('course_grade', 'course.course_grade_id', '=', 'course_grade.id', 'inner')
            ->join('course_section', 'course.course_section_id', '=', 'course_section.id', 'inner')
            ->join('course_period', 'course.course_period_id', '=', 'course_period.id', 'inner')
            ->join('user', 'course.user_teacher_id', '=', 'user.id', 'inner')
            ->join('user_info', 'user.id', '=', 'user_info.user_id', 'inner')
            ->where('user_course.user_id', '=', $userId)
            ->paginate(3);
    }

    /**
     * @param $userId
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function searchTeacherCourses($userId)
    {
        return DB::table('user_course')
            ->select(
                'user_course.id',
                'user_course.status',
                DB::raw('user_course.course_id AS course_id'),
                DB::raw('user_course.user_id AS user_id'),
                'course.code',
                'course.name',
                DB::raw('course_grade.name AS grade'),
                DB::raw('course_section.name AS section'),
                DB::raw('course_period.name AS period'),
                'course.description'
            )
            ->join('course', 'user_course.course_id', '=', 'course.id', 'inner')
            ->join('course_grade', 'course.course_grade_id', '=', 'course_grade.id', 'inner')
            ->join('course_section', 'course.course_section_id', '=', 'course_section.id', 'inner')
            ->join('course_period', 'course.course_period_id', '=', 'course_period.id', 'inner')
            ->where('course.user_teacher_id', '=', $userId)
            ->groupBy('user_course.course_id')
            ->paginate();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function getTeacher(): \Illuminate\Database\Eloquent\Collection
    {
        return (new User())->newQuery()
            ->where('user_type_id', 2)
            ->get();
    }

}
