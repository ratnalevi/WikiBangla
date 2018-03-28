<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Wiki Bangla | <?php echo $title;?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="keywords" content="<?php echo $keywords;?>"/>
	
	<meta property="og:url" content="<?php echo $og_url;?>">
	<meta property="og:type" content="<?php echo $og_type;?>">
	<meta property="og:title" content="<?php echo $og_title;?>">
	<meta property="og:site_name" content="<?php echo $og_site_name;?>">
	<meta property="og:description" content="<?php echo $og_description;?>">
	<meta property="og:image" content="<?php echo $og_image;?>">

	<meta property="fb:pages" content="934737806646344" />

    <?php if (sizeof($_GET) == 0) { ?>
        <link rel="amphtml" href="<?= $data['og_url'] . '?amp=1' ?>"/>
    <?php } else { ?>
        <link rel="amphtml" href="<?= $data['og_url'] . '&amp=1' ?>"/>
    <?php } ?>

    <link rel="shortcut icon" href="assets-front/images/fav-icon.ico">
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css">
	
	<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<!--UI <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
	
	<script>base_url = "<?php echo base_url(); ?>";</script>
</head>
<body class="home" <?php if($this->uri->segment(1)=='p'){ ?>data-spy="scroll" data-target=".navbar" data-offset="50"<?php } ?>>

    <?php require_once'includes/header.php';?>

 
    <?php echo (isset($content))?$content:'';?>

    
    <?php require_once'includes/footer.php';?>  
    
    <script src="<?php echo base_url(); ?>js/custom.js"> </script>
    
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    
    <script>
	$(function(){ 
	    $(document).on('focus', ".date", function(){
	        $(this).datepicker({
	            changeMonth: true,
	            changeYear: true,
	            dateFormat: 'dd-mm-yy',
				//beforeShowDay: $.datepicker.noWeekends,
	   		onClose: function(dateText, inst) 
	   		{
	          this.fixFocusIE = true;
	          this.focus();
	      	}
	        });
	    });
	});
	</script>

</body>

</html>