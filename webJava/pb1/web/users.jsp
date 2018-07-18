<%@ page import="model.User" %>
<%@ page import="java.util.List" %><%--
  Created by IntelliJ IDEA.
  User: nicuc
  Date: 6/3/2018
  Time: 6:48 PM
  To change this template use File | Settings | File Templates.
--%>
<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<html>
<head>
    <title>Users</title>
</head>
<body>

<%
    List<User> users = (List<User>)request.getAttribute("users");
    for (User u : users) {
        out.println(u + "<br/>");
    }
%>

</body>
</html>
