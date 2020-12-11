$( document ).ready(function() {
    $('#loader').hide()
    $('#keywoard').on('keyup', () =>{
        $('#loader').show()
        // $('#dataTable').load('ajax/mahasiswa.php?keywoard=' + $('#keywoard').val())
        $.get('ajax/mahasiswa.php?keywoard=' + $('#keywoard').val(), (data)=> {
            $('#dataTable').html(data)
            $('#loader').hide()
        })
    })
});