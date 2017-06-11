<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php
$this->load->view('includes/head');
?>
	</head>
	<body>

	<?php
	$this->load->view('includes/header');
	?>

		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<?php echo $this->session->flashdata('flash_status'); ?>
					<h2>All Tasks <a href="<?php echo base_url()?>tasks/add" class="btn btn-primary btn-sm pull-right"><i class="fa fa-edit"></i> Add New</a></h2>

					<hr>

					<?php if ( empty( $tasks) ): ?>

						<h3 class="text-center">No Tasks yet! <a href="<?php echo base_url()?>tasks/add">Add</a> your first task now.</h3>
						
					<?php else: ?>

					<table class="table table-hover table-striped table-bordered">
						<thead>
							<tr>
								<th><i class="fa fa-th-list"></i> Task Name</th>
								<th><i class="fa fa-calendar"></i> Created On</th>
								<th><i class="fa fa-history"></i> Updated On</th>
								<th><i class="fa fa-cogs"></i> Actions</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach ($tasks as $task): ?>
							<tr>
								<td><?php echo $task['TaskName']; ?></td>
								<td>
									<?php
										$date_created = new DateTime( $task['DateCreated'] );
										echo $date_created->format('F j, Y g:i A');
									?>
								</td>
								<td>
									<?php
										$date_updated = new DateTime( $task['DateUpdated'] );
										echo $date_updated->format('F j, Y g:i A');
									?>
								</td>
								<td>
									<div class="dropdown">
										<button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
											<i class="fa fa-cog"></i>
										</button>
										<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
											<li><a href="<?php echo base_url(); ?>tasks/operation/<?php echo $task['TaskID']; ?>?type=1"><i class="fa fa-eye"></i> View</a></li>
											<li><a href="<?php echo base_url(); ?>tasks/operation/<?php echo $task['TaskID']; ?>?type=2"><i class="fa fa-edit"></i> Edit</a></li>
											<li><a href="<?php echo base_url(); ?>tasks/operation/<?php echo $task['TaskID']; ?>?type=3" onClick="return confirm('Delete This Task?')"><i class="fa fa-trash-o"></i> Delet</a></li>
										</ul>
									</div>
								</td>
							</tr>
						<?php endforeach ?>
						</tbody>
					</table>

					<div class="text-center">
						<?php echo $pagination;?>
					</div>

					<?php endif ?>

				</div>
			</div>
		</div>
<?php
$this->load->view('includes/footer');
$this->load->view('includes/foot');
?>