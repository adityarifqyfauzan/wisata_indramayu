// Sweet alert
const swalsuccess = $('.swal-success').data('swal');
const swalerror = $('.swal-error').data('swal');

if (swalsuccess) {
    Swal.fire({
        title: "Berhasil",
        text: swalsuccess,
        icon: 'success'
    })
}

if (swalerror) {
    Swal.fire({
        title: "Error",
        text: swalerror,
        icon: 'error'
    })
}

$(document).on('click', '.btn-aktif', function (e) {

    e.preventDefault();
    const href = $(this).attr('href');

    const message = $(this).attr('data-message');

    Swal.fire({
        title: 'Anda yakin?',
        text: "Ingin " + message + " akun ini",
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#5bc0de',
        cancelButtonColor: '#d33',
        confirmButtonText: message + "!"
    }).then((result) => {
        if (result.value) {
            document.location.href = href
        }
    })

})

$(document).on('click', '.btn-logout', function (e) {

    e.preventDefault();
    const href = $(this).attr('href');

    Swal.fire({
        title: 'Anda yakin?',
        text: "Ingin logout dari sistem",
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#5bc0de',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Logout!'
    }).then((result) => {
        if (result.value) {
            document.location.href = href
        }
    })

})