<?php
/*
Template Name: serie
*/
get_header(); 
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
?>       
<div class="container">
<div class="row">
<div class="col-lg-9 col-md-12 col-sm-12">      
<div class="soto mt-4">
<h1 class="oitem Top">SÉRIES EN STREAMING FULL HD VOSTFR Et VF</h1>
<div class="row top">
 <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="col-lg-2 col-md-4 col-sm-8 col-xs-6 mb-2 ">
 <div class="item">
<div class="w3l-movie-gride-agile w3l-movie-gride-agile1">           
<a  href="<?php the_permalink(); ?>" title="<?php echo the_title(); ?>">
<?php
if ( has_post_thumbnail() ) { 
$image_title=get_the_title();
the_post_thumbnail( 'episode-size' ,['alt'=>"$image_title",'class'=>"img-responsive"],$crop = true ); 
}
?>
<div class="w3l-action-icon"><i class="fa fa-play-circle" aria-hidden="true"></i></div>
                   <div class="agileits_w3layouts_mid_1_home" >

<h3><?php echo ucwords($image_title); ?></h3> 
<?php $date= get_field('date_de_sortie',get_the_ID() );
$date = explode("-",$date);
?>
<p><?php echo $date[0];  ?> </p>  
</div>                                
</a>      
  </div>
                    </div>
                       
      
  

  </div> 
 
 <?php  endwhile; ?>

 </div>

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
<?php wp_reset_query();endif; ?>
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