/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package servlets;

import dao.Usuario;
import dao.musuario;

import java.io.IOException;
import java.io.PrintWriter;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

/**
 *
 * @author User
 */
@WebServlet(name = "ServUsuario", urlPatterns = {"/ServUsuario"})
public class ServUsuario extends HttpServlet {

    /**
     * Processes requests for both HTTP <code>GET</code> and <code>POST</code>
     * methods.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    protected void processRequest(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        response.setContentType("text/html;charset=UTF-8");
        String op = request.getParameter("op"); //Pega a Opção
        String msg = ""; // Cria variável para mensagens
        try (PrintWriter out = response.getWriter()) {
            if ("iu".equals(op)) { //Apresentando o formulário de inclusão
                msg += "<!DOCTYPE html>";
                msg += "<form method='post' action='ServUsuario?op=iiu'>";
                msg += "<p>Usuário:<input type='text' name='usuario'> ";
                msg += "Nome:<input type='text' name='nome'> ";
                msg += "Categoria<select name='cat'>";
                msg += "<option value='10'>Gerente";
                msg += "<option value='20'>Atendente";
                msg += "<input type='submit' value='Incluir'>";
                msg += "</p></select></form>";
                out.println(msg + "<p><a href='musuario.jsp'>Voltar</a>");
            }
            if ("iiu".equals(op)) {
                /* Na inclusão de novo usuário a senha será igual ao usuário  */
                Usuario ous = new Usuario(request.getParameter("usuario"),
                        request.getParameter("usuario"),
                        request.getParameter("nome"),
                        request.getParameter("cat"));
                if ("".equals(ous.getUsuario()) || "".equals(ous.getNome())
                        || "".equals(ous.getCat())) {
                    msg += "Dado(s) em branco<br>";
                    out.println(msg + "<p><a href='ServUsuario?op=iu'>Voltar</a>");
                } else { //msg=musuario.iusuario(ous); 
                    //Chama o método iusuario que vamos implementar a seguir
                    //Retorma erro ou Inclusão ok
                    out.println(msg + "<p><a href='ServUsuario?op=iu'>Voltar</a>");
                }
            }
        }
    }

    // <editor-fold defaultstate="collapsed" desc="HttpServlet methods. Click on the + sign on the left to edit the code.">
    /**
     * Handles the HTTP <code>GET</code> method.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        processRequest(request, response);
    }

    /**
     * Handles the HTTP <code>POST</code> method.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        processRequest(request, response);
    }

    /**
     * Returns a short description of the servlet.
     *
     * @return a String containing servlet description
     */
    @Override
    public String getServletInfo() {
        return "Short description";
    }// </editor-fold>

}
