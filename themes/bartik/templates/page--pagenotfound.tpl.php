<?php $themeurl = file_create_url(path_to_theme()); ?>
<?php global $base_url;  ?>
<div class="full-page">
            <div class="bg-holder full">
                <div class="bg-mask"></div>
                <div class="bg-blur" style="background-image:url(<?php echo $themeurl ?>/img/196_365_1300x900.jpg);"></div>
                <div class="bg-holder-content full text-white">
                    <a class="logo-holder" href="index.php">
                        <img src="<?php echo $themeurl ?>/img/logo-invert.png" alt="Image Alternative text" title="Image Title">
                    </a>
                    <div class="full-center">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6 col-md-offset-3">
                                    <p class="text-hero">404</p>
                                    <h1>Page is not found</h1>
                                    <a class="btn btn-white btn-ghost btn-lg mt5" href="<?php echo $base_url; ?>"><i class="fa fa-long-arrow-left"></i> to Homepage</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            