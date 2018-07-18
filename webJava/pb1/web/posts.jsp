<%@ page import="model.Post" %>
<%@ page import="java.util.List" %>
<%@ page import="model.Comment" %><%--
  Created by IntelliJ IDEA.
  User: nicuc
  Date: 6/3/2018
  Time: 7:36 PM
  To change this template use File | Settings | File Templates.
--%>
<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<html>
<head>
    <title>Posts</title>
    <style>
        .post {
            border: 1px solid black;
            padding: 10px;
        }

        .comment {
            background-color: #DDDDDD;
            padding: 10px;
        }
        
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
<h1>Posts</h1>
<%
    //generate posts with accepted comments
    List<Post> posts = (List<Post>)request.getAttribute("posts");
    List<Comment> comments = (List<Comment>)request.getAttribute("comments");

    for (Post post : posts) {
        out.println("<div class=\"post\">");
        out.println(post.getContent() + "<br/>");

        //comments
        out.println("<h2>Comments</h2>");
        for (Comment comment : comments) {
            if (comment.getPostId() == post.getId() && comment.getAccepted() == 1) {
                out.println("<h3>" + comment.getEmail() + " says</h3>");
                out.println("<p class=\"comment\">" + comment.getComment() + "</p>");
            }
        }

        //insert add comment form
        out.println("<form action=\"posts\" method=\"post\">");
        out.println("<input class=\"hidden\" type=\"text\" name=\"id\" value=\""+post.getId()+"\">");
        out.println("<input name=\"email\" type=\"email\" required placeholder=\"email\">");
        out.println("<textarea name=\"comment\" rows=\"4\" placeholder=\"comment\"></textarea>");
        out.println("<input type=\"submit\" value=\"post comment\">");
        out.println("</form>");
        out.println("</div>");
    }
%>
<a href="./login.html">login</a>
</body>
</html>
