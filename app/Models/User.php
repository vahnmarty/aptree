<?php

namespace App\Models;

use Wave\User as Authenticatable;
//use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'verification_code',
        'verified',
        'trial_ends_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'trial_ends_at' => 'datetime',
    ];

    public function getUsername()
    {
        return $this->username ?? $this->email;
    }

    public function moduleActivity()
    {
        return $this->belongsToMany(ModuleItem::class, 'user_module_activity')->withPivot('completed_at');
    }

    public function quizAnswers()
    {
        return $this->belongsToMany(Answer::class, 'user_quiz_answers')->withPivot('is_correct', 'completed_at');
    }
}
