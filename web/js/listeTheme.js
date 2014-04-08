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

                    gererValidationSuppression();
                } else {
                    alert('Une erreur est survenue');
                }
            },
            error: function() {
                alert('Une erreur est survenue');
            }
        });
    });

    function gererValidationSuppression() {
        $('#btnValidationSuppressionTheme').click(function(event) {
            event.preventDefault();

            $.ajax({
                url: Routing.generate("validationSuppressionTheme", {'id': $('#idThemeSuppression').val()}),
                type: 'POST',
                success: function(data) {
                    if (data.success) {
                        window.location = data.location;
                    } else {
                        alert('Une erreur est survenue');
                    }
                },
                error: function() {
                    alert('Une erreur est survenue');
                }
            });
        })
    }
});