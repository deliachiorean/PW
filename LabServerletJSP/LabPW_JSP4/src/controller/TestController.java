package controller;

import model.DBUtils;
import model.Question;

import javax.servlet.RequestDispatcher;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import java.io.IOException;

public class TestController extends HttpServlet {

    public TestController() {
        super();
    }

    protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        String question = request.getParameter("question");
        String answer1 = request.getParameter("answer1");
        String answer2 = request.getParameter("answer2");
        String answer3 = request.getParameter("answer3");
        String corect = request.getParameter("corect");
        Question questionToAdd= new Question(question,answer1,answer2,answer3,corect);

        DBUtils dbUtils = new DBUtils();
        dbUtils.addQuestion(questionToAdd);
        String redirectURL = "http://localhost:8080/addQuestions.jsp";
        response.sendRedirect(redirectURL);
    }
}
