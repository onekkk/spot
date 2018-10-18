<?php
    require_once('init.php');
    $dbh = new PDO('mysql:host=localhost;dbname=spot', 'root', 'ichimura');

    $login_status;
	$login_name = "";
	$login_status_text = "";
	$list_text = "";
	$login_list = "";
	$user_name = "不明";
	$user_body = "";
	$follow_text = "";
	$follow_is;

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
	if(isset($_GET['user'])){
		$user_name = htmlspecialchars($_GET['user'], ENT_QUOTES);
	}else{
		$user_name = $login_name;
	}
	$smarty_obj->assign("user_name", $user_name);

	//ユーザがフォローしているかのチェック
    $sth = $dbh->prepare('SELECT COUNT(*) FROM follow WHERE follow = ? && follower = ? ;');
    $sth->execute(array($login_name, $user_name));
    $result = $sth->fetch();
    //フォローしている場合true
    if($result[0] != '0'){
    	$follow_is = true;
    }else{
    	$follow_is = false;
   	}
	$follow_text = "";
	if($follow_is){
		$follow_is_text = "フォローをはずす";
	}else{
		$follow_is_text = "フォローする";
	}
	//フォローボタンの表示
	if($login_status == true && $user_name != $_SESSION["username"]){
		$follow_text = "<input type=\"button\" class=\"btn btn-outline-primary\" id=\"follow_btn\" value=\"" . $follow_is_text . "\">";
	}
	$smarty_obj->assign("follow_is", $follow_is);
	$smarty_obj->assign("follow_text", $follow_text);

	//ユーザの情報を取得
	$sql = 'SELECT id, body FROM user WHERE username LIKE ? ;';
	$sth = $dbh->prepare($sql);
    $sth->execute($user_name);
    $result = $sth->fetch();
	$user_body = $result['body'];
    
	//ユーザが投稿したアイテムを取得            
	$sql = 'SELECT * FROM spot_items WHERE author LIKE :user ORDER BY id DESC';
    $sql_count = 'SELECT COUNT(*) FROM spot_items WHERE author LIKE :user ;';

	//ページングの処理
    $sth = $dbh->prepare($sql_count);
    $sth->execute(array(':user' => $user_name));
    $result = $sth->fetch();

    $total_item = (int) $result[0]; //アイテムの総数
    $display_item = 20;//一ページ内に表示するアイテム数
    $total_page;
    if($total_item <= $display_item){
    	$total_page = 1;
    }else if ($total_item % $display_item == 0){
        $total_page = $total_item / $display_item;
    }else{
        $total_page = $total_item / $display_item + 1;
    }

    $total_page = (int) $total_page;
    $page = htmlspecialchars($_GET["page"]);

    if (isset($_GET["page"]) && $_GET["page"] > 0 && $_GET["page"] <= $total_page) {
        $page = (int)$page;
    } else {
        $page = 1;
    }
	$smarty_obj->assign("page", $page);
	$smarty_obj->assign("total_page", $total_page);

    $display_count_current = ($page - 1) * $display_item ;
    $sql .= " LIMIT :display_count_current , :display_item ;";

	//アイテムの情報を取得する
    $sth = $dbh->prepare($sql);
	$sth->bindValue(':user', "$user_name");
	$sth->bindValue(':display_count_current', $display_count_current, PDO::PARAM_INT);
	$sth->bindValue(':display_item', $display_item, PDO::PARAM_INT);
    $sth->execute();
    $result = $sth->fetchAll();
	
	//bodyが長文の場合の処理
	foreach($result as &$line){ //bodyを書き換えるため参照渡し
    	$body_str = mb_strimwidth($line['body'],0,68);
    	if(mb_strlen($body_str) > 34){
        	$body_str .= "…";
        }
        $line['body'] = $body_str;
    }
    unset($line);

	
	$smarty_obj->assign("result", $result);

	$smarty_obj->display("user_detail.tpl");
