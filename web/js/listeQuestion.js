$(function() {
    $('.colSupprimerQuestion a').click(function(event) {
        event.preventDefault();

        $.ajax({
            url: $(this).attr('href'),
            type: 'POST',
            success: function(data) {
                if (data.success) {
                    $('#modalConfirmationSuppressionQuestion .modal-content').html(data.html);
                    $('#modalConfirmationSuppressionQuestion').modal('show');

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
        $('#btnValidationSuppressionQuestion').click(function(event) {
            event.preventDefault();

            $.ajax({
                url: Routing.generate("validationSuppressionQuestion", {'id': $('#idQuestionSuppression').val()}),
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