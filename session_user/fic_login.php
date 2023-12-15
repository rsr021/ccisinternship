<?

if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }


?>
	<script>
	function show_me() {
	  var x = document.getElementById("exampleInputPassword");
	  if (x.type === "password") {
		x.type = "text";
	  } else {
		x.type = "password";
	  }
	}
	</script>
<? if($err){echo $err;} ?>
	<form method="post">
		<div class="title">PUP OJT</div>
        <div class="subtext">Sign in to start your session</div>
        <input type="text" name="username" placeholder="USER NAME" class="textbox">
        <input type="password" name="password" id="exampleInputPassword" placeholder="PASSWORD" class="textbox">
		<div class="checkbox-container">
			<input style="width:11px;" type="checkbox" onclick="show_me()">&nbsp;<span style="font-size:12px;">Show Password</span>
		</div>
        <input type="submit" name="sign_faculty" class="button" value="SIGN IN"/>
        <div class="forgot"><a style="text-decoration:none;color:red;" href="forgot/forgotpassword_faculty.php">I forgot my password</a></div>
	</form>
