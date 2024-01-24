
<?php 
/* this template to show the results of a search mark up */

$type=get_post_type($page->ID);
?>
 
    <div class="col-lg-2 col-md-4 col-sm-8 col-xs-6 mb-2  ">
                                            <div class="item">
<div class="w3l-movie-gride-agile w3l-movie-gride-agile1">
            
<a class="fer" href="<?php esc_url(the_permalink()); ?>" title="<?php echo get_the_title();  ?>" class="hvr-shutter-out-horizontal">
  <?php
  
   if ( has_post_thumbnail() ) { 
    $image_title=get_the_title();
    the_post_thumbnail( 'episode-size' ,['alt'=>"$image_title",'class'=>"img-responsive"],$crop = true ); 
      
       }
       else{
        ?>
         <img src="<?php echo esc_url(get_the_post_thumbnail_url($pageID,'episode-size')); ?>" class="img-responsive" alt="<?php echo $image_title ;?>">

      <?php }?>
        <div class="w3l-action-icon"><i class="fa fa-play-circle" aria-hidden="true"></i></div>
                            </a>
                            <div class="mid-2 agileits_w3layouts_mid_1_home">
                                <div class="" style="min-height: 40px;">
                                 
                                     <h5 class="fet"><a href="<?php esc_url(the_permalink()); ?>"><?php echo ucwords(get_the_title()); ?></a></h5> 

                                </div>
                               
                            </div>
    <?php   if($type=='serie') {
      $terms = get_the_terms ( $post->ID, 'saison' );
$number = count($terms);
?>

                       <div class="ribben"><p><?php echo $number.' Saison' ;?></p></div>

                     <?php } else{ ?>
                       <div class="ribben"><p><?php echo 'Film' ;?></p></div>


                   <?php  }?>
  </div>
                    </div>
                       
      
  

  </div>  



	