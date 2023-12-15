<?
error_reporting(0);
//echo '<p style="color:black;">'.$_SERVER['REQUEST_URI'].'</p>';

$host = "localhost";
$user = "u695635110_root";
$dbpass = "@Blaire040302";
$dbname = "u695635110_internship_db";

// $host = "localhost";
// $user = "root";
// $dbpass = "";
// $dbname = "internship_db";
global $db_connection; 
$db_connection = mysqli_connect($host,$user,$dbpass) or die('Failed to connect to Database Server');
$db = mysqli_select_db($db_connection,$dbname);

mysqli_query($db_connection,"SET CHARACTER SET 'utf8'");
mysqli_query($db_connection,"SET SESSION collation_connection ='utf8_unicode_ci'");

header('Content-Type: text/html; charset=utf-8');
header('content-type: text/html; charset: utf-8');
header("Content-Type: text/html;charset=utf-8");
header("Content-Type: text/html; charset=ISO-8859-1");
echo '<meta http-equiv="content-type" content="text/html; charset=utf-8" />';
header('content-type:text/html;charset=utf-8');
ini_set('default_charset', 'utf-8'); 
header('Content-Type: text/html; charset=utf-8');
ini_set('default_charset', 'utf-8');

 
function generateRandomString($length = 5) {
		$characters = '2345679ACDEFGHJKLMNPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}

function GetValue($sql_query) {error_reporting(0);
	global $db_connection;
	$result = mysqli_query($db_connection,$sql_query);
	$row = mysqli_fetch_array($result);
	return $row[0];
}

function isDBTableExist($dbname,$table) {
	return GetValue("SELECT COUNT(*)
			FROM information_schema.tables
			WHERE table_schema = '".$dbname."' 
				AND table_name = '".$table."'
			LIMIT 1;") + 0;
}

function checkStudentNoExists($db_connection, $studentno) {
    $query = "SELECT COUNT(*) as count FROM tblstudent WHERE studentno = '$studentno'";
    $result = mysqli_query($db_connection, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['count'] > 0;
}

function DateSQL() { global $db_connection;
	$rs = mysqli_query($db_connection,"SELECT NOW()") or die(mysqli_error($db_connection));
	$rw = mysqli_fetch_array($rs);
	return date("Y-m-d",strtotime($rw[0]));
}
 
 
 function DateSize() {
	if (isset($_SESSION['device'])) { 
		if ($_SESSION['device'] == 'mobile') {
			return 11;
		} else {
			return 10;
		}
	} else {
		return 10;
	}
}
 
 
function Number($float) {
//$floatx = number_format($float,2,".","");
	if ($float==0) {
		return "";
	} else {
		if ($float > 0) {
		return number_format($float,2,".",",");
		}
		else { return '('.number_format(abs($float),2,".",",").')'; }
	}
}


function Excel($show_img=1) {
	$ret_str = '<span class="menuimage style1blue" onclick="fnExcelReport()">';
	if ($show_img==1) { }
	$ret_str .= 'Excel Format</span>';
	return $ret_str;
}



function CourseCode($id){
	return GetValue('SELECT coursecode FROM tblcourse WHERE courseid='.$id);
}
function CourseName($id){
	return GetValue('SELECT coursename FROM tblcourse WHERE courseid='.$id);
}

function SectionCode($id){
	return GetValue('SELECT sectioncode FROM tblsection WHERE sectionid='.$id);
}

function SectionName($id){
	return GetValue('SELECT sectionname FROM tblsection WHERE sectionid='.$id);
}

function FacultyName($id){
	return GetValue('SELECT CONCAT(firstname,\' \',lastname) as name FROM tblfaculty WHERE facultyid='.$id);
}

function StudentName($id){
	return GetValue('SELECT CONCAT(firstname,\'\',middleinitial,\' \',lastname) as name FROM tblstudent WHERE studentid='.$id);
}

function CompanyName($id){
	return GetValue('SELECT companyname FROM tblcompany WHERE companyid='.$id);
}

function Type($id){
	return GetValue('SELECT type FROM tblinterntype WHERE typeid='.$id);
}


function Province($id){
	return GetValue('SELECT provincename FROM tblloc_province WHERE provid='.$id);
}

function City($id){
	return GetValue('SELECT cityname FROM tblloc_city WHERE cityid='.$id);
}

function Barangay($id){
	return GetValue('SELECT barangayname FROM tblloc_brgy WHERE brgyid='.$id);
}

function Activity($id){
	return GetValue('SELECT act FROM tblactivity WHERE actid='.$id);
}


?>




<script>
			function fnExcelReport() {
		
              var tab_text="<table border='1'><tr bgcolor='#87AFC6'>";
              var textRange; var j=0;
              tab = document.getElementById('headerTable'); // id of table
			  if (tab==null) {
					tab = document.getElementById('trhovergreen');
					if (tab==null) {
						tab = document.getElementById('trhover');
					}
			  }	
              for(j = 0 ; j < tab.rows.length ; j++) 
              {     
                    tab_text=tab_text+tab.rows[j].innerHTML+"</tr>";
              }

              tab_text=tab_text+"</table>";
              tab_text= tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
              tab_text= tab_text.replace(/<img[^>]*>/gi,""); // remove if u want images in your table
              tab_text= tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // removes input params
			  tab_text= tab_text.replace(/&nbsp;<\//gi, "</");
			  tab_text= tab_text.replace(/&nbsp;<\//gi, "</");
                   var ua = window.navigator.userAgent;
                  var msie = ua.indexOf("MSIE "); 

                     if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
                        {
                               txtArea1.document.open("txt/html","replace");
                               txtArea1.document.write(tab_text);
                               txtArea1.document.close();
                               txtArea1.focus(); 
                                sa=txtArea1.document.execCommand("SaveAs",true,"exported.xls");
                              }  
                      else                 //other browser not tested on IE 11
					 
                          sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));  
                          return (sa);
}
</script>