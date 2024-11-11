<?php 
/**
 * Plugin Name: TechIT Dev widgets
 * Plugin URLI: https://techitdev.com/
 * Author: TechIT Dev
 * Author URI: https://techitdev.com/
 * Version: 0.1.0
 * Text Domain: tid-widgets
 * License: GNU General Public License (GPL)
 * Description: Display custom information on the shop page.
 */

 if( !defined('ABSPATH')){
        exit;
    }

    load_plugin_textdomain( 'tid-widgets', false, dirname(plugin_basename( __FILE__ )).'/languages' );


 class TechIT_Dev_Shop_Widgets extends WP_Widget{
    public function __construct(){
        parent::__construct(
            'TechIT_Dev_Shop_Widgets', 
            __('Techit Dev Shop Custom Widget', 'tid-widgets'),
            array('description' => 'Display custom information on the shop page', 'tid-widgets')
        );
    }

    public function widget($args, $instance){
        if( is_shop() ){
            echo $args['before_widget'];
            echo $args['before_title'].apply_filters( 'widget_title', $instance['title']) . $args['after_title'] ;
            echo '<p>' . esc_html( $instance['text'] ) . '</p>';
            echo $args['after_widget'];
        }
    }

    public function form($instance){
        $title = ! empty($instance['title']) ? $instance['title'] : __('New Title', 'tid-widgets');
        $text = !empty($instance['text']) ? $instance['text'] : __('Default Text', 'tid-widgets');

        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('title') ) ;?>" >  
                <?php _e('Title'); ?>
            </label>
            <input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id('title') )?>" name="<?php echo esc_attr($this->get_field_name('title'));?>" type="text" value="<?php echo esc_attr( $title);?>" >
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('text') ) ;?>" >  
                <?php _e('Text'); ?>
            </label>
            <textarea class="widefat"  id="<?php echo esc_attr( $this->get_field_id('text') )?>" name="<?php echo esc_attr($this->get_field_name('text'));?>"  >
                <?php echo esc_attr( $text )?>
            </textarea>
        </p>

<?php
    }

    public function update ($new_instance, $old_instance){
        $instance = array();
        $instance['title'] = ( !empty($new_instance['title'])) ? strip_tags( $new_instance['title']) : '';
        $instance['text'] = ( !empty($new_instance['text'])) ? strip_tags( $new_instance['text']) : '';

        return $instance;
    }

 }

//  Register the Widget
if( ! function_exists('techitdev_register_shop_widget')){
    function techitdev_register_shop_widget(){
        register_widget( 'TechIT_Dev_Shop_Widgets' );
    }
    add_action( 'widgets_init', 'techitdev_register_shop_widget');
    
}


include_once('inc/techitdev_widget_area.php');
include_once ('techitdev_calling_css_js.php');