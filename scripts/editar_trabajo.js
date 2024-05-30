document.addEventListener('DOMContentLoaded', function () {
    toggleUploadFields();  // Configura los campos correctos al cargar la página
    const idTrabajo = new URLSearchParams(window.location.search).get('id');
    
    if (!idTrabajo) {
        console.error('No se ha especificado un ID de trabajo');
        return;
    }

    const closeDocumentButton = document.querySelector('.close[data-modal-id="documentModal"]');
    if (closeDocumentButton) {
        closeDocumentButton.addEventListener('click', closeDocumentModal);
    }

    // Añadir escuchador de eventos al botón de cierre del modal de imágenes
    const closeImageButton = document.querySelector('.close[data-modal-id="documentModalImage"]');
    if (closeImageButton) {
        closeImageButton.addEventListener('click', closeDocumentModalImage);
    }

    // Añadir escuchador de eventos al botón de cierre del modal de imágenes
    const closeImage = document.querySelector('.close[data-modal-id="imageModal"]');
    if (closeImage) {
        closeImage.addEventListener('click', closeImageModal);
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

    if (docs.length > 0) {
        const header = document.createElement('h3');
        header.id = 'h3-imagenes';
        header.textContent = 'Documentos PDF';
        docContainer.appendChild(header);
    }

    docs.slice(0, 3).forEach(doc => {
        

        const div = document.createElement('div');
        div.className = 'document-item';
        div.id = `media-item-pdf-${doc.id_pdf}`;

        const docIcon = document.createElement('img');
        docIcon.src = 'img/pdf.png';
        docIcon.alt = 'PDF Icon';
        docIcon.style.width = '50px';
        docIcon.style.height = '50px';

        const fileInfo = document.createElement('div');
        fileInfo.className = 'document-info';
        fileInfo.innerHTML = `<p class="document-title">${doc.titulo}</p><p class="document-description">${doc.descripcion || 'Sin descripción'}</p>`;

        const downloadLink = document.createElement('a');
        downloadLink.href = doc.ruta;
        downloadLink.download = '';  
        downloadLink.className = 'download-button';
        downloadLink.textContent = 'Descargar';

        const deleteButton = document.createElement('button');
        deleteButton.className = 'delete-button';
        deleteButton.textContent = 'Eliminar';
        deleteButton.onclick = function() {
            deleteMedia(doc.id_pdf, 'pdf');
        };

        div.appendChild(docIcon);
        div.appendChild(fileInfo);
        div.appendChild(downloadLink);
        div.appendChild(deleteButton);

        docContainer.appendChild(div);

        const initialHr = document.createElement('hr');
        docContainer.appendChild(initialHr);
    });

    // Añadir enlace para ver todos los documentos
    const viewAllLink = document.createElement('a');
    viewAllLink.href = "#";
    viewAllLink.className = 'view-all';
    viewAllLink.textContent = 'Ver todos los documentos';
    viewAllLink.onclick = function() {
        document.getElementById('documentModal').style.display = 'block';
        loadDocuments(); // Llama a la función para cargar los documentos
    };
    docContainer.appendChild(viewAllLink);
}

function loadDocuments() {
    var xhr = new XMLHttpRequest();
    // Recolectando el id_trabajo de la URL del navegador
    const id_trabajo = new URLSearchParams(window.location.search).get('id');
    
    // Asegúrate de que la URL es correcta y que el id_trabajo está siendo usado correctamente en la URL
    xhr.open("GET", `scripts/get_documents.php?id_trabajo=${id_trabajo}`, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById("document-list").innerHTML = xhr.responseText;
        }
    };
    xhr.send();
}

function displayIMG(docs) {
    const docContainer = document.getElementById('documentList');

    if (docs.length > 0) {
        const header = document.createElement('h2');
        header.textContent = 'Imagenes';
        docContainer.appendChild(header);
    }
    

    docs.slice(0, 3).forEach(doc => {
        

        const div = document.createElement('div');
        div.className = 'document-item';
        // Asegúrate que estás usando el identificador correcto aquí
        div.id = `media-item-img-${doc.id_archivo}`;

        const docIcon = document.createElement('img');
        docIcon.src = 'img/image.png';
        docIcon.alt = 'Imagen';
        docIcon.style.width = '50px';
        docIcon.style.height = '50px';

        const fileInfo = document.createElement('div');
        fileInfo.className = 'document-info';
        fileInfo.innerHTML = `<p class="document-title">${doc.nombre}</p><p class="document-description">${doc.texto_alternativo}</p>`;

        const viewButton = document.createElement('button');
        viewButton.className = 'view-button download-button';
        viewButton.textContent = 'Ver';
        // Añadir evento que abre el modal y muestra la imagen
        viewButton.onclick = function() {
            openImageModal(doc.nombre_archivo);
        };

        const downloadLink = document.createElement('a');
        downloadLink.href = doc.nombre_archivo;
        downloadLink.download = '';  
        downloadLink.className = 'download-button';
        downloadLink.textContent = 'Descargar';

        const deleteButton = document.createElement('button');
        deleteButton.className = 'delete-button';
        deleteButton.textContent = 'Eliminar';
        // Verifica que pasas el tipo correcto y el ID adecuado
        deleteButton.onclick = function() {
            deleteMedia(doc.id_archivo, 'img'); // Asegúrate de que el tipo es correcto
        };

        div.appendChild(docIcon);
        div.appendChild(fileInfo);
        div.appendChild(viewButton);
        div.appendChild(downloadLink);
        div.appendChild(deleteButton);

        docContainer.appendChild(div);
    });

    // Añadir enlace para ver todas las imágenes
    const viewAllLink = document.createElement('a');
    viewAllLink.href = "#";
    viewAllLink.className = 'view-all';
    viewAllLink.textContent = 'Ver todas las fotos';
    viewAllLink.onclick = function() {
        document.getElementById('documentModalImage').style.display = 'block';
        loadIMG(); // Llama a la función para cargar las imágenes
    };
    docContainer.appendChild(viewAllLink);

    const initialHr = document.createElement('hr');
    docContainer.appendChild(initialHr);
}

function loadIMG() {
    var xhr = new XMLHttpRequest();
    const id_trabajo = new URLSearchParams(window.location.search).get('id');
    
    xhr.open("GET", `scripts/get_fotos.php?id_trabajo=${id_trabajo}`, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById("photos-list").innerHTML = xhr.responseText;
            addEventListenersToViewButtons();
        }
    };
    xhr.send();
}

function addEventListenersToViewButtons() {
    const photosList = document.getElementById("photos-list");
    photosList.addEventListener('click', function(event) {
        const target = event.target;
        if (target.classList.contains('view-button')) {
            const imageUrl = target.getAttribute('data-image-url');
            if (imageUrl) {
                openImageModal(imageUrl);
            }
        }
    });
}

function openImageModal(imageSrc) {
    const modalImage = document.getElementById('modal-image');
    modalImage.src = imageSrc;
    document.getElementById('imageModal').style.display = 'block';
}


function deleteMedia(id, type) {
    if (!confirm('¿Estás seguro de que quieres eliminar este archivo?')) return;

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
            const elementId = `media-item-${type}-${id}`;
            const elementToRemove = document.getElementById(elementId);
            if (elementToRemove) {
                elementToRemove.remove();
            } else {
                console.error('Element to remove not found:', elementId);
            }
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

function closeDocumentModal() {
    document.getElementById('documentModal').style.display = 'none';
}

function closeDocumentModalImage() {
    document.getElementById('documentModalImage').style.display = 'none';
}

function closeImageModal() {
    document.getElementById('imageModal').style.display = 'none';
}

function handleNewImageSelection() {
    const fileInput = document.getElementById('file-upload');
    const currentImage = document.getElementById('currentProjectImage');
    if (fileInput.files.length > 0) {
        const reader = new FileReader();
        reader.onload = function (e) {
            currentImage.src = e.target.result;
        };
        reader.readAsDataURL(fileInput.files[0]);
    }
}

function validateAndUploadProject() {
    const idTrabajo = new URLSearchParams(window.location.search).get('id');
    const titulo = document.getElementById('input_titulo').value;
    const descripcion = document.getElementById('descripcion').value;
    const horas = document.getElementById('input_horas').value;
    const tipo = document.getElementById('tipo_proyecto').value;
    const imageInput = document.getElementById('file-upload');

    if (!idTrabajo) {
        alert("Error: No se ha especificado un ID de trabajo.");
        return;
    }
    if (titulo.trim() === "") {
        alert("Por favor, introduce un título.");
        return;
    }

    if (descripcion.trim() === "") {
        alert("Por favor, introduce una descripción.");
        return;
    }

    if (horas.trim() === "" || isNaN(horas)) {
        alert("Por favor, introduce las horas en formato numérico.");
        return;
    }

    if (tipo.trim() === "") {
        alert("Por favor, selecciona el tipo de proyecto.");
        return;
    }
    const formData = new FormData();
    formData.append('id_trabajo', idTrabajo);
    formData.append('titulo', titulo);
    formData.append('descripcion', descripcion);
    formData.append('horas', horas);
    formData.append('tipo', tipo);
    if (imageInput.files.length > 0) {
        formData.append('portada', imageInput.files[0]); // Añade la imagen solo si existe
    }

    fetch('scripts/editarModificar.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(text => {
        const data = JSON.parse(text);
        if (data.success) {
            console.log('Proyecto actualizado correctamente:', data);
            alert('Trabajo actualizado correctamente.');
            uploadMedia(); // Subir archivos multimedia después de actualizar el proyectos
        } else {
            throw new Error(data.error || 'Error desconocido al actualizar el proyecto');
        }
    })
    .catch((error) => {
        console.error('Error:', error);
        alert('Hubo un error al actualizar el trabajo: ' + error.message);
    });
}


function uploadMedia() {
    const idProyecto = new URLSearchParams(window.location.search).get('id');
    documents.forEach((doc, index) => {
        const formData = new FormData();

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
    alert('Todo OK, redirigiendo...');
    window.location.href = 'index.php'; // Redirigir tras la subida exitosa
}
