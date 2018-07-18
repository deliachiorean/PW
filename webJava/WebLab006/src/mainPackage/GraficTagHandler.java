package mainPackage;

import javafx.util.Pair;

import javax.servlet.RequestDispatcher;
import javax.servlet.jsp.JspException;
import javax.servlet.jsp.JspWriter;
import javax.servlet.jsp.tagext.TagSupport;
import java.io.IOException;
import java.net.URLEncoder;
import java.util.ArrayList;

public class GraficTagHandler extends TagSupport {
    private String textox;
    private String textoy;
    private int minox;
    private int minoy;
    private int maxox;
    private int maxoy;
    private String culoare;
    private String valori;

    public void setTextox(String textox) {
        this.textox = textox;
    }

    public void setTextoy(String textoy) {
        this.textoy = textoy;
    }

    public void setMinox(int minox) {
        this.minox = minox;
    }

    public void setMinoy(int minoy) {
        this.minoy = minoy;
    }

    public void setMaxox(int maxox) {
        this.maxox = maxox;
    }

    public void setMaxoy(int maxoy) {
        this.maxoy = maxoy;
    }

    public void setCuloare(String culoare) {
        this.culoare = culoare;
    }

    public void setValori(String valori) {
        this.valori = valori;
    }

    public int doStartTag() throws JspException {
        JspWriter out = pageContext.getOut();
        try {
            out.print("<img src='http://localhost:8080/Grafic?" +
                    "textox="+ textox + "&" +
                    "textoy="+ textoy + "&" +
                    "minox="+ minox + "&" +
                    "minoy="+ minoy + "&" +
                    "maxox="+ maxox + "&" +
                    "maxoy="+ maxoy + "&" +
                    "culoare="+ URLEncoder.encode(culoare,"UTF-8") + "&" +
                    "valori="+ URLEncoder.encode(valori, "UTF-8") +
                    "'></img>");

        } catch (IOException e) {
            e.printStackTrace();
        }
        return SKIP_BODY;
    }
}
