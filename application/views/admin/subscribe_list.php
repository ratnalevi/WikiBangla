<?php
$r = '';
foreach($rows as $i => $row){
	if($i==count($rows)-1){
		$r .= $row->email;
	}else{
		$r .= $row->email.', ';
	}
}
?>
	<div class="row">		
		<div class="col-lg-12 col-md-12 col-sm-12">
			<div class="form-group">
				<label>Email:</label>
				<textarea name="email" class="form-control"><?php echo $r; ?></textarea>
			</div>
		</div>	
	</div>

