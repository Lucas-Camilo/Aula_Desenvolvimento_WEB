<?php
$limite=60; // em segundos
session_start();
if (!isset($_SESSION['usuario']))
   {print "<H2>�rea restrita</H2>";
    print "<p><a href='index.php'>Login</a></p>";
    exit;}
else {$duracao=time() - $_SESSION['timeout'];
      if ($duracao > $limite)
         {session_destroy();
          header ("Location: index.php");}}
print "Ol� ".$_SESSION['nome']." resta ".
      ($limite - $duracao)." segundos"; 		  
?>