<?php echo $content; ?>

<?php echo validation_errors(); ?>

  <form id="manage_user" class="validation" action="<?php echo base_url('user/'.$action);?>" method="post">
    <input type="text" class="required" minlength="1" maxlength="20" name="nombre" placeholder="Nombre" value="<?php echo isset($user) ? $user->get_nombre() : ''; ?>">
    <input type="text" name="apellidos" placeholder="Apellidos" value="<?php echo isset($user) ? $user->get_apellidos() : ''; ?>">
    <?php if ($action == 'new') ?><input type="text" name="username" placeholder="Usuario">
    <input type="password" name="password" class="required" placeholder="Contraseña">
    <?php if ($action == 'edit') ?><input type="password" name="repeat_password" class="required" placeholder="Repite la Contraseña">
    <input type="email" name="email" placeholder="Correo electrónico" value="<?php echo isset($user) ? $user->get_email() : ''; ?>">
    <input type="submit" name="submit" value="Enviar">
  </form>
</div>
