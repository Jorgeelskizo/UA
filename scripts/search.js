document.getElementById('searchForm').addEventListener('submit', function(event) {
    event.preventDefault();

    var formData = new FormData(this);
    fetch('scripts/search_results.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        var resultsContainer = document.getElementById('results');
        resultsContainer.innerHTML = '';
        data.forEach(item => {
            resultsContainer.innerHTML += `<div>${item.nombre_proyecto} - ${item.fecha}</div>`;
        });
    })
    .catch(error => console.error('Error:', error));
});