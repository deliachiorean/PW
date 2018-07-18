package mainPackage;

import java.io.IOException;
import java.text.SimpleDateFormat;
import java.time.LocalDate;
import java.time.format.DateTimeFormatter;
import java.util.Calendar;
import java.util.Date;
import java.util.Objects;
import javax.servlet.jsp.JspException;
import javax.servlet.jsp.JspWriter;
import javax.servlet.jsp.tagext.TagSupport;

public class CalendarTagHandler extends TagSupport {
    private int an;
    private int luna;
    private int zi;
    private String culoare;
    private String clasa;

    public void setAn(int an) {
        this.an = an;
    }

    public void setLuna(int luna) {
        this.luna = luna;
    }

    public void setZi(int zi) {
        this.zi = zi;
    }

    public void setCuloare(String culoare) {
        this.culoare = culoare;
    }

    public void setClasa(String clasa) {
        this.clasa = clasa;
    }

    public int doStartTag() throws JspException {
        // setam atributul "culoare"
        if (culoare == null)
            culoare = "#FFFF00";
        JspWriter out = pageContext.getOut();
        try {
            // afisam toate zilele saptamanii (Sun, Mon, Tue, Wed, Thu, Fri, Sat)
            if (clasa != null)
                out.print("<table class='" + clasa + "'>");
            else
                out.print("<table>");
            out.print("  <tr>");
            out.print("    <th>Sun</th>");
            out.print("    <th>Mon</th>");
            out.print("    <th>Tue</th>");
            out.print("    <th>Wed</th>");
            out.print("    <th>Thu</th>");
            out.print("    <th>Fri</th>");
            out.print("    <th>Sat</th>");
            out.print("  </tr>");

            // obtinem ziua 1 din luna data, si ce zi este
            Calendar myCal = Calendar.getInstance();
            myCal.set(Calendar.YEAR, an);
            myCal.set(Calendar.MONTH, luna - 1);
            myCal.set(Calendar.DAY_OF_MONTH, 1);
            Date now = myCal.getTime();
            SimpleDateFormat simpleDateFormat = new SimpleDateFormat("EE");
            String dictionarZile[] = {"Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"};

            // afisam prima zi
            int i = 0;
            while (!Objects.equals(dictionarZile[i], simpleDateFormat.format(now))) {
                out.print("<td></td>");
                i++;
            }
            if (zi == 1)
                out.print("<td><b><span style='color:" + culoare + "'>1</span></b></td>");
            else
                out.print("<td>1</td>");

            // afisam restul zilelor de pe prima linie
            int ziCurenta = 2;
            while (i < 6) {
                if (zi == ziCurenta)
                    out.print("<td><b><span style='color:" + culoare + "'>" + ziCurenta + "</span></b></td>");
                else
                    out.print("<td>" + ziCurenta + "</td>");
                i++;
                ziCurenta++;
            }
            out.print("</tr>");
            i = 0;

            // aflam care e ultima zi a lunii curente
            String date = "" + luna + "/" + 1 + "/" + an;
            LocalDate convertedDate = LocalDate.parse(date, DateTimeFormatter.ofPattern("M/d/yyyy"));
            convertedDate = convertedDate.withDayOfMonth(
                    convertedDate.getMonth().length(convertedDate.isLeapYear()));
            int ultimaZi = convertedDate.getMonth().length(convertedDate.isLeapYear());

            // afisam restul zilelor din luna
            while (ziCurenta <= ultimaZi) {
                if (i == 7) {
                    i = 0;
                    out.print("</tr>");
                    out.print("<tr>");
                }
                if (zi==ziCurenta)
                    out.print("<td><b><span style='color:" + culoare + "'>" + ziCurenta + "</span></b></td>");
                else
                    out.print("<td>" + ziCurenta + "</td>");
                i++;
                ziCurenta++;
            }

            // punem celule goale daca ultimul rand nu e complet
            while (i < 7) {
                out.print("<td></td>");
                i++;
            }
            out.print("</tr>");

            // Inchidem tabelul
            out.print("</table>");
        } catch (IOException e) {
            e.printStackTrace();
        }
        return SKIP_BODY;
    }
}
