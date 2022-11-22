<?php get_header();?>

<!-- banner -->
<div class="inside-banner">
    <div class="container">
        <span class="pull-right"><a href="">Home</a> / About Us</span>
        <h2><?php echo esc_html(get_the_title()); ?></h2>
    </div>
</div>
<!-- banner -->


<div class="container">
    <div class="spacer">
        <div class="row">
            <div class="col-lg-8  col-lg-offset-2">
                <?php echo the_post_thumbnail('medium');?>
                <p><?php the_content(); ?></p>
            </div>

        </div>
    </div>
</div>

<?php get_footer(); 