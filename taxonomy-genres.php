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

<h1 class="oitem Top">SÉRIES <?php  $tr=get_queried_object()->name;
      echo $tr;
     
        ?>
  
  </h1>


    <div class="row top">
<?php if ( have_posts() ) {


    while ( have_posts() ) : the_post();
        //Output my posts
        if($post->post_type=="serie"):
?>
        <div class="col-lg-2 col-md-4 col-sm-8 col-xs-6 mb-2 ">
                                            <div class="item gery">
<div class="w3l-movie-gride-agile w3l-movie-gride-agile1">
            
<a  href="<?php the_permalink(); ?>" title="<?php echo the_title(); ?>" >

         <?php
   if ( has_post_thumbnail() ) { 
    $image_title=get_the_title();
    the_post_thumbnail( 'episode-size' ,['alt'=>"$image_title",'class'=>"img-responsive"],$crop = true ); 
      
       }
        ?>
        <div class="w3l-action-icon"><i class="fa fa-play-circle" aria-hidden="true"></i></div>
                            </a>
                                     <?php $terms = get_the_terms ( $post->ID, 'saison' );
$number = count($terms);

$date_sortie= get_field('date_de_sortie',get_the_ID() );?>
<h3 class="fet p-1" style="min-height: 45px;"><a href="<?php the_permalink(); ?>" title="<?php echo the_title(); ?>"><?php echo ucwords(the_title());  
?></a></h3> 
                                                       <div class="ribben"><p><?php echo $number.' Saison' ;?> </p></div>
  </div>
                    </div>
                       
      
  

  </div> 
      <?php   endif;  endwhile;



      ?>



      <?php
}wp_reset_query();?>

   

  
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
<div class="col-lg-3 col-md-12 col-sm-12 top">

  <h3>Genre Séries Streaming</h3>
       <?php
$terms = get_terms( array(
    'taxonomy' => 'genres',
    'hide_empty' => false,
) );
 ?>


<ul class="list-group">
   <?php foreach ($terms as $term1) {
  $genre_url=get_term_link( $term1->term_id);
if($term1->term_id != get_queried_object()->term_id){

  ?>

  <li class="list-group-item menu-item-object-genres ">  <a href="<?php  echo $genre_url ;?>" title="<?php echo $term1->name;?>"><?php echo $term1->name;?></a></li>
<?php } 
else { ?>
  <li class="list-group-item menu-item-object-genres ">  <a href="<?php  echo $genre_url ;?>" title="<?php echo $term1->name;?>"><?php echo $term1->name;?></a></li>
  <?php } }?>
</ul>

</div></div>
</div>
<?php get_footer();?>