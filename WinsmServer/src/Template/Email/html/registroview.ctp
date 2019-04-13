<p>Hola <?php echo $NAME." ".$SURNAME; ?></p>
<p>
Bienvenido a Startrade<br>
Usuario: <?php echo $MAIL; ?><br>
Clave: <?php echo $PASSWORD; ?><br>
Telefono: <?php echo $PHONE_MOBILE_COUNTRY." ".$PHONE_MOBILE_NUM; ?><br>
</p>
<p>Para Activar el usuario visite el siguiente Link <a href="<?php $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]/winsm"; echo $actual_link; ?>/TUser/confirmUser?v=<?php echo $TOKEN; ?>">activar</a></p>