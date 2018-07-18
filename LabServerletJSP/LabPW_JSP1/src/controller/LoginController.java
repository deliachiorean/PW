package controller;

import model.Authenticator;
import model.Comment;

import javax.servlet.RequestDispatcher;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import java.io.IOException;
import java.util.ArrayList;

public class LoginController extends HttpServlet {

    public LoginController() {
        super();
    }

    protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        String username = request.getParameter("username");
        String password = request.getParameter("password");
        RequestDispatcher rd = null;

        Authenticator authenticator = new Authenticator();
        boolean result = authenticator.authenticate(username, password);
        if (result) {
            ArrayList<Comment> comments=authenticator.getUnauthorizedComments();
            if (comments!=null) {
                rd = request.getRequestDispatcher("/autorizat.jsp");
                request.setAttribute("comments", comments);
            }
        }
        else{
            rd = request.getRequestDispatcher("/error.jsp");
        }
        rd.forward(request, response);
    }
}
