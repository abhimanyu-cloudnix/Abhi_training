<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap Assignment</title>
	<link href="bt.css" rel="stylesheet">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	
	<!--UI-->
	<link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">
	<script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<!--databse connectivity-->

	<?php
	$con = mysqli_connect("localhost","root","root","Training");
	?>
	
	<?php $NAME=$_POST['Name'];;
	
	?>
	 

<script>
		function post1(name) {
			
			var str = document.forms["myForm"]["comment"].value;
			

		    if (window.XMLHttpRequest) {
    
			  xmlhttp=new XMLHttpRequest();
			  } 
			  xmlhttp.onreadystatechange=function() {
			    if (this.readyState==4 && this.status==200) {
			      document.getElementById("txtHint").innerHTML=this.responseText;
			    }
			  }
			  xmlhttp.open("GET","post.php?q="+name+"&x="+str,true);
			  xmlhttp.send();
			}

			  
		
	
	
</script>  
	
   
 </head>
 <body >
 <div class="container-fluid">
  
<div class="jumbotron">
	  <div class="container text-center">
	  <h2>
	  <?php
		
		$sql = "SELECT Name FROM tuser where Name='". $GLOBALS['NAME'] ."'";
		$result = $con->query($sql);

		if ($result->num_rows > 0) {
		    
		    while($row = $result->fetch_assoc()) {
		        echo $row["Name"].  "<br>";
		    }
		    }
		?>
		</h2>      
		<p>My Portfolio</p>
	  </div>
	</div>
	
	<!--left-nav-->
	<div class="row">
	  <div class="col-sm-3">
		<div class="sidebar-nav">
		  <div class="navbar navbar-default" role="navigation">
		  
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
			  <span class="visible-xs navbar-brand">Menu</span>
			</div>
			<div class="navbar-collapse collapse sidebar-navbar-collapse navbar navbar-inverse ">
			
			  <ul class="nav navbar-nav">
			  	<?php
		
				$sql = "SELECT Name FROM tuser where User_id in(SELECT friend_id from tfriends where user_id=(SELECT User_id from tuser where Name='". $GLOBALS['NAME'] ."'))";
				$result = $con->query($sql);

				if ($result->num_rows > 0) {
				    
				    while($row = $result->fetch_assoc()) {

				        
				        echo '<li ><a href="facebooks.php?id='.$row["Name"].'"  data-toggle="tooltip" >'. $row["Name"].'</a></li>';
				    }
				    }
				?>


			</ul>
			</div>
			<!--/.nav-collapse -->
		  </div>
		</div>
	  </div>
	  <div class="col-sm-9">
	  				<div class="form-group">
			  		<form name="myForm"  >
						  <label for="comment">Whats in your mind?</label>
						  <textarea class="form-control" rows="5" name="comment">
						  </textarea>
						  <button type="button" class="btn"  name="submit" onclick="post1('<?php echo $GLOBALS['NAME']  ?>')">Post</button>
					</form>
					</div> 
				<div id="txtHint"> 
		  			<?php
			
					$sql = "SELECT posting_date, post FROM tWall WHERE user_id=(SELECT User_id from tuser WHERE Name='". $GLOBALS['NAME'] ."')ORDER BY posting_date DESC";
					$result = $con->query($sql);

					if ($result->num_rows > 0) {
					    
					    while($row = $result->fetch_assoc()) {
					        
					        echo '	
									  <div class="panel panel-default">
									    <div class="panel-heading"><h4>'. $row["post"].'</h4></div>
									    <div class="panel-body"><h6>'. $row["posting_date"].'</h6></div>
									  </div>
									';
					    }
					    }
			?>
			</div>
	  </div>
	</div>
	<!--/footer -->
	<footer class="container-fluid text-center">
	  <div class="add"></div>
	  <!-- Footer1-->
		<div class="mypage-footer">
		<?php
		$sql = "SELECT Address, Phone, Email_id from tuser WHERE Name='". $GLOBALS['NAME'] ."'";
					$result = $con->query($sql);

					if ($result->num_rows > 0) {
					    
					    while($row = $result->fetch_assoc()) {
					        
					        echo '<center>	
					        	<h3>My Details</h3><br>
					        	Address: '. $row["Address"].'<br>
								Mobile No.: '. $row["Phone"].'<br>
								Email: '. $row["Email_id"].'</td>
								</center>
									';
					    }
					    }
			?>
			
		</div>
		
	</footer>
	
	
 
 </div>
 </body>
 </html>