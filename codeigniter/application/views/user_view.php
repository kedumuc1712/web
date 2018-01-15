<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>CRUD</title>
	<!-- Jquery -->
	<script
			 src="https://code.jquery.com/jquery-3.2.1.js"
			 integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
			 crossorigin="anonymous"> 	
	</script>

	<link rel="stylesheet" href="<?php echo base_url('css/style.css')?>" />
	<script type="text/javascript" src="<?php echo base_url('js/ajax.js') ?>"></script>
 	
</head>
<body>
	<!-- Search -->
	<form id="search-box" method="post">
		<input type="text" class="search" name="search" data-url="<?php echo site_url('index.php/user/ajax_list/') ?>" placeholder="Search here !" />
	</form>

	<!-- Sort -->
	<div id="sort">
		<select class="filter" data-url="<?php echo base_url('index.php/user/ajax_list/') ?>">
			<option value="">Sort</option>
			<option value="ASC">Asceding</option>
			<option value="DESC">Descending</option>
		</select>
	</div>

	<table id="table">
		<tr>
			<th>ID</th>
			<th>FirstName</th>
			<th>LastName</th>
			<th>Email</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>

		<?php foreach($results as $row) { ?>
		<tr>
			<td><?php echo $row->ID; ?></td>
			<td><?php echo $row->firstName; ?></td>
			<td><?php echo $row->lastName; ?></td>
			<td><?php echo $row->email; ?></td>
			<td>
				<button class="edit" data-id="<?php echo $row->ID; ?>" data-url="<?php echo site_url('index.php/user/ajax_edit/') ?>">Edit
				</button>

  				<button class="save" data-id="<?php echo $row->ID; ?>" data-url="<?php echo site_url('index.php/user/user_update/') ?>">Save</button>

  				<button class="cancel" data-id="<?php echo $row->ID; ?>">Cancel</button>
			</td>
			<td>
				<button class="delete" data-id="<?php echo $row->ID; ?>" data-url="<?php echo site_url('index.php/user/user_delete/') ?>">Delete</button>
			</td>
		</tr>
		<?php } ?>
	</table>

	<div id="pagination" data-url="<?php echo base_url('index.php/user/ajax_list/') ?>">
		<ul>
			<li class="0">First</li>
			<?php 
				for ($i = 0, $number = 1; $i < $num_links * 5; $i += 5, $number++) { 
					echo  "<li class=".$i.">$number</li>" . " ";
				}
			?>
			<li class="<?php echo (($num_links * 5) - 5); ?>">Last</li>
		</ul>
	</div>

  <div id="modal_form">
  	<form action="" id="form" method="post">
  		<input type="hidden" name="ID" value="">
		
		<div class="field">
			<label>FirstName</label>
			<input type="text" name="firstName">
		</div>

		<div class="field">
			<label>LastName</label>
			<input type="text" name="lastName">
		</div>

		<div class="field">
			<label>Email</label>
			<input type="text" name="email">
		</div>
  	</form>
  </div>

</body>
</html>