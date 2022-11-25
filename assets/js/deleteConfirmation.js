function confirmationDelete(anchor) {
    var conf = confirm('Are you sure want to delete this record?');
    if (conf)
        window.location = anchor.attr("href");
}