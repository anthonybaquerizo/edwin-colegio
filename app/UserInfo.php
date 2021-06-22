<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{

    protected $table = 'user_info';

    protected $primaryKey = 'user_id';

    protected $fillable = [
        'dni',
        'names',
        'last_name',
        'phone',
        'gender',
        'photo_path',
        'status'
    ];

    protected $casts = [
        'dni' => 'string',
        'phone' => 'string',
        'status' => 'boolean',
    ];

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->last_name . ',' . $this->names;
    }

}
