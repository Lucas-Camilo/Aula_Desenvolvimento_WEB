<?php
class usuario
{
    private $usuario;
    private $senha;
    private $nome;
    private $cat;
    function __construct($v_usuario, $v_senha, $v_nome, $v_cat)
    {
        $this->usuario = $v_usuario;
        $this->senha = $v_senha;
        $this->nome = $v_nome;
        $this->cat = $v_cat;
    }
    public function getUsuario()
    {
        return $this->usuario;
    }
    public function getSenha()
    {
        return $this->senha;
    }
    public function getNome()
    {
        return $this->nome;
    }
    public function getCat()
    {
        return $this->cat;
    }
    public function setUsuario($v_usuario)
    {
        $this->usuario = $v_usuario;
    }
    public function setSenha($v_senha)
    {
        $this->senha = $v_senha;
    }
    public function setNome($v_nome)
    {
        $this->nome = $v_nome;
    }
    public function setCat($v_cat)
    {
        $this->cat = $v_cat;
    }
}
