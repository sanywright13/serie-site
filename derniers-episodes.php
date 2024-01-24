<?php /* Template Name: derniers episodes */
get_header(); 

     $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;


// the query
$post_list =  new WP_Query(array('post_type'=>'post', 'post_status'=>'publish', 'posts_per_page'=>18  ,'paged' => $paged,  'post_status' => array('publish')));?>

<div class="container">
  <div class="row">
<div class="col-lg-9 col-md-12 col-sm-12">

      <div class="soto mt-4">
           <h1 class="oitem Top"><i class="fas fa-tv pr-2"></i>  <span class=""> Derniers épisodes Séries-TV Vostfr ajoutés en Streaming

</span>

            </h1>
            
  <?php if ( $post_list->have_posts() ) : ?>
  <div class="row top">
  
    <?php 

      while ( $post_list->have_posts() ) : $post_list->the_post(); ?>
  
   <?php 

$serie=get_the_category();
$langue = get_the_terms(get_the_ID() ,'langue');


if(empty($langue[0]->name) or $langue[0]->name=="VOSTFR"):

$serie_id=get_page_by_title(wp_specialchars_decode($serie[0]->name), $output = OBJECT, $post_type = 'serie');
$pageID = $serie_id->ID; 

?>
      <div class="col-lg-2 col-md-4 col-sm-8 col-xs-6 mb-2  ">
                                            <div class="item">
<div class="w3l-movie-gride-agile w3l-movie-gride-agile1">
            
<a href="<?php esc_url(the_permalink(get_the_ID())); ?>" title="<?php echo get_the_title();  ?>" class="fer hvr-shutter-out-horizontal">
  <?php
    $image_title=get_the_title(get_the_ID());
   if (has_post_thumbnail() ) { 
  
    the_post_thumbnail( 'episode-size' ,['alt'=>"$image_title " , 'class'=>" img-responsive "],$crop = true ); 
       }
else {
        ?>
          <img src="<?php echo esc_url(get_the_post_thumbnail_url($pageID,'episode-size')); ?>" class="img-responsive" alt="<?php echo $image_title ;?>">

      <?php }?>
        <div class="w3l-action-icon"><i class="fa fa-play-circle" aria-hidden="true"></i></div>
                       
                            <div class="mid-2 agileits_w3layouts_mid_1_home" style="min-height: 40px;">
                              
                                     <h3 class="fet">
                                        <?php $title= substr(get_the_title(), 0, strpos(get_the_title(), "Episode"));?>
                                        <?php echo ucwords($title); ?></h3> 

                           </div>
                         </a>
      <?php  $thispost = get_post(get_the_ID(get_the_ID()));
$menu_order = $thispost->menu_order;?>
                            <div class="ribben"><p><?php echo  'Episode '.$menu_order;?> </p></div>
  </div>
                    </div>
                       
      
  

  </div>  
  <?php endif; endwhile;?>
  </div>


<nav class="mt-3" aria-label="...">
   <ul class="pagination  pagination-sm justify-content-center">
<?php // 2- Appel de la fonction paginate_links
          

          $big = 999999999; 

          echo paginate_links( array( // Plus d'info sur les arguments possibles  : https://codex.wordpress.org/Function_Reference/paginate_links
            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format' => '?paged=%#%',
            'current' => max( 1, get_query_var('paged') ),
            'total' => $post_list->max_num_pages,
               'type'     => 'list'
          ) );
          
        ?>
</ul>
</nav>
<?php  
wp_reset_query(); endif;?>
</div>
 
 </div>
<div class="col-lg-3 col-md-12 col-sm-12">
<?php if ( is_active_sidebar( 'header-sidebar' ) ) : ?>
 
    <?php dynamic_sidebar( 'sidebar-1' ); ?>
 
<?php endif; ?>
 </div>
</div>
</div>
<?php 
get_footer(); 
?>