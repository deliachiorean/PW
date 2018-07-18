package servlets;

import java.io.*;
import javax.servlet.*;
import javax.servlet.http.*;

public class DBServlet extends HttpServlet {

    public void doGet(HttpServletRequest request,
            HttpServletResponse response)
            throws IOException, ServletException {
        response.setContentType("text/html");
        PrintWriter out = response.getWriter();

        out.println("<html>");
        out.println("<head>");

        out.println("<title>First servlet</title>");
        out.println("</head>");
        out.println("<body>");

        DBUtils DBUtils = new DBUtils();
        DBUtils.connect();
        out.println(DBUtils.showData());

        out.println("<hr>");

        out.println("</body>");
        out.println("</html>");
    }
}


 