$(function() {
    $('.colSupprimerTheme a').click(function(event) {
        event.preventDefault();

        $.ajax({
            url: $(this).attr('href'),
            type: 'POST',
            success: function(data) {
                if (data.success) {
                    $('#modalConfirmationSuppressionTheme .modal-content').html(data.html);
                    $('#modalConfirmationSuppressionTheme').modal('show');
                } else {
                    alert('Une erreur est survenue');
                }
            },
            error: function() {
                alert('Une erreur est survenue');
            }
        });
    });
});