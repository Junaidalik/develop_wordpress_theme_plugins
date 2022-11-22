<html>

<head><?php wp_head(); ?></head>

<body>
    <!-- Header Starts -->
    <div class="navbar-wrapper">

        <div class="navbar-inverse" role="navigation">
            <div class="container">
                <div class="navbar-header">


                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                </div>


                <!-- Nav Starts -->
                <div class="navbar-collapse collapse">
                    <?php 
                    $defaults_menu = array(
                      'items_wrap'           => '<ul id="%1$s" class="%2$s nav navbar-nav navbar-right">%3$s</ul>',
                      'theme_location'       => 'header-menu',
                
                    );
                    wp_nav_menu( $defaults_menu); ?>
                </div>
                <!-- #Nav Ends -->

            </div>
        </div>

    </div>
    <!-- #Header Starts -->

    <div class="container">

        <!-- Header Starts -->
        <div class="header">
            <?php $path = get_template_directory_uri();
                  $_path = $path.'/images/logo.png';
           ?>

            <a href="<?php echo get_home_url(); ?>"><img src="<?php echo $_path ?>" alt="Realestate"></a>

            <ul class="pull-right">
                <?php 
                    $defaults_menu = array(
                      'items_wrap'           => '<ul id="%1$s" class="%2$s nav navbar-nav navbar-right">%3$s</ul>',
                      'theme_location'       => 'extra-menu',
                    );
                    wp_nav_menu( $defaults_menu); 
                    ?>
            </ul>
        </div>
        <!-- #Header Starts -->
    </div>