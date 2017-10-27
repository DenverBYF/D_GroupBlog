<?php

namespace App\Http\Controllers;

use App\Group;
use App\link;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		$group = Group::first();
		$link = link::all();
		return view('admin.group',['group'=>$group,'link'=>$link]);
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
		$group = Group::first();
		$name = $request->name;
		$email = $request->email;
		$desc  = $request->desc;
		$image = $request->file('uploadfile');
		if ($request->hasFile('uploadfile')) {
			if ($image->isValid()) {
				$mime_type_array = ['image/png', 'image/jpeg'];
				$extension_type_array = ['jpeg', 'jpg', 'png'];
				$mime_type = $image->getMimeType();
				$extension_type = $image->extension();
				if (in_array($mime_type, $mime_type_array) and in_array($extension_type, $extension_type_array)) {
					if (!empty($group->url)) {
						unlink(storage_path() . "/app/public/group/$group->url");
					}
					try {
						$image_new = Image::make($image->path())->resize(150, 150);
						$image_name = sha1(time()).".".$extension_type;
						$image_new->save(storage_path() . "/app/public/group/" . $image_name);
						$group->name = $name;
						$group->desc = empty($desc)?NULL:$desc;
						$group->email = empty($email)?NULL:$email;
						$group->url = $image_name;
						$group->save();
					} catch (Exception $e) {
						return response("修改失败", 500);
					}
					return response("ok", 200);
				} else {
					return response("图片不合法", 400);
				}
			} else {
				return response("文件无效", 400);
			}
		} else {
			$group->name = $name;
			$group->desc = empty($desc)?NULL:$desc;
			$group->email = empty($email)?NULL:$email;
			$group->save();
			return response("ok",200);
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

}
