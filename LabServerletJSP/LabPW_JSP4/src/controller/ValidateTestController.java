package controller;

import model.DBUtils;
import model.Question;

import javax.servlet.RequestDispatcher;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import java.io.IOException;
import java.util.ArrayList;

public class ValidateTestController extends HttpServlet {

    public ValidateTestController() {
        super();
    }

    protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        DBUtils dbUtils=new DBUtils();
        ArrayList<Question> questions=dbUtils.getAllQuestions();
        RequestDispatcher rd = null;
        int i=1;
        int corect=0;
        for (Question q : questions){
            System.out.println(request.getParameter("test"+i)+" "+q.getCorect()+"\n");
            if (request.getParameter("test"+i).equals(q.getCorect())) {
                corect++;
            }
            i++;
        }
        rd = request.getRequestDispatcher("/result.jsp");
        String toSend=String.valueOf(corect);
        request.setAttribute("corect", toSend);
        rd.forward(request, response);
    }
}