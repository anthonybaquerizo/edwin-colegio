<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoursePeriod extends Model
{

    protected $table = 'course_period';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'year',
        'quantity',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

}
