
<div class="row">
	<div id="data-content" class="col-md-12">
		<h1 class="widget-title"><?php echo $title; ?></h1>
		
		<div class="signup">
			<div class="row">
				<div class="col-md-5">
					<form method="post" action="">
						<div class="form-group">
							<label for="">Password<span class="required">*</span></label>
							<input type="password" class="form-control" name="password" id="password" required="">
						</div>
						<div class="form-group">
							<label for="">Confirm Password<span class="required">*</span></label>
							<input type="password" class="form-control" name="confirm_password" id="confirm_password" required="">
						</div>
						<input type="submit" class="btn btn-info btn-sm" name="submit" value="Reset Password">
						<input name="uid" type="hidden" value="<?php echo $_GET['id']; ?>" />
						<input name="email" type="hidden" value="<?php echo $_GET['email']; ?>" />
					</form>
				</div>
			</div>			
		</div>
		
	</div>
</div> <!-- /row -->
