<?php echo $content; ?>

<?php echo validation_errors(); ?>

  <form id="manage_user" class="validation" action="<?php echo base_url('user/edit');?>" method="post">
    <input type="text" class="required" minlength="1" maxlength="20" name="nombre" placeholder="Nombre">
    <input type="text" name="apellidos" placeholder="Apellidos">
    <input type="text" name="username" placeholder="Usuario">
    <input type="password" name="password" class="required" placeholder="Contraseña">
    <input type="email" name="email" placeholder="Correo electrónico">
    <input type="submit" name="submit" value="Enviar">
  </form>
</div>
