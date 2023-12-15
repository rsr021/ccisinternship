<?

if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }

if(isset($_GET['?'])){include('index.php');exit(0);}




if(isset($_POST['sub'])){
	$username = $_POST['username'];
	$email = $_POST['email'];
    $password = $_POST['password'];
	$confirmpassword = $_POST['confirmpassword'];
	
	if (($username == '') || ($email == '')){
		$err = '<div style="color:red;">
				  Please input fields
				</div>';
	} else if ($password != $confirmpassword){
		$err = '<div style="color:red;">
				  Password do not matched
				</div>';
	} else {
		$success = '<div style="color:green;">
						Registered Successfully.
					</div>';
					$password = md5($password);
		mysqli_query($db_connection,'INSERT INTO tblfaculty SET username=\''.
										$username.'\',email=\''.
										$email.'\',password=\''.
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
?>
<!DOCTYPE html>
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
            height: 400px;
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
    
</head>
<body>
    <header>
        <div class="logo">
            <a href="?"><img src="images/PUPLogo.png" alt="Logo"></a>
        </div>
        <!--<div class="nav-links">
            <a href="?">Login</a>
            <a href="?">Sign Up</a>
        </div>-->
    </header>
    <div class="background-image"></div>
    <div class="register">
        <img src="images/Logo.png" alt="Logo" class="register_logo">
        <div class="title">PUP OJT</div>
        <div class="subtext">Sign in to start your session</div>
        <form method="post" >
            <input type="text" name="username" placeholder="USER NAME" class="textbox">
            <input type="text" name="email" placeholder="E-MAIL" class="textbox">
            <input type="text" name="password" placeholder="PASSWORD" class="textbox">
            <input type="password" name="confirmpassword" placeholder="CONFIRM PASSWORD" class="textbox">
            <input type="submit" name="sub" class="button" value="REGISTER"/>
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
/*
    // Check if the form has been submitted
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
    $username = $conn->real_escape_string($_REQUEST['username']);
    $email = $conn->real_escape_string($_REQUEST['email']);
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
    $sql = "INSERT INTO faculty_reg (user_name, email, password) VALUES ('$username', '$email', '$hashedPassword')";

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