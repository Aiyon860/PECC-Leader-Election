<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use hasRoles;

    protected $guard_name = 'web';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'candidate_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'color',
        'vision',
        'mission',
        'photo',
        'user_id',
    ];

    /**
     * Get all votes for this candidate.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function votes()
    {
        return $this->hasMany(Vote::class, 'candidate_id', 'candidate_id');
    }

    /**
     * Get the user associated with this candidate.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the vote count for this candidate.
     * 
     * @return int
     */
    public function getVoteCountAttribute()
    {
        return $this->votes()->count();
    }
}
