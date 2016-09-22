    <div class="user-login-links">
	<span class="password-link"><a href="login">Login Here</a></span> | <span class="register-link"><a href="register">Create an account</a></span>
    </div>

<div id="emptyDiv"></div>
<div id="description"></div>
<!--container start-->
<div id="container">
  <div id="container_body">
    <div>
      <h3 class="form_title">Travel Painters Change Password Form</h3>
      <p class="head_para"></p>
    </div>
    <!--Form  start-->
    <div id="form_name">
      <div class="firstnameorlastname">
       <form name="form"  action="Registeration-step-2.php">
       <div id="errorBox"></div>
       
         
      </div>
      <div id="email_form">
		
		
		<?php 
	
			//$form['name'] = array
			//	(
			//	  '#type' => 'textfield',
			//	  '#title' => t('Username'),
			//	  '#description' => t('Please enter your username'),
			//	  '#size' => 32,
			//	  '#maxlength' => 32,
			//	  '#required' => 1,
			//	);
			
				  print drupal_render($form['name']);  
		?>
		 </div>
		 <div>
	  
	     <?php
        // render login button
		print drupal_render($form['form_build_id']);
		print drupal_render($form['form_id']);
		print drupal_render($form['actions']);
		?>

       </div>
     </form>
    </div>
    <!--form ends-->
  </div>
</div>