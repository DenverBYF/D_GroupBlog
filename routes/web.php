<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	if(isset($_GET['tag_id'])){
		$tag_id = $_GET['tag_id'];
		$posts = \App\Posts::where('tag_id','=',$tag_id)->paginate(4);
		$this_tag = \App\tag::findOrFail($tag_id);
		$tag_name = $this_tag->name;
	}else{
		$posts = \App\Posts::orderBy('id','desc')->paginate(4);
		$tag_name = NULL;
	}
	$group = \App\Group::first();
	$user = \App\User::take(8)->skip(1)->get();
	$hot_posts = \App\Posts::orderBy('view','desc')->take(8)->get();
	$tag = \App\tag::all();
	$link = \App\link::all();
    return view('welcome',['group'=>$group,'user'=>$user,'posts'=>$posts,'hot_posts'=>$hot_posts,'tag'=>$tag,'link'=>$link,'tag_name'=>$tag_name]);
})->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('article/{id}',function ($id){
	$post = \App\Posts::findOrFail($id);
	$user = $post->user;
	$post->view +=1;
	$post->save();
	$tag = \App\tag::all();
	$name = \App\Group::first()->name;
	return view('article',['post'=>$post,'user'=>$user,'tag'=>$tag,'name'=>$name]);
})->name('article');
Route::resource('comment','CommentController');

Route::prefix('admin')->middleware(['auth','role:admin'])->group(function (){
	Route::resource('post','admin\PostController',['only'=>['index']]);
	Route::resource('users','admin\UserController');
	Route::resource('tags','admin\TagController');
	Route::get('code','admin\UserController@create_code')->name('code');
	Route::resource('group','GroupController');
	Route::resource('link','LinkController');
});

Route::prefix('editor')->middleware(['auth'])->group(function (){
	Route::resource('article','ArticleController');
	Route::post('editor_setting','EditorController@setting')->name('editor_setting');
	Route::get('set',function(){
		$user = \Illuminate\Support\Facades\Auth::user();
		return view('editor.setting',['user'=>$user]);
	})->name('set');
	Route::get('search_tag',function (\Illuminate\Http\Request $request){
		$data = $request->input('data');
		$tag = \App\tag::where('name','like',"%$data%")->get()->toJson();
		return $tag;
	})->name('search_tag');
});
