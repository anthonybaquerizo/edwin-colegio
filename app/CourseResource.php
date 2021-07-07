<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseResource extends Model
{

    protected $table = 'course_resource';

    protected $primaryKey = 'id';

    protected $fillable = [
        'course_id',
        'resource_id',
        'title',
        'description',
        'file_path',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

}
