package controller;

import model.DBUtils;

import javax.servlet.RequestDispatcher;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import java.io.IOException;

public class RegexController extends HttpServlet {

    public RegexController() {
        super();
    }

    protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        String regex = request.getParameter("regex");
        RequestDispatcher rd = null;

        DBUtils dbUtils=new DBUtils();
        dbUtils.addRegex(regex);
        String redirectURL = "http://localhost:8080/addRegex.jsp";
        response.sendRedirect(redirectURL);
    }
}
