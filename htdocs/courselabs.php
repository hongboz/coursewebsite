 
<?php
  session_start();
  if(!isset($_SESSION['userType'])){
      header("location:index.php");
   }
?>
<html>
<head>
<title>A2 Course Labs Page</title>

<link rel="stylesheet" type="text/css" href="courselabs.css">
<link rel="stylesheet" type="text/css" href="homepage.css">
<style>

</style>	
</head>
<body>
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
  <li><a href="otherresourcespage.php"> Other Resources </a></li>
   <?php
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
<div id ="menu">
<h2>Course Labs</h2>
<div class=horizontal-line></div>
<p id=text class=para>You can find all course labs here, corresponding to the week number.</p>

<div class="dropmenu">
	<button class="dropdown1">Select week here</button>
	<div class="labs">
		<a href="#">Week 1</a>
		<a href="#">Week 2</a>
		<a href="#">Week 3</a>
		<a href="#">Week 4</a>
		<a href="#">Week 5</a>
	</div>
</div>
</br></br></br></br></br></br></br>
<div class=horizontal-line></div>
</br></br></br></br></br></br></br></br></br></br></br></br></br></br>
</div>
</div>

<footer>
  <span> <a id="faculty" href="http://www.utsc.utoronto.ca/cms/faculty-of-computer-science"> UTSC Computer Science Faculty</a> </span>
  <span id="creators"> Created By: Hongbo Zhang and Kevin Liu </span>
</footer>

</body>
</html>