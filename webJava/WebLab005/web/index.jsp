<%@ taglib prefix = "ct" uri = "/WEB-INF/custom.tld"%>
<%@ page contentType="text/html;charset=UTF-8" language="java" %>

<html>
    <head>
        <title>CalendarCustomTag</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <ct:calendar an="2018" luna="6" zi="8" culoare="#FF0000" />
        <br/>
        <ct:calendar an="2018" luna="7" zi="8" culoare="#0000FF"/>
        <br/>
        <ct:calendar an="2018" luna="8" clasa="c2"/>
    </body>
</html>
