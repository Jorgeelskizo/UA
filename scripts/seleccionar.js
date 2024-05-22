document.addEventListener('DOMContentLoaded', function() {
    var selectElement = document.getElementById('language-select');
    if (selectElement) {
        selectElement.addEventListener('change', function() {
            var selectedLanguage = this.value;
            window.location.href = 'nombre_idi/leng.php?l=' + selectedLanguage;
        });
    } else {
        console.error("Elemento de selección de idioma no encontrado.");
    }
});
