/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package dao;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.List;

/**
 *
 * @author User
 */
public class musuario {

    /*--------Consulta Usuario -------------- */
    public static List cusuario(Usuario us) throws SQLException {
        Connection conn = null;
        /* Criando uma lista para armazenar dados lidos na tabela usuario */
        List<Usuario> ListaUsuario = new ArrayList<>();
        try {
            conn = ConexaoManutencao.getConexao();
            String sql = "SELECT * FROM usuario";
            sql += " WHERE usuario='" + us.getUsuario() + "'";
            sql += " AND senha=sha1('" + us.getSenha() + "')";
            System.out.println(sql);
            Statement st = conn.createStatement();
            ResultSet rs = st.executeQuery(sql);
            rs.first();
            do {
                Usuario u = new Usuario();
                /* Preenchendo a lista com dados lidos*/

                u.setUsuario(rs.getString("usuario"));
                u.setNome(rs.getString("nome"));
                u.setCat(rs.getString("cat"));
                System.out.println(u.getNome());
                ListaUsuario.add(u);
            } while (rs.next());
            return ListaUsuario;/*Devolvendo a lista*/
        } catch (Exception e) {
            return ListaUsuario;
        }

    }

    public static String iusuario(Usuario us) {
        Connection conn = null;
        try {
            conn = ConexaoManutencao.getConexao();
            String sql = "INSERT INTO usuario (usuario, senha,nome, cat) "
                    + "values (?,sha1(?),?,?)";
            PreparedStatement stmt = conn.prepareStatement(sql);
            stmt.setString(1, us.getUsuario());
            stmt.setString(2, us.getSenha());
            stmt.setString(3, us.getNome());
            stmt.setString(4, us.getCat());
            stmt.execute();
            stmt.close();
            ConexaoManutencao.closeAll(conn);
            return "Usuário Incluido";
        } catch (Exception e) {
            String msg = "Erro: " + e;
            return msg;
        }
    }
}
