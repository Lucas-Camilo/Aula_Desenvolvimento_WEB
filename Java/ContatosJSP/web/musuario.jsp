<%-- Document   : sistema    Author     : Rolando --%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Contatos</title>
    </head>
    <body>
        <%//Verifica se está logado
            if (session.getAttribute("sesusu") != null) {
                out.println("Olá " + session.getAttribute("sesnom")
                        + " Cat " + session.getAttribute("sescat"));
            } else {
                response.sendRedirect("index.html");
            }  %> 
        <H1 align="center"> Sistema de Contatos</H1>
            <% //Opões do Administrador
                if ("00".equals(session.getAttribute("sescat"))) {
                    out.println("<H2>Área do Administrador</H2><br>");
                    out.println("<A href='ServUsuarios?op=op'>Manutenção de Usuários</A><br>");
                    out.println("<A href='sistema.jsp'>Voltar</A><br>");
           }%>
        <br><A href='index.html'>Logout</A>
    </body></html>
