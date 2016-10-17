
    <div class="user-login-links">
	<span class="password-link"><a href="/user/password">Forget your password?</a></span> | <span class="register-link"><a href="/user/register">Create an account</a></span>
    </div>

 
<!-- /user-login-custom-form -->

<div id="emptyDiv"></div>
<div id="description"></div>
<!--container start-->
<div id="container">
  <div id="container_body">
    <div>
      <h3 class="form_title">Please Login</h3>
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
        <div id="password_form">
		<?php
		//print path_to_theme();
		//print file_create_url(path_to_theme()).'/css/ab-style.css';
		//print drupal_get_path('theme', 'bartik'). '/css/ab-style.css';
		
		//drupal_add_css(file_create_url(path_to_theme()).'/css/ab-style.css');
			//$form['pass'] = array
			//(
			//  '#type' => 'password',
			//  '#title' => t('Password'),
			//  '#description' => t('Please enter your password'),
			//  '#size' => 32,
			//  '#maxlength' => 32,
			//  '#required' => 1,
			//);
			
			print drupal_render($form['pass']); 
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
<!--container ends-->