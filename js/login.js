// public/js/login_specific.js
document.addEventListener("DOMContentLoaded", function() {
    function vista_form() {
        let pass = document.getElementById('pass');
        let ver = document.getElementById('ver');
        let ocultar = document.getElementById('ocultar');
        if (pass.type === 'password') {
            pass.type = 'text';
            ver.style.display = 'none';
            ocultar.style.display = 'block';
        } else {
            pass.type = 'password';
            ver.style.display = 'block';
            ocultar.style.display = 'none';
        }
    }
    // Asocia la función a la ventana para que onclick en HTML la encuentre
    window.vista_form = vista_form;
});