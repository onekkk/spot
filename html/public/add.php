<?php

require_once('init.php');
error_reporting(-1);


$item = array('name' => "",
                'body' => "",
				'token' => "",
			);
$time;
$spot = array(
			array(
					'name' => "",
					'body' => "",
					'lat'  => "",
					'lng'  => "",
				),
			array(
					'name' => "",
					'body' => "",
					'lat'  => "",
					'lng'  => "",
				),
			array(
					'name' => "",
					'body' => "",
					'lat'  => "",
					'lng'  => "",
				),
			
			);
$author = "不明";
$total_count = 0;
$total_count_m;
$error_flg = -1;
$error_message = "";
$script = "";
$img_error_message = ""; //画像のエラーメッセージー格納変数
$img_array_is; //画像をアップロードしているかを格納する変数

$dbh = new PDO('mysql:host=mysql;dbname=spot', 'root', 'pass');
$csrf_token = generate_token();
$smarty_obj->assign("csrf_token", $csrf_token);

$login_status = "";
$list_text;
$login_list = "";
	//ログインチェック
    if(login_check()){
    	$login_status = $_SESSION["username"] . "でログイン中";
        $list_text = list_array();
    	$login_list = array("link" => "user_logout.php", "text" => "ログアウト");
	}else{
        $login_status = "未ログイン";
        $login_list = array("link" => "user_login.php", "text" => "ログイン");
	}

	$smarty_obj->assign("login_status", $login_status);
    $smarty_obj->assign("list_text", $list_text);
    $smarty_obj->assign("login_list", $login_list);
	
	//追加ボタンを押した時の処理
	if(isset($_POST['add'])){		
		
		$total_count = (int) htmlspecialchars($_POST['count']);  //送信されたスポットの数を受け取る
		$total_count_m = $total_count-1;
		for($i = 0; $i < $total_count-3; $i++){
			$script .= "spot_add();";
		}
		$spot = null; //初期化
		for($i = 0; $i < $total_count; $i++){
        	$post_name = 'spot_name_';
            $post_name .= $i+1;
            $post_body = 'spot_body_';
            $post_body .= $i+1;
            $post_lat = 'spot_lat_';
            $post_lat .= $i+1;
            $post_lng = 'spot_lng_';
            $post_lng .= $i+1;
			
			$array = array(
					'name' => htmlspecialchars($_POST[$post_name], ENT_QUOTES),
					'body' => htmlspecialchars($_POST[$post_body], ENT_QUOTES),
					'lat'  => htmlspecialchars($_POST[$post_lat], ENT_QUOTES),
					'lng'  => htmlspecialchars($_POST[$post_lng], ENT_QUOTES)
					);
			
			$spot[] = $array;
			
		}
		$item = array(
				'name' => htmlspecialchars($_POST['item_name'], ENT_QUOTES),
                'body' => htmlspecialchars($_POST['item_body'], ENT_QUOTES),
				'token' => htmlspecialchars($_POST['token'], ENT_QUOTES)
				);
		// $smarty_obj->assign("total_count", $total_count);
		// $smarty_obj->assign("script", $script);
        // $smarty_obj->assign("spot", $spot);
        // $smarty_obj->assign("item", $item);

		//トークンのチェック
		if(!token_check($item['token'])){
			$error_flg = 0;
		}
		//nameとbodyの中身のチェック
		if(empty($item['name']) || empty($item['body'])){
        	$error_flg = 1;
        }

		
		//スポットのエラーチェック

		//$total_count = (int) htmlspecialchars($_POST['count']); すでに受け取っているためコメントアウト
		for($i = 0; $i < $total_count; $i++){
			//中身のチェック
			if(empty($spot[$i]['name']) || empty($spot[$i]['body']) || empty($spot[$i]['lat']) || empty($spot[$i]['body'])){
				$error_flg = 1;
				break;
			}
			
			//経度と緯度に数値以外の値が入っていないかのチェック
			if(!preg_match("/^[-]?[0-9]+(\.[0-9]+)?$/", $spot[$i]['lat']) || !preg_match("/^[-]?[0-9]+(\.[0-9]+)?$/", $spot[$i]['lng'])){
                $error_flg = 2;
				break;
            }
		}

		//画像のエラーチェック
		//アイテムのトップにアップロードする画像のエラーチェック
		if(is_uploaded_file($_FILES['item_img']['tmp_name'])){ //画像がアップロードしていた場合
			$error_is = img_error_check('item_img');//画像のエラーチェック
			if($error_is[0]){
				$error_flg = 3;
				$img_error_message = $error_is[1];
			}
		}else{
			$error_flg = 3;
			$img_error_message = "ファイルをアップロードしてください";
		}

		//スポットにアップする画像のエラーチェック
		for($i = 0; $i < $total_count; $i++){
			$spot_img_name = "spot_img_" . ($i + 1);
			if(is_uploaded_file($_FILES[$spot_img_name]['tmp_name'])){ //画像がアップロードしていた場合
				$error_is = img_error_check($spot_img_name);//画像のエラーチェック
				if($error_is[0]){
					$error_flg = 3;
					$img_error_message = $error_is[1];
					break;
				}
				$img_array_is[] = true;
			}else{
				$img_array_is[] = false;
			}
		}

		//エラーメッセージを変数に格納する
		if($error_flg == 0){
			$error_message = '<p id="error" class="alert alert-danger"><strong>不正な送信です。</strong></p>';
		}else if($error_flg == 1){
			$error_message = '<p id="error" class="alert alert-danger"><strong>未入力の値があります</strong></p>';	
		}else if($error_flg == 2){
            $error_message = '<p id="error" class="alert alert-danger"><strong>緯度か経度に不正な値が入力されています。</strong></p>';
        }else if($error_flg == 3){
        	$error_message = "<p id=\"error\" class=\"alert alert-danger\"><strong> $img_error_message </strong></p>";

        }else{
			//データベースに登録
			$timestamp = time();
			$time = date("Y-m-d H:i:s", $timestamp);
			$author = $_SESSION['username'];
			//画像のアップロード処理
			//アイテムの画像のアップロード処理
			$sth = $dbh->query('SELECT MAX(id) FROM spot_items;');
			$result = $sth->fetch();
			//var_dump($result);
			if($result == null){
				$result = -1;
			}
			$extension=img_type('item_img'); //画像の拡張子を調べる関数
			$file_name = "../img/spot_items/" . ((int)$result[0] + 1) . $extension;
			move_uploaded_file($_FILES['item_img']['tmp_name'], $file_name);
			$sth = $dbh->prepare('INSERT INTO spot_items(author, name, body, post_date, img_path) VALUES(?, ?, ?, ?, ?);');
			$sth->execute(array($author, $item['name'], $item['body'], $time, $file_name));
			

			$sth = $dbh->prepare('SELECT MAX(id) FROM spot_items');
			$sth->execute();
			$result = $sth->fetch();
			//画像のアップロード処理
			//スポットの画像のアップロード処理
			//INSERTの処理
			$sth = $dbh->prepare('INSERT INTO items_detail(item_id, name, body, lat, lng, img_path) VALUES(?, ?, ?, ?, ?, ?);');
            for($i = 0; $i < $total_count; $i++){
            	$file_name = "";
            	if($img_array_is[$i]){
            		$spot_img_name = "spot_img_" . ($i + 1);
	            	$sth2 = $dbh->query('SELECT MAX(id) FROM item_detail;');
	            	$result2 = $sth->fetch();
	            	if($result2 == null){
						$result2 = -1;
					}
					$extension=img_type($spot_img_name); //画像の拡張子を調べる関数
					$file_name = "../img/items_detail/" . ((int)$result2[0] + 1) . $extension;
					move_uploaded_file($_FILES[$spot_img_name]['tmp_name'], $file_name);
	            }
				$sth->execute(array($result[0], $spot[$i]['name'], $spot[$i]['body'], $spot[$i]['lat'], $spot[$i]['lng'], $file_name));
			}
			header("Location:./add_success.php");
			
		}
		//エラーメッセージをassign
		//$smarty_obj->assign("error_message", $error_message);	
		
	}
	$smarty_obj->assign("total_count", $total_count);
	$smarty_obj->assign("script", $script);
    $smarty_obj->assign("spot", $spot);
    $smarty_obj->assign("item", $item);
	$smarty_obj->assign("error_message", $error_message);

	$smarty_obj->display("add.tpl");
