<!DOCTYPE html>
<html lang="fr-FR">
 <head>
  <title><?php
$taxo=get_query_var( 'taxonomy' ) ;
 $term=get_queried_object()->name;
      echo 'liste Series Vostfr et Vf de '.$taxo.' '.$term;

  ?></title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<?php wp_head(); ?> 

</head>
<body>
 <div class="container-fluid navbar navbar-expand-lg theme">
<div class="container">
<a href="<?php echo get_bloginfo( 'wpurl' ).'/';?>" class="navbar-brand" title="series vostfr vf en streaming">opseries.com/</a>
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
