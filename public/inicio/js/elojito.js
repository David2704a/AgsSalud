function mostrarContrasena(){
    var tipo = document.getElementById("password");
    if(tipo.type == "password"){
        tipo.type = "text";
        $('#the-eye').removeClass('fa fa-eye-slash').addClass('fa fa-eye');

    }else{
        tipo.type = "password";
        $('#the-eye').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
    }
}
