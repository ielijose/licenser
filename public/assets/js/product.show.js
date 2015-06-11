"use strict";
(function(){

    var id = $("#id").val();
    var status = '';

    $(".delete-ad").on('click', function(event) {
        event.preventDefault();

        if (confirm("Desea eliminar el estudiante? \nNo se puede revertir.")) {
            location.href = $(this).attr('href');
        }
    });

    $("#submit-update").on("click", function() {
        $("#product-update").submit();
    });

})();