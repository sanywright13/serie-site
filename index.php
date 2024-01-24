<?php 

if(is_home()) { 
get_header('index'); 
}
$popularpost= get_posts(array(
  'post_type'=>'serie',
  'post_status' => array('publish'),
    'posts_per_page'=>6,
  'meta_query' => array(
    array(

      'key' => 'populaire',
      'compare' => '=',
      'value' => '1'
    )
  )
)); 
 ?>

<div class="container">
<div class="soto">
 <h1 class="section-title"> Séries Streaming Populaires</h1>
<div class="row">
<?php 
     if ( $popularpost) :
    foreach ( $popularpost as $post ) :
      setup_postdata( $post )

      ?>
              <?php  $image_title=get_the_title(); ?>
              <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                     <div class="item" >
                        <div class="w3l-movie-gride-agile w3l-movie-gride-agile1">
                            <a href="<?php esc_url(the_permalink()); ?>"  title="<?php echo $image_title; ?>">
                                <?php
  
   if ( has_post_thumbnail() ) { 
 
    the_post_thumbnail( 'index-size' ,['alt'=>"$image_title","class"=>'img-responsive'],$crop = true ); 
      
       }
        ?>

<div class="w3l-action-icon">
<i class="fa fa-play-circle" aria-hidden="true"></i>
</div>
</a>
 <div class="agileits_w3layouts_mid_1_home">
<a href="<?php esc_url(the_permalink()); ?>"  title="<?php echo $image_title; ?>">
<?php $date_sortie= get_field('date_de_sortie',get_the_ID() );
$terms = get_the_terms ( $post->ID, 'saison' );
$number = count($terms);
?>
<h3><?php echo ucwords(the_title()); ?></h3> 
</a>                     
</div>                               
                          
                        </div>
                    </div>
                  </div>
                          <?php endforeach ; endif;?>   
              </div>

          </div>
      
        </div>
<div class="container front-page">
	<div class="row">

<div class="col-lg-9 col-md-12 col-sm-12">

      <div class="soto p-2 mt-4">
           <h2 class="oitem Top"><i class="fas fa-tv pr-2"></i>  <span class=""> Derniers épisodes Séries-TV VOSTFR ajoutés 

</span>
<span class="fero">
  <a class="float-right" href="<?php   echo esc_url('https://opseries.com/derniers-episodes/'); ?>" title="dernier series tv episodes vostfr">Voir Plus<i class="fas fa-arrow-circle-right pl-2"></i></a>
          </span>
            </h2>

  <div class="row top">
    <?php if (have_posts() ) {

     while (have_posts()) : the_post(); ?>
  
   <?php 
$langue_post = get_the_terms(get_the_ID(),'langue');
if(empty($langue_post[0]->name) or $langue_post[0]->name=="VOSTFR"):

$serie=get_the_category();
$serie_id=get_page_by_title(wp_specialchars_decode($serie[0]->name), $output = OBJECT, $post_type = 'serie');
$pageID = $serie_id->ID; 


?>
      <div class="col-lg-2 col-md-3 col-sm-2 col-6 mb-2  ">
                                            <div class="item">
<div class="w3l-movie-gride-agile w3l-movie-gride-agile1">
            
<a  href="<?php esc_url(the_permalink()); ?>" title="<?php echo get_the_title();  ?>" >
  <?php
  $image_title=get_the_title();
   if ( has_post_thumbnail() ) { 
    
    the_post_thumbnail( 'index-size' ,['alt'=>"$image_title",'class'=>"img-responsive"],$crop = true ); 
      
       }
       else{        
               echo get_the_post_thumbnail( $pageID, 'episode-size',array( 'class' =>'img-responsive' ,'alt'=>$image_title)  ); 

        }?>
        <div class="w3l-action-icon"><i class="fa fa-play-circle" aria-hidden="true"></i></div>
                          
                            <div class="agileits_w3layouts_mid_1_home" >
<?php $title= substr(get_the_title(), 0, strpos(get_the_title(), "Episode"));
$thispost = get_post(get_the_ID());
$menu_order = $thispost->menu_order;
?>
                        <h3><?php echo ucwords($title).' VOSTFR'; ?></h3> 
                            <p><?php echo  'Episode '.$menu_order;?> </p>

                                </div>
                                 </a>
                           
      

  </div>
                    </div>
                       
      
  </div>  
  <?php endif; endwhile;?>
  <?php  }
wp_reset_query(); ?>
  </div>

</div>
 
  <?php $args = array(
    'post_page'=>'12',
    'post_status' => array('publish'),
    'post_type'=>'post',
   'tax_query' => array(
        array(
            'taxonomy' => 'langue',
            'field' => 'slug',
            'terms' => 'vf',
        ),
    ),

);
 
$query_1 = new WP_Query( $args );?>

 <div class="soto p-2 mt-4">
           <h2 class="oitem Top"><i class="fas fa-tv pr-2"></i>  <span class=""> Derniers épisodes Séries-TV VF ajoutés 

</span>
<span class="fero">
  <a class="float-right" href="<?php   echo esc_url('https://opseries.com/langue/vf/'); ?>" title="derniers episodes series tv vf">Voir Plus<i class="fas fa-arrow-circle-right pl-2"></i></a>
          </span>
            </h2>

  <div class="row top">
    <?php if ($query_1->have_posts() ) {

     while ($query_1->have_posts()) : $query_1->the_post(); 

$serie=get_the_category();
$serie_id=get_page_by_title(wp_specialchars_decode($serie[0]->name), $output = OBJECT, $post_type = 'serie');
$pageID = $serie_id->ID; 

?>

      <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-2  ">
                                            <div class="item">
<div class="w3l-movie-gride-agile w3l-movie-gride-agile1">
            
<a  href="<?php esc_url(the_permalink()); ?>" title="<?php echo get_the_title();  ?>" >
  <?php
  $image_title=get_the_title();
   if ( has_post_thumbnail() ) { 
    
    the_post_thumbnail( 'episode-size' ,['alt'=>"$image_title",'class'=>"img-responsive"],$crop = true ); 
      
       }
    else{        
        echo get_the_post_thumbnail( $pageID, 'episode-size',array( 'class' =>'img-responsive' ,'alt'=>$image_title)  ); 

      }?>
        <div class="w3l-action-icon"><i class="fa fa-play-circle" aria-hidden="true"></i></div>
                          
                            <div class="mid-2 agileits_w3layouts_mid_1_home" style="min-height: 40px;">
                              
                                  <?php $title= substr(get_the_title(), 0, strpos(get_the_title(), "Episode"));?>
                        <h3 ><?php echo ucwords($title).' VF'; ?></h3> 

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

</div>

<?php $args = array(
    'post_page'=>'8',
    'post_type'=>'films',
    'post_status' => array('publish')
);
 
$query_film = new WP_Query( $args );?>
 <div class="soto mt-3">
 <h2 class="oitem Top"><i class="fas fa-tv pr-2"></i>  <span class=""> Derniers Films VF en Streaming 

</span>

<span class="fero">
  <a class="float-right" href="<?php   echo esc_url('https://opseries.com/films/'); ?>" title="derniers series vostfr et vf">Voir Plus<i class="fas fa-arrow-circle-right pl-2"></i></a>
          </span>
            </h2>

<div class="row top">
 <?php 
      if ($query_film->have_posts()) : while ($query_film->have_posts()) : $query_film->the_post(); 
      ?>
        <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-2 ">
                                            <div class="item gery">
<div class="w3l-movie-gride-agile w3l-movie-gride-agile1">
            
<a  href="<?php the_permalink(); ?>" title="<?php echo the_title(); ?>">
<?php
$image_title=get_the_title();
if ( has_post_thumbnail() ) { 
the_post_thumbnail( 'episode-size' ,['alt'=>"$image_title",'class'=>"img-responsive"],$crop = true ); 
}?>
        <div class="w3l-action-icon"><i class="fa fa-play-circle" aria-hidden="true"></i></div>
   
                            <div class="mid-2 agileits_w3layouts_mid_1_home" style="min-height: 40px;">
                              
                        <h3 ><?php echo ucwords($image_title); ?></h3> 

                                </div>
</a>
                          
  </div>
                    </div>
                       
 
  </div> 
 
 <?php  endwhile; ?>
<?php wp_reset_query();endif; ?>
 </div>

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
get_footer(); ?>
