<?php 
/* Template Name: page search */
get_header();

$terms = get_terms( array(
  'taxonomy' => 'type',
  'hide_empty' => false,
));

$propert_type = "";
if(isset($_GET['property_type'])) {
$propert_type  = array(
    'taxonomy' => 'type',
    'field'    => 'slug',
    'terms'    => array($_GET['property_type']),
);
}
$slider_range="";
if(isset($_GET['pieces'])){
    $slider_range = array(
        'key'     => '_property_price',
        'value'   => $_GET['pieces'] ,
        'compare' => 'BETWEEN',
    );
}
$search_title ="";
if(isset($_GET['searchpost'])){
    $search_title = $_GET['searchpost'];
}

$args = array(  
  'post_type' => 'property',
  'post_status' => 'publish',
  'posts_per_page' => 2, 
  'orderby' => 'title', 
  'order' => 'ASC',
  'cat' => 'home',
  's'=> $search_title,
  
  'tax_query' => array(
    'relation' => 'AND',
    $propert_type,
   
  ),
    'meta_query' => array(
        'relation' => 'AND',
		$slider_range,
    ),
);

$query = new WP_Query($args);
 ?>


<div class="container">
    <div class="properties-listing spacer">

        <div class="row">
            <div class="col-lg-3 col-sm-4 ">

                <div class="search-form">
                    <h4><span class="glyphicon glyphicon-search"></span> Search for</h4><br/>                 
                    <form  id="form_id" method="GET" action="<?php echo esc_html( get_permalink()) ?>">
                    <input type="range" name="pieces" id="inputPieces" multiple value="<?php echo  esc_html(isset($_GET['pieces'][0])? $_GET['pieces'][0]:"" )?>,<?php echo esc_html(isset($_GET['pieces'][1])? $_GET['pieces'][1]:"") ?>" min="100" max="2000" unit=" Rs." style="width: 250px">
                    <br/>
                    <input  type="text" name="searchpost" id="searchpost" class="form-control" placeholder="Search of Properties">
                    <div class="row">
                        <div class="col-lg-5">
                            <select class="form-control">
                                <option>Buy</option>
                                <option>Rent</option>
                                <option>Sale</option>
                            </select>
                        </div>
                      
                        <div class="col-lg-7">
                            <select class="form-control">
                                <option>Price</option>
                                <option>$150,000 - $200,000</option>
                                <option>$200,000 - $250,000</option>
                                <option>$250,000 - $300,000</option>
                                <option>$300,000 - above</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                   
                        <div class="col-lg-12">
                            <select class="form-control" name="property_type">
                              <?php 
                              $terms = get_terms( array(
                                'taxonomy' => 'type',
                                'hide_empty' => false,
                            ));?>
                            <option placeholder="property type"></option>
                             <?php 
                              foreach($terms as $term):
                              ?>
                           
                            <option placeholder="property type"><?php echo esc_html($term->name) ?></option>
                                <?php  endforeach; ?>
                            </select>
                           
                           
                        </div>
                    </div>
                    <button type="submit" id="butsave" class="btn btn-primary">Find Now</button>
              </form>
                </div>



                <div class="hot-properties hidden-xs">
                    <h4>Hot Properties</h4>
                    <div class="row">
                      
                        <div class="col-lg-4 col-sm-5"><img src="<?php echo get_the_post_thumbnail_url()?>"
                                class="img-responsive img-circle" alt="properties"></div>
                        <div class="col-lg-8 col-sm-7">
                            <h5><a href="property-detail.php">Integer sed porta quam</a></h5>
                            <p class="price">$300,000</p>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-lg-4 col-sm-5"><img src="<?php echo get_the_post_thumbnail_url()?>"
                                class="img-responsive img-circle" alt="properties"></div>
                        <div class="col-lg-8 col-sm-7">
                            <h5><a href="property-detail.php">Integer sed porta quam</a></h5>
                            <p class="price">$300,000</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4 col-sm-5"><img src="<?php echo get_the_post_thumbnail_url()?>"
                                class="img-responsive img-circle" alt="properties"></div>
                        <div class="col-lg-8 col-sm-7">
                            <h5><a href="property-detail.php">Integer sed porta quam</a></h5>
                            <p class="price">$300,000</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4 col-sm-5"><img src="<?php echo get_the_post_thumbnail_url()?>"
                                class="img-responsive img-circle" alt="properties"></div>
                        <div class="col-lg-8 col-sm-7">
                            <h5><a href="property-detail.php">Integer sed porta quam</a></h5>
                            <p class="price">$300,000</p>
                        </div>
                    </div>

                </div>


            </div>

            <div class="col-lg-9 col-sm-8">
                <div class="sortby clearfix">
                    <div class="pull-left result">Showing: 12 of 100 </div>
                    <div class="pull-right">
                        <select class="form-control">
                            <option>Sort by</option>
                            <option>Price: Low to High</option>
                            <option>Price: High to Low</option>
                        </select>
                    </div>

                </div>
               <div class="row">
                   <!-- properties -->
                   <?php

                    if($query->have_posts()){
                       while($query->have_posts()){
                       $query->the_post();
                     
                      $status_name = get_taxonomy_term(get_the_ID() ,'status');
                      $curreny_name = get_taxonomy_term(get_the_ID() ,'currency');
                      $feature_names = features_of_property(get_the_ID(),"features");

                     
                      ?>

                    <div class="col-lg-4 col-sm-6">

                
                        <div class="properties">
                            <div class="image-holder"><img src="<?php echo get_the_post_thumbnail_url()?>" class="img-responsive"
                                    alt="properties">
                                <div class="status sold"><?php  echo esc_html( $status_name);  ?></div>
                            </div>
                            <h4><a href="property-detail.php"><?php echo the_title(); ?></a></h4>
                            <p class="price"><?php echo esc_html__('Price:','mytheme'); ?><?php echo  $curreny_name . get_post_meta( get_the_ID(), '_property_price', true); ?></p>
                            <div class="listing-detail">
                            <?php
                            foreach( $feature_names as $feature_name ):
                             $separator =explode('-',$feature_name->name);?>
                           <span data-toggle="tooltip" data-placement="bottom" data-original-title="<?php echo esc_html( $separator[1] ) ?>"><?php echo esc_html( $separator[0]) ?></span>
                            <?php endforeach; ?>
                           
                            </div>
                            <a class="btn btn-primary" href=<?php echo esc_html( get_permalink()) ?>>View Details</a>
                        </div>
                    </div>
                    <!-- properties -->
                    
                    <?php     
                       }

        echo paginate_links( array(
	        'base' => str_replace( $args['posts_per_page'], '%#%', esc_url( get_pagenum_link( $args['posts_per_page'] ) ) ),
	        'format' => '?paged=%#%',
	        'current' => max( 1, get_query_var('paged') ),
	        'total' => $query->max_num_pages
) );
                 
                  wp_reset_postdata();
                } 
                else
                { ?>
                    <h1 style="color:black; margin:3em"><?php echo esc_html("post not found!!") ?></h1>;
               <?php }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 

?>
<div class="center">
                        <ul class="pagination">
                            <li><a href="#">«</a></li>
                            <li><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                            <li><a href="#">»</a></li>
                        </ul>
                    </div>
                    
<?php get_footer();