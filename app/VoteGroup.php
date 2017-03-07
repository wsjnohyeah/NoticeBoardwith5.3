<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VoteGroup extends Model
{
    protected $fillable = ['title', 'intro'];

    /**
     * Return the votes of the vote group.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function votes()
    {
        return $this->hasMany('App\Vote');
    }

    /**
     * Return the tickets of the vote group.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tickets()
    {
        return $this->hasMany('App\Ticket');
    }
}
