<%@ taglib prefix = "ct" uri = "/WEB-INF/custom.tld"%>
<%@ page contentType="text/html;charset=UTF-8" language="java" %>

<html>
<head>
    <title>GraficCustomTag</title>
</head>
<body>
<ct:grafic culoare="red"
           textox="problemeWeb" textoy="chefDeViata"
           minox="1" maxox="10" minoy="1" maxoy="10"
           valori="[[1,10];[2,8];[3,7];[4,6];[5,4];[6,3];[7,2];[8,2];[9,1];[10,1]]"/>
</body>
</html>
