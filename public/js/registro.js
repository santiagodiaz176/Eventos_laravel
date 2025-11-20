$(document).ready(main);
 
var contador = 0; 
function main(){
	//Habilitamos el botón de ingresar
	$('#btningresar').attr("disabled", false);
	$('.registro').click(function(){
		// $('nav').toggle(); 
 
		if(contador == 1){
			$('#formReg').animate({				
				//left: '0'
				margin: '0 0 0 0px'				
			});
			contador = 0;
			//Habilitamos el botón de ingresar
			$('#formLogin').css("display", "block");
			$('#formReg').css("display", "none");			
			$('#btningresar').attr("disabled", false);
			$('#btningresar').css("background", "transparent");	
			//Escondemos el link de cerrar registro
			$('#cambiaNombre').css("display", "none");		    
			//Mostramos el link de crear cuenta
		    $('#crearCuenta').css("display", "block");	
		} else {
			contador = 1;
			//Desabilitamos el botón de ingresar
			$('#formReg').css("display", "block");	
			$('#formLogin').css("display", "none");
			$('#btningresar').attr("disabled", true);
			$('#btningresar').css("background", "#D8D8D8");	
			//Escondemos el link de crear cuenta
		    $('#crearCuenta').css("display", "none");	
			//Mostramos el link de cerrar registro
		    $('#cambiaNombre').css("display", "block");				
			$('#formReg').animate({
				//left: '-100%'
				margin: '0 0 0 0'
				
			});
		} 
	});	
	

 };