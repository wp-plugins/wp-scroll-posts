<?php
    /*
  Plugin Name: wp scroll posts
  Plugin URI: http://ajaysharma3085006.wordpress.com/
  Description: scroll any category posts up/down in widget , page  or post, have shortcode [wpsp],[wpsp cat='CategoryName'], with multiple instance
  Version: 0.5
  Author: Ajay Sharma
  Author URI: http://ajaysharma3085006.wordpress.com/
  License: GPLv2 or later
 */
  function wp_scroll_post_activation() {
    
     add_option( wpsp_nop, '3', '', yes ); 
     add_option( wpsp_mnop, '10', '', yes );
     add_option( wpsp_cat, 'uncategorized', '', yes ); 
     add_option( wpsp_direction,'up', '', yes ); 
     add_option( wpsp_readmore,'Read More', '', yes ); 
     add_option( wpsp_enable,'1', '', yes ); 
     add_option( wpsp_mousepause,'true', '', yes );
     add_option( wpsp_speed,'500', '', yes );
     add_option( wpsp_ptime,'3000', '', yes );
     add_option( wpsp_thumbnail_enable,'1','', yes );
     add_option( wpsp_title_enable,'1', '', yes );
     add_option( wpsp_date_enable,'1', '', yes );
     add_option( wpsp_excerpt_enable,'1', '', yes );
     add_option( wpsp_readmore_enable,'1', '', yes );
     add_option( wpsp_c_len,'10', '', yes );
    
    
    }
register_activation_hook(__FILE__, 'wp_scroll_post_activation');
//deactivation
function wp_scroll_post_deactivation() {
    
delete_option( 'wpsp_nop' );
delete_option( 'wpsp_mnop' );
delete_option( 'wpsp_cat' );
delete_option( 'wpsp_direction' );
delete_option( 'wpsp_readmore' );
delete_option( 'wpsp_enable' );
delete_option( 'wpsp_mousepause' );
delete_option( 'wpsp_speed' );
delete_option( 'wpsp_ptime' );
delete_option( 'wpsp_thumbnail_enable' );
delete_option( 'wpsp_title_enable' );
delete_option( 'wpsp_date_enable' );
delete_option( 'wpsp_excerpt_enable' );
delete_option( 'wpsp_readmore_enable' );
delete_option( 'wpsp_c_len' );


}
register_deactivation_hook(__FILE__, 'wp_scroll_post_deactivation');
//scripts
add_action('wp_enqueue_scripts', 'wp_scroll_posts_scripts');
function wp_scroll_posts_scripts() {
    wp_enqueue_script('jquery');
    wp_register_script('vticker', plugins_url('js/jquery.vticker.js', __FILE__), array("jquery"));
    wp_enqueue_script('vticker');
}
add_action('wp_enqueue_scripts', 'wp_sp_styles');
function wp_sp_styles() {
    wp_register_style('wpsp_css', plugins_url('css/styles.css', __FILE__));
    wp_enqueue_style('wpsp_css');
  }
    // create custom plugin settings menu
add_action('admin_menu', 'scroll_posts_create_menu');
function scroll_posts_create_menu() {
  //create new top-level menu
  //add_menu_page('scroll posts  Plugin Settings', 'wp scroll posts', 'administrator', __FILE__, 'scroll_posts_settings_page',plugins_url('/images/icon.png', __FILE__));
  add_menu_page('scroll posts  Plugin Settings', 'wp scroll posts', 'administrator', 'wp_scroll_posts_setting', 'scroll_posts_settings_page',plugins_url('/images/icon.png', __FILE__));
  
  //call register settings function
  add_action( 'admin_init', 'register_scroll_post_settings' );
    
}
  

function register_scroll_post_settings() { 

  //register our settings
  register_setting( 'wpsp-settings-group', 'wpsp_nop' );
  register_setting( 'wpsp-settings-group', 'wpsp_mnop' );
  register_setting( 'wpsp-settings-group', 'wpsp_mnop' );
  register_setting( 'wpsp-settings-group', 'wpsp_cat' );
  register_setting( 'wpsp-settings-group', 'wpsp_direction' );
  register_setting( 'wpsp-settings-group', 'wpsp_readmore' );
  register_setting( 'wpsp-settings-group', 'wpsp_enable' );
  register_setting( 'wpsp-settings-group', 'wpsp_mousepause' );
  register_setting( 'wpsp-settings-group', 'wpsp_speed' );
  register_setting( 'wpsp-settings-group', 'wpsp_ptime' );
  register_setting( 'wpsp-settings-group', 'wpsp_thumbnail_enable' );
  register_setting( 'wpsp-settings-group', 'wpsp_title_enable' );
  register_setting( 'wpsp-settings-group', 'wpsp_date_enable' );
  register_setting( 'wpsp-settings-group', 'wpsp_excerpt_enable' );
  register_setting( 'wpsp-settings-group', 'wpsp_readmore_enable' );
  register_setting( 'wpsp-settings-group', 'wpsp_c_len' );
  //wpsp_thumbnail_enable

}

function scroll_posts_settings_page() {?><div class="wrap">
<h2>Wp scroll post Settings</h2>

<form method="post" action="options.php">
    <?php settings_fields( 'wpsp-settings-group' ); ?>
    <?php do_settings_sections( 'scroll_posts_settings_page' ); ?>
    <table class="form-table">
    <tr valign="top">
        <th scope="row">Enable  Wiget</th>
        <td>
<input type="checkbox" name="wpsp_enable" value="1" <?php checked(get_option('wpsp_enable'), 1); ?> />
        
         Default: true</td>
        </tr>
        <tr valign="top">
        <th scope="row">Enable  Feature image/thumbnail</th>
        <td>
<input type="checkbox" name="wpsp_thumbnail_enable" value="1" <?php checked(get_option('wpsp_thumbnail_enable'), 1); ?> />
                 Default: true</td>
        </tr>
        <tr valign="top">
        <th scope="row">Enable  Posts Title</th>
        <td>
<input type="checkbox" name="wpsp_title_enable" value="1" <?php checked(get_option('wpsp_title_enable'), 1); ?> />
  Default: true</td>
        </tr>
        <tr valign="top">
        <th scope="row">Enable  Date of posting</th>
        <td>

<input type="checkbox" name="wpsp_date_enable" value="1" <?php checked(get_option('wpsp_date_enable'), 1); ?> />

        
         Default: true</td>
        </tr>
        <tr valign="top">
        <th scope="row">Enable  Excerpt</th>
        <td>

<input type="checkbox" name="wpsp_excerpt_enable" value="1" <?php checked(get_option('wpsp_excerpt_enable'), 1); ?> />

        
         Default: true</td>
        </tr>
        <tr valign="top">
        <th scope="row">Enable  Readmore text</th>
        <td>

<input type="checkbox" name="wpsp_readmore_enable" value="1" <?php checked(get_option('wpsp_readmore_enable'), 1); ?> />

        
         Default: true</td>
        </tr>
        <tr valign="top">
        <th scope="row">Maximum Numbers of posts in scroller</th>
        <td><input type="text" name="wpsp_mnop" value="<?php echo get_option('wpsp_mnop'); ?>" />
                
         Default: 10</td>
        </tr>
        <tr valign="top">
        <th scope="row">Numbers of post visible at a time in Scroller </th>
        <td>
       
<select name="wpsp_nop">
    <option value="1" <?php selected( get_option('wpsp_nop'), 1 ); ?>>1</option>
    <option value="2" <?php selected( get_option('wpsp_nop'), 2 ); ?>>2</option>
    <option value="3" <?php selected( get_option('wpsp_nop'), 3 ); ?>>3</option>
    <option value="4" <?php selected( get_option('wpsp_nop'), 4 ); ?>>4</option>
    <option value="5" <?php selected( get_option('wpsp_nop'), 5 ); ?>>5</option>
    <option value="6" <?php selected( get_option('wpsp_nop'), 6 ); ?>>6</option>
    <option value="7" <?php selected( get_option('wpsp_nop'), 7 ); ?>>7</option>
    <option value="8" <?php selected( get_option('wpsp_nop'), 8 ); ?>>8</option>
    <option value="9" <?php selected( get_option('wpsp_nop'), 9 ); ?>>9</option>
    <option value="10" <?php selected( get_option('wpsp_nop'), 10 ); ?>>10</option>
    <option value="11" <?php selected( get_option('wpsp_nop'), 11); ?>>11</option>
    <option value="12" <?php selected( get_option('wpsp_nop'), 12); ?>>12</option>
</select>
        
        
        
         Default: 3</td>
        </tr>
         
        <tr valign="top">
        <th scope="row">category name</th>
        <td><input type="text" name="wpsp_cat" value="<?php echo get_option('wpsp_cat'); ?>" />
                
         Default: uncategorized <br />
         <strong>Note</strong>: If you want to include multiple categories then write names of categories separeted by comma . For example " <strong>news , tips</strong> " where news and tips are names of categories.
         </td>
        </tr>
        <tr valign="top">
        <th scope="row">Excerpt length (in words)(please only numeric) </th>
        <td><input type="text" name="wpsp_c_len" value="<?php echo get_option('wpsp_c_len'); ?>" />
                
         Default: 10 <br />
        
         </td>
        </tr>
        <tr valign="top">
        <th scope="row">speed </th>
        <td><input type="text" name="wpsp_speed" value="<?php echo get_option('wpsp_speed'); ?>" />
                
         Default: 500 <br />
        
         </td>
        </tr>
        <tr valign="top">
        <th scope="row">Pause time</th>
        <td><input type="text" name="wpsp_ptime" value="<?php echo get_option('wpsp_ptime'); ?>" />
                
         Default: 3000<br />
         
        </tr>
        
        <tr valign="top">
        <th scope="row">Direction</th>
        <td>        
               
<select name="wpsp_direction">
    <option value="up" <?php selected( get_option('wpsp_direction'), up ); ?>>up</option>
    <option value="down" <?php selected( get_option('wpsp_direction'), down ); ?>>down</option>
   
</select>         Default: up</td>
        </tr> 
        <tr valign="top">
        <th scope="row">Enable Pause on mouse hover</th>
        <td>

<select name="wpsp_mousepause">
    <option value="true" <?php selected( get_option('wpsp_mousepause'), 'true' ); ?>>true</option>
    <option value="false" <?php selected( get_option('wpsp_mousepause'), 'false' ); ?>>false</option>
   
</select>         
         Default: true</td>
        </tr>  
        <tr valign="top">
        <th scope="row">Read more Text</th>
        <td><input type="text" name="wpsp_readmore" value="<?php echo get_option('wpsp_readmore'); ?>" />
       
         Default: Read More</td>
        </tr>
        
    </table>
   
    <?php submit_button(); ?></form>
	
	<div > 
	<h3>To add scroller to your website </h3>
	<ul>
	<li> <h4> Method 1</h4> Go to Appreance->widget  there you will find <code>wp scroll posts</code> widget</li>
	<li> <h4> Method 2</h4>or use short code <code>[wpsp]</code> , <code>[wpsp cat='CategoryName']</code>to your page or post or text widget</li>
	<li> <h4> Method 3</h4>to use in theme use <code>&lt;?php echo do_shortcode('[wpsp]'); ?&gt;</code> to your template</li>
	</div>
	
</div>
<?php

 } 
//setting ends here
// js multiple instance and v ticker setting here

function js_id_scrool($id_post){
  $js_fun_eve="


<script type='text/javascript'>
   
            jQuery(function(){
                jQuery('#scrroll-$id_post').vTicker({
speed: ".get_option('wpsp_speed').",
pause: ".get_option('wpsp_ptime').",
showItems: ".get_option('wpsp_nop').",
animation: 'fade',
mousePause:".get_option('wpsp_mousepause').",
height: '0',
direction:'".get_option('wpsp_direction')."' 
});

            });
      
          
        </script>
       ";
      echo $js_fun_eve;}
 class wp_scroll_post extends WP_Widget {

    function __construct() {
        parent::__construct(
            'scroll_post_sp', // Base ID
            'wp scroll posts', // Name
            array( 'description' => __( 'A scroll post Widget by ajaysharma3085006', 'http://localhost/empolyee/wp-admin/widgets.php' ), ) // Args
        );
    }

    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );
         $text = apply_filters( 'widget_text', $instance['text'] );

        echo $args['before_widget'];
        if ( ! empty( $title ) )
            echo $args['before_title'] . $title . $args['after_title'];
         echo $args['before_text'] . $text . $args['after_text'];
       // echo __( 'scroll posts', 'text_domain' );
        echo $args['after_widget'];

// output
$id_post= rand();
echo js_id_scrool($id_post);
        ?>
		<!-- div id will be changed every time so please don't give css to id-->

        <div id="scrroll-<?php echo $id_post;?>" class="wpsp_container">
          <ul>
        <?php
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array('posts_per_page' => get_option('wpsp_mnop'),'category_name'=>get_option("wpsp_cat"), 'paged' => $paged );
query_posts($args);
query_posts( $args); if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <li >                
                  <?php if(get_option('wpsp_thumbnail_enable')==1){?> 
                  <p class="wpsp_img_box"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                  <?php the_post_thumbnail('small'); ?>
                  </a></p>
                  <?php } ?>                  
                  <div class="wpsp_detail">
                    
<?php if(get_option('wpsp_title_enable')==1){?> 
                    <h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
<?php }?>
                    <?php if(get_option('wpsp_date_enable')==1){?> <span><?php echo get_the_date();?></span><?php }?>
                   

                   <?php if(get_option('wpsp_excerpt_enable')==1){?> <p><?php //the_content();
                   
                   $wpsp_ex_len=get_option('wpsp_c_len');
                   
                     if (!is_numeric($wpsp_ex_len)) {
             $wpsp_ex_len=10;
             }
                   $wpsp_content = get_the_content();                   
$wpsp_trimmed = wp_trim_words( $wpsp_content, $wpsp_ex_len ,$more=null);
$wpsp_rest = substr($wpsp_trimmed, 0, -8); 
echo $wpsp_rest;
                   ?></p><?php }?>

                    
                     <?php if(get_option('wpsp_readmore_enable')==1){?> 
                      <a href="<?php the_permalink(); ?>" class="wpsp_readmore">
                     <?php echo get_option('wpsp_readmore'); ?> </a>
                     <?php }?>
                  </div>
                </li>
                <?php endwhile; endif; ?> 
              </ul>
              
            </div>
                  <?php 
        // output ends 
    }
   public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = __( 'wp scroll posts', 'wp-scroll-posts' );
        }
        
        ?>
        <p>
        <label for="<?php echo $this->get_field_name( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
               <?php 
    }
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] .= ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
          return $instance;
    }
} // class Foo_Widget
   // register Foo_Widget widget
   
   if (get_option('wpsp_enable') == 1){
function register_foo_widget() {
    register_widget( 'wp_scroll_post' );
}
add_action( 'widgets_init', 'register_foo_widget' );}



 add_filter('widget_text', 'do_shortcode'); //to enable shortcode in  text widget
/*****short code catcher starts here**/
function wpsp_shortcode_catcher( $atts ) {
 
 extract( shortcode_atts( array(
    'src' => 'default value',
    'cat' => get_option("wpsp_cat"),
    'width' => '350px',
    'height' => '400px',
    ), $atts ) );
	
    ob_start();
    
   
        
       ?>
<!--wp scrollpost  out put starts here by ajay sharma-->
<?php 

// output
$id_post= rand();
echo js_id_scrool($id_post);
?>
<!-- div id will be changed every time so please don't give css to id-->
<div id="scrroll-<?php echo $id_post;?>" class="wpsp_container">
          <ul>
        <?php

        //$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array('posts_per_page' => get_option('wpsp_mnop'),'category_name'=>$cat );
query_posts( $args); if ( have_posts($args) ) : while ( have_posts($args) ) : the_post($args); ?>
                <li >                
                  <?php if(get_option('wpsp_thumbnail_enable')==1){?> 
                  <p class="wpsp_img_box"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                  <?php the_post_thumbnail('small'); ?>
                  </a></p>
                  <?php } ?>                  
                  <div class="wpsp_detail">
                    
<?php if(get_option('wpsp_title_enable')==1){?> 
                    <h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
<?php }?>
                    <?php if(get_option('wpsp_date_enable')==1){?> <span><?php echo get_the_date();?></span><?php }?>
                   

                   <?php if(get_option('wpsp_excerpt_enable')==1){?> <p><?php //the_content();
                   
                   $wpsp_ex_len=get_option('wpsp_c_len');
                   
                     if (!is_numeric($wpsp_ex_len)) {
             $wpsp_ex_len=10;
             }
                   $wpsp_content = get_the_content();                   
                                 
$wpsp_trimmed = wp_trim_words( $wpsp_content, $wpsp_ex_len ,$more=null);
$wpsp_rest = substr($wpsp_trimmed, 0, -8); 
//echo $wpsp_rest;
echo $wpsp_trimmed;
                   ?></p><?php }?>

                    
                     <?php if(get_option('wpsp_readmore_enable')==1){?> 
                      <a href="<?php the_permalink(); ?>" class="wpsp_readmore">
                     <?php echo get_option('wpsp_readmore'); ?> </a>
                     <?php }?>
                  </div>
                </li>
                <?php endwhile; endif; wp_reset_query(); ?> 
              </ul>
              
            </div>
                  
<!--wp scrollpost  out put ends here by ajay sharma-->

<?php
    return ob_get_clean();
	 

     }
add_shortcode( 'wpsp', 'wpsp_shortcode_catcher' );

/*** short code catcher ends here******/
