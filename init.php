<?php 
/**
 * Plugin Name: Testimonial MR
 * Plugin URI: promasudbd.com
 * Version: 1.0.0
 * Author: Masud Rana
 * Author URI: promasudbd.com
 * Description: Lorem, ipsum dolor sit amet consectetur adipisicing elit. Amet, voluptate!
 * Tags: Free Plugin, Premimum Plugin, Domo Side
 * */ 


//  wp enqueue script file include here
add_action("wp_enqueue_scripts", function(){
    wp_enqueue_style('font-awesome', plugins_url("assets/css/all.css", __FILE__));
    wp_enqueue_style('owl-carousel', plugins_url("assets/css/owl.carousel.min.css", __FILE__));
    wp_enqueue_style('owl-default-theme', plugins_url("assets/css/owl.theme.default.min.css", __FILE__));
    wp_enqueue_style('testimonil-main-css', plugins_url("assets/css/style.css", __FILE__));


    wp_enqueue_script('carousel-main-js', plugins_url("assets/js/owl.carousel.min.js", __FILE__), ['jquery'], time(), true );
    wp_enqueue_script('main-js', plugins_url("assets/js/main.js", __FILE__), ['jquery', 'carousel-main-js'], time(), true );
});

//  after setup theme function here 
add_action("after_setup_theme", "create_testimonial_post_type");
// Register Custom Post Type
function create_testimonial_post_type() {

    register_post_type( 'testimonial', [
        'public'                => true,
        'labels'                => [
            'name'                  => _x( 'Testimonials', 'Post Type General Name', 'text_domain' ),
            'singular_name'         => _x( 'Testimonial', 'Post Type Singular Name', 'text_domain' ),
            'menu_name'             => __( 'Testimonials', 'text_domain' ),
            'name_admin_bar'        => __( 'Testimonial', 'text_domain' ),
            'archives'              => __( 'Testimonial Archives', 'text_domain' ),
            'attributes'            => __( 'Testimonial Attributes', 'text_domain' ),
            'parent_item_colon'     => __( 'Parent Testimonial:', 'text_domain' ),
        ],
        'supports'  => array( 'title', 'editor', 'thumbnail' ),
    ]);

    // add Shortcode here
    add_shortcode("testimonil-slider-mr", function(){
        ob_start();
        ?>
        <section class="owl-carousel owl-theme testimonial-slider">
            <?php 
            $agrs = [
                'post_type' => 'testimonial',
                'posts_per_page' => 6
            ];

            $query = new WP_Query( $agrs);

            while($query -> have_posts()): 
                $query->the_post();
            ?>
                <div class="testimonial-single-slide">
                    <?php the_post_thumbnail('large', ['class' => 'user-image']); ?>
                    <h2><?php the_title(); ?></h2>
                    <p><?php the_content(); ?></p>
                    <ul>
                        <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                        <li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                        <li><a href="#"><i class="fa-brands fa-linkedin-in"></i></a></li>
                    </ul>
                </div>
            <?php endwhile; ?>
        </section>
        <?php 
        return ob_get_clean();

    });
   
}

?>