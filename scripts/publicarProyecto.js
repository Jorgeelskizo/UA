function previewImage() {
    var file = document.getElementById("file-upload").files[0];
    if (file) {
        var reader = new FileReader();
        reader.onload = function(e) {
            var img = document.getElementById("preview-img");
            img.src = e.target.result;
            img.style.display = 'block'; // Asegura que la imagen sea visible
        };
        reader.readAsDataURL(file);
    }
}

