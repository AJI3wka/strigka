<?php
function resp($text, $is_error = 0){
    $response = array('error' => $is_error, 'text' => $text);
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}
if( wp_doing_ajax() ){
    add_action('wp_ajax_send_mess', 'send_mess');
    add_action('wp_ajax_nopriv_send_mess', 'send_mess');

}


function send_mess() {
    $subject = 'Письмо с сайта!';
    if(isset($_POST['form_hid'])){ $subject =  $_POST['form_hid']; }

    $mail_to = 'strizhka-franch@yandex.ru';
    //$mail_to = 'felix.kirill@gmail.com';
    $msg = 'Имя: '.$_POST['name']."\n";
    $msg .= 'Тел: '.$_POST['phone']."\n";
    $msg .= 'id: '.$_POST['id']."\n";
    $msg .= 'email: '.$_POST['email']."\n";
    $is_send = mail($mail_to, $subject, $msg);
    if($is_send){
        resp('1');
        die();
    }else{
        resp('0',1);
            wp_die();
    }
}


add_action( 'after_setup_theme', 'blankslate_setup' );
function blankslate_setup()
{
load_theme_textdomain( 'blankslate', get_template_directory() . '/languages' );
add_theme_support( 'title-tag' );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-thumbnails' );
global $content_width;
if ( ! isset( $content_width ) ) $content_width = 640;
register_nav_menus(
array( 'main-menu' => __( 'Main Menu', 'blankslate' ) )
);
}
add_action( 'wp_enqueue_scripts', 'blankslate_load_scripts' );
function blankslate_load_scripts()
{
wp_enqueue_script( 'jquery' );
}
add_action( 'comment_form_before', 'blankslate_enqueue_comment_reply_script' );
function blankslate_enqueue_comment_reply_script()
{
if ( get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }
}
add_filter( 'the_title', 'blankslate_title' );
function blankslate_title( $title ) {
if ( $title == '' ) {
return '&rarr;';
} else {
return $title;
}
}
add_filter( 'wp_title', 'blankslate_filter_wp_title' );
function blankslate_filter_wp_title( $title )
{
return $title . esc_attr( get_bloginfo( 'name' ) );
}
add_action( 'widgets_init', 'blankslate_widgets_init' );
function blankslate_widgets_init()
{
register_sidebar( array (
'name' => __( 'Sidebar Widget Area', 'blankslate' ),
'id' => 'primary-widget-area',
'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
'after_widget' => "</li>",
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>',
) );
}
function blankslate_custom_pings( $comment )
{
$GLOBALS['comment'] = $comment;
?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
<?php 
}
add_filter( 'get_comments_number', 'blankslate_comments_number' );
function blankslate_comments_number( $count )
{
if ( !is_admin() ) {
global $id;
$comments_by_type = &separate_comments( get_comments( 'status=approve&post_id=' . $id ) );
return count( $comments_by_type['comment'] );
} else {
return $count;
}
}


add_action( 'template_redirect', 'Sheensay_HTTP_Headers_Last_Modified' );

function Sheensay_HTTP_Headers_Last_Modified() {

    if ( ( defined( 'DOING_AJAX' ) && DOING_AJAX ) || ( defined( 'XMLRPC_REQUEST' ) && XMLRPC_REQUEST ) || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) || ( is_admin() ) ) {
        return;
    }

    $last_modified = '';


    // Для страниц и записей
    if ( is_singular() ) {
        global $post;

        if ( !isset( $post -> post_modified_gmt ) ) {
            return;
        }

        $post_time = strtotime( $post -> post_modified_gmt );
        $modified_time = $post_time;

        // Если есть комментарий, обновляем дату
        if ( ( int ) $post -> comment_count > 0 ) {
            $comments = get_comments( array(
                'post_id' => $post -> ID,
                'number' => '1',
                'status' => 'approve',
                'orderby' => 'comment_date_gmt',
            ) );
            if ( !empty( $comments ) && isset( $comments[0] ) ) {
                $comment_time = strtotime( $comments[0] -> comment_date_gmt );
                if ( $comment_time > $post_time ) {
                    $modified_time = $comment_time;
                }
            }
        }

        $last_modified = str_replace( '+0000', 'GMT', gmdate( 'r', $modified_time ) );
    }


    // Cтраницы архивов: рубрики, метки, даты и тому подобное
    if ( is_archive() || is_home() ) {
        global $posts;

        if ( empty( $posts ) ) {
            return;
        }

        $post = $posts[0];

        if ( !isset( $post -> post_modified_gmt ) ) {
            return;
        }

        $post_time = strtotime( $post -> post_modified_gmt );
        $modified_time = $post_time;

        $last_modified = str_replace( '+0000', 'GMT', gmdate( 'r', $modified_time ) );
    }


    // Если заголовки уже отправлены - ничего не делаем
    if ( headers_sent() ) {
        return;
    }

    if ( !empty( $last_modified ) ) {
        header( 'Last-Modified: ' . $last_modified );

        if ( !is_user_logged_in() ) {
            if ( isset( $_SERVER['HTTP_IF_MODIFIED_SINCE'] ) && strtotime( $_SERVER['HTTP_IF_MODIFIED_SINCE'] ) >= $modified_time ) {
                $protocol = (isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.1');
                header( $protocol . ' 304 Not Modified' );
            }
        }
    }
}



// Отключаем сам REST API
if(!current_user_can('administrator')){


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
remove_action( 'rest_api_init', 'wp_oembed_register_route');
remove_filter( 'rest_pre_serve_request', '_oembed_rest_pre_serve_request', 10, 4 );

remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );

remove_action('wp_head', 'wp_shortlink_wp_head');

add_filter('xmlrpc_enabled', '__return_false');
}
remove_action('wp_head', 'wp_shortlink_wp_head');
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head');




add_action('admin_head', 'hidden_term_description');

function hidden_term_description() {
print '<style>
.term-description-wrap { display:none; }
</style>';
} 

function replaceTempl($text, $ip, $rp = ''){
    $text = str_replace('Москва', $ip, $text);
    if ($rp == '' || !$rp) {
        $rp = $ip;
    }
    $text = str_replace('Москве', $rp, $text);
    return $text;
}

if(isset($_GET['add_step']) && isset($_GET['tid'])){
	$log = '';
	$add_step = intval($_GET['add_step']);
	$tid = intval($_GET['tid']);

	$tax = get_term($tid, "category");
	$h1 = get_field('h1', $tax);

	$log .= '<h4 style="text-align:center;">'.$h1.'</h4>';

	$log .= '<h1 style="text-align:center;">Шаг '.$add_step.'</h1>';

	$offset = (($add_step * 100) - 100);
	$end_query = ' LIMIT '. 100 .' OFFSET '. $offset;

	$log .= '<h5>'.$end_query.'</h5><br/>';
	global $wp_db;
    $datas = $wpdb->get_results('SELECT * FROM `cytes_all` ORDER BY `id` ASC'.$end_query);
   
    $i = 1;
    foreach ($datas as $city) {
    	$log .= $i.'-->'.$city->ip.'---'.$city->id.'<br/>';
    	$post_title =  replaceTempl($h1, $city->ip, $city->rp);
        $post_data = array(
            'post_title'    => $post_title,
            'post_status'   => 'publish',
            'post_category' => array( $tid )
        );

        // Вставляем запись в базу данных
        $post_id = wp_insert_post( $post_data );
        update_field('field_5a7e9f2544a57', $city->ip, $post_id);
        update_field('field_5a7e9f3244a58', $city->rp, $post_id);
    	$log .= $post_title.'<br/>';
    	$i++;
    }
    wp_die($log, 'Шаг '.$add_step);
}

function get_parent_cat($post){
    if($post->post_type == 'post'){
        $cat = get_the_category($post)[0];
        if($cat->term_id){
            return $cat->term_id;
        }
    }
    return false;
};

function filter_wpseo_title( $wpseo_replace_vars ) {
    global $post;
    $cat = get_parent_cat($post);
    if($cat){
        $title = get_field('title', 'category_'.$cat);
        $ip = get_field('именительный_падеж', $post->ID);
        $rp = get_field('предложный_падеж', $post->ID);
        return replaceTempl($title, $ip, $rp);
    }else{
        return $wpseo_replace_vars;
    }
};

// add the filter
add_filter( 'wpseo_title', 'filter_wpseo_title', 10, 1 );


function filter_wpseo_metadesc( $wpseo_replace_vars ) {
    global $post;
    $cat = get_parent_cat($post);
    if($cat){
        $title = get_field('description', 'category_'.$cat);
        $ip = get_field('именительный_падеж', $post->ID);
        $rp = get_field('предложный_падеж', $post->ID);
        return replaceTempl($title, $ip, $rp);
    }else{
        return $wpseo_replace_vars;
    }
};

// add the filter
add_filter( 'wpseo_metadesc', 'filter_wpseo_metadesc', 10, 1 );


