package controller;

import model.Comment;
import model.Post;
import model.User;
import repository.PostsRepository;
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
    PostsRepository postsRepository;
    public LoginController() {
        super();
        repository = new UsersRepository();
        postsRepository = new PostsRepository();
    }

    @Override
    public void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        RequestDispatcher dispatcher = null;
        List<User> users = repository.getUsers();
        request.setAttribute("users", users);
        dispatcher = request.getRequestDispatcher("/users.jsp");
        dispatcher.forward(request, response);
    }

    @Override
    public void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        String username = request.getParameter("username");
        String password = request.getParameter("password");
        RequestDispatcher rd = null;

        Authenticator authenticator = new Authenticator();
        boolean result = authenticator.authenticate(username, password);
        if (result) {
            rd = request.getRequestDispatcher("./allposts.jsp");
            List<Comment> comments = postsRepository.getComments();
//            System.out.println(comments.size());
            request.setAttribute("comments", comments);
        } else {
            rd = request.getRequestDispatcher("/error.jsp");
        }
        rd.forward(request, response);

    }

}
