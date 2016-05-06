<?php
// Отключаем сам REST API
 add_filter('rest_enabled', '__return_false');
 // Отключаем фильтры REST API 
 remove_action( 'xmlrpc_rsd_apis', 'rest_output_rsd' ); 
 remove_action( 'wp_head', 'rest_output_link_wp_head', 10, 0 ); 
 remove_action( 'template_redirect', 'rest_output_link_header', 11, 0 ); 
 remove_action( 'auth_cookie_malformed', 'rest_cookie_collect_status' ); 
 remove_action( 'auth_cookie_expired', 'rest_cookie_collect_status' ); 
 remove_action( 'auth_cookie_bad_username', 'rest_cookie_collect_status' ); 
 remove_action( 'auth_cookie_bad_hash', 'rest_cookie_collect_status' ); 
 remove_action( 'auth_cookie_valid', 'rest_cookie_collect_status' ); 
 remove_filter( 'rest_authentication_errors', 'rest_cookie_check_errors', 100 );
 // Отключаем события REST API 
 remove_action( 'init', 'rest_api_init' ); 
 remove_action( 'rest_api_init', 'rest_api_default_filters', 10, 1 ); 
 remove_action( 'parse_request', 'rest_api_loaded' );
// Отключаем Embeds связанные с REST API 
 remove_action( 'rest_api_init', 'wp_oembed_register_route' ); 
 remove_filter( 'rest_pre_serve_request', '_oembed_rest_pre_serve_request', 10, 4 );

add_filter('pre_site_transient_update_core',create_function('$a', "return null;"));
wp_clear_scheduled_hook('wp_version_check');
remove_action( 'load-update-core.php', 'wp_update_plugins' );
add_filter( 'pre_site_transient_update_plugins', create_function( '$a', "return null;" ) );

register_nav_menus(array(
  'top_menu' => 'Меню в header(на голубом фоне)',  
  'header_menu' => 'Меню в header', 
  'provider_menu' => 'Меню в "Поставщикам"',  
  'customer_menu' => 'Меню в "Заказчику"', 
  'reform_menu' => 'Меню в "Про реформу"', 
  'platform_menu' => 'Меню в "Площадкам"', 
  'foot_menu_left' => 'Меню в footer слева',
  'foot_menu_center' => 'Меню в footer по центру',
  'foot_menu_right' => 'Меню в footer справа'
));

function get_dynamic_sidebar($index=1) {
    $sidebar_contents = "";
    ob_start();
    dynamic_sidebar($index);
    $sidebar_contents = ob_get_clean();
    return $sidebar_contents;
}

function register_my_widgets(){
  register_sidebar( array(
	'name' => 'Контакты в футере',
	'id' => 'footer-contacts-sidebar',
	'description' => 'Выводиться в футер справа',
	'before_widget' => '',
	'after_widget' => '',
	'before_title' => '<h4>',
	'after_title' => '</h4>',
  ));
  register_sidebar( array(
    'name' => 'Заказчику',
    'id' => 'customer-sidebar',
    'description' => 'Выводиться в body страницы "Заказчику"',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '<h1>',
    'after_title' => '</h1>',
  ));
  register_sidebar( array(
    'name' => 'Поделиться',
    'id' => 'share-sidebar',
    'description' => 'Выводиться в конце новостей, записей и ответов/вопросов',
    'before_widget' => '<div class="nav navbar-nav inline-navbar margin-bottom">',
    'after_widget' => '</div>',
    'before_title' => '<li>',
    'after_title' => '</li>',
  ));
  register_sidebar( array(
    'name' => 'Кнопки соцсетей',
    'id' => 'social-sidebar',
    'description' => 'Выводиться в header и footer',
    'before_widget' => '<div class="nav navbar-nav inline-navbar">',
    'after_widget' => '</div>',
    'before_title' => '<li>',
    'after_title' => '</li>',
  ));
}
add_action( 'widgets_init', 'register_my_widgets' );

function register_faq_widget() { 
  register_widget( 'FAQ_Widget' );
} 
class FAQ_Widget extends WP_Widget {
  function __construct() {
    parent::__construct(
      'faq_widget', // Base ID
      __( 'Widget Title', 'text_domain' ), // Name
      array( 'description' => __( 'A FAQ Widget', 'text_domain' ), ) // Args
    );
  }
  function FAQ_Widget() {
      $widget_ops = array( 'classname' => 'example', 'description' => __('Виджет, который выводит FAQ с отметкой "Топ"', 'example') );
      $control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'example-widget' );
      $this->WP_Widget( 'example-widget', __('FAQ Widget', 'example'), $widget_ops, $control_ops );
  }
  public function widget($args, $instance) {
    extract($args);
    $title = apply_filters('widget_title', $instance['title'] );
    echo $before_widget; 
    if ( $title )
      echo $before_title . $title . $after_title;
     faq_in_top();
     echo $after_widget; 
  }
  public function update( $new_instance, $old_instance ) {
      $instance = $old_instance;
      //Strip tags from title and name to remove HTML
      $instance['title'] = strip_tags( $new_instance['title'] ); 
      return $instance;
  }
  public function form( $instance ) {
    $title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'New title', 'text_domain' );
    ?>
    <p>
    <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
    <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
    </p>
    <?php 
  }
}
add_action( 'widgets_init', 'register_faq_widget' );
add_action( 'init', 'create_post_type' );
function create_post_type() {
  register_post_type( 'faq',
    array(
    'labels' => array(
              'name' => 'FAQ',
              'has_archive' => true
              ),
    'public' => true,
    'supports' => array( 'title', 'editor' ),
   'taxonomies' => array('category'),
   'show_in_menu'=>true,
   'menu_position'=>5,
   'menu_icon'=>'dashicons-format-chat',
   'rewrite' => array('slug' => '/category/faq/'),
   'query_var' => true,
   'has_archive' => true,
   'hierarchical' => false,
   'publicly_queryable' => false
   ));

   register_post_type( 'partners',
    array(
    'labels' => array(
              'name' => 'Партнери',
              'has_archive' => true
              ),
   'public' => true,
   'supports' => array( 'title' ),
   'show_in_menu'=>true,
   'menu_position'=>5,
   'menu_icon'=>'dashicons-businessman',
   'rewrite' => array('slug' => '/partner'),
   'query_var' => true,
   'has_archive' => true,
   'hierarchical' => false,
   'publicly_queryable' => false
   ));

   register_post_type( 'faces',
    array(
    'labels' => array(
              'name' => 'Обличчя реформи',
              'has_archive' => true
              ),
   'public' => true,
   'supports' => array( 'title' ),
   'show_in_menu'=>true,
   'menu_position'=>5,
   'menu_icon'=>'dashicons-smiley',
   'rewrite' => array('slug' => '/faces'),
   'query_var' => true,
   'has_archive' => true,
   'hierarchical' => false,
    'publicly_queryable' => false
   ));

   register_post_type( 'dogovory',
    array(
    'labels' => array(
              'name' => 'Укладені договори',
              'has_archive' => true
              ),
   'public' => true,
   'supports' => array( 'title','editor' ),
   'show_in_menu'=>true,
   'menu_position'=>4,
   'menu_icon'=>'dashicons-id-alt',
   'rewrite' => array('slug' => '/dogovory'),
   'query_var' => true,
   'has_archive' => true,
   'hierarchical' => false,
    'publicly_queryable' => false
   ));
}


function add_faqcategory_automatically($post_ID) {
  global $wpdb;
  if(!has_term('','category',$post_ID)) {
    $faqcat = array (15);
    wp_set_object_terms( $post_ID, $faqcat, 'category');
  }
}
add_action('publish_faq', 'add_faqcategory_automatically');

function inherit_template(){
    if (is_category()){
        $catid = get_query_var('cat');
        $cat = &get_category($catid);
        $parent = $cat->category_parent;
        $cat = &get_category($parent);
        if ($cat->cat_ID == 15) {
            if (file_exists(TEMPLATEPATH . '/category-faq.php'))  {
                include (TEMPLATEPATH . '/category-faq.php');
                exit;
            }
        }
    }
}

function lemon_wp_title( $title, $sep ) {
  global $paged, $page;
  if ( is_feed() )
  return $title;
  $title .= get_bloginfo( 'name', 'display' );
  $site_description = get_bloginfo( 'description', 'display' );
  if ( $site_description && ( is_home() || is_front_page() ) )
    $title = "$title $sep $site_description";
  return $title;
}
add_filter( 'wp_title', 'lemon_wp_title', 10, 2 );

function lemon_body_class( $classes ) {
  if ( function_exists('qtrans_getLanguage') ){
  	if ( qtrans_getLanguage()=='ua')
  		$classes[] = 'ua_content';
  	if ( qtrans_getLanguage()=='en')
  		$classes[] = 'en_content';
  }
	return $classes;
}
add_filter( 'body_class', 'lemon_body_class' );

function lemon_menu_name( $location ) {
  if( empty($location) ) return false;

    $locations = get_nav_menu_locations();
    if( ! isset( $locations[$location] ) ) return false;

    $menu_obj = get_term( $locations[$location], 'nav_menu' );
	$menu_title = $menu_obj->name;

	return $menu_title;
}

function content($limit) {
  $content = explode(' ', strip_tags(get_the_content()), $limit);
  if (count($content)>=$limit) {
    array_pop($content);
    $content = implode(" ",$content).'...'.'<br />';
  } else {
    $content = implode(" ",$content);
  } 
  $content = preg_replace('/\[.+\]/','', $content);
  $content = apply_filters('the_content', $content); 
  $content = str_replace(']]>', ']]&gt;', $content);
  return $content;
}

function trim_event_text($text, $count, $after) {
  if (mb_strlen($text) > $count) $text = mb_substr($text,0,$count);
  else $after = '';
  return $text . $after;
}

function trim_title_chars($count, $after) {
  $title = get_the_title();
  if (mb_strlen($title) > $count) $title = mb_substr($title,0,$count);
  else $after = '';
  return $title . $after;
}

function my_post_queries( $query ) {
    if (!is_admin() && $query->is_main_query()){
        if(is_category(15)||is_category(12)||is_category(13)){
            // $query->set('posts_per_page', 2);
            $query->set('post_type','faq');
        }
    }
}
add_action( 'pre_get_posts', 'my_post_queries' );

function wp_corenavi() {
  global $wp_query;
  $pages = '';
  $max = $wp_query->max_num_pages;
  if (!$current = get_query_var('paged')) $current = 1;
  $a['base'] = str_replace(999999999, '%#%', get_pagenum_link(999999999));
  $a['total'] = $max;
  $a['current'] = $current;

  $total = 0; //1 - выводить текст "Страница N из N", 0 - не выводить
  $a['mid_size'] = 2; //сколько ссылок показывать слева и справа от текущей
  $a['end_size'] = 3; //сколько ссылок показывать в начале и в конце
  $a['prev_text'] = '...'; //текст ссылки "Предыдущая страница"
  $a['next_text'] = '...'; //текст ссылки "Следующая страница"

  if ($max > 1) echo '<div class="navigation">';
  if ($total == 1 && $max > 1) $pages = '<span class="pages">Страница ' . $current . ' из ' . $max . '</span>'."\r\n";
  echo $pages . paginate_links($a);
  if ($max > 1) echo '</div>';
}

add_shortcode('button-to-page', 'button_to_page');
function button_to_page() {
	global $post;
	$pageLink = $post->post_name;
	$addClass = 'reg-in-body';
	$registerLink = '#';
	if ($pageLink=='zamovniku') {
		$registerLink = get_permalink( get_page_by_path( 'pochaty-robotu-zamovnyku' ) );
		$addClass = '';
	}
		elseif ($pageLink=='postachalniku') {
			$registerLink = get_permalink( get_page_by_path( 'pochaty-robotu-postachalnyku' ) );
			$addClass = '';
		}
	$pageContent='';
	$pageContent.='<div class="clearfix"></div><hr />';
	$pageContent.='<div class="system-advantages--buttons"><a class="green-btn '.$addClass.'" href="'.$registerLink.'"><span id="ua">Зареєструватись</span><span id="en">Register</span></a>';
	$pageContent.='<a href="http://help.vdz.ua" target="_blank" class="blue-btn"><span id="ua">Перейти на Базу знань</span><span id="en">Go to Database</span></a>';
	$pageContent.='<a class="red-btn" href="'.get_permalink( get_page_by_path( 'yak-oskarzhyty-torgy' ) ).'"><span id="ua">Оскаржити торги</span><span id="en">File a complaint</span></a>';
	$pageContent.='</div>';

	return $pageContent;
}

add_shortcode('faq-in-top', 'faq_in_top');
function faq_in_top() {
  echo '<div class="faq"><ul class="faq--list">';
  $args = array(
    'posts_per_page' => -1, 
    'orderby' => 'menu_order', 
    'post_type' => 'faq', 
    'post_status' => 'publish',
    'meta_query' => array(
      array(
        'key' => 'top_faq',
        'value' => 1
      )
    )
   );
  $query = new WP_Query($args); 
  if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); 
  echo '<li><div class="faq--qestion"><a href="#faq-'.get_the_ID().'" data-toggle="collapse">'.get_the_title().'</a></div><div id="faq-'.get_the_ID().'" class="collapse"><div class="faq--answer">'.get_the_content().'</div>';
 // if ( function_exists('dynamic_sidebar') ) dynamic_sidebar('share-sidebar');
  echo '<div class="clearfix"></div></div></li>';
  endwhile; endif;
  wp_reset_postdata();
  echo '</ul><div> <a href="'.get_category_link(15).'" ><i class="sprite-arrow-right"></i>&nbsp;<span id="ua">Всі питання</span><span id="en">All FAQ</span></a></div><hr /></div>';
}

function author_img($my_user_id) {
  $author_id = get_the_author_meta($my_user_id);
  $author_img = get_field('author-photo', 'user_'. $my_user_id );
  $author_img_src = $author_img['url'];
  return $author_img_src ;
}

function last_news($total_news){
  $category_link = get_category_link ($categ_id); 
  $args = array(
    'posts_per_page' => $total_news, 
    'orderby' => 'comment_count', 
    'author' => all_experts()
    );
  $query = new WP_Query($args); 
    if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); 
       $avtor = get_the_author_meta('ID',$post->post_author);
       $author_posts_url = get_author_posts_url($avtor); 
       $user = get_userdata($avtor);
      echo '<div class="news-wrapper"><div class="img_wrapper"><img src="'.author_img($avtor).'" alt="'.$user->user_firstname . ' ' . $user->user_lastname.'" /></div>';
      echo '<div class="avtor"><a href="'.$author_posts_url.'">'.$user->user_firstname .' '. $user->user_lastname. '</a></div><div class="blog-title"><a href="'. get_permalink() .'">'. get_the_title() .'</a></div><div class="date-time">'; news_date($post->ID); 
      echo', '.get_the_time().' '.comments($post->ID).'</div><div class="clearfix"></div></div>';
  endwhile; endif;
  wp_reset_postdata();
}

add_shortcode('vacancies-in-top', 'vacancies_in_top');
function vacancies_in_top(){
  $text_to_site = '';
  $args = array(
    'showposts' => 3, 
    'category_name' =>  'vacancies',
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC'
  );
  $wp_query = new WP_Query( $args );
  $cat = get_category_by_slug('vacancies');
  $text_to_site.='<h1 align="center">'.$cat->cat_name.'</h1>';
  if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post(); 
      $text_to_site.= '<div class="row">
                         <div class="vacancies col-md-12 col-lg-12 col-sm-12 col-xs-12">
                          <span class="day">';
      $text_to_site.= get_the_time('d.m.y');
      $text_to_site.='</span>
                          <h3 class="title"><a href="';
      $text_to_site.= get_the_permalink(); 
      $text_to_site.='">';
      $text_to_site.= get_the_title();
      $text_to_site.= '</a></h3>';
      $text_to_site.= content(15); 
      $text_to_site.= '<div class="clearfix"></div>';
      $text_to_site.= get_dynamic_sidebar('share-sidebar');
      $text_to_site.= '<div class="more"><a href="';
      $text_to_site.= get_the_permalink(); 
      $text_to_site.= '"><i class="sprite-arrow-right"></i>  <span id="ua">Детальніше</span><span id="en">More</span></a></div>
                          <div class="clearfix"></div>
                          <hr />    
                          </div>
                      </div>';
      endwhile; endif;
      wp_reset_postdata(); 
      return $text_to_site;
  }

add_shortcode('official-news-in-top', 'official_news_in_top');
function official_news_in_top(){
  $text_to_site = '';
  $args = array(
    'showposts' => 4, 
    'category_name' =>  'ofitsijni-novyny',
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC'
  );
  $wp_query = new WP_Query( $args );
  $cat = get_category_by_slug('ofitsijni-novyny');
  $text_to_site.='<h1 align="center"><span id="ua">Останні зміни до законодавства</span><span id="en">Last law revisions</span></h1>';
  $text_to_site.= '<div class="row">
                         <div class="gray-bg padding margin-bottom">';
  if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post(); 
      $text_to_site.= '<div class="col-md-3 col-sm-6 col-xs-12"><span class="day">';
      $text_to_site.= get_the_time('d.m.y');
      $text_to_site.='</span><p><a href="';
      $text_to_site.= get_the_permalink(); 
      $text_to_site.='">';
      $text_to_site.= get_the_title();
      $text_to_site.= '</a></p><div class="clearfix"></div>';
      $text_to_site.= '</div>';
      endwhile; endif;
      wp_reset_postdata(); 
       $text_to_site.='<div class="clearfix"></div></div><div class="blog-all"> <a href="'.get_category_link($cat->term_id).'" ><i class="sprite-arrow-right"></i>  <span id="ua">Перейти до останніх змін до законодавства</span><span id="en">Go to last law revisions</span></a><div class="clearfix"></div></div><hr />';
      return $text_to_site;
  }

add_shortcode('author-in-top', 'author_in_top');
function author_in_top(){
  global $wpdb;
  $f_content='';
  $lastnames = $wpdb->get_col("SELECT user_id FROM $wpdb->usermeta WHERE $wpdb->usermeta.meta_key = 'last_name' ORDER BY $wpdb->usermeta.meta_value ASC"); 
    $i=0;
    $f_content.= '<hr /><h1>'.get_cat_name(16).'</h1><div class="blog-list blog-sm"><div class="row"><div class="render-as-table-sm">';  
    foreach ($lastnames as $userid) { 
      $user = get_userdata($userid);  
      $roles = $user->roles;      
      $post_count = get_usernumposts($user->ID); 
      $author_posts_url = get_author_posts_url($user->ID); 
      $intop = get_field('top_faq', 'user_'. $user->ID);
      $posada = get_field('posada', 'user_'. $user->ID);
    $args = array('posts_per_page' => 1, 'orderby' => 'date', 'author' => $user->ID, 'cat'=> 16);
    $query = new WP_Query($args); 
    if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
    if (($roles[0] == 'author') and ($intop == 1) and ($i < 4)){     
      $f_content.= '<div class="col-sm-3 gray-bg">';
      $f_content.= '<div class="padding top-blog">
                      <div class="day">'.get_the_date('j.m.Y').'</div>
                      <div class="title"><a href="'.get_the_permalink().'" >'.trim_title_chars(45, '...').'</a></div>
                    </div>
                    <hr />
                    <div class="img_wrapper padding">
                      <img src="'.author_img($user->ID).'" alt="'. $user->user_firstname . ' ' . $user->user_lastname .'" />
                    </div>
                    <hr />
                    <div class="padding">
                      <div class="blog--fio">
                        <a href="'. $author_posts_url .'">'. $user->user_firstname . ' ' . $user->user_lastname .'</a>
                      </div>'.
                    $posada
                    .'</div>'.comments($post->ID).'<a class="blog-more" href="'.get_the_permalink().'" ><i class="sprite-arrow-right"></i>&nbsp;<span id="ua">Детальніше</span><span id="en">More</span></a></div>';
    $i++;
    }   
    endwhile; endif;
    wp_reset_postdata();
   }
    $f_content.= '</div><div class="clearfix"></div><div class="blog-all"> <a href="'.get_category_link(16).'" ><i class="sprite-arrow-right"></i> '.get_cat_name(16).'</a></div></div><hr /></div>';    
    return $f_content;
}

function single_last_blog($categoryid){
  global $wpdb;
  $f_content='';
  $args = array(
            'showposts' => 1, 
            'orderby' => 'date',
            'order' => 'DESC',  
            'cat'=> $categoryid,
            'author' => all_experts()
          );
           $query = new WP_Query($args); 
           if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
               $avtor = get_the_author_meta('ID',$post->post_author);
               $user = get_userdata($avtor);   
               $posada = get_field('posada', 'user_'. $user->ID); 
               $author_posts_url = get_author_posts_url($user->ID);
               $f_content.= '<div class="gray-bg">';
               $f_content.= '<div class="padding top-blog">
                                <div class="day">'.get_the_date('j.m.Y').'</div>
                                <div class="title"><a href="'.get_the_permalink().'" >'.trim_title_chars(45, '...').'</a></div>
                              </div>
                              <hr />
                              <div class="img_wrapper padding">
                                <img src="'.author_img($user->ID).'" alt="'. $user->user_firstname . ' ' . $user->user_lastname .'" />
                              </div>
                              <div class="clearfix"></div>
                              <hr />
                              <div class="padding">
                                <div class="blog--fio">
                                  <a href="'. $author_posts_url .'">'. $user->user_firstname . ' ' . $user->user_lastname .'</a>
                                </div>'.
                                $posada
                              .'</div>'.comments($post->ID).'<a class="blog-more" href="'.get_the_permalink().'" ><i class="sprite-arrow-right"></i>&nbsp;<span id="ua">Детальніше</span><span id="en">More</span></a></div>';
         endwhile; endif;
   wp_reset_postdata();
   $f_content.= '<div class="clearfix"></div>';    
   return $f_content;
}

function all_experts() {
global $wpdb;
$authors = $wpdb->get_results("SELECT ID, user_nicename from $wpdb->users ORDER BY display_name");
foreach($authors as $author) {
  $user = get_userdata($author->ID);  
  $roles = $user->roles;  
  $author_id = $user->ID;
  // if (($roles[0]=='author')|($roles[0]=='editor')) {
  if ($roles[0]=='author') {
    $author_id_array[]=$author_id;
   }
 } $author_list_str = implode(",", $author_id_array);
 return $author_list_str;
}

function show_experts() {  
  $number     = 100;  
  $roles    ='author';
  $paged      = (get_query_var('paged')) ? get_query_var('paged') : 1;  
  $offset     = ($paged - 1) * $number;  
  $users      = get_users();  
  $query      = get_users('&offset='.$offset.'&number='.$number.'&role='.$roles);  
  $total_users = count($users);  
  $total_query = count($query);  
  $total_pages = intval($total_users / $number) + 1;        
foreach($query as $q) {   
  $author_id = $q->ID;
  $author_url = get_author_posts_url($q->ID);
  ?>
  <div class="author-info">
  <a class="news-link" href="<?php echo $author_url; ?>"> 
    <div class="avatar" style="background: url('<?php echo author_img($author_id); ?>'); background-position:50%;"><span class="more_news_img"></span></div>
    <div class="author-heading"><?php the_author_meta('display_name', $author_id); ?></div>
    <div class="author-title"><?php the_author_meta('author-post', $author_id); ?></div>    
  </a>
  </div>  
<?php }  
}

function news_date($id){
  $my_post_id = get_post($id); 
  $mon = date('m',strtotime($my_post_id->post_date));
  $year = date('Y',strtotime($my_post_id->post_date));
  $day = date('d',strtotime($my_post_id->post_date));

  switch ($day) {
  case "01":
        $day = '1';
        break;
  case "02":
        $day = '2';
        break;
  case "03":
        $day = '3';
        break;
  case "04":
        $day = '4';
        break;
  case "05":
        $day = '5';
        break;
  case "06":
        $day = '6';
        break;
  case "07":
        $day = '7';
        break;
  case "08":
        $day = '8';
        break;
  case "09":
        $day = '9';
        break;
    }

  switch ($mon) {
    case "01":
        $monthnum = '<!--:ru-->января<!--:--><!--:ua-->січня<!--:--><!--:en-->January<!--:-->';
        break;
    case "02":
        $monthnum = '<!--:ru-->февраля<!--:--><!--:ua-->лютого<!--:--><!--:en-->February<!--:-->';
        break;
    case "03":
        $monthnum = '<!--:ru-->марта<!--:--><!--:ua-->березня<!--:--><!--:en-->March<!--:-->';
        break;
    case "04":
        $monthnum = '<!--:ru-->апреля<!--:--><!--:ua-->квітня<!--:--><!--:en-->April<!--:-->';
        break;
    case "05":
        $monthnum = '<!--:ru-->мая<!--:--><!--:ua-->травня<!--:--><!--:en-->May<!--:-->';
        break;
    case "06":
        $monthnum = '<!--:ru-->июня<!--:--><!--:ua-->червня<!--:--><!--:en-->June<!--:-->';
        break;
    case "07":
        $monthnum = '<!--:ru-->июля<!--:--><!--:ua-->липня<!--:--><!--:en-->July<!--:-->';
        break;
    case "08":
        $monthnum = '<!--:ru-->августа<!--:--><!--:ua-->серпня<!--:--><!--:en-->August<!--:-->';
        break;
    case "09":
        $monthnum = '<!--:ru-->сентября<!--:--><!--:ua-->вересня<!--:--><!--:en-->September<!--:-->';
        break;
    case "10":
        $monthnum = '<!--:ru-->октября<!--:--><!--:ua-->жовтня<!--:--><!--:en-->October<!--:-->';
        break;
    case "11":
        $monthnum = '<!--:ru-->ноября<!--:--><!--:ua-->листопада<!--:--><!--:en-->November<!--:-->';
        break;
    case "12":
        $monthnum = '<!--:ru-->декабря<!--:--><!--:ua-->грудня<!--:--><!--:en-->Desember<!--:-->';
        break;
  }
  echo _e(' '. $day .' '. $monthnum .' '. $year );
}


function comments($my_post_id){
  $com_content = '';
  $comment_num = get_comments_number($my_post_id); 
   if ($comment_num > 0) {
     $com_content.='<span class="comment"><i class="sprite-coment-border"></i> '. $comment_num .'</span>';
   }
  return $com_content;
}

add_shortcode('carousel-platforms', 'carousel_platforms');
function carousel_platforms( $atts ){
    $atts = shortcode_atts( array(
      'url' => '',
      'title' => '',
    ), $atts, 'carousel-platforms' );
    extract( $atts );

  $api = file_get_contents($url);
  $platform = json_decode($api, true);

  if (is_array($platform)){
    shuffle($platform);
    $content ='';
    if ($title) { $content .= '<h1 align="center">'.$title.'</h1>'; }
    $content .= '<div class="start-steps--platforms-list margin-bottom clearfix"><div class="owl-carousel">';
    foreach ($platform as $key => $value) {
      $size = getimagesize($value['logo']);
          if($size[0]>150 || $size[1]>100) { $nw=150; $nh=floor(150/($size[0]/$size[1]));}
          else {$nw=$size[0]; $nh=$size[1];}        
      $content .=  '<div class="item" id="'.$value['slug'].'"><a href="'.$value['href'].'"><img src="'.$value['logo'].'" width="'.$nw.'" height="'.$nh.'"  alt="'.$valu['name'].'" title="'.$value['name'].'" /></a><a class="pl-title" href="'.$value['href'].'">'.$value['name'].'</a><div class="phone"></div></div>';
    }
    $content .=  '</div></div>';    
  } else {
    $content .= '<div class="blue" align="center">Oops!! Path (url) is incorrect!! Try another!</div>';
  }
  return $content;
}

add_shortcode('dogovory-to-screen', 'dogovory_to_screen');
function dogovory_to_screen(){
   $content ='';
   $content .= '<div class="start-steps--platforms-list margin-bottom clearfix"><div class="owl-carousel">';
   $args = array(
        'post_type' => 'dogovory',
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'ASC',          
        'posts_per_page' => -1        
      );
      $wp_query = new WP_Query($args);
      if ( $wp_query->have_posts() ) {
        while ( $wp_query->have_posts() ) {
          $wp_query->the_post();
          $dogovoryContent = str_replace("\r", "<br />", get_the_content(''));
          $content .=  '<div class="item" id="dogovory_'.get_the_ID().'">'.$dogovoryContent.'</div>';
         }
      } 
      wp_reset_postdata(); 
    $content .=  '</div></div>';
    return $content;
}

add_shortcode('reform-faces', 'reform_faces');
function reform_faces(){
 $content ='';
 $content.='<div class="row faces"><ul class="nav-justified">'; 
 $args = array(
      'post_type' => 'faces',
      'post_status' => 'publish',
      'orderby' => 'date',
      'order' => 'ASC',          
      'posts_per_page' => -1        
    );
    $wp_query = new WP_Query($args);
    if ( $wp_query->have_posts() ) {
      while ( $wp_query->have_posts() ) {
        $wp_query->the_post();
        $img_url = wp_get_attachment_image_src(get_post_field('photo', $post->ID), 'medium'); 
        $content.='<li><img src="'.$img_url[0].'" alt="'.get_the_title().'" title="'.get_the_title().'"><span class="size21 blue">'.get_post_field('name', $post->ID).'</span>'.get_post_field('posada', $post->ID).'</li>';
       }
    } 
    wp_reset_postdata(); 
  return $content;
}

function disqus_embed($disqus_shortname) {
    global $post;
    wp_enqueue_script('disqus_embed', 'http://'.$disqus_shortname.'.disqus.com/embed.js');
    echo '<div id="disqus_thread"></div>
    <script type="text/javascript">
        var disqus_shortname = "'.$disqus_shortname.'";
        var disqus_title = "'.$post->post_title.'";
        var disqus_url = "'.get_permalink($post->ID).'";
        var disqus_identifier = "'.$disqus_shortname.'-'.$post->ID.'";
    </script>';
}
