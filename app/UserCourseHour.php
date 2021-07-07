<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserCourseHour extends Model
{

    protected $table = 'user_course_hours';

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_course_id',
        'course_hours_id',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function course(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(UserCourse::class, 'user_course_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function hour(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(CourseHour::class, 'course_hours_id', 'id');
    }

}
