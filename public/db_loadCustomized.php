<link rel="stylesheet" href="output.css" />
<?php

echo "<a href='index.php'>";
echo "<button class='block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 m-4 rounded'>Home</button></a>";

require_once 'db_connect.php';

$search = $_REQUEST['search'];
$order = $_REQUEST['order'];
$startdate = $_REQUEST['startdate'];
$enddate = $_REQUEST['enddate'];

$cmd = "SELECT * FROM Tasks_Test where ";

if($search == 'Incomplete'){
    $cmd .= 'completed = 0 ';
} else if($search == 'Complete'){
    $cmd .= 'completed = 1 ';
} else{
    $cmd .= 'archived = 1 ';
}

if(($startdate == '' || $startdate == null) && ($enddate == '' || $enddate == null)){
    $cmd .= '';
}else if($startdate == '' || $startdate == null){
    $cmd .= "and taskDate <= $enddate";
}else if($enddate == '' || $enddate == null){
    $cmd .= "and taskDate >= $startdate";
}else{
    $cmd .= "and taskDate >= $startdate and taskDate <= $enddate ";
}

if($order == 'Priority'){
    $cmd .= 'order by priority';
} else if($order == 'taskDate'){
    $cmd .= 'order by taskDate';
}


$result = mysqli_query($link,$cmd) or die(mysqli_error($link));

while($row = mysqli_fetch_array($result)){
    if($row['category'] == 0){
        $cat = "Study";
    } elseif($row['category'] == 0){
        $cat = "Work";
    } else{
        $cat = "Other";
    }
    echo "<div class='bg-indigo-200 rounded m-4 p-5'>";
    echo "<h5>" .$row["priority"]. "</h5>";
    echo "<strong>" .$cat ,"</strong><h5 class='font-sans text-base'>" . $row['task'] ."</h5> <p class='font-sans text-sm'>" .$row['details'] ."</p>";
    echo "<p class='font-sans text-sm'>" .$row['taskDate'] ."</p>";
    echo "</div>";
}


?>