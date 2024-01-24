<?php get_header(); ?>

<?php 
$term_list_genre =  get_the_terms( $post->ID , 'genres' );
$term_list_acteur =  get_the_terms( $post->ID , 'acteurs' );
$term_list_realisateur =  get_the_terms( $post->ID , 'realisateur' );
global $post;
    $post_slug = $post->post_name;
 ?>
<div class="container">
	<div class="row ">
    
 <div class="col-lg-9 col-md-12 col-sm-12 top ">

<div class="soto mt-3">
  <h1 class="text-white m-3">
      <?php 
         echo ucwords(get_the_title()).' en Streaming';?>  

</h1>
  <div class="row">
   
  <div class="col-md-6 col-lg-3  col-sm-12" style="float:left;">
    
     <?php
    $name= get_the_title();
  if ( has_post_thumbnail() ) { 
    the_post_thumbnail( 'serie' ,['alt'=>"$name",'class'=>"img-responsive"],$crop = true ); 
     }?>
  </div>
   <div class="col-md-6 col-lg-8 col-sm-12  m-3 " style="float:right">


 

      <h2 class="nadi"><strong>
<?php 
                 echo 'Regarder Le Film '.ucwords(get_the_title()).' en Streaming Complet et Gratuit' ;
?></strong>
</h2>
   	
<?php  $titre= get_field('titre_alternatif',get_the_ID() );

 if(! empty ($titre )){ ?>
       <div  class="p-2"></span><span class=" nadi"><h2 class="finf">Titre alternatif : </span>
<?php 
         echo 'Regarder Le Film '.ucwords($titre).' en Streaming Complet et Gratuit' ;?>
     </span></h2>
 
<?php   } 

 
 if(! empty ($term_list_genre )){ ?>

  <div  class="p-2">
    <span class="nadi"><span class="finf">Genre :</span> <?php foreach($term_list_genre as $genre){?>
   <a href="<?php  echo esc_url('https://opseries.com/films/Genres/'.$genre->slug.'/') ;?>"><span class=" mr-2 p-1"><?php echo ucwords($genre->name).'';?></span></a>
 <?php }?>
</span></div>

<?php  } ?>
 <div  class="p-2">
 <?php if(! empty ($term_list_realisateur )){ ?>

 <span class=" nadi"><span class="finf">Realisateur :</span> <?php foreach($term_list_realisateur as $rea){?>
   <a href="<?php echo home_url( '/' ).'/realisateur/'.$rea->slug.'/';?>"><span class=" mr-2 p-1"><?php echo ucwords($rea->name).'';}?></span></a>
</span>


<?php  }

 else {

$rea=get_field('realisateurs',get_the_ID() );
if($rea){
?>
<span class=" nadi"><span class="finf">realisateurs :</span> 
<span class=" mr-2 "><?php echo ucwords($rea);?></span>
</span>
<?php
}
}?>
</div>
 <div  class="p-2">
<?php
if(! empty ($term_list_acteur)){ ?>

  <div  class=""><span class=" nadi"><span class="finf">Acteurs :</span> <?php foreach($term_list_acteur as $acteur){?>
   <a href="<?php echo home_url( '/' ).'/acteurs/'.$acteur->slug.'/';?>"><span class=" mr-2 p-1"><?php echo ucwords($acteur->name).'';}?></span></a>
</span></div>
<?php } 
else {

$acteurs=get_field('acteurs',get_the_ID() );
if($acteurs){
?>
 <div  class=""><span class=" nadi"><span class="finf">Acteurs :</span> 
<span class=" mr-2 p-1"><?php echo ucwords($acteurs);?></span>
</span></div>
<?php
}
} 
?>
</div>
<?php

$duree= get_field('duree',get_the_ID() );
if(! empty ($duree)){ ?>
<div class="p-2"><span class=" nadi"><span class="finf">Duree :</span><?php echo $duree;?></span></div>

<?php }
$date_sortie= get_field('date_de_sortie',get_the_ID() );
if(! empty ($date_sortie)){ ?>
<div class="p-2"><span class=" nadi"><span class="finf">Date de sortie :</span><?php echo $date_sortie;?></span></div>

<?php }
$rate =get_field('rating',get_the_ID() );
if(!empty ($rate)){ 
?>

<div class="p-2"><span class=" nadi"><span class="finf">Rating: </span><?php echo $rate;?>
</span></div>
<?php }
$pays =get_field('pays',get_the_ID() );
if(!empty ($pays)){ 
?>

<div class="p-2"><span class=" nadi"><span class="finf">pays d'origine: </span><?php echo $pays;?>
</span></div>
<?php }

$details =get_field('details',get_the_ID() );
if(!empty ($details)){ 
?>
  <div  class=" nadi"><p><?php 
echo $details;
?></p>
  </div>
<?php }?>
</div>
  
</div>
</div>

<div class="soto p-2">

<div class="vid">

  <div class=" mt-3">
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
<div class="clearfix">

 
 <div class="col-lg-7 col-md-6 col-sm-12 float-left">
   



   <ul>
      <?php     $realpagescount = 1 + substr_count($post->post_content, '<nextpage>');
      $content=explode('<nextpage>',$post->post_content);

$act="active";
for ($x = 0; $x < $realpagescount; $x++) {

$j=$x+1;
?>
    <li class="streamer">
     <div data-url='<?php echo $content[$x];?>' class="player">
   
     <div id="player_v_DIV_5" class="d-flex">
    <?php echo 'lecteur '.$j;  ?>
</div>
    </div>
  </li>
    <?php 
}?>
     </ul>
 </div>
   
</div>


</div>
</div>

<hr>

<?php 
    $recent_posts = wp_get_recent_posts(array('post_type'=>'films','numberposts' => 6,
        'post_status' => 'publish' ));

?>
<h4>  Derniers Film VF et VOSTFR a regarder en streaming</h4>
<div class="row derniers-films">
<?php  foreach( $recent_posts as $recent ){?>

<div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-2  single-film">
                                        
<div class="w3l-movie-gride-agile w3l-movie-gride-agile1 fet">
            
<a  href="<?php echo get_permalink($recent["ID"]); ?>" title="<?php echo esc_attr($recent["post_title"]); ?>" class="hvr-shutter-out-horizontal">

        <?php    echo get_the_post_thumbnail( $recent["ID"], 'episode-size',array( 'alt'=>  
       esc_attr($recent["post_title"]))  );  ?>

                        
                                  
<div class=" p-1" style="min-height: 45px;"><?php echo esc_attr($recent["post_title"]); ?></div> 

</a>
                          
  </div>
                
                       

</div>

<?php } ?>
  </div>


 
 </div>
<?php if (comments_open()){
    comments_template();
}?>
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
if($term1->term_id != get_queried_object()->term_id){

  ?>

  <li class="list-group-item for fet">  <a href="<?php  echo esc_url('https://opseries.com/films/Genres/'.$term1->slug.'/') ;?>" title="<?php echo 'films '.$term1->name.' en streaming';?>"><?php echo $term1->name;?></a></li>
<?php } 
else { ?>
  <li class="list-group-item finf">  <a href="<?php  echo esc_url('https://opseries.com/films/Genres/'.$term1->slug.'/') ;?>" title="<?php echo 'films '.$term1->name.' en streaming';?>"><?php echo $term1->name;?></a></li>
  <?php } }}?>
</ul>

</div>

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

    /*var fp = $("li.streamer.active .player");
    if (fp.length) {
        play_streamer(fp, 0);
    }*/

    $("li.streamer:not(.dow) .player").click(function (e) {
        e.preventDefault();
        play_streamer($(this));
    })


    
    
    $(".dow .player").click(function () {
        var url = $(this).data('url');
        window.open(url,'_blank');
    })
    
    
  
});

</script>
<?php get_footer();?>