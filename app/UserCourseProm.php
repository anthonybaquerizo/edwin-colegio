<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserCourseProm extends Model
{

    protected $table = 'user_course_prom';

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_course_id',
        'work_note1',
        'work_note2',
        'work_note3',
        'work_investigation',
        'final_exam',
        'prom_nt',
        'prom_ti',
        'prom_ef',
        'prom_final',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userCourse()
    {
        return $this->belongsTo(UserCourse::class, 'user_course_id', 'id');
    }

    /**
     * @param $courseId
     * @return \Illuminate\Support\Collection
     */
    public function getStudent($courseId)
    {
        return DB::table('user_course')
            ->join('user', 'user_course.user_id', '=', 'user.id', 'inner')
            ->join('user_info', 'user.id', '=', 'user_info.user_id', 'inner')
            ->where('user_course.course_id', '=', $courseId)
            ->select(
                'user_course.id',
                'user_course.user_id',
                DB::raw("CONCAT(user_info.last_name, ',', user_info.names) as student")
            )
            ->orderBy('user_info.last_name', 'ASC')
            ->limit(3)
            ->get();
    }

}
