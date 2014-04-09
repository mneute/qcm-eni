$(function() {
    $('.colSupprimerTest a').click(function(event) {
        event.preventDefault();

        $.ajax({
            url: $(this).attr('href'),
            type: 'POST',
            success: function(data) {
                if (data.success) {
                    $('#modalConfirmationSuppressionTest .modal-content').html(data.html);
                    $('#modalConfirmationSuppressionTest').modal('show');

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
        $('#btnValidationSuppressionTest').click(function(event) {
            event.preventDefault();

            $.ajax({
                url: Routing.generate("validationSuppressionTest", {'id': $('#idTestSuppression').val()}),
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