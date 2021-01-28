$(document).ready(function () {

    // Изменить статус комментария в админке
    $('.comments-status').on('change', function () {
        confirm('Вы действительно хотите изменить статус?');
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            enctype: 'multipart/form-data',
            data: {
                'status' : $(this).find('select').val(),
                '_method': 'PUT'
            },
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data){
                alert('Комментарий опубликован');
            },
            error: function(data) {
                console.log('Ошибка');
            }
        });
    });

    $('.articles-status').on('change', function () {
        confirm('Вы действительно хотите изменить статус статьи?');
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            enctype: 'multipart/form-data',
            data: {
                'status' : $(this).find('select').val(),
                'update_ajax': true,
                '_method': 'PUT'
            },
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data){
                alert('Статус изменен');
                console.log(data)
            },
            error: function(data) {
                console.log('Ошибка');
                console.log(data)
            }
        });
    });

});
