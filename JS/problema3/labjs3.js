var count=0;
    var first=0;
    var second=0;
    var hit=0;

    var array=[10,10,12,12,25,25,30,30,52,52,63,63,74,74,18,18];

    function shuffleArray(){
    array.sort(function() { return 0.5 - Math.random() });
    }


    function clicks(index){
        console.log("e in click "+index+" "+count);



        if(count==0){
            first=index;
            console.log("first="+first+" "+array[index]);
            document.getElementsByTagName("td")[index].innerHTML=array[index];
            count=1;
        }
        else {


            second=index;
            console.log("second="+second+" "+array[index]+"\n");
            document.getElementsByTagName("td")[index].innerHTML=array[index];
            count=2;

            var firstpick=document.getElementsByTagName("td")[first];
            var secondpick= document.getElementsByTagName("td")[second];
            if(array[first]==array[second]){
                hit++;
                count=0;

            }
            else{
                setTimeout(function () {
                    firstpick.innerHTML="";
                    secondpick.innerHTML="";
                    
                },2000);
                count=0;
            }

        }

        if(hit==array.length/2){

            alert("Congratulations! Game completed. \nPress F5 to start new game.")
        }


    }