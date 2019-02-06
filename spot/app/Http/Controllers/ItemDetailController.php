<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\SpotItem;
use App\ItemDetail;
use App\User;
use App\Bookmark;

class ItemDetailController extends Controller
{
    public function index(Request $request){

    	$spot_id = (int) $request->input('id');
    	$item = SpotItem::find($spot_id);
    	$author = User::find($item['author_id']); //ユーザー名を取得
    	$item['author_name'] = $author['name']; 

    	$spots = ItemDetail::where('item_id', $item['id'])->get();

    	$auth = Auth::user(); //認証情報を取得
    	$bookmark_is = Bookmark::query()->where('user', $auth['id'])->where('item_id', $spot_id)->count();

    	return view('item_detail', ['is_auth' => Auth::check(), 'auth_id' => $auth['id'], 'user_name' => $auth['name'], 'bookmark_is' => $bookmark_is, 'item' => $item, 'spots' => $spots]);
    }
}
