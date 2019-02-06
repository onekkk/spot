<?php

namespace App\Http\Controllers;


use Validator;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\SpotItem;
use App\ItemDetail;


class AddController extends Controller
{

    public function index(Request $request){

    	$auth = Auth::user(); //認証情報を取得
    	return view('add', ['is_auth' => Auth::check(), 'user_name' => $auth['name'], 'script' => '']);
    }


    public function upload(Request $request){

    	$req = $request->all();

    	$item[] = array();
		$item['name'] = $req['item_name'];
		$item['body'] = $req['item_body'];
		if(!empty($req['item_img'])){
			$item['img'] = $req['item_img'];
		}else{
			$item['img'] = "";
		}

    	$spot_total = $req['count'];
		$spots = array();
		for($i = 1; $i <= $spot_total; $i++){
			$sp = array();
			$sp_name = 'spot_name_' . $i;
			$sp_body =  "spot_body_" . $i;
			$sp_img = 'spot_img_' . $i;
			$sp_lat = 'spot_lat_' . $i;
			$sp_lng = 'spot_lng_' . $i;
			$sp['name'] = $req[$sp_name];
			$sp['body'] = $req[$sp_body];
			if(!empty($req[$sp_img])){
				$sp['img'] = $req[$sp_img];
			}
			$sp['lat'] = $req[$sp_lat];
			$sp['lng'] = $req[$sp_lng];

			$spots[] = $sp;
		}

		
		$item_rules = [
			'name' => ['required', 'max:80'],
			'body' => ['required', 'max:1000'],
			'img' => ['required', 'file', 'image', 'mimes:jpeg,png,gif', /*'dimensions:min_width=120,min_height=120,max_width=400,max_height=400',*/],
		];

		$item_validator = Validator::make($item, $item_rules)->validate();


		$spot_rules = [
			'*.name' => ['required', 'max:80'],
			'*.body' => ['required', 'max:1000'],
			'*.img' => ['file', 'image', 'mimes:jpeg,png,gif', /*'dimensions:min_width=120,min_height=120,max_width=400,max_height=400',*/],
			'*.lat' => ['required', 'regex:/^[-]?[0-9]+(\.[0-9]+)?$/'],
			'*.lng' => ['required', 'regex:/^[-]?[0-9]+(\.[0-9]+)?$/'],
		];


		$spot_validator = Validator::make($spots, $spot_rules)->validate();

		/* 登録処理 */

		$auth = Auth::user();
		$path = $request->file('item_img')->store('public/img/items');
		$file_path = "storage/img/items/".basename($path);
		SpotItem::create([
			'author_id' => $auth['id'],
			'name' => $item['name'],
			'body' => $item['body'],
			'img_path' => $file_path,
		]);

		$spot_id = SpotItem::max('id');
		var_dump($spot_id);

		for($i = 1; $i <= $spot_total; $i++){
			$req_file = 'spot_img_' . $i;
			$file_path = null;
			if ($request->hasFile($req_file)) {
				$path = $request->file('item_img')->store('public/img/spots');
				$file_path = "storage/img/spots/".basename($path);
			}

			ItemDetail::create([
				'item_id' => $spot_id,
				'name' => $spots[$i-1]['name'],
				'body' => $spots[$i-1]['body'],
				'lat' => (double) $spots[$i-1]['lat'],
				'lng' => (double) $spots[$i-1]['lng'],
				'img_path' => $file_path,
			]);
		}

		return redirect('/');

    }

}
