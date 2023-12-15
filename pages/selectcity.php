<?Php 

if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }
$provid = $_GET['provid'];

echo '<select id="cityid" class="form-control" onchange="loadPage(\'pages/selectbarangay.php?cityid=\'+this.value+\'&provid=\'+object(\'provid\').value,\'tmp_brgy\');">';
echo '<option value="0">Select City</option>';

				$rs1 = mysqli_query($db_connection,'SELECT cityid,cityname from tblloc_city where
													provid='.$provid.' ORDER BY cityname');
				while ($rw1 = mysqli_fetch_array($rs1)) { $sel = '';
					if ($cityid==$rw1['cityid']) { $sel = 'selected="selected"'; }
					echo '<option value="'.$rw1['cityid'].'" '.$sel.'>'.$rw1['cityname'].'</option>';
				}
				echo '</select>';
				

?>