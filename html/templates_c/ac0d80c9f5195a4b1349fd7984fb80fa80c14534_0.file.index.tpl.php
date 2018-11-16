<?php
/* Smarty version 3.1.32, created on 2018-11-16 04:56:42
  from '/var/www/html/templates/index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5bee4e0abc19e4_28951142',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ac0d80c9f5195a4b1349fd7984fb80fa80c14534' => 
    array (
      0 => '/var/www/html/templates/index.tpl',
      1 => 1542344198,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5bee4e0abc19e4_28951142 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE>

<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="../css/common.css">
</head>

<body>
<div class="row">
	<div class="col-md-12">
		<header>
			<h1>スポッツ!</h1>
			<p id="login_status"><?php echo $_smarty_tpl->tpl_vars['login_status']->value;?>
</p>
		</header><!-- /header -->
	</div>
</div>
<div class="row" id="container">
	<div class="col-md-2">
		<nav class="nav flex-column">
		  	<a class="nav-link active" href="">ホーム</a>
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
			<form action="" method="get" class="col-md-12">
				<div class="input-group" id="serach_bar">
  					<input type="text" class="form-control" name="serach_text" placeholder="" value="<?php echo $_smarty_tpl->tpl_vars['search_text']->value;?>
">
  					<div class="input-group-append">
    						<input class="btn btn-primary" type="submit" name="serach" value="検索">
  					</div>
				</div>
			</form>
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['result']->value, 'item');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
?>
				<div class="item">
                	<a href="item_detail.php?id=<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" title="" >
                		<img src="<?php echo $_smarty_tpl->tpl_vars['item']->value['img_path'];?>
" alt="">
                    	<h3><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</h3>
                    	<p class="author">作成者　<?php echo $_smarty_tpl->tpl_vars['item']->value['author'];?>
</p>
                    </a>
				</div>
			<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
		
		<div class="col-md-12" id="page">
			<div class="row">
				<p class="col-md-4">
					<?php if ($_smarty_tpl->tpl_vars['page']->value > 1) {?>
      					<a href="?page=<?php echo ($_smarty_tpl->tpl_vars['page']->value-1);?>
">前のページへ</a>
    				<?php }?>
				</p>
				<p class="col-md-4"><?php echo $_smarty_tpl->tpl_vars['page']->value;?>
 ページ目</p>
				<p class="col-md-4">
					<?php if ($_smarty_tpl->tpl_vars['page']->value < $_smarty_tpl->tpl_vars['total_page']->value) {?>
    　　				<a href="?page=<?php echo ($_smarty_tpl->tpl_vars['page']->value+1);?>
">次のページへ</a>
    				<?php }?>
				</p>
			</div>
		</div>
	</div>

</div>

<?php echo '<script'; ?>
 src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"><?php echo '</script'; ?>
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
