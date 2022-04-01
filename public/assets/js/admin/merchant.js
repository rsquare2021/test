// レシート一覧
$(function() {
    var kengen = $('#kengen').val();
    var mk_id = $('#mk_id').val();
    var company_id = $('#company_id').val();
    $data ={
        url: '/_merchant/ajax/get_receipt.php',
		type: 'POST',
		data:{
			kengen: kengen,
            mk_id: mk_id,
            company_id: company_id,
		},
		dataType:'json'
    };
    callFrontAjax($data, receipt_get);
});
function receipt_get(data){
    $.each(data, function(key, value){
		$('.receipt_body').append('\
            <tr>\
                <td>'+value.id+'</td>\
                <td>'+value.user_id+'</td>\
                <td>'+value.mk_date+'</td>\
                <td>'+value.mk_time+'</td>\
                <td>'+value.company+'</td>\
                <td>'+value.mk_value+'</td>\
                <td>'+value.point+'</td>\
                <td>'+value.id+'</td>\
                <td>'+value.status+'</td>\
                <td>'+value.status+'</td>\
                <td><a href=""><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></a></td>\
            </tr>\
        ');
	});
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// callFrontAjax
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function callFrontAjax($data, fncSuccess, fncFail){
    //console.log($data);
    $.ajax($data)
        .done( function(data, textStatus, jqXHR){
            console.log(data);
            console.log(textStatus);
            console.log(jqXHR);
            console.log(jqXHR.responseText);
        
            if(fncSuccess != undefined){
                    fncSuccess(data);
                }
            })
        // 失敗
        .fail(function (jqXHR, textStatus, errorThrown) {
            alert('サーバとの通信に失敗しました');
            console.log(jqXHR);
            console.log(jqXHR.responseText);
            console.log(textStatus);
            console.log(errorThrown);
            if(fncFail != undefined){
                fncFail(data);
            }
        })
        // Ajaxリクエストが成功・失敗どちらでも発動
            .always( function(data) {
    });
};















