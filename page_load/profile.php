<?
session_start();
if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }


	$a = GetValue('SELECT firstname FROM tblstudent WHERE studentid='.$_SESSION['studentid']);
	$c = GetValue('SELECT resume FROM tblstudent WHERE studentid='.$_SESSION['studentid']);
	$d = GetValue('SELECT cv FROM tblstudent WHERE studentid='.$_SESSION['studentid']);

	if(($a!='')&&($c!='')&&($d!='')){
		mysqli_query($db_connection,'UPDATE tblstudent SET is_updated=1 WHERE studentid='.$_SESSION['studentid']);
	}


	if(isset($_GET['firstname'])){
		mysqli_query($db_connection,'UPDATE tblstudent SET firstname=\''.
									$_GET['firstname'].'\',middleinitial=\''.
									$_GET['middleinitial'].'\',middlename=\''.
									$_GET['middlename'].'\',lastname=\''.
									$_GET['lastname'].'\',email=\''.
									$_GET['email'].'\',contactno=\''.
									$_GET['contactno'].'\',address=\''.
									$_GET['address'].'\',gender=\''.
									$_GET['gender'].'\',provid=\''.
									$_GET['provid'].'\',cityid=\''.
									$_GET['cityid'].'\',brgyid=\''.
									$_GET['brgyid'].'\'  
									WHERE studentid='.$_GET['studentid']);
	}



	if(isset($_GET['get_resume'])){
		if(isset($_POST['firstname'])){
			if (isset($_FILES['pic'])) {
				$target_dir = "resume/";
				$pic = basename($_FILES["pic"]["name"]);
				$target_file = $target_dir . $pic;
				if (move_uploaded_file($_FILES["pic"]["tmp_name"], $target_file)) {
					mysqli_query($db_connection,'UPDATE tblstudent SET resume=\''.
								$pic.'\' WHERE studentid='.$_SESSION['studentid']);
				} else {}
			} else {$pic = '';}
		}
	}
	
	if(isset($_GET['get_cv'])){
		if(isset($_POST['xxx'])){
			if (isset($_FILES['pic2'])) {
				$target_dir = "cv/";
				$pic2 = basename($_FILES["pic2"]["name"]);
				$target_file = $target_dir . $pic2;
				if (move_uploaded_file($_FILES["pic2"]["tmp_name"], $target_file)) {
					mysqli_query($db_connection,'UPDATE tblstudent SET cv=\''.
								$pic2.'\' WHERE studentid='.$_SESSION['studentid']);
				} else {}
			} else {$pic2 = '';}
			
		}
	}
	
	if(isset($_GET['get_consent'])){
		if(isset($_POST['ddd'])){
			if (isset($_FILES['pic4'])) {
				$target_dir = "consent/";
				$pic4 = basename($_FILES["pic4"]["name"]);
				$target_file = $target_dir . $pic4;
				if (move_uploaded_file($_FILES["pic4"]["tmp_name"], $target_file)) {
					mysqli_query($db_connection,'UPDATE tblstudent SET consent=\''.
								$pic4.'\' WHERE studentid='.$_SESSION['studentid']);
				} else {}
			} else {$pic4 = '';}
			
		}
	}
	
	
	if(isset($_GET['load_bio'])){
		$q = 'UPDATE tblstudent SET courseid='.
										$_GET['courseid'].',sectionid='.
										$_GET['sectionid'].',bio=\''.
										$_GET['bio'].'\' WHERE studentid='.$_GET['load_bio'];
		//echo $q;
			mysqli_query($db_connection,$q);
	}
	
	
	if(isset($_GET['get_profilepic'])){
		if(isset($_POST['yyy'])){
			if (isset($_FILES['pic3'])) {
				$target_dir = "profilepic/";
				$pic3 = basename($_FILES["pic3"]["name"]);
				$target_file = $target_dir . $pic3;
				if (move_uploaded_file($_FILES["pic3"]["tmp_name"], $target_file)) {
					mysqli_query($db_connection,'UPDATE tblstudent SET profilepic=\''.
								$pic3.'\' WHERE studentid='.$_SESSION['studentid']);
				} else {}
			} else {$pic3 = '';}
			
		}
	}
	
	//get_certification_completion
	if(isset($_GET['get_certification_completion'])){
		if(isset($_POST['firstname'])){
			if (isset($_FILES['pic_c'])) {
				$target_dir = "certificate_completion/";
				$pic_c = basename($_FILES["pic_c"]["name"]);
				$target_file = $target_dir . $pic_c;
				if (move_uploaded_file($_FILES["pic_c"]["tmp_name"], $target_file)) {
					mysqli_query($db_connection,'UPDATE tblstudent SET certificate_completion=\''.
								$pic_c.'\' WHERE studentid='.$_SESSION['studentid']);
				} else {}
			} else {$pic_c = '';}
			
		}
	}
	
	
	if(isset($_GET['typeid'])){
		mysqli_query($db_connection,'UPDATE tblstudent SET typeid='.$_GET['typeid'].' WHERE studentid='.$_SESSION['studentid']);
	}
	
	
	
	if(isset($_GET['get_skills'])){
		mysqli_query($db_connection,'UPDATE tblstudent SET skills=\''.$_GET['get_skills'].'\' WHERE studentid='.$_SESSION['studentid']);
	}
	
	if(isset($_GET['get_other'])){
		mysqli_query($db_connection,'UPDATE tblstudent SET other_info=\''.$_GET['get_other'].'\' WHERE studentid='.$_SESSION['studentid']);
	}
	
	
?>

    <style>
        /* Ensure no margin or padding on the body */
        body, html {
            font-family: 'Raleway', sans-serif;
            margin: 0;
            padding: 0;
            height: 100%;
        }

        .color_bg {
            flex: 1;
            padding-left: 60px;
        }

        .maroon_bg {
            background-color: maroon;
            height: 200px;
        }

        .beige_bg{
            background-color: beige;
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
            height: 200px;
        }

        /* New styles for the profile container */
        .profile-container {
            text-align: center; /* Center the content */
            position: relative; /* Needed to position the profile image */
            margin-top: -350px; /* Adjust this value to move the profile image up between the backgrounds */
            z-index: 10; /* Ensure the profile image is above the backgrounds */
        }

        /* Styles for the profile image */
        .profile-image {
            border-radius: 50%; /* Circular image */
            width: 180px; /* Size of the image */
            height: 180px; /* Size of the image */
            display: inline-block; /* Allows us to use text-align on the container */
            background-color: white; /* Fallback background */
            position: relative; /* Relative to the profile-container */
            z-index: 15; /* Above the .profile-details */
    
        }

        /* Editable content */
        .profile-details {
            font-size: 20px; /* Base font size for the details */
            padding: 0;
            text-align: center;
            margin-top: 5px; /* Adjust the spacing from the profile image */
            width: 100%;
            font-family: 'Raleway', sans-serif;

        }

        /* Add specific styles for the name and title */
        .name {
            font-size: 28px !important ; /* Larger font size for the name */
            margin-bottom: 5px; /* Spacing between name and title/qualifications */
            font-weight: normal !important;
        }

        .title {
            font-size: 25px !important; /* Slightly smaller font size for the title */
            font-weight: bold; 
        }
        .editable {
            border: none;
            background-color: transparent;
            font-family: 'Raleway', sans-serif;
            font-size: inherit;
            color: inherit;
            text-align: inherit;
        
        }

        .editable:focus {
          outline: 1px solid #ccc; /* Highlighting when editing */
        }

        .bot-color-bg {
         margin-top: 55px;
         display: flex;
         gap: 10px;
         padding-top: 50px;
         align-items: flex-start;
        }

        .beige-2 {
            height: 250px;
            flex: 1;
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
            background-color: beige;
            display: flex;
            flex-direction: column; /* Align items vertically */
            align-items: left; /* Center items horizontally */
            padding:20px;
            padding-bottom: 70px;
            align-items: flex-start;
        }

        .icon-container{
            display: flex;
            align-items: center;
            margin-bottom: 5px;
        }

        .icon-profile {
            width: 38px; /* Set the width of the image icons */
            height: 38px; /* Set the height of the image icons */
            margin-right: 10px; /* Adjust the margin to control spacing */
        }

        .label-button{
            display: flex;
            flex-direction: column;
        }
        .label-profile{
            text-align:left;
            font-size: 20px;
        }

        .view-button{
            background-color: maroon;
            color: white;
            border-radius: 20px;
            font-weight: bold;
            padding: 5px 10px; /* Add padding to the button for spacing */
            margin-top: 5px; /* Add margin to separate button from label */
        } 
        .beige-3{
            /*display: flex;*/ /* Use flexbox for layout */
            flex-direction: column; /* Stack children vertically */
            justify-content: space-between; /* Space out the children */
            height: 340px;
            flex: 1;
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
            background-color: beige;
            padding: 20px;
            box-sizing: border-box;
        }

        .info-content {
            flex-direction: column; /* Stack info groups on top of each other */
            align-items: flex-start; /* Align items to the start */
        }

        .bot-color-bg-2 {
            flex: 1;
            flex-grow: 1;
            margin-top: 20px;
            gap: 100px;
        }

        .beige-4 {
            height: 250px;
            flex: 1;
            background-color: beige;
            margin-bottom: 10px;
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
        }

        .beige-5 {
            height: 350px;
            flex: 1;
            background-color: beige;
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
        }

        .container-bg {
            margin-right: 70px;
        }

        .overview{
            color: maroon;
            padding-top: 0px;
            Font-size: 20px;
        }

        .line-container {
            position: relative;
            width: 100%;
            height: 6px; /* Adjust the height for a thinner line */
            background-color: maroon;
            margin: 20px 0;
            background-image: linear-gradient(to right, maroon, maroon calc(50% - 10px), transparent calc(50% - 10px), transparent calc(50% + 10px), maroon calc(50% + 10px)); /* Adjust the gradient to stop and start around the center */
            width: 400px;
        }

        .circle {
            position: absolute;
            width: 20px;
            height: 20px;
            background-color: beige;
            border: 2px solid #ccc;
            border-radius: 50%;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
            top: 50%; /* Center vertically */
            transform: translateY(-50%); /* Offset by half of the circle's height */
            border-color: maroon;
        }

        .circle.checked {
            background-color: #4CAF50; /* Change color when checked */
        }

/*Darren*/
    .circle:hover::before {
      content: attr(title);
      position: absolute;
      top: -30px;
      left: 50%;
      transform: translateX(-50%);
      background-color: #333; /* Change the background color as needed */
      color: #fff; /* Change the text color as needed */
      padding: 5px;
      border-radius: 5px;
      opacity: 0.9;
      z-index: 1;
      white-space: nowrap;
      display: block;
    }
	
	

    </style>
	<script>
	</script>
</head>
<body>
<?
	$resume = GetValue('SELECT resume FROM tblstudent WHERE studentid='.$_SESSION['studentid']);
	$cv = GetValue('SELECT cv FROM tblstudent WHERE studentid='.$_SESSION['studentid']);
	$consent = GetValue('SELECT consent FROM tblstudent WHERE studentid='.$_SESSION['studentid']);
		
?>
<? $link = "TINY.box.show({url:'pages/updateinfo.php?studentid=".$_SESSION['studentid']."',width:700,height:690 })"; ?> 				
<?
	$provid = GetValue('select provid from tblstudent where studentid='.$_SESSION['studentid']);
	$cityid = GetValue('select cityid from tblstudent where studentid='.$_SESSION['studentid']);
	$brgyid = GetValue('select brgyid from tblstudent where studentid='.$_SESSION['studentid']);
	

?>	
    <div class="container-bg">
        <!-- Side Navbar -->
            <div class= "color_bg"> 
                <div class= "maroon_bg"></div>
                <div class= "beige_bg"></div>
                  <!-- Profile image container -->
                  <div class="profile-container">
                        <div class="profile-image" 
						
						<? $profilepic=GetValue('SELECT profilepic FROM tblstudent WHERE studentid='.$_SESSION['studentid']);?>
						
						<?
						if($profilepic){
							echo'style="background-image: url(\'page_load/profilepic/'.$profilepic.'\'); background-size: cover;"';
						} else {
							echo'style="background-image: url(\'images/nopic.png\'); background-size: cover;"';
						
						}
						?>
						
						
						>
                        <!-- Profile image here -->
                  </div>
				  <? $upload = "TINY.box.show({url:'students/upload_profilepic.php?studentid=".$_SESSION['studentid']."',width:400,height:80 })"; ?> 				

				  <img title="Upload your picture" style="cursor:pointer;" 
				  src="images/edit.png" onclick="<?=$upload?>" height=15/>
                <div id="show_update" class="profile-details">
                    <div class="name editable">
					<? 
					
						$firstname = GetValue('SELECT firstname FROM tblstudent WHERE studentid='.$_SESSION['studentid']);
						$lastname = GetValue('SELECT lastname FROM tblstudent WHERE studentid='.$_SESSION['studentid']);

					?>
                    <span> 
							
							<? if($firstname) { 
								echo $firstname.' '.$lastname.'';
							} else {
								echo'<p>your name here...</p>';
							}?> 
							
							<?
								
							$link_d = "TINY.box.show({url:'page_load/add_completion.php?studentid=".$_SESSION['studentid']."',width:400,height:80 })";
							$is_have = GetValue('SELECT certificate_completion from
							tblstudent WHERE studentid='.$_SESSION['studentid']);

							//RESERVED FOR OTHER
							echo'<a style="font-size:12px;" href="javascript:void();" 
							onclick="'.$link_d.'">
							Certificate of Completion</a>&nbsp;';
							
							$dars = 'openCustom(\'forms/view_completion.php?studentid='.$_SESSION['studentid'].'\',1000,1000)';            

							if($is_have){
								echo'<img onclick="'.$dars.'" style="cursor:pointer;" src="images/eye.png" height="13"/>';
							}
							
							?>
							</span>
							
							
                    </div>
                    <div class="title editable"><!--contenteditable="true"-->
                    <p class="editable"><hr style="width:500px;margin-top:-10px;">
					<? $courseid = GetValue('SELECT courseid FROM tblstudent WHERE studentid='.$_SESSION['studentid']);?>
						<? if($courseid) {echo CourseName(GetValue('SELECT courseid FROM tblstudent WHERE studentid='.$_SESSION['studentid'])).'&nbsp;&nbsp;-&nbsp;&nbsp;'
						.CourseCode($courseid).'&nbsp;('.SectionCode(GetValue('SELECT sectionid FROM tblstudent WHERE studentid='.$_SESSION['studentid'])).')';}
						else {echo'COURSE | SECTION'; }?>
						<br> <span style="font-weight:normal;font-size:16px;">
						
						<? $bio = GetValue('SELECT bio FROM tblstudent WHERE studentid='.$_SESSION['studentid']); ?>
						<?
							if($bio){
								echo $bio;
							} else {
								echo'BIO';
							}
						?>
						
						</span> &nbsp;
						<img title="Update Course | Section | BIO" 
						onclick="loadSubContent('students/updatecourse.php?studentid=<?=$_SESSION['studentid']?>','show_update');"
						style="cursor:pointer;" src="images/edit.png" onclick="'.$link0.'" height=15/>
					</p>
                    </div>

                </div>
            </div>
            <div class= "bot-color-bg"> 
            <div class="beige-2">
			<?
			$view_portfolio =  'openCustom(\'forms/view_portfolio.php?studentid='.$_SESSION['studentid'].'\',880,1000)';            

			
			?>
    <p class="overview" style="margin-top:-4px;"> Overview &nbsp;|&nbsp;
	<a style="text-decoration:none;color: maroon;" href="javascript:void(0)" onclick="<?=$view_portfolio?>">View Portfolio</a>
	</p>
	<div class="icon-container">
        <div>
            <img src="images/work.png" alt="Icon 1" class="icon-profile">
        </div>
		<? 
			$typeid=GetValue('SELECT typeid FROM tblstudent WHERE studentid='.$_SESSION['studentid']); 
		?>
        <div class="label-button">
            <div class="label-profile"><span id="g">
			
			<?
			if($typeid){
				echo Type($typeid);
			} else {
				echo 'Prefer internship';
			}
			?>
			
			
			</span>&nbsp;
			<img style="cursor:pointer;" src="images/edit.png" onclick="loadSubContent('page_load/get_type.php','g')" height=15/>
			
			</div>
        </div>
    </div>

    <div class="icon-container">
        <div>
            <img src="images/school.png" alt="Icon 2" class="icon-profile">
        </div>
        <div class="label-button">
            <div class="label-profile">Polytechnic University</div>
        </div>
    </div>
    <div class="icon-container">
        <div>
            <img src="images/medical-certificate.png" alt="Icon 3" class="icon-profile">
        </div>
		<?
			
		$link0 = "TINY.box.show({url:'./students/upload_resume.php?studentid=".$_SESSION['studentid']."',width:400,height:80 })";
		$link2 = "TINY.box.show({url:'./students/view_resume.php?studentid=".$_SESSION['studentid']."',width:800,height:600 })";

		?>
        <div class="label-button">
            <div class="icon-button">
			
			<?
			
			if($resume){
				echo'<button class="view-button" onclick="'.$link2.'">
			VIEW</button>&nbsp;&nbsp;<img style="cursor:pointer;" src="images/edit.png" onclick="'.$link0.'" height=15/>';
			} else {
				echo'<button class="view-button" onclick="'.$link0.'">
			UPLOAD</button>';
			}
			
			?>
			
			
			</div>
        </div>
    </div>

    <div class="icon-container">
        <div>
            <img src="images/resume.png" alt="Icon 4" class="icon-profile">
        </div>
		
		<?
			
		$link3 = "TINY.box.show({url:'./students/upload_cv.php?studentid=".$_SESSION['studentid']."',width:400,height:80 })";
		$link4 = "TINY.box.show({url:'./students/view_cv.php?studentid=".$_SESSION['studentid']."',width:800,height:600 })";

		?>
	   
		<div class="icon-button">
            <div class="icon-button">
			
			<?
			
			if($cv){
				echo'<button class="view-button" onclick="'.$link4.'">
			VIEW</button>&nbsp;&nbsp;<img style="cursor:pointer;" src="images/edit.png" onclick="'.$link3.'" height=15/>';
			} else {
				echo'<button class="view-button" onclick="'.$link3.'">
			UPLOAD</button>';
			}
			
			?>
			
			</div>
        </div>
    </div>
	
	<div class="icon-container">
        <div>
            <img src="images/consent.png" alt="Icon 3" class="icon-profile">
        </div>
		<?
			
		$link_consent1 = "TINY.box.show({url:'./students/upload_consent.php?studentid=".$_SESSION['studentid']."',width:400,height:80 })";
		$link_consent2 = "TINY.box.show({url:'./students/view_consent.php?studentid=".$_SESSION['studentid']."',width:800,height:600 })";

		?>
        <div class="label-button">
            <div class="icon-button">
			
			<?
			
			if($consent){
				echo'<button class="view-button" onclick="'.$link_consent2.'">
			VIEW</button>&nbsp;&nbsp;<img style="cursor:pointer;" src="images/edit.png" onclick="'.$link_consent1.'" height=15/>';
			} else {
				echo'<button class="view-button" onclick="'.$link_consent1.'">
			UPLOAD</button>';
			}
			
			?>
			
			
			</div>
        </div>
    </div>

    <div class="icon-container">
        <div>
            <img src="images/process.png" alt="Icon 5" class="icon-profile">
        </div>
        <div class="line-container">
        <div title="Step 1: Complete Basic Information" class="circle" style="left: 0%;">
		<? if($firstname) {echo '<img style="height:20px;width:20px;" src="./images/ppp.png"/>';} else {}?></div>
		<div title="Step 2: Upload Medical Certificate" class="circle" style="left: 20%;">
		<? if($resume) {echo '<img style="height:20px;width:20px;" src="./images/ppp.png"/>';} else {}?></div>
        <div title="Step 3: Upload Your Resume/CV" class="circle" style="left: 40%;">
		<? if($cv) {echo '<img style="height:20px;width:20px;" src="./images/ppp.png"/>';} else {}?></div>
        <div title="Step 4: Upload Consent Form" class="circle" style="left: 60%;">
		<? if($consent) {echo '<img style="height:20px;width:20px;" src="./images/ppp.png"/>';} else {}?></div>
        <div title="Step 5: Endorsement Letter" class="circle" style="left: 80%;">
		<? if(GetValue('SELECT is_endorse FROM tblstudent WHERE studentid='.$_SESSION['studentid'])) {echo '<img style="height:20px;width:20px;" src="./images/ppp.png"/>';} else {}?></div>
        <div title="Step 6: OJT" class="circle" style="left: 100%;">
		<? if(GetValue('SELECT is_ojt FROM tblstudent WHERE studentid='.$_SESSION['studentid'])) {echo '<img style="height:20px;width:20px;" src="./images/ppp.png"/>';} else {}?></div>
    </div>
	
	

    <script>
        const circles = document.querySelectorAll('.circle');

        circles.forEach(circle => {
            circle.addEventListener('click', () => {
                circle.classList.toggle('checked');
            });
        });
    </script>
    </div>
	
</div>
<div class="beige-3">
                    <div class="info-header">Basic Information
					<a style="text-decoration:none;font-size:12px;" 
					href="javascript:void();" onclick="<?=$link?>">Edit</a></div>
                    <div class="info-content"><br>
                        <div class="info-group">
                            <div><b>Age:</b></div>
							<? $age = GetValue('SELECT TIMESTAMPDIFF(YEAR,dateofbirth,NOW()) as age FROM tblstudent WHERE studentid='.$_SESSION['studentid']);
							$dateofbirth = GetValue('SELECT dateofbirth FROM tblstudent WHERE studentid='.$_SESSION['studentid']); ?>
                            <div><? if($dateofbirth){echo $age; } else{echo'<span style="color:red;">!</span>';} ?></div>
                        </div><br>
                        <div class="info-group">
                            <div><b>E-mail:</b></div>
                            <? $email = GetValue('SELECT email FROM tblstudent WHERE studentid='.$_SESSION['studentid']); ?>
                            <div><? if($email){echo $email; } else{echo'<span style="color:red;">!</span>';} ?></div>
                        </div><br>
                        <div class="info-group">
                            <div><b>Gender:</b></div>
                            <? $gender = GetValue('SELECT gender FROM tblstudent WHERE studentid='.$_SESSION['studentid']); ?>
                            <div><? if($gender){echo $gender; } else{echo'<span style="color:red;">!</span>';} ?></div>
                        </div><br>
                        <div class="info-group">
                            <div><b>Contact Info</b></div>
                            <? $contactno = GetValue('SELECT contactno FROM tblstudent WHERE studentid='.$_SESSION['studentid']); ?>
                            <div><? if($contactno){echo $contactno; } else{echo'<span style="color:red;">!</span>';} ?></div>
                        </div><br>
                        <div class="info-group">
                            <div><b>Address:</b></div>
                            <? $provid = GetValue('SELECT provid FROM tblstudent WHERE studentid='.$_SESSION['studentid']); ?>
                            <? $cityid = GetValue('SELECT cityid FROM tblstudent WHERE studentid='.$_SESSION['studentid']); ?>
                            <? $brgyid = GetValue('SELECT brgyid FROM tblstudent WHERE studentid='.$_SESSION['studentid']); ?>
                            <? $address = GetValue('SELECT address FROM tblstudent WHERE studentid='.$_SESSION['studentid']); ?>
                            <div><? if($provid){echo $address.' '.ucwords(strtolower(Barangay($brgyid))).', '.City($cityid).', '.Province($provid); } else{echo'<span style="color:red;">!</span>';} ?></div>
                        </div>
                    </div>
                </div>
            </div>
                
            </div> 

            <!--<div class="bot-color-bg-2">
                <div class="beige-4">
                </div>
                <div class="beige-5">
                    
                </div>
            </div>--><br><br><br>
    </div>
	
	<div class="container-bg" style="padding-left:60px;">
		<div class="beige-3">
		<?
		$skills = "TINY.box.show({url:'./students/upload_consent.php?studentid=".$_SESSION['studentid']."',width:300,height:160 })";
		?>
            <div class="info-header">Skills 
			<img onclick="loadPage('page_load/update_skills.php','skills');" title="Input your skills" style="cursor:pointer;" src="images/edit.png"  height=15 /></div>
            <div class="info-content">
                <!-- Your existing content for the "skills" div -->
                <div id="skills"  style="margin-top:60px;text-align: center;font-style:arial;font-size:20px;">
                <? if(GetValue('SELECT skills FROM tblstudent WHERE studentid='.$_SESSION['studentid'])){
					echo GetValue('SELECT skills FROM tblstudent WHERE studentid='.$_SESSION['studentid']);
				}?>
				</div>
            </div>
        </div><br>
        
        <!-- Container for other_info content -->
        <div class="beige-3">
            <div class="info-header">Other Information
			<img onclick="loadPage('page_load/update_other_info.php','other_info');" title="Input your other information" style="cursor:pointer;" src="images/edit.png"  height=15 /></div>
            <div class="info-content">
                <!-- Your existing content for the "other_info" div -->
                 <div id="other_info"  style="margin-top:60px;text-align: center;font-style:arial;font-size:20px;">
                 <? if(GetValue('SELECT other_info FROM tblstudent WHERE studentid='.$_SESSION['studentid'])){
					echo GetValue('SELECT other_info FROM tblstudent WHERE studentid='.$_SESSION['studentid']);
				}?>
                    <!-- Add your other information-related content here -->
                </div>
            </div>
        </div>
	</div><br><br>
    
</body>
</html>
