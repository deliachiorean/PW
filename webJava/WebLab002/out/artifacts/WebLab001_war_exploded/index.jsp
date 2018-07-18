<%@page contentType="text/html" pageEncoding="UTF-8"%>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Captcha</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div style="text-align: center;">
    <form method="post">
        <input type="text" name="code"/>
        <br><br>
        <img src="http://localhost:8080/Captcha">

        <br><br>
        <input type="submit" value="submit">
    </form>
    <br>
    <%
        String captcha = (String) session.getAttribute("captcha");
        String code = request.getParameter("code");
        if (captcha != null && code != null) {
            if (captcha.equals(code)) {
                out.print("<p class='correct'>Correct</p>");
            } else {
                out.print("<p class='incorrect'>Incorrect</p>");
            }
        }
    %>
</div>
</body>
</html>