<!DOCTYPE html>
<html lang="fr-FR">
 <head>
  <title><?php wp_title(' ',true,'right');?> 
<?php echo get_bloginfo( 'name' ); ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<?php 
if(is_tax('genres')){
		 $genre=get_queried_object()->name;
		?>
<meta name=description content="<?php echo 'Regarder Toutes les Series VF et VOSTFR en streaming Gratuit de Genre '.$genre; ?>">

<?php 

}?>
<?php wp_head(); ?> 
 <?php 
  if(is_singular('films')){ 
    global $post;?>

    <script type="application/ld+json">
      <?php $acteurs=get_field('acteurs',get_the_ID() ); 
      $acteurs=get_field('acteurs',get_the_ID() ); 
      $term_list_acteur=explode(",",$acteurs);
$rea=get_field('realisateurs',get_the_ID() );

$details =get_field('details',get_the_ID() ); 
 $img_url=get_the_post_thumbnail_url($post->ID);
 echo '
{
      "@context": "https://schema.org",
      "@type": "Movie",
      "name":"'.get_the_title().'"
      ,';
         if(!empty($rea)){ 
    echo  '"director": {
    "@type": "Person",
    "name": "'.$rea.'"
  },';
 }
 if(!empty($term_list_acteur)){
    echo  '"actor": [';
  foreach($term_list_acteur as $i=>$acteur){
    if($i==0){
       echo '{
          "@type": "Person",
          "name":"'.$acteur.'"
        }';
    }
       else{

  echo ',{
          "@type": "Person",
          "name":"'.$acteur.'"
        }';

}

       } 
      echo '],';
   } 
echo '"image": ["
    '.$img_url.'"
  ],';
  if(!empty($details)){
 echo  '"description": "'.$details.'",';
  }


echo '"dateCreated" : "'.get_the_date('c').'"}'; ?>
    </script>
<?php }?>

</head>
<body>
 <div class="container-fluid navbar navbar-expand-lg theme">
<div class="container">
<a href="<?php echo get_bloginfo( 'wpurl' ).'/';?>" class="navbar-brand">opseries.com</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"><i class="fas fa-list-alt"></i></span>
</button>
  
  <?php 


if ( has_nav_menu( 'header-menu' ) ) {

         $defaults = array( 'theme_location' => 'header-menu' ,'container' => 'div','container_class'=>'collapse navbar-collapse','container_id'      => 'navbarResponsive','menu_class'=>' navbar-nav mr-auto mt-2 mt-lg-0','link_before'=>' ','link_after'=>' ','depth'=>'', 'walker' => new IBenic_Walker());

        wp_nav_menu( $defaults );

    }

  ?>

</div>
</div>



<!-- Coming Soon -->
