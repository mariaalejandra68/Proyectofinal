<script>
    let btn_salir2 = document.querySelector(".btn-exit-system2");
    let btn_salir = document.querySelector(".exit-system-cerrar");

    btn_salir2.addEventListener('click', function(e) {
        e.preventDefault();
        Swal.fire({
            title: '¿Salir?',
            text: '¿Seguro de que quieres salir?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#159650',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, salir',
            cancelButtonText: 'No, quedarme'
        }).then((result) => {
            if (result.value) {
                let url = '<?php echo SERVERURL; ?>ajax/loginAjax.php';
                let token = '<?php echo ($_SESSION['token_spc']); ?>';
                let nombre = '<?php echo ($_SESSION['id_spc']); ?>';

                let datos = new FormData();
                datos.append("token", token);
                datos.append("nombre", nombre);

                fetch(url, {
                        method: 'post',
                        body: datos
                    })
                    .then(respuesta => respuesta.json())
                    .then(respuesta => {
                        return alertas_ajax(respuesta);
                    });
            }
        });
    });
    btn_salir.addEventListener('click', function(e) {
        e.preventDefault();
        Swal.fire({
            title: '¿Salir?',
            text: '¿Seguro de que quieres salir?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#159650',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, salir',
            cancelButtonText: 'No, quedarme'
        }).then((result) => {
            if (result.value) {
                let url = '<?php echo SERVERURL; ?>ajax/loginAjax.php';
                let token = '<?php echo ($_SESSION['token_spc']); ?>';
                let nombre = '<?php echo ($_SESSION['identificacion_spc']); ?>';

                let datos = new FormData();
                datos.append("token", token);
                datos.append("nombre", nombre);

                fetch(url, {
                        method: 'post',
                        body: datos
                    })
                    .then(respuesta => respuesta.json())
                    .then(respuesta => {
                        return alertas_ajax(respuesta);
                    });
            }
        });
    });
</script>