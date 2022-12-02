Swal.fire({
    icon: 'error',
    title: 'Error',
    text: 'Your action cannot be processed! Try something else...',
}).then(function() {
    window.location = "/assets/php/loader.php";
});