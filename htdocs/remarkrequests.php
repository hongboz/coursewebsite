<?php
  session_start();
  if(!isset($_SESSION['userType'])){
      header("location:index.php");
   }
?>
<html>
<head>
<link rel="stylesheet" href="homepage.css">
<link rel="stylesheet" href="remarkrequests.css">
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
      

      $requestArray = array();
      $request="";
      $sql = "SELECT * FROM remarkrequests";
      $result = mysqli_query($db,$sql);
      while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
      {
        array_push($requestArray, $row);
      }

      //display all remark requests
      for ($x=0; $x < sizeof($requestArray); $x++)
      {
        $toString = implode(', ', $requestArray[$x]);
        $request .= "$toString</br></br>";
      }

      if($_SERVER["REQUEST_METHOD"] == "POST"){
        $reason = mysqli_real_escape_string($db,htmlspecialchars($_POST['reason']));
        $assessment = mysqli_real_escape_string($db,$_POST['radio']);
        $firstName = mysqli_real_escape_string($db,$_SESSION['firstName']);
        $lastName= mysqli_real_escape_string($db,$_SESSION['lastName']);
        $sql1 = "insert into remarkrequests values(".$_SESSION['studentId'].",'$firstName','$lastName','$assessment','$reason');";
        mysqli_query($db,$sql1);

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
  </br></br>
  <!-- body of remarkrequests -->
  <h2>Remark Requests</h2>
    <h3>[Student ID, First Name, Last Name, Assessment, Reason]</h3>
    <?php

      echo "<p> $request </p>"


    ?>



  </br></br></br>
<footer>
  <span> <a id="faculty" href="http://www.utsc.utoronto.ca/cms/faculty-of-computer-science"> UTSC Computer Science Faculty</a> </span>
  <span id="creators"> Created By: Hongbo Zhang and Kevin Liu </span>
</footer>
</body>
</html>