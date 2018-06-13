$('#add_budget').click(function(){
    
    $('#modal1').modal('open');
});

//
//var seq;
//編集業行クリック　モーダルオープングローバル変数指定
$('tr').click(function () {
    seq = $(this).attr('id');
    var price = $(this).find('.price').text();
    var category_name = $(this).find('.category_name').text();
    $('#update_price').val(price);
    $('#update_name').val(category_name);
    console.log(price);
    $('#update_modal').modal('open');
});


$('#update').click(function () {
  
    $('<input>').attr({
        type: 'hidden',
        name: 'seq',
        value: seq
    }).appendTo('form');
    
    $('form').submit();
});