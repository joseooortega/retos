<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Retos everywhere!</title>
    <?php
      if (isset($metas) && $metas){
        foreach ($metas as $meta) {
          $attr = array();
          foreach ($meta['attributes'] as $tag => $attribute) {
            $attr[] = ' '.$tag.'="'.$attribute.'"';
          }
          echo '<meta'.$attr.'>';
        }
      }
    ?>
    <link rel="stylesheet" href="resources/css/style.css">
    <script src="resources/js/jquery-3.1.1.min.js" charset="utf-8"></script>
    <script src="resources/js/helper.js" charset="utf-8"></script>
    <script src="resources/js/forms_control.js" charset="utf-8"></script>
    <?php
      if (isset($js) && $js)
        foreach ($js as $value) { echo '<script src="resources/js/'.$value.'.js" charset="utf-8"></script>'; }
    ?>
  </head>
  <body>
    <header>
      <div class="cookies">
        <p></p>
      </div>
      <div class="user">
        <a href="<?php echo base_url(); ?>user"></a>
      </div>
      <nav class="container">
        <ul>
          <li><a href="<?php echo base_url(); ?>">Home</a></li>
          <li><a href="<?php echo base_url(); ?>">Retos</a></li>
          <li><a href="<?php echo base_url(); ?>">Eventos</a></li>
          <li><a href="<?php echo base_url(); ?>">¿Como funciona?</a></li>
          <li><a href="<?php echo base_url(); ?>">Contactanos</a></li>
        </ul>
      </nav>
    </header>
