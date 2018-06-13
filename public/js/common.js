//マテリアライズ
$(document).ready(function () {
    $('select').formSelect();
    $('.modal').modal();
     $('.sidenav').sidenav();
});


$(function () {

    dateFormat();
    numFormat();

});

$('.side-open').click(function(){
    $('.sidenav').sidenav('open');
});

/**
 * オンロード日付フォーマット処理
 * 
 */
function dateFormat() {
    $('.Ymd').each(function (i) {
        var text = $(this).text();
        var year = text.substr(0, 4);
        var month = text.substr(4, 2);
        var day = text.substr(6, 2);
        var res_text = year + '/' + month + '/' + day + '';
        $(this).text(res_text);
    });
    
    $('.YmdHi').each(function (i) {
        var text = $(this).text();
        var year = text.substr(0, 4);
        var month = text.substr(4, 2);
        var day = text.substr(6, 2);
        var hour = text.substr(8, 2);
        var minute = text.substr(10, 2);
        var res_text = year + '/' + month + '/' + day + ' '+hour+':'+minute+'';
        $(this).text(res_text);
    });
}


/*
 * オンロード数値フォーマット
 */
function numFormat() {
    $('.number').each(function (i) {
        var res_text = $(this).text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, '$1,');
        $(this).text(res_text);
    });
}