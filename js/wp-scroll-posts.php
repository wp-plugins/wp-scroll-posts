<?php
    /*
  Plugin Name: wp-scroll-posts-old
  Plugin URI: http://ajaysharma3085006.wordpress.com/
  Description: scroll any category post up/down in widget 
  Version: 0.1
  Author: Ajay Sharma
  Author URI: http://ajaysharma3085006.wordpress.com/
  License: GPLv2 or later
 */
 //activation
 function wp_scroll_post_activation() {}
register_activation_hook(__FILE__, 'wp_scroll_post_activation');
//deactivation
function wp_scroll_post_deactivation() {
    /*
delete_option( 'wcv_name_txt' );
delete_option( 'wcv_email_txt' );
delete_option( 'wcv_comment_txt' );*/}
register_deactivation_hook(__FILE__, 'wp_scroll_post_deactivation');
//scripts
add_action('wp_enqueue_scripts', 'wp_scroll-posts_scripts');
function wp_scroll_posts_scripts() {
    wp_enqueue_script('jquery');
    wp_register_script('vticker', plugins_url('js/jquery.vticker.js', __FILE__), array("jquery"));
    wp_enqueue_script('vticker');
}/*
add_action('wp_enqueue_scripts', 'wp_comments_styles');
function wp_comments_styles() {
    wp_register_style('validation_css', plugins_url('css/jquery.validate.css', __FILE__));
    wp_enqueue_style('validation_css');
  }*/
    // create custom plugin settings menu
add_action('admin_menu', 'scroll_posts_create_menu');
function scroll_posts_create_menu() {
	//create new top-level menu
	add_menu_page('scroll posts  Plugin Settings', 'wp scroll posts', 'administrator', __FILE__, 'scroll_posts_settings_page',plugins_url('/images/icon.png', __FILE__));
	
	//call register settings function
	add_action( 'admin_init', 'register_scroll_post_settings' );
    
}
    add_action('admin_menu', 'my_plugin_menu');
    
    function my_plugin_menu() {
        add_plugins_page('My Plugin Page', 'My Plugin', 'read', 'my-unique-identifier', '');
    }

function register_scroll_post_settings() { 

	//register our settings
	register_setting( 'wcv-settings-group', 'wp_post_no' );
	register_setting( 'wcv-settings-group', 'wcv_email_txt' );
	register_setting( 'wcv-settings-group', 'wcv_comment_txt' );	
}

function scroll_posts_settings_page() {?><div class="wrap">
<h2>Wp scroll post Settings</h2>

<form method="post" action="options.php">
    <?php settings_fields( 'wcv-settings-group' ); ?>
    <?php do_settings_sections( 'wp_scroll_posts_settings_page' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">No of posts </th>
        <td><input type="text" name="wcv_name_txt" value="<?php echo get_option('wcv_name_txt'); ?>" /> Default: 5</td>
        </tr>
         
        <tr valign="top">
        <th scope="row">category</th>
        <td><input type="text" name="wcv_email_txt" value="<?php echo get_option('wcv_email_txt'); ?>" /> Default: all</td>
        </tr>
        
        <tr valign="top">
        <th scope="row">Scroll up/down</th>
        <td><input type="text" name="wcv_comment_txt" value="<?php echo get_option('wcv_comment_txt'); ?>" /> Default: up</td>
        </tr> 
    </table>
    
    <?php submit_button(); ?></form>
</div>
<?php //echo get_option('ajay');?><?php } ?>
<?php if(isset($_GET['settings-updated'])){ ?><div id="message" class="updated">
        <p><strong><?php _e('Settings saved.') ?></strong></p>
    </div>
<?php } ?>
<?php //add_action('wp_head', 'js_to_head'); 
add_action('wp_footer', 'wp_posts_data'); 
function wp_posts_data() {//echo "data to head ajay comment plugin";?>
<?php	$wcv_name =(get_option('wcv_name_txt') == '') ? "Please Enter your name" :  get_option('wcv_name_txt'); //echo $message;
$wcv_email =(get_option('wcv_email_txt') == '') ? "Please Enter Valid Email Address" :  get_option('wcv_email_txt'); 
$wcv_message =(get_option('wcv_comment_txt') == '') ? "Please Enter your Comment" :  get_option('wcv_comment_txt'); 	?>        
        <script type="text/javascript">
		/* <![CDATA[ */
            jQuery(function(){
                jQuery("#author").validate({
                    expression: "if (VAL) return true; else return false;",
                    message: "<?php echo $wcv_name; ?>"
                });
               
				
                jQuery("#email").validate({
                    expression: "if (VAL.match(/^[^\\W][a-zA-Z0-9\\_\\-\\.]+([a-zA-Z0-9\\_\\-\\.]+)*\\@[a-zA-Z0-9_]+(\\.[a-zA-Z0-9_]+)*\\.[a-zA-Z]{2,4}$/)) return true; else return false;",
                    message: "<?php echo $wcv_email; ?>"
                });
				jQuery("#comment").validate({
                    expression: "if (VAL) return true; else return false;",
                    message: "<?php echo $wcv_message; ?>"
                });				
						
            });
			
            /* ]]> */
        </script>
<!--validation ends-->
<?php } 

class My_Widget extends WP_Widget {

    public function __construct() {
        // widget actual processes
    }

    public function widget( $args, $instance ) {
        // outputs the content of the widget
    }

    public function form( $instance ) {
        // outputs the options form on admin
    }

    public function update( $new_instance, $old_instance ) {
        // processes widget options to be saved
    }
}
add_action( 'widgets_init', function(){
     register_widget( 'My_Widget' );
});