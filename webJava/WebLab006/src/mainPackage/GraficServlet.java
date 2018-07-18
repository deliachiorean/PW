package mainPackage;

import javafx.util.Pair;

import javax.imageio.ImageIO;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import java.awt.*;
import java.awt.image.BufferedImage;
import java.io.IOException;
import java.io.OutputStream;
import java.lang.reflect.Field;
import java.net.URLDecoder;
import java.net.URLEncoder;
import java.util.ArrayList;
import java.util.Random;

public class GraficServlet extends HttpServlet {
    protected void processRequest(HttpServletRequest request,
                                  HttpServletResponse response)
            throws ServletException, IOException {
        String textox = request.getParameter("textox");
        String textoy = request.getParameter("textoy");
        int minox = Integer.parseInt(request.getParameter("minox"));
        int minoy = Integer.parseInt(request.getParameter("minoy"));
        int maxox = Integer.parseInt(request.getParameter("maxox"));
        int maxoy = Integer.parseInt(request.getParameter("maxoy"));
        String culoare = URLDecoder.decode(request.getParameter("culoare"),"UTF-8");
        String valori = URLDecoder.decode(request.getParameter("valori"),"UTF-8");
        int width = 600;
        int height = 600;

        ArrayList<Pair<Integer, Integer>> perechi = new ArrayList<>();
        valori = valori.replace("[", "");
        valori = valori.replace("]", "");
        for (String s : valori.split(";")) {
            int valoare1 = Integer.parseInt(s.split(",")[0]);
            int valoare2 = Integer.parseInt(s.split(",")[1]);
            perechi.add(new Pair<>(valoare1, valoare2));
        }

        // pregatim imaginea
        BufferedImage bufferedImage = new BufferedImage(width, height,
                BufferedImage.TYPE_INT_RGB);
        Graphics2D g2d = bufferedImage.createGraphics();

        // umplem fundalul cu alb
        g2d.setColor(Color.white);
        g2d.fillRect(0,0,width,height);
        g2d.setColor(Color.black);

        // desenam axele
        int axisOffset = 40;
        g2d.drawLine(axisOffset,height-axisOffset,axisOffset,axisOffset); //oy
        g2d.drawLine(axisOffset,height-axisOffset,width-axisOffset,height-axisOffset); // ox
        g2d.drawLine(axisOffset,axisOffset,axisOffset-10,axisOffset+8); // sageata oy
        g2d.drawLine(axisOffset,axisOffset,axisOffset+10,axisOffset+8);
        g2d.drawLine(width-axisOffset,height-axisOffset, // sageata ox
                width-axisOffset-8,height-axisOffset-10);
        g2d.drawLine(width-axisOffset,height-axisOffset,
                width-axisOffset-8,height-axisOffset+10);

        // scriem textul de pe axe
        Font font = new Font("Georgia", Font.BOLD, 18);
        g2d.setFont(font);
        g2d.drawChars(textox.toCharArray(), 0, textox.length(), axisOffset, height - axisOffset + 30);
        g2d.drawChars(textoy.toCharArray(), 0, textoy.length(), 0, 20);

        // tragem linia pentru minim si maxim pe ox / oy
        font = new Font("Georgia", Font.BOLD, 14);
        g2d.setFont(font);
        String textMinox = String.valueOf(minox);
        String textMaxox = String.valueOf(maxox);
        String textMinoy = String.valueOf(minoy);
        String textMaxoy = String.valueOf(maxoy);
        g2d.drawLine(axisOffset + 20,height-axisOffset - 4, // minim ox
                axisOffset + 20,height-axisOffset + 4);
        g2d.drawLine(axisOffset - 4,height-axisOffset - 20, // minim oy
                axisOffset + 4,height-axisOffset - 20);
        g2d.drawChars(textMinox.toCharArray(), 0, textMinox.length(), // text minim ox
                axisOffset + 14, height-axisOffset + 16);
        g2d.drawChars(textMinoy.toCharArray(), 0, textMinoy.length(), // text minim oy
                axisOffset - 24, height-axisOffset - 16);
        g2d.drawLine(width - axisOffset - 20,height-axisOffset - 4, // maxim ox
                width - axisOffset - 20,height-axisOffset + 4);
        g2d.drawLine(axisOffset - 4,axisOffset + 20, // maxim oy
                axisOffset + 4,axisOffset + 20);
        g2d.drawChars(textMaxox.toCharArray(), 0, textMaxox.length(), // text maxim ox
                width - axisOffset - 26, height-axisOffset + 16);
        g2d.drawChars(textMaxoy.toCharArray(), 0, textMaxoy.length(), // text maxim oy
                axisOffset - 24, axisOffset + 24);

        // determinam coordonatele minimului / maximului pe ox si oy
        int coordMinox = axisOffset + 20;
        int coordMaxox = width - axisOffset - 20;
        int coordMinoy = height-axisOffset - 20;
        int coordMaxoy = axisOffset + 20;

        // desenam 8 liniute intermediare pe ox si pe oy
        int unitSizeX = (coordMaxox - coordMinox) / (maxox - minox);
        int unitSizeY = (coordMaxoy - coordMinoy) / (maxoy - minoy);
        for (int i=0; i<8; i++) { // liniute pe ox
            int coordX = unitSizeX * (i + 1) + coordMinox;
            int coordY = height - axisOffset;
            g2d.drawLine(coordX, coordY - 4, coordX, coordY + 4);
        }
        for (int i=0; i<8; i++) { // liniute pe oy
            int coordX = axisOffset;
            int coordY = unitSizeY * (i + 1) + coordMinoy;
            g2d.drawLine(coordX - 4, coordY, coordX + 4, coordY);
        }

        // desenam punctele, impreuna cu linii intre ele, de culoarea specificata
        Color color;
        try {
            Field field = Class.forName("java.awt.Color").getField(culoare);
            color = (Color)field.get(null);
        } catch (Exception e) {
            color = Color.black; // Not defined
        }
        g2d.setColor(color);
        int coordXAnterior = -1;
        int coordYAnterior = -1;
        for (Pair<Integer, Integer> punct : perechi) {
            int coordX = unitSizeX * (maxox - punct.getKey()) + coordMinox;
            int coordY = unitSizeY * (maxoy - punct.getValue()) + coordMinoy;
            g2d.drawLine(coordX-3, coordY - 3, coordX + 3, coordY + 3);
            g2d.drawLine(coordX-3, coordY + 3, coordX + 3, coordY - 3);
            if (coordXAnterior != -1 && coordYAnterior != -1) {
                g2d.drawLine(coordX, coordY, coordXAnterior, coordYAnterior);
            }
            coordXAnterior = coordX;
            coordYAnterior = coordY;
        }

        // terminam imaginea
        g2d.dispose();

        // o returnam in raspuns
        response.setContentType("image/png");
        OutputStream os = response.getOutputStream();
        ImageIO.write(bufferedImage, "png", os);
        os.close();
    }

    protected void doGet(HttpServletRequest request,
                         HttpServletResponse response)
            throws ServletException, IOException {
        processRequest(request, response);
    }

    protected void doPost(HttpServletRequest request,
                          HttpServletResponse response)
            throws ServletException, IOException {
        processRequest(request, response);
    }
}
