<?php 
/**
 * Display Sidebar or Widget Area
 */
if( ! function_exists('techitdev_custom_widget_area')){
    function techitdev_custom_widget_area() {
        if( function_exists('register_sidebar')){
            register_sidebar(array(
                'name'          => __('Main Sidebar', 'tid-widgets'),
                'id'            => 'main-sidebar',
                'before_widget' => '<div class="widget %1$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>',
            ));
    
            register_sidebar(array(
                'name'          => __('Shop Page Sidebar', 'tid-widgets'),
                'id'            => 'shop-sidebar',
                'before_widget' => '<div class="widget %1$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>',
            ));
    
            register_sidebar(array(
                'name'          => __('Blog Sidebar', 'tid-widgets'),
                'id'            => 'blog-sidebar',
                'before_widget' => '<div class="widget %1$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>',
            ));
      
        }
    }
}

add_action('widgets_init', 'techitdev_custom_widget_area');


// Display the sidebar
if( ! function_exists('techitdev_add_shop_page_sidebar')){
    function techitdev_add_shop_page_sidebar(){
        if( is_shop() && is_active_sidebar( 'shop-sidebar' )){
            echo '<div id="tid-main-content-sidebar">';
            echo '<aside id="tid-shop-sidebar" class="tid-sidebar" >';
            dynamic_sidebar( 'shop-sidebar' );
            echo '</aside>';
            echo '<div  class="tid-main-content">';
        }
    }
}

if( ! function_exists('techitdev_close_shop_sidebar')){
    function techitdev_close_shop_sidebar(){
        if (is_shop()) {
            echo '</div></div>';
        }
    }    
}

// Hook to display sidebar before the shop page content
add_action( 'woocommerce_before_main_content', 'techitdev_add_shop_page_sidebar' );
// Hook to close wrapper after shop content
add_action( 'woocommerce_after_main_content', 'techitdev_close_shop_sidebar', 5);


if ( ! function_exists('techitdev_add_main_sidebar')){
    function techitdev_add_main_sidebar(){
        if( is_shop()) {
            return;
        }
        if( is_single() && ! is_shop()){
            if( is_active_sidebar( 'blog-sidebar' )){
                echo '<div id="tid-main-content-sidebar" >';
                echo '<aside id="tid-blog-sidebar" class="tid-sidebar" >';
                dynamic_sidebar('blog-sidebar');
                echo '</aside>';
                echo '<div class="tid-main-content" >';
            }
        }else{
            if(is_active_sidebar( 'main-sidebar' )){
                echo '<div id="tid-main-content-sidebar">';
                echo '<aside id="tid-main-sidebar" class="tid-sidebar" >';
                dynamic_sidebar('main-sidebar');
                echo '</aside>';
                echo '<div class="tid-main-content" >';
            }
        }
    }
}
add_action( 'get_header', 'techitdev_add_main_sidebar', 5);

if ( ! function_exists('techitdev_close_sidebar_wrapper')){
    function techitdev_close_sidebar_wrapper(){
        echo '</div></div>';
    }
}
add_action( 'wp_after_main_content', 'techitdev_close_sidebar_wrapper', 5 );