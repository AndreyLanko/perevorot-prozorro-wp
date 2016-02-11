<?php
/*
  Plugin Name: Social Profile Widget
  Plugin URI: http://lemon.ua
  Description: Links to social media profile
  Author: Natalie
  Author URI: http://lemon.ua
 */

/**
 * Adds Social_Profile widget.
 */
class Lm_Social_Profile extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
                'Lm_Social_Profile',
                __('Social Networks Profiles', 'translation_domain'), // Name
                array('description' => __('Links to social media profile', 'translation_domain'),)
        );

    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget($args, $instance) {
        $title = apply_filters('widget_title', $instance['title']);
        $facebook = $instance['facebook'];
        $twitter = $instance['twitter'];
        $google = $instance['google'];
        $linkedin = $instance['linkedin'];
        $youtube = $instance['youtube'];

        $social_wrapper['before'] = '<li>';
        $social_wrapper['after'] = '</li>';

        // social profile link

        $facebook_profile = '<a href="' . $facebook . '" target="_blank"><i class="sprite-header-fb"></i></a>';
        $google_profile = '<a href="' . $google . '" target="_blank"><i class="sprite-header-g"></i></a>';
        $twitter_profile = '<a href="' . $twitter . '" target="_blank"><i class="sprite-header-tw"></i></a>';
        $linkedin_profile = '<a href="' . $linkedin . '" target="_blank"><i class="sprite-header-ln"></i></a>';
        $youtube_profile = '<a href="' . $youtube . '" target="_blank"><i class="sprite-header-youtube"></i></a>';

        echo $args['before_widget'];        

        echo '<ul class="social-top">';
        if (!empty($title)) {
            echo '<li class="title">'. $title .'</li>';
        }
        echo (!empty($facebook) ) ? $social_wrapper['before'].$facebook_profile.$social_wrapper['after'] : null;
        echo (!empty($twitter) ) ? $social_wrapper['before'].$twitter_profile.$social_wrapper['after'] : null;
        echo (!empty($google) ) ? $social_wrapper['before'].$google_profile.$social_wrapper['after'] : null;
        echo (!empty($linkedin) ) ? $social_wrapper['before'].$linkedin_profile.$social_wrapper['after'] : null;
        echo (!empty($youtube) ) ? $social_wrapper['before'].$youtube_profile.$social_wrapper['after'] : null;
        echo '</ul>';

        echo $args['after_widget'];
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form($instance) {
        isset($instance['title']) ? $title = $instance['title'] : null;
        empty($instance['title']) ? $title = 'We in Social Networks' : null;

        isset($instance['facebook']) ? $facebook = $instance['facebook'] : null;
        isset($instance['twitter']) ? $twitter = $instance['twitter'] : null;
        isset($instance['google']) ? $google = $instance['google'] : null;
        isset($instance['linkedin']) ? $linkedin = $instance['linkedin'] : null;
        isset($instance['youtube']) ? $youtube = $instance['youtube'] : null;
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('facebook'); ?>"><?php _e('Facebook:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('facebook'); ?>" name="<?php echo $this->get_field_name('facebook'); ?>" type="text" value="<?php echo esc_attr($facebook); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('twitter'); ?>"><?php _e('Twitter:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('twitter'); ?>" name="<?php echo $this->get_field_name('twitter'); ?>" type="text" value="<?php echo esc_attr($twitter); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('google'); ?>"><?php _e('Google+:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('google'); ?>" name="<?php echo $this->get_field_name('google'); ?>" type="text" value="<?php echo esc_attr($google); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('linkedin'); ?>"><?php _e('Linkedin:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('linkedin'); ?>" name="<?php echo $this->get_field_name('linkedin'); ?>" type="text" value="<?php echo esc_attr($linkedin); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('youtube'); ?>"><?php _e('Youtube:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('youtube'); ?>" name="<?php echo $this->get_field_name('youtube'); ?>" type="text" value="<?php echo esc_attr($youtube); ?>">
        </p>
        <?php
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title']) ) ? strip_tags($new_instance['title']) : '';
        $instance['facebook'] = (!empty($new_instance['facebook']) ) ? strip_tags($new_instance['facebook']) : '';
        $instance['twitter'] = (!empty($new_instance['twitter']) ) ? strip_tags($new_instance['twitter']) : '';
        $instance['google'] = (!empty($new_instance['google']) ) ? strip_tags($new_instance['google']) : '';
        $instance['linkedin'] = (!empty($new_instance['linkedin']) ) ? strip_tags($new_instance['linkedin']) : '';
        $instance['youtube'] = (!empty($new_instance['youtube']) ) ? strip_tags($new_instance['youtube']) : '';

        return $instance;
    }

}

// register Lm_Social_Profile widget
function register_Lm_social_profile() {
    register_widget('Lm_Social_Profile');
}

add_action('widgets_init', 'register_Lm_social_profile');

class Lm_Social_Share extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
                'Lm_Social_Share',
                __('Social Networks Shares', 'translation_domain'), // Name
                array('description' => __('Links to share', 'translation_domain'),)
        );
        $action = $_POST['actionSocial'];
        if (method_exists($this, $action)) {
            $post_data = $_POST;
            $this->$action($post_data);
        }
    }

    function updateCount($data) {
      global $wpdb;
      $table_name = "wp_lm_social";
      $sql = "CREATE TABLE IF NOT EXISTS `".$table_name."` (
  `id` int(11) NOT NULL,
  `fb` int(11) NOT NULL DEFAULT '0',
  `tw` int(11) NOT NULL DEFAULT '0',
  `in` int(11) NOT NULL DEFAULT '0',
  `vk` int(11) NOT NULL DEFAULT '0',
  `gp` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
      $wpdb->query($sql);
      $json_response = array(
        'success' =>  false
      );
      $sql = "select count(*) from $table_name where id = ".$data['post_id'];
      $result = $wpdb->get_var($wpdb->prepare($sql));
      if ($result == 0) {
        $insert_data = array(
          'id'  =>  $data['post_id']
        );
        $wpdb->insert($table_name,$insert_data);
      }
      $function_name = $data['type']."_share_count";
      if (method_exists($this,$function_name)) {
        $count = $this->$function_name($data['current_url']);
        $update_data = array(
          $data['type'] =>  $count
        );
        $wpdb->update($table_name,$update_data,array('id'=>$data['post_id']));
        $json_response['success'] = true;
      }
      echo json_encode($json_response);
      exit();
    }

    function fb_share_count($url) {
        $api = file_get_contents("http://api.facebook.com/method/links.getStats?urls=".$url."&format=json");
        $count = reset(json_decode( $api ));
        return $count->share_count;
    }
    function tw_share_count($url) {
       // $api = file_get_contents( 'https://cdn.api.twitter.com/1/urls/count.json?url=' . $url );
        $api = file_get_contents( 'http://opensharecount.com/count.json?url=' . $url );
        $count = json_decode($api);
        return $count->count;
    }
    function in_share_count($url) {
        $api = file_get_contents('http://www.linkedin.com/countserv/count/share?format=json&url='. $url );
        $count = json_decode($api);
        return $count->count;
    }
    function vk_share_count($url) {
        $api = file_get_contents('http://vkontakte.ru/share.php?act=count&index=1&url='. $url );
        $tmp = array();
        preg_match('/^VK.Share.count\(1, (\d+)\);$/i',$api,$tmp);
        return $tmp[1];
    }
    function gp_share_count($url) {
        $curl = curl_init();
        curl_setopt( $curl, CURLOPT_URL, "https://clients6.google.com/rpc" );
        curl_setopt( $curl, CURLOPT_POST, 1 );
        curl_setopt( $curl, CURLOPT_POSTFIELDS, '[{"method":"pos.plusones.get","id":"p","params":{"nolog":true,"id":"' . $url . '","source":"widget","userId":"@viewer","groupId":"@self"},"jsonrpc":"2.0","key":"p","apiVersion":"v1"}]' );
        curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $curl, CURLOPT_HTTPHEADER, array( 'Content-type: application/json' ) );
        $curl_results = curl_exec( $curl );
        curl_close( $curl );
        $json = json_decode( $curl_results, true );
        return intval( $json[0]['result']['metadata']['globalCounts']['count'] );
    }

    public function getPostData($id) {
      global $wpdb;
      $table_name = "wp_lm_social";
      return $wpdb->get_row("SELECT * FROM $table_name WHERE id = $id");
    }

    public function getPostSocial($id,$type) {
      $post = $this->getPostData($id);
      if (!empty($post)) return $post->$type;
      return 0;
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget($args, $instance) {
        $datatitle = get_the_title();
        $dataitem = get_the_ID();
        if (!is_singular('faq') & !is_post_type_archive('faq')){
            $datahref = get_the_permalink();           
        } else $datahref = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];

        $title = apply_filters('widget_title', $instance['title']);
        $facebook = $instance['facebook'] ? 'true' : 'false';
        $twitter = $instance['twitter'] ? 'true' : 'false';
        $google = $instance['google'] ? 'true' : 'false';
        $linkedin = $instance['linkedin'] ? 'true' : 'false';
        $vkontakte = $instance['vkontakte'] ? 'true' : 'false';

        $social_wrapper['before'] = '<li>';
        $social_wrapper['after'] = '</li>';

        // social profile link
        $facebook_profile = '<a data-item="'.$dataitem.'" data-type="fb" data-title="'.$datatitle.'" data-href="'.$datahref.'" href="" target="_blank"><i class="sprite-social-fb"></i></a>';
        $google_profile = '<a data-item="'.$dataitem.'" data-type="gp" data-title="'.$datatitle.'" data-href="'.$datahref.'" href="" target="_blank"><i class="sprite-social-g"></i></a>';
        $twitter_profile = '<a data-item="'.$dataitem.'" data-type="tw" data-title="'.$datatitle.'" data-href="'.$datahref.'" href="" target="_blank"><i class="sprite-social-tw"></i></a>';
        $linkedin_profile = '<a data-item="'.$dataitem.'" data-type="in" data-title="'.$datatitle.'" data-href="'.$datahref.'" href="" target="_blank"><i class="sprite-social-in"></i></a>';
        $vkontakte_profile = '<a data-item="'.$dataitem.'" data-type="vk" data-title="'.$datatitle.'" data-href="'.$datahref.'" href="" target="_blank"><i class="sprite-social-vk"></i></a>';
        $post_id = get_the_ID();

        $_fb = $this->getPostSocial($post_id,'fb');
        $_tw = $this->getPostSocial($post_id,'tw');
        $_gp = $this->getPostSocial($post_id,'gp');
        $_in = $this->getPostSocial($post_id,'in');
        $_vk = $this->getPostSocial($post_id,'vk');

        $facebook_count = ($_fb)?'<span class="share-count">'.$_fb.'</span>':'';
        $google_count = ($_gp)?'<span class="share-count">'.$_gp.'</span>':'';
        $twitter_count = ($_tw)?'<span class="share-count">'.$_tw.'</span>':'';
        $linkedin_count = ($_in)?'<span class="share-count">'.$_in.'</span>':'';
        $vkontakte_count = ($_vk)?'<span class="share-count">'.$_vk.'</span>':'';

        echo $args['before_widget'];        

        echo '<ul class="share">';
        if (!empty($title)) {
            echo $args['before_title'] . $title . $args['after_title'];
        }
        echo (isset( $instance[ 'facebook' ] ) ) ? $social_wrapper['before'].$facebook_profile.$facebook_count.$social_wrapper['after'] : null;
        echo (isset( $instance[ 'twitter' ] ) ) ? $social_wrapper['before'].$twitter_profile.$twitter_count.$social_wrapper['after'] : null;
        echo (isset( $instance[ 'google' ] ) ) ? $social_wrapper['before'].$google_profile.$google_count.$social_wrapper['after'] : null;
        echo (isset( $instance[ 'linkedin' ] ) ) ? $social_wrapper['before'].$linkedin_profile.$linkedin_count.$social_wrapper['after'] : null;
        echo (isset( $instance[ 'vkontakte' ] ) ) ? $social_wrapper['before'].$vkontakte_profile.$vkontakte_count.$social_wrapper['after'] : null;
        echo '</ul>';

        echo $args['after_widget'];
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form($instance) {
        isset($instance['title']) ? $title = $instance['title'] : null;
        empty($instance['title']) ? $title = 'Social Networks Shares' : null;

        isset($instance['facebook']) ? $facebook = $instance['facebook'] : null;
        isset($instance['twitter']) ? $twitter = $instance['twitter'] : null;
        isset($instance['google']) ? $google = $instance['google'] : null;
        isset($instance['linkedin']) ? $linkedin = $instance['linkedin'] : null;
        isset($instance['vkontakte']) ? $linkedin = $instance['vkontakte'] : null;
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('facebook'); ?>"><?php _e('Facebook:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('facebook'); ?>" name="<?php echo $this->get_field_name('facebook'); ?>" type="checkbox"  <?php checked( $instance[ 'facebook' ], 'on' ); ?> />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('twitter'); ?>"><?php _e('Twitter:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('twitter'); ?>" name="<?php echo $this->get_field_name('twitter'); ?>" type="checkbox" <?php checked( $instance[ 'twitter' ], 'on' ); ?> />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('google'); ?>"><?php _e('Google+:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('google'); ?>" name="<?php echo $this->get_field_name('google'); ?>" type="checkbox" <?php checked( $instance[ 'google' ], 'on' ); ?> />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('linkedin'); ?>"><?php _e('Linkedin:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('linkedin'); ?>" name="<?php echo $this->get_field_name('linkedin'); ?>" type="checkbox" <?php checked( $instance[ 'linkedin' ], 'on' ); ?> />
        </p>
         <p>
            <label for="<?php echo $this->get_field_id('vkontakte'); ?>"><?php _e('ВКонтакте:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('vkontakte'); ?>" name="<?php echo $this->get_field_name('vkontakte'); ?>" type="checkbox" <?php checked( $instance[ 'vkontakte' ], 'on' ); ?> />
        </p>

        <?php
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = (!empty($new_instance['title']) ) ? strip_tags($new_instance['title']) : '';
        $instance['facebook'] = $new_instance['facebook'];
        $instance['twitter'] = $new_instance['twitter'];
        $instance['google'] = $new_instance['google'];
        $instance['linkedin'] = $new_instance['linkedin'];
        $instance['vkontakte'] = $new_instance['vkontakte'];

        return $instance;
    }

}

// register Lm_Social_Profile widget
function register_Lm_social_share() {
    register_widget('Lm_Social_Share');
}
add_action('widgets_init', 'register_Lm_social_share');

// enqueue css stylesheet
function Lm_social_profile_widget_css() {
    wp_enqueue_style('social-profile-widget', plugins_url('lm-social-profile-widget.css', __FILE__));
    wp_enqueue_script('social-profile-widget', plugins_url('lm-social-profile-widget.js', __FILE__));
}
add_action('wp_enqueue_scripts', 'Lm_social_profile_widget_css');



