<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Course extends Model
{

    protected $table = 'course';

    protected $primaryKey = 'id';

    protected $fillable = [
        'course_grade_id',
        'course_section_id',
        'course_period_id',
        'user_teacher_id',
        'code',
        'name',
        'description',
        'syllable',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    /**
     * Generate code
     */
    public function createCode()
    {
        $this->setAttribute('code', 'IEP' . rand(101, 999));
    }

    /**
     * @param $name
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function search($name)
    {
        return DB::table('course')
            ->select(
                'course.id',
                'course.created_at',
                'course.code',
                'course.name',
                DB::raw("CONCAT(user_info.last_name, ',', user_info.names) as teacher"),
                DB::raw('course_grade.name AS grade'),
                DB::raw('course_section.name AS section'),
                DB::raw('course_period.name AS period'),
                'course.description'
            )
            ->join('course_grade', 'course.course_grade_id', '=', 'course_grade.id', 'inner')
            ->join('course_section', 'course.course_section_id', '=', 'course_section.id', 'inner')
            ->join('course_period', 'course.course_period_id', '=', 'course_period.id', 'inner')
            ->join('user', 'course.user_teacher_id', '=', 'user.id', 'inner')
            ->join('user_info', 'user.id', '=', 'user_info.user_id', 'inner')
            ->where('course.name', 'like', "%{$name}%")
            ->orderBy('course.created_at', 'DESC')
            ->paginate();
    }

    /**
     * @param $courseId
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function assistanceDate($courseId)
    {
        return DB::table('user_course')
            ->join('user_course_hours', 'user_course.id','=', 'user_course_hours.user_course_id')
            ->join('course_hours', 'user_course_hours.course_hours_id', '=', 'course_hours.id')
            ->where('user_course.course_id', '=', $courseId)
            ->groupBy('course_hours.date')
            ->select(
                DB::raw("DATE_FORMAT(course_hours.date, '%d/%m/%Y') as date")
            )
            ->paginate();
    }

    /**
     * @param $courseId
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function assistance($courseId, $date)
    {
        return DB::table('user_course')
            ->select(
                'user_course_hours.id',
                DB::raw("CONCAT(user_info.last_name, ',', user_info.names) as student"),
                'user_course_hours.status'
            )
            ->join('course', 'user_course.course_id','=', 'course.id')
            ->join('user_course_hours', 'user_course.id','=', 'user_course_hours.user_course_id')
            ->join('user', 'user_course.user_id', '=', 'user.id', 'inner')
            ->join('user_info', 'user.id', '=', 'user_info.user_id', 'inner')
            ->join('course_hours', 'user_course_hours.course_hours_id', '=', 'course_hours.id')
            ->where('user_course.course_id', '=', $courseId)
            ->where('course_hours.date', '=', $date)
            ->paginate();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function grade(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(CourseGrade::class, 'course_grade_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function section(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(CourseSection::class, 'course_section_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function period(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(CoursePeriod::class, 'course_period_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function teacher(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_teacher_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function hours(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Coursehour::class, 'course_id', 'id');
    }

}
