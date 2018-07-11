$(document).ready(function(){

//Mostrar Menu Principal
	$('#button-menu').click(function(){
		console.log("entra al menu");
		if ($('#button-menu').attr('class') == 'fa fa-bars') {
			$('#button-menu').removeClass('fa fa-bars').addClass('fa fa-times');
			$('.navegacion .menu').css({'left':'0px'});
			$('.navegacion').css({'width':'100%','background':'rgba(0,0,0,.3)'});

		}else{
			$('#button-menu').removeClass('fa fa-times').addClass('fa fa-bars');
			$('.navegacion .menu').css({'left':'-320px'});
			$('.navegacion .submenu').css({'left':'-320px'});
			$('.navegacion').css({'width':'0%','background':'rgba(0,0,0,.0)'});
		}
		console.log("muestra el menu");
	});


// Mostrar SubMenu

	$('.navegacion .menu > .item-submenu a').click(function(){
		var positionMenu = $(this).parent().attr('menu');
		//console.log(positionMenu);
		$('.item-submenu[menu='+positionMenu+'] .submenu').css({'left':'0px'});
	})

	$('.navegacion .submenu li.go-back').click(function(){
		$(this).parent().css({'left':'-320px'});
	})

	$("#dominios").click(function(){
		alert('funciono');
   		$("#contenido").load("../sel_medica/index.php");
   		$('#button-menu').removeClass('fa fa-close').addClass('fa fa-bars');
		$('.navegacion .menu').css({'left':'-320px'});
		$('.navegacion .submenu').css({'left':'-320px'});
		$('.navegacion').css({'width':'0%','background':'rgba(0,0,0,.0)'});
});

});

