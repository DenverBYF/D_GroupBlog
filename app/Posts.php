<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    //
	protected $fillable=[
		'title',
		'content',
		'html_content',
		'user_id',
		'tag_id',
	];
	public function User()
	{
		return $this->belongsTo('App\User');
	}
	public function tag()
	{
		return $this->belongsTo('App\tag');
	}
}
