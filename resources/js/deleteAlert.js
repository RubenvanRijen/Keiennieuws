$('.show_confirm_delete_booking_dashboard').click(function(event) {
    var form = $(this).closest("form");
    var name = $(this).data("name");
    event.preventDefault();
    swal({
            title: `Weet u zeker dat u deze reservering wilt verwijderen`,
            text: "U kunt nog altijd een nieuwe reservering plaatsen als u dat wilt",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                form.submit();
            }
        });
});