<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\tag;
use App\Posts;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
		$id = Auth::id();
		$posts = Posts::where('user_id','=',$id)->orderBy('id','desc')->paginate(10);
		return view('post.post',['post'=>$posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		return view('editor.editor');
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
		$vaild = Validator::make($request->all(),[
			'title' => 'required|unique:posts|',
			'tag' => 'required',
			'content' => 'required',
			'html_content' => 'required',
		]);
		if($vaild->fails()){
			return response($vaild->errors(),400);
		}else{
			$tag = tag::where('name','=',$request->input('tag'))->first();
			if(empty($tag)){
				$tag = tag::create(['name' => $request->input('tag')]);
			}
			$tag_id = $tag->id;
			$post = Posts::create([
				'title' => $request->input('title'),
				'tag_id' => $tag_id,
				'content' => $request->input('content'),
				'html_content' => $request->input('html_content'),
				'user_id' => Auth::id(),
			]);
			if(!$post){
				return response("create fail",400);
			}else{
				return response($post->id,200);
			}
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
		$article = Posts::findOrFail($id);
		$article->view = $article->view + 1;
		$article->save();
		return view('article',['title'=>$article->title,'tag'=>$article->tag,'editor'=>$article->user->name,'html_content'=>$article->html_content,'time'=>$article->update_at]);
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
		$user_id = Auth::id();
		$article = Posts::findOrFail($id);
		if($article->user_id === $user_id){
			$url = route('article.update',['id'=>$id]);
			return view('post.edit',['article'=>$article,'url'=>$url]);
		}
		return response("not editor",401);
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
		$user_id = Auth::id();
		$article = Posts::findOrFail($id);
		if($article->user_id === $user_id){
			$tag = tag::where('name','=',$request->input('tag'))->first();
			if(empty($tag)){
				$tag = tag::create(['name' => $request->input('tag')]);
			}
			$tag_id = $tag->id;
			$article->title = $request->input('title');
			$article->tag_id = $tag_id;
			$article->content = $request->input('content');
			$article->html_content = $request->input('html_content');
			$article->save();
			return response("ok",200);
		}
		return response("not editor",401);
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
		$user = Auth::user();
		$article = Posts::findOrFail($id);
		$user_id = $user->id;
		$tag_id = $article->tag_id;
		if($user->hasRole('admin')){
			$this->delete($article,$tag_id);
		}else{
			if($article->user_id != $user_id){
				return response("not editor",401);
			}else{
				$this->delete($article,$tag_id);
			}
		}
    }
    private function delete($article,$tag_id)
	{
		$article->delete();
		if(Posts::where('tag_id','=',$tag_id)->count() == 0){
			tag::destroy($tag_id);
		}
		return response("ok",200);
	}
}
