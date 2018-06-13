/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var seq;
//編集業行クリック　モーダルオープングローバル変数指定
$('tr').click(function () {
    seq = $(this).attr('id');
    //カンマは削除
    var price = $(this).find('.price').text();
    price= price.replace( /,/g , "" ) ;

    var category_name = $(this).find('.category_name').text();
    var comment = $(this).find('.comment').text();
    $('#m_price').val(price);
    $('#m_category_name').val(category_name);
    $('#m_comment').val(comment);
    console.log(comment);
    $('#modal1').modal('open');
});

$('#update').click(function () {
    $("#mode").val('update');
    $('#price').val($('#m_price').val());
    $('#comment').val($('#m_comment').val());
    $('<input>').attr({
        type: 'hidden',
        name: 'seq',
        value: seq
    }).appendTo('form');

    $('form').submit();
});