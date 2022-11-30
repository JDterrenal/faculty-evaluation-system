Swal.fire({
    icon: 'success',
    title: 'Record Updated!',
    text: 'Record has beed updated successfully!',
}).then(function() {
    window.location = "/assets/php/loader.php";
});