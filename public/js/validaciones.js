
function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

function validate_CE(id_email) {
    $('#'+id_email).removeClass("is-invalid");
    $('#'+id_email).removeClass('is-valid');
    
    var email = $('#'+id_email).val();
    
    if(email==='ejemplo@dominio.com'){
        $('#'+id_email).addClass('is-invalid');
        return false;
    }

    if (validateEmail(email)) {
        $('#'+id_email).addClass('is-valid');
    } else {
        $('#'+id_email).addClass('is-invalid');
    }
    return false;
  }

  function valida_numeros(e){
    tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla==8){
        return true;
    }
        
    // Patron de entrada, en este caso solo acepta numeros
    patron =/[0-9]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}

function habilitaCampo(name){

    var campo = document.getElementById(name);
    
    console.log(campo.disabled);
    console.log(campo);
    
    if(campo.disabled){
        campo.disabled=false;
        campo.value="0"; 
    }else{
        campo.disabled=true;
        campo.value="0"; 
    }
}

function ConfirmDeleteModel(modelo,name,id){
    var result = confirm('*¿Seguro que deseas eliminar '+modelo+' '+id+'.- '+name+'?');

    if (result) {
        return true;
    } else {
        return false;
    }
  }