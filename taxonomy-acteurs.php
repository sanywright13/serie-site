<?php get_header();
$paged = 1;
if ( get_query_var('paged') ) $paged = get_query_var('paged');
if ( get_query_var('page') ) $paged = get_query_var('page');
?> 

<div class="container top">
    
    <div class="row">

      <div class="col-lg-8 col-md-12 col-sm-12">
           <h1 class="p-3 tabs-colorful text-white">
              <?php echo "Liste Des Séries d'acteur ".get_queried_object()->name;
             
              ?>
          </h1>
          <div class="row mt-2 soto">
           <?php if ( have_posts() ) {


    while ( have_posts() ) : the_post();
        //Output my posts
        
?>


    <div class="col-lg-3 col-md-4 col-sm-8 col-xs-6 mb-2 ">
                                            <div class="ter">
                                              <div class="item">
<div class="w3l-movie-gride-agile w3l-movie-gride-agile1">
            
<a  href="<?php the_permalink(); ?>" title="<?php echo the_title(); ?>" class="hvr-shutter-out-horizontal">

         <?php
  
   if ( has_post_thumbnail() ) { 
    $image_title=get_the_title();
    the_post_thumbnail( 'serie-genre' ,['alt'=>"$image_title",'class'=>"img-responsive"],$crop = true ); 
      
       }
        ?>
        <div class="w3l-action-icon"><i class="fa fa-play-circle" aria-hidden="true"></i></div>
                            </a>
                                     <?php 
$date_sortie= get_field('date_de_sortie',get_the_ID() );?>
<h6 class="fet p-2"><a href="<?php the_permalink(); ?>" title="<?php echo the_title(); ?>"><?php echo ucwords(the_title()); ?></a></h6>                          
    <?php  
      $terms = get_the_terms ( $post->ID, 'saison' );
$number = count($terms);
 ?>
                        
  </div>
                    </div>
                       
      
  
</div>
  </div> 
            
  <?php endwhile; }?>
 </div>
<nav aria-label class="top">
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
        <div class="col-lg-4 col-md-8 col-sm-12">
  
<?php if ( is_active_sidebar( 'header-sidebar' ) ) : ?>
 
    <?php dynamic_sidebar( 'sidebar-1' ); ?>
 
<?php endif; ?>
    </div>
    </div>
</div>
<?php get_footer();?>