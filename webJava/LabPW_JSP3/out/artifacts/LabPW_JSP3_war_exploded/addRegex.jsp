<%--
  Created by IntelliJ IDEA.
  User: Deeathex
  Date: 6/3/2018
  Time: 8:02 PM
  To change this template use File | Settings | File Templates.
--%>
<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<html>
<head>
    <title>Manage filter</title>
</head>
<body>
<div>
    <%
        out.println("<p>Insert a regex to add in database:</p><br>");
        out.println("<form action=\"RegexController\" method=\"post\"> " +
                "<input type=\"text\" name=\"regex\">" +
                "<input type=\"submit\" value=\"Add regex\"/> " +
                "</form>");
    %>
</div>
</body>
</html>
