package model;

import javax.servlet.*;
import javax.servlet.http.HttpServletResponse;
import java.io.IOException;
import java.io.PrintWriter;
import java.util.ArrayList;

public class MyFilter implements Filter {
    @Override
    public void init(FilterConfig filterConfig) throws ServletException {
    }

    @Override
    public void doFilter(ServletRequest servletRequest, ServletResponse servletResponse,
                         FilterChain filterChain) throws IOException, ServletException {

        HtmlResponseWrapper capturingResponseWrapper = new HtmlResponseWrapper(
                (HttpServletResponse) servletResponse);

        filterChain.doFilter(servletRequest, capturingResponseWrapper);

        if (servletResponse.getContentType() != null
                && servletResponse.getContentType().contains("text/html")) {

            String content = capturingResponseWrapper.getCaptureAsString();

            //replacing the bad words
            DBUtils dbUtils=new DBUtils();
            ArrayList<String> regularExpressions = dbUtils.getAllRegex();
            for (String regex : regularExpressions) {
                content = content.replaceAll(
                        regex,
                        "***");
            }
            servletResponse.getWriter().write(content);
        }
    }

    @Override
    public void destroy() {
    /* Called before the Filter instance is removed
      from service by the web container*/
    }
}
