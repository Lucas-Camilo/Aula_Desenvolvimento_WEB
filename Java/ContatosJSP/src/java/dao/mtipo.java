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
public class mtipo {

    public static List ltipo(Usuario us) throws SQLException {
        Connection conn = null;
        List<Tipo> ListaTipo = new ArrayList<>();
        try {
            conn = ConexaoManutencao.getConexao();
            String sql = "SELECT idt, nomet FROM tipo";
            System.out.println(sql);
            Statement st = conn.createStatement();
            ResultSet rs = st.executeQuery(sql);
            rs.first();
            do {
                Tipo t = new Tipo();
                t.setIdt(rs.getString("idt"));
                t.setNomet(rs.getString("nomet"));
                System.out.println(t.getNomet());
                ListaTipo.add(t);
            } while (rs.next());
            return ListaTipo;
        } catch (Exception e) {
            return ListaTipo;
        }
    }

    public static String itipo(Tipo nt) {
        Connection conn = null;
        try {
            conn = ConexaoManutencao.getConexao();
            String sql = "INSERT INTO tipo (idt, nomet) values(?,?)";
            PreparedStatement stmt = conn.prepareStatement(sql);
            stmt.setString(1, nt.getIdt());
            stmt.setString(2, nt.getNomet());
            stmt.execute();
            stmt.close();
            ConexaoManutencao.closeAll(conn);
            return "Tipo Incluido com sucesso";
        } catch (Exception e) {
            String msg = "Erro: " + e;
            return msg;
        }
    }
}
