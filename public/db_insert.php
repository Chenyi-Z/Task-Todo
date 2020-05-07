<?php
require_once 'db_connect.php';

$category = $_REQUEST['cat'];
$task = $_REQUEST['task'];
$details = $_REQUEST['description'];
$priority = $_REQUEST['priority'];
$date = $_REQUEST['taskdate'];
$complete = $_REQUEST['complete'];

if($complete == '' || $complete == null){
    $complete = 0;
}

$cmd = "INSERT INTO Tasks_Test (userID, task, category, details, priority, completed, taskDate) ";
$cmd .= "VALUES (1, ";
$cmd .= "'" . $task . "', ";
$cmd .= "'" . $category . "', ";
$cmd .= "'" . $details . "', ";
$cmd .= "'" . $priority . "', ";
$cmd .= "'" . $complete . "', ";
$cmd .= "'" . $date . "'); ";


if(mysqli_query($link, $cmd)){
    print("Stored");
} else{
    print("Failed");
}

echo "<script>location.href='index.php'</script>";

?>
