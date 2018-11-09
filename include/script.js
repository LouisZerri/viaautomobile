$(document).ready(function(){
		
	$("#hide").hide();

	$("#password").focus(function() {
		$('#hide').show("slow");
	})

	$('#password').on('input',function(e){
		var caractere = $(this).val();

		if(caractere.length >= 9)
		{
			$('#c').hide();	
		}
		else
		{
			$('#c').show();
		}
		if(/[0-99999999]/.test(caractere))
		{
			$('#0').hide();				
		}
		else
		{
			$('#0').show();				
		}
		if(/[A-Z]/.test(caractere))
		{
			$('#M').hide();
		}
		else
		{
			$('#M').show();				
		}
		if(/[a-z]/.test(caractere))
		{
			$('#m').hide();
		}
		else
		{
			$('#m').show();				
		}
		if(/\W/.test(caractere))
		{
			$('#caractere').hide();			
		}
		else
		{
			$('#caractere').show();
		}


		if($('#c').attr("style") == "font-weight: bold; font-size: 15px; display: none;" && $('#0').attr("style") == "font-weight: bold; font-size: 15px; display: none;" && $('#M').attr("style") == "font-weight: bold; font-size: 15px; display: none;" && $('#m').attr("style") == "font-weight: bold; font-size: 15px; display: none;" && $('#caractere').attr("style") == "font-weight: bold; font-size: 15px; display: none;")
		{
			$('#button-addon2').text("Valide");
			$('#button-addon2').attr("class","btn btn-success");
			$('#hide').attr("style","");
		}
		else
		{
			$('#button-addon2').text("Non valide");
			$('#button-addon2').attr("class","btn btn-danger");
			$('#hide').attr("style","border: 1px solid red; border-radius: 5px; outline: none; border-color: #9ecaed; box-shadow: 0 0 10px #9ecaed;");
		}
	})
});