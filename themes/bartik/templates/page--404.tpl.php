<?php $themeurl = file_create_url(path_to_theme()); 

   global $base_url;
      $burl = $base_url."/";
      $message = "Oops Your requested page not found !!!!";
      drupal_set_message($message, $type = 'error');
      header("Location: ".$burl);
      die();  

?>
 <!-- GOOGLE FONTS -->
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,600' rel='stylesheet' type='text/css'>
    <!-- /GOOGLE FONTS -->
    <link rel="stylesheet" href="<?php echo $themeurl; ?>/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo $themeurl; ?>/css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo $themeurl; ?>/css/icomoon.css">
    <link rel="stylesheet" href="<?php echo $themeurl; ?>/css/styles.css">
    <link rel="stylesheet" href="<?php echo $themeurl; ?>/css/mystyles.css">
    <script src="<?php echo $themeurl; ?>/js/modernizr.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    
    <!--Added for destinations -->
    <link rel="stylesheet" href="<?php echo $themeurl; ?>/css/dest.min.css">
    <link rel="stylesheet" href="<?php echo $themeurl; ?>/css/default.css">
    <link rel="stylesheet" href="<?php echo $themeurl; ?>/css/component.css">
    <script src="<?php echo $themeurl; ?>/js/modernizr.custom.js"></script>

    
      <link rel="stylesheet" href="<?php echo $themeurl; ?>/css/ab-style.css" />
     <link rel="stylesheet" href="<?php echo $themeurl; ?>/css/menu-style.css" />
<?php global $base_url;  ?>
<div class="container-fuild full-sukh-404">
           <div class="full-center full-sukh">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6 col-md-offset-3">
                                    <p class="text-hero">404</p>
                                    <h1>Page is not found</h1>
                                    <a class="btn btn-primary btn-lg mt5" href="<?php echo $base_url; ?>"><i class="fa fa-long-arrow-left"></i> to Homepage</a>
                                </div>
                            </div>
                        </div>
                    </div>
           
        </div>
            