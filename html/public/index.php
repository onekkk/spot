<?php
	require_once('init.php');
	$dbh = new PDO('mysql:host=mysql;dbname=spot', 'root', 'pass');
	
	$serach_text = "";
	$login_status = "";
	$login_list = "";
	$list_text;

	if(login_check()){
		$login_status = $_SESSION["username"] . "でログイン中";
		$list_text = list_array();//ログイン時に表示するリストの内容を返す関数
		$login_list = array("link" => "user_logout.php", "text" => "ログアウト");
	}else{
		$login_status = "未ログイン";
		$login_list = array("link" => "user_login.php", "text" => "ログイン");
	}
	$smarty_obj->assign("login_status", $login_status);
	$smarty_obj->assign("list_text", $list_text);
	$smarty_obj->assign("login_list", $login_list);	

	//アイテムを検索するSQLと総数を検索するSQLを作成
	$sql = "";
	$sql_count = "";
    $search_text_like = ""; 
	if (isset($_GET["serach"])){//検索バーに文字が入ってある場合
		$search_text = htmlspecialchars($_GET["serach_text"]);
	}

	$sql = 'SELECT * FROM spot_items WHERE name LIKE :search_text OR body LIKE :search_text OR author LIKE :search_text ORDER BY id DESC';
	$sql_count = 'SELECT COUNT(*) FROM spot_items WHERE name LIKE :search_text OR body LIKE :search_text OR author LIKE  :search_text ORDER BY id DESC;';

	$smarty_obj->assign("search_text", $search_text);

	
	$sth = $dbh->prepare($sql_count); 
	$sth->bindValue(':search_text', "%{$search_text}%");
	$sth->execute();
    $result = $sth->fetch();


	$total_item = (int) $result[0];//アイテム数を取得
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
	
	//現在のページ数を取得
	if (isset($_GET["page"]) && $_GET["page"] > 0 && $_GET["page"] <= $total_page) {
		$page = htmlspecialchars($_GET["page"]);
  		$page = (int) $page;
	} else {
  		$page = 1;
	}
	$smarty_obj->assign("page", $page);
	$smarty_obj->assign("total_page", $total_page);

	//ページ内に表示するアイテムの情報を取得
	$display_count_current = ($page - 1) * $display_item ;
	$sql .= " LIMIT :display_count_current , :display_item ;";

	$sth = $dbh->prepare($sql);
	$sth->bindValue(':search_text', "%{$search_text}%");
	$sth->bindValue(':display_count_current', $display_count_current, PDO::PARAM_INT);
	$sth->bindValue(':display_item', $display_item, PDO::PARAM_INT);
	$sth->execute();
	$result = $sth->fetchAll();
	
	//body内に表示する文字数を調整
	foreach($result as &$line){
		$body_str = mb_strimwidth($line['body'],0,68);
		if(mb_strlen($body_str) > 34){
			$body_str .= "…";
		}
		$line['body'] = $body_str;
	}
	unset($line);
	$smarty_obj->assign("result", $result);

	$smarty_obj->display("index.tpl");
