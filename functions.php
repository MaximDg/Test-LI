<?php
require_once 'connect.php';
require_once 'config.php';

function registration()
{

if (!$_GET['code']) {
	exit('error code in url');
}

$token = json_decode(file_get_contents('https://graph.facebook.com/v2.12/oauth/access_token?client_id='.ID.'&redirect_uri='.URL.'&client_secret='.SECRET.'&code='.$_GET['code']), true);

if (!$token) {
	exit('error token');
}

$data = json_decode(file_get_contents('https://graph.facebook.com/v2.12/me?client_id='.ID.'&redirect_uri='.URL.'&client_secret='.SECRET.'&code='.$_GET['code'].'&access_token='.$token['access_token'].'&fields=id,name,email,gender,location'), true);

if (!$data) {
	exit('error data');
}

$email =  $data['email'];
$name = $data['name'];
$idFb = $data['id'];
	$dbIdFb = db()->query('SELECT id_fb FROM registration');
	if ($dbIdFb->num_rows == 0) {	
					session_start();
					$_SESSION['idFb'] = $idFb;			
					db()->query("INSERT INTO registration (name, email, id_fb) VALUES ('{$name}', '{$email}', '{$idFb}')");
	}			
	else {
		$dbIdFb = db()->query('SELECT id_fb FROM registration WHERE id_fb ='.$idFb);
		if ($dbIdFb->num_rows != 0) {
			return;
		}
		session_start();
		$_SESSION['idFb'] = $idFb;				
		db()->query("INSERT INTO registration (name, email, id_fb) VALUES ('{$name}', '{$email}', '{$idFb}')");
	}
}

function addEditPostDb()
{

	$idUser = ($_POST['id']);
	$idUserFb = ($_POST['fb']);
	$idParent = ($_POST['parent']);
	$editId = ($_POST['edit']);
	$name = ($_POST['name']);
	$post = strip_tags(trim($_POST['text']));
	date_default_timezone_set('Europe/Kiev');
	$timeUpdate = date('Y-m-d H:i:s');

    if ($editId != 0 && $editId != '') {
    	db()->query("UPDATE posts SET post = '$post' WHERE id = '$editId'");
    }
    else {
    	db()->query("INSERT INTO posts (id_user, id_user_fb, id_parent, name, post, time_update) VALUES ('{$idUser}', '{$idUserFb}', '{$idParent}', '{$name}', '{$post}', '{$timeUpdate}')");
    }

}


function drawAllComments()
{
	drawAllCommentsWithParentID(0, 0);
}

function drawAllCommentsWithParentID($parID, $lvl)
{
	$order = $parID == 0 ? 'DESC' : 'ASC';
	$posts = db()->query('SELECT id, id_user_fb, name, post, time_update FROM posts WHERE id_parent ='.$parID.' ORDER BY time_update '.$order);


  	while ($row = $posts->fetch_object()) {	
  		$parentId = $row->id;
		drawComment($row, $lvl, $parID, $parentId);		
		drawAllCommentsWithParentID($parentId, $lvl+1);
	}  

}

function drawComment($row, $lvl, $parIdBlock, $parentId)
{	

	$test = $_SESSION['idFb'];
	$test1 = $row->id_user_fb;
	$postId = $row->id;

	if ($test == $test1) {
		$textUserLog = '<button class="btn btn-warning btn-xs btn-edit" name="'.$postId.'">edit</button>';
	}
	else {
		$textUserLog = '';
	}

	if (isset($_SESSION['idFb'])) {
		$btnCom = '<button name="'.$row->id.'" class="btn btn-xs btn-primary btn-comment">comment</button>';
	}
	else {
		$btnCom = '';
	}

	$str = $row->post;
	$str = strip_tags($str);
	if (strlen($str) > 110) {
		$textPrev = substr($str, 0, 110);
		$textPrev = rtrim($textPrev, "!,.-");
		$textPrev = substr($textPrev, 0, strrpos($textPrev, ' '));
		$textNext = substr($str, strlen($textPrev));
		$str = '<div class="panel-body panel-body-my"><span class="text-prev">'.$textPrev.'</span><span class="text-next">'.$textNext.'</span>
			<a href="#" class="text-more">... show full</a></div><button class="btn btn-success btn-xs btn-plus-minus" name="'.$parentId.'">+/-</button>'.$btnCom.$textUserLog;
	} 
	else {
		$str = '<div class="panel-body panel-body-my">'.$row->post.'</div><button class="btn btn-success btn-xs btn-plus-minus" name="'.$parentId.'">+/-</button>'.$btnCom.$textUserLog;
	}

	$marginL = 40*$lvl;
	$commentNoneBlock = $lvl == 0 ? '' : 'class="comment-panel '.$parIdBlock.'"';
	echo '<div class="clearfix"></div>
			<div '.$commentNoneBlock.' style="margin-left: '.$marginL.'px; display: block;">
				<div class="panel panel-default col-sm-4">
				  <div class="panel-heading panel-heading-my">'.$row->name."<span>".$row->time_update.'</span></div>'.$str.'				  	  
				</div>				
			</div>';
}

?>
