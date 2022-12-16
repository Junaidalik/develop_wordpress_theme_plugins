<?php
class Elementor_User_Registration_Form_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'user_registration_form_widget';
	}

	public function get_title() {
		return esc_html__( 'User Registration Form', 'elementor-addon' );
	}

	public function get_icon() {
		return 'eicon-code';
	}

	public function get_categories() {
		return [ 'layout' ];
	}

	public function get_keywords() {
		return [ 'User Registration', 'Form' ];
	}

    protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'User Registration Form', 'textdomain' ),
				'tab' => \Elementor\Controls_Manager::TAB_LAYOUT,
			]
		);

		$this->end_controls_section();


    }


	protected function render() {

		$settings = $this->get_settings_for_display();

        ?>

<section class="vh-100" style="background-color: #eee;">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius: 25px;">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>

                <form class="mx-1 mx-md-4" id='register' name='register' method="POST" action="<?php echo esc_url(get_permalink()) ?>">

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <label class="form-label" for="form3Example1c">Enter Name</label>
                      <input type="text" id="username" name='username' placeholder='username' class="form-control" />
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                       <label class="form-label" for="form3Example3c">Enter Email</label>
                      <input type="email" id="email" name='email' placeholder='email' class="form-control" />
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <label class="form-label" for="form3Example4c">Enter Password</label>
                      <input type="password" id="pass" name='pass' placeholder='password' class="form-control" />
                    </div>
                  </div>

                  <div class="d-flex justify-content-center mx-2 mb-1 mb-lg-2">
                    <button style="max-width:10em" type="submit" class="btn btn-primary btn-sm">Register</button>
                  </div>

                </form>

              </div>
             
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
    





    <?php

        }


    }
