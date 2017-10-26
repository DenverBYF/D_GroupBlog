<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class EditorController extends Controller
{
    //
	public function setting(Request $request)
	{
		$user = Auth::user();
		$user->name = $request->name;
		$user->desc = empty($request->desc)?NULL:$request->desc;
		$user->website = empty($request->website)?NULL:$request->website;
		$user->github = empty($request->github)?NULL:$request->github;
		$user->sign = empty($request->sign)?NULL:$request->sign;
		$user->key_word = empty($request->key_word)?NULL:$request->key_word;
		$image = $request->file('uploadfile');
		if($request->hasFile('uploadfile')){
			if ($image->isValid()) {
				$mime_type_array = ['image/png', 'image/jpeg'];
				$extension_type_array = ['jpeg', 'jpg', 'png'];
				$mime_type = $image->getMimeType();
				$extension_type = $image->extension();
				if (in_array($mime_type, $mime_type_array) and in_array($extension_type, $extension_type_array)) {
					if (!empty($user->url)) {
						unlink(storage_path() . "/app/public/user/$user->url");
					}
					try {
						$image_new = Image::make($image->path())->resize(150, 150);
						$image_name = sha1(time()).".".$extension_type;
						$image_new->save(storage_path() . "/app/public/user/" . $image_name);
						$user->url = $image_name;
						$user->save();
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
		}else{
			$user->save();
			return response("ok",200);
		}
	}
}
