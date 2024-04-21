const btn = document.getElementsByClassName('view-all')[0];

btn.addEventListener('click', ()=> {
    // Obtener el modal
    var modal = document.getElementById('modal');

    // Obtener el elemento <span> que cierra el modal
    var span = document.getElementsByClassName("close")[0];

    // Al hacer click en el botón, abre el modal 
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // Al hacer click en <span> (x), cierra el modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // Al hacer click fuera del modal, lo cierra
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
});


