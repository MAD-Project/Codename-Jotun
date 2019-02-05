<?php 
    //Envia un texto html ejecutando un comando en PHP
    switch ($_POST["nuevoEstado"]) {
        case 'A':
            exec("echo '<h1>Egibide - Escuela de hosteleria</h1><br><h2>Hola " . $_POST['nombre'] . ". Su pedido ha sido confirmado.</h2> Se le enviará la fecha de recogida una vez preparado.<br>' | mail -s 'Pedido - Escuela Hosteleria\nContent-Type: text/html' " . $_POST['email'] ."");
        break;
        
        case 'R':
            exec("echo '<h1>Egibide - Escuela de hosteleria</h1><br><h2>Hola " . $_POST['nombre'] . ". Su pedido ha sido rechazado.</h2><br>' | mail -s 'Pedido - Escuela Hosteleria\nContent-Type: text/html' " . $_POST['email'] ."");
        break;

        default:
            exec("echo '<h1>Egibide - Escuela de hosteleria</h1><br><h2>Hola " . $_POST['nombre'] . ". Su pedido ya esta preparado.</h2>Puede recogerlo el día " + $_POST["fechaEntrega"] + " <br>' | mail -s 'Pedido - Escuela Hosteleria\nContent-Type: text/html' " . $_POST['email'] ."");
        break;
    }

    echo "El mensaje ha sido enviado a: " . $_POST['email'] . "";