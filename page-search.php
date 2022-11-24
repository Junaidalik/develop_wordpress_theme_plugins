<!-- <script src="ajax.js"></script> -->
<?php 
/* Template Name: page search */
get_header();

$terms = get_terms( array(
  'taxonomy' => 'type',
  'hide_empty' => false,
));
// echo "<pre>"; print_r($terms); echo "</pre>";
//   exit();
$property_type="";
if(isset($_GET['property_type'])){
$property_type  = array(
    'taxonomy' => 'type',
    'field'    => 'slug',
    'terms'    => array($_GET['property_type']),
);

}
$property_currency="";
if(isset($_GET['property_currency'])){
$property_currency  = array(
    'taxonomy' => 'currency',
    'field'    => 'slug',
    'terms'    => array($_GET['property_currency']),
);
}
$property_features="";
if(isset($_GET['property_features']))
$property_features  = array(
    'taxonomy' => 'features',
    'field'    => 'slug',
    'terms'    => array($_GET['property_features']),
);

  
$slider_range = "";
  if(isset($_GET['pieces'][0]) && isset($_GET['pieces'][0] ))
  {

    $slider_range = array(
        'key'     => '_property_price',
        'value'   =>array($_GET['pieces'][0] , $_GET['pieces'][1]),
        'compare' => 'BETWEEN',
    );

  }


$search_title ="";
if(isset($_GET['searchpost'])){
    $search_title = $_GET['searchpost'];
}
// to change the data of page query argument
$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
$args = array(  
  'post_type' => 'property',
  'post_status' => 'publish',
  'posts_per_page' => 3, 
  'paged' => $paged,
  'orderby' => 'title', 
  'order' => 'ASC',
  //'cat' => 'home',
  's'=> $search_title,
   'tax_query' => array(
    'relation' => 'AND',
    $property_type,
    $property_currency,
    $property_features,
   
  ),
    'meta_query' => array(
		$slider_range,
     ),
    
);

// $query = new WP_Query($args);


// echo "<pre>";
// print_r($args);
// echo "</pre>";

 ?>


<div class="container">
    <div class="properties-listing spacer">

        <div class="row">
            <div class="col-lg-3 col-sm-4 ">

                <div class="search-form">
                    <h4><span class="glyphicon glyphicon-search"></span> Search for</h4><br/>                 
                    <form  id="form_id" name="form_data" method="GET" action="<?php echo esc_html( get_permalink()) ?>">

                     
                     <input type="hidden" id="page_no" name="page_no" value="1" />
                     
                     
                    <input type="range" name="pieces" id="inputPieces" multiple value="<?php echo  esc_html(isset($_GET['pieces'][0])? $_GET['pieces'][0]:"" )?>,<?php echo esc_html(isset($_GET['pieces'][1])? $_GET['pieces'][1]:"") ?>" min="100" max="2000" unit=" Rs." style="width: 250px">
                    <br/>
                    <input  type="text" name="searchpost" id="searchpost" value="" class="form-control" placeholder="Search of Properties">
                    <div class="row">
                        <div class="col-lg-6">

                            <select class="form-control" placeholder="property currency" name="property_currency">
                              <?php 
                              $terms = get_terms( array(
                                'taxonomy' => 'currency',
                                'hide_empty' => false,
                            ));?>
                            <option <?php echo esc_html(isset($_GET["property_currency"]) ? '':'selected' ) ?> disabled>currency</option>
                             <?php foreach($terms as $term){ ?>
                            <option <?php echo ((isset($_GET['property_currency']) ? $_GET['property_currency']:'') == $term->slug) ? 'selected':'' ?> value="<?php echo $term->slug?>"><?php echo $term->name ?></option>
                                <?php } ?>
                            </select>
                        </div>
                      
                        <div class="col-lg-6">
                        <select class="form-control" placeholder="property features" name="property_features">
                              <?php 
                              $terms = get_terms( array(
                                'taxonomy' => 'features',
                                'hide_empty' => false,
                            ));?>
                            <option <?php echo esc_html(isset($_GET["property_features"]) ? '':'selected' ) ?> disabled>features</option>
                             <?php foreach($terms as $term){ ?>
                            <option <?php echo ((isset($_GET['property_features']) ? $_GET['property_features']:'') == $term->slug) ? 'selected':'' ?> value="<?php echo $term->slug?>"><?php echo $term->name ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                   
                        <div class="col-lg-12">
                            <select class="form-control" placeholder="property type" name="property_type">
                              <?php 
                              $terms = get_terms( array(
                                'taxonomy' => 'type',
                                'hide_empty' => false,
                              ));                              
                            ?>
                            <option <?php echo esc_html(isset($_GET["property_type"]) ? '':'selected' ) ?> disabled>type</option>
                             <?php foreach($terms as $term){ ?>
                            <option <?php echo ((isset($_GET['property_type']) ? $_GET['property_type']:'') == $term->slug) ? 'selected':'' ?>  value="<?php echo $term->slug?>"><?php echo $term->name ?></option>
                                <?php } ?>
                            </select>
                           
                           
                        </div>
                    </div>
                    <?php
                    //  echo "<pre>";
                    //  print_r($terms);
                    //  echo "</pre>";
                    ?>
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
               <div class="row" id="properties_div">
                   <!-- properties -->
                
                </div>
                <!-- pagination start -->
                <div class="center">
             <?php 
                //  echo paginate_links( array(
                //         'base' => str_replace( $args['posts_per_page'],'%#%', esc_url(get_pagenum_link( $args['posts_per_page']) )  ),
                //         'format' => '?paged=%#%',
                //         'current' => max( 1, get_query_var('paged') ),
                //         'total' => $query->max_num_pages
                // ));

                // echo esc_url(get_pagenum_link( $args['posts_per_page']));
                ?>
                </div>
                <!-- pagination end -->
                <!-- load more -->
                <div class="btn__wrapper">
                    <button class="btn btn-info btn-lg" id="load_more">Load more</button>
                </div>
                
            </div>
        </div>
    </div>
</div>


                    
<?php get_footer();