<%@ page import="model.Question" %>
<%@ page import="java.util.ArrayList" %>
<%@ page import="model.DBUtils" %>
<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<html>
  <head>
    <title>Quiz HTML</title>
  </head>
  <body>
  <div>
      <form action="ValidateTestController" method="post">
          <ol>
              <%
                DBUtils dbUtils=new DBUtils();
                ArrayList<Question> questions=dbUtils.getAllQuestions();
                int i=1;
                for (Question q : questions){
                    out.println("<li>"+q.getQuestion()+"</li>");
                    out.println("<form>");
                    out.println("<input type=\"radio\" name=\"test"+i+"\" checked value='"+ q.getAnswer1() +"'>"+ q.getAnswer1()+"<br>");
                    out.println("<input type=\"radio\" name=\"test"+i+"\" checked value='"+ q.getAnswer2() +"'>"+ q.getAnswer2()+"<br>");
                    out.println("<input type=\"radio\" name=\"test"+i+"\" checked value='"+ q.getAnswer3() +"'>"+ q.getAnswer3());
                    out.println("<form>");
                    i++;
                }
              %>
          </ol>
          <input type="submit" name="submit">
      </form>
  </div>
  </body>
</html>
