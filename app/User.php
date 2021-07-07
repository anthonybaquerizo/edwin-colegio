<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'user';

    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'status' => 'boolean',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function info(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(UserInfo::class, 'user_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(UserType::class, 'user_type_id', 'id');
    }

    /**
     * @param $type
     * @param $names
     * @param $username
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function search($type, $names, $username): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return DB::table('user')
            ->select('user.*', 'user_info.*')
            ->join('user_info', 'user.id', '=', 'user_info.user_id', 'inner')
            ->where('user.user_type_id', '=', $type)
            ->where(function ($query) use ($names, $username) {
                $query->where('user_info.names', 'like', "%{$names}%")
                    ->orWhere('user.username', 'like', "%{$username}%");
            })
            ->orderBy('user.id', 'DESC')
            ->paginate();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function getTeacher(): \Illuminate\Database\Eloquent\Collection
    {
        return (new User())->newQuery()
            ->where('user_type_id', 2)
            ->get();
    }

}
