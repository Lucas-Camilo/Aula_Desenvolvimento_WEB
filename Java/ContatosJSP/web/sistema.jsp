<%-- Document   : sistema    Author     : Rolando --%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Sistema Contatos</title>
    </head>
    <body>
        <%//Verifica se está logado. Se não desvia para index.html para logar
            if (session.getAttribute("sesusu") != null) {
                out.println("Olá " + session.getAttribute("sesnom")
                        + " Cat " + session.getAttribute("sescat"));
            } else {
                response.sendRedirect("index.html");
            }
        %>    
        <H1 align="center"> Sistema de Contatos</H1>
        <H3 align="Center"> Manutenção de Tabelas</H3>
        <P align="Center"><A href="mtipo.jsp">Manutenção de Tipos</A></P>
        <P align="Center"><A href="mcontato.jsp">Manutenção de Contatos</A></P>
        <% //Opões do Administrador
            if ("00".equals(session.getAttribute("sescat"))) 
            {
                out.println("<H2>Área do Administrador</H2><br>");
                out.println("<A href='musuario.jsp'>Manutenção de usuários</A><br>");
            } 
        %>
        <br><A href='index.html'>Logout</A>    
    </body></html>

