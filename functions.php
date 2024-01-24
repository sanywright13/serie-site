<?php

// Add scripts and stylesheets
function startwordpress_scripts() {
  wp_enqueue_style('fontsawesome', 'https://use.fontawesome.com/releases/v5.5.0/css/all.css');
  if(is_singular('post')){
  wp_enqueue_style( 'comments', get_template_directory_uri() . '/css/comments.css' );
  if (!is_admin()) {
    wp_deregister_script('jquery');
    wp_register_script('jquery', ("https://code.jquery.com/jquery-3.4.1.min.js"), false);
    wp_enqueue_script('jquery');
}
}
     wp_enqueue_style('bootstrap4', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css');
   wp_enqueue_style( 'style', get_template_directory_uri() . '/style.css' );

if(is_singular('films')){
 if (!is_admin()) {
    wp_deregister_script('jquery');
    wp_register_script('jquery', ("https://code.jquery.com/jquery-3.4.1.min.js"), false);
    wp_enqueue_script('jquery');
}
}
         if(is_front_page()){
            if (!is_admin()) {
    wp_deregister_script('jquery');
    wp_register_script('jquery', ("https://code.jquery.com/jquery-3.4.1.min.js"), false);
    wp_enqueue_script('jquery');
}
     }
      wp_enqueue_script( 'boot1','https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js', array( 'jquery' ),'',true );
}

add_action( 'wp_enqueue_scripts', 'startwordpress_scripts' );

add_filter( 'template_redirect', function()
{
    if (    is_single() 
         && false === strpos( get_queried_object()->post_content, '<!--nextpage-->' )
         && get_query_var('page') 
    ) {
        wp_redirect( get_permalink( get_queried_object_id() ) );
        die;
    }


});

function my_aioseo_paged_title($title) {
global $cpage;
if ( $cpage >= 1 && is_post_type_archive('serie')) {
$title = 'Voir Vos derniers Series VOSTFR et VF en streaming ajoutees – Comment page ' . $cpage;
return $title;
} else {
return $title;
}
}
add_filter( 'aioseop_archive_title', 'my_aioseo_paged_title' );
add_action('template_redirect', 'post_redirect_by_custom_filters');
function post_redirect_by_custom_filters() {
    global $post;
  
    if (is_category()) {
      $term = get_queried_object();
        $new_url = "https://opseries.com/serie/{$term->slug}/";  
        wp_redirect($new_url, 301);
        exit;
    }
}

remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

remove_action( 'wp_head', 'wp_generator' ) ;
function remove_cssjs_ver( $src ) {
if( strpos( $src, '?ver=' ) )
 $src = remove_query_arg( 'ver', $src );
return $src;
}
add_filter( 'style_loader_src', 'remove_cssjs_ver', 10, 2 );
add_filter( 'script_loader_src', 'remove_cssjs_ver', 10, 2 );

remove_action( 'wp_head', 'rsd_link' ) ;
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

function disable_embed(){
wp_dequeue_script( 'wp-embed' );
}
add_action( 'wp_footer', 'disable_embed' );

add_filter('xmlrpc_enabled', '__return_false');
remove_action( 'wp_head', 'wlwmanifest_link' ) ;



function disable_pingback( &$links ) {
 foreach ( $links as $l => $link )
 if ( 0 === strpos( $link, get_option( 'home' ) ) )
 unset($links[$l]);
}
add_action( 'pre_ping', 'disable_pingback' );
define('WP_POST_REVISIONS', 2);

add_action( 'init', 'stop_heartbeat', 1 );
function stop_heartbeat() {
wp_deregister_script('heartbeat');
}

function wpdocs_dequeue_dashicon() {
        if (current_user_can( 'update_core' )) {
            return;
        }
        wp_deregister_style('dashicons');
}
add_action( 'wp_enqueue_scripts', 'wpdocs_dequeue_dashicon' );

function remove_jquery_migrate( $scripts ) {
   if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
        $script = $scripts->registered['jquery'];
   if ( $script->deps ) { 
// Check whether the script has any dependencies

        $script->deps = array_diff( $script->deps, array( 'jquery-migrate' ) );
 }
 }
 }
add_action( 'wp_default_scripts', 'remove_jquery_migrate' );



add_filter( 'pre_get_posts', 'tgm_io_cpt_search' );
/**
 * This function modifies the main WordPress query to include an array of 
 * post types instead of the default 'post' post type.
 *
 * @param object $query  The original query.
 * @return object $query The amended query.
 */
function tgm_io_cpt_search( $query ) {
    
    if ( $query->is_search ) {
    $query->set( 'post_type', array( 'serie', 'films') );
    }
    
    return $query;
    
}
//Remove Gutenberg Block Library CSS from loading on the frontend
function smartwp_remove_wp_block_library_css(){
 wp_dequeue_style( 'wp-block-library' );
 wp_dequeue_style( 'wp-block-library-theme' );
}
add_action( 'wp_enqueue_scripts', 'smartwp_remove_wp_block_library_css' );



add_action( 'admin_init', 'posts_order_wpse_91866' );

function posts_order_wpse_91866() 
{
    add_post_type_support( 'post', 'page-attributes' );
}



add_action('get_link_by_slug', 'wcr_save_category_fields', 10, 2);

 function get_link_by_slug($slug, $type = 'page'){
  $post = get_page_by_path($slug, OBJECT, $type);
  return get_permalink($post->ID);
}
add_theme_support( 'post-thumbnails' ); 


//filter function to disable TinyMCE emojicons
function disable_emojicons_tinymce( $plugins ) {
  if ( is_array( $plugins ) ) {
    return array_diff( $plugins, array( 'wpemoji' ) );
  } else {
    return array();
  }
}

function disable_wp_emojicons() {

  // all actions related to emojis
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

  // filter to remove TinyMCE emojis
  add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
}
add_action( 'init', 'disable_wp_emojicons' ); // hook into init and remove actions

// Add featured image sizes220 pixels par 325

add_image_size( 'episode-size', 145,240, true );
add_image_size( 'serie',260,360, true );
add_image_size( 'serie-genre', 158,240, true );
add_image_size( 'image-liste',120,180, true );
add_image_size( 'index-size',220,330, true );
//add_image_size( 'index-size',194,293, true );
function myplugin_rewrite_tag_rule() {


 global $wp;
$slug=esc_url(add_query_arg( $wp->query_vars));
$queries = explode("/", $slug);

$postType= $queries[1];
 $pagin=(int)$queries[5];

if($postType=="films"){
 if($pagin > 1 && !empty($pagin)){
 add_rewrite_rule('films/Genres/([^/]*)/page/?([0-9]{1,})/?$', 'index.php?post_type=films&genres=$matches[1]&paged=$matches[2]', 'top');
}
else
 add_rewrite_rule( '^films/Genres/([^/]*)/?', 'index.php?post_type=films&genres=$matches[1]','top' );
 }
 
}

add_action('init', 'myplugin_rewrite_tag_rule', 10, 0);
  flush_rewrite_rules();



add_action( 'init', 'create_liste_hierarchical_taxonomy', 0 );
 
function create_liste_hierarchical_taxonomy() {
 
// Labels part for the GUI
 
  $labels = array(
    'name' => _x( 'liste', 'taxonomy general name' ),
    'singular_name' => _x( 'liste', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search liste' ),
    'popular_items' => __( 'Popular liste' ),
    'all_items' => __( 'All liste' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit liste' ), 
    'update_item' => __( 'Update liste' ),
    'add_new_item' => __( 'Add New liste' ),
    'new_item_name' => __( 'New liste ' ),
    'separate_items_with_commas' => __( 'Separate liste with commas' ),
    'add_or_remove_items' => __( 'Add or remove liste' ),
    'choose_from_most_used' => __( 'Choose from the most used liste' ),
    'menu_name' => __( 'liste' ),
  ); 
 
// Now register the non-hierarchical taxonomy like tag
 
  register_taxonomy('liste','post',array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => 'liste',
    'has_archive' => false,
    'rewrite' => array( 'slug' => 'liste' ),
  ));
  flush_rewrite_rules();

}

?>
<?php 

/*create Serie Custum Post */


?>
<?php
// hook into the init action and call create_book_taxonomies when it fires
//create a custom taxonomy name it "type" for your posts

function movies_custom_post_type() {
    $labels = array(
        'name'                => __( 'films' ),
        'singular_name'       => __( 'films'),
        'menu_name'           => __( 'films'),
        'parent_item_colon'   => __( 'Parent films'),
        'all_items'           => __( 'All films'),
        'view_item'           => __( 'View films'),
        'add_new_item'        => __( 'Add New films'),
        'add_new'             => __( 'Add New'),
        'edit_item'           => __( 'Edit films'),
        'update_item'         => __( 'Update films'),
        'search_items'        => __( 'Search films'),
        'not_found'           => __( 'Not Found'),
        'not_found_in_trash'  => __( 'Not found in Trash')
    );
    $args = array(
        'label'               => __( 'films'),
        'description'         => __( 'films'),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields', 'page-attributes', 'comments'),
        'public'              => true,
        'hierarchical'        => false,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'has_archive'         => true,
        'can_export'          => true,
        'exclude_from_search' => false,
            'yarpp_support'       => true,
        'taxonomies'          => array('Genres'),
        'publicly_queryable'  => true,
        'capability_type'     => 'page'
);
    register_post_type( 'films', $args );
}
add_action( 'init', 'movies_custom_post_type', 0 );
flush_rewrite_rules();


add_action( 'init', 'Serie_custom_taxonomy', 0 );
function Serie_custom_taxonomy() {
 
  $labels = array(
    'name' => _x( 'Genres', 'taxonomy general name' ),
    'singular_name' => _x( 'Genre', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Genres' ),
    'all_items' => __( 'All Genres' ),
    'parent_item' => __( 'Parent Genre' ),
    'parent_item_colon' => __( 'Parent Genre:' ),
    'edit_item' => __( 'Edit Genre' ), 
    'update_item' => __( 'Update Genre' ),
    'add_new_item' => __( 'Add New Genre' ),
    'new_item_name' => __( 'New Genre Name' ),
    'menu_name' => __( 'Genres' ),
  );    
 
  register_taxonomy('genres',array('serie','films'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
        'show_in_rest' => true,

    'query_var' => true,
    'rewrite' => array( 'slug' => 'Genres' ),

  ));

  $labels = array(
    'name' => _x( 'langue', 'taxonomy general name' ),
    'singular_name' => _x( 'langue', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search type' ),
    'all_items' => __( 'All langue' ),
    'parent_item' => __( 'Parent langue' ),
    'parent_item_colon' => __( 'Parent langue:' ),
    'edit_item' => __( 'Edit langue' ), 
    'update_item' => __( 'Update langue' ),
    'add_new_item' => __( 'Add New langue' ),
    'new_item_name' => __( 'New langue Name' ),
    'menu_name' => __( 'langue' ),
  );    
 
  register_taxonomy('langue',array('post','films'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
        'show_in_rest' => true,

    'query_var' => true,
    'rewrite' => array( 'slug' => 'langue' ),

  ));

  $labels = array(
    'name' => _x( 'realisateur', 'taxonomy general name' ),
    'singular_name' => _x( 'realisateur', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search realisateur' ),
    'all_items' => __( 'All realisateur' ),
    'parent_item' => __( 'Parent realisateur' ),
    'parent_item_colon' => __( 'Parent realisateur:' ),
    'edit_item' => __( 'Edit realisateur' ), 
    'update_item' => __( 'Update realisateur' ),
    'add_new_item' => __( 'Add New realisateur' ),
    'new_item_name' => __( 'New realisateur Name' ),
    'menu_name' => __( 'realisateur' ),
  );    
 
  register_taxonomy('realisateur',array('serie','films'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
        'show_in_rest' => true,

    'query_var' => true,
    'rewrite' => array( 'slug' => 'realisateur' ),
  ));
 
    $labels = array(
    'name' => _x( 'Saison', 'taxonomy general name' ),
    'singular_name' => _x( 'Saison', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Saison' ),
    'all_items' => __( 'All saison' ),
    'parent_item' => __( 'Parent Saison' ),
    'parent_item_colon' => __( 'Parent Saison:' ),
    'edit_item' => __( 'Edit Saison' ), 
    'update_item' => __( 'Update Saison' ),
    'add_new_item' => __( 'Add New Saison' ),
    'new_item_name' => __( 'New saison Name' ),
    'menu_name' => __( 'saison' ),
  );    
 
  register_taxonomy('saison',array('post','serie'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
        'show_in_rest' => true,

    'query_var' => true,
    'rewrite' => array( 'slug' => 'saison' ),
  ));
  $labels = array(
    'name' => _x( 'acteurs', 'taxonomy general name' ),
    'singular_name' => _x( 'acteurs', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search acteurs' ),
    'all_items' => __( 'All acteurs' ),
    'parent_item' => __( 'Parent acteurs' ),
    'parent_item_colon' => __( 'Parent acteurs:' ),
    'edit_item' => __( 'Edit acteurs' ), 
    'update_item' => __( 'Update acteurs' ),
    'add_new_item' => __( 'Add New acteurs' ),
    'new_item_name' => __( 'New acteurs Name' ),
    'menu_name' => __( 'acteurs' ),
  );    
 
  register_taxonomy('acteurs',array('serie','films'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
        'show_in_rest' => true,

    'query_var' => true,
    'rewrite' => array( 'slug' => 'acteurs' ),
  ));
  $labels = array(
    'name' => _x( 'liste', 'taxonomy general name' ),
    'singular_name' => _x( 'liste', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search liste' ),
    'all_items' => __( 'All liste' ),
    'parent_item' => __( 'Parent liste' ),
    'parent_item_colon' => __( 'Parent liste:' ),
    'edit_item' => __( 'Edit liste' ), 
    'update_item' => __( 'Update liste' ),
    'add_new_item' => __( 'Add New liste' ),
    'new_item_name' => __( 'New liste Name' ),
    'menu_name' => __( 'liste' ),
  );    
 
  register_taxonomy('liste',array('serie'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
        'show_in_rest' => true,

    'rewrite' => array( 'slug' => 'liste' ),
  ));
}
 flush_rewrite_rules();


function Serie_custom_post_type() {
    $labels = array(
        'name'                => __( 'Serie' ),
        'singular_name'       => __( 'Serie'),
        'menu_name'           => __( 'Serie'),
        'parent_item_colon'   => __( 'Parent Serie'),
        'all_items'           => __( 'All Serie'),
        'view_item'           => __( 'View Serie'),
        'add_new_item'        => __( 'Add New Serie'),
        'add_new'             => __( 'Add New'),
        'edit_item'           => __( 'Edit Serie'),
        'update_item'         => __( 'Update Serie'),
        'search_items'        => __( 'Search Serie'),
        'not_found'           => __( 'Not Found'),
        'not_found_in_trash'  => __( 'Not found in Trash')
    );
    $args = array(
        'label'               => __( 'Serie'),
        'description'         => __( 'Serie'),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields', 'page-attributes'),
        'public'              => true,
        'hierarchical'        => false,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'has_archive'         => true,
        'can_export'          => true,
        'exclude_from_search' => false,
            'yarpp_support'       => true,
        'taxonomies'          => array('Genres'),
        'publicly_queryable'  => true,
        'capability_type'     => 'page'
);
    register_post_type( 'Serie', $args );
}
add_action( 'init', 'Serie_custom_post_type', 0 );
flush_rewrite_rules();


/*query for index.php*/
function wpa89392_homepage_episode( $query ) {
    if ( $query->is_home() && $query->is_main_query() ) {
        $query->set( 'post_type', array( 'post' ) );
        $query->query_vars['posts_per_page'] = 1;
       
    }
}
add_action( 'pre_get_posts', 'wpa89392_homepage_episode' );

 flush_rewrite_rules();
 



function wpa89392_liste( $query ) {
    
    if(is_tax('liste') && $query->is_main_query()){
   $query->set( 'post_type', array( 'serie' ) );
        $query->query_vars['posts_per_page'] = 14;

    }
}
add_action( 'pre_get_posts', 'wpa89392_liste' );

 flush_rewrite_rules();






 /*query search*/
function search_filter($query) {
  if ( !is_admin() && $query->is_main_query() ) {
    if ($query->is_search) {
      $query->set('paged', ( get_query_var('paged') ) ? get_query_var('paged') : 1 );
        $query->query_vars['posts_per_page'] = 12;
    }
     
  }
}
add_action( 'pre_get_posts', 'search_filter' );

function register_my_menu() {
  register_nav_menu('header-menu',__( 'Header Menu' ));
}
add_action( 'init', 'register_my_menu' );

class IBenic_Walker extends Walker_Nav_Menu {
    
function start_lvl(&$output, $depth = 0, $args = array()) {
      $output .= "\n<ul class=\"dropdown-menu dropdown-content\">\n";
   }

   function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
       $item_html = '';
      // $item_ = str_replace( '<a', '<a style="font-size:18px;"', $item_); 
        //      $item_ = str_replace( '</a>', '</a>', $item_ );

       parent::start_el($item_html, $item, $depth, $args);

       if ( $item->is_dropdown && $depth === 0 ) {
           $item_html = str_replace( '<a', '<div class="dropbtn"><a class="dropdown-toggle" data-toggle="dropdown"', $item_html );
           $item_html = str_replace( '</a>', '<b class="caret"></b></a></div>', $item_html );
       }

       $output .= $item_html;
       //$output .= $item_;
    }

    function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output) {
        if ( $element->current )
        $element->classes[] = 'active';

        $element->is_dropdown = !empty( $children_elements[$element->ID] );

        if ( $element->is_dropdown ) {
            if ( $depth === 0 ) {
                $element->classes[] = 'dropdown';
            } elseif ( $depth === 1 ) {
                // Extra level of dropdown menu, 
                // as seen in http://twitter.github.com/bootstrap/components.html#dropdowns
                $element->classes[] = 'dropdown-submenu';
            }
        }

    parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }


}


function smallenvelop_widgets_init() {
    register_sidebars( 2,array(
        'name' => __( 'Sidebar %d', 'smallenvelop'),
        'id' => 'header-sidebar',
        'before_widget' => '<div>',
        'after_widget' => '</div>',
        'before_title' => '<h1>',
        'after_title' => '</h1>',
    ) );
}
add_action( 'widgets_init', 'smallenvelop_widgets_init' );
?>
<?php 
/*
function wpbeginner_comment_text_after($arg) {
    $arg['comment_notes_after'] = "<p class='comment-policy'>We are glad you have chosen to leave a comment. Please keep in mind that comments are moderated according to our <a href='http://www.example.com/comment-policy-page/'>comment policy</a>.</p>";
    return $arg;
}
  
add_filter('comment_form_defaults', 'wpbeginner_comment_text_after');
*/
?>
<?php   


function wpb_move_comment_field_to_bottom( $fields ) {
$comment_field = $fields['comment'];
unset( $fields['comment'] );
$fields['comment'] = $comment_field;
return $fields;
}
  
add_filter( 'comment_form_fields', 'wpb_move_comment_field_to_bottom');

function wpbeginner_remove_comment_url($arg) {
    $arg['url'] = '';
    return $arg;
}
add_filter('comment_form_default_fields', 'wpbeginner_remove_comment_url');

?>
<?php 
function comment_form_change_cookies_consent( $fields ) {
    $commenter = wp_get_current_commenter();
    $consent   = empty( $commenter['comment_author_email'] ) ? '' : ' checked="checked"';
    $fields['cookies'] = '<p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . $consent . ' />' .
                     '<label for="wp-comment-cookies-consent">Enregistrer mon nom, mon e-mail dans le navigateur pour mon prochain commentaire.</label></p>';
    return $fields;
}
add_filter( 'comment_form_default_fields', 'comment_form_change_cookies_consent' );


?>
<?php

/**
 * Customize Adjacent Post Link Order
 */
add_filter('wp_nav_menu_items', 'add_search_form', 10, 2);
function add_search_form($items, $args) {
if( $args->theme_location == 'header-menu' )
        $items .= '</ul><ul class="navbar-nav"><li><div class="wrap">
  <div class="search">
  <form class="form-inline example" method="get" id="searchform" action="'.esc_url( home_url( '/' ) ).'" role="search">
   <label for="s" class="assistive-text "></label>
    <input class="form-control field searchTerm" type="text"   name="s" value="'.esc_attr( get_search_query() ).'" id="s" placeholder="Chercher Serie ou Film" />
    <button  type="submit" class="submit" name="submit" id="searchsubmit" value="'. esc_attr_e( "","shape").'" ><i class="fa fa-search"></i></button>
</form>
</div>
</div></li>';
        return $items;
}


function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return 0;
    }
    return $count;
}
function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}



require get_template_directory() . '/inc/template-functions.php';
require get_template_directory() . '/class-theme-walker-comment.php';
require get_template_directory() . '/class-theme-svg-icons.php';
?>