
<%@ page import="java.util.List" %>
<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<html>
<head>
<title>Captcha</title>
<style>
</style>
</head>
<body>

<form action="CaptchaController" method="post">
  <input name="captcha" type="text" placeholder="captcha">
  <img src="CaptchaController">
  <input type="submit" value="submit captcha">
</form>


  </body>
</html>
