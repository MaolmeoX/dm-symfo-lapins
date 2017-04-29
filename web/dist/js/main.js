/**
 * Created by MaolmeoX on 28/03/2017.
 */
$(document).ready(function () {
    $('#remplissage_bdd').on('click', function () {
        $.ajax({
            beforeSend: function(){
                // Handle the beforeSend event
            },
            complete: function(){
                // Handle the complete event
            }
        });
    })
});