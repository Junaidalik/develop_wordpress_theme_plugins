<?php get_header();

$args = array(  
        'post_type' => 'property',
        'post_status' => 'publish',
        'posts_per_page' => -1, 
        'orderby' => 'title', 
        'order' => 'ASC',
        'cat' => 'home',
    );
$loop = new WP_Query( $args ); ?>
<!-- <div id="slider" class="sl-slider-wrapper">

<div class="sl-slider">

  <div class="sl-slide" data-orientation="horizontal" data-slice1-rotation="-25" data-slice2-rotation="-25" data-slice1-scale="2" data-slice2-scale="2">
    <div class="sl-slide-inner">
      <div class="bg-img" style="background-image: url('<?php //echo get_the_post_thumbnail_url() ?>')"></div>
      <h2><a href="#">2 Bed Rooms and 1 Dinning Room Aparment on Sale</a></h2>
      <blockquote>              
      <p class="location"><span class="glyphicon glyphicon-map-marker"></span> 1890 Syndey, Australia</p>
      <p>Until he extends the circle of his compassion to all living things, man will not himself find peace.</p>
      <cite>$ 20,000,000</cite>
      </blockquote>
    </div>
  </div>
 
</div>/sl-slider -->



<!-- <nav id="nav-dots" class="nav-dots">
  <span class="nav-dot-current"></span>
  <span></span>
  <span></span>
  <span></span>
  <span></span>
</nav>

</div></slider-wrapper -->
</div> -->

<div class="banner-search">
    <div class="container">
        <!-- banner -->
        <h3>Buy, Sale & Rent</h3>
        <div class="searchbar">
            <div class="row">
            <form id="form_id" method="GET" action="<?php echo home_url('/').'page-search' ?>">
                <div class="col-lg-6 col-sm-6">
                    <input type="text" name="searchpost" id="searchpost"  class="form-control" placeholder="Search of Properties">
                    <div class="row">
                        <div class="col-lg-3 col-sm-3 ">
                            <select class="form-control">
                                <option>Buy</option>
                                <option>Rent</option>
                                <option>Sale</option>
                            </select>
                        </div>
                        <div class="col-lg-3 col-sm-4">
                            <select class="form-control">
                                <option>Price</option>
                                <option>$150,000 - $200,000</option>
                                <option>$200,000 - $250,000</option>
                                <option>$250,000 - $300,000</option>
                                <option>$300,000 - above</option>
                            </select>
                        </div>
                        <div class="col-lg-3 col-sm-4">
                            <select class="form-control">
                                <option>Property</option>
                                <option>Apartment</option>
                                <option>Building</option>
                                <option>Office Space</option>
                            </select>
                        </div>
                        <div class="col-lg-3 col-sm-4">
                            <button class="btn btn-success"  type="submit" id="butsave">Find
                                Now</button>
                        </div>
                    </div>
                    
                </div>
            </form>
                <div class="col-lg-5 col-lg-offset-1 col-sm-6 ">
                    <p>Join now and get updated with all the properties deals.</p>
                    <button class="btn btn-info" data-toggle="modal" data-target="#loginpop">Login</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- banner -->
<div class="container">
    <div class="properties-listing spacer"> <a href="buysalerent.php" class="pull-right viewall">View All Listing</a>
        <h2>Featured Properties</h2>
        <div id="owl-example" class="owl-carousel">
            <!-- here is loop to get posts -->
        <?php   while ( $loop->have_posts() ) : $loop->the_post(); 
           /**call of function to get taxonomy terms */
        $status_name = get_taxonomy_term(get_the_ID() ,'status');
        $curreny_name = get_taxonomy_term(get_the_ID() ,'currency');?>
            <div  class="properties" id="property">
                <div  class="image-holder"><img src="<?php echo get_the_post_thumbnail_url()?>" class="img-responsive" alt="properties"/>
                    <div  class="status new"><?php  echo esc_html( $status_name);  ?></div>
                </div>
                <h4><a href="single-property.php"><?php echo the_title(); ?></a></h4>
                <p class="price">
                    <?php echo esc_html__('Price:','mytheme'); ?><?php echo  $curreny_name . get_post_meta( get_the_ID(), '_property_price', true); ?>
                </p>
                <div class="listing-detail"><?php  
          $feature_names = features_of_property(get_the_ID(),"features"); 
          foreach( $feature_names as $feature_name ):?>
         <?php $separator =explode('-',$feature_name->name);?>
                    <span data-toggle="tooltip" data-placement="bottom"
                        data-original-title="<?php echo esc_html( $separator[1] ) ?>"><?php echo esc_html( $separator[0]) ?></span>
                    <?php endforeach; ?>
                </div>
                <a class="btn btn-primary" href=<?php echo esc_html( get_permalink()) ?>>View Details</a>
            </div>
            <?php   endwhile; ?>
            <!-- loop finish here -->
        </div>
    </div>
    
    <div class="spacer">
        <div class="row">
            <div class="col-lg-6 col-sm-9 recent-view">
                <h3>About Us</h3>
                <p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested.
                    Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in
                    their exact original form, accompanied by English versions from the 1914 translation by H.
                    Rackham.<br><a href="about.php">Learn More</a></p>

            </div>
            <div class="col-lg-5 col-lg-offset-1 col-sm-3 recommended">
                <h3>Recommended Properties</h3>
                <div id="myCarousel" class="carousel slide">
                    <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1" class=""></li>
                        <li data-target="#myCarousel" data-slide-to="2" class=""></li>
                        <li data-target="#myCarousel" data-slide-to="3" class=""></li>
                    </ol>
                    <!-- Carousel items -->
                    <div class="carousel-inner">
                        <div class="item active"> 
                            <div class="row">
                                <div class="col-lg-4"><img src=<?php echo get_the_post_thumbnail_url() ?>
                                        class="img-responsive" alt="properties" /></div>
                                <div class="col-lg-8">
                                    <h5><a href="property-detail.php">Integer sed porta quam</a></h5>
                                    <p class="price">$300,000</p>
                                    <a href="property-detail.php" class="more">More Detail</a>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="row">
                                <div class="col-lg-4"><img src=<?php echo get_the_post_thumbnail_url() ?>
                                        class="img-responsive" alt="properties" /></div>
                                <div class="col-lg-8">
                                    <h5><a href="property-detail.php">Integer sed porta quam</a></h5>
                                    <p class="price">$300,000</p>
                                    <a href="property-detail.php" class="more">More Detail</a>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="row">
                                <div class="col-lg-4"><img src=<?php echo get_the_post_thumbnail_url() ?>
                                        class="img-responsive" alt="properties" /></div>
                                <div class="col-lg-8">
                                    <h5><a href="property-detail.php">Integer sed porta quam</a></h5>
                                    <p class="price">$300,000</p>
                                    <a href="property-detail.php" class="more">More Detail</a>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="row">
                                <div class="col-lg-4"><img src=<?php echo get_the_post_thumbnail_url() ?>
                                        class="img-responsive" alt="properties" /></div>
                                <div class="col-lg-8">
                                    <h5><a href="property-detail.php">Integer sed porta quam</a></h5>
                                    <p class="price">$300,000</p>
                                    <a href="property-detail.php" class="more">More Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php    
 
 get_footer();