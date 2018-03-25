
<div class="row">
	<div id="data-content" class="col-md-12">
		<h1 class="widget-title"><?php echo $title; ?></h1>
		
		<div class="form-horizontal profile">
			<div class="form-group">
				<label for="" class="col-sm-2 control-label">Name:</label>
				<div class="col-sm-10" style="margin-top: 7px;">
					<?php echo $row->fullname; ?>
				</div>
			</div>
			<div class="form-group">
				<label for="" class="col-sm-2 control-label">Email:</label>
				<div class="col-sm-10" style="margin-top: 7px;">
					<?php echo $row->email; ?>
				</div>
			</div>
		</div>
		
	</div>
</div> <!-- /row -->
