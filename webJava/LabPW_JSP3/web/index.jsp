<%--
  Created by IntelliJ IDEA.
  User: Deeathex
  Date: 6/3/2018
  Time: 7:31 PM
  To change this template use File | Settings | File Templates.
--%>
<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<html>
  <head>
    <title>Login</title>
  </head>
  <body>
  <form action="LoginController" method="post">
    Username: <input type="text" name="username"> <BR><BR>
    Password: <input type="password" name="password"> <BR>
    <input type="submit" value="Login"/>
  </form>
  </body>
</html>
