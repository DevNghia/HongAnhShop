$(document).ready(function () {
    $("#sort").on("change", function () {
        var url = $(this).val();
        if (url) {
            window.location = url;
        }
        return false;
    });
});
