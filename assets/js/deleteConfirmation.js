function confirmationDelete(anchor) {
    Swal.fire({
        icon: "warning",
        title: "Are you sure?",
        text: "This action cannot be reverted!",
        showCancelButton: true,
        confirmButtonText: 'Delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
            ).then(function () {
                window.location = anchor.attr("href");
            });
        }
    });
}