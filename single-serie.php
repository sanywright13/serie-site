<?php get_header('serie'); ?>

<?php 
$term_list_genre =  get_the_terms( $post->ID , 'genres' );
$term_list_acteur =  get_the_terms( $post->ID , 'acteurs' );
$term_list_realisateur =  get_the_terms( $post->ID , 'realisateur' );
 ?>
<div class="container">
	<div class="row">
    
 <div class="col-lg-9 col-md-12 col-sm-12 top">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="<?php echo get_bloginfo( 'wpurl' ).'/';?>">opseries.com/
</a>
</li>
  <li class="breadcrumb-item"><a href="<?php echo esc_url('https://opseries.com/serie/');?>" title="">

  <?php  echo 'Series '; ?></a></li>
<?php $post_title=get_the_title();


?>
  
  
    <li class="breadcrumb-item active" aria-current="page"><?php echo ucwords($post_title);?></li>
  </ol>
</nav>
      <h1 class="p-3 tabs-colorful text-white">
      <?php 
$titr=strtoupper(get_the_title());

      $serie= substr($titr, 0, strpos($titr, "VOSTFR"));
if(!empty($serie)){
         echo 'Regarder '.ucwords(get_the_title()).' et VF en Streaming'; 
}
else {
  echo 'Regarder '.ucwords(get_the_title()).' VOSTFR et VF en Streaming'; 
}
?> 
</h1>

<div class="">

  <div class="row">
  <div class="col-md-4 col-lg-3  col-sm-6 col-6" >
     <?php
    $name= get_the_title();
  if ( has_post_thumbnail() ) { 
    the_post_thumbnail( 'serie' ,['alt'=>"$name",'class'=>" img-responsive rounded  "],$crop = true ); 
     }?>
  </div>
   <div class="col-md-6 col-lg-8 col-sm-12  fere">
   	 <div  class="p-2"><h3 class=" nadi"><span class="finf">Série : </span>
<?php 
         echo ucwords(the_title());?>
   	 </h3></div>
<?php  $titre= get_field('duree',get_the_ID() );

 if(! empty ($titre )){ ?>
       <div  class="p-2"><span class="finf">Durée : </span>
<?php  echo ucwords($titre);?>
 </div>
 
<?php   } if(! empty ($term_list_genre )){ ?>

  <div  class="p-2 finfo">
  <span class="finf">Genre :</span> 
  <?php foreach($term_list_genre as $genre){?>
   <a href=" <?php echo 'https://opseries.com/Genres/'.$genre->slug.'/';?>"><?php echo ucwords($genre->name).' / ';?>
     
   </a>
 <?php }?>
</div>
<?php  } if(! empty ($term_list_realisateur )){ ?>

  <div  class="p-2">
  <span class="finf">Realisateur :</span> 
  <?php foreach($term_list_realisateur as $rea){?>
<?php echo ucwords($rea->name).' ';?>
<?php }?>

</div>


<?php  }
else {

$rea=get_field('realisateurs',get_the_ID() );
if($rea){
?>
<span class=" p-2"><span class="finf">realisateurs :</span> 
<?php echo ucwords($rea);?>
</span>
<?php
}
}
 if(! empty ($term_list_acteur)){ ?>
<div  class="p-2">
<span class="finf">Acteurs :</span> 
<?php foreach($term_list_acteur as $acteur){?>
<?php echo ucwords($acteur->name).' , ';?>
<?php }?>

</div>
<?php }
else {

$acteurs=get_field('acteurs',get_the_ID() );
if($acteurs){?>
 <div  class="p-2">
<span class="finf">Acteurs :</span> 
<?php echo ucwords($acteurs);?>
</div>
<?php
}
} 

$date_sortie= get_field('date_de_sortie',get_the_ID() );
if(! empty ($date_sortie)){ ?>
<div class="p-2">
  <span class="finf">Date de sortie :</span><?php echo $date_sortie;?>
</div>

<?php }
$rate =get_field('rating',get_the_ID() );
if(!empty ($rate)){ ?>

<div class="p-2">
<span class="finf">Rating: </span>
<?php echo $rate;?>
</div>
<?php } 
$content_post = get_post(get_the_ID());
$content = $content_post->post_content;
if(! empty ($content)){ ?>
<p> <?php echo $content;?></p>
<?php }?>
</div>
  
</div>
</div>
 <h2 class="p-3  tabs-colorful text-white">Liste Des Episodes   <?php 
    echo the_title().' en Streaming';?> </h2>
<div class="soto p-2">
   <?php 
//get the category serie of the serie 
$serie=get_the_title($post->ID);
$serie_en=urldecode($serie);
$saisons = get_the_terms($post->ID ,'saison');
//on va retirer les caractere speciales on puis on va les comparer
// Remove special characters except space
$cat_post=get_terms( 'category', array( 'name' =>$serie_en ));


$cate=array();
foreach($saisons as $lok){
$cate[]=$lok->name;
}
natsort($cate);
?>

<?php foreach ($cate as $saison ) :
$arg=array(
    'orderby'     => 'menu_order',
    'order'       => 'ASC',
   'post_status' => array('publish'),
     'post_type'=> 'post',
     'posts_per_page'=>-1,
    'tax_query' => array(
    'relation' => 'AND',

    array(
        
          'taxonomy' => 'category',
      'field'    => 'id',
        'terms'    =>$cat_post['0']->term_id,
    ),
    array(
        'taxonomy' => 'saison',
        'field'    => 'name',
        'terms'    =>  $saison,
    ),
),
);      

$query = new WP_Query( $arg);

  ?>
 
<h4>
   
                  <span class="badge badge-success"><?php echo $saison;?></span>
              </h4>
                     
 <div class=" btn-group-justified">
     
 <?php   $i=0 ; if($query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); 
$langue_post = get_the_terms(get_the_ID(),'langue');
  $thispost = get_post(get_the_ID()); 
$menu_order = $thispost->menu_order; 

          if(!empty($langue_post[0]->name) and $langue_post[0]->name=="VF") {
            $i=$i+1;
            if($i==1){
              echo '<div style="font-size: 19px;font-weight: bold;color:#2e8bc3;">Episodes Vf</div>';
            }
            $class="classvf";
?>
<a class="btn btn-default mr-2 mb-2" href="<?php echo esc_url(the_permalink()); ?>" title="<?php echo the_title(); ?>"><span class="" ><?php echo 'Episode '.$menu_order;?></span><span><i class="langue <?php echo  $class;?>"></i></span></a>

<?php    }?>

<?php endwhile; ?>
<?php endif;
$j=0;
?>

<?php   if($j==0 and $i!=0){
              echo '<br>';
            }
             if($query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); 
$langue_post = get_the_terms(get_the_ID(),'langue');
$thispost = get_post(get_the_ID()); 
$menu_order = $thispost->menu_order; 
if(empty($langue_post[0]->name) or (!empty($langue_post[0]->name) and $langue_post[0]->name=="VOSTFR")) {
$j=$j+1;
            if($j==1 and $i!=0){
    echo '<div style="font-size:19px;font-weight:bold;color:#2e8bc3;">Episodes Vostfr</div>';
            }
            $class="classvostfr";
?>
<a class="btn btn-default mr-2 mb-2" href="<?php echo esc_url(the_permalink()); ?>" title="<?php echo the_title(); ?>"><span class="" ><?php echo 'Episode '.$menu_order;?></span><span><i class="langue <?php echo  $class;?>"></i></span></a>

<?php    }?>

<?php endwhile; endif;?>


</div>

<?php endforeach; wp_reset_query();
?>
<hr>

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