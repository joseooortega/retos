<?php
$this->load->view('bakend/templates/head');
if (isset($sidebar_l) && $sidebar_l)
$this->load->view('bakend/templates/sidebar_l');
//
?>
<div id="content">
  <?php $this->load->view('bakend/'.$view); ?>
</div>
<?php
//
if (isset($sidebar_r) && $sidebar_r)
$this->load->view('bakend/templates/sidebar_r');
$this->load->view('bakend/templates/footer');
