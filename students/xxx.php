<?

if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }



if (isset($_POST['firstname'])){
	echo $_POST['firstname'];
}

?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h3 class="h3 mb-0 text-gray-800" align="center">Student Application</h3>
	<!--<div align="left">Search:&nbsp;<input type="text" id="search_ref" name="search_ref" 
		style="width:220px"/><button class="btn btn-sm btn-primary" onclick="click_me()">Search</button>
	</div>	-->
	<div align="right">
<a href="javascript:void();" onclick="save_entry()" class="btn btn-primary btn-sm btn-icon-split" >
    <span class="icon text-white-50">
        <i class="fas fa-plus" style="margin-top: 2px;"></i> <!-- Use "fas fa-plus" for the plus icon -->
    </span>
    <span class="text">Add Student Ojt</span>
</a>
</div> 	
</div>

<!--<div class="d-sm-flex align-items-center mb-4">
<select><option>ALL STUDENTS</option><option>Without Ojt Students</option></select>&nbsp;<select><option>ALL COURSES</option><option>Without Ojt Students</option></select>&nbsp;<select><option>ALL SECTIONS</option><option>4A</option><option>4B</option></select>
<div align="right">&nbsp;<input type="text" placeholder="search name or studentno" id="search_ref" name="search_ref" 
		style="width:220px"/><button class="btn btn-sm btn-primary" onclick="click_me()">Search</button>
	</div>	
</div>-->

<form style="text-align:right;" method="post" id="myForm" enctype="multipart/form-data">
	<input type="text" name="lastname" id="lastname" placeholder="lastname"/>
	<input type="text" name="firstname" id="firstname" placeholder="firstname"/>
	<input type="file" id="pic" name="pic" accept="image/*" >
	<a href="javascript:void();" onclick="sample()" class="btn btn-primary btn-sm btn-icon-split">
	<span class="icon text-white-50">
		<i class="fas fa-save"></i>
	</span>
	<span class="text">Save Person</span></a>
</form>

<div class="card shadow mb-4">
	<div class="card-body">
		<div class="table-responsive">
			<table id="example" class="table table-sm" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>View</th>
				<th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Ashton Cox</td>
                <td>Junior Technical Author</td>
                <td>San Francisco</td>
                <td>66</td>
                <td>2009-01-12</td>
                <td><a href="">View</a></td>
				<td><a href="">Edit</a></td>
            </tr>
            <tr>
                <td>Cedric Kelly</td>
                <td>Senior Javascript Developer</td>
                <td>Edinburgh</td>
                <td>22</td>
                <td>2012-03-29</td>
                <td>$433,060</td>
            </tr>
            <tr>
                <td>Airi Satou</td>
                <td>Accountant</td>
                <td>Tokyo</td>
                <td>33</td>
                <td>2008-11-28</td>
                <td>$162,700</td>
            </tr>
            <tr>
                <td>Bradley Greer</td>
                <td>Software Engineer</td>
                <td>London</td>
                <td>41</td>
                <td>2012-10-13</td>
                <td>$132,000</td>
            </tr>
            <tr>
                <td>Dai Rios</td>
                <td>Personnel Lead</td>
                <td>Edinburgh</td>
                <td>35</td>
                <td>2012-09-26</td>
                <td>$217,500</td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
        </tfoot>
    </table>
			
		</div>
	</div>
</div>

