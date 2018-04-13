<?php
  session_start();
  if(!isset($_SESSION['userType'])){
      header("location:index.php");
   }
?>
<html>
<head>
<link rel="stylesheet" href="feedbackpage.css">
<link rel="stylesheet" href="homepage.css">
</head>
<body>
<?php
      include("config.php");
      session_start();
      // Create connection
      $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
      
      // Checks connection
      if (!$db) {
          die('Connect Error (' . mysqli_connect_errno() . ') '
                  . mysqli_connect_error());
      }
      

      $instructors = array();
      $sql = "SELECT firstName, lastName FROM logininfo WHERE userType = 'Instructor';";
      $result = mysqli_query($db,$sql);
      while ($row = mysqli_fetch_assoc($result)) {
          $instructors[] = $row;
      }

      if($_SERVER["REQUEST_METHOD"] == "POST") {
        $answer1 = mysqli_real_escape_string($db,$_POST['a']);
        $answer2 = mysqli_real_escape_string($db,$_POST['b']);
        $answer3 = mysqli_real_escape_string($db,$_POST['c']);
        $answer4 = mysqli_real_escape_string($db,$_POST['d']);
        $answer5 = mysqli_real_escape_string($db,$_POST['e']);
        $instructor = $_POST['instructors'];
        $sql1 = "insert into feedback values('a', '$answer1', '$instructor')";
        $sql2 = "insert into feedback values('b', '$answer2', '$instructor')";
        $sql3 = "insert into feedback values('c', '$answer3', '$instructor')";
        $sql4 = "insert into feedback values('d', '$answer4', '$instructor')";
        $sql5 = "insert into feedback values('e', '$answer5', '$instructor')";
        mysqli_query($db,$sql1);
        mysqli_query($db,$sql2);
        mysqli_query($db,$sql3);
        mysqli_query($db,$sql4);
        mysqli_query($db,$sql5);
        
    }
  ?>
<div id ="top">
  <img id ="logo" src="http://www.utsc.utoronto.ca/~sdamouras/pics/UTSC%20logo.png" alt=" UTSC Logo">
  <h1 id="title"> CSCB20 - Intro. to Databases and Web Applications </h1>
  <i><div id="quote">"What separates design from art is that design is meant to be... functional." - Cameron Moll</div></i>
</div>
<div id="content">
<ul id="navigationbar">
  <li><a href="homepage.php"> Home </a></li>
  <div class="dropdown">
  <li><a class="coursematerial" href="coursematerialspage.php"> Course Materials </a></li>
      <div class="dropdown-content">
        <a href="syllabus.php">Syllabus</a>
        <a href="lectureslides.php">Weekly Lecture Slides</a>
        <a href="assignments.php">Assignments</a>
        <a href="courselabs.php">Labs</a>
        <a href="practicequizzes.php">Practice Quizzes</a>
        <a href="schedule.php">Schedule</a>

      </div>
  </div>
  <li><a href="announcements.php"> Announcements </a></li>
 
  <li><a href="courseteam.php"> Course Team </a></li>
  <div class="dropdown">
    <li><a class="coursematerial" href="usefullinks.php"> Useful Links </a></li>
      <div class="dropdown-content">
        <a href="https://piazza.com/class/jcpjjp5l4bywd"> Piazza </a>
        <a href="https://portal.utoronto.ca/webapps/portal/execute/tabs/tabAction?tab_tab_group_id=_12_1">Portal</a>
        <a href="https://markus.utsc.utoronto.ca/cscb20w18/?locale=en"> MarkUs </a>
        <a href="http://www.utsc.utoronto.ca/labs/"> UTSC Labs </a>
      </div>
    </div>
  <li><a href="otherresourcespage.php"> Other Resources </a></li> <?php
      if($_SESSION['userType'] == 'Student'){
        echo "<li><a href=\"viewmarks.php\"> View Marks </a></li>";
        echo "<li><a href=\"feedbackpage.php\"> Give Feedback </a></li>";
    }
      elseif($_SESSION['userType'] == 'Instructor'){
        echo "<li><a href=\"entermarks.php\"> Enter Marks </a></li>";
        echo "<li><a href=\"viewfeedback.php\"> View Feedback </a></li>";
        echo "<li><a href=\"viewgrades.php\"> View Grades </a></li>";
        echo "<li><a href=\"remarkrequests.php\"> Remark Requests </a></li>";
    }
      else
      {
        echo "<li><a href=\"entermarks.php\"> Enter Marks </a></li>";
        echo "<li><a href=\"remarkrequests.php\"> Remark Requests </a></li>";
      }
    ?>
    <li><a href="logout.php"> Log Out </a></li>
</ul>
<div id="input">
  <h3> Give Anonymous Feedback </h3>
  <form action ="" method = "post">
  <h4>What do you like about the instructor teaching?</h4>
  <textarea name="a" cols="45" rows="15"></textarea>
  </br>
  <h4>What do you recommend the instructor to do to improve their teaching?</h4>
  <textarea name="b" cols="45" rows="15"></textarea>
  </br>
  <h4>What do you like about the labs?</h4>
  <textarea name="c" cols="45" rows="15"></textarea>
  </br>
  <h4>What do you recommend the lab instructors to do to improve their lab teaching?</h4>
  <textarea name="d" cols="45" rows="15"></textarea>
  </br>
  <h4>Other comments/feedback: </h4>
  <textarea name="e" cols="45" rows="15"></textarea>
  </br></br></br>
  <?php
  echo "<select name=\"instructors\">";
    for($i = 0; $i < count($instructors); $i++){
      echo "<option value =\"".$instructors[$i]['firstName']." ".$instructors[$i]['lastName']."\">".$instructors[$i]['firstName']." ".$instructors[$i]['lastName']."</option>";
    }
  echo"</select>
  <button> Submit </button>
  </form>";
  ?>
</div>
</div>

</br></br></br></br></br></br></br></br></br>
<footer>
  <span> <a id="faculty" href="http://www.utsc.utoronto.ca/cms/faculty-of-computer-science"> UTSC Computer Science Faculty</a> </span>
  <span id="creators"> Created By: Hongbo Zhang and Kevin Liu </span>
</footer>
<?php mysqli_close($db); ?>
</body>
</html>