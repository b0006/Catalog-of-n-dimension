function show_catalog()
{
    $.ajax({
        url: 'catalog.php',
        cache: false,
        success: function(html){
            $("#catalog").html(html);
            //$("select[name='section_select']").html(html);
        }
    });
}

$(document).ready(function(){
    show_catalog();
    setInterval('show_catalog()',1000);
});