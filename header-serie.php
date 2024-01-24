<!DOCTYPE html>
<html lang="fr-FR">
 <head>
<title><?php

$titr=strtoupper(get_the_title());

      $serie= substr($titr, 0, strpos($titr, "VOSTFR"));
if(!empty($serie)){
  $titre=$serie;
         echo ucwords(get_the_title($post->ID)).' et VF en Streaming | opseries.com'; 
}
else {
  $titre=get_the_title();
  echo ucwords(get_the_title($post->ID)).' VOSTFR et VF en Streaming | opseries.com'; 
}


  ?></title>
   
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<?php if(is_singular( 'serie' )){ 
if(!empty($serie)){
  
  ?>
<meta name="description" content="<?php echo 'Regarder et telecharger Toutes les episodes de la serie '.get_the_title($post->ID). ' et VF en streaming';?>"> 
<?php } else {
	?>
	<meta name="description" content="<?php echo 'Regarder et telecharger Toutes les episodes de la serie '.get_the_title($post->ID). ' VOSTFR et VF en streaming';?>"> 
<?php }
} 
	?>
  <?php wp_head(); ?> 

<script type="application/ld+json">

<?php $serie=get_the_category($post->ID);
$img_url=get_the_post_thumbnail_url($post->ID);

echo '
  {
"@context": "http://schema.org",
"@type": "WebPage",
"name": "'.wp_specialchars_decode(get_the_title($post->ID)).'",
"url": "'.get_the_permalink($post->ID).'",
"description": "Regarder et telecharger Toutes les episodes de la serie '.get_the_title($post->ID). ' en streaming",
"breadcrumb":{
"@type":"BreadcrumbList",
"itemListElement":[
{
"@type":"ListItem",
"position":"1",
"item":{
"@type":"WebPage",
"@id":"https://opseries.com/",
"name":"Home"
}
},
{
"@type":"ListItem",
"position":"2",
"item":{
"@type":"WebPage",
"@id":"https://opseries.com/serie/",
"name":"Series"
}
},

{
"@type":"ListItem",
"position":"3",
"item":{
"@type":"WebPage",
"@id":"'.get_the_permalink($post->ID).'",
"name":"'.wp_specialchars_decode(get_the_title($post->ID)).'"
}
}
]
}
,"image": ["
    '.$img_url.'"
  ]

}';?>
</script>
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
