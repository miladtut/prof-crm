$('#flash-overlay-modal').modal();

$(document).on('click','.delete',function (e) {
    e.preventDefault();
    var url = $(this).attr('href');
    var itemName = $(this).data('name');
    $('#deleteModal').find('#target').attr('href',url);
    $('#deleteModal').find('#msg').html(itemName);
    $('#deleteModal').modal('show');
});

$(document).on('click','.status',function (e) {
    e.preventDefault();
    $('#statusModal').modal('show');
});

$(document).on('click','.payment',function (e) {
    e.preventDefault();
    $('#paymentModal').modal('show');
});


$(document).on('click','.reject',function (e) {
    e.preventDefault();
    var url = $(this).data('href');
    $('#rejectForm').attr('action',url);
    $('#rejectModal').modal('show');
});


$(document).on('click','.reason',function (e) {

    e.preventDefault();
    var txt = $(this).data('txt');
    $('#showModal').find('.txt-show').html(txt);
    $('#showModal').modal('show');
});
