var ok=0;
var simulate=0;
$(document).ready(function(){
    var n=$("li").length;
        $(".next").click(function () {
            if (ok < n) {
                $("li:first-child").appendTo('ul.list');
                ok++;

            } else {
                alert("Nu se mai poate da next");
            }
        });

    function simulateClick() {
        if (ok < n && simulate===0) {
        $('.next').click();
            if(ok===n){
                simulate=1;
            }
        }
        if (simulate===1){
            $(".previous").click();
            if(ok===0){
                simulate=0;
            }
        }
    }

    setInterval(simulateClick, 5000);

       $(".previous").click(function () {
        if(ok>0) {
            ok--;
            $("li:last-child").prependTo('ul.list');
        } else if(ok===0){
            alert("Nu se poate da previous");
        }
    });

});