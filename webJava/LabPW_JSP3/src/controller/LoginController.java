package controller;

import model.DBUtils;

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

        DBUtils dbUtils=new DBUtils();
        boolean result = dbUtils.authenticate(username, password);
        if (result) {
            rd = request.getRequestDispatcher("/addRegex.jsp");
        }
        else{
            rd = request.getRequestDispatcher("/error.jsp");
        }
        rd.forward(request, response);
    }
}

