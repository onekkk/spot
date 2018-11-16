<?php
    require_once('init.php');
    $dbh = new PDO('mysql:host=mysql;dbname=spot', 'root', 'pass');

    $login_status;
	$login_name = "";
	$login_status_text = "";
	$list_text = "";
	$login_list = "";
	$user_name = "不明";
	$user_body = "";
	$error = false;
	$img_error_messag = "";

	//ログインチェック

	$login_status = login_check();
    if($login_status){
		$login_name = $_SESSION["username"];
        $login_status_text = $login_name . "でログイン中";
		$list_text = list_array();
        $login_list = array("link" => "user_logout.php", "text" => "ログアウト");
	}else{
        $login_status_text = "未ログイン";
        $login_list = array("link" => "user_login.php", "text" => "ログイン");
	}
	$smarty_obj->assign("login_name", $login_name);	
	$smarty_obj->assign("login_status_text", $login_status_text);
    $smarty_obj->assign("list_text", $list_text);
    $smarty_obj->assign("login_list", $login_list);
	
	//ユーザーの取得
	$user_name = $_SESSION["username"];
	$smarty_obj->assign("user_name", $user_name);

	//ユーザの情報を取得
	$sql = 'SELECT * FROM user WHERE username LIKE ? ;';
	$sth = $dbh->prepare($sql);
    $sth->execute(array($user_name));
    $result = $sth->fetch();
	
	$smarty_obj->assign("result", $result);

	if(isset($_POST['edit'])){
		if(is_uploaded_file($_FILES['user_icon']['tmp_name'])){ //画像がアップロードしていた場合
			$error_is = img_error_check('user_icon');//画像のエラーチェック
			if($error_is[0]){
				$error = true;
				$img_error_message = $error_is[1];
			}
		}else{
			$error = true;
			$img_error_message = "ファイルをアップロードしてください";
		}
		//エラーが検出されなかった場合
		if(!($error)){
			//画像のアップロード処理
			$extension=img_type('user_icon'); //画像の拡張子を調べる関数
			$file_name = "../img/user_icon/" . (int)$result['id'] . $extension;
			move_uploaded_file($_FILES['user_icon']['tmp_name'], $file_name);
			$sql = 'UPDATE user SET img_path = ? WHERE username LIKE ? ;';
			$sth = $dbh->prepare($sql);
    		$sth->execute(array($file_name, $user_name));
    		header("Location:./user_detail_edit_succes.php");
		}
		$smarty_obj->assign("error_message", $error_message);
	}

	$smarty_obj->display("user_detail_edit.tpl");
