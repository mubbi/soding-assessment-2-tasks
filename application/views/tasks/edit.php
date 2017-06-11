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
					<h2>Edit Task <a href="<?php echo base_url()?>tasks" class="btn btn-primary btn-sm pull-right"><i class="fa fa-chevron-left"></i> Back</a></h2>

					<hr>

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

					<?php echo form_open(base_url().'tasks/operation/'.$task['TaskID'].'?type=2'); ?>
					<?php echo validation_errors(); ?>

						<div class="form-group">
							<label for="">Task Name*</label>
							<input type="text" class="form-control" name="task_name" value="<?php echo $task['TaskName']; ?>" required autofocus>
						</div>

						<div class="form-group">
							<label for="">Task Description*</label>
							<textarea name="task_description" class="form-control" rows="3"><?php echo $task['TaskDescription']; ?></textarea>
						</div>

						<button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</button>

					</form>

				</div>
			</div>
		</div>
<?php
$this->load->view('includes/footer');
?>
	<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
	<script>
	tinymce.init({
		selector: 'textarea',
		height: 250,
		menubar: false,
		plugins: [
		'advlist autolink lists link image charmap print preview anchor',
		'searchreplace visualblocks fullscreen',
		'insertdatetime media table contextmenu paste'
		],
		toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | table link image | fullscreen'
	});
	</script>
<?php
$this->load->view('includes/foot');
?>