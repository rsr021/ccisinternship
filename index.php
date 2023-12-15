<?
session_start();
if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }


if(isset($_GET['studentregister'])){
	include('session_user/s_register.php');
	exit();
}
if(isset($_GET['facultyregister'])){
	include('session_user/fic_register.php');
	exit();
}

if(isset($_GET['forgot'])){
	include('forgot/forgotpassword.php');
	exit();
}


 if(isset($_POST['signin'])){
        $studentno = $_POST['studentno'];
        $password = $_POST['password'];
        $password = md5($password);
		$dob_month = $_POST['dob_month'];
		$dob_day = $_POST['dob_day'];
		$dob_year = $_POST['dob_year'];
		$dob = date('Y-m-d', strtotime($dob_year.'-'.$dob_month.'-'.$dob_day));
        
		$select_student = mysqli_query($db_connection, "SELECT * FROM tblstudent WHERE dateofbirth ='$dob' AND studentno ='$studentno' AND studentpassword ='$password'");
        $count_student = mysqli_num_rows($select_student);
        if ($count_student==1){
            while($result = mysqli_fetch_array($select_student)){
                $_SESSION['studentid'] = $result['studentid'];
                $_SESSION['courseid'] = $result['courseid'];
                $_SESSION['sectionid'] = $result['sectionid'];
            }
			include('homestudent.php');
            exit();
        }
		$err =  '<span style="color:red; font-size:16pm; font-weight:bold" class="blink">Invalid Email or Password</span>';
	}
	 
if (isset($_SESSION['studentid'])) {
	include_once('../includes/database.php');
	include('homestudent.php');
	exit(0);
}



if(isset($_POST['sign_faculty'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $password = md5($password);
		
        $select_employee = mysqli_query($db_connection, "SELECT * FROM tblfaculty WHERE username ='$username' AND password ='$password'");
        $count_employee = mysqli_num_rows($select_employee);
        if ($count_employee==1){
            while($result = mysqli_fetch_array($select_employee)){
                $_SESSION['facultyid'] =  $result['facultyid'];
				$_SESSION['usertype'] =  $result['usertype'];
				$_SESSION['sectionid'] =  $result['sectionid'];
				$_SESSION['courseid'] =  $result['courseid'];
            }
            if ($_SESSION['usertype'] == 1){
                $_SESSION['username']=$username;
                $_SESSION['usertype']=1;
				include('home.php');
                exit();
            } elseif ($_SESSION['usertype'] == 0) {
				$_SESSION['username'] = $username;
				$_SESSION['usertype'] = 0;
				include('homefaculty.php');
				exit();
            } else {
                include('index.php');
                exit();
            }
        }
		echo '<script>
			setTimeout(function () {
				alert("Error on Login: Account doesn\'t exist!");
			}, 200);
		</script>' ;
 }
	 
if (isset($_SESSION['facultyid'])) {
    include_once('includes/database.php');
    if ($_SESSION['usertype'] == 1) {
        include('home.php');
    } else {
        include('homefaculty.php');
    }
    exit(0);
}




?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style/register.css">
	<link rel="icon" href="images/PUPLogo.png" type="image/ico">
	<title> PUP Internship </title>
	<style>
		.blink {
			animation: 2s linear infinite condemned_blink_effect;
		}
		@keyframes condemned_blink_effect {
			  0% {
				visibility: hidden;
			  }
			  50% {
				visibility: hidden;
			  }
			  100% {
				visibility: visible;
			  }
		}

        a.medium {
            text-decoration: none;
            font-size: 14px;
        }

        /* Hover state styling */
        a.medium:hover {
            text-decoration: underline; /* Add underline on hover */
        }

        @media (max-width: 768px) {
            .h4 {
                font-size: 1.2rem;
            }

            .h5 {
                font-size: 1rem;
            }
        }
		
		
		
        .checkbox-container {
            display: flex;
            align-items: center;
        }

        .checkbox-container input[type="checkbox"] {
            width: 11px;
			margin-left: 8px;
        }

        .checkbox-container span {
            font-size: 12px;
            margin-left: 2px;
        }
	</style>
    <style>
	
	
	
	
        body{
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .background-image {
            background-image: url("images/bg.png"); /* Replace with your background image URL */
            background-size: cover;
            background-position: center;
            height: 50%;
            position: absolute;
            width: 100%;
            margin-top: 65px;
        }
        .register_logo {
            width: 70px;
            height: 70px;
            margin: 0 auto;
        }
        .register {
            width: 35%;
            height: 500px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
            margin-top: 50px;
            align-items: center;display: flex;
            justify-content: center;
            flex-direction: column;
            z-index: 1;
            background-color: rgba(255, 255, 255, 0.9);
            
        }
        .title {
            font-size: 24px;
            text-align: center;
            margin-bottom: 10px;
            margin-top: 5px;
            font-weight: bold;
            text-shadow: 1px 1px 2px gray;
        }
        .subtext {
            font-size: 14px;
            text-align: center;
            margin-bottom: 20px;
        }
        .textbox {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            box-sizing: border-box;
        }
        .button {
            width: 100%;
            padding: 10px;
            background-color: #800000;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 20px;
            margin-top: 10px;
            font-weight: bold;
        }

        .button:hover{
            background-color: white;
            color:#800000;
            border: 3px;
            background-color: transparent;
            border-style: solid;
        }
        .forgot {
            text-align: center;
            font-size: 12px;
            margin-top: 10px;
            color: red;
        }
        .register-text {
            text-align: center;
            font-size: 14px;
            margin-top: 10px;
        }
    </style>
	<script>
	
    function loadPage(url,elementId) {
		if (window.XMLHttpRequest) {
				xmlhttp=new XMLHttpRequest();
		} else {
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}   
		xmlhttp.onreadystatechange=function() {
			if (xmlhttp.readyState==4 && xmlhttp.status==200) {
				document.getElementById(elementId).innerHTML="";
				document.getElementById(elementId).innerHTML=xmlhttp.responseText;	
			}
		}  
		xmlhttp.open("GET",url,true);
		xmlhttp.send();	   
    }
    function show_me() {
	  var x = document.getElementById("exampleInputPassword");
	  if (x.type === "password") {
		x.type = "text";
	  } else {
		x.type = "password";
	  }
	}
	
	</script>
    
</head>
<body>
    
    <header>
        <div class="logo">
            <a href="javascript:void();" onclick="window.location.reload();"><img src="images/ojt.png" alt="Logo"></a>
        </div>
        <div class="nav-links">
            <a href="?studentregister">Student Register</a>&nbsp;&nbsp;&nbsp;&nbsp;|
            <a href="?facultyregister">Faculty Register</a>
        </div>
    </header>
    <div class="background-image"></div>
    <div class="register">
        <img src="images/Logo.png" alt="Logo" class="register_logo">
        <div id="show"><div class="title">PUP OJT (Student)</div>
        <div class="subtext">Sign in to start your session</div>
        <form method="post">
		<? if($err){echo $err;} ?>
            <input type="text" name="studentno" placeholder="STUDENT NUMBER" class="textbox">
						<div class="date">
					  <select id="dob_month" name="dob_month" class="textbox" style="color:grey;">
						<option value="0">Date of Birth</option>
						<option value="1">January</option>
						<option value="2">February</option>
						<option value="3">March</option>
						<option value="4">April</option>
						<option value="5">May</option>
						<option value="6">June</option>
						<option value="7">July</option>
						<option value="8">August</option>
						<option value="9">September</option>
						<option value="10">October</option>
						<option value="11">November</option>
						<option value="12">December</option>
					  </select>
					  <select id="dob_day" name="dob_day" class="textbox" style="color:grey;">
						<option value="0">Day</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						<option value="9">9</option>
						<option value="10">10</option>
						<option value="11">11</option>
						<option value="12">12</option>
						<option value="13">13</option>
						<option value="14">14</option>
						<option value="15">15</option>
						<option value="16">16</option>
						<option value="17">17</option>
						<option value="18">18</option>
						<option value="19">19</option>
						<option value="20">20</option>
						<option value="21">21</option>
						<option value="22">22</option>
						<option value="23">23</option>
						<option value="24">24</option>
						<option value="25">25</option>
						<option value="26">26</option>
						<option value="27">27</option>
						<option value="28">28</option>
						<option value="29">29</option>
						<option value="30">30</option>
						<option value="31">31</option>
					  </select>
                         <select id="dob_year" name="dob_year" class="textbox" style="color:grey;">
                            <option value="0">Year</option>
                            <?php
                            $currentYear = date("Y"); // Get the current year
                            for ($year = $currentYear; $year >= 1960; $year--) {
                                echo '<option value="' . $year . '">' . $year . '</option>';
                            }
                         ?>
                      </select>
					 
            <input type="password" name="password" id="exampleInputPassword" placeholder="PASSWORD" class="textbox">
            <div class="checkbox-container">
				<input style="width:11px;" type="checkbox" onclick="show_me()">&nbsp;<span style="font-size:12px;">Show Password</span>
			</div>
            <input type="submit" name="signin" class="button" value="SIGN IN"/>
        </form></div>
        <div class="forgot"><a style="text-decoration:none;color:red;" href="forgot/forgotpassword.php">I forgot my password</a></div>
        <div class="register-text"><a style="text-decoration:none;" href="javascript:void();" onclick="loadPage('session_user/fic_login.php','show')">Login as Faculty</a></div>
    </div>
</body>
</html>