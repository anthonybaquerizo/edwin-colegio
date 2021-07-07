<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseGrade extends Model
{

    protected $table = 'course_grade';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

}
