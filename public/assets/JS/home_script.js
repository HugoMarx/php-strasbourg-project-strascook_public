document.addEventListener("DOMContentLoaded", function () {
    var element = document.getElementById("myToast");

   // Create toast instance
    var myToast = new bootstrap.Toast(element);
    myToast.show();
});
