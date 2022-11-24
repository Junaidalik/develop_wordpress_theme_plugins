<?php
// Our custom post type function
function create_posttype()
{
    // set up product labels
    $labels = array(
        'name' => 'Property',
        'singular_name' => 'Property',
        'add_new' => 'Add New Property',
        'add_new_item' => 'Add New Property',
        'edit_item' => 'Edit Property',
        'new_item' => 'New Property',
        'all_items' => 'All Property',
        'view_item' => 'View Property',
        'search_items' => 'Search Property',
        'not_found' =>  'No Property Found',
        'not_found_in_trash' => 'No Property found in Trash',
        'parent_item_colon' => '',
        'menu_name' => 'Property',
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'property'),
            'show_in_rest' => true,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'trackbacks',
            'custom-fields',
            'comments',
            'revisions',
            'thumbnail',
            'author',
            'page-attributes'
        )
    );

    register_post_type('property', $args);
    //  1st taxonomy is created 
    register_taxonomy(
        'type',
        'property',  
        array(
            'hierarchical' => true,
            'show_ui'=> true,
            'show_admin_column'=> true,
            'label' => 'Type',
            'query_var' => true,
            'rewrite' => array('slug' => 'type'),

        )
    );
    // 2nd  taxonomy is created 
    register_taxonomy(
        'status',
        'property',
        array(
            'hierarchical' => true,
            'label' => 'Status',
            'show_ui'=> true,
            'query_var' => true,
            'show_admin_column'=> true,
            'rewrite' => array('slug' => 'status')
        )
    );
    // 3rd  taxonomy is created
    register_taxonomy(
        'currency',
        'property',
        array(
            'hierarchical' => true,
            'label' => 'Currency',
            'show_ui'=> true,
            'show_admin_column'=> true,
            'query_var' => true,
            'rewrite' => array('slug' => 'currency')
        )
    );
    // 4th  taxonomy is created
    register_taxonomy(
        'location',
        'property',
        array(
            'hierarchical' => true,
            'label' => 'Location',
            'show_ui'=> true,
            'query_var' => true,
            'show_admin_column'=> true,
            'rewrite' => array('slug' => 'location')
        )
    );
    // 5th  taxonomy is created
    register_taxonomy(
        'features',
        'property',
        array(
            'hierarchical' => false,
            'label' => 'Features',
            'show_ui'=> true,
            'query_var' => true,
            'show_admin_column'=> true,
            'rewrite' => array('slug' => 'features')
        )
    );
}
// Hooking up our function to theme setup
  add_action('init', 'create_posttype');

// show custom taxonomy and add custom column  in custom post type table

add_filter('manage_property_posts_columns' , 'mytheme_custom_post_type_columns');
add_action( 'manage_property_posts_custom_column' , 'mytheme_fill_custom_post_type_columns', 10, 2 );
     
        
        /** This function add column to table of post type */
        function mytheme_custom_post_type_columns($columns){
            $columns['property_price']  =  __('Property-Price',  '');          
            return  $columns;
         } 
        
        /** This function add value to respective column */
         function mytheme_fill_custom_post_type_columns($column_name, $post_id){
             if($column_name == "property_price"){
               $price = get_post_meta($post_id, '_property_price', true);
               echo $price;
            }    
      } 

/** create meta box fields */
function mytheme_add_custom_box()
{
    add_meta_box(
        'property_setting_metabox_1',
        'Additional Information',
        'mytheme_custom_box_html',
        'property',
        'normal',
        'default'                          // Post type
    );
}
add_action('add_meta_boxes', 'mytheme_add_custom_box');


/**call back function */
function mytheme_custom_box_html($post)
{
    $price  = get_post_meta($post->ID, '_property_price', true);
    $address = get_post_meta($post->ID, '_property_address', true);

?>
<table>
    <tr>
        <td><input type="number" id="property_price" name="property_price" class="postbox" placeholder="Price"
                value="<?php echo $price; ?>"></td>
        <td><input type="text" id="property_address" name="property_address" class="postbox" placeholder="Address"
                value="<?php echo $address; ?>"></td>
    </tr>

</table>

<?php
}

/**save post type data */
function mytheme_save_postdata($post_id)
{
    if(isset($_POST['property_price'])){
    update_post_meta($post_id,  '_property_price', $_POST['property_price']);
    }
    if(isset($_POST['property_address'])){
    update_post_meta($post_id,  '_property_address',  $_POST['property_address']);
    }
}
add_action('save_post', 'mytheme_save_postdata', 99);

/** the function to get the terms of taxonomy */
if(!function_exists('get_taxonomy_term')){
function get_taxonomy_term($post_id ,  $taxonomy){
    $terms = get_the_terms($post_id,$taxonomy);
    $taxon_term = "";
    if(is_array($terms) && count($terms)!==0){
        foreach ($terms as $term){
        $taxon_term =   $term->name;
     }
     return $taxon_term;
    }
 }

}

if(!function_exists("features_of_property")){
    function features_of_property($post_id,$taxonomy){
        $terms = get_the_terms($post_id,$taxonomy);
        return $terms;
    }
}

/** Add custom form field to a term of a taxonomy */

add_action( 'location_add_form_fields', 'new_add_term_fields' );

function new_add_term_fields( $taxonomy ) {
	?>
		<div class="form-field">
			<label for="new_text">New Text Field</label>
			<input type="text" name="new_text" id="new_text" />
		</div>
	<?php
}

/** add custom form field to a term of a taxonomy(location) in edit form */

add_action( 'location_edit_form_fields', 'new_edit_term_fields', 10, 2 );
function new_edit_term_fields( $term, $taxonomy ) {
	// get meta data value
	$text_field = get_term_meta( $term->term_id, 'new_text', true );
     ?><tr class="form-field">
		<th><label for="new_text">New Text Field</label></th>
		<td>
			<input name="new_text" id="new_text" type="text" value="<?php echo esc_attr( $text_field ) ?>" />
		</td>
	</tr>
 <?php
 ;
}

add_action( 'created_location', 'new_save_term_fields' );
add_action( 'edited_location', 'new_save_term_fields' );
function new_save_term_fields( $term_id ) {
	
	update_term_meta(
		$term_id,
		'new_text',
		sanitize_text_field( $_POST[ 'new_text' ] )
	);
	
	
}

add_action('manage_edit-location_columns','add_custom_column',10,1);
add_action('manage_location_custom_column', 'add_Text_Field_column_content',10,3);

function add_custom_column($columns){
    $columns['Text_Field'] = __( 'Text_Field', 'add_Text_Field_column_content' );
    return $columns;

}

function add_Text_Field_column_content($content, $column_name, $term_id ){
    if( $column_name ==  'Text_Field'){
        $content = esc_attr( get_term_meta( $term_id, 'new_text', true ));
        return $content;
    }
}

/** add custom column to post type(property) */

// call back function of ajax for php data


add_action( 'wp_ajax_nopriv_my_action', 'my_action' );
add_action( 'wp_ajax_my_action', 'my_action' );

function my_action() { 
    
    $args = array(  
        'post_type' => 'property',
        'post_status' => 'publish',
        'posts_per_page' => 3,
        'offset' => 3 , 
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
      
      $query = new WP_Query($args);

      print_r($_POST['page_no']);

    ?>
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
                  wp_reset_postdata();
                } 
                else
                { ?>
                    <h1 style="color:black; margin:3em"><?php echo esc_html("post not found!!") ?></h1>;
               <?php }
	wp_die(); 
}
