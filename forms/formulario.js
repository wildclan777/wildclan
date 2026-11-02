$(document).ready(function(){
    $("#sendmail").click(function(){
        //alert(""); //Alerta inicial
        $.ajax({
            async: false,
            type: "POST",
            url: "forms/contact.php",
            data: $("#contacto_form").serialize(),
            success: function(data) {
                div = document.getElementById("resultado_form");
                if(data == true){
                    div.innerHTML = "<div style='color:#18b315; font-size:16px;'><strong>¡Su información ha sido enviada correctamente, nos pondremos en contácto con usted!</strong><div>";
                    // Descativamos el boton send-mail Enviar Mensaje 
                    div = document.getElementById("send-mail");
                    div.style["display"] = "none";
                    // Limpiamos el formulario
                    document.getElementById("contacto_form").reset();
                    // Despues de unos segundos mostramos de nuevo el botón enviar
                    setTimeout( function(){
                        div = document.getElementById("sendmail");
                        div.style["display"] = "inline-block";
                        div = document.getElementById("resultado_form");
                        div.innerHTML = "";
                    }, 5000 );
                }else{
                    div.innerHTML = data;
                }
            },
            error: function(data) {
                div.innerHTML = "ERROR AL ENVIAR, INTENTE MAS TARDE";
            }
        });
        return false; // Evitamos ejecutar el submit en el form.
    });
});

