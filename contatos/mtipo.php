<?php
include("cls_tipo.php");
include("cls_banco.php");
if (isset($_GET['op'])) $op = $_GET['op'];
else $op = "";
if ($op == "") {
    header("Location: index.php");
    exit;
}
include("vsessao.php");
if ($op == "it") {
    print "<p align='center'>Novo Tipo</p>
    <form method='post' action='mutipo.php?op=iit'>
    <p align='center'>
    <br>ID<input type='text' name='idt'
                size='8'  maxglength='10'>
    <br>Nome<input type='text' name='nomet'
                size='8'  maxglength='10'>
    <br><input type='submit' value='Incluir'></p></form>";
    exit;
}
if ($op == "iit") {
    $mensagem = "";
    $tipo = new tipo(
        $_POST['idt'],
        $_POST['nomet']
    );
    if ($tipo->getNomet() == "") {
        $mensagem .= "<br>Nome do tipo é obrigatório";
    }
    print $mensagem;
    print "<br><a href='mutipo.php?op=it'>Voltar</a>";
    $conec = conec::conecta_mysql("localhost", "root", "", "contatos");
    try {
        $conec->setAttribute(
            PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION
        );
        $sth = $conec->prepare("INSERT INTO tipo values(?)");
        $sth->execute(array(
            $tipo->getNomet()
        ));
        print "<br> Tipo Incluido com sucesso
            <br><a href='sistema.php'>Voltar</a>";
    } catch (Exception $e) {
        print "Erro" . $e->getMessage() .
            "<br><a href='sistema.php'>Voltar</a>";
        exit;
    }
    exit;
}
if ($op == "lt") {
    $conec = conec::conecta_mysql("localhost", "root", "", "contatos");
    try {
        $conec->setAttribute(
            PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION
        );
        $sth = $conec->prepare("SELECT * FROM tipo");
        $sth->execute();
        print "table border='1'>
        <tr><td>ID</td><td>Tipo</td</tr>";
        if ($sth->rowCount() == 0) {
            print "<tr><td>Nada para Listar</td></tr>";
            exit;
        }
        $linha = $sth->fetch(
            PDO::FETCH_NUM,
            PDO::FETCH_ORI_FIRST
        );
        do {
            $ous = new tipo($linha[0], $linha[1]);
            print "<TR><TD>".$ous->getIdt()."</TD>".
            "<TD>" . $ous->getNomet() . "</TD></TR>";
        } while ($linha = $sth->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT));
        print "</TABLE><br>a
        href='sistema.php'>Voltar</a>";
    } catch (Exception $e) {
        print "<br>Falha: Usuarios não listados" . $e->getMessage();
        print "<br><a href='sistema.php'>Voltar</a>";
        exit;
    }
    exit;
}
if($op == "et")
{
    $conec = conec::conecta_mysql("localhost", "root", "", "contatos");
    try
    {
        $conec->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sth = $conec->prepare("SELECT * FROM tipo");
        $sth->execute();
        if ($sth->rowCount() == 0) //Tipos Vazios
        {
            print " <p>Nenhum tipo para excluir</p> ";
            print " <br><a href='sistema.php'>Voltar</a> ";
            exit;
        }
        print "<form method='post' action='mtipo.php?op=eet'>
		 <select name='idt'>
         <option value=''>Selecione para excluir";
         $linha = $sth->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_FIRST);
        do {
            $ous = new tipo($linha[0], $linha[1]);
            print "<option value'".$ous->getNomet()."'>";
        } while ($linha = $sth->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT));
        print "</SELECT<br><input type='submit' value='Excluir'
		   </form><br><a href='sistema.php'>Voltar</a>";
    }catch (Exception $e)
    {
        print "<br>Falha:" . $e->getMessage();
        print "<br><a href='sistema.php'>Voltar</a>";
        exit;
    }
    exit;
}
if ($op == "eet") {
    $volta = "mtipo.php?op=eu";
    $usuario = new tipo($_POST["idt"], "");
    if ($usuario->getNomet() == "") {
        print "Selecione um tipoo para Excluir";
        print "<br><a href='sistema.php'>Voltar</a>";
        exit;
    }
    $conec = conec::conecta_mysql("localhost", "root", "", "contatos");
    try {
        $conec->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sth = $conec->prepare("DELETE FROM tipo WHERE idt=?");
        $sth->execute(array($usuario->getIdt()));
        if ($sth->rowCount() == 0) print "Usuario não excluido";
        else print "Tipo: " . $usuario->getNomet() . " Ecluido com sucesso";
        print "<br><a href='sistema.php'>Voltar</a>";
    } catch (Exception $e) {
        print "<br>Falha: Tipo não excluido " . $e->getMessage() .
            "<br><a href='sistema.php'>Voltar</a>";
        exit;
    }
    exit;
}
if ($op == "at") {
    $conec = conec::conecta_mysql("localhost", "root", "", "contatos");
    try {
        $conec->setAttribute(
            PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION
        );
        print "<h2>Alteração de tipo</h2>";
        $sth = $conec->prepare(
            "SELECT * FROM tipo",
            array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL)
        );
        $sth->execute();
        if ($sth->rowCount() == 0) {
            print "Nenhum tipo para alterar
                <br><a href='sistema.php'>Voltar</a>";
            exit;
        }
        $linha = $sth->fetch(
            PDO::FETCH_NUM,
            PDo::FETCH_ORI_FIRST
        );
        print "<form method='post' action='mtipo.php?op=aet'>";
        print "<SELECT name='idt'><OPTION value=>
            Selecione para alterar";
        do {
            $ous = new tipo($linha[0], $linha[1]);
            print "<option value='" . $ous->getIdt() .
                "'>" . $ous->getNomet();
        } while ($linha = $sth->fetch(
            PDO::FETCH_NUM,
            PDO::FETCH_ORI_NEXT
        ));
        print "</SELECT <INPUT type='submit' value='Editar'></form>
                    <br><a href='sistema.php'>Voltar</a>";
    } catch (PDOException $e) {
        print "<br>Falha: " .
            $e->getMessage() . "<br>
            <a href='sistema.php'>Voltar</a>";
        exit;
    }
    exit;
}
if ($op == "aet") {
    $idt = $_POST["idt"];
    $conec = conec::conecta_mysql("localhost", "root", "", "contatos");
    try {
        $conec->setAttribute(
            PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION
        );
        $sth = $conec->prepare(
            "SELECT * FROM usuario WHERE
                        idt='$idt'",
            array(PDO::ATTR_CURSOR =>
            PDO::CURSOR_SCROLL)
        );
        $sth->execute();
        $linha = $sth->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_FIRST);
        $ous = new tipo($linha[0], $linha[1]);
        print "<h2>Alteração de Tipo</h2>";;
        print "<form method='post'
            action='musuario.php?op=act'>";
        print "Usuario:<INPUT type='text' name='idt'
            value ='" . $ous->getIdt();
        "'readonly>";
        print "Nome: <INPUT type='text' name='nomet'
    value='" .$linha[1]. "'>";
        print "<INPUT type='submit' value='Confirmar'></form>
        <br><a href='sistema.php'>Voltar</a>";
    } catch (PDOException $e) {
        print "<br>Falha: " . $e->getMessage() .
            "<br><a href='sistema.php'>Voltar</a>";
        exit;
    }
    exit;
}
if ($op == "act") {
    $ous = new tipo($_POST["idt"], $_POST["nomet"]);
    if ($ous->getIdt() == "") print "<br>Selecione um tipo para Alterar";
    if ($ous->getNomet() == "") print "<br>O nome não pode ficar em branco";
    if ($ous->getIdt() == "" || $ous->getNomet() == "") {
        print "<br><a href='sistema.php'>Voltar</a>";
        exit;
    }
    $conec = conec::conecta_mysql("localhost", "root", "", "contatos");
    try {
        $conec->setAttribute(
            PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION
        );
        $sth = $conec->prepare("UPDATE tipo set nomet=? WHERE idt=?");
        $sth->execute(array(
            $ous->getNomet(),
            $ous->getIdt()
        ));
        if ($sth->rowCount() == 0) print "<br> Tipo não alterado";
        else print "<br>Tipo: " . $ous->getNomet() . " Alterar com sucesso";
        print "<br><a href='sistema.php'>Voltar</a>";
    } catch (Exception $e) {
        print "<br>Falha: Tipo não excluido
        " . $e->getMessage() .
            "<br><a href='sistema.php'> Voltar </a>";
        exit;
    }
    exit;
}
print "<br>Não implementado";
