<%-- 
    Document   : mtipo
    Created on : 05/10/2020, 21:00:56
    Author     : Lucas
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Manutenção de Tipos</title>
    </head>
    <body>
        <%//Verifica se está logado
            if (session.getAttribute("sesusu") != null) {
                out.println("Olá " + session.getAttribute("sesnom")
                        + " Cat " + session.getAttribute("sescat"));
            } else {
                response.sendRedirect("index.html");
            }
        
        out.println("<A href='servTipo?op=op'>Inclusão de Tipo</A><br>");
        out.println("<A href='sistema.jsp'>Voltar</A><br>");
        %>
    </body>
</html>
