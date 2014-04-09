$(function() {
    var $collectionHolder = $('#reponsesProposees');

    var $btnAjouterReponseProposee = $('#btnAjouterReponseProposee');

    $collectionHolder.find('.reponseProposee').each(function() {
        ajouterLienSuppression($(this));
    });

    $btnAjouterReponseProposee.click(function(event) {
        event.preventDefault();


        ajouterFormReponseProposee();
    });

    function ajouterFormReponseProposee() {
        var prototypeEnonce = $collectionHolder.attr('data-prototype');

        var index = $collectionHolder.find('.reponseProposee').length;

        var newForm = prototypeEnonce.replace(/__name__/g, index);

        var $divNewReponse = $('<div class="reponseProposee panel panel-default"></div>').append($('<div class="panel-body"></div>').append(newForm));
        ajouterLienSuppression($divNewReponse);
        $btnAjouterReponseProposee.before($divNewReponse);
    }

    function ajouterLienSuppression($divPanel) {
        var $lienSuppression = $('<a href="#" class="btn btn-danger btn-xs">Supprimer cette réponse</a>');
        var $divPanelFooter = $('<div class="panel-footer"></div>').append($lienSuppression);

        $divPanel.append($divPanelFooter);

        $lienSuppression.click(function(event) {
            event.preventDefault();

            $divPanel.remove();
        });
    }
});