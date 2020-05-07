<?php
require_once 'db_connect.php';

$id = $_REQUEST['id'];

$cmd = "UPDATE Tasks_Test SET completed = 1 where ID = '" .$id ."'";

if(mysqli_query($link, $cmd)){
    print("Stored");
} else{
    print("Failed");
}

echo "<script>location.href='index.php'</script>";

?>