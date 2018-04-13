<?php
  session_start();
  if(!isset($_SESSION['userType'])){
    header("location:index.php");
  }
?>
<html>
<head>
<link rel="stylesheet" href="homepage.css">
<link rel="stylesheet" href="entermarks.css">
</head>
<body>

<?php
  include("config.php");
  session_start();
  $conn = new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
  if ($conn->connect_error) 
  {
    die("Connection failed: " . $conn->connect_error);
  } 
  if($_SERVER["REQUEST_METHOD"] == "POST")
  {
    // grab from user input
    $evaluationType = ($_POST['evaluation']);
    $studentGrade = mysqli_real_escape_string($conn,$_POST['studentGrade']);
    $studentId = mysqli_real_escape_string($conn,$_POST['studentId']);
    //check evaluation type (ie: midterm, quiz1, etc.)
    $sql = "update ".$evaluationType." set grade = '".$studentGrade."' WHERE studentId = '".$studentId."'";

    mysqli_query($conn,$sql);
    //end of mark input for student

  }
?>
<div id ="top">
  <!--UTSC logo taken from www.utsc.utoronto.ca-->
  <img id ="logo" src="http://www.utsc.utoronto.ca/~sdamouras/pics/UTSC%20logo.png" alt=" UTSC Logo">
  <h1 id="title"> Welcome to CSCB20 - Intro. to Databases and Web Applications </h1>
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


    <li><a href="otherresourcespage.php"> Other Resources </a></li>
    <?php
      if($_SESSION['userType'] == 'Student')
      {
        echo "<li><a href=\"viewmarks.php\"> View Marks </a></li>";
        echo "<li><a href=\"feedbackpage.php\"> Give Feedback </a></li>";
      }
      elseif($_SESSION['userType'] == 'Instructor')
      {
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
  <div class=description>
  <h3> Enter Marks </h3>
  Enter your marks for the respective student(s) here. Type in a valid student number, then select respective assessment from dropdown menu, and input grade /100 (Allows up to 50 bonus marks) . </br></br>

  <?php
  //ask for student number and grade, drop down menu for assignment, checks database to see if number exists and then update their grade
  echo "<form action=\"\" method = \"post\">
Student Number: <input class=\"spin_off\" type=\"number\" name=\"studentId\" required min=\"100000000\" max=\"9999999999\"></br></br>
Grade: <input class=\"spin_off\" type=\"number\" name=\"studentGrade\" min=\"0\" max=\"150\" required/></br></br>
Evaluation: <select name=\"evaluation\">
<option value=\"a1\">Assignment 1</option> 
<option value=\"a2\">Assignment 2</option> 
<option value=\"a3\">Assignment 3</option>
<option value=\"quiz1\">Quiz 1</option>
<option value=\"quiz2\">Quiz 2</option>
<option value=\"quiz3\">Quiz 3</option>
<option value=\"midterm\">Midterm</option>
<option value=\"final\">Final</option>
</select></br></br>
Submit Grade: <input type=\"submit\"</br></form>"
  
  ?>
</div>
  </br></br></br></br></br></br></br></br></br></br></br></br>
<footer>
  <span> <a id="faculty" href="http://www.utsc.utoronto.ca/cms/faculty-of-computer-science"> UTSC Computer Science Faculty</a> </span>
  <span id="creators"> Created By: Hongbo Zhang and Kevin Liu </span>
</footer>
<?php mysqli_close($conn);?>
</body>
</html>
