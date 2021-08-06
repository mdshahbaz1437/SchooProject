<?php
include("function1.php");
session_start();
$logid=$_SESSION["aid"];
if(!isset($_SESSION["aid"]))
{
	header("location:admin.php");
}
$con = new connectioninfo();
$status="";

if(isset($_POST["btn1"]))
{
	extract($_POST);
	$path="";
	if($_FILES["timage"]["error"]==0)
	{
		$path="about/".$_FILES["timage"]["name"];
		move_uploaded_file($_FILES["timage"]["tmp_name"],$path);
	}
	$qry1="insert into about (abname,abdetail,abimage) values ('$tname','$tdetail','$path')";
	$rs=$con->executequery($qry1);
	if(!$rs)
	{
		$status="Record Insert";
	}
	else
	{
		$status="Record Not Insert";
	}
}



?>

<!DOCTYPE html>
<html lang="en">
  <head>
    
    <title>Vali Admin - Free Bootstrap 4 Admin Template</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script type="text/javascript">
	function validation()
	{
		var Name=document.getElementById("tname").value;
		var Image=document.getElementById("timage").value;
		var Detail=document.getElementById("tdetail").value;
		
		//regression expression
		
		var reg_name=/^(([a-zA-Z ]{3,}))$/;
		var reg_detail=/^(([a-zA-Z0-9!@#$%^&*()+-:"<>? ]{5,}))$/;
		
		
		if(Name=="")
		{
			document.getElementById("sname").innerHTML="Enter Your Name";
			error=document.getElementById("sname").style.color=" red";
			return false;
		}
		else if(!reg_name.test(Name))
		{
			document.getElementById("sname").innerHTML="<b>Check Name</b>";
			error=document.getElementById("sname").style.color="red";
			return false;
		}
		else
		{
			document.getElementById("sname").innerHTML="";
		}
		if(Detail=="")
		{
			document.getElementById("sdetail").innerHTML="Enter Detail";
			error=document.getElementById("sdetail").style.color=" red";
			return false;
		}
		else if(!reg_detail.test(Detail))
		{
			document.getElementById("sdetail").innerHTML="<b>Check Detail</b>";
			error=document.getElementById("sdetail").style.color="red";
			return false;
		}
		else
		{
			document.getElementById("sdetail").innerHTML="";
		}
		 if(Image=="")
		{
			document.getElementById("simage").innerHTML="Please Choose Image";
			error=document.getElementById("simage").style.color=" red";
			return false;
		}
		else
		{
			document.getElementById("simage").innerHTML="";
		}
		
		
		return true;
	}
	</script>
  </head>
  <body class="app sidebar-mini rtl">
    <!-- Navbar-->
     <header class="app-header"><a class="app-header__logo" href="dashboard.php">Admin</a>
      <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
      <!-- Navbar Right Menu-->
      <ul class="app-nav">
       <!-- <li class="app-search">
          <input class="app-search__input" type="search" placeholder="Search">
          <button class="app-search__button"><i class="fa fa-search"></i></button>
        </li>

        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">
           <!-- <li><a class="dropdown-item" href="page-user.html"><i class="fa fa-cog fa-lg"></i> Settings</a></li>-->
            <li><a class="dropdown-item" href="dashboard.php"><i class="fa fa-user fa-lg"></i> Profile</a></li>
            <li><a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
          </ul>
        </li>
      </ul>
    </header>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <?php include("menu.php");?>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
          <p>Admin Panel</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
        </ul>
      </div>
		<center> 
			<form class="login-form col-sm-5 col-md-5 col-lg-5" id="frm" name="frm" method="post" action="" enctype="multipart/form-data">
			  <h3 class="login-head"><i class="app-menu__icon fa fa-area-chart"></i>ABOUT ADD</h3>
			<div class="form-group">
				<label class="control-label">NAME</label>
				<input class="form-control"  type="text" id="tname" name="tname" placeholder="Name" required autofocus><strong><span id="sname"></span></strong>
			</div>
			 <div class="form-group">
				  <label for="comment">DETAIL</label>
				  <textarea class="form-control" rows="3" name="tdetail" id="tdetail" placeholder="About" required></textarea><strong><span id="sdetail"></strong></span>
				</div> 
			<div class="form-group">
				<label class="control-label">IMAGE</label>
				<input class="form-control"  type="file" id="timage" name="timage" required><strong><span id="simage"></span></strong>
			</div>
			
			  <div class="form-group btn-container">
				<button class="btn btn-primary mt-2 btn-block" onClick="return validation();" id="btn1" name="btn1"><i class="fa fa-pencil-square-o fa-lg fa-fw"></i>INSERT</button>
			  </div>
			</form>
			<b><?php echo $status; ?></b>
		</center>	
    </main>
    <!-- Essential javascripts for application to work-->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="js/plugins/pace.min.js"></script>
    <!-- Page specific javascripts-->
    <script type="text/javascript" src="js/plugins/chart.js"></script>
    <script type="text/javascript">
      var data = {
      	labels: ["January", "February", "March", "April", "May"],
      	datasets: [
      		{
      			label: "My First dataset",
      			fillColor: "rgba(220,220,220,0.2)",
      			strokeColor: "rgba(220,220,220,1)",
      			pointColor: "rgba(220,220,220,1)",
      			pointStrokeColor: "#fff",
      			pointHighlightFill: "#fff",
      			pointHighlightStroke: "rgba(220,220,220,1)",
      			data: [65, 59, 80, 81, 56]
      		},
      		{
      			label: "My Second dataset",
      			fillColor: "rgba(151,187,205,0.2)",
      			strokeColor: "rgba(151,187,205,1)",
      			pointColor: "rgba(151,187,205,1)",
      			pointStrokeColor: "#fff",
      			pointHighlightFill: "#fff",
      			pointHighlightStroke: "rgba(151,187,205,1)",
      			data: [28, 48, 40, 19, 86]
      		}
      	]
      };
      var pdata = [
      	{
      		value: 300,
      		color: "#46BFBD",
      		highlight: "#5AD3D1",
      		label: "Complete"
      	},
      	{
      		value: 50,
      		color:"#F7464A",
      		highlight: "#FF5A5E",
      		label: "In-Progress"
      	}
      ]
      
      var ctxl = $("#lineChartDemo").get(0).getContext("2d");
      var lineChart = new Chart(ctxl).Line(data);
      
      var ctxp = $("#pieChartDemo").get(0).getContext("2d");
      var pieChart = new Chart(ctxp).Pie(pdata);
    </script>
    <!-- Google analytics script-->
    <script type="text/javascript">
      if(document.location.hostname == 'pratikborsadiya.in') {
      	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
      	ga('create', 'UA-72504830-1', 'auto');
      	ga('send', 'pageview');
      }
    </script>
  </body>
</html>
