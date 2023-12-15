<?
session_start();
    if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
    if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }
	$select = mysqli_query($db_connection, "SELECT * FROM tblstudent WHERE studentid = '$_SESSION[studentid]'  ");
    $count = mysqli_num_rows($select);

    if($count == 0) {
      header("location:./");		
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="images/PUPLogo.png" type="image/ico">
	<!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">-->
	<script src="js/sweetalert.min.js"></script>
	<script src="js/tinybox.js"></script>
	<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
	<style>
	.tbox {position:absolute;  display:none; padding:14px 17px; z-index:900}
		.tinner {padding:15px; -moz-border-radius:5px; border-radius:5px; background:#fff url(images/preload.gif) no-repeat 50% 50%; border-right:1px solid #333; border-bottom:1px solid #333;}
		.tmask {position:absolute; display:none; top:0px; left:0px; height:100%; width:100%; background:#000; z-index:800}
		.tclose {position:absolute; top:0px; right:0px; width:30px; height:30px; cursor:pointer; background:url(images/close.png) no-repeat}
		.tclose:hover {background-position:0 -30px}
		
		#error {background:#ff6969; color:#fff; text-shadow:1px 1px #cf5454; border-right:1px solid #000; border-bottom:1px solid #000; padding:0}
		#error .tcontent {padding:10px 14px 11px; border:1px solid #ffb8b8; -moz-border-radius:5px; border-radius:5px}
		#success {background:#2ea125; color:#fff; text-shadow:1px 1px #1b6116; border-right:1px solid #000; border-bottom:1px solid #000; padding:10; -moz-border-radius:0; border-radius:0}
		#bluemask {background:#4195aa}
		#frameless {padding:0}
		#frameless .tclose {left:6px}
		
		
		#body-overlay { text-align:center; background-color: rgba(0, 0, 0, 0.6);z-index: 99999;position:fixed;left: 0;top: 0;width: 100%;height: 100%; display:none; }
		#body-overlay div {position:absolute;left:40%;top:20%;} 
		
		
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
        }

        #sideNav {
            height: 100%;
            width: 200px;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: rgb(128,0,0);
            padding-top: 30px;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-right: 10px; /* Added padding to the right for better aesthetics */
        }

        #sideNav a {
            padding: 16px;
            text-decoration: none;
            font-size: 18px;
            color: white;
            display: block;
            transition: 0.3s;
        }

        #sideNav a:hover {
            color: #f1f1f1;
        }

        #sideNavLogo {
            width: 28%;
            margin-bottom: 20px;
        }
		
		.headline {
			font-size: 55px; /* Adjust based on your requirements */
			line-height: 1.2; /* Provides spacing between lines */
			max-width: 800px; /* Limits the width to wrap the text into roughly three lines; adjust as needed */
			text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); /* Adds a shadow effect */
			margin-bottom: 20px; /* Add space below the headline for better separation */
			white-space: pre-line; /* Ensures text respects newline characters */
			overflow-wrap: break-word; /* Breaks long words to prevent overflow */
			margin-top: 0px;
			letter-spacing: 20px;

		}
		
		.content {
			flex: 1;
			padding-top: 20px;
			display: flex;
			flex-direction: column;
			justify-content: center;
			align-items: center;
			color: white;
			text-align: center;
			font-weight: bold;
			font-family: 'Raleway', sans-serif;
			margin: 0;
			padding: 0;
			background-image: url('images/darkbg.png');
			background-size: cover;
			background-repeat: no-repeat;
			background-attachment: fixed; /* This keeps the background fixed while scrolling */
			background-position: center;
			overflow: hidden; /* prevent scrollbar when modal appears */
			height: 100vh; /* Set the height to 100% of the viewport height */
		}
		
		button {
			padding: 10px 20px;
			border: white;
			border-style: solid;
			color: #000;
			cursor: pointer;
			transition: background-color 0.3s ease;
		}

		button:hover {
			background-color: #ddd;
		}

        #content {
            margin-left: 200px; /* Adjusted to match the width of the side navigation */
            /*padding-left:10px;*/
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
		document.getElementById(eid).innerHTML="<div align='center'><img src='images/loader.gif' width='35px' /></div>";
		loadSubContent(loc,eid);
	}
	
	
	function param(w,h) {
		var width  = w;
		var height = h;
		var left = (screen.width  - width)/2;
		var top = (screen.height - height)/2;
		var params = 'width='+width+', height='+height;
		params += ', top='+top+', left='+left;
		params += ', directories=no';
		params += ', location=no';
		params += ', resizable=no';
		params += ', status=no';
		params += ', toolbar=no';
		return params;
	}

	function openWin(url){
		myWindow=window.open(url,'mywin',param(800,500));
		myWindow.focus();
	}

	function openCustom(url,w,h){
		myWindow=window.open(url,'mywin',param(w,h));
		myWindow.focus();
	}
	
	function logout(){
		swal({
			title: "Logout",
			text: "Are you sure to Logout?",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		})
		.then((willAdd) => {
			if (willAdd) {
				window.location.href = 'session_user/logoutstudent.php';
			} else {}
		});
	}	
	/*
	$link = "TINY.box.show({url:'pages/viewcor.php?studentid=".$rw['studentid']."',width:900,height:500 })";
	*/
	
	function object(id){return document.getElementById(id);}
	/*
	<input placeholder="Input firstname" type="text" id="firstname"/><br><br>
	<input placeholder="Input middlename" type="text" id="middlename"/><br><br>
	<input placeholder="Input middleinitial" type="text" id="middleinitial"/><br><br>
	<input placeholder="Input lastname" type="text" id="lastname"/><br><br>

	<input placeholder="Input your email address" type="text" id="email"/><br><br>

	<input placeholder="Input your contact number" type="text" id="contactno"/><br><br>
	<textarea placeholder="Input your permanent address" id="address"></textarea><br><br>
	*/
	function update_info(studentid){
		var firstname = object('firstname').value;
		var middlename = object('middlename').value;
		var middleinitial = object('middleinitial').value;
		var lastname = object('lastname').value;
		var email = object('email').value;
		var contactno = object('contactno').value;
		var address = object('address').value;
		var gender = object('gender').value;
		
		var provid = object('provid').value;
		var cityid = object('cityid').value;
		var brgyid = object('brgyid').value;
		
		if (firstname !== '') {
		if (lastname !== '') {
		if (gender != 0) {
		if (email !== '') {
		if (contactno !== '') {
		if (provid != 0) {
		if (cityid != 0) {
		if (brgyid != 0) {
			if (address !== '') {
			swal({
				title: 'Basic Information',
				text: 'Are you sure you want to update your information?',
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			.then((willAdd) => {
				if (willAdd) {	
				TINY.box.show({
					html: 'Processing Request',
					animate: false,
					close: false,
					mask: false,
					boxid: 'success',
					autohide: 2
				});				
				x = 'page_load/profile.php?studentid='+studentid+'&firstname='+firstname+'&middleinitial='+middleinitial+'&middlename='+middlename
										+'&lastname='+lastname+'&email='+email
										+'&contactno='+contactno+'&address='+address+'&gender='+gender
										+'&provid='+provid
										+'&cityid='+cityid
										+'&brgyid='+brgyid;			
					$.ajax({
						url: x, 
						type: "GET",
						beforeSend: function(){$("#body-overlay").show();},
						contentType: false,
						processData:false,
						success: function(data)
						{
						
						$("#content").html(data);
						$("#content").css('opacity','1');
							$("#body-overlay").hide();
							
						swal("Successfully Updated!", {
								icon: 'success',
								buttons: false,
								timer: 2000,
							});
						},
						error: function() 
						{
							swal('Error','Error Processing Request ','error');
						} 	        
					});
				}
			});
		}else{swal('Error on Address','Please input your address','error');}
		}else{swal('Error on Barangay','Please select barangay','error');}
		}else{swal('Error on City','Please select city','error');}
		}else{swal('Error on Province','Please select province','error');}
		}else{swal('Error on Contact No.','Please input contact number','error');}
		}else{swal('Error on Email Address','Please input email address','error');}
		}else{swal('Error on Gender','Please select gender','error');}
		}else{swal('Error on Last Name','Please input last name','error');}
		}else{swal('Error on First Name','Please input last name','error');}
	}
	
	
	function update_bio(studentid){
		var courseid = object('courseid').value;
		var sectionid = object('sectionid').value;
		var bio = object('bio').value;
		
		if (courseid != 0) {		
		if (sectionid != 0) {		
			swal({
				title: 'Basic Information',
				text: 'Are you sure you want to update your information?',
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			.then((willAdd) => {
				if (willAdd) {	
				TINY.box.show({
					html: 'Processing Request',
					animate: false,
					close: false,
					mask: false,
					boxid: 'success',
					autohide: 2
				});				
				x = 'page_load/profile.php?load_bio='+studentid+'&studentid='+studentid+'&courseid='+courseid+'&sectionid='+sectionid+'&bio='+bio;			
					$.ajax({
						url: x, 
						type: "GET",
						beforeSend: function(){$("#body-overlay").show();},
						contentType: false,
						processData:false,
						success: function(data)
						{
						
						$("#content").html(data);
						$("#content").css('opacity','1');
							$("#body-overlay").hide();
							
						swal("Successfully Updated!", {
								icon: 'success',
								buttons: false,
								timer: 2000,
							});
						},
						error: function() 
						{
							swal('Error','Error Processing Request ','error');
						} 	        
					});
				}
			});
		}else{swal('Error on Section','Please select section','error');}
		}else{swal('Error on Course','Please select course','error');}
	}

	
	
	function upload_resume(studentid){
	     var firstname = object('firstname').value;
	    // var middlename = object('middlename').value;
	    // var lastname = object('lastname').value;
	    // var courseid = object('courseid').value;
		
		var picInput = document.getElementById('pic');
		var picFile = picInput.files[0];

		// if (firstname !== '') {
		// if (courseid != 0) {
			let myForm = new FormData();
			 myForm.append('firstname', firstname);
			// myForm.append('middlename', middlename);
			// myForm.append('lastname', lastname);
			// myForm.append('courseid', courseid);
			myForm.append('pic', picFile);
		
			swal({
				title: "Basic Information",
				text: "Are you sure want to update your information?",
				icon: "info",
				buttons: true,
				dangerMode: true,
			})
			.then((willAdd) => {
				if (willAdd) {
				TINY.box.show({
					html: 'Processing Request',
					animate: false,
					close: false,
					mask: false,
					boxid: 'success',
					autohide: 2
				});	
					$.ajax({
						url: 'page_load/profile.php?get_resume',
						type: "POST",
						data: myForm,
						beforeSend: function () {$("#body-overlay").show();},
						contentType: false,
						processData: false,
						success: function (data) {
							$("#content").html(data);
							$("#content").css('opacity', '1');
							$("#body-overlay").hide();
						   
							swal("Successfully Updated!", {
								icon: 'success',
								buttons: false,
								timer: 2000,
							});

						},
						error: function () {
							Swal('Error', 'Error Processing Request', 'error');
						}
					});
				} else {}
			});		
		// }else{swal('Error on Course','Please select course','error');}
		// }else{swal('Error on First Name','Please input first name','error');}
	}
	
	function upload_cv(studentid){
	     var xxx = object('xxx').value;
	    // var middlename = object('middlename').value;
	    // var lastname = object('lastname').value;
	    // var courseid = object('courseid').value;
		
		var picInput = document.getElementById('pic2');
		var picFile = picInput.files[0];

		// if (firstname !== '') {
		// if (courseid != 0) {
			let myForm = new FormData();
			 myForm.append('xxx', xxx);
			// myForm.append('middlename', middlename);
			// myForm.append('lastname', lastname);
			// myForm.append('courseid', courseid);
			myForm.append('pic2', picFile);
		
			swal({
				title: "Basic Information",
				text: "Are you sure want to update your information?",
				icon: "info",
				buttons: true,
				dangerMode: true,
			})
			.then((willAdd) => {
				if (willAdd) {
				TINY.box.show({
					html: 'Processing Request',
					animate: false,
					close: false,
					mask: false,
					boxid: 'success',
					autohide: 2
				});	
					$.ajax({
						url: 'page_load/profile.php?get_cv',
						type: "POST",
						data: myForm,
						beforeSend: function () {$("#body-overlay").show();},
						contentType: false,
						processData: false,
						success: function (data) {
							$("#content").html(data);
							$("#content").css('opacity', '1');
							$("#body-overlay").hide();
						   
							swal("Successfully Updated!", {
								icon: 'success',
								buttons: false,
								timer: 2000,
							});

						},
						error: function () {
							Swal('Error', 'Error Processing Request', 'error');
						}
					});
				} else {}
			});		
		// }else{swal('Error on Course','Please select course','error');}
		// }else{swal('Error on First Name','Please input first name','error');}
	}
	
	
	function upload_profilepic(studentid){
	    var yyy = object('yyy').value;
		var picInput = document.getElementById('pic3');
		var picFile = picInput.files[0];
			let myForm = new FormData();
			myForm.append('yyy', yyy);
			myForm.append('pic3', picFile);
		
			swal({
				title: "Profile Picture",
				text: "Are you sure want to upload this picture?",
				icon: "info",
				buttons: true,
				dangerMode: true,
			})
			.then((willAdd) => {
				if (willAdd) {
				TINY.box.show({
					html: 'Processing Request',
					animate: false,
					close: false,
					mask: false,
					boxid: 'success',
					autohide: 2
				});	
					$.ajax({
						url: 'page_load/profile.php?get_profilepic',
						type: "POST",
						data: myForm,
						beforeSend: function () {$("#body-overlay").show();},
						contentType: false,
						processData: false,
						success: function (data) {
							$("#content").html(data);
							$("#content").css('opacity', '1');
							$("#body-overlay").hide();
						   
							swal("Successfully Updated!", {
								icon: 'success',
								buttons: false,
								timer: 2000,
							});

						},
						error: function () {
							Swal('Error', 'Error Processing Request', 'error');
						}
					});
				} else {}
			});		
	}
	/*
	function apply(companyid){		
			swal({
				title: 'Application for OJT',
				text: 'Are you sure you want to apply in this company?',
				icon: "warning",
				buttons: true,
				dangerMode: true,
		})
			.then((willAdd) => {
			if (willAdd) {
				swal({
					title: "Sending Email",
					buttons: false,
					closeOnClickOutside: false,
					icon: "info",
					content: {
						element: "img",
						attributes: {
							src: "images/processing.gif",
							style: "width: 150px; height: 70px;",
						},
					},
				});
					setTimeout(() => {
					swal("Suc", "Successfully Sent!", "success");
					var loc = 'page_load/company.php?companyid='+companyid;			
					loadPage(loc,'content');
					
				}, 3000);
			} else {
			}
		});
	}
	*/
	
	function apply(companyid){		
			swal({
				title: 'Application for OJT',
				text: 'Are you sure you want to apply in this company?',
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			.then((willAdd) => {
				if (willAdd) {			
				x = 'page_load/company.php?companyid='+companyid;			
					$.ajax({
						url: x, 
						type: "GET",
						beforeSend: function(){$("#body-overlay").show();},
						contentType: false,
						processData:false,
						success: function(data)
						{
						
						$("#content").html(data);
						$("#content").css('opacity','1');
							$("#body-overlay").hide();
							
						},
						error: function() 
						{
							swal('Error','Error Processing Request ','error');
						} 	        
					});
				}
			});
	}
	//is_ojt_start
	/*function is_ojt_start(studentid){		
			swal({
				title: 'On-the-job Training',
				text: 'Click OK if your OJT has been started',
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			.then((willAdd) => {
				if (willAdd) {			
				x = 'page_load/report.php?get_ss='+studentid+'&studentid='+studentid;			
					$.ajax({
						url: x, 
						type: "GET",
						beforeSend: function(){$("#body-overlay").show();},
						contentType: false,
						processData:false,
						success: function(data)
						{
						
						$("#content").html(data);
						$("#content").css('opacity','1');
							$("#body-overlay").hide();
							
						swal('Success','Successfully updated','success');
						},
						error: function() 
						{
							swal('Error','Error Processing Request ','error');
						} 	        
					});
				}
			});
	}*/
	
	function upload_consent(studentid){
	    var ddd = object('ddd').value;
		var picInput = document.getElementById('pic4');
		var picFile = picInput.files[0];
			let myForm = new FormData();
			myForm.append('ddd', ddd);
			myForm.append('pic4', picFile);
		
			swal({
				title: "Consent Form",
				text: "Are you sure want to submit this consent form?",
				icon: "info",
				buttons: true,
				dangerMode: true,
			})
			.then((willAdd) => {
				if (willAdd) {
				TINY.box.show({
					html: 'Processing Request',
					animate: false,
					close: false,
					mask: false,
					boxid: 'success',
					autohide: 2
				});	
					$.ajax({
						url: 'page_load/profile.php?get_consent',
						type: "POST",
						data: myForm,
						beforeSend: function () {$("#body-overlay").show();},
						contentType: false,
						processData: false,
						success: function (data) {
							$("#content").html(data);
							$("#content").css('opacity', '1');
							$("#body-overlay").hide();
						   
							swal("Successfully Updated!", {
								icon: 'success',
								buttons: false,
								timer: 2000,
							});

						},
						error: function () {
							Swal('Error', 'Error Processing Request', 'error');
						}
					});
				} else {}
			});		
	}
	
	
	
	function upload_pic_entry(){
		var des = document.getElementById('des').value;
		var picInput = document.getElementById('pic5');
		var picFile = picInput.files[0];
			let myForm = new FormData();
			myForm.append('des', des);
			myForm.append('pic5', picFile);
		
			swal({
				title: "Picture",
				text: "Are you sure want to submit this picture?",
				icon: "info",
				buttons: true,
				dangerMode: true,
			})
			.then((willAdd) => {
				if (willAdd) {
				TINY.box.show({
					html: 'Processing Request',
					animate: false,
					close: false,
					mask: false,
					boxid: 'success',
					autohide: 2
				});	
					$.ajax({
						url: 'page_load/report.php',
						type: "POST",
						data: myForm,
						beforeSend: function () {$("#body-overlay").show();},
						contentType: false,
						processData: false,
						success: function (data) {
							$("#content").html(data);
							$("#content").css('opacity', '1');
							$("#body-overlay").hide();
						   
							swal("Successfully Updated!", {
								icon: 'success',
								buttons: false,
								timer: 2000,
							});

						},
						error: function () {
							Swal('Error', 'Error Processing Request', 'error');
						}
					});
				} else {}
			});		
	}
	
	//submit_weekly
	function submit_weekly(){
	//datefrom, dateto, timein, timeout, totalhours, description
	var title = object('title').value;
	var datefrom = object('datefrom').value;
	var dateto = object('dateto').value;
	var timein = object('timein').value;
	var timeout = object('timeout').value;
	var totalhours = object('totalhours').value;
	var description = object('description').value;
	// var monday_time_in = object('monday_time_in').value;
	// var monday_time_out = object('monday_time_out').value;
	
	if (title != '') {	
	//if (totalhours != '') {	
	if (description != '') {	
			swal({
				title: 'Report Submission',
				text: 'Are you sure you want to submit this report?',
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			.then((willAdd) => {
				if (willAdd) {	
				TINY.box.show({
					html: 'Processing Request',
					animate: false,
					close: false,
					mask: false,
					boxid: 'success',
					autohide: 1
				});			
				x = 'page_load/report.php?datefrom='+datefrom+'&dateto='
										+dateto+'&timein='+
										timein+'&timeout='+
										timeout+'&totalhours='+
										totalhours+'&description='+
										description+'&title='+
										title;			
					$.ajax({
						url: x, 
						type: "GET",
						beforeSend: function(){$("#body-overlay").show();},
						contentType: false,
						processData:false,
						success: function(data)
						{
						
						$("#content").html(data);
						$("#content").css('opacity','1');
							$("#body-overlay").hide();
							
						swal("Successfully Added!", {
								icon: 'success',
								buttons: false,
								timer: 2000,
							});
						},
						error: function() 
						{
							swal('Error','Error Processing Request ','error');
						} 	        
					});
				}
			});
		}else{swal('Error on Description','Please input description','error');}
		//}else{swal('Error on Hours','Please input total numbers of hours per week','error');}
		}else{swal('Error on Title','Please input title','error');}
	}
	
	
	function monday(){
		var checkbox = document.getElementById('monday_');
		var monday_time_in = object('monday_time_in').value;
		var monday_time_out = object('monday_time_out').value;
		monday_day = 'Monday';
		
		if(checkbox.checked){
			loadSubContent('page_load/addreport_tmp_dtr.php?d1='+checkbox.value+'&monday_day='+monday_day
								+'&monday_time_in='+monday_time_in+'&monday_time_out='+monday_time_out,'bebi');
		} else {
			loadSubContent('page_load/addreport_tmp_dtr.php?monday_del='+checkbox.value+'&del='+monday_day,'bebi');
		}
	}
	
	function tuesday(){
		var checkbox = document.getElementById('tuesday_');
		var monday_time_in = object('tuesday_time_in').value;
		var monday_time_out = object('tuesday_time_out').value;
		monday_day = 'Tuesday';
		
		if(checkbox.checked){
			loadSubContent('page_load/addreport_tmp_dtr.php?d2='+checkbox.value+'&monday_day='+monday_day
								+'&monday_time_in='+monday_time_in+'&monday_time_out='+monday_time_out,'bebi');
		} else {
			loadSubContent('page_load/addreport_tmp_dtr.php?monday_del='+checkbox.value+'&del='+monday_day,'bebi');
		}
	}
	
	function wednesday(){
		var checkbox = document.getElementById('wednesday_');
		var monday_time_in = object('wednesday_time_in').value;
		var monday_time_out = object('wednesday_time_out').value;
		monday_day = 'Wednesday';
		
		if(checkbox.checked){
			loadSubContent('page_load/addreport_tmp_dtr.php?d3='+checkbox.value+'&monday_day='+monday_day
								+'&monday_time_in='+monday_time_in+'&monday_time_out='+monday_time_out,'bebi');
		} else {
			loadSubContent('page_load/addreport_tmp_dtr.php?monday_del='+checkbox.value+'&del='+monday_day,'bebi');
		}
	}
	
	function thursday(){
		var checkbox = document.getElementById('thursday_');
		var monday_time_in = object('thursday_time_in').value;
		var monday_time_out = object('thursday_time_out').value;
		monday_day = 'Thursday';
		
		if(checkbox.checked){
			loadSubContent('page_load/addreport_tmp_dtr.php?d4='+checkbox.value+'&monday_day='+monday_day
								+'&monday_time_in='+monday_time_in+'&monday_time_out='+monday_time_out,'bebi');
		} else {
			loadSubContent('page_load/addreport_tmp_dtr.php?monday_del='+checkbox.value+'&del='+monday_day,'bebi');
		}
	}
	
	function friday(){
		var checkbox = document.getElementById('friday_');
		var monday_time_in = object('friday_time_in').value;
		var monday_time_out = object('friday_time_out').value;
		monday_day = 'Friday';
		
		if(checkbox.checked){
			loadSubContent('page_load/addreport_tmp_dtr.php?d5='+checkbox.value+'&monday_day='+monday_day
								+'&monday_time_in='+monday_time_in+'&monday_time_out='+monday_time_out,'bebi');
		} else {
			loadSubContent('page_load/addreport_tmp_dtr.php?monday_del='+checkbox.value+'&del='+monday_day,'bebi');
		}
	}
	
	
	
	
	function save_type(){
		var typeid = object('typeid').value;
			
			swal({
				title: 'Basic Information',
				text: 'Are you sure you want to update your information?',
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			.then((willAdd) => {
				if (willAdd) {				
				x = 'page_load/profile.php?typeid='+typeid;			
					$.ajax({
						url: x, 
						type: "GET",
						beforeSend: function(){$("#body-overlay").show();},
						contentType: false,
						processData:false,
						success: function(data)
						{
						
						$("#content").html(data);
						$("#content").css('opacity','1');
							$("#body-overlay").hide();
							
						swal("Successfully Updated!", {
								icon: 'success',
								buttons: false,
								timer: 2000,
							});
						},
						error: function() 
						{
							swal('Error','Error Processing Request ','error');
						} 	        
					});
				}
			});
	}
	
	
	
	function save_skills(){	
		var set_skills = object('set_skills').value;
			swal({
				title: 'Skills',
				text: 'Do you want to save it?',
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			.then((willAdd) => {
				if (willAdd) {			
				x = 'page_load/profile.php?get_skills='+encodeURIComponent(set_skills);			
					$.ajax({
						url: x, 
						type: "GET",
						beforeSend: function(){$("#body-overlay").show();},
						contentType: false,
						processData:false,
						success: function(data)
						{
						
						$("#content").html(data);
						$("#content").css('opacity','1');
							$("#body-overlay").hide();
							
						swal("Successfully Added!", {
								icon: 'success',
								buttons: false,
								timer: 2000,
							});
						},
						error: function() 
						{
							swal('Error','Error Processing Request ','error');
						} 	        
					});
				}
			});
	}

	function save_other(){	
		var set_other = object('set_other').value;
			swal({
				title: 'Other Information',
				text: 'Do you want to save it?',
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			.then((willAdd) => {
				if (willAdd) {			
				x = 'page_load/profile.php?get_other='+encodeURIComponent(set_other);			
					$.ajax({
						url: x, 
						type: "GET",
						beforeSend: function(){$("#body-overlay").show();},
						contentType: false,
						processData:false,
						success: function(data)
						{
						
						$("#content").html(data);
						$("#content").css('opacity','1');
							$("#body-overlay").hide();
							
						swal("Successfully Added!", {
								icon: 'success',
								buttons: false,
								timer: 2000,
							});
						},
						error: function() 
						{
							swal('Error','Error Processing Request ','error');
						} 	        
					});
				}
			});
	}
	
	function save_feedback(companyid){
	    var description = object('description').value;
		var rating = document.querySelector('input[name="rating_option"]:checked');
		var rating = document.querySelector('input[name="rating"]:checked');
		
		
		if (rating!=null) {
				rating = rating.value;
		}
		//if (max_apply !== '') {
			let myForm = new FormData();
			myForm.append('description', description);
			
		
			swal({
				title: "Adding Feedback",
				text: "Are you sure want to comment this feedback?",
				icon: "info",
				buttons: true,
				dangerMode: true,
			})
			.then((willAdd) => {
				if (willAdd) {
					TINY.box.show({
					html: 'Processing Request',
					animate: false,
					close: false,
					mask: false,
					boxid: 'success',
					autohide: 1
				});
					$.ajax({
						url: 'page_load/company.php?getcompany='+companyid+'&description='+description+'&rating='+rating,
						type: "POST",
						data: myForm,
						beforeSend: function () {$("#body-overlay").show();},
						contentType: false,
						processData: false,
						success: function (data) {
							$("#content").html(data);
							$("#content").css('opacity', '1');
							$("#body-overlay").hide();
						   
							swal("Successfully Added!", {
								icon: 'success',
								buttons: false,
								timer: 2000,
							});
							object('description').value = '';
							

						},
						error: function () {
							swal("Error", {
								icon: 'error',
								buttons: false,
								timer: 2000,
							});
						}
					});
				} else {}
			});		
		//}else{swal('Error on Max Apply','Please input the maximum applicants per company','error');}
		
	}
	
	
	function accept_company(idnum,companyid,courseid,sectionid){
		//var getname = object('getname'+applicationid).value;
			swal({
				title: 'Approving Application',
				text: 'Are you sure you that you accepted by this Company ?',
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			.then((willAdd) => {
				if (willAdd) {	
					//swal('Success','Successfully Accept','success');
					loadPage('page_load/verifycompany.php?idnum='+idnum
										+'&courseid='+courseid
										+'&sectionid='+sectionid
										+'&companyid='+companyid,'content');
				}
			});
	}
	
	//reject_company
	function reject_company(idnum){
		//var getname = object('getname'+applicationid).value;
			swal({
				title: 'Reject Application',
				text: 'Are you sure you that you have rejected by this Company ?',
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			.then((willAdd) => {
				if (willAdd) {	
					swal('Success','Rejected','info');
					loadPage('page_load/verifycompany.php?reject='+idnum,'content');
				}
			});
	}
	
	function upload_certificate_completion(studentid){
	    var firstname = object('firstname').value;
		var picInput = document.getElementById('pic_c');
		var picFile = picInput.files[0];
			let myForm = new FormData();
			myForm.append('firstname', firstname);
			myForm.append('pic_c', picFile);
		
			swal({
				title: "Certificate of Completion",
				text: "Are you sure that this certification is legit?",
				icon: "info",
				buttons: true,
				dangerMode: true,
			})
			.then((willAdd) => {
				if (willAdd) {
				TINY.box.show({
					html: 'Processing Request',
					animate: false,
					close: false,
					mask: false,
					boxid: 'success',
					autohide: 2
				});	
					$.ajax({
						url: 'page_load/profile.php?get_certification_completion',
						type: "POST",
						data: myForm,
						beforeSend: function () {$("#body-overlay").show();},
						contentType: false,
						processData: false,
						success: function (data) {
							$("#content").html(data);
							$("#content").css('opacity', '1');
							$("#body-overlay").hide();
						   
							swal("Successfully Updated!", {
								icon: 'success',
								buttons: false,
								timer: 2000,
							});

						},
						error: function () {
							Swal('Error', 'Error Processing Request', 'error');
						}
					});
				} else {}
			});		
	}
	
	function save_me(actid) {
		var checkbox = document.getElementById('me' + actid);
		
		if (checkbox.checked) {
			loadSubContent('page_load/addreport_tmp.php?actid=' + checkbox.value + '&actids=' + actid, 'show_');
			} else {
				loadSubContent('page_load/addreport_tmp.php?actidtodelete=' + checkbox.value+'&del=' + actid, 'show_');
			}
	}

	
	</script>
</head>
<body>

    <div id="sideNav"><!--onclick="loadPage('page_load/home.php','content')"-->
        <img id="sideNavLogo" src="images/PUPLogo.png" alt="Logo">
        <a href="javascript:void();" style="font-family:arial narrow;" onclick="window.location.reload()"><i class="fas fa-home"></i> Home</a>
        <a href="javascript:void();" style="font-family:arial narrow;" onclick="loadPage('page_load/profile.php','content')"><i class="fas fa-user"></i> Profile</a>
        <a href="javascript:void();" style="font-family:arial narrow;" onclick="loadPage('page_load/report.php','content')"><i class="fas fa-chart-bar"></i>OJT Report</a>
        <a href="javascript:void();" style="font-family:arial narrow;" onclick="loadPage('page_load/company.php','content')"><i class="fas fa-building"></i>Company</a>
		<a href="javascript:void();" style="font-family:arial narrow;" onclick="loadPage('page_load/endorsement_entry.php','content');"><i class="fas fa-check-circle"></i> Endorsement</a>
		<a href="javascript:void();" style="font-family:arial narrow;" onclick="loadPage('page_load/verifycompany.php','content')"><i class="fas fa-building"></i>Apply</a>
		
		<a href="javascript:void();" style="font-family:arial narrow;" onclick="logout();"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
	<? echo '<div id="body-overlay"><div><img src="images/processing.gif" width="80%" /></div></div>'; ?>
    <div id="content">
		<div class="content" > 
				<div>
					<div class="headline">ENHANCE OJT WITH <br> OUR ADVANCED <br> MONITORING SYSTEM</div>
					<p>Polytechnic University's CCIS department leverages our state-of-the-art<br> OJT monitoring system to streamline and enhance the on-the-job training experience.</p>
					<? $link = "TINY.box.show({url:'page_load/home.php',width:700,height:650 })";?>
					<button id="guideButton" onclick="<?=$link?>">OJT GUIDE</button>
				</div>
			</div>
	</div>

</body>
</html>