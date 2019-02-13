<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Follow;

class FollowController extends Controller
{

    public function index(Request $request){

        $auth = Auth::user(); //認証情報を取得

        $follows = DB::table('follows')
            ->join('users', 'follows.follower', '=', 'users.id')
            ->where('follows.follow', $auth['id'])
            ->select('follows.*', 'users.name')
            ->paginate(50);
        //$follow_id = $query->paginate(50);
        //$follows = (array)$follows;

        return view('follow_list', ['is_auth' => Auth::check(), 'user_name' => $auth['name'], 'auth_id' => $auth['id'], 'follows' => $follows]);
    }

    public function upload(Request $request){

    	$validatedData = $request->validate([
        	'follow' => 'required|integer',
        	'follower' => 'required|integer',
    	]);
    	
    	$req = $request->all();

    	if($req['follow_is'] == "true"){
            //delete
            $del = Follow::where('follow', $req['follow'])->where('follower', $req['follower'])->delete();
    	}else{
            //insert
            Follow::create([
                'follow' => $req['follow'],
                'follower' => $req['follower'],
            ]);
    	}
    }
}
