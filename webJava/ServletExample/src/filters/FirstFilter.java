package filters;

import javax.servlet.*;
import java.io.IOException;
import java.io.PrintWriter;

public class FirstFilter implements Filter {
    @Override
    public void init(FilterConfig filterConfig) throws ServletException {
        // Get init parameter
        String testParam = filterConfig.getInitParameter("test-param");

        //Print the init parameter
        System.out.println("Test Param: " + testParam);
    }

    @Override
    public void doFilter(ServletRequest servletRequest, ServletResponse servletResponse,
            FilterChain filterChain) throws IOException, ServletException {

        servletRequest.setAttribute("filterAttribute", "Request Filter was executed");
        // here you can do things before the servlet is called

        filterChain.doFilter(servletRequest, servletResponse);

        // here you can do things after the servlet was called

        PrintWriter out = servletResponse.getWriter();
        out.println("####################### (added by response filter)");
    }

    @Override
    public void destroy() {
    /* Called before the Filter instance is removed
      from service by the web container*/
    }
}
