<?php get_header();?>
<?php 
$paged = 1;
if ( get_query_var('paged') ) $paged = get_query_var('paged');
if ( get_query_var('page') ) $paged = get_query_var('page');



?>
            
<div class="container">
  <div class="row">
      <div class="col-lg-9 col-md-12 col-sm-12">
  
   
<div class="soto mt-4">

<h1 class="oitem Top">Derniers épisodes Séries-TV <?php  $tr=get_queried_object()->name;
      echo $tr;
        ?>
  
  </h1>

 <div class="row top">
    <?php if (have_posts() ) {

     while (have_posts()) : the_post(); 

$serie=get_the_category();


$serie_id=get_page_by_title($serie[0]->name, $output = OBJECT, $post_type = 'serie');
$pageID = $serie_id->ID; 

?>

  
  
      <div class="col-lg-2 col-md-4 col-sm-8 col-xs-6 mb-2  ">
                                            <div class="item">
<div class="w3l-movie-gride-agile w3l-movie-gride-agile1">
            
<a class="fer" href="<?php esc_url(the_permalink()); ?>" title="<?php echo get_the_title();  ?>" class="hvr-shutter-out-horizontal">
  <?php
  
   if ( has_post_thumbnail() ) { 
    $image_title=get_the_title();
    the_post_thumbnail( 'episode-size' ,['alt'=>"$image_title",'class'=>""],$crop = true ); 
      
       }
    else{        ?>
         <img src="<?php echo esc_url(get_the_post_thumbnail_url($pageID,'episode-size')); ?>" class="img-responsive" alt="<?php echo $image_title ;?>">

      <?php }?>
        <div class="w3l-action-icon"><i class="fa fa-play-circle" aria-hidden="true"></i></div>
                          
                            <div class="mid-2 agileits_w3layouts_mid_1_home" style="min-height: 40px;">
                              
                                  <?php $title= substr(get_the_title(), 0, strpos(get_the_title(), "Episode"));?>
                        <h3 class="fet"><?php echo ucwords($title); ?></h3> 

                                </div>
                                 </a>
                           
      <?php  $thispost = get_post(get_the_ID());
$menu_order = $thispost->menu_order;?>

                            <div class="ribben"><p><?php echo  'Episode '.$menu_order;?> </p></div>
  </div>
                    </div>
                       
      
  

  </div>  
  <?php endwhile;?>
  <?php  }
wp_reset_query(); ?>
  </div>
<?php 
global $wp;

?>
   

   <?php
/*    echo  home_url( $wp->request ); */
   $total = $wp_query->max_num_pages;
// only bother with the rest if we have more than 1 page!
   $current_page = get_query_var('paged');

if ( $total > 1 )  {
     // get the current page
     if ( !$current_page = get_query_var('paged') )
          $current_page = 1;
     // structure of "format" depends on whether we're using pretty permalinks
     if( get_option('permalink_structure') ) {
       $format = 'page/%#%';
     } else {
       $format = 'page/%#%/';
     }
   }
   http://localhost/project/serie-2/wordpress/page/2/?s=monster&post_type=serie&submit=chercher
?>
<div class="top"></div>
<nav aria-label="...">
   <ul class="pagination  pagination-sm justify-content-center">
<?php // 2- Appel de la fonction paginate_links
          global $wp_query;

          $big = 999999999; 

          echo paginate_links( array( // Plus d'info sur les arguments possibles  : https://codex.wordpress.org/Function_Reference/paginate_links
            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format' => '?paged=%#%',
            'current' => max( 1, get_query_var('paged') ),
            'total' => $wp_query->max_num_pages,
               'type'     => 'list'
          ) );
          
        ?>
</ul>
</nav>
</div>
    </div>
<div class="col-lg-3 col-md-12 col-sm-12">
<?php if ( is_active_sidebar( 'header-sidebar' ) ) : ?>
 
    <?php dynamic_sidebar( 'sidebar-1' ); ?>
 
<?php endif; ?>
 </div>
</div>
</div>
<?php get_footer();?>