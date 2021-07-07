<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserCourse extends Model
{

    protected $table = 'user_course';

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'course_id',
        'prom_1',
        'prom_2',
        'prom_3',
        'prom_final',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Builder|Model|object|null
     */
    public function verify($userId, $courseId)
    {
        return $this->newQuery()
            ->where('user_id', '=', $userId)
            ->where('course_id', '=', $courseId)
            ->first();
    }

    public function calculateFinalProm()
    {
        $this->prom_final = round(($this->prom_1 + $this->prom_2 + $this->prom_3) / 3, 2);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function course(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function assistance(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(UserCourseHour::class, 'user_course_id', 'id');
    }

}
