<div class="row">
	<div class="col-md-12">
		<h3 class="main-title"><?php echo $title; ?></h3>
	</div>
</div> 

<?php
$output = '<table class="table table-bordered table-striped">';

foreach ($controllers as $controller=>$value) {
    $output .='<th class="permission-block" colspan="2"> SECTION - ' . strtoupper($controller) . '</th>';
    foreach ($value as $op => $perm_name) {
        $checked = !empty($db_controllers) && array_key_exists($op, $db_controllers) ? TRUE: FALSE;
        $row ='<tr>';
        $row .= '<td>' . $perm_name . '</td>';
        $row .= '<td>' . form_checkbox(array('name'=>str_replace(' ','_',$controller).'[]',  'class'=>'icheck-green','value'=> $op, 'checked'=>$checked)) . '</td>';
        $row .= '</tr>';
        $output .= $row;
    }
}


$output .= '</table>';
$form_attributes = array('class' => 'add-form', 'id' => 'permisson-add-form');
$get = $_GET;
// $ename = form_label('Employee Name :', 'ename');
$role_id = form_hidden('rid',$rid);

$submit = form_button(array(
    'name'        => 'submit',
    'id'          => 'edit-search',
    'value'       => 'true',
    'class'       => 'btn btn-primary',
    'type'        => 'submit',
    'content'       => '<i class="fa fa-check"></i>Save Permission'
));

echo form_open($action, $form_attributes);
//echo form_fieldset('Manage Permission',array('class'=>"search-fieldset"));
echo $role_id;
//echo "<h3>Permissions for <b>{$role_name}</b>:</h3>";
echo '<div id="perm-wrapper" class="field-wrapper">'. $output . '</div>';
echo $submit;
echo form_fieldset_close();
echo form_close();
?>
