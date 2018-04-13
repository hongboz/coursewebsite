<?php
  session_start();
  if(!isset($_SESSION['userType'])){
      header("location:index.php");
   }
?>
<html>
<head>
<link rel="stylesheet" href="homepage.css">
<link rel="stylesheet" href="viewfeedback.css">
</head>
<body>
<?php
  include("config.php");
  session_start();
  // create connection
  $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

  //check connection
  if (!$db) {
    die('Connect Error (' .mysqli_connect_errno() . ') ' . mysqli_connect_error());
  }
  $instructorName = mysqli_real_escape_string($db,$_SESSION['firstName'] . ' ' . $_SESSION['lastName']);
  /*steps: 
  1. make 1 array for each question/answer pair, will store 1 answer per element (varchar)
  2. query for each array, with format being: select answer from feedback where question = 'letter' and instructor = 'full name' 
  3. make a button for each question (a, b, ... e)
  4. depending on button clicked, will show pop up window of all feedback for that question for that prof. EG: if clicked on Question A) loop through array A and display answers one by one separated by a line break in the loop*/
  $a=$b=$c=$d=$e= array();
  $sqla = "SELECT answer FROM feedback WHERE instructor = '$instructorName' and question='a'";
  $sqlb = "SELECT answer FROM feedback WHERE instructor = '$instructorName' and question='b'";
  $sqlc = "SELECT answer FROM feedback WHERE instructor = '$instructorName' and question='c'";
  $sqld = "SELECT answer FROM feedback WHERE instructor = '$instructorName' and question='d'";
  $sqle = "SELECT answer FROM feedback WHERE instructor = '$instructorName' and question='e'";
  $resulta=mysqli_query($db,$sqla);
  $resultb=mysqli_query($db,$sqlb);
  $resultc=mysqli_query($db,$sqlc);
  $resultd=mysqli_query($db,$sqld);
  $resulte=mysqli_query($db,$sqle);

  while($row = mysqli_fetch_assoc($resulta))
  {
      array_push($a,$row['answer']);
  }
  while($row = mysqli_fetch_assoc($resultb))
  {
      array_push($b,$row['answer']);
  }
  while($row = mysqli_fetch_assoc($resultc))
  {
      array_push($c,$row['answer']);
  }
  while($row = mysqli_fetch_assoc($resultd))
  {
      array_push($d,$row['answer']);
  }
  while($row = mysqli_fetch_assoc($resulte))
  {
      array_push($e,$row['answer']);
  }


?>


<?php
  $stringa='';
  $stringb='';
  $stringc='';
  $stringd='';
  $stringe='';
  for($x=0; $x < sizeOf($a); $x++)
    {
        $stringa .= "$a[$x]</br>--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</br>";
    }
  
  for($x=0; $x < sizeOf($b); $x++)
    {
        $stringb .= "$b[$x]</br>--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</br>";
    }
  
  for($x=0; $x < sizeOf($c); $x++)
    {
        $stringc .= "$c[$x]</br>--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</br>";
    }

  for($x=0; $x < sizeOf($d); $x++)
    {
        $stringd .= "$d[$x]</br>--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</br>";
    }
  

  for($x=0; $x < sizeOf($e); $x++)
    {
        $stringe .= "$e[$x]</br>--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</br>";
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

  <!--body of viewfeedback-->
<h3>Question: What do you like about the instructor teaching?</h3>
</br>
<button id="myBtnA" name="myBtnA" value="myBtnA">See Feedback</button>
</br>
<h3>Question: What do you recommend the instructor to do to improve their teaching?</h3>
</br>
<button id="myBtnB" name="myBtnB">See Feedback</button></br>
<h3>Question: What do you like about the labs?</h3></br>
<button id="myBtnC" name="myBtnC">See Feedback</button></br>
<h3>Question: What do you recommend the lab instructors to do to improve their lab teaching?</h3></br>
<button id="myBtnD" name="myBtnD">See Feedback</button></br>
<h3>Other Comments Here</h3></br>
<button id="myBtnE" name="myBtnE">See Feedback</button>



<!--output respective question depending on button clicked-->
<div id="myModal" class="modal">

  <div class="modal-content">
    <span class="close">&times;</span>
    <p>
      <?php echo $stringa; ?>

    </p>
  </div>

</div>

<div id="myModal2" class="modal2">

  <div class="modal-content2">
    <span class="close">&times;</span>
    <p>
      <?php echo $stringb; ?>

    </p>
  </div>

</div>

<div id="myModal3" class="modal3">

  <div class="modal-content3">
    <span class="close">&times;</span>
    <p>
      <?php echo $stringc; ?>

    </p>
  </div>

</div>

<div id="myModal4" class="modal4">

  <div class="modal-content4">
    <span class="close">&times;</span>
    <p>
      <?php echo $stringd; ?>

    </p>
  </div>

</div>

<div id="myModal5" class="modal5">

  <div class="modal-content5">
    <span class="close">&times;</span>
    <p>
      <?php echo $stringe; ?>

    </p>
  </div>

</div>

<script>
var modal = document.getElementById('myModal');
var modal2 = document.getElementById('myModal2');
var modal3 = document.getElementById('myModal3');
var modal4 = document.getElementById('myModal4');
var modal5 = document.getElementById('myModal5');

var btn = document.getElementById("myBtnA");
var btn2 = document.getElementById("myBtnB");
var btn3 = document.getElementById("myBtnC"); 
var btn4 = document.getElementById("myBtnD");
var btn5 = document.getElementById("myBtnE");

var span = document.getElementsByClassName("close")[0];
var span2 = document.getElementsByClassName("close")[1];
var span3 = document.getElementsByClassName("close")[2];
var span4 = document.getElementsByClassName("close")[3];
var span5 = document.getElementsByClassName("close")[4];

// When the user clicks the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
}
btn2.onclick = function() {
    modal2.style.display = "block";
}
btn3.onclick = function() {
    modal3.style.display = "block";
}
btn4.onclick = function() {
    modal4.style.display = "block";
}
btn5.onclick = function() {
    modal5.style.display = "block";
}

//close window when X is pressed
span.onclick = function() {
  modal.style.display = "none";
}
span2.onclick = function() {
  modal2.style.display = "none";
}
span3.onclick = function() {
  modal3.style.display = "none";
}
span4.onclick = function() {
  modal4.style.display = "none";
}
span5.onclick = function() {
  modal5.style.display = "none";
}

//closes window when anywhere outside is clicked
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
    if (event.target == modal2)
    {
      modal2.style.display = "none";
    }
    if (event.target == modal3)
    {
      modal3.style.display = "none";
    }
    if (event.target == modal4)
    {
      modal4.style.display = "none";
    }
    if (event.target == modal5)
    {
      modal5.style.display = "none";
    }
}
</script>
<!--~~~~~~~~~~~~~~~~~~-->
  </br></br></br>
  <footer>
  <span> <a id="faculty" href="http://www.utsc.utoronto.ca/cms/faculty-of-computer-science"> UTSC Computer Science Faculty</a> </span>
  <span id="creators"> Created By: Hongbo Zhang and Kevin Liu </span>
</footer>
</body>
</html>