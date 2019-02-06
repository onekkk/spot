<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\SpotItem;
use App\User;
use App\Follow;

class UserDetailController extends Controller
{
    public function index(Request $request){

        $auth = Auth::user(); //認証情報を取得
        $user_id = (int) $request->input('author');
        if($auth['id'] == $user_id){
            return redirect('/profile');
        }
    	
    	$spots = SpotItem::query()->where('author_id', $user_id)->paginate(20);
    	$author = User::find($user_id); //ユーザー名を取得
    	$author_name = $author['name'];
        $author_path = $author['img_path'];

    	
    	$follow_is = Follow::query()->where('follow', $auth['id'])->where('follower', $user_id)->count();

    	
    	return view('user_detail', ['is_auth' => Auth::check(), 'user_name' => $auth['name'], 'auth_id' => $auth['id'], 'user_id' => $user_id, 'follow_is' => $follow_is, 'spots' => $spots, 'author_name' => $author_name, 'author_path' => $author_path]);
    }
}
