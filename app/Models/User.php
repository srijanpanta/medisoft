<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phoneNumber',
        'password',
		'role',
		'doctor_type',
		'nmc_no',
		'doctor_degree',
		'document',
		'status',
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
        'email_verified_at' => 'datetime',
    ];

    public function reports()
    {
        return $this->hasMany(Report::class);
    }
    //friendship that this user started
	public function friendsOfThisUser()
	{
		return $this->belongsToMany(User::class, 'friendships', 'first_user', 'second_user')
		->withPivot('status')
		->wherePivot('status', 'confirmed');
	}

	// friendship that this user was asked for
	public function thisUserFriendOf()
	{
		return $this->belongsToMany(User::class, 'friendships', 'second_user', 'first_user')
		->withPivot('status')
		->wherePivot('status', 'confirmed');
	}

	// accessor allowing you call $user->friends
	public function getFriendsAttribute()
	{
		if ( ! array_key_exists('friends', $this->relations)) $this->loadFriends();
		return $this->getRelation('friends');
	}

	public function loadFriends()
	{
		if ( ! array_key_exists('friends', $this->relations))
		{
		$friends = $this->mergeFriends();
		$this->setRelation('friends', $friends);
	}
	}

	public function mergeFriends()
	{
		if($temp = $this->friendsOfThisUser)
		return $temp->merge($this->thisUserFriendOf);
		else
		return $this->thisUserFriendOf;
	}
//======================== end functions to get friends attribute =========================
//====================== functions to get blocked_friends attribute ============================

	// friendship that this user started but now blocked
	public function friendsOfThisUserBlocked()
	{
		return $this->belongsToMany(User::class, 'friendships', 'first_user', 'second_user')
					->withPivot('status', 'acted_user')
					->wherePivot('status', 'blocked')
					->wherePivot('acted_user', 'first_user');
	}

	// friendship that this user was asked for but now blocked
	public function thisUserFriendOfBlocked()
	{
		return $this->belongsToMany(User::class, 'friendships', 'second_user', 'first_user')
					->withPivot('status', 'acted_user')
					->wherePivot('status', 'blocked')
					->wherePivot('acted_user', 'second_user');
	}

	// accessor allowing you call $user->blocked_friends
	public function getBlockedFriendsAttribute()
	{
		if ( ! array_key_exists('blocked_friends', $this->relations)) $this->loadBlockedFriends();
			return $this->getRelation('blocked_friends');
	}

	public function loadBlockedFriends()
	{
		if ( ! array_key_exists('blocked_friends', $this->relations))
		{
			$friends = $this->mergeBlockedFriends();
			$this->setRelation('blocked_friends', $friends);
		}
	}

	public function mergeBlockedFriends()
	{
		if($temp = $this->friendsOfThisUserBlocked)
			return $temp->merge($this->thisUserFriendOfBlocked);
		else
			return $this->thisUserFriendOfBlocked;
	}
// ======================================= end functions to get block_friends attribute =========
public function friend_requests()
{
	return $this->hasMany(Friendship::class, 'second_user')
	->where('status', 'pending');
}

public function getFriendship(User $user) {
return Friendship::where(function($q) use($user){
$q->where(function($q) use($user) {
$q->where('first_user', $user->id)
  ->where('second_user', $this->id);
})->orWhere(function($q) use($user) {
$q->where('first_user', $this->id)
  ->where('second_user', $user->id);
});
})->first();
}
}
