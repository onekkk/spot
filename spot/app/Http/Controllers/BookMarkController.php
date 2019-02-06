<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Bookmark;

class BookMarkController extends Controller
{
    public function index(Request $request){

        $auth = Auth::user(); //認証情報を取得

        $bookmarks = DB::table('bookmarks')
            ->join('spot_items', 'bookmarks.item_id', '=', 'spot_items.id')
            ->join('users', 'spot_items.author_id', '=', 'users.id')
            ->where('bookmarks.user', $auth['id'])
            ->select('bookmarks.*', 'spot_items.*', 'users.name as author_name')
            ->paginate(20);
            

        return view('bookmark_list', ['is_auth' => Auth::check(), 'user_name' => $auth['name'], 'auth_id' => $auth['id'], 'bookmarks' => $bookmarks]);
    }

    public function upload(Request $request){

    	$validatedData = $request->validate([
        	'user' => 'required|integer',
        	'item_id' => 'required|integer',
    	]);
    	
    	$req = $request->all();

    	if($req['bookmark_is'] == "true"){
            //delete
            $del = Bookmark::where('user', $req['user'])->orwhere('item_id', $req['item_id'])->delete();
    	}else{
            //insert
            Bookmark::create([
                'user' => $req['user'],
                'item_id' => $req['item_id'],
            ]);
    	}
    }
}
