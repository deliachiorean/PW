<%@ page import="model.Comment" %>
<%@ page import="java.util.ArrayList" %>
<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Authorize comments</title>
</head>
<body>
<div>
    <%
        out.println("<table border='1'>");
        out.println("<tr>");
        out.println("<th> Email </th>");
        out.println("<th> Comment </th>");
        out.println("<tr>");
        ArrayList<Comment> comments=(ArrayList<Comment>) request.getAttribute("comments");
        for (Comment c: comments) {
            out.println("<tr>");
            out.println("<td>"+c.getEmail()+"</td>");
            out.println("<td>"+c.getComment()+"</td>");
            out.println("<td><form action=\"CommentsController\" method=\"post\"> " +
                    "<input type=\"submit\" value=\"autorizeaza\"/> " +
                    "<input type=\"hidden\" name=\"email\" value=\""+ c.getEmail() +"\">" +
                    "</form> </td>");
            out.println("</tr>");
        }
        out.println("</table>");
    %>
</div>
</body>
</html>

