<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<html>
<head>
    <title>Title</title>
</head>
<body>

<%
    String helloMessage = (String) request.getAttribute("helloMessage");
    for (int i = 0; i < 10; i++) {
        out.println(helloMessage + "<br/>");
    }
%>

<br/>

<a href="login.html">Go to login page</a>

</body>
</html>
