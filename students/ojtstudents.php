<?

if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }





?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h3 class="h3 mb-0 text-gray-800" align="center">OJT Students</h3>
	<!--<div align="left">Search:&nbsp;<input type="text" id="search_ref" name="search_ref" 
		style="width:220px"/><button class="btn btn-sm btn-primary" onclick="click_me()">Search</button>
	</div>	-->
	<!--<div align="right">
<a href="javascript:void();" onclick="save_entry()" class="btn btn-primary btn-sm btn-icon-split" >
    <span class="icon text-white-50">
        <i class="fas fa-plus" style="margin-top: 2px;"></i> 
    </span>
    <span class="text">Add Student Ojt</span>-->
</a>
</div> 	
</div>




























<!--
<div class="card shadow mb-4">
	<div class="card-body">
		<div class="table-responsive">
		<table id="example" class="table table-sm" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Student Name</th>
                <th>Company Applied</th>
				<th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
        <?
		$count=1;
		$rs = mysqli_query($db_connection,'SELECT companyid, studentid, sectionid, is_cancel
								FROM tblcompany_ojt');
		while($rw = mysqli_fetch_array($rs)){
			echo'<tr>
				<td>'.$count++.'</td>
				<td>'.StudentName($rw['studentid']).'</td>
				<td>'.CompanyName($rw['companyid']).'</td>
				<td>VIEW</td>
			</tr>';
		}
		?>
		</table>
		</div>
	</div>
</div>
-->