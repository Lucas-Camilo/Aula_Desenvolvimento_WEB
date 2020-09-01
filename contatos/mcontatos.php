<?php
include("cls_contatos.php");
include("cl_banco.php");
include("cls_tipo.php");
if (isset($_GET['op'])) $op = $_GET['op'];
else $op = "";
if ($op == "") {
    header("Location: index.php");
    exit;
}
include("vsessao.php");
if ($op == "ic") {
    $conec = conec::conecta_mysql("localhost", "root", "", "contatos");
    try {
        $conec->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sth = $conec->prepare("SELECT * FROM tipo");
        $sth->execute();

        print "<p align='center'>Incluir Contato</p>    
    <form method='post' action='mcontatos.php?op=iic'>
        <p align='center'>
		<br>Nome<input type='text' name='nome'
		             size='50' maxglength='50'>
                <br>Email<input type='email' name='email'
		             size='50' maxglength='50'>
		<br><select name='tipoc'>
                       <option value=''>Selecione um tipo";
        $linha = $sth->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_FIRST);
        do {
            $ous = new tipo($linha[0], $linha[1]);
            print "<option value='" . $ous->getIdt() . "'>" . $ous->getNomet();
        } while ($linha = $sth->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT));
        print "</select>
		<br><input type='submit' value='Incluir'>
        </p></form>";
    } catch (Exception $e) {
        print "<br>Falha:" . $e->getMessage();
        print "<br><a href='sistema.php'>Voltar</a>";
        exit;
    }
}
if ($op == "iic") {
    $mensagem = "";
    $contato = new contatos(null, $_POST['nome'], $_POST['email'], $_POST['tipoc']);
    if ($contato->getNomec() == "" || $contato->getEmailc() == "" || $contato->getTipoc() == "") {
        $mensagem .= "<br>Dados não preenchidos Corretamente";
        exit;
    }
    print $mensagem;
    print "<br><a href='mtipo.php?op=it'>Voltar</a>";
    $conec = conec::conecta_mysql("localhost", "root", "", "contatos");
    try {
        $conec->setAttribute(
            PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION
        );
        $sth = $conec->prepare("INSERT INTO contato values(?, ?, ?, ?)");
        $sth->execute(array(
            $contato->getIdc(),
            $contato->getNomec(),
            $contato->getEmailc(),
            $contato->getTipoc()
        ));
        print "<br> Contato Incluido com sucesso
            <br><a href='sistema.php'>Voltar para Inserção de Contato</a>";
    } catch (Exception $e) {
        print "Erro" . $e->getMessage() .
            "<br><br><a href='sistema.php'>Voltar</a>";
        exit;
    }
    exit;
}
if ($op == "lc") {
    $filter = $_POST["filter"];
    $conec = conec::conecta_mysql("localhost", "root", "", "contatos");
    try {
        $conec->setAttribute(
            PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION
        );
        if ($filter == "") {
            $sth = $conec->prepare("SELECT * FROM contato");
            
        } else {
            $sth = $conec->prepare("SELECT * FROM contato WHERE tipoc = :tip");
            $sth->bindParam(':tip', $filter);
        }
        $sth->execute();
        print "<table border='1'>
        <tr><td>ID</td><td>Nome</td><td>E-mail</td><td>tipo</td></tr>";
        if ($sth->rowCount() == 0) {
            print "<tr><td>Nada para Listar</td></tr>";
            exit;
        }
        $linha = $sth->fetch(
            PDO::FETCH_NUM,
            PDO::FETCH_ORI_FIRST
        );
        do {
            $ous = new contatos($linha[0], $linha[1], $linha[2], $linha[3]);
            print "<TR><TD>" . $ous->getIdc() . "</TD>" .
                "<TD>" . $ous->getNomec() . "</TD>" .
                "<TD>" . $ous->getEmailc() . "</TD>" .
                "<TD>" . $ous->getTipoc() . "</TD></TR>";
        } while ($linha = $sth->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT));
        print "</TABLE><br><a
        href='sistema.php'>Voltar</a>";
    } catch (Exception $e) {
        print "<br>Falha: Conntatos não listados" . $e->getMessage();
        print "<br><a href='sistema.php'>Voltar</a>";
        exit;
    }
    exit;
}
if ($op == "fc") {
    $conec = conec::conecta_mysql("localhost", "root", "", "contatos");
    try {
        $conec->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sth = $conec->prepare("SELECT * FROM tipo");
        $sth->execute();
        print "<p align='center'>Incluir Contato</p>    
        <form method='post' action='mcontatos.php?op=lc'>
        <p align='center'>
		<br><select name='filter'>
                       <option value=''>Selecione um tipo";
        $linha = $sth->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_FIRST);
        do {
            $ous = new tipo($linha[0], $linha[1]);
            print "<option value='" . $ous->getIdt() . "'>" . $ous->getNomet();
        } while ($linha = $sth->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT));
        print "</select>
		<input type='submit' value='Buscar'>
        </p></form>";
    } catch (Exception $e) {
        print "<br>Falha:" . $e->getMessage();
        print "<br><a href='sistema.php'>Voltar</a>";
        exit;
    }
}
