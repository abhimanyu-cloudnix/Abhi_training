<!DOCTYPE html>
<html>
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



    
    
</head>
<body>

<?php


$name = $_GET['q'];
$post = $_GET['x'];
$date = date('Y-m-d H:i:s');




$con = mysqli_connect("localhost","root","root","Training");
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

$sql = "INSERT INTO tWall VALUES ((select user_id from tuser where Name='". $GLOBALS['name'] ."'), '". $GLOBALS['date'] ."', '". $GLOBALS['post'] ."');";
$result = $con->query($sql);

$sql = "SELECT posting_date, post FROM tWall WHERE user_id=(SELECT User_id from tuser WHERE Name='". $GLOBALS['name'] ."')ORDER BY posting_date DESC";
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
</body>
</html>