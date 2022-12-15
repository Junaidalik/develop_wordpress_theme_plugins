<?php get_header();?>

<!-- banner -->
<div class="inside-banner">
    <div class="container">
        <span class="pull-right"><a href="#">Home</a> / Buy</span>
        <h2>Buy</h2>
    </div>
</div>
<!-- banner -->


<div class="container">
    <div class="properties-listing spacer">

        <div class="row">
            <div class="col-lg-3 col-sm-4 hidden-xs">

                <div class="hot-properties hidden-xs">
                    <h4>Hot Properties</h4>
                    <?php get_the_ID();  ?>
                    <div class="row">
                        <div class="col-lg-4 col-sm-5"><?php echo the_post_thumbnail('medium');?></div>
                        <div class="col-lg-8 col-sm-7">
                            <h5><a href="property-detail.php">Integer sed porta quam</a></h5>
                            <p class="price">$300,000</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-sm-5"><?php echo the_post_thumbnail('medium');?></div>
                        <div class="col-lg-8 col-sm-7">
                            <h5><a href="property-detail.php">Integer sed porta quam</a></h5>
                            <p class="price">$300,000</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4 col-sm-5"><?php echo the_post_thumbnail('medium');?></div>
                        <div class="col-lg-8 col-sm-7">
                            <h5><a href="property-detail.php">Integer sed porta quam</a></h5>
                            <p class="price">$300,000</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4 col-sm-5"><?php echo the_post_thumbnail('medium');?></div>
                        <div class="col-lg-8 col-sm-7">
                            <h5><a href="property-detail.php">Integer sed porta quam</a></h5>
                            <p class="price">$300,000</p>
                        </div>
                    </div>

                </div>



                <div class="advertisement">
                    <h4>Advertisements</h4>
                    <?php echo the_post_thumbnail('thumbnail');?>

                </div>

            </div>

            <div class="col-lg-9 col-sm-8 ">

                <h2><?php echo esc_html(the_title()) ?></h2>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="property-images">
                            <!-- Slider Starts -->
                            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                <!-- Indicators -->
                                <ol class="carousel-indicators hidden-xs">
                                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                    <li data-target="#myCarousel" data-slide-to="1" class=""></li>
                                    <li data-target="#myCarousel" data-slide-to="2" class=""></li>
                                    <li data-target="#myCarousel" data-slide-to="3" class=""></li>
                                </ol>
                                <div class="carousel-inner">
                                    <!-- Item 1 -->
                                    <div class="item active">
                                        <?php echo the_post_thumbnail('full');?>
                                    </div>
                                    <!-- #Item 1 -->

                                    <!-- Item 2 -->
                                    <div class="item">
                                        <?php echo the_post_thumbnail('full');?>

                                    </div>
                                    <!-- #Item 2 -->

                                    <!-- Item 3 -->
                                    <div class="item">
                                        <?php echo the_post_thumbnail('full');?>
                                    </div>
                                    <!-- #Item 3 -->

                                    <!-- Item 4 -->
                                    <div class="item ">
                                        <?php echo the_post_thumbnail('full');?>

                                    </div>
                                    <!-- # Item 4 -->
                                </div>
                                <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span
                                        class="glyphicon glyphicon-chevron-left"></span></a>
                                <a class="right carousel-control" href="#myCarousel" data-slide="next"><span
                                        class="glyphicon glyphicon-chevron-right"></span></a>
                            </div>
                            <!-- #Slider Ends -->

                        </div>




                        <div class="spacer">
                            <h4><span class="glyphicon glyphicon-th-lit"></span> Properties Detail</h4>
                            <p><?php echo esc_html__(get_the_content(get_the_ID())); ?> </p>

                        </div>
                        <?php  $location_name = get_taxonomy_term(get_the_ID(),"location"); ?>
                        <div>
                            <h4><span
                                    class="glyphicon glyphicon-map-marker"></span><?php echo esc_html($location_name) ?>
                            </h4>
                            <div class="well"><iframe width="100%" height="350" frameborder="0" scrolling="no"
                                    marginheight="0" marginwidth="0"
                                    src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Pulchowk,+Patan,+Central+Region,+Nepal&amp;aq=0&amp;oq=pulch&amp;sll=37.0625,-95.677068&amp;sspn=39.371738,86.572266&amp;ie=UTF8&amp;hq=&amp;hnear=Pulchowk,+Patan+Dhoka,+Patan,+Bagmati,+Central+Region,+Nepal&amp;ll=27.678236,85.316853&amp;spn=0.001347,0.002642&amp;t=m&amp;z=14&amp;output=embed"></iframe>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-4">
                        <div class="col-lg-12  col-sm-6">
                            <div class="property-info">
                                <?php  $curreny_name = get_taxonomy_term(get_the_ID() ,'currency'); ?>
                                <p class="price">
                                    <?php echo  $curreny_name . get_post_meta( get_the_ID(), '_property_price', true); ?>
                                </p>
                                <p class="area"><span
                                        class="glyphicon glyphicon-map-marker"></span><?php echo esc_html(get_post_meta( get_the_ID(), '_property_address', true)); ?>
                                </p>

                                <div class="profile">
                                    <span class="glyphicon glyphicon-user"></span> Agent Details
                                    <p><?php echo esc_html(get_userdata( $post->post_author)->data->display_name )?></p>

                                </div>
                            </div>

                            <h6><span class="glyphicon glyphicon-home"></span> Availabilty</h6>
                            <div class="listing-detail"><?php  
          $feature_names = features_of_property(get_the_ID(),"features"); 
          foreach( $feature_names as $feature_name ):?>
                                <?php  
            $separator =explode('-',$feature_name->name);
           
            ?>
                                <span data-toggle="tooltip" data-placement="bottom"
                                    data-original-title="<?php echo esc_html( $separator[1] ) ?>"><?php echo esc_html( $separator[0]) ?></span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-6 ">
                            <div class="enquiry">
                                <h6><span class="glyphicon glyphicon-envelope"></span> Post Enquiry</h6>
                                <form role="form">
                                    <input type="text" class="form-control" placeholder="Full Name" />
                                    <input type="text" class="form-control" placeholder="you@yourdomain.com" />
                                    <input type="text" class="form-control" placeholder="your number" />
                                    <textarea rows="6" class="form-control"
                                        placeholder="Whats on your mind?"></textarea>
                                    <button type="submit" class="btn btn-primary" name="Submit">Send Message</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<?php get_footer();