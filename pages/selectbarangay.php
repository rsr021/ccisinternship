<?Php 

if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }
$cityid = $_GET['cityid'];
$provid = $_GET['provid'];

echo '<select class="form-control"  id="brgyid">';
echo '<option value="0">Select Barangay</option>';

				$rs1 = mysqli_query($db_connection,'SELECT brgyid,barangayname from tblloc_brgy where
													cityid='.$cityid.' AND provid='.$provid.' ORDER BY barangayname');
				while ($rw1 = mysqli_fetch_array($rs1)) { $sel = '';
					if ($brgyid==$rw1['brgyid']) { $sel = 'selected="selected"'; }
					echo '<option value="'.$rw1['brgyid'].'" '.$sel.'>'.ucwords(strtolower($rw1['barangayname'])).'</option>';
				}
				echo '</select>';
				

?>