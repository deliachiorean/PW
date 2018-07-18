package servlets;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.Statement;

public class DBUtils {
    private String driver;
    private String connString;
    private String user;
    private String pass;
    private Statement stmt;

    public DBUtils() {
        this.driver = "org.gjt.mm.mysql.Driver";
        this.connString = "jdbc:mysql://localhost/databaseName";
        this.user = "username";
        this.pass = "password";
    }

    public void connect() {
        try {
            Class.forName(driver);
            Connection con = DriverManager.getConnection(connString, user, pass);
            stmt = con.createStatement();
        }
        catch (Exception ex) {
            System.out.println("eroare la connect:" + ex.getMessage());
        }
    }

    public String showData() {
        String res = "";
        try {

            ResultSet rs = stmt.executeQuery("select * from user limit 10");
            while (rs.next()) {
                res += rs.getInt("id") + "  " + rs.getString("displayName") + " " +
                        rs.getString("role") + " " + rs.getInt("groupId");
                res = res + "<br/>";
            }
        }
        catch (Exception ex) {
            System.out.println("eroare la showData:" + ex.getMessage());
        }
        return res;
    }
}