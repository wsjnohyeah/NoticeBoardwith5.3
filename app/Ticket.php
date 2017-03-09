<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
	/**
	 * Massive assign
	 *
	 * @var array
	 */
	protected $fillable = [
		'vote_group_id', 'string'
	];

	/**
	 * popular search for ticket
	 *
	 * @param $query
	 * @param $string
	 * @return mixed
	 */
	public function scopeTicket($query, $string)
	{
		return $query->where('string', $string)->firstorFail();
	}

	/**
	 * Return the vote group to which the ticket belongs.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function voteGroup()
	{
		return $this->belongsTo('App\VoteGroup');
	}

	/**
	 * All answers belong to specific ticket
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\MorphMany
	 */
	public function answers()
	{
		return $this->morphMany('App\Answer', 'source');
	}

	/**
	 * Ticket IPAddress
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\MorphMany
	 */
	public function ipAddress()
	{
		return $this->morphMany('App\IPAddress', 'source');
	}

	/**
	 * Check if ticket used
	 *
	 * @param $voteId
	 * @return mixed
	 */
	public function isTicketUsed($voteId)
	{
		if ($this->answers->map(function ($answer) {
				return $answer->option->question->vote->id;
			})->flatten()->search($voteId) === false
		) {
			return false;
		}
		return true;
	}

}
