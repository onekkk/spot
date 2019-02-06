<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\SpotItem;

class ProfileController extends Controller
{
	public function index(Request $request){
		$auth = Auth::user(); //認証情報を取得
		
    	$spots = DB::table('spot_items')
            ->join('users', 'spot_items.author_id', '=', 'users.id')
            ->where('spot_items.author_id', $auth['id'])
            ->select('spot_items.*', 'users.name as author_name')
            ->paginate(20);

    	
    	return view('profile', ['is_auth' => Auth::check(), 'user_name' => $auth['name'], 'auth_id' => $auth['id'], 'auth_path' => $auth['img_path'],'spots' => $spots]);
	}

}
