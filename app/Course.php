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
