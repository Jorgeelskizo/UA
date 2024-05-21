function previewImage() {
    var file = document.getElementById("file-upload").files;
    if (file.length > 0) {
        var fileReader = new FileReader();

        fileReader.onload = function (event) {
            document.getElementById("preview-img").setAttribute("src", event.target.result);
            document.getElementById("preview-img").style.display = "block";
        };

        fileReader.readAsDataURL(file[0]);
    }
}
