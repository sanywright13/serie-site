<!DOCTYPE html>
<html lang="fr-FR">
 <head>
  <title><?php wp_title(' ',true,'right');?> 
<?php echo get_bloginfo( 'name' ); ?></title>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<?php 
wp_head(); ?> 

 
<script type="application/ld+json">
  <?php $serie=get_the_category($post->ID);
  $thispost = get_post($post->ID);
    $menu_order = $thispost->menu_order;
  $img_url=get_the_post_thumbnail_url($post->ID);
   $serie_id=get_page_by_title(wp_specialchars_decode($serie[0]->name), $output = OBJECT, $post_type = 'serie');
$pageID = $serie_id->ID; 
  if(!$img_url){
    $img_url=get_the_post_thumbnail_url($pageID);
  }
  $saison = get_the_terms($post->ID,'saison');
  $saison_nom=$saison[0]->name;
  $saison_num=str_replace('Saison', '', $saison_nom);
  $saison_num=str_replace(' ', '', $saison_num);
    $saison_num=(int)$saison_num;
    $serie_name=strtoupper($serie[0]->name);
    $serie1= substr($serie_name, 0, strpos($serie_name, " VOSTFR"));

    if(!empty($serie1)){
$serie_name=$serie1;
    }

  echo '
{
  "@context" : "http://schema.org",
  "@type" : "TVEpisode",
  "partOfTVSeries" : {
    "@type" : "TVSeries",
    "name" : "'.wp_specialchars_decode($serie_name).'"
  },
  "partOfSeason" : {
    "@type" : "TVSeason",
    "seasonNumber" : "'.$saison_num.'"
  },
  "episodeNumber" : "'.$menu_order.'",
  "image" : "'.$img_url.'"
} ';  ?>
</script>

<script type="application/ld+json">

<?php $serie=get_the_category($post->ID);
echo '
  {
"@context": "http://schema.org",
"@type": "WebPage",
"name": "'.wp_specialchars_decode(get_the_title($post->ID)).'",
"url": "'.get_the_permalink($post->ID).'",
"description": "Regarder '.wp_specialchars_decode(get_the_title($post->ID)). ' en streaming gratuit en une bonne qualité Video HD",
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
"@id":"'.esc_url(get_the_permalink($pageID)).'",
"name":"'.wp_specialchars_decode($serie[0]->name).'"
}
},
{
"@type":"ListItem",
"position":"4",
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

