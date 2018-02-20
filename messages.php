<?php
require_once 'functions.php';
require_once 'connect.php';

session_start();
if ($_GET['code']) {	
	if (!isset($_SESSION['idFb'])) {		
	registration();	  
	}	
}
if (!isset($_SESSION['idFb'])) {
  $logInNone = '<div class="col-sm-6 post-div">
          <a href="index.php" class="btn btn-block btn-odnoklassniki btn-lg">To add and comment messages sign in</a>
        </div>';
  $logOutNone = ' none';     
}

$dbIdFb = db()->query('SELECT id_fb FROM registration');
if ($dbIdFb->num_rows != 0 && isset($_SESSION['idFb'])) {
  $idFb = $_SESSION['idFb'];
  $dbIdFb = db()->query('SELECT id, id_fb, name FROM registration WHERE id_fb ='.$idFb);

  while ($row = $dbIdFb->fetch_object()) {
  $i = $row->id;  
  $n = $row->name;
  $fb = $row->id_fb;
  }
}

if(isset($_POST['post']) || isset($_POST['comment']))
{ 
  addEditPostDb();
} 

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Test LI</title>

    <!-- Bootstrap -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-social.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
  </head>
  <body> 

  <div class="container"> 
      <div class="row">

      	<?php echo $logInNone ?>
        
        <div class="center-block col-sm-6 post-div <?php echo $logOutNone ?>">  
          <h3 class="text-center text-primary">Your post:</h3>
          <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data" name="post"  id="form">
            
              <div class="form-group">
                  <textarea class="form-control" id="post" name="text" rows="3" required></textarea>
              </div>
              
              <input type="hidden" name="parent" value="0">
              <input type="hidden" name="edit" value="0">
              <input type="hidden" name="id" value="<?php echo $i ?>">
              <input type="hidden" name="name" value="<?php echo $n ?>">
              <input type="hidden" name="fb" value="<?php echo $fb ?>">
              <button type="submit" class="btn btn-primary  center-block" id="button_post" name="post" >Save</button>
            </form>
        </div>
      </div> 


      <div class="center-block col-sm-6 post-div comment-div"> 
          <button class="btn btn-danger btn-xs btn-close">X</button> 
          <h4 class="text-center text-primary">Your comment:</h4>
          <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data" name="post"  id="form">
            
              <div class="form-group">
                  <textarea class="form-control" id="post" name="text" rows="3" required></textarea>
              </div>
              <input type="hidden" name="parent" class="parent">
              <input type="hidden" name="edit" class="edit">
              <input type="hidden" name="id" value="<?php echo $i ?>">
              <input type="hidden" name="name" value="<?php echo $n ?>">
              <input type="hidden" name="fb" value="<?php echo $fb ?>">
              <button type="submit" class="btn btn-primary center-block" id="button_post" name="comment" >Save</button>
            </form>
        </div>

<?php 

drawAllComments();

?>

  </div>
  
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/script.js"></script>
  </body>
</html>