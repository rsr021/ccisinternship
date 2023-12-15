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
	});*/
	
	
	//new DataTable('#example');
	
	function loadPageContent(loc,eid) {
		document.getElementById(eid).innerHTML="<div align='center'><img src='images/loading_image.gif' width='100px' /></div><div align='center'><img src='images/ajax-loader2.gif' width='200px' /></div><div align='center'><span style='color:blue;font-size:14px;font-weight:bold;'>Please Wait.....</span></p></div>";
		loadPage(loc,eid);
	}
	
	function loadSubContent(loc,eid) {
		document.getElementById(eid).innerHTML="<div align='center'><img src='images/ajax-loader3.gif' width='15px' /></div>";
		loadPage(loc,eid);
	}
	
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
	
	

	function object(id) { return document.getElementById(id);}
	function obj(id) { return document.getElementById(id);}
	
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
	
	
	function savePerson() {
		var lastname = object('lastname').value;
		var firstname = object('firstname').value;

		if (lastname !== '') {
			let myform = new FormData();
			myform.append('lastname', lastname);
			myform.append('firstname', firstname);

			Swal.fire({
				title: 'Add User',
				text: 'Are you sure to Process this entry?',
				icon: "warning",
				showCancelButton: true,
				confirmButtonText: 'Yes',
				cancelButtonText: 'No',
				reverseButtons: true
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						url: 'pages/darren.php',
						type: "POST",
						data: myform,
						beforeSend: function () {
							$("#body-overlay").show();
						},
						contentType: false,
						processData: false,
						success: function (data) {
						$("#maincontent").html(data);
						$("#maincontent").css('opacity', '1');
						$("#body-overlay").hide();

						   // Swal.fire('Success', 'Request Successfully Processed.', 'success');
							Swal.fire({
							  position: 'top-end',
							  icon: 'success',
							  title: 'Data has been saved',
							  showConfirmButton: false,
							  timer: 1500
							})
						},
						error: function () {
							Swal.fire('Error', 'Error Processing Request', 'error');
						}
					});
				}
			});
		} else { Swal.fire('Error', 'Please input first name', 'error');}
	}
	
	
	
	
	
/*	
			function savePerson() {
    var firstname = document.getElementById('firstname').value;

    if (firstname !== '') {
        let myForm = new FormData();
        myForm.append('firstname', firstname);

        Swal.fire({
            title: 'Petty Cash for Liquidation',
            text: 'Are you sure to Process this Petty Cash?',
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'pages/home_.php',
                    type: "POST",
                    data: myForm,
                    beforeSend: function () {
                        $("#body-overlay").show();
                    },
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        $("#maincontent").html(data);
                        $("#maincontent").css('opacity', '1');
                        $("#body-overlay").hide();

                       // Swal.fire('Success', 'Request Successfully Processed.', 'success');
						Swal.fire({
						  position: 'top-end',
						  icon: 'success',
						  title: 'Your work has been saved',
						  showConfirmButton: false,
						  timer: 1500
						})
                    },
                    error: function () {
                        Swal.fire('Error', 'Error Processing Request', 'error');
                    }
                });
            }
        });
    } else {
        Swal.fire('Error', 'Please Select Referral Reason', 'error');
    }
}

*/
/*
function add_cod_customer(){
	var cusid = object('cusid').value;
	
	swal({
		  title: 'COD Customer',
		  text: 'Are you sure to Process this?',
		  icon: "warning",
		  buttons: true,
		  dangerMode: true,
		})
		.then((willAdd) => {
			if (willAdd) {			  
			x = 'delivery/codtmp.php?cusid='+cusid;			
				  $.ajax({
					url: x, 
					type: "GET",
					beforeSend: function(){$("#body-overlay").show();},
					contentType: false,
					processData:false,
					success: function(data)
					{
					
					$("#tmptmp").html(data);
					$("#tmptmp").css('opacity','1');
						$("#body-overlay").hide();
						
					swal('Success','Request Successfully Processed.','success');
					},
					error: function() 
					{
						swal('Error','Error Processing Request ','error');
					} 	        
				});
			}
		});
}

*/



