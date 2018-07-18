<%@ page import="model.Comment" %>
<%@ page import="java.util.ArrayList" %>
<%@ page import="model.Authenticator" %>
<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<html>
  <head>
      <title>Java</title>
  </head>
  <body bgcolor = "#FFFFFF">
  <h1>10 Motive Sa Inveti Java</h1>
  <p>1. Prietenos cu începătorii: <br>Aşa cum am spus-o deja, Java a luat fiinţă pentru a uşura munca programatorilor, lucru care, în timp, a permis şi amatorilor să deprindă meşteşugul construirii de software. Totuşi, vorbim despre un limbaj de programare de nivel înalt. Java se ocupă practic de cele mai complexe detalii ale unui computer, ca de exemplu gestionarea memoriei. Acest lucru îi permite developer-ului să se concentreze strict pe programare, fără să-şi mai facă alte griji în privinţa detaliilor.<br>
      <br>
      2. Accesibil pentru autodidacţi:<br> Limbajul Java are în spate o istorie de peste două decenii, astfel că, la ora actuală, orice întrebare sau neclaritate ai avea despre utilizarea sa a fost deja pusă, s-a răspuns la ea, iar răspunsul a fost verificat şi validat. Este greu practic, într-o asemenea etapă, să pui în dificulate un motor de căutare cu o problemă de codare Java. Iar acesta este un avantaj major în special pentru cei care aleg fie să înveţe programare singuri, fie optează pentru un curs intensiv.<br>
      <br>
      3. Instrumente utile:<br> Java dispune de o interfaţă de programare a aplicaţiilor (API) foarte bogată, precum şi de un ecosistem cu sursă deschisă extrem de ajutător.  Java vine, aşadar, la pachet cu tot felul de unelte care să te ajute indiferent de produsul software pe care ai vrea să îl realizezi.<br>
      <br>
      4. Puterea exemplului:<br> Când vorbim despre limbajul Java, discutăm despre un instrument de programare orientată pe obiect. Astfel, Java agreează cele mai bune practici ale acestui tip de design de software şi recomandă învăţarea şi urmarea acestora. Totodată, promovează din plin folosirea cât mai adecvată, iar multe dintre tiparele de design folosesc Java ca limbaj de facto. Desigur, înţelegerea tiparelor de design ajută la generarea unui cod cu o sustenabilitate mai bună.<br>
      <br>
      5. Pune la dispoziţie editoare uimitoare:<br> Mediul de dezvoltare integrat disponibil pentru Java este atât de grozav, că te va lăsa cu gura căscată. Acesta nu doar că te avertizează instantaneu în momentul în care ai comis o greşeală, dar îţi pune la dispoziţie şi sugestii cum ai putea să repari eroarea pentru a nu-ţi compromite munca. Mulţi utilizatori laudă modul prin care sugestiile sunt însoţite de explicaţii, un lucru cât se poate de util mai ales începătorilor.<br>
      <br>
      6. Java în tot şi-n toate:<br> Am pomenit deja în introducere de istoria bogată pe care limbajul de programare Java o are în palmares. Aşa se face că veţi da de codurile scrise astfel aproape oriunde v-aţi putea imagina. Spre exemplu, dezvoltatorii de aplicaţii complexe preferă Java graţie stabilităţii şi capabilităţii sale de a nu da erori atunci când se confruntă cu volume impresionante de date. În prezent, potrivit specialiştilor, Java luptă pentru supremaţie în ceea ce numim Internet of Things. Astfel că, în ziua în care vom putea spune nu numai în glumă că telefoanele noastre fac şi cartofi prăjiţi, cel mai probabil acel lucru va fi realizat printr-un cod Java.<br>
      <br>
      7. Un limbaj de circulaţie care deschide multe uşi:<br> Devine deja inutil să reiterăm omniprezenţa limbajului Java, aşa că nu ar trebui să ne surprindă câte uşi poate deschide. A deprinde tainele limbajului Java îţi poate creşte şansele de ascensiune la actualul loc de muncă sau, de ce nu, îţi poate deschide orizonturi către oportunităţi de carieră mult mai atractive din punct de vedere financiar.<br>
      <br>
      8. Oferă-ţi singur o mână de ajutor:<br> De ce să aştepţi uneori cu frustrare chiar ca cineva, altcineva să conceapă o aplicaţie informatică pentru nevoile tale când şi tu poţi face asta? Software developerii care lucrează pentru sistemul Android folosesc aproape în exclusivitate limbajul Java. Apucă-te aşadar şi tu să înveţi Java şi îţi vei putea face singur viaţa mai uşoară dezvoltând aplicaţiile pe care le consideri utile.<br>
      <br>
      9. Este uşor de învăţat:<br> Este timpul să ne alungăm din minte concepţia că programarea este un domeniu accesibil strict pasionaţilor de ştiinţe exacte. După cum o spun chiar trainerii, legărura dintre matematică şi programare se termină destul de repede. Învăţarea limbajului Java se aseamănă mult mai mult cu învăţarea unei limbi străine. Nu ai nevoie la început decât de voinţă, determinare, perseverenţă şi, poate cel mai important, răbdare.<br>
      <br>
      10. Intră în comunitatea celor mai buni:<br> Devenind un cunoscător al codării Java, te alături uneia dintre cele mai numeroase comunităţi de programatori din lume. Conform unor statistici de specialitate, în 2015 Java a fost pe primul loc în topul limbajelor de programare folosite la nivel mondial. De altfel, Oracle, deţinătorul Java, lucrează constant pentru menţinerea lui la standarde înalte. Comunitatea programatorilor Java este renumită pentru suportul de breaslă pe care îl oferă membrilor săi, aşa că învăţând Java „You’ll never walk alone”, dacă ar fi să parafrazăm imnul unei celebre echipe de fotbal.<br>
  </p><br>
  <h2>Comentarii:</h2><br>
  <div>
    <%
        Authenticator authenticator=new Authenticator();
        ArrayList<Comment> comments=authenticator.getAuthorizedComments();
        for (Comment c: comments) {
            out.println("<p><b>"+c.getEmail()+": </b>"+c.getComment()+"</p>");
        }
    %>
  </div>


  <h3>Adauga comentariu</h3>
  <form action="AddCommentsController" method="post">
  <label>Email:</label>
  <input type="email" name="email"><br><br>
  <label>Comentariu:</label><br>
  <textarea name="comment"></textarea><br><br>
  <input type="submit" name="submit">
  </form>

  </body>
</html>
