package controller;

import model.Comment;
import model.Post;
import model.User;
import repository.PostsRepository;

import javax.servlet.RequestDispatcher;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import java.io.IOException;
import java.util.List;

public class PostsController extends HttpServlet {
    private PostsRepository repository;

    public PostsController() {
        super();
        repository = new PostsRepository();
    }

    @Override
    public void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {

        List<Post> posts = repository.getPosts();
        List<Comment> comments = repository.getComments();
        System.out.println(comments.size());
        request.setAttribute("posts", posts);
        request.setAttribute("comments", comments);
        RequestDispatcher dispatcher = request.getRequestDispatcher("/posts.jsp");
        dispatcher.forward(request, response);
    }

    @Override
    public void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        RequestDispatcher dispatcher = null;
        try {
            if (request.getParameter("comment").length() == 0) {
                throw new Exception("comment length is 0");
            }
            Comment comment = new Comment(
                    Integer.parseInt(request.getParameter("id")),
                    request.getParameter("email"),
                    request.getParameter("comment"),
                    0);
            repository.addComment(comment);
            dispatcher = request.getRequestDispatcher("./commentsuccess.jsp");

        } catch (Exception ex) {
            dispatcher = request.getRequestDispatcher("./commentfailed.jsp");
        }
        dispatcher.forward(request, response);
    }
}
