<?php

if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }

if(isset($_GET['applicationid'])){
    $studentid = GetValue('SELECT studentid FROM tblapplication WHERE applicationid='.$_GET['applicationid']);
    $sectionid = GetValue('SELECT sectionid FROM tblstudent WHERE studentid='.$studentid);
    $companyid = GetValue('SELECT companyid FROM tblapplication WHERE applicationid='.$_GET['applicationid']);
    $courseid = GetValue('SELECT courseid FROM tblstudent WHERE studentid='.$studentid);
    
    $max_apply_course = GetValue('SELECT max_apply FROM tblcourse WHERE courseid='.$courseid);
    $applicants_course = GetValue('SELECT applicants FROM tblcourse WHERE courseid='.$courseid);
    
    $max_apply_per_section = GetValue('SELECT max_apply FROM tblsection WHERE sectionid='.
														$sectionid.' AND courseid='.
														$courseid);
    $applicants_per_section = GetValue('SELECT applicants FROM tblsection WHERE sectionid='.
														$sectionid.' AND courseid='.
														$courseid);

    // Check if the maximum number of applicants per course and per section is not reached
    if ($applicants_course < $max_apply_course && $applicants_per_section < $max_apply_per_section) {
        
        // Check if the section has less than 2 students
        if ($applicants_per_section < $max_apply_per_section) {
            
			//echo'INSERT SUCCESS';
			mysqli_query($db_connection,'INSERT INTO tblcompany_ojt SET companyid='.
                                            $companyid.', studentid='.
                                            $studentid.', sectionid='.
                                            $sectionid.', courseid='.
                                            $courseid.' ');
            mysqli_query($db_connection,'UPDATE tblapplication SET status=1 WHERE applicationid='.$_GET['applicationid']);
            mysqli_query($db_connection,'UPDATE tblstudent SET companyid='.$companyid.' WHERE studentid='.$studentid);
                
            $apply = GetValue('select max(applicants) from tblsection where sectionid='.$sectionid) + 1;                                    
            mysqli_query($db_connection,'UPDATE tblsection SET applicants='.$apply.' WHERE sectionid='.$sectionid);
            include('../email/send_email.php');
			
			
        } else {
            echo'<span style="color:red;">The section '.SectionCode($sectionid).' is full with 2 students.</span>';
        }
    } else {
        echo'<span style="color:red;">The section has reached its maximum capacity.</span>';
    }
}
?>
