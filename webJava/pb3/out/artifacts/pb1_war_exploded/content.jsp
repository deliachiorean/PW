<%--
  Created by IntelliJ IDEA.
  User: nicuc
  Date: 6/3/2018
  Time: 11:08 PM
  To change this template use File | Settings | File Templates.
--%>
<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<html>
<head>
    <title>Stuff</title>
</head>
<body>

<%
    String content = (String)request.getAttribute("output");
    out.println("<p>"+ content+"</p>");
%>
<a href="/login.html">login</a>

</body>
</html>
