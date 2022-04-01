(function(){

    function getUsers(){
        $data ={
            url: './ajax/get_users.php',
            type: 'POST',
            //data:data,
            dataType: "json",
            contentType: false,
            processData: false
        };
        callFrontAjax($data, function(data){
            var $contena = $("#mk_tbody");
            $contena.empty();
            var cnt = 0;
            if(data.length > 0){
                for(var i=0;i<data.length;i++){
                    var $check;
                    if(data[i].active == 1){
                        $check = '<input id="togActive" type="checkbox" checked data-id="'+data[i].id+'" data-toggle="toggle">';
                    }
                    else{
                        $check = '<input id="togActive" type="checkbox" data-id="'+data[i].id+'" data-toggle="toggle">';
                    }
                    var $elem = $('<tr>\
                                        <td >'+data[i].mail+'</td>\
                                        <td >'+data[i].pass+'</td>\
                                        <td >'+$check+'</td>\
                                    </tr>');
                    $contena.append($elem);  
                    var $check = $elem.find("#togActive");
                    $check.bootstrapToggle();
                    $check.change(function(){
                        var active = 0;
                        if($(this).prop("checked") == 1){
                            active = 1;
                        }
                        $data ={
                            url: './ajax/set_active.php',
                            type: 'POST',
                            data:{
                                active:active,
                                id:$(this).data("id"),
                            },
                            dataType: "json",
                        };
                        callFrontAjax($data, function(data){
                            if(!data.result){
                                alert("エラー");
                            }
                        });
                    });
                }
            }
        });
    }

    getUsers();

    $("#createBtn").on("click",function(){
        if( $("#user_id").val() == "" ){
            alert("IDを入力してください");
            return
        }

        $data ={
            url: './ajax/create_user.php',
            type: 'POST',
            data:{
                user_id:$("#user_id").val(),
            },
            dataType: "json",
        };
        callFrontAjax($data, function(data){
            if(data.result){
                $("#user_id").val("");
                getUsers();
            }
            else{
                alert("エラー");
            }
        });
    });

}());