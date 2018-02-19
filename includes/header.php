<link rel="icon" type="image/x-icon" href="assets/image/favicon.png">

<?php
    include 'style.php';
    include 'script.php';
?>
<!-- NAVBAR WITH RESPONSIVE TOGGLE -->
 <nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand" href="index.php"><span class="glyphicon glyphicon-home"></span> &nbsp;<?php echo $schoolinfo->getSchoolInfo()->school_name;?></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Student <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="addstudent.php"><span class="glyphicon glyphicon-plus-sign"></span>&nbsp;&nbsp;Register Student</a></li>
            <li class="divider"></li>
            <li><a href="liststudent.php"><span class="glyphicon glyphicon-eye-open"></span>&nbsp;&nbsp;View Student</a></li>
            
          </ul>
        </li>

        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Subject <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="addsubject.php"><span class="glyphicon glyphicon-plus-sign"></span>&nbsp;&nbsp;Add Subject</a></li>
            <li class="divider"></li>
            <li><a href="listsubject.php"><span class="glyphicon glyphicon-eye-open"></span>&nbsp;&nbsp;View Subject List</a></li>
          </ul>
        </li>

        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Class <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="addclass.php"><span class="glyphicon glyphicon-plus-sign"></span>&nbsp;&nbsp;New Class</a></li>
            <li class="divider"></li>
            <li><a href="classlist.php"><span class="glyphicon glyphicon glyphicon-th-list"></span>&nbsp;&nbsp;List Class </a></li>
          </ul>
        </li>

         <li><a href="classselect.php"></span> Result</a></li>
        <li><a href="listresult.php"><span class="glyphicon glyphicon-book"></span>&nbsp;&nbsp;View Result</a></li>
        <li><a href="schoolinfo.php"><span class="glyphicon glyphicon-file"></span>&nbsp;&nbsp;School Info</a></li>
        
      </ul>
      <!--
      <form class="navbar-form navbar-left" action="action_page.php">
      <div class="form-group">
        <input type="text" class="form-control" placeholder="Search" name="search">
        <div class="form-group">
          <button class="btn btn-default" type="submit">
            <span class="glyphicon glyphicon-search"></span>
          </button>
        </div>
      </div>
    </form>-->
    </div>
  </div>
</nav>
