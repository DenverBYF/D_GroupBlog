<?php

namespace App\Http\Controllers;

use App\Posts;
use App\tag;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$user = Auth::user();
		if($user->hasRole('admin')){
			$hot_post = Posts::orderby('view','desc')->take(10)->get();
			$post_num = Posts::all()->count();
			$tag_num = tag::all()->count();
			$user_num = User::all()->count();
			return view('admin',['user'=>$user->name,'post_num'=>$post_num,'tag_num'=>$tag_num,'user_num'=>$user_num,'posts'=>$hot_post]);
		}
		else{
			return redirect(route('article.index'));
		}
    }
}
