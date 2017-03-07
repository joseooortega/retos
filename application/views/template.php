<?php
$this->load->view('templates/head');
if (isset($cabeceras)){ ?>
  <div id="cabecera" class="flexslider">
  <ul class="slides">
    <?php foreach ($cabeceras as $cabecera) { ?>
      <li><div class="image-background" style="<?php echo base_url('uploads/img/'.$cabecera); ?>"></div></li>
    <?php } ?>
  </ul>
</div>
<script type="text/javascript">
  $(window).load(function() {
    $('#cabecera').flexslider({
      animation: "slide"
    });
  });
</script>
<?php }
if (isset($sidebar_l) && $sidebar_l)
$this->load->view('templates/sidebar_l');
//
?>
<div id="content">
  <?php $this->load->view($view); ?>
</div>
<?php
//
if (isset($sidebar_r) && $sidebar_r)
$this->load->view('templates/sidebar_r');
$this->load->view('templates/footer');
