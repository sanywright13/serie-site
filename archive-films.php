<?php
/*
Template Name: serie
*/
get_header('films');?>

   <?php 
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
  
 global $wp;
$slug=add_query_arg( $wp->query_vars);
$queries = explode("/", $slug);
$genre= $queries[3];



?>       
<div class="container">
  <div class="row">
      <div class="col-lg-9 col-md-12 col-sm-12">
   
    <div class="p-2">

  </div>
   
<div class="soto">
 <?php  $tr=get_queried_object()->name;
        ?>

      <h1 class="oitem Top"> <?php if($tr!="films") 
      echo 'films ' .$tr. ' en streaming';
      else{
echo 'films en streaming VOSTFR et VF';
      }?>
  
  </h1>


    <div class="row top">
 <?php 
      if (have_posts()) : while (have_posts()) : the_post(); 
      ?>
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
                            </a>
                   <div class="agileits_w3layouts_mid_1_home" style="min-height: 40px;">
                        <a  href="<?php the_permalink(); ?>" title="<?php echo the_title(); ?>">
      
                        <h6 ><?php echo ucwords($image_title); ?></h6> 
<?php $date= get_field('date_de_sortie',get_the_ID() );
$date = explode("-",$date);
?></a>

                           <p><?php echo $date[0];  ?> </p>
                                </div>               
                                  

                         
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
<div class="col-lg-3 col-md-12 col-sm-12 top">

 <h3>Genre Film streaming</h3>
       <?php
       global $post ;
$terms = get_terms( array(
    'taxonomy' => 'genres',
    'hide_empty' => false,
    'post_type' => 'films'
) );
  $exclude=['Biopic','Espionnage','Judiciaire','KIDS','Korean','Médical','Policier','REALITY']
 ?>
<ul class="list-group">
   <?php foreach ($terms as $term1) {
  $genre_url=get_term_link( $term1->term_id);
  if (!in_array($term1->name,$exclude)) {
if($term1->term_id != get_queried_object()->term_id){?>

  <li class="list-group-item">  <a  href="<?php  echo esc_url('https://streamingfrance.com/films/Genres/'.$term1->slug.'/') ;?>" title="<?php echo $term1->name;?>"><?php echo $term1->name;?></a></li>
<?php } 
else { ?>
  <li class="list-group-item">  <a href="<?php  echo esc_url('https://streamingfrance.com/films/Genres/'.$term1->slug.'/') ;?>" title="<?php echo $term1->name;?>"><?php echo $term1->name;?></a></li>
  <?php } }}?>
</ul>

</div>
</div>
</div>
<?php get_footer();?>