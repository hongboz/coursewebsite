<?php
  session_start();
  if(!isset($_SESSION['userType'])){
      header("location:index.php");
   }
?>
<html>
<head>
<link rel="stylesheet" href="homepage.css">
<link rel="stylesheet" href="viewgrades.css">
</head>
<body>
  <?php
      include("config.php");
      session_start();
      // Create connection
      $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

      $mystudentId = mysqli_real_escape_string($db,$_SESSION['studentId']);
      
      // Checks connection
      if (!$db) {
          die('Connect Error (' . mysqli_connect_errno() . ') '
                  . mysqli_connect_error());
      }
      $studentIds = array();
      //populate studentIds array with all student Ids in the logininfo table
      $getstudents = "SELECT studentId FROM logininfo WHERE studentId > 0";
      $result = mysqli_query($db,$getstudents);
      $count = mysqli_num_rows($result);

      //loop through rows of studentId and add into array
      while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
      {
        array_push($studentIds, $row['studentId']);
      }
      //use array length to determine how many students we have, then generate the appropriate number of rows
      $numofstudents = sizeof($studentIds);
      $assessment = array("a1", "a2", "a3", "quiz1", "quiz2", "quiz3", "midterm", "final");
      
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

  <div class="description">
  <h3>Student Marks</h3>
  <div class="gradeheader"> Student &emsp;&emsp;&emsp; A1 &emsp;&emsp; A2 &emsp;&emsp; A3 &emsp;&emsp; Quiz 1 &emsp;&emsp; Quiz 2 &emsp;&emsp; Quiz 3 &emsp;&emsp; Midterm &emsp;&emsp; Final </div></br></br>
  <div class="column">

    <div class="grades"> 
      <?php

      for ($x=0; $x < $numofstudents; $x++)
      {
        $grade = array();
        foreach ($assessment as $value)
        {
              $sql1 = "SELECT grade FROM ".$value." WHERE studentId = ".$studentIds[$x]."";
              $result1 = mysqli_query($db,$sql1);
              $row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC);
              //if grade is null, replace with string 'NA'
              if($row1['grade'] == "")
              {
                array_push($grade, "na");
              }
              else{
                array_push($grade, $row1['grade']);
              }
              
        }
        //store grades into 
        //display a row of grades per iteration
        echo " ".$grade[0]." &emsp;&emsp;&nbsp;&nbsp; ".$grade[1]." &emsp;&emsp; ".$grade[2]." &emsp;&emsp;&nbsp;&nbsp;&nbsp; ".$grade[3]." &emsp;&emsp;&emsp;&emsp; ".$grade[4]." &emsp;&emsp;&nbsp;&nbsp;&emsp; ".$grade[5]." &emsp;&emsp;&nbsp;&nbsp;&emsp;&emsp; ".$grade[6]." &emsp;&emsp;&nbsp;&nbsp;&emsp; ".$grade[7]."  </br>";
      }
      
      ?>

    </div>
  <?php
      for ($x=0; $x < $numofstudents; $x++)
      {
        echo "$studentIds[$x]</br>";
      }
    ?>
</div>

</div>

</br></br></br></br></br></br>
</br></br></br></br></br></br>

<footer>
  <span> <a id="faculty" href="http://www.utsc.utoronto.ca/cms/faculty-of-computer-science"> UTSC Computer Science Faculty</a> </span>
  <span id="creators"> Created By: Hongbo Zhang and Kevin Liu </span>
</footer>
<?php
  mysqli_close($db); 
?>
</body>
</html>