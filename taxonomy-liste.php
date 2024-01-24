<?php
get_header();
  ?>
<?php 

$paged = 1;
if ( get_query_var('paged') ) $paged = get_query_var('paged');
if ( get_query_var('page') ) $paged = get_query_var('page');

?>
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
  <h1 class="oitem Top">Liste des SÉRIES vostfr et vf commençant par la lettre '<?php  $tr=get_queried_object()->name;
      echo $tr;
     
        ?>'
  
  </h1>
  <div class="row">
<div class="col-lg-12 col-md-12 col-sm-12">
 
      <h4 style="padding-left: 5px;"> 
        
      </h4>
   
     <div class="table-responsive">
  <table class="table soto ">
    <thead>

      <tr class="fu ">
        <th>RESULTAS</th>
        <th>ANNEE</th>
           <th>GENRE</th>
            <th>Acteurs</th>
      </tr>
    </thead>
    <tbody>
             
 <?php if ( have_posts() ) {


    while ( have_posts() ) : the_post();
        //Output my posts
        
     $term_list_genre =  get_the_terms( $post->ID , 'genres' );
        $term_list_acteur =  get_the_terms( $post->ID , 'acteurs' );
?>
   <tr>
        <td>
            <div class="w3l-movie-gride-agile w3l-movie-gride-agile1">
 <a href="<?php echo the_permalink(get_the_ID()); ?>" title="<?php echo the_title(); ?>" >
                                   
                           <?php
    $image_title=get_the_title();
   if ( has_post_thumbnail() ) { 
  
    the_post_thumbnail( 'image-liste' ,['alt'=>"$image_title",'class'=>""],$crop = true ); 
      
       }
        ?>
                       
                           

                            <?php ?>
                           <h3><div class="fenoy mt-1"><?php  echo the_title();?> </div></h3>
                               </a>
                        </div>
                     
        </td>
        <td class="fd"> <?php $date=get_field('date_de_sortie',get_the_ID()) ;
         if(!empty($date)){ echo $date ;}?>
           
         </td>
              <td class="finfo">  <?php if(!empty($term_list_genre)){?> 
              	<?php foreach($term_list_genre as $genre) {?>
                	<a href=" <?php echo 'https://opseries.com/Genres/'.$genre->slug.'/';?>">
                		<?php echo $genre->name;?>
                			
                		/</a>
<?php } }?> 
</td>

<td class="fd"> <?php if($term_list_acteur){
?>
<?php 
	foreach($term_list_acteur as $acteur) {?>

	<?php 
echo $acteur->name.', ';}}

else{
$acteurs=get_field('acteurs',get_the_ID() );
if($acteurs){
?>

<?php echo ucwords($acteurs);?>

<?php }
}?></td>
      </tr>      

                 <?php 
endwhile;}wp_reset_query();?>
    </tbody>

  </table>
</div>

   

   <?php

   $total = $wp_query->max_num_pages;

   $current_page = get_query_var('paged');

if ( $total > 1 )  {
     
     if ( !$current_page = get_query_var('paged') )
          $current_page = 1;
   
     if( get_option('permalink_structure') ) {
       $format = 'page/%#%';
     } else {
       $format = 'page/%#%/';
     }
   }
?>
<nav aria-label="...">
   <ul class="pagination  pagination-sm justify-content-center">
<?php // 2- Appel de la fonction paginate_links
          global $wp_query;

          $big = 999999999; 

          echo paginate_links( array( 
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
</div>
     <?php get_footer(); ?>