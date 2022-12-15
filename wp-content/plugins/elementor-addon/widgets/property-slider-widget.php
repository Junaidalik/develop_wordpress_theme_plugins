<?php
class Elementor_Property_Slider_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'property_slider_widget';
	}

	public function get_title() {
		return esc_html__( 'Property Slider', 'elementor-addon' );
	}

	public function get_icon() {
		return 'eicon-code';
	}

	public function get_categories() {
		return [ 'layout' ];
	}

	public function get_keywords() {
		return [ 'My', 'Form' ];
	}

    protected function register_controls() {
    //function to select custom taxonomy term dropdown
        if(!function_exists('custom_select_type_term')){
            function custom_select_type_term(){
                 $terms = get_terms( array (
                   'taxonomy'=>'type',
                    'hide_empty'=> false,
                 ));
            $arr = array();
            foreach($terms as $term){
            $arr[$term->term_id] = $term->name;
            $arr['All'] = 'All';
           }
           return $arr;
            }
        }

        if(!function_exists('custom_select_currency_term')){
            function custom_select_currency_term(){
                 $terms = get_terms( array (
                   'taxonomy'=>'currency',
                    'hide_empty'=> false,
                 ));
            $arr = array();
            foreach($terms as $term){
            $arr[$term->term_id] = $term->name;
            $arr['All'] = 'All';
           }
           return $arr;
        //    echo "<pre>"; print_r($arr); echo "</pre>";
               //wp_die();
            }
        }

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Custom', 'textdomain' ),
				'tab' => \Elementor\Controls_Manager::TAB_LAYOUT,
			]
		);

			$this->add_control(
		'post_per_page',
			[
				'label' => esc_html__( 'show posts per page', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				// 'default' => esc_html__( 'Default title', 'textdomain' ),
				'placeholder' => esc_html__( 'Select number of page', 'textdomain' ),
			]
		);

        $this->add_control(
               
            'control_id_type',
            [
                'label' => esc_html__( 'Select property type', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple' => true,
                'options' => custom_select_type_term(),
                'default' => [ ],
            ]
        );

        $this->add_control(
           
            'control_id_currency',
            [
                'label' => esc_html__( 'Select property currency', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple' => true,
                'options' => custom_select_currency_term(),
                'default' => [ ],
            ]
        );
        $this->end_controls_section();
    }







    protected function render() {

		$settings = $this->get_settings_for_display();
        
        $types = isset($settings['control_id_type']) ? $settings['control_id_type'] : array();
        $currencies = isset($settings['control_id_currency']) ? $settings['control_id_currency'] : array();
       
        $property_type="";
        if(!empty($types)){
        $property_type  = array(
            'taxonomy' => 'type',
            'field'    => 'term_id',
            'terms'    => $types,
        );
        
        }
        $property_currency="";
        if(!empty($currencies)){
        $property_currency  = array(
            'taxonomy' => 'currency',
            'field'    => 'term_id',
            'terms'    => $currencies,
        );
        }

          $args = array(  
            'post_type' => 'property',
            'post_status' => 'publish',
            'posts_per_page' =>  isset($settings['post_per_page']) ? $settings['post_per_page'] : array() , 
            'orderby' => 'title', 
            'order' => 'ASC',
            'cat' => 'home',
            'tax_query' => array(
                'relation' => 'AND',
                $property_type,
                $property_currency, 
              ),
        );
    $loop = new WP_Query( $args ); ?>
	
<div class="container">
    <div class="properties-listing spacer"> <a href="buysalerent.php" class="pull-right viewall">View All Listing</a>
        <h2>Featured Properties</h2>
        <div id="owl-example" class="owl-carousel">
            <!-- here is loop to get posts -->
            <?php   while ( $loop->have_posts() ) : $loop->the_post(); 
           /**call of function to get taxonomy terms */
             $status_name = get_taxonomy_term(get_the_ID() ,'status');
             $curreny_name = get_taxonomy_term(get_the_ID() ,'currency');?>
            <div class="properties" id="property">
                <div class="image-holder"><img src="<?php echo get_the_post_thumbnail_url()?>" class="img-responsive"
                        alt="properties" />
                    <div class="status new"><?php  echo esc_html( $status_name);  ?></div>
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

    <?php }
}