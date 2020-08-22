<html>
<body>
<?php
include("vsessao.php");
if ($_SESSION['cat']=="00")
   {print "<H1 align='center'>Área do Administrador</H1>
           <a href='musuario.php?op=iu'>Novo</a>
           <a href='musuario.php?op=eu'>Excluir</a>
           <a href='musuario.php?op=au'>Alterar</a>
               <a href='musuario.php?op=lu'>Listar</a>Usuário";}
print "<br> <a href='mtipo.php'>Inclusãotip </a>"
?>
<p align="center"><a href="index.php">Logoff</a></p>
</body>
</html>