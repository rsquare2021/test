// レシート撮影

(function(){

    $data ={
        url: '/_merchant/ajax/get_receipt.php',
        type: 'POST',
        //data:data,
        dataType: "json",
        contentType: false,
        processData: false
    };
    callFrontAjax($data, function(data){
        //data = (JSON.stringify(data));
        $contena = $("#mk_tbody");
        if(data.length > 0){
            var cnt = 0;
            for(var n=0;n<data.length;n++){
                var user = data[n].user;
                
                for(var i=0;i<user.length;i++){
                    cnt++
                    var sts_base = user[i].status;
                    var sts = sts_base.split('');
                    var st = "";
                    $.each(sts, function(index, value) {
                        if(index == 0) { //対象商品
                            if(value == "1") {
                                st += "<span>商品</span>";
                            }
                        } else if(index == 1) { //数量
                            if(value !== "0") {
                                st += "<span>数量</span>";
                            }
                        } else if(index == 2) { //数量
                            if(value !== "0") {
                                if ( st.indexOf('数量') != -1) {
                                } else {
                                    st += "<span>数量</span>";
                                }
                            }
                        } else if(index == 3) { //数量
                            if(value !== "0") {
                                if ( st.indexOf('数量') != -1) {
                                } else {
                                    st += "<span>数量</span>";
                                }
                            }
                        } else if(index == 4) { //対象期間
                            if(value !== "0") {
                                st += "<span>日時</span>";
                            }
                        } else if(index == 5) { //対象店舗
                            if(value !== "0") {
                                st += "<span>店舗</span>";
                            }
                        } else if(index == 6) { //重複
                            if(value !== "0") {
                                st += "<span>重複</span>";
                            }
                        } else if(index == 7) { //NGワード
                            if(value !== "0") {
                                st += "<span>NGワード強</span>";
                            }
                        } else if(index == 8) { //強制送信
                            if(value !== "0") {
                                st += "<span>強制送信</span>";
                            }
                        } else {
                        }
                    })
                    var company = user[i].company;
                    var tel_company = user[i].tel_company;
                    var com = '';
                    if(tel_company == null || tel_company == '') {
                        com = company;
                    } else {
                        com = tel_company;
                    }
                    if(i == 0){
                        var $elem = $('<tr id="id_'+user[i].id+'" data-status="'+user[i].status+'" data-now="'+user[i].now_st+'" data-meken_value="">\
                                        <td class="mk_no">'+cnt+'</td>\
                                        <td class="mk_id">'+user[i].id+'</td>\
                                        <td rowspan="'+user.length+'" class="mk_user">'+user[i].user_id+'</td>\
                                        <td class="now_status">'+user[i].now_status+'<br><span class="nt_only">'+com+'</span></td>\
                                    </tr>');
                    }
                    else{
                        var $elem = $('<tr id="id_'+user[i].id+'" data-status="'+user[i].status+'" data-now="'+user[i].now_st+'" data-meken_value="">\
                                        <td class="mk_no">'+cnt+'</td>\
                                        <td class="mk_id">'+user[i].id+'</td>\
                                          <td class="now_status">'+user[i].now_status+'<br><span class="nt_only">'+com+'</span></td>\
                                      </tr>');
                    }
                    $elem.data({
                        "user":user[i]
                    });
                    $contena.append($elem);
                    $elem.on("click",function(){
                        //選択した要素を確認
                        $('#mk_tbody').children('tr').removeClass('active');
                        $(this).addClass('active');
                        //初期セット
                        $('.right_content .inner').show();
                        $('.right_content img').css('opacity','1');
                        $('.index_text').hide();
                        var work_id = $(this).attr('id');
                        $('#work').val(work_id);
                        $('.wrap').hide();
                        $('.wrap').each(function(){
                            $(this).removeClass('active');
                        });
                        $('.confirm_btn').each(function(){
                            $(this).removeClass('active');
                        });

                        $('.duplicate_text').removeClass('active');
                        if($(this).hasClass('change')) {
                            $('.modal_status .flex').hide();
                        } else {
                            $('.modal_status .flex').show();
                        }
                        $('#st_product').val('0');
                        $('#st_term').val('0');
                        $('#st_shop').val('0');
                        $('#st_duplicate').val('0');
                        $('#st_ngword').val('0');
                        var kengen_ng = false;
                        var now_st = $(this).data('now');
                        now_st = parseInt(now_st);
                        var kengen = $('#user_kengen').val();
                        if(kengen == '0' && now_st > 19) {
                            kengen_ng = true;
                        } else if(kengen == '1' && now_st > 29) {
                            kengen_ng = true;
                        }
                        $('#now_st').val(now_st);
                        var user = $(this).data("user");
                        var status = $(this).data('status');
                        var st_detail = "";
                        $('.status_table td').each(function(){
                            $(this).removeClass('active');
                            $(this).removeClass('ok');
                        });
                        var target_status = (String(status)).split('');
                        
                        $.each(target_status, function(index, value) {
                            if(index == 0) { //対象商品
                                if(value == "1") {
                                    $('.status_table .product').addClass('active');
                                    $('#st_product').val('1');
                                    $('.wrap_st_product').addClass('active');
                                }
                            } else if(index == 1) { //給油量
                                if(value == "1") {
                                    $('.status_table .oil').addClass('active');
                                    $('#st_oil').val('1');
                                    $('.wrap_st_product').addClass('active');
                                } else if(value == "2") {
                                    $('.status_table .oil').addClass('active');
                                    $('#st_oil').val('1');
                                    $('.wrap_st_product').addClass('active');
                                }
                            } else if(index == 2) { //自己申告
                                if(value == "1") {
                                    $('.status_table .input').addClass('active');
                                    $('#st_input').val('1');
                                    $('.wrap_st_product').addClass('active');
                                }
                            } else if(index == 3) { //給油差
                                if(value == "1") {
                                    $('.status_table .diff').addClass('active');
                                    $('#st_diff').val('1');
                                    $('.wrap_st_product').addClass('active');
                                }
                            } else if(index == 4) { //対象期間
                                if(value == "1") {
                                    $('.status_table .term').addClass('active');
                                    $('#st_term').val('1');
                                    $('.wrap_st_term').addClass('active');
                                } else if(value == "2") {
                                    $('.status_table .term').addClass('active');
                                    $('#st_term').val('1');
                                    $('.wrap_st_term').addClass('active');
                                }
                            } else if(index == 5) { //対象店舗
                                if(value == "1") {
                                    $('.status_table .shop').addClass('active');
                                    $('#st_shop').val('1');
                                    $('.wrap_st_shop').addClass('active');
                                } else if(value == "2") {
                                    $('.status_table .shop').addClass('active');
                                    $('#st_shop').val('1');
                                    $('.wrap_st_shop').addClass('active');
                                }
                            } else if(index == 6) { //重複
                                if(value == "1") {
                                    $('.status_table .duplicate').addClass('active');
                                    $('#st_duplicate').val('1');
                                    $('.wrap_st_duplicate').addClass('active');
                                } else if(value == "2") {
                                    $('.status_table .duplicate').addClass('active');
                                    $('#st_duplicate').val('1');
                                    $('.wrap_st_duplicate').addClass('active');
                                }
                            } else if(index == 7) { //NGワード
                                if(value == "1") {
                                    $('.status_table .ngword').addClass('active');
                                    $('#st_ngword').val('1');
                                    $('.wrap_st_ngword').addClass('active');
                                    st_detail += "<p class='alert_ngword'>対象外のレシートである可能性が高いです。</p>";
                                } else if(value == "2") {
                                    $('.status_table .ngword').addClass('active');
                                    $('#st_ngword').val('1');
                                    $('.wrap_st_ngword').addClass('active');
                                }
                            } else if(index == 8) { //強制送信
                                if(value == "1") {
                                    $('.duplicate_text').addClass('active');
                                }
                            } else {
                            }
                        });

                        //現在のステータス

                        var now = user.now;
                        var cnt = 0;
                        var val = '';
                        now = (String(now)).split('');
                        $.each(now, function(cnt, val) {
                            if(cnt == 0) { //対象商品
                                if(val == "2") {
                                    $('.status_table .product').addClass('ok');
                                    $('.alert_product').hide();
                                    $('#st_product').val('2');
                                }
                            } else if(cnt == 1) { //給油量
                                if(val == "2") {
                                    $('.status_table .oil').addClass('ok');
                                    $('.alert_oil').hide();
                                    $('#st_oil').val('2');
                                }
                            } else if(cnt == 2) { //自己申告
                                if(val == "2") {
                                    $('.status_table .input').addClass('ok');
                                    $('.alert_input').hide();
                                    $('#st_input').val('2');
                                }
                            } else if(cnt == 3) { //給油差
                                if(val == "2") {
                                    $('.status_table .diff').addClass('ok');
                                    $('.alert_diff').hide();
                                    $('#st_diff').val('2');
                                }
                            } else if(cnt == 4) { //対象期間
                                if(val == "2") {
                                    $('.status_table .term').addClass('ok');
                                    $('.alert_term').hide();
                                    $('#st_term').val('2');
                                }
                            } else if(cnt == 5) { //対象店舗
                                if(val == "2") {
                                    $('.status_table .shop').addClass('ok');
                                    $('.alert_shop').hide();
                                    $('#st_shop').val('2');
                                }
                            } else if(cnt == 6) { //重複
                                if(val == "2") {
                                    $('.status_table .duplicate').addClass('ok');
                                    $('.alert_duplicate').hide();
                                    $('#st_duplicate').val('2');
                                }
                            } else if(cnt == 7) { //NGワード
                                if(val == "2") {
                                    $('.status_table .ngword').addClass('ok');
                                    $('.alert_ngword').hide();
                                    $('#st_ngword').val('2');
                                }
                            } else if(cnt == 8) { //強制送信
                                if(val == "2") {
                                    $('.status_table .count').addClass('ok');
                                    $('.alert_count').hide();
                                    $('#st_count').val('2');
                                }
                            } else {
                            }
                        });

                        $('#modal_h').val('');
                        $('#modal_m').val('');
                        var time = user.time;
                        var mk_time = user.mk_time;
                        if(time) {
                            var modal_h = time.slice(0,2);
                            var modal_m = time.slice(-2);
                            $("#modal_h").val(modal_h);
                            $("#modal_m").val(modal_m);
                        }
                        if(mk_time) {
                            var modal_h = mk_time.slice(0,2);
                            var modal_m = mk_time.slice(-2);
                            $("#modal_h").val(modal_h);
                            $("#modal_m").val(modal_m);
                        }
                        $("#modal_post_date").text(user.post_date);
                        $("#modal_create").val(user.mk_date);
                        $("#modal_receipt_no").val(user.mk_no);
                        $("#modal_data_no").text(user.id);
                        $("#modal_tel").val(user.mk_tel);
                        $("#modal_user_id").text(user.user_id);
                        var self_oil = user.receipt_value;
                        if(self_oil == '' || self_oil == null) {
                            $('#self_oil').html('未入力');
                        } else {
                            $('#self_oil').html(self_oil);
                        }
                        var products = user.products;
                        var oil = products.substr(products.indexOf('C') + 1);
                        if(oil == '' || oil == null) {
                            $('#receipt_oil').html('読み取れません');
                        } else {
                            $('#receipt_oil').html(oil);
                        }
                        $('#modal_status').val(status);
                        $("#receipt_img").attr("src","../assets/ajax"+user.src);
                        $("#zoomImg").attr("src","../assets/ajax"+user.src);
                        if(user.receipt_no !== null || user.receipt_no !== '') {
                            $('#modal_receipt_no').val(user.mk_no);
                        }
                        if(user.mk_tel) {
                            $('#modal_tel').val(user.mk_tel);
                        } else {
                        }
                        if(user.mk_date !== null || user.mk_date !== '') {
                            $('#modal_date').val(user.mk_date);
                        }
                        $('#check_oil').val(user.mk_value);
                        $('#memo').val(user.receipt_memo);
                    })
                }
            }
        }
    });
}());









