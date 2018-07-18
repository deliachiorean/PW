package repository;

import model.User;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.util.ArrayList;
import java.util.List;

public class UsersRepository {
    private Connection con;
    public UsersRepository() {

    }

    public List<User> getUsers() {
        List<User> allUsers = new ArrayList<>();
        try {
            Class.forName("org.gjt.mm.mysql.Driver");
            con = DriverManager.getConnection("jdbc:mysql://localhost/javausers", "root", "");

            PreparedStatement statement = con.prepareStatement("select * from users");
            ResultSet result = statement.executeQuery();
            while (result.next()) {
                //System.out.println(result.getString("username") + ": " + result.getString("password"));
                User u = new User(result.getString("username"), result.getString("password"));
                allUsers.add(u);
            }



        } catch (Exception e) {
            e.printStackTrace();
            return null;
        }

        return allUsers;
    }

}
