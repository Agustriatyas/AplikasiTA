<!DOCTYPE html>
<html>
<head>
	<title>BPPTPM Kab.Ciamis</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/mycss/login.css" />
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/jquery_easyui/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/libs_js/login.js"></script>
	
</head>
<body>
	<div class="lg-container">
	<h1>Please Login</h1>
	<?php //echo form_open('c_login'); 
		$attributes = array('id' => 'lg-form');
		echo form_open(base_url().'index.php/c_login', $attributes);
	?>
	<!--form action="../../controllers/c_login.php" id="lg-form" name="lg-form" method="post"-->
<!--table-->
	<tr>
		<div>
        <td><?php //echo form_input('username') 
        	echo form_input(array(
  				'name' => 'username',
  				'id' => 'username',
  				'placeholder' => 'Username',
			));
        	?>
        </td>
        <td><font color="#ef4423"><?php echo form_error('username'); ?></font></td>
        </div>
	</tr>
	<tr>
		<div>
        <td><?php //echo form_password('password'); 
        echo form_password(array(
  				'name' => 'password',
  				'id' => 'password',
  				'placeholder' => 'Password',
			));
        ?></td>
        <td><font color="#ef4423"><?php echo form_error('password'); ?></font></td>
        </div>
	</tr>
	<tr>
		<div>
        	<!--td colspan="4" align="middle"><?php //echo form_submit('submit', 'Login'); 
        // 		echo form_submit(array(
        // 			'id' => 'login', 
        // 			'value' => 'Enter', 
        // 			'class' => 'btn btn-primary',
        // 			'type' => 'button'
     			// ));
        	?></td-->
        	<button value="save" name="submit">Login</button>
		</div>
        <!--div>				
			<button type="submit" id="login">Login</button>
		</div-->
	</tr>
<!--/table-->
	<?php echo form_close(); ?>
	<!--/form-->
		<div id="message"></div>
	</div>
</body>
</html>

