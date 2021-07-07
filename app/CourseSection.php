<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseSection extends Model
{

    protected $table = 'course_section';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'pavilion',
        'number',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

}
