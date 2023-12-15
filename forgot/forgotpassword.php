<?
if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }


?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 50px;
        }

        form {
            max-width: 300px;
            margin: 0 auto;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }
.button2{
	background-color: rgb(128,70,20);
	 color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
			text-decoration:none;
} 
        .button {
            background-color: rgb(128,0,0);
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
			text-decoration:none;
        }
    </style>
	<script>
	function loadSubContent(url,elementId) {
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
	
	function loadPage(loc,eid) {
		document.getElementById(eid).innerHTML="<div align='center'><img src='../images/loader.gif' width='35px' /></div>";
		loadSubContent(loc,eid);
	}
	
	function email_authenticate(){
		var email = document.getElementById('email').value;
		
		if(email!=''){
			loadPage('pages/emailverify.php?email='+email,'content_f')
		} else {
			alert('Please input your email.');
		}
	}
	function send_opt(email){
		loadPage('../email/forgot.php?email='+email,'showy');
		//var showDiv = document.getElementById("show_you");
		//showDiv.style.display = "block";
		 setTimeout(function() {
			var showDiv = document.getElementById("show_you");
			showDiv.style.display = "block";
		}, 4000); // 3000 milliseconds = 3 seconds
	}
	
	function match_otp(email){
		
		
		var otp = document.getElementById('otp').value;
		if(otp==''){
			alert('Input the field');
		} else {
			loadPage('pages/newpassword.php?otp='+otp+'&email='+email,'content_f');
		}
	}
	function save_password(email){
		var newp = document.getElementById('newp').value;
		var conp = document.getElementById('conp').value;
		
		if (newp==''){
			alert('Please input new password');
		} else if(conp!==newp){
			alert('Password don\'t matched');
		} else {
			loadPage('pages/success.php?newp='+newp+'&email='+email,'content_f');
		}
		
		
	}
	document.addEventListener("keydown", function(event) {
		if (event.key === "Enter") {
			event.preventDefault();
		}
	});
	</script>
</head>
<body>
    <div id="content_f">
	<h2>Forgot Password</h2>
	<form id="forgotPasswordForm">
		<label for="email">Email:</label>
		<input type="text" id="email" name="email"><br><br>
	</form>
		<a class="button2" href="../">Back</a>
		<a class="button" href="javascript:void();" onclick="email_authenticate()">Submit</a>
	</div>
</body>
</html>
