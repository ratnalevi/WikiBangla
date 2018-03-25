<div class="row">
	<div id="data-content" class="col-md-12">
		<h1 class="widget-title"><?php echo $title; ?></h1>
		
		<div class="signup">
			<div class="row">
				<div class="col-md-5 col-sm-6 col-xs-6 col-md-offset-2 col-sm-offset-2 col-xs-offset-2">
					<p>Already a member? <a href="<?php echo base_url('front/login'); ?>">Log in</a></p>
					<form method="post" action="">
						<div class="form-group">
							<label for="">Name<span class="required">*</span></label>
							<input type="text" class="form-control" name="name" id="name" required="" value="<?php echo $_POST['name']; ?>">
						</div>
						<div class="form-group">
							<label for="">Email<span class="required">*</span></label>
							<input type="email" class="form-control" name="email" id="email" required="" value="<?php echo $_POST['email']; ?>">
						</div>
						<div class="form-group">
							<label for="">Password<span class="required">*</span></label>
							<input type="password" class="form-control" name="password" id="password" required="">
						</div>
						<div class="form-group">
							<label for="">Confirm Password<span class="required">*</span></label>
							<input type="password" class="form-control" name="confirm_password" id="confirm_password" required="">
						</div>
						<input type="submit" class="btn btn-info btn-sm" name="submit" value="Signup">
					</form>
				</div>
			</div>			
		</div>
		
	</div>
</div> <!-- /row -->
