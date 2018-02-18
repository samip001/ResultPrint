<?php
	include 'core/init.php';

?>

<style type="text/css">
.accordion {
    background-color: #eee;
    color: #444;
    cursor: pointer;
    padding: 18px;
    width: 100%;
    border: none;
    text-align: left;
    outline: none;
    font-size: 15px;
    transition: 0.4s;
}

.active, .accordion:hover {
    background-color: #ccc;
}

.accordion:after {
    content: '\002B';
    color: #777;
    font-weight: bold;
    float: right;
    margin-left: 5px;
}

.active:after {
    content: "\2212";
}

.pan {
    padding: 0 px;
    background-color: white;
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.2s ease-out;
}

</style>

<?php
	
	if(isset($_GET['command'])){
		$classname =$_GET['classname'];
		$id = $_GET['id'];
		if($_GET['command'] == 'DELETE'){
			$subject->deleteSubject(intval($_GET['id']));
			header('Location:classlist.php');
			exit();

		}
		if($_GET['command'] == 'EDIT'){
			header('Location:editsubject.php?classname='.$classname.'&id='.$id);
			exit();
		}

	}
?>
<title>Subject List </title>
<?php include 'includes/header.php';?>

<div class="container">
	<?php include 'includes/classlist.php';?>

	<div class="col-md-9">
		<h2>Class and Subject List</h2>
		<hr>
		<?php
		// call from classlist.php
		//$classes = $class->getAllClasses();
		foreach ($classes as $class) {
			$classname = $class->class_name;
			echo '<button class="accordion">Class: '.$classname .'</button>';
			echo '<div class="pan">
					<table class="table table-hover">
					<thead>
						<th>S/N</th>
						<th>Subject Name</th>
						<th>Total Marks</th>
						<th>Practical</th>
						<th>Credit Hrs</th>
						<th>Edit</th>
						<th>Delete</th>	
					</thead>
					<tbody>';
			$subjects = $subject->getSubjects($classname);
			
			if ($subjects) {
				$i=1;
				foreach ($subjects as $sub) {
					echo '<tr>
						<td>'.$i.'.</td>
						<td>'.$sub->subject_name.'</td>
						<td>'.$sub->total_mark.'</td>
						<td>'.$validator->numberToAlphaPractical($sub->practical).'</td>
						<td>'.$sub->credit_hrs.'</td>
						<td><a href="listsubject.php?classname='.$classname.'&command=EDIT&id='.$sub->subject_id.'"><span class="glyphicon glyphicon-pencil"></span></td>
						<td><a href="listsubject.php?classname='.$classname.'&command=DELETE&id='.$sub->subject_id.'"><span class="glyphicon glyphicon-trash" style="color: red"></span></td>
					</tr>';
					$i++;
				}
			}
			else{
				echo '<tr>
						<td class="text-danger"><a href="addsubject.php" class="btn btn-sm btn-danger">Add Subject</a></td>
						<td colspan="4" class="text-danger">No Subject Found</td>

				</tr>';
			}

			echo '</tbody>
			</table>
			</div>';
		}
		?>
	</div>

</div>


<script type="text/javascript">
	
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var pan = this.nextElementSibling;
    if (pan.style.maxHeight){
      pan.style.maxHeight = null;
    } else {
      pan.style.maxHeight = pan.scrollHeight + "px";
    } 
  });
}
</script>