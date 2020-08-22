<?php
include ("cl_usuario.php");
include ("cl_banco.php");
if(isset($_GET['op'])) $op=$_GET['op'];
else $op="";
if ($op=="")
   {header("Location: index.php"); exit;}
if ($op=="asu")
   {print "<p align='center'>Alteração de Senha</p>
           <form method='post' action='musuario.php?op=aasu'>
		   <p align='center'>Login
		   <br>Usuário<input type='text' name='usuario'
		               size='8' maxglength='8'>
		   <br>Senha<input type='password' name='senha'
		             size='8' maxglength='8'>
		   <br>Nova Senha<input type='password' name='nsenha'
		                  size='8' maxglength='8'>
		   <br>Repetir<input type='password' name='rsenha'
		               size='8' maxglength='8'>
		   <br><input type='submit' value='Alterar'>
		   <br><a href='index.php'>Abandonar</a></p></form>";
	exit;}
if ($op=="aasu")
   {$usuario=new usuario($_POST['usuario'],$_POST['senha'],"","");
    $nsenha=$_POST['nsenha'];
    $rsenha=$_POST['rsenha'];
    if ($nsenha != $rsenha)
       {print "Senha redigitada diferente
	           <br><a href='index.php'>Voltar</a>";
		exit;}
	$conec=conec::conecta_mysql("localhost","root","","contatos");
    try
    {$conec->setAttribute(PDO::ATTR_ERRMODE,
                      PDO::ERRMODE_EXCEPTION);
     $sth=$conec->prepare("SELECT * FROM usuario WHERE
                   usuario='".$usuario->getUsuario()."' AND
				   senha=SHA1('".$usuario->getSenha()."')",
				   array(PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL));
     $sth->execute();
     if ($sth->rowCount()==0)
        {print "Usuário/senha inválidos";
         print "<br><a href='index.php'>Voltar</a>";     
         exit;}
	 $usuario->setSenha($nsenha);	 
     $sth=$conec->prepare("UPDATE usuario SET senha=?
                                  WHERE usuario=?");
     $sth->execute(array (SHA1($usuario->getSenha()),
                          $usuario->getUsuario()));
	 if ($sth->rowCount()==0)
         {print "Alteração não efetivada"; exit;}
	 print "Alteração feita";	 
	}catch(Exception $e){print $e->getMessage(); 
       print "<br><a href='index.php'>Voltar</a>"; exit;}
	   
exit;}
include("vsessao.php");
if ($_SESSION["cat"]!="00")
   {header("Location: index.php"); exit;}
if ($op=="iu")
 {print "<p align='center'>Novo Usuário</p>
         <form method='post' action='musuario.php?op=iiu'>
		 <p align='center'>
		 <br>Usuário<input type='text' name='usuario'
		             size='8' maxglength='8'>
		 <br>Nome<input type='text' name='nome'
		             size='50' maxglength='50'>
		 <br>Categoria:<select name='cat'>
                       <option value=''>Selecione
                       <option value='01'>Diretoria
                       <option value='02'>Chefia
                       <option value='03'>Subordinado
                       </select>						 
		 <br><input type='submit' value='Incluir'></p></form>";			   
 exit;}
if ($op=="iiu")
 {$mensagem="";
  $usuario=new usuario($_POST['usuario'],$_POST['usuario'],
                       $_POST['nome'],$_POST['cat']);
  if ($usuario->getUsuario()=="") 
      $mensagem.="<br>Usuário é obrigatório";					   
  if ($usuario->getNome()=="") 
      $mensagem.="<br>Nome é obrigatório";
  if ($usuario->getCat()=="") 
      $mensagem.="<br>Selecione a categoria";
  if ($mensagem!="")
      {print $mensagem; 
       print"<br><a href='musuario.php?op=iu'>Voltar</a>";
	   exit;}
  $conec=conec::conecta_mysql("localhost","root","","contatos");
  try
   {$conec->setAttribute(PDO::ATTR_ERRMODE,
                         PDO::ERRMODE_EXCEPTION);
	$sth=$conec->prepare("INSERT INTO usuario values(?,?,?,?)");
    $sth->execute(array ($usuario->getUsuario(),
	                     SHA1($usuario->getSenha()),
                         $usuario->getNome(),
 						 $usuario->getCat()));
	print "<br>Usuório incluido com sucesso 
	       <br><a href='sistema.php'>Voltar</a>";					 
   }catch (Exception $e) 
           {print "Erro ".$e->getMessage().
                  "<br><a href='sistema.php'>Voltar</a>";
			exit;}	
        	
 exit;}
if($op=="lu")
{$conec=conec::conecta_mysql("localhost","root","","contatos");
 try
 {$conec->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  $sth=$conec->prepare("SELECT * FROM usuario");
  $sth->execute();
  print "<table border='1'>
		<tr><td>Usuário</td><td>Nome</td><td>Categoria</td></tr>";
  if($sth->rowCount()==0){print "<tr><td>Nada para listar</td></tr>}";
						  exit;}
  $linha=$sth->fetch(PDO::FETCH_NUM,PDO::FETCH_ORI_FIRST);
  do{$ous=new usuario($linha[0],"",$linha[2],$linha[3] );
	  print "<TR><TD>".$ous->getUsuario()."</TD>".
				"<TD>".$ous->getNome()."</TD>".
				"<TD>".$ous->getCat()."</TD></TR>";
	  }while($linha=$sth->fetch(PDO::FETCH_NUM,PDO::FETCH_ORI_NEXT));
  print"</TABLE><br><a
		href='sistema.php'>Voltar</a>";
 }catch(Exception $e){
		print"<br>Falha: Usuarios não listados".$e->getMessage();
		print"<br><a href='sistema.php'>Voltar</a>";
	 exit;}
exit;}
if($op=="eu")
{$conec=conec::conecta_mysql("localhost","root","","contatos");
try
{$conec->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
 $sth=$conec->prepare("SELECT * FROM usuario");
  $sth->execute();
  if($sth->rowCount()==0) //possui somente o Administrador
  {print " <p>Nenhum usuario para excluir</p> ";
   print " <br><a href='sistema.php'>Voltar</a> ";
   exit;}
  print "<form method='post' action='musuario.php?op=eeu'>
		 <select name='usuario>
		 <option value=''>Selecione para excluir";
  $linha=$sth->fetch(PDO::FETCH_NUM,PDO::FETCH_ORI_FIRST);
  do{$ous=new usuario($linha[0],"",$linha[2],$linha[3]);
		if($ous->getCat() !="00")
		print "<option value='".$ous->getUsuario().
		"'>".$ous->getNome();
	}while($linha=$sth->fetch(PDO::FETCH_NUM,PDO::FETCH_ORI_NEXT));
	print "</SELECT<br><input type='submit' value='Excluir'
		   </form><br><a href='sistema.php'>Voltar</a>";
}catch(Exception $e){
		print"<br>Falha:".$e->getMessage();
		print"<br><a href='sistema.php'>Voltar</a>";
	 exit;}
exit;}
if($op=="eeu")
{$volta="musuario.php?op=eu";
 $usuario = new usuario($_POST["usuario"],"","","","");
 if($usuario->getusuario()==""){print "Selecione um usuario para Excluir";
								print "<br><a href='sistema.php'>Voltar</a>";exit;}
	$conec=conec::conecta_mysql("localhost","root","","contatos");
	try{$conec->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		$sth=$conec->prepare("DELETE FROM usuario WHERE usuario=?");
		$sth->execute(array($usuario->getUsuario()));
		if($sth->rowCount()==0) print "Usuario não excluido";
		else print "Usuario ".$usuario->getnome()." Ecluido com sucesso";
		print "<br><a href='sistema.php'>Voltar</a>";
		}catch(Exception $e){print "<br>Falha: Usuário não excluido ".$e->getMessage().
			"<br><a href='sistema.php'>Voltar</a>";exit;}							
exit;}
if($op=="au")
    {$conec=conec::conecta_mysql("localhost", "root", "", "contatos");
        try{ $conec->setAttribute(PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION);
            print "<h2>Alteração de usuário</h2>";
            $sth=$conec->prepare("SELECT * FROM usuario WHERE cat <>
                                '00'",
            array(PDO::ATTR_CURSOR=> PDO::CURSOR_SCROLL));
            $sth->execute();
            if($sth->rowCount()==0)
            {print "Nenhum usuario para alterar
                <br><a href='sistema.php'>Voltar</a>";
                exit;}
            $linha = $sth->fetch(PDO::FETCH_NUM,
            PDo::FETCH_ORI_FIRST);
            print "<form method='post' action='musuario.php?op=aeu'>";
            print "<SELECT name='usuario'><OPTION value=>
            Selecione para alterar";
            do{$ous=new usuario($linha[0],"", $linha[2], $linha[3]);
                print "<option value='".$ous->getUsuario().
                "'>".$ous->getNome();
            }while ($linha=$sth->fetch(PDO::FETCH_NUM,
                    PDO::FETCH_ORI_NEXT));
            print "</SELECT <INPUT type='submit' value='Editar'></form>
                    <br><a href='sistema.php'>Voltar</a>";                
        }catch (PDOException $e){print"<br>Falha: ".
            $e->getMessage()."<br>
            <a href='sistema.php'>Voltar</a>";
        exit;}
    exit;}
if($op=="aeu")
{$usuario=$_POST["usuario"];
    $conec=conec::conecta_mysql("localhost", "root", "", "contatos");
    try{$conec->setAttribute(PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION);
    $sth=$conec->prepare("SELECT * FROM usuario WHERE
                        usuario='$usuario'",
                        array(PDO::ATTR_CURSOR =>
                        PDO::CURSOR_SCROLL));
    $sth->execute();
    $linha = $sth->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_FIRST);
    $ous= new usuario($linha[0],"",$linha[2], $linha[3]);
    print "<h2>Alteração de usuário</h2>";;
    print "<form method='post'
            action='musuario.php?op=acu'>";
    print "Usuario:<INPUT type='text' name='usuario'
            value ='".$ous->getUsuario();"'readonly>";
    print "Nome: <INPUT type='text' name='nome'
    value='".$linha[2]."'>";
    print "Categoria: <SELECT name='cat'";
    if($ous->getCat()=="01")
        print "<OPTION value='01' selected>Diretoria";
    else print "<OPTION value='01'>Diretoria";
    if($ous->getCat()=="02")
        print "<OPTION value='02' selected>Chefia";
    else print "<OPTION value='02'>Chefia";
    if($ous->getCat()=="03")
        print "<OPTION value='03' selected>Subordinado";
    else print "<OPTION value='03'>Subordinado";
    print "</SELECT><INPUT type='submit' value='Confirmar'></form>
        <br><a href='sistema.php'>Voltar</a>";
    }catch(PDOException $e)
        {print "<br>Falha: ".$e->getMessage().
                "<br><a href='sistema.php'>Voltar</a>";
            exit;}
    exit;}
if($op=="acu")
{$ous = new usuario($_POST["usuario"],"",$_POST["nome"],$_POST["cat"]);
    if($ous->getusuario()=="") print "<br>Selecione um usuario para Alterar";
    if($ous->getnome()=="") print "<br>O nome não pode ficar em branco";
    if($ous->getcat()=="") print "<br>Selecione uma categoria";
    if($ous->getusuario()=="" || $ous->getnome()=="" || $ous->getcat()=="")
    { print "<br><a href='sistema.php'>Voltar</a>";exit;}
    $conec=conec::conecta_mysql("localhost", "root", "", "contatos");
    try{$conec->setAttribute(PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION);
        $sth=$conec->prepare("UPDATE usuario set nome=?, cat=? WHERE
        usuario=?");
        $sth->execute(array($ous->getnome(),
        $out->getcat(),
        $ous->getusuario()));
    if($sth->rowCount()==0) print "<br> Usuario não alterado";
    else print "<br>Usuário ".$ous->getnome()." Alterar com sucesso";
    print "<br><a href='sistema.php'>Voltar</a>";
    }catch (Exception $e)
    {print "<br>Falha: Usuário não excluido
        ".$e->getMessage().
        "<br><a href='sistema.php'> Voltar </a>";
    exit;}
    exit;}
print "<br>Não implementado";	
?>
