<?php
session_start();
// Smartyクラスを読み込む
require_once("../smarty/libs/Smarty.class.php");

// Smartyのインスタンスを生成
$smarty_obj = new Smarty();

// テンプレートディレクトリとコンパイルディレクトリを読み込む
$smarty_obj->setTemplateDir(__DIR__.'/../templates/');
$smarty_obj->setCompileDir(__DIR__.'/../templates_c/');


//トークンを生成
function generate_token()
{
    return hash('sha256', session_id());
}
//トークンのチェック
function token_check($token_post){
	$token = generate_token();
	if($token == $token_post){
		return true;
	}
	return false;
}

//ログインのチェック
function login_check(){
	if(isset($_SESSION['username'])){
                return true;
        }else{
                return false;
        }
}

//navバーのlistを生成
function list_array(){
	$link = array("add.php", "user_detail.php", "follow_up_list.php", "bookmark_list.php");
	$text = array("スポット登録", "ユーザー情報", "フォロー一覧", "お気に入り一覧");
	$list = array();
	for($i = 0; $i < count($link); $i++){
		$array = array(
			"link" => $link[$i],
			"text" => $text[$i]
		);
		$list[] = $array;
	}
	return $list;
}

//画像のエラーチェック
function img_error_check($img_name){
	try{	
			//エラー処理
			if (!isset($_FILES[$img_name]['error']) || !is_int($_FILES[$img_name]['error'])) {
        			throw new RuntimeException('パラメータが不正です');
    			}
			// $_FILES['img']['error'] の値を確認
    		switch ($_FILES[$img_name]['error']) {
        		case UPLOAD_ERR_OK: // OK
           			break;
        		case UPLOAD_ERR_INI_SIZE:  // php.ini定義の最大サイズ超過
        		case UPLOAD_ERR_FORM_SIZE: // フォーム定義の最大サイズ超過 (設定した場合のみ)
            		throw new RuntimeException('ファイルサイズが大きすぎます');
        		default:
            		throw new RuntimeException('その他のエラーが発生しました');
    		}
			// $_FILES['img']['mime']の値はブラウザ側で偽装可能なので
    			// MIMEタイプに対応する拡張子を自前で取得する
    			if (!$ext = array_search(
        			mime_content_type($_FILES[$img_name]['tmp_name']),
        			array(
            				'gif' => 'image/gif',
            				'jpg' => 'image/jpeg',
            				'png' => 'image/png',
        			),
        			true
    			)) {
        			throw new RuntimeException('ファイル形式が不正です');
    			}
    			//エラーが　検出されなかった場合
    			return array(false, "");
				// $sth = $dbh->prepare('SELECT MAX(id) FROM bbs_comment;');
				// $sth->execute();
				// $result = $sth->fetch();
				// $extension="";
				// if(strrchr($_FILES['img']['name'], '.') === '.jpg'){
				// 	$extension=".jpg";
				// }else if(strrchr($_FILES['img']['name'], '.') === '.png'){
				// 	$extension=".png";

				// }else if(strrchr($_FILES['img']['name'], '.') === '.gif'){
				// 	$extension=".gif";
				// }
				// $file_name = "img/" . ((int)$result[0] + 1) . $extension;
			
				// move_uploaded_file($_FILES['img']['tmp_name'], $file_name);

			}catch(RuntimeException $e){
				return array(true, $e->getMessage());
			}

}

function img_type($img_name){
	$extension="";
	if(strrchr($_FILES[$img_name]['name'], '.') === '.jpg'){
		$extension=".jpg";
	}else if(strrchr($_FILES[$img_name]['name'], '.') === '.png'){
		$extension=".png";
	}else if(strrchr($_FILES[$img_name]['name'], '.') === '.gif'){
		$extension=".gif";
	}
	return $extension;
}




