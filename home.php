<?
session_start();
if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }


	$select = mysqli_query($db_connection, "SELECT * FROM tblfaculty WHERE facultyid = '$_SESSION[facultyid]'  ");
    $count = mysqli_num_rows($select);

    if($count == 0) {
      header("location:./");			
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="icon" href="images/PUPLogo.png" type="image/ico">
	<link rel="canonical" href="https://demo-basic.adminkit.io/" />

	<title>Coordinator | Panel</title>
	<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
	<link href="css/blaire.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	<!--Darren-->
	<!--<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>-->
	<script src="js/sweetalert.min.js"></script>
	 <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
	<script src="js/tinybox.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
	
	<script type='text/javascript' src='js/tinybox.js'></script>

	<script>

        function setActive(element) {
            var sidebarItems = document.getElementsByClassName('sidebar-item');
            for (var i = 0; i < sidebarItems.length; i++) {
                sidebarItems[i].classList.remove('active');
            }
            element.closest('.sidebar-item').classList.add('active');
        }
		
		function setActiveLink(link) {
			var links = document.querySelectorAll('a');
			links.forEach(function (a) {
				a.classList.remove('active'); 
			});
			link.classList.add('active');
		}
		
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
	
	function object(id){return document.getElementById(id);}
	
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
				window.location.href = 'session_user/logoutemployee.php';
			} else {}
		});
	}	
	/*
	
	
$link = "TINY.box.show({url:'pages/viewcor.php?studentid=".$rw['studentid']."',width:900,height:500 })";



onclick="openCustom(\'forms/infosheet.php?studentid='.secureData($rw['studentid']).'\',1000,1000)"            
$studentid = secureData($_GET['studentid'],'d');
*/	
	
	// data table plugin
	/*new DataTable('#example', {
	  info: true,
	  ordering: true,
	  paging: true,
	  scrollCollapse: false,
	  // scrollY: '350px',
	  language: {
		searchPlaceholder: "Search records....."
	  },
	});
	
	*/
	
	
	
	
	function assign_section(facultyid){
		var sectionid = object('sectionid').value;
		var name = object('name').value;
		
		if (sectionid !== 0) {
			swal({
				title: 'Assigning Section',
				text: 'Are you sure you want assign this section to ' +name+' ?',
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
				x = 'pages/faculty.php?facultyid='+facultyid+'&sectionid='+sectionid;			
					$.ajax({
						url: x, 
						type: "GET",
						beforeSend: function(){$("#body-overlay").show();},
						contentType: false,
						processData:false,
						success: function(data)
						{
						
						$("#maincontent").html(data);
						$("#maincontent").css('opacity','1');
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
		}else{swal('Error on Student','Please Input Student if you\'re trying to make a referral','error');}
	}

	function addedit_section(sectionid){
		var sectioncode = object('sectioncode').value;
		var courseid = object('courseid').value;
		var max_apply = object('max_apply').value;
		var max_slots = object('max_slots').value;
		var action = 'Add';
		if (sectionid) { action = 'Update';}
		
		if (sectioncode !== '') {
			swal({
				title: 'Adding Section',
				text: 'Are you sure you want to '+action+' this section?',
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			.then((willAdd) => {
				if (willAdd) {	
				/*TINY.box.show({
					html: 'Processing Request',
					animate: false,
					close: false,
					mask: false,
					boxid: 'success',
					autohide: 2
				});*/				
				x = 'pages/section.php?sectionid='+sectionid+'&sectioncode='+encodeURIComponent(sectioncode)
									+'&courseid='+courseid+'&max_apply='+max_apply+'&max_slots='+max_slots;			
					$.ajax({
						url: x, 
						type: "GET",
						beforeSend: function(){$("#body-overlay").show();},
						contentType: false,
						processData:false,
						success: function(data)
						{
						
						$("#maincontent").html(data);
						$("#maincontent").css('opacity','1');
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
		}else{swal('Error on Section Code','Please section code','error');}
	}
	
	//companycode, companyname, signatory, position, address, notarizationdate, max_apply
	function addcompany(){
	    var companycode = object('companycode').value;
	    var companyname = object('companyname').value;
	    var signatory = object('signatory').value;
	    var position = object('position').value;
	    var address = object('address').value;
	    var notarizationdate = object('notarizationdate').value;
	    var max_apply = object('max_apply').value;
	    var start_date = object('start_date').value;
	    var end_date = object('end_date').value;
		var company_link = object('company_link').value;
		var picInput = document.getElementById('moa_img');
		var picFile = picInput.files[0];
		
		var provid = object('provid').value;
	    var cityid = object('cityid').value;
		var brgyid = object('brgyid').value;
		var typeid = object('typeid').value;

		if (companyname !== '') {
		if (signatory !== '') {
		if (position !== '') {
		//if (address !== '') {
		//if (max_apply !== '') {
		if (provid !=0) {	
		if (cityid != 0) {	
		if (brgyid != 0) {	
		if (typeid != 0) {	
		//if (address !== '') {
			let myForm = new FormData();
			myForm.append('companycode', companycode);
			myForm.append('companyname', companyname);
			myForm.append('signatory', signatory);
			myForm.append('position', position);
			myForm.append('address', address);
			myForm.append('notarizationdate', notarizationdate);
			myForm.append('max_apply', max_apply);
			myForm.append('start_date', start_date);
			myForm.append('end_date', end_date);
			myForm.append('company_link', company_link);
			myForm.append('moa_img', picFile);
			
			myForm.append('provid', provid);
			myForm.append('cityid', cityid);
			myForm.append('brgyid', brgyid);
			myForm.append('typeid', typeid);
			
		
			swal({
				title: "Adding Company",
				text: "Are you sure want to add this company?",
				icon: "info",
				buttons: true,
				dangerMode: true,
			})
			.then((willAdd) => {
				if (willAdd) {
					$.ajax({
						url: 'pages/company.php?paula',
						type: "POST",
						data: myForm,
						beforeSend: function () {$("#body-overlay").show();},
						contentType: false,
						processData: false,
						success: function (data) {
							$("#maincontent").html(data);
							$("#maincontent").css('opacity', '1');
							$("#body-overlay").hide();
						   
							swal("Successfully Added!", {
								icon: 'success',
								buttons: false,
								timer: 2000,
							});

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
		}else{swal('Error on Intern Type','Please select internship type','error');}
		}else{swal('Error on Barangay','Please select barangay','error');}
		}else{swal('Error on City','Please select city','error');}
		}else{swal('Error on Province','Please select province','error');}
		}else{swal('Error on Position','Please input position','error');}
		}else{swal('Error on Signatory','Please input signatory','error');}
		}else{swal('Error on Company Name','Please input company name','error');}
	}
	
	//companycode, companyname, signatory, position, address, notarizationdate, max_apply
	function updatecompany(companyid){
	    var companycode = object('companycode').value;
	    var companyname = object('companyname').value;
	    var signatory = object('signatory').value;
	    var position = object('position').value;
	    var address = object('address').value;
	    var notarizationdate = object('notarizationdate').value;
	    var max_apply = object('max_apply').value;
	    var start_date = object('start_date').value;
	    var end_date = object('end_date').value;
		var company_link = object('company_link').value;
		var picInput = document.getElementById('moa_img');
		var picFile = picInput.files[0];
		
		var provid = object('provid').value;
	    var cityid = object('cityid').value;
		var brgyid = object('brgyid').value;
		var typeid = object('typeid').value;

		if (companyname !== '') {
		if (signatory !== '') {
		if (position !== '') {
		if (provid !== '') {
		//if (max_apply !== '') {
			let myForm = new FormData();
			myForm.append('companycode', companycode);
			myForm.append('companyname', companyname);
			myForm.append('signatory', signatory);
			myForm.append('position', position);
			myForm.append('address', address);
			myForm.append('notarizationdate', notarizationdate);
			myForm.append('max_apply', max_apply);
			myForm.append('start_date', start_date);
			myForm.append('end_date', end_date);
			myForm.append('company_link', company_link);
			myForm.append('moa_img', picFile);
			
			myForm.append('provid', provid);
			myForm.append('cityid', cityid);
			myForm.append('brgyid', brgyid);
			myForm.append('typeid', typeid);
		
			swal({
				title: "Adding Company",
				text: "Are you sure want to add this company?",
				icon: "info",
				buttons: true,
				dangerMode: true,
			})
			.then((willAdd) => {
				if (willAdd) {
					$.ajax({
						url: 'pages/company.php?blaire&companyid='+companyid,
						type: "POST",
						data: myForm,
						beforeSend: function () {$("#body-overlay").show();},
						contentType: false,
						processData: false,
						success: function (data) {
							$("#maincontent").html(data);
							$("#maincontent").css('opacity', '1');
							$("#body-overlay").hide();
						   
							swal("Successfully Added!", {
								icon: 'success',
								buttons: false,
								timer: 2000,
							});

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
		}else{swal('Error on Address','Please complete the address','error');}
		}else{swal('Error on Position','Please input position','error');}
		}else{swal('Error on Signatory','Please input signatory','error');}
		}else{swal('Error on Company Name','Please input company name','error');}
	}
	
	
	
	function approve_student(applicationid){
		var getname = object('getname'+applicationid).value;
			swal({
				title: 'Approving Application',
				text: 'Are you sure you want to approve the application of ' +getname+' ?',
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			.then((willAdd) => {
				if (willAdd) {				
				x = 'students/getstudents.php?applicationid='+applicationid;			
				loadPage(x,'showy'+applicationid);
				}
			});
	}
	//reject_student
	function reject_student(applicationid){
		var getname = object('getname'+applicationid).value;
			swal({
				title: 'Rejecting Application',
				text: 'Are you sure you want to reject the application of ' +getname+' ?',
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			.then((willAdd) => {
				if (willAdd) {				
				x = 'students/getreject.php?applicationid='+applicationid;			
				loadPage(x,'showy'+applicationid);
				}
			});
	}
	//send_endorsement
	/*function send_endorsement(studentid){
	var companyid = object('companyid'+studentid).value;
	var courseid = object('courseid'+studentid).value;
	var sectionid = object('sectionid'+studentid).value;
			swal({
				title: 'Sending Endorsement Letter',
				text: 'Are you sure you want to send this endorsement?',
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
				
				x = 'students/test.php?insertendorsement='+studentid+'&companyid='+companyid
												+'&courseid='+courseid+'&sectionid='+sectionid;			
				loadPage(x,'maincontent');
				}
			});
	}*/
	
	function send_endorsementV2(studentid){
	var companyid = object('companyid'+studentid).value;
	var courseid = object('courseid'+studentid).value;
	var sectionid = object('sectionid'+studentid).value;
			swal({
				title: 'Sending Endorsement Letter',
				text: 'Are you sure you want to send this endorsement?',
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
				
				x = 'students/send_endorseV2.php?insertendorsement='+studentid+'&companyid='+companyid
												+'&courseid='+courseid+'&sectionid='+sectionid;			
				loadPage(x,'maincontent');
				}
			});
	}
	
	//send_notification
	function send_notification(facultyid){
	
	var textmes = object('textmes').value;
	
			swal({
				title: 'Notifying Faculty',
				text: 'Are you sure you want to send this email?',
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
				
				x = 'pages/stat.php?xxx='+facultyid+'&textmes='+encodeURIComponent(textmes);			
				loadPage(x,'maincontent');
				}
			});
	}
	 
	</script>
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
		
		
		
	</style>
</head>
<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="javascript:void();"  onclick="window.location.reload();">
				<div class="sidebar-brand-icon">
				  <img height="50" src="images/PUPLogo.png">&nbsp;<span class="align-middle">Coordinator</span>
				</div>
					
				</a>

				<ul class="sidebar-nav">
					

					<li class="sidebar-item active">
						<a class="sidebar-link" href="javascript:void();" onclick="location.reload()">
							<i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
						</a>
					</li>
				<li class="sidebar-header">
						Menu
					</li>
					<li class="sidebar-item">
    <a class="sidebar-link" href="javascript:void();" onclick="loadPage('students/students_tmp.php','maincontent'); setActive(this);">
        <i class="align-middle" data-feather="user"></i> <span class="align-middle">Printable Application</span>
    </a>
</li>

					
					<li class="sidebar-item">
    <a class="sidebar-link" href="javascript:void();" onclick="loadPage('students/send_endorseV2.php','maincontent'); setActive(this);">
        <i class="align-middle" data-feather="send"></i> <span class="align-middle">Application Entry</span>
    </a>
</li>


						
				<li class="sidebar-item">
    <a class="sidebar-link" href="javascript:void();" onclick="loadPage('students/students.php','maincontent'); setActive(this);">
        <i class="align-middle" data-feather="list"></i> <span class="align-middle">Master List</span>
    </a>
</li>

<li class="sidebar-item">
    <a class="sidebar-link" href="javascript:void();" onclick="loadPage('students/ojt_students.php','maincontent'); setActive(this);">
        <i class="align-middle" data-feather="users"></i> <span class="align-middle">OJT Students</span>
    </a>
</li>

			
					
					<li class="sidebar-header">
						Setup Manager
					</li>


					<li class="sidebar-item">
    <a class="sidebar-link" href="javascript:void();" onclick="loadPage('students/liststudents.php','maincontent'); setActive(this);">
        <i class="align-middle" data-feather="list"></i> <span class="align-middle">List of Students</span>
    </a>
</li>

<li class="sidebar-item">
    <a class="sidebar-link" href="javascript:void();" onclick="loadPage('pages/company.php?companyid=0','maincontent'); setActive(this);">
        <i class="align-middle" data-feather="briefcase"></i> <span class="align-middle">Company</span>
    </a>
</li>

<li class="sidebar-item">
    <a class="sidebar-link" href="javascript:void();" onclick="loadPage('pages/stat.php','maincontent'); setActive(this);">
        <i class="align-middle" data-feather="bar-chart-2"></i> <span class="align-middle">Statistic</span>
    </a>
</li>

<li class="sidebar-item">
    <a class="sidebar-link" href="javascript:void();" onclick="loadPage('pages/faculty.php','maincontent'); setActive(this);">
        <i class="align-middle" data-feather="users"></i> <span class="align-middle">Faculty List</span>
    </a>
</li>

<li class="sidebar-item">
    <a class="sidebar-link" href="javascript:void();" onclick="loadPage('pages/section.php?sectionid=0','maincontent'); setActive(this);">
        <i class="align-middle" data-feather="book"></i> <span class="align-middle">Sections</span>
    </a>
</li>

				</ul>	
			</div>
		</nav>

		<div class="main">
			<nav class="navbar navbar-expand navbar-d navbar-bg">
				<a style="text-decoration:none;" class="sidebar-toggle js-sidebar-toggle">
            <i class="fas fa-bars"></i>
        </a>

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
	
						
						
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
								<i class="align-middle" data-feather="settings"></i>
							</a>

							<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
								<!--<img src="images/acuna.jpg" class="avatar img-fluid rounded me-1" alt="Charles Hall" /> -->
								<span class="text-dark"><?=FacultyName($_SESSION['facultyid'])?></span>
							</a>
							<div class="dropdown-menu dropdown-menu-end">
								<!--<a class="dropdown-item" href="pages-profile.html"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
								<a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="pie-chart"></i> Analytics</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="index.html"><i class="align-middle me-1" data-feather="settings"></i> Settings & Privacy</a>
								<a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="help-circle"></i> Help Center</a>
								<div class="dropdown-divider"></div>-->
								<a class="dropdown-item"  href="javascript:void()" onclick="logout();">Log out</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>

			<main  class="content">
			<div id="body-overlay"></div>
				<div id="maincontent" class="container-fluid p-0">
				<div id="body-overlay"></div>
				
					<h1 class="h3 mb-3"><strong>Dashboard</strong></h1>
	
					<div class="row">
						<div class="col-xl-6 col-xxl-5 d-flex">
						<? $completed = GetValue('SELECT COUNT(studentid) FROM tblstudent WHERE is_updated=1'); ?>
						<? $count = GetValue('SELECT COUNT(studentid) FROM tblstudent'); ?>
						<? $incomplete = GetValue('SELECT COUNT(studentid) FROM tblstudent WHERE is_updated=0'); ?>
							<div class="w-100">
								<div class="row">
									<div class="col-sm-6">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">OJT STUDENTS</h5>
													</div>
													<? $ojt = GetValue('SELECT COUNT(studentid) FROM tblstudent WHERE is_ojt=1'); ?>
													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="briefcase"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3"><?=$ojt?></h1>
												<div class="mb-0">
													<span hidden class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -3.65% </span>
													<span class="text-muted">Out of <b><?=$count?></b> students.</span>
												</div>
											</div>
										</div>
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Incomplete with their requirements</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="alert-triangle"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3"><?=$incomplete?></h1>
												<div class="mb-0">
													<span hidden class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> 5.25% </span>
													<span class="text-muted">Out of <b><?=$count?></b> students.</span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">WITHOUT OJT</h5>
													</div>
													<? $without = GetValue('SELECT COUNT(studentid) FROM tblstudent WHERE is_ojt=0'); ?>
													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="user-minus"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3"><?=$without?></h1>
												<div class="mb-0">
													<span hidden class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> 6.65% </span>
													<span class="text-muted">Out of <b><?=$count?></b> students.</span>
												</div>
											</div>
										</div>
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Students Completed Requirements</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="check-circle"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3"><?=$completed?></h1>
												<div class="mb-0">
													<span hidden class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -2.25% </span>
													<span class="text-muted">Out of <b><?=$count?></b> students.</span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<?php
							// Fetch data from the server (Replace this with your PHP code)
							$query = 'SELECT c.companyname, AVG(r.rating) AS avg_rating FROM tblcompany c LEFT JOIN tblrating r ON c.companyid = r.companyid GROUP BY c.companyid ORDER BY avg_rating';
							$rs = mysqli_query($db_connection, $query);
							$companyNames = [];
							$avgRatings = [];

							while ($rw = mysqli_fetch_array($rs)) {
								$companyNames[] = $rw['companyname'];
								$avgRatings[] = number_format($rw['avg_rating'], 2);
							}
						?>

						<div class="col-xl-6 col-xxl-7">
							<!--<div class="card flex-fill w-100">
								<div class="card-header">

									<h5 class="card-title mb-0">Recent Movement</h5>
								</div>
								<div class="card-body py-3">
									<div class="chart chart-sm">
										<canvas id="chartjs-dashboard-line"></canvas>
									</div>
								</div>
							</div>-->
							<canvas id="companyRatingsChart" width="200" height="150"></canvas>
							
						</div>
						
						<script>
    // Use the fetched data to create a bar graph
    var ctx = document.getElementById('companyRatingsChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($companyNames); ?>,
            datasets: [{
                label: 'Average Rating',
                data: <?php echo json_encode($avgRatings); ?>,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    max: 5 
                },
                x: {
                    ticks: {
                        autoSkip: false,
                        maxRotation: 45, // Rotate labels to an angle
                        minRotation: 45, // Minimum rotation angle
                        font: {
                            size: 0 // Adjust the font size as needed
                        }
                    }
                }
            }
        }
    });
</script>
						
					</div>
										<div class="row">
										<div>
											<div class="card flex-fill">
												<div class="card-header">

													<h5 class="card-title mb-0">Newly Deployed Students</h5>
												</div>
												<table class="table table-hover my-0">
													<thead>
														<tr>
															<th>#</th>
															<th>Student Name</th>
															<th class="d-none d-xl-table-cell">Course/Sec</th>
															<th class="d-none d-xl-table-cell">Start Date of Internship</th>
															<th class="d-none d-md-table-cell">VIEW</th>
															<th>Status</th>
														</tr>
													</thead>
													<tbody>
													
													<?
													$c=1;
													$result = mysqli_query($db_connection,'SELECT a.studentid, a.is_ojt,
																	b.start_intern, b.courseid, b.sectionid
																	FROM tblstudent a, tblcompany_ojt b
																	WHERE a.studentid=b.studentid 
																	AND b.is_ojt=1
																	ORDER BY b.start_intern DESC LIMIT 10');
													while($row_cat = mysqli_fetch_array($result)){
														echo'<tr>
															<td>'.$c++.'</td>
															<td class="d-none d-xl-table-cell">'.StudentName($row_cat['studentid']).'</td>
															<td class="d-none d-xl-table-cell">'.CourseCode($row_cat['courseid']).'/'.SectionCode($row_cat['sectionid']).'</td>
															<td class="d-none d-xl-table-cell">'.date('M d, Y',strtotime($row_cat['start_intern'])).'</td>
															<td class="d-none d-md-table-cell">
															<a href="javascript:void()"
															onclick="loadPage(\'students/ojt_students.php\',\'maincontent\')">VIEW</a>
															</td>
															<td><span class="badge bg-success">DEPLOYED</span></td>
														</tr>';
													}
													?>
													</tbody>
												</table>
											</div>
										</div>
										<!--<div class="col-12 col-lg-4 col-xxl-3 d-flex">
											<div class="card flex-fill w-100">
												<div class="card-header">

													<h5 class="card-title mb-0">Monthly Sales</h5>
												</div>
												<div class="card-body d-flex w-100">
													<div class="align-self-center chart chart-lg">
														<canvas id="chartjs-dashboard-bar"></canvas>
													</div>
												</div>
											</div>
										</div>-->
									</div>
						
						
						
						
						
						
						
					</div>

					
					</div>

				</div>
				
				
				
			</main>

			
		</div>
	</div>

	<script src="js/app.js"></script>

	<script>
		document.addEventListener("DOMContentLoaded", function() {
			var ctx = document.getElementById("chartjs-dashboard-line").getContext("2d");
			var gradient = ctx.createLinearGradient(0, 0, 0, 225);
			gradient.addColorStop(0, "rgba(215, 227, 244, 1)");
			gradient.addColorStop(1, "rgba(215, 227, 244, 0)");
			// Line chart
			new Chart(document.getElementById("chartjs-dashboard-line"), {
				type: "line",
				data: {
					labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
					datasets: [{
						label: "Sales ($)",
						fill: true,
						backgroundColor: gradient,
						borderColor: window.theme.primary,
						data: [
							2115,
							1562,
							1584,
							1892,
							1587,
							1923,
							2566,
							2448,
							2805,
							3438,
							2917,
							3327
						]
					}]
				},
				options: {
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					tooltips: {
						intersect: false
					},
					hover: {
						intersect: true
					},
					plugins: {
						filler: {
							propagate: false
						}
					},
					scales: {
						xAxes: [{
							reverse: true,
							gridLines: {
								color: "rgba(0,0,0,0.0)"
							}
						}],
						yAxes: [{
							ticks: {
								stepSize: 1000
							},
							display: true,
							borderDash: [3, 3],
							gridLines: {
								color: "rgba(0,0,0,0.0)"
							}
						}]
					}
				}
			});
		});
	</script>
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			// Pie chart
			new Chart(document.getElementById("chartjs-dashboard-pie"), {
				type: "pie",
				data: {
					labels: ["Chrome", "Firefox", "IE"],
					datasets: [{
						data: [4306, 3801, 1689],
						backgroundColor: [
							window.theme.primary,
							window.theme.warning,
							window.theme.danger
						],
						borderWidth: 5
					}]
				},
				options: {
					responsive: !window.MSInputMethodContext,
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					cutoutPercentage: 75
				}
			});
		});
	</script>
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			// Bar chart
			new Chart(document.getElementById("chartjs-dashboard-bar"), {
				type: "bar",
				data: {
					labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
					datasets: [{
						label: "This year",
						backgroundColor: window.theme.primary,
						borderColor: window.theme.primary,
						hoverBackgroundColor: window.theme.primary,
						hoverBorderColor: window.theme.primary,
						data: [54, 67, 41, 55, 62, 45, 55, 73, 60, 76, 48, 79],
						barPercentage: .75,
						categoryPercentage: .5
					}]
				},
				options: {
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					scales: {
						yAxes: [{
							gridLines: {
								display: false
							},
							stacked: false,
							ticks: {
								stepSize: 20
							}
						}],
						xAxes: [{
							stacked: false,
							gridLines: {
								color: "transparent"
							}
						}]
					}
				}
			});
		});
	</script>
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			var markers = [{
					coords: [31.230391, 121.473701],
					name: "Shanghai"
				},
				{
					coords: [28.704060, 77.102493],
					name: "Delhi"
				},
				{
					coords: [6.524379, 3.379206],
					name: "Lagos"
				},
				{
					coords: [35.689487, 139.691711],
					name: "Tokyo"
				},
				{
					coords: [23.129110, 113.264381],
					name: "Guangzhou"
				},
				{
					coords: [40.7127837, -74.0059413],
					name: "New York"
				},
				{
					coords: [34.052235, -118.243683],
					name: "Los Angeles"
				},
				{
					coords: [41.878113, -87.629799],
					name: "Chicago"
				},
				{
					coords: [51.507351, -0.127758],
					name: "London"
				},
				{
					coords: [40.416775, -3.703790],
					name: "Madrid "
				}
			];
			var map = new jsVectorMap({
				map: "world",
				selector: "#world_map",
				zoomButtons: true,
				markers: markers,
				markerStyle: {
					initial: {
						r: 9,
						strokeWidth: 7,
						stokeOpacity: .4,
						fill: window.theme.primary
					},
					hover: {
						fill: window.theme.primary,
						stroke: window.theme.primary
					}
				},
				zoomOnScroll: false
			});
			window.addEventListener("resize", () => {
				map.updateSize();
			});
		});
	</script>
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			var date = new Date(Date.now() - 5 * 24 * 60 * 60 * 1000);
			var defaultDate = date.getUTCFullYear() + "-" + (date.getUTCMonth() + 1) + "-" + date.getUTCDate();
			document.getElementById("datetimepicker-dashboard").flatpickr({
				inline: true,
				prevArrow: "<span title=\"Previous month\">&laquo;</span>",
				nextArrow: "<span title=\"Next month\">&raquo;</span>",
				defaultDate: defaultDate
			});
		});
	</script>

</body>

</html>