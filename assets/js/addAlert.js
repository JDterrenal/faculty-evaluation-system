Swal.fire({
    icon: 'success',
    title: 'Record Added!',
    text: 'Record has been added successfully!',
}).then(function () {
    window.location = "/assets/php/loader.php";
});