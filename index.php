<?php 
include_once('sessionhelpers.inc.php');
if($_GET['wunsch'] == 'new' && $_GET['titel']!=''){
	$titel = $_GET['titel'];
	$interpret = $_GET['interpret'];
	$name = $_GET['name'];
	$agent = 'User-Agent: ' . $_SERVER['HTTP_USER_AGENT'];
	$ip = $_SERVER['REMOTE_ADDR'];
	insert($titel,$interpret,$name,$agent,$ip);
	header('Location: index.php');
}elseif($_GET['wunsch']=='new' && $_GET['titel']==''){header('Location: index.php');}
if($_GET['like']!=''){
	like($_GET['like']);
	header('Location: index.php');
}elseif($_GET['dislike']){
	dislike($_GET['dislike']);
	header('Location: index.php');
}


?>               
<!DOCTYPE html>
<html lang="de">
<head>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/custom.min.css">
<script src="js/jquery.min.js"></script>
</head>
<body>
			   <!-- Horizontal Form -->
                <div class="panel panel-green margin-bottom-40">
                    <div class="panel-heading">
                        
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="get" action="index.php">
							<input type="hidden" value="new" id="wunsch" name="wunsch">
                            <div class="form-group">
                                <label for="titel" class="col-lg-2 control-label">Titel</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" name="titel" id="titel" placeholder="Titel">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="interpret" class="col-lg-2 control-label">Interpret</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" name="interpret" id="interpret" placeholder="Interpret">
                                </div>
                            </div>
                           <!-- <div class="form-group">
                                <label for="name" class="col-lg-2 control-label">Name</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Name">
									
                                </div>
                            </div>-->
                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button type="submit" class="btn btn-success">Absenden</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- End Horizontal Form -->
				<?php if($_GET['list']=='likes') { echo '<a class="btn btn-info" style="color:white;" href="?">Nach Reihenfolge sortieren!</a>';}
						else {echo '<a class="btn btn-info" style="color:white;" href="?list=likes">Nach Anzahl der Likes sortieren!</a>';} ?>
<table class="table table-striped table-hover ">
  <thead>
    <tr>
      <th>#</th>
      <th>Titel</th>
      <th>Interpret</th>
	  <th>Voting</th>
	  <th style="width:9%;">&nbsp;</th>
    </tr>
  </thead>
  <tbody>
  
	<?php listwishes($_GET['list']); ?>
      
  </tbody>
</table> 
<!-- Latest compiled and minified JavaScript -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>