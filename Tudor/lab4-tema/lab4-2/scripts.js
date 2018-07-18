$(document).ready(function() {

    $('#first_form').submit(function(e) {
        e.preventDefault();
        var name = $('#name').val();
        var datanasterii = $('#datanasterii').val();
        var email = $('#email').val();
        var varsta = $('#varsta').val();
        var splitt = datanasterii.split('/');
        var actualYearPresent=new Date().getFullYear();
        var actualMonthPresent=new Date().getMonth();
        var actualDayPresent=new Date().getDay();
        var aflaVarsta=actualYearPresent-parseInt(splitt[2]);


      $('.error').remove();

        if (name.length < 1) {
            $('#name').after('<span class="error">This field is required</span>');
            errorMessage = " Numele";
            $('#name').css('border-color', 'red');
        } else if(!name.match('^[a-zA-Z]{3,16}$')){
            $('#name').after('<span class="error">This field has to be without numbers</span>');
            errorMessage = " Numele";
            $('#name').css('border-color', 'red');
        }else{
            $('#name').css('border-color', '');
        }
        if (datanasterii.length < 1) {
            $('#datanasterii').after('<span class="error">This field is required</span>');
            errorMessage += " DataNasterii";
            $('#datanasterii').css('border-color', 'red');
        } else if(!datanasterii.match(/^\d\d?\/\d\d?\/\d\d\d\d$/)){
            $('#datanasterii').after('<span class="error">Error date must be dd/mm/yyyy</span>');
            errorMessage += " DataNasterii";
            $('#datanasterii').css('border-color', 'red');
        }else if(parseInt(splitt[2]) >= 2019){
            $('#datanasterii').after('<span class="error">Error year must be maximum 2018</span>');
            errorMessage += " DataNasterii";
            $('#datanasterii').css('border-color', 'red');
        } else if(parseInt(splitt[1]) >=13){
            $('#datanasterii').after('<span class="error">Error month must be maximum 12</span>');
            errorMessage += " DataNasterii";
            $('#datanasterii').css('border-color', 'red');
        } else if(parseInt(splitt[1])%2==0 && parseInt(splitt[0])>=31){
            $('#datanasterii').after('<span class="error">Error day must be maximum 30 because of the month</span>');
            errorMessage += " DataNasterii";
            $('#datanasterii').css('border-color', 'red');
        }else if(parseInt(splitt[1])%2==1 && parseInt(splitt[0])>=32){
            $('#datanasterii').after('<span class="error">Error day must be maximum 31 because of the month</span>');
            errorMessage += " DataNasterii";
            $('#datanasterii').css('border-color', 'red');
        }else if(parseInt(splitt[1])==02 && parseInt(splitt[2])%4==0 && parseInt(splitt[0])>=30 ){
            $('#datanasterii').after('<span class="error">Error day must be maximum 29 because of the february</span>');
            errorMessage += " DataNasterii";
            $('#datanasterii').css('border-color', 'red');
        } else{
            $('#datanasterii').css('border-color', '');
        }

        if (varsta.length < 1) {
            $('#varsta').after('<span class="error">This field is required</span>');
            errorMessage += " Varsta";
            $('#varsta').css('border-color', 'red');
        }else if(varsta!=aflaVarsta){
            $('#varsta').after('<span class="error">You dont know your age FOOOL</span>');
            errorMessage+=" Varsta";
            $('#varsta').css('border-color', 'red');
        } else{
            $('#varsta').css('border-color', '');
        }

        if (email.length < 1) {
            $('#email').after('<span class="error">This field is required</span>');
            errorMessage+=" Email";
            $('#email').css('border-color', 'red');
        } else {
            var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

            if (!regex.test(email)) {
                $('#email').after('<span class="error">Enter a valid email</span>');
                errorMessage+=" Email";
                $('#email').css('border-color', 'red');
            }else{
                $('#email').css('border-color', '');
            }


        }
        if( errorMessage.length > 0){
            alert("Campurile " + errorMessage + " nu sunt completate corect");
            errorMessage=[];
        }

    });
    });

