<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
		if(Auth::check()){
			$user = Auth::user();
		}else{
			$valid = $this->valid($request->all());
			if($valid->fails()){
				return response($valid->errors(),400);
			}
		}
		$comment = Comment::create([
			'name' => isset($user)?$user->name:$request->name,
			'email' => isset($user)?$user->email:$request->email,
			'content' => $request->html_content,
			'posts_id' => $request->id,
			'user_id' => isset($user)?Auth::id():NULL,
		]);
		if($comment){
			return response("ok",200);
		}else{
			return response("error",500);
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function valid($data)
	{
		$valid = Validator::make($data,[
			'name' => 'required',
			'email' => 'required|email',
			'html_content' => 'required',
		]);
		return $valid;
	}
}
