<div class="mfp-with-anim mfp-hide mfp-dialog mfp-search-dialog" id="search-dialog">
                <h2>Search and Save on Hotels</h2>
                  <!-- Added to handle the form -->           
                  <div id="messages" class="hotelerror" style="display:none;" >
                  City, Airport or Landmark and checkin/checkout is required.
                  </div>  
                  
                  <p></p> 
                  <!-- Finish Here -->
                  <form method="POST" action="<?php echo isset($_SESSION['urlforform'])?$_SESSION['urlforform']:""; ?>hotelsearch">
                    <div class="form-group form-group-lg form-group-icon-left">
                      <i class="fa fa-map-marker input-icon"></i>
                      <label>Where you want to stay?</label>
                      <input class="typeaheadhotel iamhotel form-control" name="hotelsearchcrt" placeholder="Enter a City, Airport or Landmark" type="text" />
                    </div>
                    <div class="input-daterange" data-date-format="M d, D">
                      <div class="row">
                        <div class="col-md-3 removepaddingright">
                          <div class="form-group form-group-lg form-group-icon-left">
                            <i class="fa fa-calendar input-icon input-icon-highlight icon-setting-sukh"></i>
                            <label>Check-in</label>
                             <input id="from_datepickerhotel" class="form-control date-setting-sukh" placeholder="yyyy-mm-dd" name="starth" type="text">
                             <!--  <input class="form-control" name="startx" type="text" /> -->
                          </div>
                        </div>
                        <div class="col-md-3 removepaddingright">
                          <div class="form-group form-group-lg form-group-icon-left">
                            <i class="fa fa-calendar input-icon input-icon-highlight icon-setting-sukh"></i>
                            <label>Check-out</label>
                            <input id="to_datepickerhotel" class="form-control  date-setting-sukh" name="endh" placeholder="yyyy-mm-dd" type="text" />
                          </div>
                        </div>
                        <div class="col-md-2">
                          <div class="form-group form-group-lg form-group-select-plus">
                            <label>Rooms</label>
                            <select name="rooms" class="form-control box-setting-sukh" >
                                          <option value="1">1</option>
                                          <option value="2">2</option>
                                          <option value="3">3</option>
                                          <option value="4">4</option>
                                          <option value="5">5</option>
                                          <option value="6">6</option>
                                          <option value="7">7</option>
                                          <option value="8">8</option>
                                          <option value="9">9</option>
                                        </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                          <div class="form-group form-group-lg form-group-select-plus">
                            <label>Adults</label>
                            <select name="adultshotel" class="form-control box-setting-sukh" >
                                          <option value="1">1</option>
                                          <option value="2">2</option>
                                          <option value="3">3</option>
                                          <option value="4">4</option>
                                          <option value="5">5</option>
                                          <option value="6">6</option>
                                          <option value="7">7</option>
                                          <option value="8">8</option>
                                          <option value="9">9</option>
                                        </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                          <div class="form-group form-group-lg form-group-select-plus">
                            <label>Children</label>
                            <select name="childrenhotelch" class="form-control box-setting-sukh" >
                                          <option value="0">0</option>
                                          <option value="1">1</option>
                                          <option value="2">2</option>
                                          <option value="3">3</option>
                                          <option value="4">4</option>
                                          <option value="5">5</option>
                                          <option value="6">6</option>
                                          <option value="7">7</option>
                                          <option value="8">8</option>
                                          <option value="9">9</option>
                                        </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="panel-group">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                      <a data-toggle="collapse" href="#collapse1">More Options</a>
                    </h4>
                </div>
                <div id="collapse1" class="panel-collapse collapse" style="height: auto;padding: 2px 17px;">
                 <div class="row">
                              <div class="col-md-6">
                                <div class="form-group form-group-lg form-group-icon-left sukh-lbel-more-color">
                                  <i class="fa fa-home input-icon input-icon-highlight"></i>
                                  <label>Hotel Name</label>
                                   <input class="form-control" name="hotelname" type="text" placeholder="Hotel Name" />
                                 </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group form-group-lg form-group-icon-left sukh-lbel-more-color">
                                <i class="fa fa-Star input-icon input-icon-highlight"></i>
                                  <label>Hotel Rating</label>
                                    <select name="childrenhotel" class="form-control box-setting-sukh" >
                                          <option value="Any">Any</option>
                                          <option value="1 star">1 Star</option>
                                          <option value="2 star">2 Star</option>
                                          <option value="3 star">3 Star</option>
                                          <option value="4 star">4 Star</option>
                                          <option value="5 star">5 Star</option>
                                        </select>
                                </div>
                              </div>
                              </div>
                </div>
            </div>
          </div>
            
                    <button class="btn btn-primary btn-lg nav_search_for_flights_hotel" type="submit">Search for Hotels</button>
                  </form>
            </div>
             <style>
        .mulhide{display: none;}
        .isa_error {
            color: #D8000C;
            background-color: rgba(255, 186, 186, 0.87);
            padding: 0em 1em;
          }
          #messages {
              margin-left: 0px;
              margin-right: 0px;
             /* background-color: rgba(24, 178, 146, 0.09);*/
             background-color: rgba(153, 153, 153, 0.75);
              border-radius: 1px;
              list-style-type: none;
              border: 0px solid;
              font-family: Arial;
              font-size: 15px;
              color: #bd362f;
              text-align: center;
          }

        </style>
        <script type="text/javascript">
          $(document).ready(function() {
            var max_fields      = 5; //maximum input boxes allowed
            var wrapper         = $(".input_fields_wrap"); //Fields wrapper
            var add_button      = $(".add_field_button"); //Add button ID
            
            var x = 2; //initlal text box count
            $(add_button).click(function(e){ //on add input button click
                e.preventDefault();
                if(x < max_fields){ //max input box allowed
                    x++; //text box increment
                    console.log(x);
                    var clstoshow = ".mul"+x;
                    $(clstoshow).show();
                    /*$(wrapper).append('<div class="row"><div class="col-md-12"><div class="col-md-4"><div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-map-marker input-icon"></i><label>From</label><input name="text[]" class="typeahead form-control" placeholder="City, Airport, U.S. Zip" type="text"/></div></div><div class="col-md-4"><div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-map-marker input-icon"></i><label>To</label><input name="text[]" class="typeahead form-control" placeholder="City, Airport, U.S. Zip" type="text"/></div></div><div class="col-md-4"><div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-calendar input-icon input-icon-highlight"></i><label>Departing</label><input id="from_datepicker" class="form-control date-setting-sukh-multi  hasDatepicker" placeholder="yyyy-mm-dd" name="startx" type="text"></div></div><a href="#" class="remove_field">Remove</a></div></div>');*/ //add input box
                }
            });
            $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
              e.preventDefault(); /*$(this).parent('div').remove();*/ x--;
              console.log(x);
            })

            $(".remove_field").on("click", function(e){ //user click on remove text
              e.preventDefault(); 
              //console.log($(this).attr('data'));
              var clstormv = "."+$(this).attr('data');
              $(clstormv).hide();
              x--;
              //console.log(x);
            })

            /* mldatepicker */
            /*$('#from_datepicker1').datepicker();    
            alert("abc");*/
            /*{
              minDate: 'D',
              dateFormat: "yyyy-mm-dd",
              defaultDate: "+1w",
              numberOfMonths: 2
            }*/

        });
        </script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script>
        $( function() {
          var dateFormat = 'yy-mm-dd';  
          $('#datepickercust1').datepicker({
              minDate: 'D',
              dateFormat: dateFormat,
              defaultDate: "+1w",
              numberOfMonths: 2,
              onClose: function(selectedDate) {
                $('#datepickercust2').datepicker("option", "minDate", selectedDate);
                $('#datepickercust2').val("");
                //$('#datepickercust2').datepicker("show");
              }
            });   

             $('#datepickercust2').datepicker({
                minDate: '+1D',
                dateFormat: dateFormat,
                defaultDate: "+1w",
                numberOfMonths: 2,
                onClose: function(selectedDate) {
                  $('#datepickercust3').datepicker("option", "minDate", selectedDate);
                  $('#datepickercust3').val("");
                  //$('#datepickercust3').datepicker("show");
              }
            });

             $('#datepickercust3').datepicker({
                minDate: '+1D',
                dateFormat: dateFormat,
                defaultDate: "+1w",
                numberOfMonths: 2,
                onClose: function(selectedDate) {
                  $('#datepickercust4').datepicker("option", "minDate", selectedDate);
                  $('#datepickercust4').val("");
                  //$('#datepickercust4').datepicker("show");
              }
            });

             $('#datepickercust4').datepicker({
                minDate: '+1D',
                dateFormat: dateFormat,
                defaultDate: "+1w",
                numberOfMonths: 2,
                onClose: function(selectedDate) {
                  $('#datepickercust5').datepicker("option", "minDate", selectedDate);
                  $('#datepickercust5').val("");
                  //$('#datepickercust5').datepicker("show");
              }
            });

             $('#datepickercust5').datepicker({
                minDate: '+1D',
                dateFormat: dateFormat,
                defaultDate: "+1w",
                numberOfMonths: 2
            });
        
        } );
        </script>
     <script type="text/javascript">
  $(document).ready(function(){
  
  
        $('.rtripandowselectorow').on('click',function(e)
        {
          $('.tocity').hide();
          $('.fromcity').hide();
          $('.startdate').hide();
          $('.enddate').hide();
        });
        
      $('.rtripandowselectorrt').on('click',function(e)
        {
          $('.tocity').hide();
          $('.fromcity').hide();
          $('.startdate').hide();
          $('.enddate').hide();
        });

 
      
          
    $('.nav_search_for_flights').on('click',function(e){
     if ($('#flight-search-1').hasClass('active')){
  
    /* Added to handle and display the form so that user inputs all the required information to process successfully */
  
        
    if($("input[name=from]").val() == "" && $("input[name=to]").val() == "" && $("input[name=start]").val() == "" && $("input[name=end]").val() == "")
        {
      $(".fromcity").hide();
      $(".tocity").hide();
      $(".startdate").hide(); 
      $(".enddate").hide();
      
          $(".fromcity").fadeIn();
      $(".tocity").fadeIn();
      $(".startdate").fadeIn(); 
      $(".enddate").fadeIn();   
          e.preventDefault();
        }
    
    else if($("input[name=from]").val() == "" && $("input[name=to]").val() == "" && $("input[name=start]").val() == "")
        {
      $(".fromcity").hide();
      $(".tocity").hide();
      $(".startdate").hide(); 
      $(".enddate").hide();
      
          $(".fromcity").fadeIn();
      $(".tocity").fadeIn();
      $(".startdate").fadeIn();     
          e.preventDefault();
        }
    
    else if($("input[name=from]").val() == "" && $("input[name=to]").val() == "" && $("input[name=end]").val() == "")
        {
      $(".fromcity").hide();
      $(".tocity").hide();
      $(".startdate").hide(); 
      $(".enddate").hide();
      
          $(".fromcity").fadeIn();
      $(".tocity").fadeIn();
      $(".enddate").fadeIn();   
          e.preventDefault();
        }

    else if($("input[name=from]").val() == "" && $("input[name=start]").val() == "" && $("input[name=end]").val() == "")
        {
      $(".fromcity").hide();
      $(".tocity").hide();
      $(".startdate").hide(); 
      $(".enddate").hide();
      
          $(".fromcity").fadeIn();
      $(".startdate").fadeIn();
      $(".enddate").fadeIn();   
          e.preventDefault();
        }

    else if($("input[name=to]").val() == "" && $("input[name=start]").val() == "" && $("input[name=end]").val() == "")
        {
      $(".fromcity").hide();
      $(".tocity").hide();
      $(".startdate").hide(); 
      $(".enddate").hide();
      
          $(".tocity").fadeIn();
      $(".startdate").fadeIn();
      $(".enddate").fadeIn();   
          e.preventDefault();
        }     
    
    else if($("input[name=from]").val() == "" && $("input[name=to]").val() == "")
        {
      $(".fromcity").hide();
      $(".tocity").hide();
      $(".startdate").hide(); 
      $(".enddate").hide();
    
          $(".fromcity").fadeIn();
      $(".tocity").fadeIn();    
          e.preventDefault();
        }
    
    else if($("input[name=start]").val() == "" && $("input[name=end]").val() == "")
        {
      $(".fromcity").hide();
      $(".tocity").hide();
      $(".startdate").hide(); 
      $(".enddate").hide();
      
      $(".startdate").fadeIn(); 
      $(".enddate").fadeIn();   
          e.preventDefault();
        }
    
    else if($("input[name=from]").val() == "" && $("input[name=start]").val() == "")
        {
      $(".fromcity").hide();
      $(".tocity").hide();
      $(".startdate").hide(); 
      $(".enddate").hide();
      
      $(".fromcity").fadeIn();  
      $(".startdate").fadeIn();   
          e.preventDefault();
        }
    
    else if($("input[name=from]").val() == "" && $("input[name=end]").val() == "")
        {
      $(".fromcity").hide();
      $(".tocity").hide();
      $(".startdate").hide(); 
      $(".enddate").hide();
      
      $(".fromcity").fadeIn();  
      $(".enddate").fadeIn();   
          e.preventDefault();
        }
    
    else if($("input[name=to]").val() == "" && $("input[name=start]").val() == "")
        {
      $(".fromcity").hide();
      $(".tocity").hide();
      $(".startdate").hide(); 
      $(".enddate").hide();
      
      $(".tocity").fadeIn();  
      $(".startdate").fadeIn();   
          e.preventDefault();
        }
    
    else if($("input[name=to]").val() == "" && $("input[name=end]").val() == "")
        {
      $(".fromcity").hide();
      $(".tocity").hide();
      $(".startdate").hide(); 
      $(".enddate").hide();
      
      $(".tocity").fadeIn();  
      $(".enddate").fadeIn();   
          e.preventDefault();
        }
  
    else if($("input[name=from]").val() == "")
        {
      $(".fromcity").hide();
      $(".tocity").hide();
      $(".startdate").hide(); 
      $(".enddate").hide();
      
      $(".fromcity").fadeIn();  
          e.preventDefault();
        }
    
    else if($("input[name=to]").val() == "")
        {
      $(".fromcity").hide();
      $(".tocity").hide();
      $(".startdate").hide(); 
      $(".enddate").hide();
      
      $(".tocity").fadeIn();  
          e.preventDefault();
        }
    
    else if($("input[name=start]").val() == "")
        {
      $(".fromcity").hide();
      $(".tocity").hide();
      $(".startdate").hide(); 
      $(".enddate").hide();
      
      $(".startdate").fadeIn();  
          e.preventDefault();
        }
    
    else if($("input[name=end]").val() == "")
        {
      $(".fromcity").hide();
      $(".tocity").hide();
      $(".startdate").hide(); 
      $(".enddate").hide();
      
      $(".enddate").fadeIn();  
          e.preventDefault();
        }
 /* End here*/  
  
        $("input[name=rfrom]").val("");
        $("input[name=tfrom]").val("");
      }    

    
    if ($('#flight-search-2').hasClass('active')){
    
        /* Added to handle and display the form so that user inputs all the required information to process successfully */
  
        
    if($("input[name=rfrom]").val() == "" && $("input[name=tfrom]").val() == "" && $("input[name=departing]").val() == "")
        {
      $(".fromcity").hide();
      $(".tocity").hide();
      $(".startdate").hide(); 
      
          $(".fromcity").fadeIn();
      $(".tocity").fadeIn();
      $(".startdate").fadeIn();     
          e.preventDefault();
        }
        
    else if($("input[name=rfrom]").val() == "" && $("input[name=tfrom]").val() == "")
        {
      $(".fromcity").hide();
      $(".tocity").hide();
      $(".startdate").hide(); 
    
          $(".fromcity").fadeIn();
      $(".tocity").fadeIn();    
          e.preventDefault();
        }
    
    else if($("input[name=rfrom]").val() == "" && $("input[name=departing]").val() == "")
        {
      $(".fromcity").hide();
      $(".tocity").hide();
      $(".startdate").hide(); 
      
      $(".fromcity").fadeIn();
      $(".startdate").fadeIn(); 
 
          e.preventDefault();
        }
    
    else if($("input[name=tfrom]").val() == "" && $("input[name=departing]").val() == "")
        {
      $(".fromcity").hide();
      $(".tocity").hide();
      $(".startdate").hide(); 
      
      $(".tocity").fadeIn();  
      $(".startdate").fadeIn();   
          e.preventDefault();
        }
    
  
    else if($("input[name=rfrom]").val() == "")
        {
      $(".fromcity").hide();
      $(".tocity").hide();
      $(".startdate").hide(); 
      $(".enddate").hide();
      
      $(".fromcity").fadeIn();  
          e.preventDefault();
        }
    
    else if($("input[name=tfrom]").val() == "")
        {
      $(".fromcity").hide();
      $(".tocity").hide();
      $(".startdate").hide(); 
      $(".enddate").hide();
      
      $(".tocity").fadeIn();  
          e.preventDefault();
        }
    
    else if($("input[name=departing]").val() == "")
        {
      $(".fromcity").hide();
      $(".tocity").hide();
      $(".startdate").hide(); 
      $(".enddate").hide();
      
      $(".startdate").fadeIn();  
          e.preventDefault();
        }
    
 /* End here*/  
    

        $("input[name=from]").val("");
        $("input[name=to]").val("");
      }

       if ($('#flight-search-3').hasClass('active')){  
       
        console.log("this is working");
        var anytextboxempty = 'no';
        $('.mlrow').each(function (index, value) { 
          
          
          if($(this).is(":visible")===true)
          {
            
            //console.log('div' + index + ':' + $(this).attr('class')); 
            $(this).find('input:text').each(function() {
                //console.log($(this).attr('name'));
                if($(this).attr('name') !== undefined && $(this).val()==="")
                {
                  console.log('empty');
                  anytextboxempty = 'yes';
                  return false;
                }
            });

          }

        });
        if(anytextboxempty == 'yes')
        {
           //console.log(anytextboxempty);
           $('.mlrow').each(function (index, value) { 
              if($(this).is(":visible")===true)
              {
                var divthis = $(this);
                $(this).find('input:text').each(function() {
                    if($(this).attr('name') !== undefined && $(this).val()==="")
                    {
                      divthis.find('.isa_error').remove();
                      var phtml = '<div class="isa_error"><i class="fa fa-times-circle"></i> Please fill From, To, and Departing .</div>';
                      divthis.prepend(phtml);
                      e.preventDefault(); 
                      return false;
                    }
                });
              }
            });
            
        }
        
       }
        
    });
  });
</script>