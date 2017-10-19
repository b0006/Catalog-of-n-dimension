$(document).ready(function(){   
    //Отправляем данные формы
    $('#addForm').submit(function(e){
        e.preventDefault();
        //Получаем объект формы
        var form = $('#addForm');

        $.ajax({ 
            url: form.attr('action'),
            type: form.attr('method'),
            cache: false,
            data: form.serialize(),

            success: function (data) {
                alert("Раздел добавлен");
                form.trigger('reset');
                $('.add').modal('hide');
            }                      
        });       
    });
    
    /*$('#addForm').submit(function(e){
        //e.preventDefault();
        
        $.ajax({
            url: 'select.php',
            cache: false,
            success: function(html){
                $("div[name='name'] > select").html(html);
            }
        });  
    });*/
    
    $('#updateForm').submit(function(e){
        e.preventDefault();
        //Получаем объект формы
        var form = $('#updateForm');

        $.ajax({ 
            url: form.attr('action'),
            type: form.attr('method'),
            cache: false,
            data: form.serialize(),

            success: function (data) {
                alert("Раздел изменен");
                form.trigger('reset');
                $('.update').modal('hide');
            }
        });
    });
    
    /*$('#updateForm').submit(function(e){
        e.preventDefault();
        
        $.ajax({
            url: 'section_edit.php',
            cache: false,
            success: function(html){
                $("div[name='edit'] > select").html(html);
            }
        }); 
    });*/
    
    $('#deleteForm').submit(function(e){
        e.preventDefault();
        //Получаем объект формы
        var form = $('#deleteForm');

        $.ajax({ 
            url: form.attr('action'),
            type: form.attr('method'),
            cache: false,
            data: form.serialize(),

            success: function (data) {
                alert("Раздел удален");
                form.trigger('reset');
                $('.delete').modal('hide');
            }
        });
    });
    
    /*$('#deleteForm').submit(function(e){
        e.preventDefault();
        //Получаем объект формы
        var form = $('#deleteForm');

        $.ajax({
            url: 'select.php',
            cache: false,
            success: function(html){
                $("div[name='name'] > select").html(html);
            }
        }); 
    });*/
    
    $('#addFormElem').submit(function(e){
        e.preventDefault();
        //Получаем объект формы
        var form = $('#addFormElem');

        $.ajax({ 
            url: form.attr('action'),
            type: form.attr('method'),
            cache: false,
            data: form.serialize(),

            success: function (data) {
                alert("Элемент добавлен");
                form.trigger('reset');
                $('.add').modal('hide');
            }
        });
    });
    
    $('#updateFormElem').submit(function(e){
        e.preventDefault();
        //Получаем объект формы
        var form = $('#updateFormElem');

        $.ajax({ 
            url: form.attr('action'),
            type: form.attr('method'),
            cache: false,
            data: form.serialize(),

            success: function (data) {
                alert("Элемент изменен");
                form.trigger('reset');
                $('.update').modal('hide');
            }
        });
    });
    
    $('#deleteFormElem').submit(function(e){
        e.preventDefault();
        //Получаем объект формы
        var form = $('#deleteFormElem');

        $.ajax({ 
            url: form.attr('action'),
            type: form.attr('method'),
            cache: false,
            data: form.serialize(),

            success: function (data) {
                alert("Элемент удален");
                form.trigger('reset');
                $('.delete').modal('hide');
            }
        });
    });
})