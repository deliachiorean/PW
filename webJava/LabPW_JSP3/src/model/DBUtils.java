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
            con = DriverManager.getConnection("jdbc:mysql://localhost/dbpw_jsp", "root", "root");

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

    public void addRegex(String regex){
        try {
            preparedStatement = con.prepareStatement("INSERT INTO regularexpressions(regex) VALUES (?)");
            preparedStatement.setString(1, regex);
            preparedStatement.execute();
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }

    public ArrayList<String> getAllRegex(){
        ResultSet rs;
        ArrayList<String> result = new ArrayList<>();
        try {
            preparedStatement = con.prepareStatement("select * from regularexpressions");
            rs = preparedStatement.executeQuery();
            while (rs.next()) {
                result.add(rs.getString("regex"));
            }
            rs.close();
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return result;
    }
}
