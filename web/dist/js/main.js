/**
 * Created by MaolmeoX on 28/03/2017.
 */
$(document).ready(function () {
    $('#remplissage_bdd').on('click', function () {

        if (confirm("Êtes-vous sur de vouloir réinitialiser la base de données à l'état initial ?")) {
            $.ajax({
                url: Routing.generate('remplissage_bdd'),
                beforeSend: function () {
                },
                success: function (d) {
                    $('#remplissage_bdd').removeClass('btn-default').addClass('btn-success').html('<i class="fa fa-check-square-o" aria-hidden="true"></i> ' + d);
                    setTimeout(function () {
                        location.reload();
                    }, 4000)
                }
            });
        }

    });

    var client = $('#appbundle_rendezvous_client');
    client.change(function () {
        var $form = $(this).closest('form');
        var data = {};
        data[client.attr('name')] = client.val();
        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            data: data,
            success: function (html) {
                $('#appbundle_rendezvous_docteur').replaceWith(
                    $(html).find('#appbundle_rendezvous_docteur')
                );
            }
        });
    });
});