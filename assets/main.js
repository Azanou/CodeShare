$(document).ready(function () {

    $('[data-confirm]').on('click', function (e) {
        e.preventDefault();
        const href = $(this).attr('href');
        const message = $(this).data('confirm');

        Swal.fire({
            title: 'Êtes-vous sûr ?',
            text: message,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Supprimer',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = href;
            }
        });
    });
        // let's implement the logic of our search bar right here

        $("#searchbox").on('keyup', function(){

            var url = "ajax/search.php"
            var query = $(this).val()

            if(query.length > 0){
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {
                        query: query
                    },
                    beforeSend: function(){
                        $('#spinner').show();
                    },
                    success: function(response) {
                      $('#display-results').html(response).show()
                      $('#spinner').hide()
                    }
                })
            }else{
                $('#display-results').hide()
            }         
        })

});

