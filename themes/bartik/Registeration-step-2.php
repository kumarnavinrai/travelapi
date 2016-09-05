<?php include 'header.php'?>

<div id="emptyDiv"></div>
<div id="description"></div>
<!--container start-->
<div id="container">
  <div id="container_body">
    <div>
      <h2 class="form_title">Travel Painters Register Form </h2>
      <p class="head_para"></p>
    </div>
    <!--Form  start-->
    <div id="form_name">
      <div class="firstnameorlastname">
       <form name="form" >
       <div id="errorBox"></div>
        <input type="text" name="Name" value="" placeholder="First Name"  class="input_name" required="required" >
        <input type="text" name="LastName" value="" placeholder="Last Name" class="input_name"  required="required">
         
      </div>
      <div id="radio_button">
	Gender :<br>
        <input type="radio" name="radiobutton" value="Female" required="required">
    Female
        &nbsp;&nbsp;&nbsp;
        <input type="radio" name="radiobutton" value="Male" required="required">
    Male      </div>
      <!--DOB details start-->
      <div>
      </div>
		<div class="input-daterange" data-date-format="M d, D">
			<div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-calendar input-icon input-icon-highlight"></i>
			   <label>Date of Birth</label>
				<input class="form-control sukh" name="start" type="text" />
			</div>
		</div>
		
      
      </div>
      <!--DOB details ends-->
     
       <div>
         <input class="ab-signup" type="submit"  value="Submit"/>
      </div>
     </form>
    </div>
    <!--form ends-->
  </div>
</div>
<!--container ends-->
<?php include 'footer.php'?>