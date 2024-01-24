<div class="col-lg-3 col-md-12 col-sm-12">
      
 <div class="list-group ">
<?php
if (!empty($langue[0]->name))
{
 ?>

 <div class="list-group-item tabs-color"><?php echo 'Les episodes' ;?> </div>

 <?php  } else {?>

<div class="list-group-item tabs-color"><?php echo 'Les episodes'  ;?> </div>


  <?php }
  wp_reset_query();
 ?>
<div class="narotu">

        <?php $current_post_id = $post->ID;?>

        <?php foreach($postlist as $post_episode):
              
$langue_post = get_the_terms($post_episode->ID,'langue');
          if(!empty($langue_post[0]->name) and $langue_post[0]->name=="VF") {
            $class="classvf";
          }
          else {
            $class="classvostfr";
          }
     
          $thispost = get_post($post_episode->ID);
$menu_order = $thispost->menu_order;?>
    <?php if($current_post_id ==$post_episode->ID){?>
 <a  href="<?php echo esc_url(the_permalink($current_post_id)); ?>" title="<?php echo get_the_title($current_post_id);  ?>" class="list-group-item    ferase "><i class="fas fa-play pr-2"></i><?php echo  'Episode '.$menu_order;?><span><i class="langue <?php echo  $class;?>"></i></span></a><?php }?>
    <?php if( $current_post_id != $post_episode->ID){?>
 <a  href="<?php echo esc_url(the_permalink($post_episode->ID)); ?>" title="<?php echo get_the_title($post_episode->ID);  ?>" class="list-group-item  for"><?php echo  'Episode '.$menu_order;?><span><i class="langue <?php echo  $class;?>"></i></span></a><?php }?>
 <?php endforeach;wp_reset_query();?>
</div>
</div>
<?php 
$page=get_page_by_title(wp_specialchars_decode($serie[0]->name), null, 'serie');
$pageID = $page->ID; 
$saisen = get_the_terms($pageID ,'saison');
$cate=array();
foreach($saisen as $lok){
$cate[]=$lok->name;
}
natsort($cate);
?>
<div class="list-group top" style="">

 <div class="list-group-item tabs-color ">Les  Saisons  </div>
          <?php 
           foreach($cate as $saiso){

             if(!empty($langue['0']->name))
  {
$args2 = array(
    'orderby'     => 'menu_order',
    'order'       => 'ASC',
   
     'post_type'=> 'post',
     'posts_per_page'=>1,
    'tax_query' => array(
    'relation' => 'AND',

    array(
        
          'taxonomy' => 'category',
      'field'    => 'id',
        'terms'    => $serie['0']->term_id,
    ),
    array(
        'taxonomy' => 'saison',
        'field'    => 'name',
        'terms'    =>  $saiso,
    ),
      array(
        'taxonomy' => 'langue',
        'field'    => 'id',
        'terms'    => $langue[0]->term_id,
    ),
),
);      
}
else {

$args2 = array(
    'orderby'     => 'menu_order',
    'order'       => 'ASC',
   
     'post_type'=> 'post',
     'posts_per_page'=>1,
    'tax_query' => array(
    'relation' => 'AND',

    array(
        
          'taxonomy' => 'category',
      'field'    => 'id',
        'terms'    => $serie['0']->term_id,
    ),
    array(
        'taxonomy' => 'saison',
        'field'    => 'name',
        'terms'    =>  $saiso,
    ),
),
); 

}
$query2 = new WP_Query( $args2 );
if ( $query2->have_posts() ) {
   $query2->the_post(); 


            ?>

 <?php if( !empty($saiso->term_id) != !empty($saisons['0']->term_id)){?>

                 <a href="<?php echo esc_url(the_permalink());?>" title="" class="list-group-item list-group-item-action  for"><span class=""><?php echo $saiso;?></span></a>

<?php }
if(!empty($saiso->term_id) == !empty($saisons['0']->term_id)){?>
                  <a href="<?php echo esc_url(the_permalink());?>" title="" class="list-group-item list-group-item-action  ferase"><span class=""><i class="fas fa-video pr-2 "></i><?php echo $saiso;?></span></a>
               <?php 

}
             }wp_reset_query();
             }?>
        
 
</div>
<?php   ?>

<br>

  <?php

$postargs = array(
  'numberposts' => 8,
  'offset' => 0,
  'category' => 0,
  'orderby' => 'post_date',
  'order' => 'DESC',
  'include' => '',
  'exclude' => '',
  'meta_key' => '',
  'meta_value' =>'',
  'post_type' => 'post',
  'post_status' => 'publish',
  'suppress_filters' => true);

$recent_posts = wp_get_recent_posts( $postargs, ARRAY_A );

?>


  <div class="mt-2 Top decalthon"><i class="far fa-clock pr-2"></i>Derniers Episodes Ajoutés <span class="ders">
    <a href="<?php echo esc_url(get_link_by_slug('derniers-episodes')); ?>"  class="_3n2oh">Voir Tout</a>
</span>
  </div>

<div class="list-group">
   <?php foreach( $recent_posts as $recent ){ ?>
<a href="<?php echo esc_url(get_the_permalink($recent["ID"]));?>" class="list-group-item for list-group-item-action" title="<?php echo $recent["post_title"]?>"><h3><?php echo $recent["post_title"]?></h3><span class="ml-5 pl-5 float-right"></span></a>

  <?php  } wp_reset_query();?>
</div>

    </div>