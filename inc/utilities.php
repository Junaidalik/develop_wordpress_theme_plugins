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

$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
// my_action function for page-search
function my_action() { 

  $data =$_POST['form_data'];
  $form_Data   =    array();
  parse_str($data,$form_Data );
//  print_r($form_Data['property_type']);

  $property_type="";
  if(isset($form_Data['property_type'])){
  $property_type  = array(
      'taxonomy' => 'type',
      'field'    => 'slug',
      'terms'    => array($form_Data['property_type']),
  );
  
  }
  $property_currency="";
  if(isset($form_Data['property_currency'])){
  $property_currency  = array(
      'taxonomy' => 'currency',
      'field'    => 'slug',
      'terms'    => array($form_Data['property_currency']),
  );
  }
  $property_features="";
  if(isset($form_Data['property_features'])){
  $property_features  = array(
      'taxonomy' => 'features',
      'field'    => 'slug',
      'terms'    => array($form_Data['property_features']),
  ); 
}  
  $slider_range = "";
  if(isset($form_Data['pieces'][0]) && isset($form_Data['pieces'][0] )){
  $slider_range = array(
          'key'     => '_property_price',
          'value'   =>array($form_Data['pieces'][0] , $form_Data['pieces'][1]),
          'compare' => 'BETWEEN',
      );
}
  $search_title ="";
  if(isset($form_Data['searchpost'])){
      $search_title = $form_Data['searchpost'];
  }

    $args = array(  
        'post_type' => 'property',
        'post_status' => 'publish',
        'posts_per_page' => 2,
        'paged' => $form_Data['page_no'] , 
        'orderby' => 'title', 
        'order' => 'ASC',
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

    //   echo "<pre>"; print_r($query); echo "</pre>"; 
      $total_posts =  $query->found_posts;
      $total_pages =   ceil( $total_posts / 2);

       
    //    echo '<input type="hidden" value="'.$total_pages.'" id="total_pages">';
    ?><input type="hidden" value="<?php echo esc_attr($total_pages) ?>" id="total_pages">;

<?php 
      if($query->have_posts()){
            $data = array();
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
        <p class="price">
            <?php echo esc_html__('Price:','mytheme'); ?><?php echo  $curreny_name . get_post_meta( get_the_ID(), '_property_price', true); ?>
        </p>
        <div class="listing-detail">
            <?php
             foreach( $feature_names as $feature_name ):
                $separator =explode('-',$feature_name->name);?>
            <span data-toggle="tooltip" data-placement="bottom"
                data-original-title="<?php echo esc_html( $separator[1] ) ?>"><?php echo esc_html( $separator[0]) ?></span>
            <?php endforeach; ?>
        </div>


        <a class="btn btn-primary" href=<?php echo esc_html( get_permalink()) ?>>View Details</a>
    </div>
</div>

<?php }               
// wp_send_json_success(array('number_of_pages'=> 7,'data'=>$data),200);
        wp_reset_postdata();
  } else{ 
    // $error = new WP_Error( '400', 'No user information was retrieved.', 'Please try later' );
    // wp_send_json_error( $error );
    
    ?>
<h1 style="color:black; margin:3em"><?php //echo esc_html("post not found!!") ?></h1>;
<?php }
	wp_die(); 
}

// action function for my-form-widget

add_action( 'wp_ajax_nopriv_widget_action', 'widget_action' );
add_action( 'wp_ajax_widget_action', 'widget_action' );

function widget_action(){  
    
    $data = $_POST['form_data'];
    $form_data = array();
    parse_str($data, $form_data);

    $user_id = get_current_user_id();    
    
    $post_id = isset($form_data['is_update']) ? $form_data['is_update'] : '' ;
     if($post_id == ""){
        $post_id = get_user_meta( $user_id,  'property_processing', true );
     }
     if($post_id == ""){
        wp_send_json_error(array('status' => 'error', 'message' => __('please set title first to upload image`!', 'mwp-dropform')));
     }


   

     if($form_data['title'] != ''){
  
        $args = array(
                 'post_title'    => wp_strip_all_tags( $form_data['title'] ),
                 'post_content'  => $form_data['description'],
                 'post_type'             => 'property',
                 'ID'    =>  $post_id,
                 'post_status'   => 'publish',
      );
    
        //  Insert the post into the database
        $post_id = wp_update_post( $args, true );
    }else{
        // alert('still not set title');
        echo 'not set title';
    }




       delete_user_meta( $user_id,  'property_processing');

        //  set term for taxonomy type
        $type_term_id = $form_data['property_type'];
        $type_term_id = array($type_term_id);

        wp_set_post_terms($post_id, $type_term_id, 'type');
        
        // set term for taxonomy currency
        $currency_term_id = $form_data['property_currency'];
        $currency_term_id = array($currency_term_id);
        
        wp_set_post_terms($post_id, $currency_term_id, 'currency');

         // set term for taxonomy status
        $status_term_id = $form_data['property_status'];
        $status_term_id = array($status_term_id);
         
        wp_set_post_terms($post_id, $status_term_id, 'status');

        // set term for taxonomy status
        $location_term_id = $form_data['property_location'];
        $location_term_id = array($location_term_id);
                    
        wp_set_post_terms($post_id, $location_term_id, 'location');

        // set price

            if(isset($form_data['price'])){
            update_post_meta($post_id,  '_property_price', $form_data['price']);
            }
            
            // if(isset($_POST['address'])){
            // update_post_meta($post_id,  '_property_address',  $form_data['address']);
          // }
      
    ?>
<?php
}
// <------------------------------- dropzone image upload action ------------------------------>

add_action( 'wp_ajax_nopriv_upload_sb_pro_events_images', 'upload_sb_pro_events_images' );
add_action( 'wp_ajax_upload_sb_pro_events_images', 'upload_sb_pro_events_images' );

function upload_sb_pro_events_images(){

    $user_id = get_current_user_id();
    $post_id = isset($_GET['is_update']) ? $_GET['is_update'] : '' ;
     if($post_id == ""){
        $post_id = get_user_meta( $user_id,  'property_processing', true );
     }
     if($post_id == ""){
        wp_send_json_error(array('status' => 'error', 'message' => __('please set title first to upload image!', 'mwp-dropform')));
     }

        if (!empty($_FILES)) {

            require_once( ABSPATH . 'wp-admin/includes/image.php' );
            require_once( ABSPATH . 'wp-admin/includes/file.php' );
            require_once( ABSPATH . 'wp-admin/includes/media.php' );

                foreach ($_FILES as $file => $array) {
                    if ($_FILES[$file]['error'] !== UPLOAD_ERR_OK) {
                        wp_send_json_error(array('status' => 'error', 'message' => __('Error: ', 'mwp-dropform') . $_FILES[$file]['error']));
                    }      
                    //  <--- set condition for post_id and post_meta-id --->
                   
                        
                        $attachment_id = media_handle_upload($file, $post_id);
                if (is_wp_error($attachment_id)) { 
                    wp_send_json_error(array(
                        'status' => 'error',
                        'message' => __('Error while processing file', 'mwp-dropform'),
                        ));
                    } else {
                        wp_send_json_success(array(
                            'status' => 'ok',
                            'attachment_id' => $attachment_id,
                            'message' => __('File uploaded', 'mwp-dropform'),
                        ));
                    }
                }
         
        
    }}

    
    
//  <------------------------------- onblur field create action -------------------------->

add_action( 'wp_ajax_nopriv_title_action', 'title_action' );
add_action( 'wp_ajax_title_action', 'title_action' );
 function title_action(){

        $data = $_POST['form_data'];
        $form_data = array();
        parse_str($data, $form_data);

        $title_value = isset($form_data['title']) ? $form_data['title'] : '';

        $user_id = get_current_user_id();
        $post_id = isset($_GET['is_update']) ? $_GET['is_update'] : '' ;

       if($post_id == ""){
          $post_id = get_user_meta( $user_id,  'property_processing', true );
       }
       if($post_id == ""){
        wp_send_json_error(array('status' => 'error', 'message' => __('please set title first to upload image!', 'mwp-dropform')));
       }  

          if($post_id == "" || $post_id == "0" ){

                $args = array(
                    'post_title'    => wp_strip_all_tags( $title_value ),
                    'post_type'     => 'property',
                    'post_status'   => 'pending',
                  );

                 $post_id =   wp_insert_post($args);
                 

                //  print_r( $post_id );
                //  echo "create";

                 update_user_meta( $user_id,  'property_processing', $post_id );

            }  else{
                
                $args = array(
                    'post_title'    => wp_strip_all_tags( $title_value ),
                    'ID' => $post_id,
                    'post_type'     => 'property',
                    'post_status'   => 'pending',           
                  );
                  
                   $post_id = wp_update_post( $args);
                //   print_r($post_id);

            }
            

          }

// <-------------------get event images action function in dropzone to get all images against a specific post----------------------------->

        add_action( 'wp_ajax_nopriv_get_event_images', 'get_event_images' );
        add_action( 'wp_ajax_get_event_images', 'get_event_images' );

    if(!function_exists('get_event_images')){
        function get_event_images(){

                $post_id = isset($_POST['is_update']) ? $_POST['is_update'] : 0 ;

                if($post_id != '' || $post_id != '0'){

                $media = get_attached_media( 'image', $post_id );

                }
                else{

                    $user_id = get_current_user_id();
                    $post_meta_id = get_user_meta( $user_id,  'property_processing', true );

                    $media = get_attached_media( 'image', $post_meta_id );
                    
                }

                $result = array();
                foreach($media as $post){

                    $attach_id = $post->ID;
                    $source = wp_get_attachment_image_src($attach_id);
                    $path = $source[0];

                         $obj = array();
                         $obj['dispaly_name'] = basename(get_attached_file($attach_id));         
                         $obj['name'] = $path;
                         $obj['size'] = filesize(get_attached_file($attach_id));
                         $obj['id'] = $attach_id;
                         $result[] = $obj;
                }

                $return =  array('images'=> $result  );
                wp_send_json_success($return);
        }
}

// <-------------------- function to remove image from frontend [Remove functionality] ---------------------> 
                add_action( 'wp_ajax_nopriv_delete_event_image', 'delete_event_image' );
                add_action( 'wp_ajax_delete_event_image', 'delete_event_image' );

                if(!function_exists('delete_event_image')){

                    function delete_event_image(){

                        print_r($_POST);
                    
                        $img_id = isset($_POST['img']) ? $_POST['img'] : 0 ;
                        
                        if($img_id != '' || $img_id != '0'){

                            wp_delete_attachment($img_id);

                        }


                    }

                }
