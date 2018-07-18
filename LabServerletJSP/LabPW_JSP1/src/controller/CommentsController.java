package controller;

import model.Authenticator;
import model.Comment;

import javax.servlet.RequestDispatcher;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import java.io.IOException;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.util.ArrayList;

public class CommentsController extends HttpServlet {
    public CommentsController() {super();}

    protected void doPost(HttpServletRequest request,HttpServletResponse response) throws ServletException, IOException {
        String email= request.getParameter("email");
        RequestDispatcher rd = null;
        Authenticator authenticator=new Authenticator();
        authenticator.setAuthorizedComment(email);
        String redirectURL = "http://localhost:8080/login.html";
        response.sendRedirect(redirectURL);
    }
}
