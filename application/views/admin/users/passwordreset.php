<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Wiki Bangla Admin</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url(); ?>assets/css/metisMenu.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>assets/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
    <link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet">

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
            	<div class="login-logo text-center">
            		<img width="100" src="<?php echo base_url(); ?>images/logo.png" />
            	</div>
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                    	<div id="infoMessage">
						    <?php if($this->session->flashdata('success-message')){ ?>
						        <div class="alert alert-success" id="success-alert">
						            <button type="button" class="close" data-dismiss="alert">x</button>
						            <?php echo $this->session->flashdata('success-message');?>
						        </div>
						    <?php } ?>
						    <?php if($this->session->flashdata('warning-message')){ ?>
						        <div class="alert alert-danger" id="warning-alert">
						            <button type="button" class="close" data-dismiss="alert">x</button>
						            <?php echo $this->session->flashdata('warning-message');?>
						        </div>
						    <?php } ?>
						</div>
                        <form method="post" action="<?php echo base_url(); ?>zadmin/passwordreset">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="" required="">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Confirm Password" name="confirm_password" type="password" value="" required="">
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" name="submit" class="btn green" value="Reset Password">
			                    <input type="hidden" name="uid" value="<?php echo $_GET['id']; ?>">
			                    <input type="hidden" name="email" value="<?php echo $_GET['email']; ?>">
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<style>
	.alert {
	    margin-bottom: 15px;
	    padding: 10px;
	}
</style>
    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url(); ?>assets/js/metisMenu.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url(); ?>assets/js/sb-admin-2.js"></script>

</body>

</html>
