<?php

	require_once('init.php');

	$dbh = new PDO('mysql:host=mysql;dbname=spot', 'root', 'pass');
	$username;
	$password;
	$token;
	$error_message = "";


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



	//登録ボタンを押された場合の処理
	if (isset($_POST["sign_up"])){
		$username = htmlspecialchars($_POST["username"]);
		$password = htmlspecialchars($_POST["password"]);
		$token = htmlspecialchars($_POST["token"]);

		//エラーチェック
		if($token != $csrf_token){ //トークンのチェック
			$error_message = "<p id=\"error\" class=\"alert alert-danger\"><strong>不正な送信です。</strong></p>";
		}else if(empty($_POST["username"]) || empty($_POST["password"])){ //値のチェック
			$error_message = "<p id=\"error\" class=\"alert alert-danger\"><strong>正しい値が入力されていません</strong></p>";
		}else{
		
		//重複しているユーザIDの有無をチェック
		$sth = $dbh->prepare('SELECT COUNT(*) FROM user WHERE username=?;');
        $sth->execute(array($username));
        $result = $sth->fetch();
		$check = (int) $result[0];
		if($check!= 0){
			$error_message = "<p id=\"error\" class=\"alert alert-danger\"><strong>このユーザーIDはすでに登録されています。</strong></p>";
		}else{
			
			//データベースに登録
        	$password = password_hash($password, PASSWORD_DEFAULT);
            $sth = $dbh->prepare('INSERT INTO user(username, password) VALUES(?, ?);');
            $sth->execute(array($username, $password));
			$_SESSION['username'] = $username;
            $error_mesage = "";
            header("Location:./index.php");
            exit;
		}
	}
	$smarty_obj->assign("error_message", $error_message);
    $smarty_obj->assign("username", $username);
    $smarty_obj->assign("password", $password);
}
$smarty_obj->display("user_sign_up.tpl");
