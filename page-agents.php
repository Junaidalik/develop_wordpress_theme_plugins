<?php get_header(); ?>
<!-- banner -->
<div class="inside-banner">
    <div class="container">
        <span class="pull-right"><a href="http://localhost/wordpress/">Home</a> / Agents</span>
        <h2>Agents</h2>
    </div>
</div>
<!-- banner -->
<div class="container">
    <div class="spacer agents">
        <div class="row">
            <div class="col-lg-8  col-lg-offset-2 col-sm-12">
                <!-- agents -->
                <?php  $user_query = new WP_User_Query( array( 'role_in' => array('Administrator', 'Subscriber' )) );     
                  // echo "<pre>"; print_r($user_query->results ); echo "</pre>";?>
                <?php foreach($user_query->results as $result): ?>
                <div class="row">
                    <div class="col-lg-2 col-sm-2 "><a href="#"><img
                                src="<?php echo esc_html(get_avatar_url($result->data->ID)) ?>" class="img-responsive"
                                alt="agent name"></a></div>
                    <div class="col-lg-7 col-sm-7 ">
                        <h4><?php echo esc_html($result->data->display_name)  ?></h4>
                        <p> <?php echo esc_html(get_user_meta( $result->data->ID, 'description', true )); ?>
                        </p>
                    </div>
                    <div class="col-lg-3 col-sm-3 "><span class="glyphicon glyphicon-envelope"></span> <a
                            href="mailto:abc@realestate.com"><?php echo esc_html($result->data->user_email)?></a>
                    </div>
                </div>

                <?php endforeach ?>
                <!-- agents -->
            </div>
        </div>


    </div>
</div>

<?php get_footer(); 