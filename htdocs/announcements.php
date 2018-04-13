<?php
  session_start();
  if(!isset($_SESSION['userType'])){
      header("location:index.php");
   }
?>
<html>
<head>
<link rel="stylesheet" href="announcements.css">
<link rel="stylesheet" href="homepage.css">
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

<center><h2>Announcements</h2></center>

<div id="allnews"> 
  <h4>Mar 9. 2018:</h4>
  <p class="announce"> Hey class, i just wanted to remind you that Assignment 3
  will be out on blackboard by Mar. 11th. Get a head start on it as this one is quite tricky! <p>
  <h4>Mar 1. 2018:</h4>
  <p class="announce"> Hey class, The last TA has just finished marking your
  midterms and we will be updating the your grades on blackboard by the end of
  today. Overall, i'm quite impressed with the results as the average was 82%.
  Keep up the great work!<p>
  <h4>Feb 21. 2018:</h4>
  <p class="announce"> Hello everyone,
As you plow on assignment1, here are some things to keep in mind as also discussed earlier in lecture: 
1. You cannot use 3rd party CSS framework. </br>
2. You cannot use 3rd party JavaScript framework such as  JQuery etc.</br>
--However, you can use your own JavaScript functions written by you and which does not reference any 3rd party JavaScript frameworks. </br>
3. The due date for assignment2 is 12th March @ 11:59 pm. </br>

4. You can use the content (such as pdf, instructor name, TA name, etc. etc.) from either Anna's website or our current website. </br>

5. Each user story can be 2-3 sentences. Concentrate on how the user will interact with your website. Also to think about here is the kinds of user (instructor or admin or student). Your user stories and mock diagram must be well considered and thorough. In your mock diagram, please do not use a screenshot of the actual web page. This is incorrect. The mock diagram happens first. At this point, you have a rough idea of how the webpage should work and how the user will interact with it. </br>

--At no point in the mocks should we see elements that reflect the actual webpage. Again use the wireframe mockup (referenced in the handout) to draw these out.  
--However, when you implement (when you start using HTML and CSS) these user stories on your web page, it is OK if you just concentrate from the student point of view. </br>

6. Here are some example of user stories, that I encourage you to read and get familiar with:
https://www.mountaingoatsoftware.com/agile/user-stories</br>

7. Make sure to test and run your webpage on Google Chrome. If your webpage depends on some images and other resources, make sure to have them placed appropriately in the directory that you submit to us. Please see the assignment handout for this. </br>

8. I hope you can take advantage of all the office hours this week towards your assignment2 and for prep towards quiz2. </br>

thanks,
abbas<p>
</div>
</div>

<footer>
  <span> <a id="faculty" href="http://www.utsc.utoronto.ca/cms/faculty-of-computer-science"> UTSC Computer Science Faculty</a> </span>
  <span id="creators"> Created By: Hongbo Zhang and Kevin Liu </span>
</footer>

</body>
</html>