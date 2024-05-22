document.addEventListener('DOMContentLoaded', function () {
    toggleUploadFields();  // Configura los campos correctos al cargar la página
    const idTrabajo = new URLSearchParams(window.location.search).get('id');

    if (!idTrabajo) {
        console.error('No se ha especificado un ID de trabajo');
        return;
    }

    fetch(`scripts/editar_trabajoGETPDF.php?id=${idTrabajo}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.error) {
                console.error(data.error);
                alert('No se pudo cargar los documentos PDF');
            } else {
                displayPDF(data);
            }
        })
        .catch(error => {
            console.error('Error al cargar los PDFs:', error);
            alert('Error al cargar los documentos: ' + error.message);
        });


    fetch(`scripts/editar_trabajoGETIMG.php?id=${idTrabajo}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.error) {
                console.error(data.error);
                alert('No se pudo cargar los documentos PDF');
            } else {
                displayIMG(data);
            }
        })
        .catch(error => {
            console.error('Error al cargar los PDFs:', error);
            alert('Error al cargar los documentos: ' + error.message);
        });
});

function displayPDF(docs) {
    const docContainer = document.getElementById('documentList');
    docs.forEach(doc => {
        const div = document.createElement('div');
        div.className = 'document-item';
        div.id = `media-item-${doc.id_archivo}`;

        const docIcon = document.createElement('img');
        docIcon.src = 'img/pdf.png';
        docIcon.alt = 'PDF Icon';
        docIcon.style.width = '50px';
        docIcon.style.height = '50px';

        const fileInfo = document.createElement('div');
        fileInfo.className = 'document-info';
        fileInfo.innerHTML = `<p class="document-title">${doc.titulo}</p><p class="document-description">${doc.descripcion || 'Sin descripción'}</p>`;

        const downloadButton = document.createElement('button');
        downloadButton.className = 'download-button';
        downloadButton.textContent = 'Descargar';
        downloadButton.onclick = function () {
            window.location.href = doc.ruta;
        };

        const deleteButton = document.createElement('button');
        deleteButton.className = 'delete-button';
        deleteButton.textContent = 'Eliminar';
        deleteButton.onclick = function() {
            deleteMedia(doc.id_pdf, 'pdf'); // Llamada a la función deleteMedia con el ID y el tipo
        };

        div.appendChild(docIcon);
        div.appendChild(fileInfo);
        div.appendChild(downloadButton);
        div.appendChild(deleteButton);

        docContainer.appendChild(div);
    });
}

function displayIMG(docs) {
    const docContainer = document.getElementById('documentList');
    docs.forEach(doc => {
        const div = document.createElement('div');
        div.className = 'document-item';
        div.id = `media-item-${doc.id_archivo}`;

        const docIcon = document.createElement('img');
        docIcon.src = 'img/image.png';
        docIcon.alt = 'Imagen';
        docIcon.style.width = '50px';
        docIcon.style.height = '50px';

        const fileInfo = document.createElement('div');
        fileInfo.className = 'document-info';
        fileInfo.innerHTML = `<p class="document-title">${doc.nombre}</p><p class="document-description">${doc.texto_alternativo}</p>`;

        const downloadButton = document.createElement('button');
        downloadButton.className = 'download-button';
        downloadButton.textContent = 'Descargar';
        downloadButton.onclick = function () {
            window.location.href = doc.ruta;
        };

        const deleteButton = document.createElement('button');
        deleteButton.className = 'delete-button';
        deleteButton.textContent = 'Eliminar';
        deleteButton.onclick = function() {
            deleteMedia(doc.id_archivo, 'image'); 
        };

        div.appendChild(docIcon);
        div.appendChild(fileInfo);
        div.appendChild(downloadButton);
        div.appendChild(deleteButton);

        docContainer.appendChild(div);
    });
}


function deleteMedia(id, type) {
    if (!confirm('¿Estás seguro de que quieres eliminar este archivo?')) {
        return;
    }

    const formData = new FormData();
    formData.append('id', id);
    formData.append('type', type);

    fetch('scripts/eliminarArchivo.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Archivo eliminado correctamente');
            // Actualiza la interfaz de usuario eliminando el elemento
            document.getElementById(`media-item-${id}`).remove();
        } else {
            alert('Error al eliminar el archivo: ' + data.error);
        }
    })
    .catch(error => {
        console.error('Error al eliminar el archivo:', error);
        alert('Error al eliminar el archivo: ' + error.message);
    });
}


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