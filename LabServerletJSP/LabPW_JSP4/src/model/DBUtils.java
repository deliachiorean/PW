package model;

import java.sql.*;
import java.util.ArrayList;

public class DBUtils {
    private PreparedStatement preparedStatement;
    private Connection con;

    public DBUtils() {
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

    public void addQuestion(Question question){
        try {
            preparedStatement = con.prepareStatement("INSERT INTO chestionar(question, answer1, answer2, answer3, corect) VALUES (?,?,?,?,?)");
            preparedStatement.setString(1, question.getQuestion());
            preparedStatement.setString(2, question.getAnswer1());
            preparedStatement.setString(3, question.getAnswer2());
            preparedStatement.setString(4, question.getAnswer3());
            preparedStatement.setString(5, question.getCorect());
            preparedStatement.execute();
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }

    public ArrayList<Question> getAllQuestions(){
        ResultSet rs;
        ArrayList<Question> result = new ArrayList<>();
        try {
            preparedStatement = con.prepareStatement("select * from chestionar");
            rs = preparedStatement.executeQuery();
            while (rs.next()) {
                Question q = new Question();
                q.setQuestion(rs.getString("question"));
                q.setAnswer1(rs.getString("answer1"));
                q.setAnswer2(rs.getString("answer2"));
                q.setAnswer3(rs.getString("answer3"));
                q.setCorect(rs.getString("corect"));
                result.add(q);
            }
            rs.close();
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return result;
    }

    public int numberOfQuestions() {
        ResultSet rs;
        ArrayList<Question> result = new ArrayList<>();
        try {
            preparedStatement = con.prepareStatement("select count(*) from chestionar");
            rs = preparedStatement.executeQuery();
            while (rs.next()) {
                return rs.getInt(1);
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return 0;
    }
}
