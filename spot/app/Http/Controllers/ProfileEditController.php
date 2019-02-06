<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class ProfileEditController extends Controller
{
    public function index(Request $request){
		$auth = Auth::user(); //認証情報を取得
    	
    	return view('profile_edit', ['is_auth' => Auth::check(), 'user_name' => $auth['name'], 'auth_id' => $auth['id']]);
	}


    public function update(Request $request){
        $auth = Auth::user(); //認証情報を取得
        
        $validatedData = $request->validate([
        	'name' => 'string|max:255',
        	'img' =>  'file', 'image', 'mimes:jpeg,png,gif',
    	]);

        $name = $auth['name'];
        if($request->has('name')){
        	$name = $request['name'];
        }


        $img_path = null;
        $before_path = $auth['img_path'];
        if ($request->hasFile('img')) {
        	if($before_path != null){
				\File::delete('../../../public/'.$before_path);
        	}
			$path = $request->file('img')->store('public/img/users');
			$img_path = "storage/img/users/".basename($path);
		}

        $user = User::find($auth['id']);
		$user->name = $name;
		$user->img_path = $img_path;
		$user->save();

        
        return redirect('/profile');
    }
}
