package controller;

import model.Comment;
import repository.PostsRepository;

import javax.servlet.RequestDispatcher;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import java.io.IOException;

public class ValidationController extends HttpServlet {
    private PostsRepository repository;

    public ValidationController() {
        super();
        repository = new PostsRepository();
    }

    @Override
    public void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        try {
            //accept the comment
            repository.updateComment(Integer.parseInt(request.getParameter("id")));
            RequestDispatcher dispatcher = request.getRequestDispatcher("./commentsuccess.jsp");
            dispatcher.forward(request, response);
        } catch (Exception ex) {
            RequestDispatcher dispatcher = request.getRequestDispatcher("./commentfailed.jsp");
        }

    }
}
