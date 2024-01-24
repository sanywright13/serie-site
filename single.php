<?php 
 get_header('single'); ?>
<?php

$saisons = get_the_terms($post->ID ,'saison');
$langue = get_the_terms($post->ID ,'langue');
global $post;
    $post_slug = $post->post_name;
?>

 <div class="container mt-1">

 <div class="">
            <h1 class="faqo mt-2"><?php echo ucwords(get_the_title());?> </h1>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="<?php echo get_bloginfo( 'wpurl' ).'/';?>">opseries.com
</a>
</li>
  <li class="breadcrumb-item"><a href="<?php echo esc_url('https://opseries.com/serie/');?>" title="">

  <?php  echo 'Series '; ?></a></li>
<?php $post_title=get_the_title();

 $serie=get_the_category($post->ID);
 $serie_id=get_page_by_title(wp_specialchars_decode($serie[0]->name), $output = OBJECT, $post_type = 'serie');
$serieID = $serie_id->ID; 
                                if ( ! empty(  $serie) ) {
?>
    <li class="breadcrumb-item"><a href="<?php echo esc_url(get_the_permalink($serieID));?>" title="<?php echo $serie[0]->name; ?>">

    <?php


    $serie1=strtoupper($serie[0]->name);
$title_serie= substr($serie1, 0, strpos($serie1," VOSTFR"));
if(!empty($title_serie)){
  $title_serie1=$title_serie;
}
else{
  $title_serie1=$serie[0]->name;
}
     echo wp_specialchars_decode(ucwords($title_serie1) ) ;?></a></li>
   <?php }?>
  
    <li class="breadcrumb-item active" aria-current="page"><?php echo ucwords($post_title);?></li>
  </ol>
</nav>

</div>


 </div>


      
<div class="container">

  <div class="row">

        <div class="col-lg-9 col-md-12">
          

<div class="">
 <?php 

$serie_id=get_page_by_title(wp_specialchars_decode($serie[0]->name), null, 'serie');
$pageID = $serie_id->ID; 

?>
<div>
<div id="video-responsive" class="video-responsive">

                                            <div class="msg_info_player hidefm">
                                               
           

                                            </div>
  <div class="holder">
 <div id="lecteur" style="height: auto;"></div>
 <div id="GoPlayer" class="backdrobb" style="background-image: url(

 <?php echo "'".get_the_post_thumbnail_url($pageID)."'" ;?>)">
   <i class="insideIframe"></i>
   <i id="PlayerButton" class="material-icons fa fa-play-circle"></i>
    </div>
   </div>
 </div>
</div>
<?php
if (!empty($langue[0]->name) and $langue[0]->name=="VF")
{
  $type="VF";
}else{
$type="VOSTFR";
}
 ?>

  <?php 

  if(!empty($langue['0']->name))
  {
// get_posts in same custom taxonomy
$args = array(
    'orderby'     => 'menu_order',
    'order'       => 'ASC',
     'post_type'=> 'post',
     'post_status' => array('publish'),
     'posts_per_page'=>40,
    'tax_query' => array(
    'relation' => 'AND',
    array(
     
          'taxonomy' => 'category',
      'field'    => 'id',
        'terms'    => $serie['0']->term_id,
    ),
    array(
        'taxonomy' => 'saison',
        'field'    => 'id',
        'terms'    => $saisons['0']->term_id,
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
$args = array(
    'orderby'     => 'menu_order',
    'order'       => 'ASC',
     'post_type'=> 'post',
     'post_status' => array('publish'),
     'posts_per_page'=>40,
    'tax_query' => array(
    'relation' => 'AND',
    array(
     
          'taxonomy' => 'category',
      'field'    => 'id',
        'terms'    => $serie['0']->term_id,
    ),
    array(
        'taxonomy' => 'saison',
        'field'    => 'id',
        'terms'    => $saisons['0']->term_id,
    ),
 
),
); 


}        

$postlist = get_posts( $args );
// get ids of posts retrieved from get_posts

$ids = array();
foreach ($postlist as $thepost) {
   $ids[] = $thepost->ID;
}

// get and echo previous and next post in the same taxonomy        
$thisindex = array_search($post->ID, $ids);

if(!empty($ids[$thisindex-1])){
$previd = $ids[$thisindex-1];
} 
if(!empty($ids[$thisindex+1])){
$nextid = $ids[$thisindex+1];
}
?>
<div class="btn-group btn-group-justified d-flex">
    <?php if ( !empty($previd) ){

  $thispost = get_post($previd);
$menu_order = $thispost->menu_order;
 ?>
  <span class="p-2">
  <a class="btn btn-default " href="<?php   echo esc_url(get_permalink($previd)); ?>" title="<?php echo get_the_title($previd); ?>"><span class="float-left " ><i class="fas fa-arrow-circle-left pr-2"></i><?php echo  'Episode '.$menu_order;?></span>
  </a>
</span>
<?php } 
if ( !empty($nextid) ) {
   $thispost = get_post($nextid);
$menu_order = $thispost->menu_order;
?>

  <span class="ml-auto p-2">
    <a class="btn btn-default " href="<?php   echo esc_url(get_permalink($nextid)); ?>" title="<?php echo get_the_title($nextid); ?>"><span class="float-left " ><?php echo  'Episode '.$menu_order;?></span><i class="fas fa-arrow-circle-right pl-2"></i>
    </a>
    </span>
<?php } ?>

</div>

<div class="clearfix">

 
 <div class="col-lg-7 col-md-6 col-sm-12 float-left">
   



   <ul>
      <?php     $realpagescount = 1 + substr_count($post->post_content, "<nextpage>");
      $content=explode("<nextpage>",$post->post_content);

$act="active";
for ($x = 0; $x < $realpagescount; $x++) {
$j=$x+1;

$pl= str_replace ("\"", "'", $content[$x]);
echo '<li class="streamer">
<div data-url="'.$pl.'" class="player">
<div id="player_v_DIV_5" class="d-flex"> lecteur'.$j.'
</div>
</div>
</li>';

}?>
     </ul>
     
 </div>
   
<div class="col-lg-5 col-md-6 col-sm-12 float-right">
<?php 

if(!empty($langue)){
$episode_1= preg_replace('/\W\w+\s*(\W*)$/', '$1', get_the_title());

if(!empty($langue[0]->name) and $langue[0]->name=="VOSTFR" and !empty($episode_1)){
$episode_name_vf=$episode_1.' Vf';
if(get_page_by_title(wp_specialchars_decode($episode_name_vf),$output = OBJECT,$post_type = 'post')){
$info=get_page_by_title(wp_specialchars_decode($episode_name_vf),$output = OBJECT,$post_type = 'post');
$statu=get_post_status($info->ID);
if(!empty($statu) and $statu=="publish"){

?>
<div class="ml-auto">
 <a class="btn btn-info" href="<?php echo 'https://opseries.com/'.$info->post_name.'/';?>">
<?php echo "VF"; ?><i class="langue classvf"></i>

</a>
</div>
<?php } } }

else {
if(!empty($langue[0]->name) and $langue[0]->name=="VF" and !empty($episode_1)){
$episode_name_vf=$episode_1.' Vostfr';
if(get_page_by_title(wp_specialchars_decode($episode_name_vf),$output = OBJECT,$post_type = 'post')){
$info=get_page_by_title(wp_specialchars_decode($episode_name_vf),$output = OBJECT,$post_type = 'post');
$statu=get_post_status($info->ID);
if(!empty($statu) and $statu=="publish"){
?>
<div class="ml-auto">
 <a class="btn btn-info" href="<?php echo 'https://opseries.com/'.$info->post_name.'/'; ?>" >

<?php echo "VOSTFR"; ?><i class="langue classvostfr"></i>
</a>
</div>

<?php }
} 
}
}
}

  ?>
</div>
</div>

<?php 

$genres= get_the_terms($pageID ,'genres');
$acteurs= get_the_terms($pageID ,'acteurs');
?>
<div class="shadow-l  soto rounded">    
 <?php  $thispost = get_post(get_the_ID());
$menu_order = $thispost->menu_order;
$title= substr(get_the_title(), 0, strpos(get_the_title(), "Episode"));
?>


<div class="row">
          
 <?php if ( has_post_thumbnail() ) {?>
         <div class="col-lg-2 col-sm-12 mt-2">

        <?php
         the_post_thumbnail( 'serie-genre' ,['alt'=>"$post_title",'class'=>"img-fluid rounded"],$crop = true ); 
      ?>
   
        </div>


 <?php }
 else {?>
  <div class="col-lg-3 col-sm-12 col-md-12 mt-2">
 <img src="<?php echo esc_url(get_the_post_thumbnail_url($pageID,'serie-genre')); ?>"
 class="img-fluid rounded" alt="<?php echo $post_title;?>">
     
    </div>
      <?php } ?>



      <div class="col-lg-9 col-md-12 col-sm-12  "> 
<h2 class="mia"><?php  echo 'Voir L’épisode '.$menu_order .' de la Serie '.$title.' '.$type.' en streaming'; ?></h2> 
<?php 
 if(! empty ($genres )){ 
?>
<div class="finfo p-1">
<span class="finf">Genres : </span>
<?php foreach($genres as $genre) {?>
<a  href="<?php echo esc_url('https://opseries.com/Genres/'.$genre->slug.'/');?>">
<?php 
echo $genre->name;?></a> /
                        <?php }?>
</div>
<?php }?>
      	
<?php if(! empty ($acteurs)){ ?>
<div class="p-1">
<span class="finf">Acteurs :</span>
<?php foreach($acteurs  as $actor) {?>

<?php echo $actor->name.',';?> 
 
 <?php } ?>

 </div>
<?php }
else {
$acteurs1=get_field('acteurs',$pageID);
if(!empty($acteurs1)){?>
  <div class="p-1 ">
<span class="finf">Acteurs :</span>
<?php echo ucwords($acteurs1);?>
        </div>   
 <?php  }
}

$duree=get_field('duree',$pageID );
if ( ! empty ( $duree) ){?>
<div class="p-1 ">
<span class="finf">Durée : </span>
<?php echo $duree ;?>
</div>
<?php }?>                        
<?php $resume=get_field('resume',get_the_ID() );?>
<?php if (!empty ( $resume) ){ ?>
<div class="p-1">
<?php $title= substr(get_the_title(), 0, strpos(get_the_title(), "Episode"));?>   

<div class="text-white-50 p-2"><?php echo $resume ;?> </div>
</div>  
<?php } ?>
</div>            
</div>
</div>
</div>
<?php if (comments_open()){
    comments_template();
}?>

  </div>

  <?php include( locate_template( 'episodes.php', false, false ) ); ?>


</div>
</div>
 <script>
                                                $(document).ready(function () {
                                                $("#PlayerButton").click(function () {
                                                $("#GoPlayer").fadeOut();
                                                $('#lecteur').css({
                                                'height': 'auto'
                                                });
                                                });
                                                });
                                                </script>
<script>

$(document).ready(function () {

 function play_streamer(player, a = 1) {

        var s = player.data('url');
       
        var videoplay =$('#lecteur').html(s);
     
$('iframe').attr("class","load");
     $('iframe').attr("id","videoplay");
        $("li.streamer").removeClass('active');
        player.parent("li.streamer").addClass('active');
        if (a) {
            $('html, body').animate({
                scrollTop: videoplay.offset().top - 20
            }, 300);
    }
    }


    $('#PlayerButton').click(function(){ 
        if(!$('#iframe').length) {

                    var fp = $("li.streamer.active .player");
                setTimeout(function(){
                $('#videoplay').fadeIn(900);
            }, 4000);
    if (fp.length) {
        play_streamer(fp, 0);
    }
        }
    });
 
  $("li.streamer:first").addClass('active');

 $("li.streamer:not(.dow) .player").click(function (e) {
        e.preventDefault();
        play_streamer($(this));
    })

   
    
    

    

});

</script>
<?php
get_footer();

?>


