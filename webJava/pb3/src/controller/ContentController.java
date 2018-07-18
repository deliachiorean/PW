package controller;

import javax.servlet.RequestDispatcher;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import java.io.IOException;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.util.ArrayList;
import java.util.List;

public class ContentController extends HttpServlet {
    private Connection con;

    public ContentController() {
        super();
    }

    public void connect() {
        try {
            Class.forName("org.gjt.mm.mysql.Driver");
            con = DriverManager.getConnection("jdbc:mysql://localhost/javausers", "root", "");

        } catch(Exception ex) {
            System.out.println("eroare la connect:" + ex.getMessage());
            ex.printStackTrace();
        }
    }

    @Override
    public void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        String regex = request.getParameter("regex");
        RequestDispatcher rd = null;
        try {
            connect();

            PreparedStatement statement = con.prepareStatement("insert into regexes values(?)");
            statement.setString(1, regex);
            statement.executeUpdate();

            rd = request.getRequestDispatcher("./success.jsp");

        } catch (Exception e) {
            e.printStackTrace();
            rd = request.getRequestDispatcher("./error.jsp");
        }

        rd.forward(request, response);
    }

    @Override
    public void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {

        try {
            String output = "";
            connect();
            //select output
            PreparedStatement statement = con.prepareStatement("select * from output3");
            ResultSet result = statement.executeQuery();

            while (result.next()) {
                //System.out.println(result.getString("username") + ": " + result.getString("password"));
                output = result.getString("output");
                System.out.println("content " + output + "..");
            }

            result.close();
            //filter output
            output = filter(output);
            //System.out.println("content " + output + "..");
            request.setAttribute("output", output);
            RequestDispatcher dispatcher = request.getRequestDispatcher("/content.jsp");
            dispatcher.forward(request, response);



        } catch (Exception e) {
            e.printStackTrace();

        }



    }

    //gets regular expressions from db
    private List<String> getRegex() {
        List<String> all = new ArrayList<>();
        try {

            connect();
            PreparedStatement statement = con.prepareStatement("select * from regexes");
            ResultSet result = statement.executeQuery();

            while (result.next()) {
                //System.out.println(result.getString("username") + ": " + result.getString("password"));
                String output = result.getString("expression");
                all.add(output);
                System.out.println("content " + output + "..");
            }

            result.close();

        } catch (Exception e) {
            e.printStackTrace();

        }
        return all;
    }

    private String filter(String output) {
        List<String> expressions = getRegex();
        for (String regex : expressions) {
            System.out.println(regex);
            output = output.replaceAll(regex, "***");
        }
        return output;

    }

}
