<?

if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }

if(isset($_GET['?'])){
	include('index.php');
	exit(0);
}




if(isset($_POST['register_s'])){
	$studentno = $_POST['studentno'];
	$dob_month = $_POST['dob_month'];
    $dob_day = $_POST['dob_day'];
    $dob_year = $_POST['dob_year'];
	$dob = date('Y-m-d', strtotime($dob_year.'-'.$dob_month.'-'.$dob_day));
	$password = $_POST['password'];
	$confirmpassword = $_POST['confirmpassword'];
	
	
		if (checkStudentNoExists($db_connection, $studentno)){
			$err = '<div style="color:red;">
						  Student No. is alread exist in the database.
						</div>';
		} else {
			if (($studentno == '')){
				$err = '<div style="color:red;">
						  Please input student number
						</div>';
			} else if ($password != $confirmpassword){
				$err = '<div style="color:red;">
						  Password do not matched
						</div>';
			} else {
				$currentYear = date('Y');
				$minimumBirthYear = $currentYear - 17;
				$userBirthYear = intval($dob_year);
				
					if ($userBirthYear > $minimumBirthYear) {
					$err = '<div style="color:red;">
							  You must be 17 years old or above to register.
							</div>';
					} else {
						$success = '<div style="color:green;">
										Registered Successfully.
									</div>';
						$password = md5($password);
						mysqli_query($db_connection,'INSERT INTO tblstudent SET studentno=\''.
															$studentno.'\',dateofbirth=\''.
															$dob.'\',studentpassword=\''.
															$password.'\' ');
						echo '<script type="text/javascript">
								setTimeout(function () {
									alert("Successfully Registered! You can now login with your username and password.");
									window.location.href = "?"; // Replace "?" with your desired URL
								}, 200);
							</script>
							'; 
					}
			}
		}
			
	
}
?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style/register.css">
	<link rel="icon" href="images/PUPLogo.png" type="image/ico">
	<title> PUP Internship </title>
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

        .success-message {
            display: none;
            background-color: #4CAF50;
            color: #fff;
            padding: 10px;
            text-align: center;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 999;
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
		
	</script>
</head>
<body>
    <header>
        <div class="logo">
            <a href="?"><img src="images/PUPLogo.png" alt="Logo"></a>
        </div>
    </header>
    <div class="background-image"></div>
    <div class="register">
        <img src="images/Logo.png" alt="Logo" class="register_logo">
        <div class="title">PUP OJT</div>
        <div class="subtext">Sign in to start your session</div>
		
		
        <form method="post" enctype="multipart/form-data">
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
					 </div><hr>
			<input type="password" name="password" placeholder="PASSWORD" class="textbox">
			<input type="password" name="confirmpassword" placeholder="CONFIRM PASSWORD" class="textbox">
			<input type="submit" id="register-btn" name="register_s" class="button" />
                     
		</form>
    </div>
    <script>
          // JavaScript to hide the success message on page reload
          window.onload = function() {
            var successMessage = document.getElementById("success-message");
            if (successMessage) {
                successMessage.style.display = "block";
                setTimeout(function() {
                    successMessage.style.display = "none";
                }, 5000); // Adjust the time (in milliseconds) the message stays visible
            }
        }
    </script>
</body>
</html>


<?php
/*    // Check if the form has been submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Database connection
        $servername = "localhost"; // Change to your database server name or IP
        $username = "root"; // Change to your database username
        $password = ""; // Change to your database password
        $database = "internship_db"; // Your database name
    
        $conn = new mysqli($servername, $username, $password, $database);
    
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

    // Escape user inputs for security
    $student_number = $conn->real_escape_string($_REQUEST['student_number']);
    $birth_month = $conn->real_escape_string($_REQUEST['birth_month']);
    $birth_date = $conn->real_escape_string($_REQUEST['birth_date']);
    $birth_year = $conn->real_escape_string($_REQUEST['birth_year']);
    $password = $conn->real_escape_string($_REQUEST['password']);
    $confirm_password = $conn->real_escape_string($_REQUEST['confirm_password']);
    // Validate user inputs

    if ($password !== $confirm_password) {
        echo "Passwords do not match!";
        exit();
    }

    // Hash the password (for security)
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Insert data into the faculty_reg table
     $sql = "INSERT INTO student_reg (student_number, birth_month, birth_date, birth_year, password) VALUES ('$student_number', '$birth_month', '$birth_date', '$birth_year','$hashedPassword')";

    if ($conn->query($sql) === true) {
        // Display the success message directly in HTML
        echo '<div id="success-message" class="success-message">Your registration has been successfully completed!</div>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    // Close the database connection
    $conn->close();
    }

    
*/
    ?>