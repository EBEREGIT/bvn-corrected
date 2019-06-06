<?php 
	include_once 'includes_admin/header_admin.php';

	if (isset($_GET['search'])) {
		$search_user = sanitize($_GET['search_user']);
		$search_query = $db->query("SELECT * FROM user WHERE bvn LIKE '%$search_user%'");
	}
	$i = 0;
?>


<div class="container-fluid">
	<table class="table table-bordered table-striped table-condensed">
		<legend>
			<div class="col-md-8"><h3>Verify User BVN</h3> </div>

			<div class="col-md-4">
			    <form action="bvn_verify.php" method="GET">
			    	<div class="input-group" id="search">
				      <input type="text" class="form-control" name="search_user" value="<?php echo $search_user; ?>" placeholder="Search Users">
				      <span class="input-group-btn">
				        <button type="submit" class="btn btn-default" name="search"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
				      </span>
				    </div>
			    </form>
		  </div>
		</legend>
		
		<thead>
			<th>S/N</th>
			<th>Action</th>
			<th>Name</th>
			<th>Email</th>
			<th>Phone Number</th>
			<th>Account Name</th>
			<th>Account Number</th>
			<th>Joined Date</th>
			<th>Last Login</th>
			<th>Last Modified</th>
			<th>user Role</th>
		</thead>

		<tbody>
			<?php if (isset($_GET['search'])) : ?>
				<?php while ($search_array = mysqli_fetch_assoc($search_query)) : ?>
					<?php $i++; ?>
						<tr>
							<td><?php echo $i; ?></td>
							<td>
								<a href="users_admin.php?delete=<?php echo $search_array['user_id']; ?>" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove-sign"></span></a>
								<a href="users_admin.php?edit=<?php echo $search_array['user_id']; ?>" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>
							</td>
							<td><?php echo $search_array['full_name']; ?></td>
							<td><?php echo $search_array['email']; ?></td>
							<td><?php echo $search_array['phone_number']; ?></td>
							<td><?php echo $search_array['account_name']; ?></td>
							<td><?php echo $search_array['account_number']; ?></td>
							<td><?php echo pretty_date($search_array['date_joined']); ?></td>
							<td><?php echo (($search_array['last_login'] == '0000-00-00 00:00:00')?'Never':pretty_date($search_array['last_login'])); ?></td>
							<td><?php echo (($search_array['last_modified'] == '0000-00-00 00:00:00')?'Never':pretty_date($search_array['last_modified'])); ?></td>
							<td><?php echo $search_array['user_role']; ?></td>
						</tr>
				<?php endwhile; ?>
			<?php endif; ?>
		</tbody>
	</table>
</div>

<?php 
	include_once 'includes_admin/footer_admin.php';
?>