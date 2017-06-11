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
					<h2>View Task <a href="<?php echo base_url()?>tasks/operation/<?php echo $task['TaskID']; ?>?type=2" class="btn btn-success btn-sm"><i class="fa fa-edit"></i> Edit</a> <a href="<?php echo base_url()?>tasks" class="btn btn-primary btn-sm pull-right"><i class="fa fa-chevron-left"></i> Back</a></h2>

					<hr>
				</div>
				<div class="col-md-6">
					<h4>Date Created</h4>
					<?php
						$date_created = new DateTime( $task['DateCreated'] );
						echo $date_created->format('F j, Y g:i A');
					?>
				</div>
				<div class="col-md-6">
					<h4>Last Updated On</h4>
					<?php
						$date_updated = new DateTime( $task['DateUpdated'] );
						echo $date_updated->format('F j, Y g:i A');
					?>
				</div>

				<div class="col-md-12">
					<hr>

					<h4>Task Name</h4>
					<?php echo $task['TaskName']; ?>

					<h4>Task Description</h4>
					<?php echo $task['TaskDescription']; ?>

				</div>
			</div>
		</div>
<?php
$this->load->view('includes/footer');
$this->load->view('includes/foot');
?>