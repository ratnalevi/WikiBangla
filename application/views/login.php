


<div class="row">
	<div id="data-content" class="col-md-12">
		<h1 class="widget-title"><?php echo $title; ?></h1>
		
		<div class="signup">

		
			<div class="row">
	
		
			
				<div class="col-md-5 col-sm-6 col-xs-6 col-md-offset-2 col-sm-offset-2 col-xs-offset-2">
				
					<p>First registration? <a href="<?php echo base_url('front/signup'); ?>">Create an account</a></p>
					<form method="post" action="">
						<div class="form-group">
							<label for="">Email<span class="required">*</span></label>
							<input type="email" class="form-control" name="email" id="email" required="" value="<?php echo $_POST['email']; ?>">
						</div>
						<div class="form-group">
							<label for="">Password<span class="required">*</span></label>
							<input type="password" class="form-control" name="password" id="password" required="">
						</div>
						<input type="submit" class="btn btn-info btn-sm" name="login" value="Login">
						<input name="url" type="hidden" value="<?php echo $_GET['url']; ?>" />
						<a style="padding-left: 20px;" href="<?php echo base_url('front/forgot_password'); ?>">Forgot password?</a></p>
					</form>
				</div>
				
				<div class="col-md-5"> 
				
				</div>
				
				
			</div>			
		</div>
		
	</div>
</div> <!-- /row -->
