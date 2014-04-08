$(document).ready(function() {
    $('.lien-confirmation-lancement-test').bind('click', function(event) {
        event.preventDefault();
        var $element = $(this);
        $.ajax({
            url: $element.attr('href'),
            type: 'POST',
            error: function() {
                alert('Une erreur est survenue');
            },
            success: function(data) {
                if (data.success) {
                    $('#myModal .modal-content').html(data.html);
                    $('#myModal').modal('show');
                } else {
                    alert('Une erreur est survenue');
                }
            }
        });
    });
});