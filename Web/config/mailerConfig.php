<?php 
    //Envia un texto html ejecutando un comando en PHP
    exec("echo '<h1>Egibide - Escuela de hosteleria</h1><br><h2>Su pedido ha sido confirmado.</h2> Puede pasar a recogerlo dentro de 4 días laborables.<br>' | mail -s 'This is the subject\nContent-Type: text/html' " . $_POST['email'] ."");

    echo "echo '<h1>Egibide - Escuela de hosteleria</h1><br><h2>Su pedido ha sido confirmado.</h2> Puede pasar a recogerlo dentro de 4 días laborables.<br>' | mail -s 'This is the subject\nContent-Type: text/html' " . $_POST['email'] ."";