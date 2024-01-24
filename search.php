<?php
/**
 * The template for displaying Search Results pages.
 
 */
 
get_header(); ?>
<div class="container">
<div class="row">
 
<?php $listes = get_terms( array(
    'taxonomy' => 'liste',
    'hide_empty' => false,
) );
 ?> 
<div class="col-12">
  
 <div class="d-flex flex-wrap mb-1 mt-4">
  <?php foreach ($listes as $liste) {?>
    <a class="chiffre" href="<?php echo get_term_link($liste->name,'liste');?>"> <span><?php echo $liste->name;?> </span></a>
 <?php }?>
    
</div>
    
</div>  

</div>  
</div>
 <div class="container">
        <section id="primary" class="content-area">
            <div id="content" class="site-content" role="main">

            <?php if ( have_posts() ) : ?>
 
                <header class="page-header">
                       <h2 class="page-title"><?php printf( __( 'Résultats trouvés pour: %s', 'shape' ), '<span>' . get_search_query() . '</span>' ); ?></h2>

                </header><!-- .page-header -->
 
                <?php /*shape_content_nav( 'nav-above' );*/ ?>
 
                <?php /* Start the Loop */?>
                <div class="soto">
   
 <div class="row">
                <?php while ( have_posts() ) : the_post(); ?>
 
                    <?php get_template_part( 'content', 'search' ); ?>
 
                <?php endwhile; ?>
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
</div>



                <?php /* shape_content_nav( 'nav-below' );*/ ?>
 
            <?php else : ?>
 <h3 class="page-title"><?php printf( __( "Il n'y a pas de résultats pour: %s .
  Vérifiez l'orthographe de votre recherche! , Vous pouvez aussi rechercher dans les listes par Ordre Alphabétique " , 'shape' ), '<span>' . get_search_query() . '</span>' ); ?></h3>
               
 
            <?php endif; ?>
 
            </div><!-- #content .site-content -->
        </section><!-- #primary .content-area -->
 </div>

<?php get_footer(); ?>