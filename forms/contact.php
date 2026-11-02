<?php

session_start( ); // allows us to retrieve our key form the session

$nombre   = $_POST['name'];
$producto = $_POST['producto'];
$email = $_POST['email'];
$telefono = $_POST['phone'];
$mensaje  = $_POST['message'];


if( $_POST['name'] = empty($nombre) && $_POST['producto']=empty($producto) && $_POST['email']=empty($email) && $_POST ['phone']=empty($telefono) && $_POST['message']=empty($mensaje) ) {
//if( md5( $_POST[ 'code' ] ) != $capchaTemp ) {
  // echo $_SESSION['key'].'   Session';
  // echo $_POST['a'].'    post';
  echo "Por favor asegurese de llenar todos los campos.";
  //$datos["success"] = 0;

} else {
  $ok = true;
  // Validamos Si los campos minimos requeridos fueron llenados
  if($nombre == ''){
    $ok = false;
    $falta = 'Falta el campo: <strong>Nombre</strong>';
  }
  if (!preg_match("/^[A-Za-zñÑáéíóúüÁÉÍÓÚ]{3,50}/",$nombre)) {
    $ok = false;
    $falta = 'No es un nombre valido, debe ser mayor a tres caracteres y utilize solo letras';
  }

  //Validamos campo producto
  if ($producto == '') {
    $ok = false;
    $falta = '<strong>Elige un producto de tu interes</strong>';
  }

  // Validamos el campo telefono
  if ($telefono =='') {
    $ok = false;
    $falta = 'Falta el campo: <strong>Telefono</strong>';
  }
  if (!preg_match("/^[_\.0-9]{8,10}$/i", $telefono)) {
    $ok = false;
    $falta = 'No es un telefono Valido(debe ser de 8 a 10 digitos)';
  }


  // Validamos campo email y Checamos si el formato de correo es correcto
  if($email == ''){
    $ok = false;
    $falta = 'Falta el campo: <strong>Correo electrónico</strong>';
  }
  //
  if (!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,50}$/i", $email)){
    $ok = false;
    $falta = 'No es una cuenta de CORREO válida';
  }

  //Validamos el campo mensaje
  if ($mensaje == '') {
    $ok = false;
    $falta = 'Falta el campo:<strong>Mensaje</strong>';
  }
  if (!preg_match("/^[A-Za-z0-9!?,#$%@&-]/",$mensaje)) {
    $ok = false;
    $falta = 'El campo mensaje debe contener entre 5 y 100 caracteres';
  }
  
 




  if($ok == true){
    // ENVIAMOS EL MAIL
    //$data['para'] = 'soporte1@netweb.com.mx';
    $data['para'] = 'adgfolio@gmail.com';
    $data['asunto'] = 'Contacto desde WildClan';
    $data['mensaje'] = '<h3>Datos del contacto via wildclan.com.mx</h3><br>
    <br><strong>Nombre: </strong> '.$nombre.'
    <br><strong>E-mail: </strong> '.$email.'
    <br><strong>Telefono: </strong> '.$telefono.'
    <br><strong>Asunto: </strong> '.$producto.'
    <br><strong>Mensaje: </strong><br>
    <p style="text-align:left">'.$mensaje.'</p>
    ';


    // echo 'test 1-';
    $para = $data['para'];
    // Asunto
    $titulo = $data['asunto'];     
    // Cuerpo o mensaje
    $mensaje = load_page('correo_template.html');
    $_REPLACE['MENSAJE'] = $data['mensaje'];
    $mensaje = replace($mensaje,$_REPLACE);
    // Cabecera que especifica que es un HMTL
    $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
    $cabeceras .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
    // Cabeceras adicionales
    $cabeceras .= 'From: Formulario wildclan.com.mx <adgfolio@gmail.com>' . "\r\n";
    $cabeceras .= 'Cc:store.vintage777@gmail.com';
    //$cabeceras .= 'Bcc:sauron69.db@gmail.com';
      // enviamos el correo!
    if(mail($para, $titulo, $mensaje, $cabeceras)){
      echo true;  
    }else{
      echo 'Ocurrio un error al enviar el formulario, por favor intente mas tarde';
    }
    //  
  }else{
    echo $falta;
  }

}

//session_destroy();

function replace($template,$_DICTIONARY){
  foreach ($_DICTIONARY as $clave=>$valor) {
    $template = str_replace(':'.$clave.':', $valor, $template);
  }   
  return $template;
}

function load_page($page)
{
  return file_get_contents($page);
}

?>

