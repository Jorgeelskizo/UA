document.addEventListener('DOMContentLoaded', function() {
    var selectElement = document.getElementById('language-select');
    if (selectElement) {
        selectElement.addEventListener('change', function() {
            var selectedLanguage = this.value;
            window.location.href = 'configs/leng.php?l=' + selectedLanguage;
        });
    } else {
        console.error("Elemento de selección de idioma no encontrado.");
    }
});

document.addEventListener('DOMContentLoaded', function() {
    var selectElement = document.getElementById('oscuro-select');
    if (selectElement) {
        selectElement.addEventListener('change', function() {
            var selectedLanguage = this.value;
            var devolver = '';
            if(selectedLanguage == "a"){
                devolver = 'Oscuro';
            }
            window.location.href = 'configs/modos.php?m=' + devolver;
        });
    } else {
        console.error("Elemento de selección de idioma no encontrado.");
    }
});

document.addEventListener('DOMContentLoaded', function() {
    var selectElement = document.getElementById('daltonico-select');
    if (selectElement) {
        selectElement.addEventListener('change', function() {
            var selectedLanguage = this.value;
            var devolver = 'r';
            if(selectedLanguage == "r"){
                devolver = 'Delta';
            }else if(selectedLanguage == "t"){
                devolver = 'Triple';
            }else if (selectedLanguage == "p"){
                devolver = 'Pro';
            }
            window.location.href = 'configs/modos.php?m=' + devolver;
        });
    } else {
        console.error("Elemento de selección de idioma no encontrado.");
    }
});

document.addEventListener('DOMContentLoaded', function() {
    var selectElement = document.getElementById('tam-select');
    if (selectElement) {
        selectElement.addEventListener('change', function() {
            var selectedLanguage = this.value;
            window.location.href = 'configs/tam.php?t=' + selectedLanguage;
        });
    } else {
        console.error("Elemento de selección de idioma no encontrado.");
    }
});
