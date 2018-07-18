package controller;

import repository.UsersRepository;

import javax.servlet.RequestDispatcher;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import java.io.IOException;
import java.util.List;

public class LoginController extends HttpServlet {
    UsersRepository repository;

    public LoginController() {
        super();
        repository = new UsersRepository();

    }

    @Override
    public void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        String username = request.getParameter("username");
        String password = request.getParameter("password");
        RequestDispatcher rd = null;

        Authenticator authenticator = new Authenticator();
        boolean result = authenticator.authenticate(username, password);
        if (result) {
            rd = request.getRequestDispatcher("./addregex.jsp");

        } else {
            rd = request.getRequestDispatcher("/error.jsp");
        }
        rd.forward(request, response);

    }

    @Override
    public void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {


        RequestDispatcher rd = request.getRequestDispatcher("./index.jsp");

        rd.forward(request, response);

    }

}
