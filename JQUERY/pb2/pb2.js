
	$(document).ready(function(){
		$('#myform').submit(function(func) {
			func.preventDefault();
		    var valid = true;
		    message='';
		        

		    if($('#name').val()===''){
		         $('#name').css('border','2px solid red');
		         message += "please enter your name" +'\n';
	       	}else{
	       		$('#name').css('border','1px solid black');
	       	}
	       	if($('#email').val()===''){
		         $('#email').css('border','2px solid red');
		         message += "please enter a valid email" +'\n';
	       	}else{
	       		$('#email').css('border','1px solid black');
	       	}
	       	if($('#varsta').val()===''){
		         $('#varsta').css('border','2px solid red');
		         message += "please enter your age" +'\n';
	       	}else{
	       		$('#varsta').css('border','1px solid black');
	       	}
	       	if($('#dataN').val()===''){
		         $('#dataN').css('border','2px solid red');
		         message += "please enter your birth date" +'\n';
	       	}else{
	       		$('#dataN').css('border','1px solid black');
	       	}

		    if(message.length >0) {
		        alert(message);
		        message=[];
		    }else alert("Succesful submit");
		});
	});

