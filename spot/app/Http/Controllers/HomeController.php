<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    use AuthenticatesUsers;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $spots = [];
        $search_text = $request->input('search_text');
        if(!empty($search_text)){
            $spots = DB::table('spot_items')
            ->join('users', 'spot_items.author_id', '=', 'users.id')
            ->where('spot_items.name', 'like', '%'.$search_text.'%')
            ->orwhere('spot_items.body', 'like', '%'.$search_text.'%')
            ->select('spot_items.*', 'users.name as author_name')
            ->paginate(20);

        }else{
            $spots = DB::table('spot_items')
            ->join('users', 'spot_items.author_id', '=', 'users.id')
            ->select('spot_items.*', 'users.name as author_name')
            ->paginate(20);
        }

        $auth = Auth::user(); //認証情報を取得
        return view('home', ["spots" => $spots, "search_text" => $search_text, 'is_auth' => Auth::check(), 'user_name' => $auth['name']]);
    }
}
