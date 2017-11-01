<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
	protected  $fillable = ['name','email','content','posts_id','user_id'];

	public function Posts()
	{
		return $this->belongsTo('App\Posts');
	}
	public function User()
	{
		return $this->belongsTo('App\User');
	}
}
