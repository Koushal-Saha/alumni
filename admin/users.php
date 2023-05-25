<?php 

?>

<div class="container-fluid">

	<div class="row">
		<div class="card col-lg-12">
		<body style="background-color:aqua">	
		<div class="card">
		
				<style>.card-header{color:red}</style>
					<div class="card-header">
						<h2><b>Users List</b></h2>
						<span class="">

							<button class="btn btn-primary btn-block btn-sm col-sm-2 float-right" type="button" id="new_career">
					<i class="fa fa-plus"></i> New User</button>
				</span>
					</div>
					<div class="card-body">
                </div>


			<div class="card-body">
				<table class="table-striped table-bordered col-md-12">
			<thead>
				<tr>
					<th class="text-center">Sl.no</th>
					<th class="text-center">Name</th>
					<th class="text-center">Username</th>
					<th class="text-center">Type</th>
					<th class="text-center">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
 					include 'db_connect.php';
 					$type = array("","Admin","Staff","Alumnus/Alumna");
 					$users = $conn->query("SELECT * FROM users order by name asc");
 					$i = 1;
 					while($row= $users->fetch_assoc()):
				 ?>
				 <tr>
				 	<td class="text-center">
				 		<?php echo $i++ ?>
				 	</td>
				 	<td>
				 		<?php echo ucwords($row['name']) ?>
				 	</td>
				 	
				 	<td>
				 		<?php echo $row['username'] ?>
				 	</td>
				 	<td>
				 		<?php echo $type[$row['type']] ?>
				 	</td>
				 	<td>
				 		<center>
								<div class="btn-group">
								  <button type="button" class="btn btn-primary">Action</button>
								  <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								    <span class="sr-only">Toggle Dropdown</span>
								  </button>
								  <div class="dropdown-menu">
								    <a class="dropdown-item edit_user" href="javascript:void(0)" data-id = '<?php echo $row['id'] ?>'>Edit</a>
								    <div class="dropdown-divider"></div>
								    <a class="dropdown-item delete_user" href="javascript:void(0)" data-id = '<?php echo $row['id'] ?>'>Delete</a>
								  </div>
								</div>
								</center>
				 	</td>
				 </tr>
				<?php endwhile; ?>
			</tbody>
		</table>
			</div>
		</div>
	</div>

</div>
<Style>
	th {
		background-color: #04AA6D;
		color: white;
	}
	td:nth-child(odd){background-color:#D6EEEE}
	td:nth-child(even){background-color:skyblue}
</Style>
<script>
	$('table').dataTable();
$('#new_user').click(function(){
	uni_modal('New User','manage_user.php')
})
$('.edit_user').click(function(){
	uni_modal('Edit User','manage_user.php?id='+$(this).attr('data-id'))
})
$('.delete_user').click(function(){
		_conf("Are you sure to delete this user?","delete_user",[$(this).attr('data-id')])
	})
	function delete_user($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_user',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
</script>
