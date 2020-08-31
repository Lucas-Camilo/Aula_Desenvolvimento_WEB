<html>

<body>
    <?php
    include("vsessao.php");
    if ($_SESSION['cat'] == "00") {
        print "<H1 align='center'>Área do Administrador</H1>
           <a href='musuario.php?op=iu'>Novo</a>
           <a href='musuario.php?op=eu'>Excluir</a>
           <a href='musuario.php?op=au'>Alterar</a>
               <a href='musuario.php?op=lu'>Listar</a>Usuário";
    }
    print "<br> <a href='mtipo.php?op=it'>Inclusão de tipo </a>
        <a href='mtipo.php?op=it'>Novo</a>
        <a href='mtipo.php?op=et'>Excluir</a>
        <a href='mtipo.php?op=at'>Alterar</a>
        <a href='mtipo.php?op=lt'>Listar</a>";

    print "<br> <a href='mcontatos.php'>Inclusão de tipo </a>";
    ?>
    <p align="center"><a href="index.php">Logoff</a></p>
</body>

</html>