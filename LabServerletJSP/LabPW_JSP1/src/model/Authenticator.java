package model;

import java.sql.*;
import java.util.ArrayList;

public class Authenticator {
    private PreparedStatement preparedStatement;
    private Connection con;

    public Authenticator() {
        connect();
    }

    public void connect() {
        try {
            Class.forName("org.gjt.mm.mysql.Driver");
            con = DriverManager.getConnection("jdbc:mysql://localhost/pwjava", "root", "");

        } catch(Exception ex) {
            System.out.println("Connection error:"+ex.getMessage());
            ex.printStackTrace();
        }
    }

    public boolean authenticate(String username, String password) {

        ResultSet rs;
        boolean result = false;
        System.out.println(username+" "+password);
        try {
            preparedStatement = con.prepareStatement("select * from users where username=?");
            preparedStatement.setString(1, username);
            rs = preparedStatement.executeQuery();
            if (rs.next() && rs.getString("password").equals(password)) {
                result = true;
            }
            rs.close();
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return result;
    }

    public ArrayList<Comment> getUnauthorizedComments(){
        ResultSet rs;
        ArrayList<Comment> comments=new ArrayList<>();
        try {
            preparedStatement = con.prepareStatement("select * from comments where autorizat=0");
            rs = preparedStatement.executeQuery();
            while (rs.next()) {
                Comment comment=new Comment();
                comment.setEmail(rs.getString("email"));
                comment.setComment(rs.getString("comment"));
                comment.setAuthorized(rs.getInt("autorizat"));
                comments.add(comment);
            }
            rs.close();
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return comments;
    }

    public ArrayList<Comment> getAuthorizedComments(){
        ResultSet rs;
        ArrayList<Comment> comments=new ArrayList<>();
        try {
            preparedStatement = con.prepareStatement("select * from comments where autorizat=1");
            rs = preparedStatement.executeQuery();
            while (rs.next()) {
                Comment comment=new Comment();
                comment.setEmail(rs.getString("email"));
                comment.setComment(rs.getString("comment"));
                comment.setAuthorized(rs.getInt("autorizat"));
                comments.add(comment);
            }
            rs.close();
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return comments;
    }

    public void setAuthorizedComment(String email){
        try {
            preparedStatement = con.prepareStatement("UPDATE comments SET autorizat= 1 WHERE email=?");
            preparedStatement.setString(1, email);
            preparedStatement.executeUpdate();
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }

    public void addComment(Comment comment){
        try {
            preparedStatement = con.prepareStatement("INSERT INTO comments(email, comment, autorizat) VALUES (?,?,0)");
            preparedStatement.setString(1, comment.getEmail());
            preparedStatement.setString(2,comment.getComment());
            preparedStatement.execute();
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }
}
