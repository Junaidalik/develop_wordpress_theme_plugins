<?php
class Elementor_My_Form_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'my_form_widget';
	}

	public function get_title() {
		return esc_html__( 'My Form', 'elementor-addon' );
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
            }
        }

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'My Form', 'textdomain' ),
				'tab' => \Elementor\Controls_Manager::TAB_LAYOUT,
			]
		);

			// $this->add_control(
		// 'title',
		// 	[
		// 		'label' => esc_html__( 'Title', 'textdomain' ),
		// 		'type' => \Elementor\Controls_Manager::TEXT,
		// 		// 'default' => esc_html__( 'Default title', 'textdomain' ),
		// 		'placeholder' => esc_html__( 'type title', 'textdomain' ),
		// 	]
		// );

        // $this->add_control(
        //     'description',
        //         [
        //             'label' => esc_html__( 'Description', 'textdomain' ),
        //             'type' => \Elementor\Controls_Manager::TEXTAREA,
        //             // 'default' => esc_html__( 'Default title', 'textdomain' ),
        //             'placeholder' => esc_html__( 'type description', 'textdomain' ),
        //         ]
        //     );
        

        $this->add_control(
               
            'control_id_type',
            [
                'label' => esc_html__( 'Select type', 'textdomain' ),
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
                'label' => esc_html__( 'Select currency', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple' => true,
                'options' => custom_select_currency_term(),
                'default' => [ ],
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
			'show_currency',
			[
				'label' => esc_html__( 'Show currency', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'textdomain' ),
				'label_off' => esc_html__( 'Hide', 'textdomain' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->end_controls_section();


    }


	protected function render() {

		$settings = $this->get_settings_for_display();

      
       
        

		?>
<div style="border:2px solid black" class="container">
    <div style='padding:0.4em'>
        <div class="searchbar">
            <div class="col-sm-6 col-sm-6 ">
                <div class="dropzone" name="dropzone" id="dropzone"> </div></div> </br></br>
                <form id="control_form_id" name="form_data" class="dropzone" style="" method="POST" action="#">
                        <input type="text" name="title" id="title" value="<?php ?>"
                            placeholder="Enter the title"></br>
                        <textarea name="description" id="description" value="<?php ?>" placeholder="Enter the description"></textarea></br></br>
                        <div class="row">
                            <!-- Here is taxonomy [type] -->
                            <?php if($settings['show_type']=='yes') {?>
                            <div class="col-sm-4 col-sm-4 ">
                                <select class="form-control" placeholder="property type" name="property_type">
                                    <?php 
                                                $args  =  array(
                                                    'taxonomy' => 'type',
                                                    'hide_empty' => true,
                                                );
                                            $type_arr = get_terms( 
                                                $args
                                            );     

                                            // print_r($type_arr);
                                    ?>
                                    <option
                                        <?php echo esc_html(isset($_GET["property_type"]) ? '':'selected' ) ?>disabled>
                                        type</option>
                                    <?php foreach($type_arr as $type){ ?>
                                    <option value="<?php echo esc_attr($type->term_id) ?>">
                                        <?php echo esc_html($type->name) ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <?php } ?>
                            <!-- Here is taxonomy [currency] -->
                            <?php if($settings['show_currency']=='yes') {?>
                            <div class="col-sm-4 col-sm-4 ">
                                <select class="form-control" placeholder="property currency" name="property_currency">
                                    <?php 
                                                $args  =  array(
                                                    'taxonomy' => 'currency',
                                                    'hide_empty' => true,
                                                );
                                            $currency_arr = get_terms( 
                                                $args
                                            );     

                                            // print_r($currency_arr);
                                    ?>
                                    <option
                                        <?php echo esc_html(isset($_GET["property_currency"]) ? '':'selected' ) ?>disabled>
                                        currency</option>
                                    <?php foreach($currency_arr as $currency){ ?>
                                    <option value="<?php echo esc_attr($currency->term_id) ?>">
                                        <?php echo esc_html($currency->name) ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <?php } ?>
                            <!-- Here is taxonomy [status] -->
                            <div class="col-sm-4 col-sm-4 ">
                                <select class="form-control" placeholder="property status" name="property_status">
                                    <?php 
                                                $args  =  array(
                                                    'taxonomy' => 'status',
                                                    'hide_empty' => true,
                                                );
                                            $status_arr = get_terms( 
                                                $args
                                            );     

                                            // print_r($currency_arr);
                                    ?>
                                    <option
                                        <?php echo esc_html(isset($_GET["property_status"]) ? '':'selected' ) ?>disabled>
                                        status</option>
                                    <?php foreach($status_arr as $status){ ?>
                                    <option value="<?php echo esc_attr($status->term_id) ?>">
                                        <?php echo esc_html($status->name) ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                             <!-- Here is taxonomy [location] -->
                            <div class="col-sm-4 col-sm-4 ">
                                <select class="form-control" placeholder="property location" name="property_location">
                                    <?php 
                                                $args  =  array(
                                                    'taxonomy' => 'location',
                                                    'hide_empty' => true,
                                                );
                                            $location_arr = get_terms( 
                                                $args
                                            );     

                                            // print_r($currency_arr);
                                    ?>
                                    <option
                                        <?php echo esc_html(isset($_GET["property_location"]) ? '':'selected' ) ?>disabled>
                                        location</option>
                                    <?php foreach($location_arr as $location){ ?>
                                    <option value="<?php echo esc_attr($location->term_id) ?>">
                                        <?php echo esc_html($location->name) ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div> 
                        
                        <div>
                            <input style="padding:1em" type="number" name="price" id="price" value="<?php //echo esc_attr($price); ?>" placeholder="Enter the price"></br>
                            <input style="padding:1em" type="text" name="address" id="address" value="<?php //echo esc_attr($address); ?>" placeholder="Enter the address"></br>
                        </div>
                                <button style="max-width:10em" class="btn btn-success" type="submit" id="control_btn">submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row" id="widget_div">
                    <!-- properties -->

                </div>
<?php  
		}
}