<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php
$this->load->view('includes/head');
?>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-md-offset-4">
					<br>
					<br>

					<h1 class="text-center"><i class="fa fa-user"></i> Login</h1>

					<?php echo $this->session->flashdata('flash_status'); ?>
					<?php echo form_open(); ?>
					<?php echo validation_errors(); ?>

						<div class="form-group">
							<label for=""><i class="fa fa-envelope"></i> Email Address*</label>
							<input type="email" class="form-control" name="emailid" value="<?php echo set_value('emailid') ?>" autocomplete="off" placeholder="Email ID" required autofocus>
						</div>

						<div class="form-group">
							<label for=""><i class="fa fa-lock"></i> Password*</label>
							<input type="password" class="form-control" name="password" autocomplete="off" placeholder="Password" required>
						</div>

						<button type="submit" class="btn btn-primary"><i class="fa fa-sign-in"></i> Login</button>

					</form>
				</div>
			</div>
		</div>
<?php
$this->load->view('includes/footer');
$this->load->view('includes/foot');
?>