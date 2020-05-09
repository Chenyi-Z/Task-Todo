<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="task.css" />
    <link rel="stylesheet" href="output.css" />
    <title>To Do List</title>
</head>
<body>
    <div id="container" class="container">
        <h1 class="center">New Task</h1>      
        <form action="db_insert.php" method="post">
            <label for="cat">Category</label>
            <select name="cat" id="cat">
                <option value="0">Study</option>
                <option value="1">Work</option>
                <option value="2">Others</option>
            </select>
            <label for="task">Task</label>
            <textarea name="task" id="task"></textarea>
            <label for="description">Description</label>
            <textarea name="description" id="description"></textarea>
            <label for="priority">Priority</label>
            <select name="priority" id="priority">
                <option value="1">High</option>
                <option value="2">Mid</option>
                <option value="3">Low</option>
            </select>
            <label for="taskdate">Date</label> 
            <input class="border border-blue-500 " type="date" id="taskdate" name="taskdate" />
            <label for="complete">Task Completed</label> 
            <input type="checkbox" id="complete" name="complete" value="1"><br/>
            <button class="bg-transparent hover:bg-blue-500 text-blue-700 hover:text-white" type="create" >Create Task</button>
        </form>

        <form action="db_loadCustomized.php" method="get">
            <label for="search">Search</label>
            <select name="search" id="search">
                <option>Incomplete</option>
                <option>Complete</option>
                <option>Archive</option>
            </select>
            <label for="order">Order By</label>
            <select name="order" id="order">
                <option>Priority</option>
                <option>Task Date</option>
            </select>
            <label for="taskdate">Start Date</label> 
            <input class="border border-blue-500 " type="date" id="startdate" name="startdate" />
            <label for="taskdate">End Date</label> 
            <input class="border border-blue-500 " type="date" id="enddate" name="enddate" />
            <button class="bg-transparent hover:bg-blue-500 text-blue-700 hover:text-white" type="create" >Search</button>
        </form>

        <?php
        require_once 'db_connect.php';
        $cmd = "SELECT * FROM Tasks_Test where completed =0 ORDER BY priority";
        $result = mysqli_query($link,$cmd) or die(mysqli_error($link));
        print("<h2>Incomplete Tasks</h2>");

        while($row = mysqli_fetch_array($result)){
            if($row['category'] == 0){
                $cat = "Study";
            } elseif($row['category'] == 0){
                $cat = "Work";
            } else{
                $cat = "Other";
            }
            echo "<div class='task'>";
            echo "<a href='db_complete.php?id=" . $row['ID']. "'>";
            echo "<button class='taskComplete'>Complete</button></a>";
            echo "<h5>" .$row["priority"]. "</h5>";
            echo "<strong>" .$cat ,"</strong><h5>" . $row['task'] ."</h5> <p>" .$row['details'] ."</p>";
            echo "<h6>" .$row['taskDate'] ."</h6>";
            echo "</div>";
        }


        $cmd = "SELECT * FROM Tasks_Test where completed =1 and TaskDate <= ".date("Y-m-d");
        $result = mysqli_query($link,$cmd) or die(mysqli_error($link));
        print("<h2>Complete Tasks</h2>");

        while($row = mysqli_fetch_array($result)){
            if($row['category'] == 0){
                $cat = "Study";
            } elseif($row['category'] == 0){
                $cat = "Work";
            } else{
                $cat = "Other";
            }
            echo "<div class='task'>";
            echo "<a href='db_archive.php?id=" . $row['ID']. "'>";
            echo "<button class='taskComplete'>Archive</button></a>";
            echo "<h5>" .$row["priority"]. "</h5>";
            echo "<strong>" .$cat ,"</strong><h5>" . $row['task'] ."</h5> <p>" .$row['details'] ."</p>";
            echo "<h6>" .$row['taskDate'] ."</h6>";
            echo "</div>";
        }

        ?>

    </div>

</body>

</html>