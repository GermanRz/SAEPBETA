$.ajax({
    // your AJAX options here
}).fail(function(xhr) {
    alert("Fallo la solicitud AJAX: " + xhr.status + " - " + xhr.statusText);
});
