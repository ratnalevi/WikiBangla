
<div class="row">
	<div id="data-content" class="col-md-12">
		<h1 class="widget-title"><?php echo $title; ?></h1>
		
		<div class="signup">
			<div class="row">
				<div class="col-md-5">
					<form method="post" action="">
						<div class="form-group">
							<label for="">Email<span class="required">*</span></label>
							<input type="email" class="form-control" name="email" id="email" required="" value="<?php echo $_POST['email']; ?>">
						</div>
						<input type="submit" class="btn btn-info btn-sm" name="submit" value="Forgot Password">
					</form>
				</div>
			</div>			
		</div>
		
	</div>
</div> <!-- /row -->
