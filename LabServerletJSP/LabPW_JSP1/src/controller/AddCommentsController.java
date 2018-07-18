package controller;

import model.Authenticator;
import model.Comment;

import javax.servlet.RequestDispatcher;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import java.io.IOException;

public class AddCommentsController extends HttpServlet {
    public AddCommentsController() {super();}

    protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        String email= request.getParameter("email");
        String comment=request.getParameter("comment");
        Comment c=new Comment(email,comment,0);
        RequestDispatcher rd = null;
        Authenticator authenticator=new Authenticator();
        authenticator.addComment(c);
        String redirectURL = "http://localhost:8080/";
        response.sendRedirect(redirectURL);
    }
}
