<?php
    include("config.php");
    session_start();
    $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $myusername = mysqli_real_escape_string($db,$_POST['username']);
        $mypassword = mysqli_real_escape_string($db,$_POST['password']);
        $myEmail = mysqli_real_escape_string($db,$_POST['email']);
        $myStudentId = mysqli_real_escape_string($db,$_POST['studentId']);
        $myFirstName = mysqli_real_escape_string($db,$_POST['firstName']);
        $myLastName = mysqli_real_escape_string($db,$_POST['lastName']);
        $myType = mysqli_real_escape_string($db,$_POST['radio']);

        $check= "SELECT COUNT(*) FROM logininfo WHERE email = '$myEmail'";
        $res = mysqli_query($db,$check);
        $data = mysqli_fetch_array($res, MYSQLI_NUM);

        $check1= "SELECT COUNT(*) FROM logininfo WHERE username = '$myusername'";
        $res1 = mysqli_query($db,$check1);
        $data1 = mysqli_fetch_array($res1, MYSQLI_NUM);

        $check2= "SELECT COUNT(*) FROM logininfo WHERE studentId = '$myStudentId'";
        $res2 = mysqli_query($db,$check2);
        $data2 = mysqli_fetch_array($res2, MYSQLI_NUM);

        if($data[0] >= 1) {
            echo "Email already in use, please enter a new one.<br/>";
        } 
        elseif($data1[0] >= 1) {
            echo "Username already in use, please choose a new one.<br/>";
        }
        elseif($data2[0] >= 1){
            echo "StudentID already in use, please choose a new one.<br/>";
        }
        else{

            $sql = "insert into logininfo values('$myusername','$mypassword', '$myEmail',
            '$myStudentId', '$myFirstName', '$myLastName', '$myType');";
            
            $result = mysqli_query($db,$sql);

        

        //insert default starting grades for all assessments only for students
        if($myType == 'Student')
        {
            $examGrade = "insert into final values('$myStudentId','$myFirstName','$myLastName', null)";
            mysqli_query($db,$examGrade);
            $a1Grade = "insert into a1 values('$myStudentId','$myFirstName','$myLastName', null)";
            mysqli_query($db,$a1Grade);
            $a2Grade = "insert into a2 values('$myStudentId','$myFirstName','$myLastName', null)";
            mysqli_query($db,$a2Grade);
            $a3Grade = "insert into a3 values('$myStudentId','$myFirstName','$myLastName', null)";
            mysqli_query($db,$a3Grade);
            $q1Grade = "insert into quiz1 values('$myStudentId','$myFirstName','$myLastName', null)";
            mysqli_query($db,$q1Grade);
            $q2Grade = "insert into quiz2 values('$myStudentId','$myFirstName','$myLastName', null)";
             mysqli_query($db,$q2Grade);
            $q3Grade = "insert into quiz3 values('$myStudentId','$myFirstName','$myLastName', null)";
            mysqli_query($db,$q3Grade);
            $mtGrade = "insert into midterm values('$myStudentId','$myFirstName','$myLastName', null)";
            mysqli_query($db,$mtGrade);
        }
        header("location: index.php"); //redirects user back to the login page (also simultaneously sets any TA / Instructor studentId to NULL (from index.php))
    }
}
?>
<html>
    <head>
        <link rel="stylesheet" href="signup.css">
    </head>
    <body>
        <form action = "" method = "post">
            <div class="container">
                <h2>Sign Up Form</h2>
            <label><b>Username:</b></label><input type = "text" name = "username" placeholder="Enter Username" required/><br />
            <label><b>Password:</b></label><input type = "password" placeholder="Enter Password" name = "password" required>
            <h3> Select User Type </h3> 

            <!-- RADIO BUTTONS -->
            <div class="borderline">
            <label>Student</label><input type="radio" name="radio" value="Student" required> </br>
            <label>T.A.</label><input type="radio" name="radio" value="TA"> </br>
            <label>Instructor</label><input type="radio" name="radio"  value="Instructor"> 
        </div>
        </br></br>

            <!--~~~~~~~~~~~~~~~-->

            <label>First Name:</label><input type = "text" name = "firstName" placeholder="Enter First Name" required /><br/>
            <label>Last Name:</label><input type = "text" name = "lastName" placeholder="Enter Last Name" required /></br>
            <label>Email:</label><input type = "email" name = "email" placeholder="Enter Email" required /><br/></br>

            <label>Student ID:</label><input type = "number"  name = "studentId" placeholder="Required If Student" class="spin_off"/><br/>


            <div class="clear">
                <button type="submit" class="signup" value=" Submit ">Sign Up!</button>
            </div>
        </div>
        </form>

        <?php $db->close();?>

    </body>
</html>