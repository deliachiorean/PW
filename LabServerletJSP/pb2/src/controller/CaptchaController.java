package controller;

import javax.imageio.ImageIO;
import javax.servlet.RequestDispatcher;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import java.awt.*;
import java.awt.image.BufferedImage;
import java.awt.image.ImageProducer;
import java.io.IOException;
import java.io.OutputStream;
import java.util.Random;

public class CaptchaController extends HttpServlet {

    private String captchaCode = "";
    protected void processRequest(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {

        //w and h of the image
        int w = 200;
        int h = 50;

        char posiblecodes[][] = {{ 'c', 'b', '1', '2', 'z'}, { '1', 'L', 'g', 'H', 't' }, { 'u', 'b', 'b', 'c', 'j' }, { 'y', 't', 'b' }, { '1', 'n', '2','f', 'd', 'w'},

        };

        //create image
        BufferedImage bufferedImage = new BufferedImage(w, h,
                BufferedImage.TYPE_INT_RGB);

        Graphics2D graphics2d = bufferedImage.createGraphics();
       
        Font font = new Font("Papyrus", Font.BOLD , 22);
        graphics2d.setFont(font);

        
        RenderingHints rh = new RenderingHints(
                RenderingHints.KEY_ANTIALIASING,
                RenderingHints.VALUE_ANTIALIAS_ON);

        rh.put(RenderingHints.KEY_RENDERING,
                RenderingHints.VALUE_RENDER_QUALITY);

        graphics2d.setRenderingHints(rh);

        //set colors
        graphics2d.setColor(new Color(153, 0, 0));
        graphics2d.fillRect(0, 0, w, h);

        graphics2d.setColor(new Color(255, 255, 255));

        //get a random captcha code
        Random r = new Random();
        int index = Math.abs(r.nextInt()) % 6;

        String captcha = String.copyValueOf(posiblecodes[index]);
        captchaCode = captcha;
        //send the captcha
        request.getSession().setAttribute("captcha", captcha);

        int x = 0;
        int y = 0;

        //draw captcha
        for (int i = 0; i < posiblecodes[index].length; i++) {
            x += 10 + (Math.abs(r.nextInt()) % 15);
            y = 20 + Math.abs(r.nextInt()) % 20;
            graphics2d.drawChars(posiblecodes[index], i, 1, x, y);
        }

        graphics2d.dispose();

        response.setContentType("image/png");
        OutputStream os = response.getOutputStream();
        ImageIO.write(bufferedImage, "png", os);
        os.close();
    }

  
    protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        processRequest(request, response);
    }

   
    protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        //verificare
        String captchaFromInput = request.getParameter("captcha");
        RequestDispatcher rd = null;
        if (captchaFromInput.equals(this.captchaCode)) {
            //is good
            rd = request.getRequestDispatcher("./success.jsp");
        } else {
            rd = request.getRequestDispatcher("./error.jsp");
        }
        rd.forward(request, response);
    }
}
