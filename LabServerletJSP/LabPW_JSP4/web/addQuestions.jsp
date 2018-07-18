<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<html>
<head>
    <title>Questions</title>
</head>
<body>
<div>
    <%
        out.println("<p>adauga o noua intrebare:</p><br>");
        out.println("<form action=\"TestController\" method=\"post\"> " +
                "Intrebare:<br>"+
                "<input type=\"text\" name=\"question\"><br>" +
                "varianta1:<br>"+
                "<input type=\"text\" name=\"answer1\"><br>" +
                "varianta2:<br>"+
                "<input type=\"text\" name=\"answer2\"><br>" +
                "varianta3:<br>"+
                "<input type=\"text\" name=\"answer3\"><br>" +
                " raspunsul corect:  <br>"+
                "<input type=\"text\" name=\"corect\"><br><br>"+
                "<input type=\"submit\" value=\"adauga intrebarea\"/> " +
                "</form>");
    %>
</div>
</body>
</html>
