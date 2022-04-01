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
