/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package dao;

/**
 *
 * @author User
 */
public class Usuario {

    private String usuario;
    private String senha;
    private String nome;
    private String cat;
    
    public Usuario(){}
    
    public Usuario(String v_usuario, String v_senha, String v_nome,
            String v_cat) {
        this.usuario = v_usuario;
        this.senha = v_senha;
        this.nome = v_nome;
        this.cat = v_cat;
    }

    public void setUsuario(String v_usuario) {
        this.usuario = v_usuario;
    }

    public void setSenha(String v_senha) {
        this.senha = v_senha;
    }

    public void setNome(String v_nome) {
        this.nome = v_nome;
    }

    public void setCat(String v_cat) {
        this.cat = v_cat;
    }

    public String getUsuario() {
        return usuario;
    }

    public String getSenha() {
        return senha;
    }

    public String getNome() {
        return nome;
    }

    public String getCat() {
        return cat;
    }
}
