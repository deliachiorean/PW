<%@ page import="model.DBUtils" %>
<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<html>
<head>
    <title>Result</title>
</head>
<body>
    <%
        String received=(String) request.getAttribute("corect");
        int corect=Integer.parseInt(received);
        DBUtils dbUtils=new DBUtils();
        int total=dbUtils.numberOfQuestions();
        out.println("Felicitari! "+corect+" din "+total);
    %>
    <br>
    <a href="/">Try again</a>
</body>
</html>
