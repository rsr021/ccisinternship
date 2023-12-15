<?
/*
if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }

$president = GetValue('SELECT studentid FROM tblstudent WHERE is_president=1 AND courseid='.$_GET['courseid'].' AND sectionid='.$_GET['sectionid'].'');	

echo'<h3>'.CompanyName($_GET['companyid']).'</h3>';
echo'<h4>'.CourseCode($_GET['courseid']).''.SectionCode($_GET['sectionid']).'</h4>';
echo'<input hidden type="text" id="companyid'.$president.'" value="'.$_GET['companyid'].'"/><br>';
echo'<input hidden type="text" id="sectionid'.$president.'" value="'.$_GET['sectionid'].'"/><br>';
echo'<input hidden type="text" id="courseid'.$president.'" value="'.$_GET['courseid'].'"/><br>';

echo '<h5>Class Representative:&nbsp;'.StudentName($president).'</h5>';

echo'<a href="javascript:void();" onclick="send_endorsementV2('.$president.')">SEND Endorsement to the Class Representative</a>';
*/
?>

<?php

if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }

$president = GetValue('SELECT studentid FROM tblstudent WHERE is_president=1 AND courseid='.$_GET['courseid'].' AND sectionid='.$_GET['sectionid'].'');	

echo '<h3>'.CompanyName($_GET['companyid']).'</h3>';
echo '<h4>'.CourseCode($_GET['courseid']).''.SectionCode($_GET['sectionid']).'</h4>';
echo '<input hidden type="text" id="companyid'.$president.'" value="'.$_GET['companyid'].'"/><br>';
echo '<input hidden type="text" id="sectionid'.$president.'" value="'.$_GET['sectionid'].'"/><br>';
echo '<input hidden type="text" id="courseid'.$president.'" value="'.$_GET['courseid'].'"/><br>';

if ($president) {
    echo '<h5>Class Representative:&nbsp;'.StudentName($president).'</h5>';
    echo '<a href="javascript:void();" onclick="send_endorsementV2('.$president.')">SEND Endorsement to the Class Representative</a>';
} else {
    echo '<p>There is no class representative in this section and course.</p>';
}

?>
