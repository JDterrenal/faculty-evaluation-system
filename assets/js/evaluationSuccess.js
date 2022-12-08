Swal.fire({
    icon: 'success',
    title: 'Evaluation Success!',
    text: 'Your evaluation has been recorded!',
}).then(function() {
    window.location = "/dashboard.php";
});