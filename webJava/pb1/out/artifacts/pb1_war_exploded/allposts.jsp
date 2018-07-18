<%@ page import="model.Comment" %>
<%@ page import="java.util.List" %><%--
  Created by IntelliJ IDEA.
  User: nicuc
  Date: 6/3/2018
  Time: 8:39 PM
  To change this template use File | Settings | File Templates.
--%>
<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<html>
<head>
    <title>Admin comments</title>
    <style>
        .hidden {
            display: none;
        }
    </style>
</head>
<body>

<%
    //generate comments for admin to accept
    List<Comment> comments = (List<Comment>)request.getAttribute("comments");
    for (Comment comment : comments) {
        if (comment.getAccepted() == 0) {
            out.println("<h3>" + comment.getEmail() + " says</h3>");
            out.println("<p class=\"comment\">" + comment.getComment() + "</p>");
            out.println("<form action=\"ValidationController\" method=\"post\">");
            out.println("<input type=\"text\" name=\"id\" class=\"hidden\" value=\""+ comment.getId() +"\">");
            out.println("<input type=\"submit\" value=\"accept\">");
            out.println("</form>");
        }

    }
%>

</body>
</html>
