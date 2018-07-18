package repository;

import model.Comment;
import model.Post;


import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.util.ArrayList;
import java.util.List;

public class PostsRepository {
    private Connection con;

    public List<Post> getPosts() {
        List<Post> allPosts = new ArrayList<>();
        try {
            connect();
            PreparedStatement statement = con.prepareStatement("select * from posts");
            ResultSet result = statement.executeQuery();
            while (result.next()) {
                //System.out.println(result.getString("username") + ": " + result.getString("password"));
                Post u = new Post(result.getInt("id"), result.getString("content"));
                allPosts.add(u);
            }

            result.close();

        } catch (Exception e) {
            e.printStackTrace();
            return null;
        }

        return allPosts;
    }

    public List<Comment> getComments() {
        List<Comment> allComments = new ArrayList<>();
        try {
            connect();
            PreparedStatement statement = con.prepareStatement("select * from comments");
            ResultSet result = statement.executeQuery();
            while (result.next()) {
                //System.out.println(result.getString("username") + ": " + result.getString("password"));
                Comment u = new Comment(
                        result.getInt("id"),
                        result.getInt("postid"),
                        result.getString("email"),
                        result.getString("comment"),
                        result.getInt("accepted"));
                allComments.add(u);
            }
            result.close();



        } catch (Exception e) {
            e.printStackTrace();
            return null;
        }

        return allComments;
    }

    public void connect() {
        try {
            Class.forName("org.gjt.mm.mysql.Driver");
            con = DriverManager.getConnection("jdbc:mysql://localhost/javausers", "root", "");

        } catch(Exception ex) {
            System.out.println("eroare la connect:"+ex.getMessage());
            ex.printStackTrace();
        }
    }

    public void addComment(Comment comment) {
        try {
            connect();
            PreparedStatement statement = con.prepareStatement("insert into comments(postid, email, comment, accepted) values(?, ?, ?, ?)");
            statement.setInt(1, comment.getPostId());
            statement.setString(2, comment.getEmail());
            statement.setString(3, comment.getComment());
            statement.setInt(4, comment.getAccepted());
            statement.executeUpdate();
        } catch (Exception e) {
            e.printStackTrace();

        }
    }

    //sets a comment to accepted
    public void updateComment(int id) {
        try {
            connect();
            PreparedStatement statement = con.prepareStatement("update comments set accepted=1 where id=?");
            statement.setInt(1, id);

            statement.executeUpdate();
        } catch (Exception e) {
            e.printStackTrace();

        }
    }


}
