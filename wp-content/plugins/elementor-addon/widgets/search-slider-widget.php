<?php
class Elementor_Search_Slider_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'search_slider_widget';
	}

	public function get_title() {
		return esc_html__( 'Search Slider', 'elementor-addon' );
	}

	public function get_icon() {
		return 'eicon-code';
	}

	public function get_categories() {
		return [ 'layout' ];
	}

	public function get_keywords() {
		return [ 'Search', 'Slider' ];
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
		'Title',
			[
				'label' => esc_html__( 'type title', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				// 'default' => esc_html__( 'Default title', 'textdomain' ),
				'placeholder' => esc_html__( 'Type title', 'textdomain' ),
			]
		);	
        $this->add_control(
            'description',
                [
                    'label' => esc_html__( 'type description', 'textdomain' ),
                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                    // 'default' => esc_html__( 'Default title', 'textdomain' ),
                    'placeholder' => esc_html__( 'Type description', 'textdomain' ),
                ]
            );	

            $this->add_control(
                'show_currency',
                [
                    'label' => esc_html__( 'Show Currency', 'textdomain' ),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Show', 'textdomain' ),
                    'label_off' => esc_html__( 'Hide', 'textdomain' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );
            $this->add_control(
                'show_features',
                [
                    'label' => esc_html__( 'Show features', 'textdomain' ),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Show', 'textdomain' ),
                    'label_off' => esc_html__( 'Hide', 'textdomain' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );
            $this->add_control(
                'show_type',
                [
                    'label' => esc_html__( 'Show type', 'textdomain' ),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Show', 'textdomain' ),
                    'label_off' => esc_html__( 'Hide', 'textdomain' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
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
        //   print_r($settings['control_id_currency']);
        // foreach(custom_select_term() as $item){
        //      print_r($item);
        // }
        
		?>
<div class="banner-search">
    <div class="container">
        <!-- banner -->
        <h3><?php echo esc_html($settings['Title']); ?></h3>
        <div class="searchbar">
            <div class="row">
                <form id="form_id" method="GET" action="<?php echo home_url('/').'page-search' ?>">
                    <div class="col-lg-6 col-sm-6">
                        <input type="text" name="searchpost" id="searchpost"
                            value="<?php echo (isset($_GET['searchpost']) ? $_GET['searchpost']:'') ?>"
                            class="form-control" placeholder="Search of Properties">
                        <div class="row">
                         <!-- Here is taxonomy [currency] -->
                        <?php if($settings['show_currency']=='yes') {?>   
                        <div class="col-lg-3 col-sm-3 ">
                                <select class="form-control" placeholder="property currency" name="property_currency">
                                    <?php 

                                            $currencies = isset($settings['control_id_currency']) ? $settings['control_id_currency'] :"";
                                            if(!empty($currencies)){

                                            if(in_array('All' , $currencies)){
                                                
                                                $args  =  array(
                                                    'taxonomy' => 'currency',
                                                    'hide_empty' => true,

                                                );

                                            }
                                            else {

                                                $args  =  array(
                                                    'taxonomy' => 'currency',
                                                    'hide_empty' => true,
                                                    'include' =>  $currencies,
                                                );

                                            }


                                            $currency_arr = get_terms( 
                                                $args
                                            );
                                            }
                                    ?>
                                    <option <?php echo esc_html(isset($_GET["property_currency"]) ? '':'selected' ) ?>disabled>currency</option>
                                    <?php foreach($currency_arr as $currency){ ?>
                                    <option value="<?php echo esc_attr($currency->term_id) ?>"><?php echo esc_html($currency->name) ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <?php } ?>
                             <!-- Here is taxonomy [features] -->
                            <?php if($settings['show_features']){ ?>
                            <div class="col-lg-3 col-sm-4">
                                <select class="form-control" placeholder="property features" name="property_features">
                                    <?php 
                              $terms = get_terms( array(
                                'taxonomy' => 'features',
                                'hide_empty' => false,
                            ));?>
                                    <option <?php echo esc_html(isset($_GET["property_features"]) ? '':'selected' ) ?>
                                        disabled>features</option>
                                    <?php foreach($terms as $term){ ?>
                                    <option
                                        <?php echo ((isset($_GET['property_features']) ? $_GET['property_features']:'') == $term->slug) ? 'selected':'' ?>
                                        value="<?php echo $term->slug?>"><?php echo $term->name ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <?php } ?>
                            <!-- Here is taxonomy [type] -->
                            <?php if($settings['show_type']) {?>
                            <div class="col-lg-3 col-sm-4">
                                <select class="form-control" placeholder="property type" name="property_type">
                           

                               
                                <?php $types   =  isset($settings['control_id_type'])  ? $settings['control_id_type']  : array(); 
                                if(!empty($types)){

                                    if(in_array('All' , $types)){
                                     
                                        $args  =  array(
                                            'taxonomy' => 'type',
                                            'hide_empty' => true,

                                        );

                                    }
                                    else {

                                        $args  =  array(
                                            'taxonomy' => 'type',
                                            'hide_empty' => true,
                                            'include' =>  $types,
                                        );

                                    }


                                    $types_arr = get_terms( 
                                        $args
                                );
                                }
                                ?> 
                                    <option <?php echo esc_html(isset($_GET["property_type"]) ? '':'selected' )?>disabled>type</option>                      
                                    <?php foreach($types_arr as $term){?>
                                            <option value="<?php echo esc_attr($term->term_id);?>"><?php echo esc_html($term->name) ?></option>                                                                              
                                    <?php }?>
                                </select>
                            </div>                                                         
                            <?php } ?>
                            <!-- submit button [find now] -->
                            <div class="col-lg-3 col-sm-4">
                                <button class="btn btn-success" type="submit" id="butsave">Find Now</button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="col-lg-5 col-lg-offset-1 col-sm-6 ">
                    <p><?php echo esc_html($settings['description']); ?></p>
                    <button class="btn btn-info" data-toggle="modal" data-target="#loginpop">Login</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
	}
}


