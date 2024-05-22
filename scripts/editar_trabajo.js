document.addEventListener('DOMContentLoaded', function () {
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

        div.appendChild(docIcon);
        div.appendChild(fileInfo);
        div.appendChild(downloadButton);

        docContainer.appendChild(div);
    });
}

function displayIMG(docs) {
    const docContainer = document.getElementById('documentList');
    docs.forEach(doc => {
        const div = document.createElement('div');
        div.className = 'document-item';

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

        div.appendChild(docIcon);
        div.appendChild(fileInfo);
        div.appendChild(downloadButton);

        docContainer.appendChild(div);
    });
}
