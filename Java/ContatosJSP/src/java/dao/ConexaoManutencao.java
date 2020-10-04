/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package dao;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

/**
 *
 * @author User
 */
public class ConexaoManutencao {

    private static final String STR_DRIVER = "com.mysql.jdbc.Driver";
    private static final String USER = "root";
    private static final String PASSWORD = "";
    private static final String IP = "localhost";
    private static final String DATABASE = "Contatos";
    private static final String STR_CON
            = "jdbc:mysql://" + IP + ":3306/" + DATABASE;

    public static Connection getConexao() throws SQLException {
        Connection conn = null;
        try {
            Class.forName(STR_DRIVER);
            conn = DriverManager.getConnection(STR_CON, USER, PASSWORD);
            System.out.println("Obtendo conexao...");
            return conn;
            // acima obtenho uma conexao passando os parametros do 
            // database, usuario e senha
        } catch (ClassNotFoundException e) {
            String errormsg = "Driver não encontrado";
            throw new SQLException(errormsg, "\n" + e);
        } catch (SQLException e) {
            String errormsg = "Erro ao obter a conexão";
            throw new SQLException(errormsg, "\n" + e);
        }
    }

    public static void closeAll(Connection conn) {
        try {
            if (conn != null) {
                conn.close();
            }
        } catch (Exception e) {
            e.printStackTrace();
        }
    }
}
