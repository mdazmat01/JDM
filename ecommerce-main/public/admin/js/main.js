setTimeout(function(){
    $('.alert').slideUp()
}, 3000);


// $(document).ready(function(){
//     $('.edit_btn').addClass('btn-danger')
//     $('.edit_btn').removeClass('btn-success')
// });

// $('.edit_btn').addClass('btn-danger')
// $('.edit_btn').removeClass('btn-success')


$(document).ready(function(){
    let table = new DataTable('#myTable');
});

function successToast(msg) {
    Toastify({
        gravity: 'bottom',
        position: 'center',
        style: {
            background: 'green'
        },
        text: msg,
        duration: 3000
        }).showToast();
}

function errorToast(msg) {
    Toastify({
        gravity: 'bottom',
        position: 'center',
        style: {
            background: 'red'
        },
        text: msg,
        duration: 3000
        }).showToast();
}
