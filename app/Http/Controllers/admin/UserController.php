<?php

namespace App\Http\Controllers\admin;

use App\invite;
use App\Posts;
use App\tag;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		$user = User::paginate(10);
		return view('user.user',['user'=>$user]);
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
		$user = User::findOrFail($id);
		$posts = Posts::where('user_id','=',$id)->paginate(10);
		return view('user.show',['name'=>$user->name,'posts'=>$posts]);

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
		$user = User::findOrFail($id);
		$posts = $user->posts;
		foreach ($posts as $post){
			if(Posts::where('tag_id','=',$post->tag_id)->count() == 1){
				tag::destroy($post->tag_id);
			}
			$post->delete();
		}
		$user->delete();
		return response("ok",200);
    }

    public function create_code()
	{
		$user = Auth::user();
		$id = $user->id;
		$ret = "";
		for ($i=0;$i<10;$i++){
			$ret.=chr(mt_rand(65,127));
		}
		$ret = sha1($ret);
		$code = invite::create([
			'user_id' => $id,
			'code' => $ret,
		]);
		if($code){
			return response($ret,200);
		}else{
			return response("error",500);
		}
	}
}
