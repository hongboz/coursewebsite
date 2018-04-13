<?php
   include("config.php");
   session_start();

   //initial check on instructor and TA accounts and sets their student IDs to NULL
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
   $sql2 = "update logininfo set studentId = null where usertype = 'instructor' or usertype = 'TA'";
      $result2 = mysqli_query($db,$sql2);

   //check for correct login information   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']);
      
      $sql = "SELECT * FROM logininfo WHERE username = '$myusername' and password = '$mypassword'";
      $result = mysqli_query($db,$sql);
      

      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
      
      if($count == 1) 
      {
         $_SESSION['username'] = $myusername;
         $_SESSION['password'] = $mypassword;
         $_SESSION['email'] = $row['email'];
         $_SESSION['firstName'] = $row['firstName'];
         $_SESSION['lastName'] = $row['lastName'];
         $_SESSION['studentId'] = $row['studentId'];

         //redirect to login success if successful, then check for user type (student/TA/Instr.)
         if($row['userType']=='Student')
         {
            $_SESSION['userType']='Student';
         }
         elseif($row['userType']=='Instructor')
         {
            $_SESSION['userType']='Instructor';

         }
         else
         {
            $_SESSION['userType']='TA';
            
         }
         header('Location: homepage.php');
      }
      else 
      {
         $error = "Sorry, your Login Name or Password is incorrect.";
      }
   }
?>
<html>
<head>
<link rel="stylesheet" href="index.css">
</head>
<body>
<h2>CSCB20 Website Login</h2>

<div class="outline">
<form action="" method="post">
  <div class="imgcontainer">
    <img src="https://upload.wikimedia.org/wikipedia/en/thumb/0/04/Utoronto_coa.svg/1200px-Utoronto_coa.svg.png" alt="Avatar" class="avatar">
  </div>

  <div class="container">
    <label for="username"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="username" required>

    <label for="passord"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>
        
    <button type="submit">Login</button>
 </form>


 <form action="signup.php">
    <button type="submit">Sign Up!</button>
 </form>
 <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
  </div>
</div>
</form>
<?php mysqli_close($db);
?>
</body>
</html>