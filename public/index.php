<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="output.css" />
    <title>To Do List</title>
</head>
<body>
    <div class="container bg-gray-100 mx-24 px-20 pb-20">
    <div class="flex">

    <?php
        require_once 'db_connect.php';
        $cmd = "SELECT * FROM Tasks_Test where completed =0 ORDER BY priority, taskDate";
        $result = mysqli_query($link,$cmd) or die(mysqli_error($link));
        print("<div class='flex-1'>");
        print("<h2 class='font-sans text-xl text-gray-800 text-center pt-10 pb-4'>Incomplete Tasks</h2>");

        while($row = mysqli_fetch_array($result)){
            if($row['category'] == 0){
                $cat = "Study";
            } elseif($row['category'] == 0){
                $cat = "Work";
            } else{
                $cat = "Other";
            }
            echo "<div class='bg-teal-200 rounded m-4 p-5'>";
            echo "<a href='db_complete.php?id=" . $row['ID']. "'>";
            echo "<button class='float-right bg-teal-500 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded'>Complete</button></a>";
            echo "<h5>" .$row["priority"]. "</h5>";
            echo "<strong>" .$cat ,"</strong><h5 class='font-sans text-base'>" . $row['task'] ."</h5> <p class='font-sans text-sm'>" .$row['details'] ."</p>";
            echo "<p class='font-sans text-sm'>" .$row['taskDate'] ."</p>";
            echo "</div>";
        }
        print("</div>");


        //$cmd = "SELECT * FROM Tasks_Test where completed =1 and archived = 0 and TaskDate <= ".date("Y-m-d");
        $cmd = "SELECT * FROM Tasks_Test where completed =1 and archived = 0";
        $result = mysqli_query($link,$cmd) or die(mysqli_error($link));
        print("<div class='flex-1'>");
        print("<h2 class='font-sans text-xl text-gray-800 text-center pt-10 pb-4'>Complete Tasks</h2>");

        while($row = mysqli_fetch_array($result)){
            if($row['category'] == 0){
                $cat = "Study";
            } elseif($row['category'] == 0){
                $cat = "Work";
            } else{
                $cat = "Other";
            }
            echo "<div class='bg-indigo-200 rounded m-4 p-5'>";
            echo "<a href='db_archive.php?id=" . $row['ID']. "'>";
            echo "<button class='float-right bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded'>Archive</button></a>";
            echo "<h5>" .$row["priority"]. "</h5>";
            echo "<strong>" .$cat ,"</strong><h5 class='font-sans text-base'>" . $row['task'] ."</h5> <p class='font-sans text-sm'>" .$row['details'] ."</p>";
            echo "<p class='font-sans text-sm'>" .$row['taskDate'] ."</p>";
            echo "</div>";
        }
        print("</div>");

        ?>
        </div>

        <h1 class="font-sans text-xl text-gray-800 text-center pt-10 pb-4">New Task</h1>    
        <div class="flex flex-col rounded-lg bg-gray-300 mx-20 px-10" name="new_form">    
        <form action="db_insert.php" method="post">
            <div class="flex m-6">
                <div class="flex-1" name="category">
                <label class="font-sans text-base text-gray-800 p-4" for="cat">Category</label>
                <select name="cat" id="cat">
                    <option value="0">Study</option>
                    <option value="1">Work</option>
                    <option value="2">Others</option>
                </select>
                </div>
            
                <div class="flex-1">
                <label class="font-sans text-base text-gray-800 p-4" for="priority">Priority</label>
                <select name="priority" id="priority">
                    <option value="1">High</option>
                    <option value="2">Mid</option>
                    <option value="3">Low</option>
                </select>
                </div>
                <div class="flex-1">
                <label class="font-sans text-base text-gray-800 p-4" for="taskdate">Date</label> 
                <input class="border rounded border-blue-200 " type="date" id="taskdate" name="taskdate" />
                </div>          
            </div>
            
            <div class="flex m-6">
                <div class="flex-1">
                    <label class="font-sans text-base text-gray-800 p-4" for="task">Task</label>
                    <textarea class="border rounded border-blue-200 " name="task" id="task"></textarea>
                </div>
                <div class="flex-1">
                    <label class="font-sans text-base text-gray-800 p-4" for="description">Description</label>
                    <textarea class="border rounded border-blue-200 " name="description" id="description"></textarea>
                </div>
            </div>
            
            <div class="m-6">
                <label class="font-sans text-base text-gray-800 px-4" for="complete">Task Completed</label> 
                <input type="checkbox" id="complete" name="complete" value="1"><br/>
            </div>
            <div class="m-6">
                <button class="bg-blue-100 border-blue-200 rounded hover:bg-blue-500 hover:rounded text-blue-700 hover:text-white py-1 px-4" type="create" >Create Task</button>
            </div>
        </form>
        </div>  


        <h1 class="font-sans text-xl text-gray-800 text-center pt-10 pb-4">Search</h1>
        <div class="flex flex-col rounded-lg bg-gray-300 mx-20 px-10" name="search_form"> 
            <form action="db_loadCustomized.php" method="get">
                <div class="flex m-6">
                    <div class="flex-1"> 
                        <label class="font-sans text-base text-gray-800 p-4" for="search">Search</label>
                        <select name="search" id="search">
                            <option>Incomplete</option>
                            <option>Complete</option>
                            <option>Archive</option>
                        </select>
                    </div>
                    <div class="flex-1">
                        <label class="font-sans text-base text-gray-800 p-4" for="order">Order By</label>
                        <select name="order" id="order">
                            <option>Priority</option>
                            <option>Task Date</option>
                        </select>
                    </div>
                </div>
                <div class="flex m-6">
                    <div class="flex-1"> 
                        <label class="font-sans text-base text-gray-800 p-4" for="taskdate">Start Date</label> 
                        <input class="border rounded border-blue-200 " type="date" id="startdate" name="startdate" />
                    </div>
                    <div class="flex-1"> 
                        <label class="font-sans text-base text-gray-800 p-4" for="taskdate">End Date</label> 
                        <input class="border rounded border-blue-200 " type="date" id="enddate" name="enddate" />
                    </div>
                </div>
                <div class="m-6">
                    <button class="bg-blue-100 border-blue-200 rounded hover:bg-blue-500 hover:rounded text-blue-700 hover:text-white py-1 px-4" type="create" >Search</button>
                </div>                         
            </form>
        </div>
             

    </div>

</body>

</html>