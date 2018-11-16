<?php
/* Smarty version 3.1.32, created on 2018-11-16 11:18:34
  from '/var/www/html/templates/user_detail_edit.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5beea78a2346f4_34518559',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '605a22aff8b958e88c321c186bed3f1c6f846d81' => 
    array (
      0 => '/var/www/html/templates/user_detail_edit.tpl',
      1 => 1542367103,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5beea78a2346f4_34518559 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE>

<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="../css/common.css">
<link rel="stylesheet" type="text/css" href="../css/user_detail_edit.css">
<?php echo '<script'; ?>
 src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7" crossorigin="anonymous"><?php echo '</script'; ?>
>
</head>

<body>
<div class="row">
        <div class="col-md-12">
                <header>
                        <h1>スポッツ!</h1>
                        <p id="login_status"><?php echo $_smarty_tpl->tpl_vars['login_status_text']->value;?>
</p>
                </header><!-- /header -->
        </div>
</div>
<div class="row" id="container">
        <div class="col-md-2">
                <nav class="nav flex-column">
                        <a class="nav-link active" href="index.php">ホーム</a>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list_text']->value, 'li');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['li']->value) {
?>
                                <a class="nav-link" href="<?php echo $_smarty_tpl->tpl_vars['li']->value["link"];?>
"><?php echo $_smarty_tpl->tpl_vars['li']->value["text"];?>
</a>
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        <a class="nav-link" href="<?php echo $_smarty_tpl->tpl_vars['login_list']->value['link'];?>
"><?php echo $_smarty_tpl->tpl_vars['login_list']->value['text'];?>
</a>
                </nav>
        </div>
        <div class="col-md-10">
                <div class="row">
			<div class="col-md-12">
				<h2 class="col-md-12" id="user_info">ユーザー情報の設定</h2>
				<div id="info_body">
                    <div class="col-md-3"></div>
					<div class="row">
                        <form action="" class="col-md-12" method="post" enctype="multipart/form-data">
                            <?php echo $_smarty_tpl->tpl_vars['error_message']->value;?>

                            <label class="col-md-4 btn btn-secondary" id="img_btn">
                                アイコンの画像を選択
                                <input type="file" name="user_icon" id="img_upload" class="" accept=".jpg,.gif,.png,image/gif,image/jpeg,image/png">
                            </label>
                            <div class="row">
        						<p class="col-md-5 body_left">    ユーザー名：</p>
        						<p class="col-md-7" description><?php echo $_smarty_tpl->tpl_vars['user_name']->value;?>
</p>
                            </div>
    						<!--
    						<p class="col-md-5 body_left">ユーザーの紹介文：</p>
                            <p class="col-md-7" description><?php echo $_smarty_tpl->tpl_vars['user_body']->value;?>
</p>
    						-->
                            <input type="submit" value="変更" name="edit" class="float-right btn btn-success">
                        </form>
					</div>
                    <div class="col-md-3"></div>
				</div>
			</div>
        </div>
</div>

<?php echo '<script'; ?>
>

<?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"><?php echo '</script'; ?>
>
</body>
</html>


<?php }
}
