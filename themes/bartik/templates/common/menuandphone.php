<div class="col-md-1 col-md-offset-2">
                           
                        </div>
<div class="col-md-6">
                            <div class="top-user-area clearfix">
                                <ul class="top-user-area-list list list-horizontal list-border">
                                    <li><a href="<?php echo $sitelink; ?>checkpnr">Check PNR</a>
                                    <?php
                                       global $user;

                                      if ( $user->uid ) 
                                      { ?>
                                      <li><a href="<?php echo $sitelink; ?>mybookingdetails">Bookings</a>
                                        </li>
                                      <li><a href="<?php echo $sitelink; ?>user/<?php echo $user->uid; ?>/edit">Profile</a>
                                        </li>
                                       <li><a href="<?php echo $sitelink; ?>user/logout">Logout</a>
                                        </li>
                                       <?php
                                      }
                                      elseif(!$user->uid) 
                                      {
                                        ?>
                                        <li><a href="<?php echo $sitelink; ?>user/register">Register</a>
                                        </li>
                                        <li><a href="<?php echo $sitelink; ?>user">Sign in</a>
                                        </li>
                                      <?php  
                                      }
                                    ?>
                                    <li class="teleli"><a href="tel:1234">+1-888-417-0446</a>
                                        </li>
                                        <li>
                                        <img class="teleimg" src="<?php echo $themeurl; ?>/img/callf.png" alt="Image Alternative text" title="Image Title" />
                                        </li>
                                    
                                        </ul>
                                    
                                               
                            </div>
                        </div>