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
	$group = \App\Group::first();
	$user = \App\User::take(8)->skip(1)->get();
	$posts = \App\Posts::orderBy('id','desc')->paginate(4);
	$hot_posts = \App\Posts::orderBy('view','desc')->take(8)->get();
	$tag = \App\tag::all();
    return view('welcome',['group'=>$group,'user'=>$user,'posts'=>$posts,'hot_posts'=>$hot_posts,'tag'=>$tag]);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('article/{id}',function ($id){
	$post = \App\Posts::findOrFail($id);
	$post->view +=1;
	$post->save();
	return view('article',['post'=>$post]);
})->name('article');

Route::prefix('admin')->middleware(['auth','role:admin'])->group(function (){
	Route::resource('post','admin\PostController',['only'=>['index']]);
	Route::resource('users','admin\UserController');
	Route::resource('tags','admin\TagController');
	Route::get('code','admin\UserController@create_code')->name('code');
	Route::resource('group','GroupController');
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
