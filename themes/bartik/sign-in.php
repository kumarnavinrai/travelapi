<?php include 'header.php'?>
<div id="emptyDiv"></div>
<div id="description"></div>
<!--container start-->
<div id="container">
  <div id="container_body">
    <div>
      <h2 class="form_title">Travel Painters Register Form</h2>
      <p class="head_para"></p>
    </div>
    <!--Form  start-->
    <div id="form_name">
      <div class="firstnameorlastname">
       <form name="form"  action="Registeration-step-2.php">
       <div id="errorBox"></div>
       
         
      </div>
      <div id="email_form">
        <input type="email" name="Email" value=""  placeholder="Enter Email" class="input_email" required="required">
      </div>
        <div id="password_form">
        <input type="password" name="Password" value=""  placeholder="Enter Password" class="input_password" required="required">
      </div>
	  
	  <div>
      <input class="ab-signup" type="submit"  value="Sign In"/>
       </div>
     </form>
    </div>
    <!--form ends-->
  </div>
</div>
<!--container ends-->


<?php include 'footer.php'?>


