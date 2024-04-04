const formularios_ajax = document.querySelectorAll(".FormularioAjax");
function enviar_formulario_ajax(e){
    e.preventDefault();

    let data = new FormData(this);
    let method = this.getAttribute("method");
    let action = this.getAttribute("action");
    let tipo = this.getAttribute("data-form");

    let encabezados = new Headers();

    let config = {
        method: method,
        headers: encabezados,
        mode: 'cors',
        cache: 'no-cache',
        body: data
    }

    let texto_alerta;

    if(tipo==="save"){
        texto_alerta="Los datos quedaran guardados en el sistema";
    }else if(tipo==="delete"){
        texto_alerta="Los datos serán eliminados completamente del sistema";
    }else if(tipo==="update"){
        texto_alerta="Los datos del sistema serán actualizados";
    }else if(tipo==="search"){
        texto_alerta="Se eliminará el término de búsqueda y tendrás que escribir uno nuevo";
    }else if(tipo==="loans"){
        texto_alerta="Desea remover los datos seleccionados para préstamos o reservaciones";
    }else if(tipo==="estado"){
        texto_alerta="Esta apunto de cambiar el estado del usuario.";
    }else if(tipo==="fichaXinstructor"){
        texto_alerta="Esta apunto de asignarle una ficha a un instructor.";
    }else{
        texto_alerta="Quieres realizar la operación solicitada";
    }


    Swal.fire({
        title: '¿Estás seguro?',
        text: texto_alerta,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#159650',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText: 'No'
    }).then((result) => {
        if(result.value){
            fetch(action,config)
            .then(respuesta => respuesta.json())
            .then(respuesta => {
                return alertas_ajax(respuesta);
            });
        }
    })

}

formularios_ajax.forEach(formularios => {
    formularios.addEventListener("submit", enviar_formulario_ajax);
});

const formularios_ajax_Search = document.querySelectorAll(".FormularioAjax1");

function enviar_formulario_ajax1(e){
    e.preventDefault();

    let data = new FormData(this);
    let method = this.getAttribute("method");
    let action = this.getAttribute("action");
    let tipo = this.getAttribute("data-form");

    let encabezados = new Headers();

    let config = {
        method: method,
        headers: encabezados,
        mode: 'cors',
        cache: 'no-cache',
        body: data
    }

    fetch(action,config)
    .then(respuesta => respuesta.json())
    .then(respuesta => {
        return alertas_ajax(respuesta);
    });

}

formularios_ajax_Search.forEach(formularios => {
    formularios.addEventListener("submit", enviar_formulario_ajax1);
});

function alertas_ajax(alerta){
    if(alerta.Alerta==="simple"){
        Swal.fire({
            title: alerta.Titulo,
            text: alerta.Texto,
            icon: alerta.Tipo,
            showConfirmButton: false,
            timer: 2500
        });
    }else if(alerta.Alerta==="recargar"){
        Swal.fire({
            title: alerta.Titulo,
            text: alerta.Texto,
            icon: alerta.Tipo,
            confirmButtonColor: '#159650',
            confirmButtonText: 'Aceptar'
        }).then((result) => {
            if(result.value){
                location.reload();
            }
        });
    }else if(alerta.Alerta==="limpiar"){
        Swal.fire({
            title: alerta.Titulo,
            text: alerta.Texto,
            icon: alerta.Tipo,
            showConfirmButton: false,
            timer: 2500
        }).then((result) => {
            if(result.value){
                document.querySelector(".FormularioAjax").reset();
            }
        });
    }else if(alerta.Alerta==="limpiarTime"){
        Swal.fire({
            title: alerta.Titulo,
            text: alerta.Texto,
            icon: alerta.Tipo,
            showConfirmButton: false,
            timer: 2500
        }).then(() => {
            document.querySelector(".FormularioAjax").reset();
            location.reload();
        });
    }else if(alerta.Alerta==="limpiarReset"){
        Swal.fire({
            title: alerta.Titulo,
            text: alerta.Texto,
            icon: alerta.Tipo,
            confirmButtonColor: '#159650',
            confirmButtonText: 'Aceptar'
        }).then((result) => {
            if(result.value){
                document.querySelector(".FormularioAjax").reset();
                location.reload();
            }
        });
    }else if(alerta.Alerta==="redireccionar"){
        window.location.href=alerta.URL;
    }
    
}

