<?php

namespace App\Models;

use App\Models\Vote;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;
    
    protected $primaryKey = 'user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'nim',
        'password',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Get the candidate profile associated with this user (if exists).
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function candidate()
    {
        return $this->hasOne(Candidate::class, 'user_id', 'user_id');
    }

    /**
     * Get the votes made by this user.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function votes()
    {
        return $this->hasMany(Vote::class, 'user_id', 'user_id');
    }

    /**
     * Check if user has voted.
     *
     * @return bool
     */
    public function hasVoted()
    {
        // You can use either the status field or check for votes
        return $this->status === 'Sudah' || $this->votes()->exists();
    }

    /**
     * Check if the user is a candidate.
     *
     * @return bool
     */
    public function isCandidate()
    {
        return $this->candidate()->exists();
    }

    public function getRedirectRoute()
    {
        $roleName = $this->getRoleNames()->first();
        
        return match($roleName) {
            'voter' => 'vote',
            'candidate' => 'vote',
            'admin' => 'dashboard',
            default => 'login'
        };
    }
}