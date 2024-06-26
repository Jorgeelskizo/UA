document.addEventListener('DOMContentLoaded', function () {
    toggleUploadFields();  // Configura los campos correctos al cargar la página
});

function previewImage() {
    var file = document.getElementById("file-upload").files[0];
    if (file) {
        var fileExt = file.name.split('.').pop().toLowerCase();
        if (!['jpg', 'jpeg', 'png'].includes(fileExt)) {
            alert("Por favor, selecciona una imagen en formato JPG o PNG.");
            resetUploadFileInput(); // Limpia el input si el formato no es correcto
            return;
        }

        var reader = new FileReader();
        reader.onload = function (e) {
            var img = document.getElementById("preview-img");
            img.src = e.target.result;
            img.style.display = 'block'; // Asegura que la imagen sea visible

            // Oculta solo el texto dentro del botón de subida
            var uploadText = document.querySelector('.custom-file-upload p');
            uploadText.style.display = 'none'; // Oculta el texto de subida
        };
        reader.readAsDataURL(file);
    }
}

function openUploadFileModal() {
    document.getElementById('uploadFileModal').style.display = 'block';
    toggleUploadFields(); // Asegura que los campos se muestren u oculten adecuadamente al abrir el modal
}

function toggleUploadFields() {
    var fileType = document.getElementById('uploadFileType').value;
    var isPDF = (fileType === 'pdf');
    document.getElementById('uploadTitleField').style.display = isPDF ? 'block' : 'none';
    document.getElementById('uploadDescField').style.display = isPDF ? 'block' : 'none';
    document.getElementById('altTextField').style.display = fileType === 'image' ? 'block' : 'none';
    document.getElementById('uploadImagePreview').style.display = 'none';
    resetUploadFileInput();
}


function previewUploadFile() {
    var file = document.getElementById('uploadFileInput').files[0];
    var fileType = document.getElementById('uploadFileType').value;
    if (!file) {
        alert('Por favor, selecciona un archivo para subir.');
        return;
    }

    var fileExt = file.name.split('.').pop().toLowerCase();
    if ((fileType === 'pdf' && fileExt !== 'pdf') || (fileType === 'image' && !['png', 'jpg', 'jpeg'].includes(fileExt))) {
        alert('Por favor, sube un archivo ' + (fileType === 'pdf' ? 'PDF.' : 'en formato PNG, JPG o JPEG.'));
        resetUploadFileInput(); // Limpia el input si el formato no es correcto
        return;
    }

    var fileNameDisplay = document.getElementById('fileNameDisplay');
    fileNameDisplay.textContent = `Archivo seleccionado: ${file.name}`;
    fileNameDisplay.style.marginTop = '10px';

    if (fileType === 'image') {
        var reader = new FileReader();
        reader.onload = function (e) {
            var img = document.getElementById('uploadImagePreview');
            img.src = e.target.result;
            img.style.display = 'block';
        };
        reader.readAsDataURL(file);
    } else {
        document.getElementById('uploadImagePreview').style.display = 'none'; // No mostrar previsualización para PDFs
    }
}

function addUploadFileToList() {
    var fileType = document.getElementById('uploadFileType').value;
    var fileInput = document.getElementById('uploadFileInput');
    if (!fileInput.files[0]) {
        alert('Por favor, selecciona un archivo para subir.');
        return;
    }

    var fileName = fileInput.files[0].name;
    var title = document.getElementById('uploadFileTitle').value.trim();
    var description = document.getElementById('uploadFileDescription').value.trim() || 'Sin descripción';
    var altText = document.getElementById('uploadAltText').value.trim();

    // Verificar requerimientos para imágenes y PDFs
    if (fileType === 'image' && !altText) {
        alert('Por favor, proporciona un texto alternativo para la imagen.');
        return;
    }
    if (fileType === 'pdf' && !title) {
        alert('Por favor, introduce un título para el archivo PDF.');
        return;
    }

    var documentObj = {
        type: fileType,
        fileName: fileName,
        title: title,
        description: description,
        altText: altText,
        file: fileInput.files[0]
    };

    documents.push(documentObj);
    updateDocumentList();
    closeUploadFileModal();
    resetUploadForm();
}



var documents = []; // Este array almacenará los objetos de los documentos

function updateDocumentList() {
    var docContainer = document.getElementById('documentList');
    docContainer.innerHTML = '';  // Limpiar el contenedor existente

    documents.forEach((doc, index) => {
        // Crear elementos de documento
        var div = document.createElement('div');
        div.className = 'document-item';

        var docIcon = document.createElement('img');
        docIcon.src = doc.type === 'image' ? 'img/image.png' : 'img/pdf.png';
        docIcon.alt = doc.altText || 'Document Icon';
        docIcon.style.width = '50px';
        docIcon.style.height = '50px';

        var fileInfo = document.createElement('div');
        fileInfo.className = 'document-info';
        fileInfo.innerHTML = `<p class="document-title">${doc.fileName}</p><p class="document-description">${doc.type === 'image' ? doc.altText : doc.description}</p>`;

        var deleteButton = document.createElement('button');
        deleteButton.className = 'delete-button';
        deleteButton.textContent = 'Eliminar';
        deleteButton.onclick = function() { removeDocument(index); };  // Añadir event listener

        div.appendChild(docIcon);
        div.appendChild(fileInfo);
        div.appendChild(deleteButton);

        docContainer.appendChild(div);
    });
}

function removeDocument(index) {
    documents.splice(index, 1);
    updateDocumentList();  // Actualizar la lista para reflejar los cambios
}

function resetUploadForm() {
    document.getElementById('uploadFileType').value = 'pdf';
    document.getElementById('uploadFileTitle').value = '';
    document.getElementById('uploadFileDescription').value = '';
    document.getElementById('uploadAltText').value = ''; // Asegurarse de limpiar también el texto alternativo
    resetUploadFileInput();
}

function resetUploadFileInput() {
    document.getElementById('uploadFileInput').value = '';
    document.getElementById('uploadImagePreview').src = '';
    document.getElementById('uploadImagePreview').style.display = 'none';
    document.getElementById('fileNameDisplay').textContent = '';
}

function closeUploadFileModal() {
    document.getElementById('uploadFileModal').style.display = 'none';
    resetUploadForm(); // Asegura que los campos están listos para la próxima vez
}

function validateAndUploadProject() {
    const titulo = document.getElementById('input_titulo').value;
    const descripcion = document.getElementById('descripcion').value;
    const horas = document.getElementById('input_horas').value;
    const tipo = document.getElementById('tipo_proyecto').value;
    const image = document.getElementById('file-upload').files[0];



    if (!image) {
        alert("Por favor, introdue la imagen de portada.");
        return;
    }
    else if (titulo.trim() === "") {
        alert("Por favor, introduce un título.");
        return;
    }
    else if (descripcion.trim() === "") {
        alert("Por favor, introduce una descripción.");
        return;
    }
    else if (horas.trim() === "") {
        alert("Por favor, introduce las horas.");
        return;
    }
    else if (tipo.trim() === "") {
        alert("Por favor, selecciona el tipo de proyecto.");
        return;
    }
    else if (documents.length === 0) {
        alert("Por favor, añade al menos un archivo multimedia.");
        return;
    }
    uploadProject();
}


function uploadProject() {
    const formData = new FormData();
    formData.append('titulo', document.getElementById('input_titulo').value);
    formData.append('descripcion', document.getElementById('descripcion').value);
    formData.append('horas', document.getElementById('input_horas').value);
    formData.append('tipo', document.getElementById('tipo_proyecto').value);
    formData.append('portada', document.getElementById('file-upload').files[0]);

    fetch('scripts/publicar.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log('Proyecto subido correctamente:', data);
                alert('Trabajo subido correctamente. Subiendo archivos PDF...');
                uploadMedia(data.id_proyecto);
            } else {
                throw new Error(data.error || 'Error desconocido al subir proyecto');
            }
        })
        .catch((error) => {
            console.error('Error:', error);
            alert('Hubo un error al subir el trabajo: ' + error.message);
        });
}

function uploadMedia(idProyecto) {

    documents.forEach((doc, index) => {
        const formData = new FormData();
        formData.append('id_proyecto', idProyecto);

        if (doc.type === 'pdf') {
            formData.append(`pdfFiles[${index}]`, doc.file);
            formData.append(`pdfTitles[${index}]`, doc.title);
            formData.append(`pdfDescriptions[${index}]`, doc.description || 'Sin descripción');
            formData.append('id_proyecto', idProyecto);

            fetch('scripts/publicar_pdf.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('PDFs subidos correctamente. Redirigiendo...');
                    } else {
                        throw new Error(data.error || 'Error desconocido al subir PDFs');
                    }
                })
                .catch(error => {
                    console.error('Error al subir PDFs:', error);
                    alert('Error al subir archivos PDF: ' + error.message);
                });
        } else if (doc.type === 'image') {
            formData.append('file', doc.file);
            formData.append('altText', doc.altText);
            formData.append('id_proyecto', idProyecto);
            fetch('scripts/publicar_img.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('PDFs subidos correctamente. Redirigiendo...');
                    } else {
                        throw new Error(data.error || 'Error desconocido al subir PDFs');
                    }
                })
                .catch(error => {
                    console.error('Error al subir PDFs:', error);
                    alert('Error al subir archivos PDF: ' + error.message);
                });
        }
    });
    alert('Archivos multimedia subidos correctamente. Redirigiendo...');
    window.location.href = 'index.php'; // Redirigir tras la subida exitosa
    
}








