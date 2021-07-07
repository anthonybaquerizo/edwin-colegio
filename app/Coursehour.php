<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coursehour extends Model
{

    protected $table = 'course_hours';

    protected $primaryKey = 'id';

    protected $fillable = [
        'course_id',
        'date',
        'hour_start',
        'hour_end',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    protected $dates = [
        'date',
    ];

    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function course(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

}
