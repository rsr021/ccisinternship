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

	<title>Faculty | Panel</title>
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
	
	function object(id){return document.getElementById(id);}
	
	function updateinfo(){
	    var firstname = object('firstname').value;
	    var middlename = object('middlename').value;
	    var lastname = object('lastname').value;
	    var courseid = object('courseid').value;
	    var sectionid = object('sectionid').value;
		
		var picInput = document.getElementById('pic');
		var picFile = picInput.files[0];

		if (firstname !== '') {
		if (courseid != 0) {
		if (sectionid != 0) {
			let myForm = new FormData();
			myForm.append('firstname', firstname);
			myForm.append('middlename', middlename);
			myForm.append('lastname', lastname);
			myForm.append('courseid', courseid);
			myForm.append('sectionid', sectionid);
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
					$.ajax({
						url: 'faculty/profile.php',
						type: "POST",
						data: myForm,
						beforeSend: function () {$("#body-overlay").show();},
						contentType: false,
						processData: false,
						success: function (data) {
							$("#maincontent").html(data);
							$("#maincontent").css('opacity', '1');
							$("#body-overlay").hide();
						   
							swal("Successfully Updated!", {
								icon: 'success',
								buttons: false,
								timer: 2000,
							});

						},
						error: function () {
							Swal.fire('Error', 'Error Processing Request', 'error');
						}
					});
				} else {}
			});		
		}else{swal('Error on Section','Please select section','error');}
		}else{swal('Error on Course','Please select course','error');}
		}else{swal('Error on First Name','Please input first name','error');}
	}
	
	function assign_president(studentid){
		
			swal({
				title: 'Assigning Class President',
				text: 'Are you sure you want to assign this student?',
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			.then((willAdd) => {
				if (willAdd) {	

					swal("Successfully Updated!", {
								icon: 'success',
								buttons: false,
								timer: 2000,
							});
					x = 'faculty/classrep.php?studentid='+studentid;			
					loadPage(x,'maincontent');
				}
			});
	}
	
	function is_ojt_start(studentid){
		var studentname = object('studentname'+studentid).value;
			swal({
				title: 'On-the-job Training',
				text: 'Click OK if Mr./Ms. ' + studentname + '\'s OJT has started.',
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			.then((willAdd) => {
				if (willAdd) {			
				x = 'faculty/classrep.php?get_ss='+studentid+'&ss='+studentid;			
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
							
						swal('Success','Successfully updated','success');
						},
						error: function() 
						{
							swal('Error','Error Processing Request ','error');
						} 	        
					});
				}
			});
	}
	
	//is_ojt_end
	function is_ojt_end(studentid){
		var studentname = object('studentname'+studentid).value;
			swal({
				title: 'On-the-job Training',
				text: 'Click OK if Mr./Ms. ' + studentname + '\'s OJT has ended.',
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			.then((willAdd) => {
				if (willAdd) {			
				x = 'faculty/classrep.php?get_ending='+studentid;			
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
							
						swal('Success','Successfully updated','success');
						},
						error: function() 
						{
							swal('Error','Error Processing Request ','error');
						} 	        
					});
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
				  <img height="50" src="images/PUPLogo.png">&nbsp;<span class="align-middle">Faculty</span>
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
						<a class="sidebar-link" href="javascript:void();" onclick="loadPage('faculty/studentlist.php','maincontent'); setActive(this);">
							<i class="align-middle" data-feather="list"></i> <span class="align-middle">OJT List</span>
						</a>
					</li>
					
					<li class="sidebar-item">
						<a class="sidebar-link" href="javascript:void();" onclick="loadPage('faculty/classrep.php','maincontent'); setActive(this);">
							  <i class="align-middle" data-feather="users"></i> <span class="align-middle">Student List</span>
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
								<a class="dropdown-item" href="javascript:void();" 
								onclick="loadPage('faculty/profile.php','maincontent')"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
								<div class="dropdown-divider"></div>
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
							<div class="w-100">
								<div class="row">
									<div class="col-sm-6">
										<div class="card">
											<div class="card-body">
												<div class="row">
												<? $is_ojt = GetValue('SELECT COUNT(studentid) FROM tblstudent WHERE courseid='.
													$_SESSION['courseid'].' AND sectionid='.
													$_SESSION['sectionid'].' AND is_ojt=1'); ?>
													
												<? $is_ojt_no = GetValue('SELECT COUNT(studentid) FROM tblstudent WHERE courseid='.
																				$_SESSION['courseid'].' AND sectionid='.
																				$_SESSION['sectionid'].' AND is_ojt=0 AND is_end=0'); ?>
												<? $is_ojt_yes = GetValue('SELECT COUNT(studentid) FROM tblstudent WHERE courseid='.
																				$_SESSION['courseid'].' AND sectionid='.
																				$_SESSION['sectionid'].' AND is_ojt=1 AND is_end=1'); ?>
												<? $ccc = GetValue('SELECT COUNT(studentid) FROM tblstudent WHERE courseid='.
																				$_SESSION['courseid'].' AND sectionid='.
																				$_SESSION['sectionid'].''); ?>
												<div class="col mt-0">
														<h5 class="card-title">OJT STUDENTS</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="book"></i>

														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3"><?=$is_ojt?></h1>
												<div class="mb-0">
													<span class="text-muted">&nbsp;</span>
												</div>
											</div>
										</div>
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">FINISHED OJT</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="check-circle"></i>

														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3"><?=$is_ojt_yes?></h1>
												<div class="mb-0">
													<span class="text-muted">&nbsp;</span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">NO OJT</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="alert-circle"></i>

														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3"><?=$is_ojt_no?></h1>
												<div class="mb-0">
													<span class="text-muted">&nbsp;</span>
												</div>
											</div>
										</div>

										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">CLASS SIZE </h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="users"></i>

														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3"><?=$ccc?></h1>
												<div class="mb-0">
													<span class="text-muted">&nbsp;</span>
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
    /*var ctx = document.getElementById('companyRatingsChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["OJT", "OJT_NO", "OJT_YES", "CCC"],
            datasets: [
                {
                    label: 'OJT',
                    data: [<?php echo $is_ojt; ?>],
                    backgroundColor: 'rgba(255, 0, 0, 0.2)',
                    borderColor: 'rgba(255, 0, 0, 1)',
                    borderWidth: 1
                },
                {
                    label: 'OJT_NO',
                    data: [<?php echo $is_ojt_no; ?>],
                    backgroundColor: 'rgba(0, 255, 0, 0.2)',
                    borderColor: 'rgba(0, 255, 0, 1)',
                    borderWidth: 1
                },
                {
                    label: 'OJT_YES',
                    data: [<?php echo $is_ojt_yes; ?>],
                    backgroundColor: 'rgba(0, 0, 255, 0.2)',
                    borderColor: 'rgba(0, 0, 255, 1)',
                    borderWidth: 1
                },
                {
                    label: 'CCC',
                    data: [<?php echo $ccc; ?>],
                    backgroundColor: 'rgba(255, 255, 0, 0.2)',
                    borderColor: 'rgba(255, 255, 0, 1)',
                    borderWidth: 1
                }
            ]
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
                        maxRotation: 45,
                        minRotation: 45,
                        font: {
                            size: 0
                        }
                    }
                }
            }
        }
    });*/
</script>

<?php
    // Fetch data for OJT, OJT_NO, OJT_YES, and CCC
    $is_ojt = GetValue('SELECT COUNT(studentid) FROM tblstudent WHERE courseid=' . $_SESSION['courseid'] . ' AND sectionid=' . $_SESSION['sectionid'] . ' AND is_ojt=1');
    $is_ojt_no = GetValue('SELECT COUNT(studentid) FROM tblstudent WHERE courseid=' . $_SESSION['courseid'] . ' AND sectionid=' . $_SESSION['sectionid'] . ' AND is_ojt=0 AND is_end=0');
    $is_ojt_yes = GetValue('SELECT COUNT(studentid) FROM tblstudent WHERE courseid=' . $_SESSION['courseid'] . ' AND sectionid=' . $_SESSION['sectionid'] . ' AND is_ojt=1 AND is_end=1');
    $ccc = GetValue('SELECT COUNT(studentid) FROM tblstudent WHERE courseid=' . $_SESSION['courseid'] . ' AND sectionid=' . $_SESSION['sectionid']);
?>

<script>
    // Use the fetched data to create a bar graph
    var ctx = document.getElementById('companyRatingsChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["OJT", "OJT_NO", "OJT_YES", "CCC"],
            datasets: [
                {
                    label: 'Student Statistics',
                    data: [
                        <?php echo $is_ojt; ?>,
                        <?php echo $is_ojt_no; ?>,
                        <?php echo $is_ojt_yes; ?>,
                        <?php echo $ccc; ?>
                    ],
                    backgroundColor: ['rgba(255, 0, 0, 0.2)', 'rgba(0, 255, 0, 0.2)', 'rgba(0, 0, 255, 0.2)', 'rgba(255, 255, 0, 0.2)'],
                    borderColor: ['rgba(255, 0, 0, 1)', 'rgba(0, 255, 0, 1)', 'rgba(0, 0, 255, 1)', 'rgba(255, 255, 0, 1)'],
                    borderWidth: 1
                }
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    max: <?php echo max([$is_ojt, $is_ojt_no, $is_ojt_yes, $ccc]); ?>
                },
                x: {
                    ticks: {
                        autoSkip: false,
                        maxRotation: 45,
                        minRotation: 45,
                        font: {
                            size: 0
                        }
                    }
                }
            }
        }
    });
</script>

						
						
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