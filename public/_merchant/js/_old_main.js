// レシート撮影

(function(){

    $data ={
        url: './ajax/get_receipt.php',
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
                        // var meken_value = $(this).children('.now_status').attr('id');
                        // if(meken_value) {
                        //     var meken_value = (String(meken_value)).split('');
                        //     $.each(meken_value, function(index, value) {
                        //         if(index == 0) { //商品
                        //             if(value == "2") {
                        //                 $('.confirm_product').addClass('active');
                        //             }
                        //         } else if(index == 1) { //期間
                        //             if(value == "2") {
                        //                 $('.confirm_term').addClass('active');
                        //             }
                        //         } else if(index == 2) { //店舗
                        //             if(value == "2") {
                        //                 $('.confirm_shop').addClass('active');
                        //             }
                        //         } else if(index == 3) { //重複
                        //             if(value == "2") {
                        //                 $('.confirm_duplicate').addClass('active');
                        //             }
                        //         } else if(index == 4) { //NGワード
                        //             if(value == "2") {
                        //                 $('.confirm_ngword').addClass('active');
                        //             }
                        //         }
                        //     });
                        // }
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

    // 確認ステータス変更
    $(".confirm_btn").on("click",function(){
        var target = $(this).data('conf');
        var check_oil = $('#check_oil').val();
        var term = $('#modal_create').val();
        var term_h = $('#modal_h').val();
        var term_m = $('#modal_m').val();
        var modal_receipt_no = $('#modal_receipt_no').val();
        var modal_tel = $('#modal_tel').val();
        if(target == 'product') {
            if(check_oil.match(/^[a-zA-Z0-9!-/:-@¥[-`{-~]+$/) && check_oil !== '') {
            } else {
                alert('数量を正しく入力して「確認済み」を押してください。');
                exit();
            }
        }
        if(target == 'term') {
            if(term == '' || term_h == '' || term_m == '') {
                alert('対象期間を入力して「確認済み」を押してください。');
                exit();
            }
            if(term_h.match(/^[0-9]+$/) && term_m.match(/^[0-9]+$/)){
            } else {
                alert('対象期間を入力して「確認済み」を押してください。');
                exit();
            }
        }
        if(target == 'duplicate') {
            if(modal_receipt_no.match(/^[a-zA-Z0-9!-/:-@¥[-`{-~]+$/) && modal_receipt_no !== '') {
            } else {
                alert('レシートNoを正しく入力して「確認済み」を押してください。');
                exit();
            }
        }
        if(target == 'shop') {
            if(modal_tel.match(/^[0-9]+$/) && modal_tel !== '') {
            } else {
                alert('電話番号を正しく入力して「確認済み」を押してください。');
                exit();
            }
        }
        $(this).toggleClass('active');
        if($(this).hasClass('active')) {
            $('#st_'+target).val('2');
        } else {
            $('#st_'+target).val('1');
        }
     });

    // スタッフからの送信
    $(".pre_submit").on("click",function(){
        var user_id = $('#user_id').val();
        var modal_receipt_no = $('#modal_receipt_no').val();
        var modal_tel = $('#modal_tel').val();
        var modal_create = $('#modal_create').val();
        var modal_h = $('#modal_h').val();
        var modal_m = $('#modal_m').val();
        var check_oil = $('#check_oil').val();
        var memo = $('#memo').val();
        var modal_data_no = $('#modal_data_no').html();
        var action = $(this).attr('id');
        var st_product = $('#st_product').val();
        var st_term = $('#st_term').val();
        var st_shop = $('#st_shop').val();
        var st_duplicate = $('#st_duplicate').val();
        var st_ngword = $('#st_ngword').val();
        // バリデーション
        var btns = 0;
        var conf = 0;
        $('.wrap.active').each(function(){
            btns += 1;
        });
        $('.confirm_btn.active').each(function(){
            conf += 1;
        });
        if(action == 'pre_accept' && btns !== conf) {
            alert('入力に不備があるか、確認が完了していません。');
            exit();
        }

        // var check_string = false;
        // var check_ng = false;
        // var check_duplicate = false;
        // var check_oil_ng = false;
        // if(modal_receipt_no.match(/^[a-zA-Z0-9!-/:-@¥[-`{-~]*$/)) {
        // } else {
        //     check_string = true;
        // }
        // if(modal_tel.match(/^[0-9!-/:-@¥[-`{-~]*$/)){
        // } else {
        //     check_string = true;
        // }
        // if(modal_create.match(/^[0-9!-/:-@¥[-`{-~]*$/)) {
        // } else {
        //     check_string = true;
        // }
        // if(check_oil.match(/^[0-9!-/:-@¥[-`{-~]*$/)) {
        // } else {
        //     check_string = true;
        // }
        // if(check_string == true) {
        //     alert('メモ以外は半角数字もしくは半角記号で入力してください。');
        //     return;
        // }
        // if(st_product == 1 || st_oil == 1 || st_input == 1 || st_diff == 1 || st_term == 1 || st_shop == 1 || st_duplicate == 1 || st_ngword == 1 || st_count == 1) {
        //     check_ng = true;
        // }
        // if(modal_receipt_no == '' || modal_tel == '' || modal_create == '') {
        //     check_duplicate = true;
        // }
        // if(check_oil == '') {
        //     check_oil_ng = true;
        // }
        // if(action == 'pre_accept' && check_oil_ng == true && (st_product !== '0' || st_oil !== '0' || st_inpuf !== '0' || st_diff !== '0')) {
        //     alert('確認が完了していません。');
        //     return;
        // } else if (action == 'pre_accept' && (check_ng == true || check_duplicate == true)){
        //     alert('確認が完了していません。');
        //     return;
        // }
        // 送信データ
        $('.overlay').css('z-index','1000');
        $data ={
            url: './ajax/from_staff.php',
            type: 'POST',
            data:{
                user_id: user_id,
                modal_receipt_no: modal_receipt_no,
                modal_tel: modal_tel,
                modal_create: modal_create,
                modal_h: modal_h,
                modal_m: modal_m,
                check_oil: check_oil,
                memo: memo,
                modal_data_no: modal_data_no,
                action: action,
                st_product: st_product,
                st_term: st_term,
                st_shop: st_shop,
                st_duplicate: st_duplicate,
                st_ngword: st_ngword,
            },
            dataType: "json",
        };
        callFrontAjax($data, from_staff);
    });

    // 管理者からの送信
    $(".submit").on("click",function(){
        var user_id = $('#user_id').val();
        var modal_receipt_no = $('#modal_receipt_no').val();
        var modal_tel = $('#modal_tel').val();
        var modal_create = $('#modal_create').val();
        var modal_h = $('#modal_h').val();
        var modal_m = $('#modal_m').val();
        var check_oil = $('#check_oil').val();
        var memo = $('#memo').val();
        var modal_data_no = $('#modal_data_no').html();
        var action = $(this).attr('id');
        var st_product = $('#st_product').val();
        var st_term = $('#st_term').val();
        var st_shop = $('#st_shop').val();
        var st_duplicate = $('#st_duplicate').val();
        var st_ngword = $('#st_ngword').val();
        // バリデーション
        var btns = 0;
        var conf = 0;
        $('.wrap.active').each(function(){
            btns += 1;
        });
        $('.confirm_btn.active').each(function(){
            conf += 1;
        });
        if(action == 'accept' && btns !== conf) {
            alert('確認が完了していません。');
            exit();
        }
        var check_string = false;
        var check_ng = false;
        var check_duplicate = false;
        var check_oil_ng = false;
        if(modal_receipt_no.match(/^[0-9!-/:-@¥[-`{-~]*$/)) {
        } else {
            check_string = true;
        }
        if(modal_tel.match(/^[0-9!-/:-@¥[-`{-~]*$/)){
        } else {
            check_string = true;
        }
        if(modal_create.match(/^[0-9!-/:-@¥[-`{-~]*$/)) {
        } else {
            check_string = true;
        }
        if(check_oil.match(/^[0-9!-/:-@¥[-`{-~]*$/)) {
        } else {
            check_string = true;
        }
        if(check_string == true) {
            alert('メモ以外は半角数字もしくは半角記号で入力してください。');
            return;
        }
        var receipt_oil = $('#self_oil').html();
        // if(st_product == 1 || st_oil == 1 || st_input == 1 || st_diff == 1 || st_term == 1 || st_shop == 1 || st_duplicate == 1 || st_ngword == 1 || st_count == 1) {
        //     check_ng = true;
        // }
        // if(modal_receipt_no == '' || modal_tel == '' || modal_create == '') {
        //     check_duplicate = true;
        // }
        // if(check_oil == '') {
        //     check_oil_ng = true;
        // }
        // if(action == 'accept' && check_oil_ng == true && (st_product !== '0' || st_oil !== '0' || st_inpuf !== '0' || st_diff !== '0')) {
        //     alert('確認が完了していません。');
        //     return;
        // } else if (action == 'accept' && (check_ng == true || check_duplicate == true)){
        //     alert('確認が完了していません。');
        //     return;
        // }
        // 送信データ
        $('.overlay').css('z-index','1000');
        $data ={
            url: './ajax/from_admin.php',
            type: 'POST',
            data:{
                user_id: user_id,
                modal_receipt_no: modal_receipt_no,
                modal_tel: modal_tel,
                modal_create: modal_create,
                modal_h: modal_h,
                modal_m: modal_m,
                receipt_oil: receipt_oil,
                check_oil: check_oil,
                memo: memo,
                modal_data_no: modal_data_no,
                action: action,
                st_product: st_product,
                st_term: st_term,
                st_shop: st_shop,
                st_duplicate: st_duplicate,
                st_ngword: st_ngword,
            },
            dataType: "json",
        };
        callFrontAjax($data, from_staff);
    });

    // NTからの送信
    $(".nt_submit").on("click",function(){
        var user_id = $('#user_id').val();
        var modal_receipt_no = $('#modal_receipt_no').val();
        var modal_tel = $('#modal_tel').val();
        var modal_create = $('#modal_create').val();
        var modal_h = $('#modal_h').val();
        var modal_m = $('#modal_m').val();
        var check_oil = $('#check_oil').val();
        var memo = $('#memo').val();
        var modal_data_no = $('#modal_data_no').html();
        var action = $(this).attr('id');
        var st_product = $('#st_product').val();
        var st_term = $('#st_term').val();
        var st_shop = $('#st_shop').val();
        var st_duplicate = $('#st_duplicate').val();
        var st_ngword = $('#st_ngword').val();
        // バリデーション
        var btns = 0;
        var conf = 0;
        $('.wrap.active').each(function(){
            btns += 1;
        });
        $('.confirm_btn.active').each(function(){
            conf += 1;
        });
        if(action == 'nt_accept' && btns !== conf) {
            alert('確認が完了していません。');
            exit();
        }
        var check_string = false;
        var check_ng = false;
        var check_duplicate = false;
        var check_oil_ng = false;
        if(modal_receipt_no.match(/^[0-9!-/:-@¥[-`{-~]*$/)) {
        } else {
            check_string = true;
        }
        if(modal_tel.match(/^[0-9!-/:-@¥[-`{-~]*$/)){
        } else {
            check_string = true;
        }
        if(modal_create.match(/^[0-9!-/:-@¥[-`{-~]*$/)) {
        } else {
            check_string = true;
        }
        if(check_oil.match(/^[0-9!-/:-@¥[-`{-~]*$/)) {
        } else {
            check_string = true;
        }
        if(check_string == true) {
            alert('メモ以外は半角数字もしくは半角記号で入力してください。');
            return;
        }
        var receipt_oil = $('#self_oil').html();
        // if(st_product == 1 || st_oil == 1 || st_input == 1 || st_diff == 1 || st_term == 1 || st_shop == 1 || st_duplicate == 1 || st_ngword == 1 || st_count == 1) {
        //     check_ng = true;
        // }
        // if(modal_receipt_no == '' || modal_tel == '' || modal_create == '') {
        //     check_duplicate = true;
        // }
        // if(check_oil == '') {
        //     check_oil_ng = true;
        // }
        // if(action == 'accept' && check_oil_ng == true && (st_product !== '0' || st_oil !== '0' || st_inpuf !== '0' || st_diff !== '0')) {
        //     alert('確認が完了していません。');
        //     return;
        // } else if (action == 'accept' && (check_ng == true || check_duplicate == true)){
        //     alert('確認が完了していません。');
        //     return;
        // }
        // 送信データ
        $('.overlay').css('z-index','1000');
        $data ={
            url: './ajax/from_nt.php',
            type: 'POST',
            data:{
                user_id: user_id,
                modal_receipt_no: modal_receipt_no,
                modal_tel: modal_tel,
                modal_create: modal_create,
                modal_h: modal_h,
                modal_m: modal_m,
                receipt_oil: receipt_oil,
                check_oil: check_oil,
                memo: memo,
                modal_data_no: modal_data_no,
                action: action,
                st_product: st_product,
                st_term: st_term,
                st_shop: st_shop,
                st_duplicate: st_duplicate,
                st_ngword: st_ngword,
            },
            dataType: "json",
        };
        callFrontAjax($data, from_staff);
    });

    function from_staff(data){
        $('.overlay').css('z-index','-1');
        if(data.double == true) {
            alert('重複しています。');
        }
        if(data.result == 'pre_accept') {
            alert('仮承認しました。');
            $('#id_'+data.back_id).addClass('change');
            $('#id_'+data.back_id).children('.now_status').html('済（仮承認）');
        }
        if(data.result == 'pre_reject') {
            alert('仮否認しました。');
            $('#id_'+data.back_id).addClass('change');
            $('#id_'+data.back_id).children('.now_status').html('済（仮否認）');
        }
        if(data.result == 'pre_reject_duplicate') {
            alert('仮否認したレシートは重複したレシートでした。');
            $('#id_'+data.back_id).addClass('change');
            $('#id_'+data.back_id).children('.now_status').html('済（仮否認）');
        }
        if(data.result == 'pre_confirm_duplicate') {
            alert('判断不可にしたレシートは重複したレシートでした。');
            $('#id_'+data.back_id).addClass('change');
            $('#id_'+data.back_id).children('.now_status').html('済（判断不可）');
        }
        if(data.result == 'pre_confirm') {
            alert('判断不可で送信しました。');
            $('#id_'+data.back_id).addClass('change');
            $('#id_'+data.back_id).children('.now_status').html('済（判断不可）');
        }
        if(data.result == 'pre_illegal') {
            alert('不正疑いで送信しました。');
            $('#id_'+data.back_id).addClass('change');
            $('#id_'+data.back_id).children('.now_status').html('済（不正）');
        }
        if(data.result == 'accept') {
            alert('承認しました。');
            $('#id_'+data.back_id).addClass('change');
            $('#id_'+data.back_id).children('.now_status').html('済（承認）');
        }
        if(data.result == 'reject') {
            alert('否認しました。');
            $('#id_'+data.back_id).addClass('change');
            $('#id_'+data.back_id).children('.now_status').html('済（否認）');
        }
        if(data.result == 'reject_duplicate') {
            alert('否認したレシートは重複したレシートでした。');
            $('#id_'+data.back_id).addClass('change');
            $('#id_'+data.back_id).children('.now_status').html('済（否認）');
        }
        if(data.result == 'confirm_duplicate') {
            alert('判断不可にしたレシートは重複したレシートでした。');
            $('#id_'+data.back_id).addClass('change');
            $('#id_'+data.back_id).children('.now_status').html('済（判断不可）');
        }
        if(data.result == 'confirm') {
            alert('判断不可で送信しました。');
            $('#id_'+data.back_id).addClass('change');
            $('#id_'+data.back_id).children('.now_status').html('済（不可）');
        }
        if(data.result == 'illegal') {
            alert('不正で送信しました。');
            $('#id_'+data.back_id).addClass('change');
            $('#id_'+data.back_id).children('.now_status').html('済（不正）');
        }

        if(data.result == 'nt_accept') {
            alert('承認しました。');
            $('#id_'+data.back_id).addClass('change');
            $('#id_'+data.back_id).children('.now_status').html('済（承認）');
        }
        if(data.result == 'nt_reject') {
            alert('否認しました。');
            $('#id_'+data.back_id).addClass('change');
            $('#id_'+data.back_id).children('.now_status').html('済（否認）');
        }
        if(data.result == 'nt_reject_duplicate') {
            alert('否認したレシートは重複したレシートでした。');
            $('#id_'+data.back_id).addClass('change');
            $('#id_'+data.back_id).children('.now_status').html('済（否認）');
        }
        if(data.result == 'nt_illegal') {
            alert('不正で送信しました。');
            $('#id_'+data.back_id).addClass('change');
            $('#id_'+data.back_id).children('.now_status').html('済（不正）');
        }
    }
    $(function() {
		$.datepicker.setDefaults($.datepicker.regional["ja"]);
        $('#modal_create').datepicker({
            dateFormat: 'yy-mm-dd',
            language: 'ja',
        });
	});
    $(".window").on("click",function(){
        var src = $('#receipt_img').attr('src');
        window.open(
            src,
            "_blank",
            "menubar=0,width=1000,height=800,top=100,left=100"
        );
    });
}());









