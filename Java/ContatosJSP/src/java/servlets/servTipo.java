/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package servlets;

import dao.Tipo;

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
@WebServlet(name = "servTipo", urlPatterns = {"/servTipo"})
public class servTipo extends HttpServlet {

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
        String op = request.getParameter("op");
        String msg = "";
        try (PrintWriter out = response.getWriter()) {
            if ("it".equals(op)) {
                msg += "<p align='center'>Novo Tipo</p>";
                msg += "<form method='post' action='servtipo?op=iit'>";
                msg += "<p align='center'>";
                msg += "<br>ID<input type='text' name='idt'"
                        + "                size='8'  maxglength='10'>";
                msg += "<br>Nome<input type='text' name='nomet'"
                        + "                size='8'  maxglength='10'>";
                msg += "<br><input type='submit' value='Incluir'></p></form>";
                out.println(msg + "<p><a href='mtipo.jsp'>Voltar</a>");
            }
            if ("iit".equals(op)) {
                Tipo oti = new Tipo(request.getParameter("idt"),
                        request.getParameter("nomet"));
                if ("".equals(oti.getIdt()) || "".equals(oti.getNomet())) {
                    msg += "Dados em Branco";
                    out.println(msg+ "<p><a href='servTipo?op=it'>Voltar</a>");
                }else {
                    out.println(msg + "<p><a href='servTipo?op=it'>Voltar</a>");
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
