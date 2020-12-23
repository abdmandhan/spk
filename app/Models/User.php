<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
    ];

    public function user_answer()
    {
        return $this->hasMany(UserAnswer::class, 'candidate_id')->where('user_id', Auth::id());
    }

    public function user_answers()
    {
        return $this->hasMany(UserAnswer::class, 'candidate_id');
    }

    public function getWeightAttribute()
    {
        $user_answer = $this->user_answer()->get();

        $point = 0;
        foreach ($user_answer as $key => $value) {
            $point = $point + ($value->weight_id * 0.2);
        }

        return $point;
    }

    public function getPointAttribute()
    {
        $user_answer = $this->user_answers()->get();

        $point = 0;
        foreach ($user_answer as $key => $value) {
            $point = $point + ($value->weight_id * 0.2);
        }

        return $point * 100 / 100;
    }
}
