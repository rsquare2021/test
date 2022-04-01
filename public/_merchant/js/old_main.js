// レシート撮影

(function(){
    
    var mk_status = {"0":"OK",
                    "1":"ユーザーによる入力",
                    "2":"短期間による送信",
                    "3":"数値異常",
                    "4":"NGワード",
                    "99":"却下"};
    var mk_reason = {"0":"潔癖",
                        "1":"ユーザーが数量の変更をしました。レシート数値を確認してください",
                        "2":"同じユーザーが短期間に複数送信しました",
                        "3":"数量を確認してください",
                        "4":"NGワードを含むレシートです",
                        "99":"却下されたレシートです"};

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
                    
                    if(i == 0){
                        var $elem = $('<tr id="id_'+user[i].id+'" data-status="'+user[i].status+'" data-now="'+user[i].now_st+'">\
                                        <td class="mk_no">'+cnt+'</td>\
                                        <td rowspan="'+user.length+'" class="mk_user">'+user[i].user_id+'</td>\
                                        <td class="mk_post_date">'+user[i].post_date+'</td>\
                                        <td class="mk_id_receipt">'+user[i].id+'</td>\
                                        <td class="now_status">'+user[i].now_status+'</td>\
                                        <td class="mk_status">'+st+'</td>\
                                    </tr>');
                    }
                    else{
                        var $elem = $('<tr id="id_'+user[i].id+'" data-status="'+user[i].status+'" data-now="'+user[i].now_st+'">\
                                        <td class="mk_no">'+cnt+'</td>\
                                          <td class="mk_post_date">'+user[i].post_date+'</td>\
                                          <td class="mk_id_receipt">'+user[i].id+'</td>\
                                          <td class="now_status">'+user[i].now_status+'</td>\
                                          <td class="mk_status">'+st+'</td>\
                                      </tr>');
                    }
                    $elem.data({
                        "user":user[i]
                    });
                    $contena.append($elem);
                    $elem.on("click",function(){
                        //初期セット
                        if($(this).hasClass('change')) {
                            $('.modal_status .flex').hide();
                        } else {
                            $('.modal_status .flex').show();
                        }
                        $('#st_product').val('0');
                        $('#st_oil').val('0');
                        $('#st_input').val('0');
                        $('#st_diff').val('0');
                        $('#st_term').val('0');
                        $('#st_shop').val('0');
                        $('#st_duplicate').val('0');
                        $('#st_ngword').val('0');
                        $('#st_count').val('0');
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
                        $("#modal").show();

                        // $("#status_reason").html(status);
                        
                        $.each(target_status, function(index, value) {
                            if(index == 0) { //対象商品
                                if(value == "1") {
                                    $('.status_table .product').addClass('active');
                                    $('#st_product').val('1');
                                    st_detail += "<p class='alert_product'>対象商品の有無を確認してください。対象商品があれば数量を入力してください。</p>";
                                }
                            } else if(index == 1) { //給油量
                                if(value == "1") {
                                    $('.status_table .oil').addClass('active');
                                    st_detail += "<p class='alert_oil'>最低給油量に達しているか確認してください。</p>";
                                    $('#st_oil').val('1');
                                } else if(value == "2") {
                                    $('.status_table .oil').addClass('active');
                                    $('#st_oil').val('1');
                                    st_detail += "<p class='alert_oil'>数量が読み取れません。</p>";
                                }
                            } else if(index == 2) { //自己申告
                                if(value == "1") {
                                    $('.status_table .input').addClass('active');
                                    $('#st_input').val('1');
                                    st_detail += "<p class='alert_input'>ユーザーが入力した給油量が正しいか確認してください。</p>";
                                }
                            } else if(index == 3) { //給油差
                                if(value == "1") {
                                    $('.status_table .diff').addClass('active');
                                    $('#st_diff').val('1');
                                    st_detail += "<p class='alert_diff'>読み取った給油量とユーザーによって入力された給油量に差異があります。</p>";
                                }
                            } else if(index == 4) { //対象期間
                                if(value == "1") {
                                    $('.status_table .term').addClass('active');
                                    $('#st_term').val('1');
                                    st_detail += "<p class='alert_term'>レシート発行日時が対象期間外です。</p>";
                                } else if(value == "2") {
                                    $('.status_table .term').addClass('active');
                                    $('#st_term').val('1');
                                    st_detail += "<p class='alert_term'>レシート発行日時が読み取れません。</p>";
                                }
                            } else if(index == 5) { //対象店舗
                                if(value == "1") {
                                    $('.status_table .shop').addClass('active');
                                    $('#st_shop').val('1');
                                    st_detail += "<p class='alert_shop'>対象外の店舗です。</p>";
                                } else if(value == "2") {
                                    $('.status_table .shop').addClass('active');
                                    $('#st_shop').val('1');
                                    st_detail += "<p class='alert_shop'>店舗が読み取れません。</p>";
                                }
                            } else if(index == 6) { //重複
                                if(value == "1") {
                                    $('.status_table .duplicate').addClass('active');
                                    $('#st_duplicate').val('1');
                                    st_detail += "<p class='alert_duplicate'>既に登録されているレシートです。</p>";
                                } else if(value == "2") {
                                    $('.status_table .duplicate').addClass('active');
                                    $('#st_duplicate').val('1');
                                    st_detail += "<p class='alert_duplicate'>重複判定ができませんでした。</p>";
                                }
                            } else if(index == 7) { //NGワード
                                if(value == "1") {
                                    $('.status_table .ngword').addClass('active');
                                    $('#st_ngword').val('1');
                                    st_detail += "<p class='alert_ngword'>対象外のレシートである可能性が高いです。</p>";
                                } else if(value == "2") {
                                    $('.status_table .ngword').addClass('active');
                                    $('#st_ngword').val('1');
                                    st_detail += "<p class='alert_ngword'>再発行レシートです。この応募者が過去に再発行レシートを送信していないか確認してください。</p>";
                                }
                            } else if(index == 8) { //強制送信
                                if(value == "1") {
                                    $('.status_table .count').addClass('active');
                                    $('#st_count').val('1');
                                    st_detail += "<p class='alert_count'>強制送信されたレシートです。</p>";
                                }
                            } else {
                            }
                            $('#status_detail').html(st_detail);
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

                        $("#modal_post_date").text(user.post_date);
                        $("#modal_create").val(user.pay_date);
                        $("#modal_receipt_no").val(user.receipt_no);
                        $("#modal_data_no").text(user.id);
                        $("#modal_tel").val(user.tel);
                        $("#modal_user_id").text(user.user_id);
                        var self_oil = user.receipt_value;
                        if(self_oil == '' || self_oil == null) {
                            $('#self_oil').html('未入力');
                        } else {
                            $('#self_oil').html(self_oil+'L');
                        }
                        var products = user.products;
                        var oil = products.substr(products.indexOf('C') + 1);
                        if(oil == '' || oil == null) {
                            $('#receipt_oil').html('読み取れません');
                        } else {
                            $('#receipt_oil').html(oil+'L');
                        }
                        $('#modal_status').val(status);
                        $("#receipt_img").attr("src","../assets/ajax"+user.src);
                        $("#zoomImg").attr("src","../assets/ajax"+user.src);
                        if(user.receipt_no !== null || user.receipt_no !== '') {
                            $('#modal_receipt_no').val(user.receipt_no);
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

    var $zoomImg = $("#zoomImg");
    $("#receipt_img").hover(
        function(){
            $zoomImg.show();
        },
        function(){
            //$zoomImg.hide(); 
        }
    )

    $zoomImg.hover(
        function(){
            $zoomImg.show();
        },
        function(){
            $zoomImg.hide(); 
        }
    )

    var ratio = 3;
    $(".modal_img_container").mousemove(function(e){
        $zoomImg.offset({
            
            top:(-e.offsetY/2*3+$zoomImg.height()/3)-$zoomImg.height()/3,
            left:(-e.offsetX/2*3+$zoomImg.width()/3)-$zoomImg.width()/3,
        });
    });

    
    $(".modal_container").on("click",function(){
        return false;
    });
    
    $("#modal").on("click",function(){
       $(this).hide();
       $zoomImg.hide();
    });

    $(".status_table td").on("click",function(){
        $(this).toggleClass('ok');
        var target_status = $(this).data('st');
        $('.alert_'+target_status).toggleClass('hidden');
        if($(this).hasClass('active')) {
            $('#st_'+target_status).val('1');
        }
        if($(this).hasClass('ok')) {
            $('#st_'+target_status).val('2');
        }
    });

    // スタッフからの送信
    $(".pre_submit").on("click",function(){
        var user_id = $('#user_id').val();
        var modal_receipt_no = $('#modal_receipt_no').val();
        var modal_tel = $('#modal_tel').val();
        var modal_create = $('#modal_create').val();
        var check_oil = $('#check_oil').val();
        var memo = $('#memo').val();
        var modal_data_no = $('#modal_data_no').html();
        var action = $(this).attr('id');
        var st_product = $('#st_product').val();
        var st_oil = $('#st_oil').val();
        var st_input = $('#st_input').val();
        var st_diff = $('#st_diff').val();
        var st_term = $('#st_term').val();
        var st_shop = $('#st_shop').val();
        var st_duplicate = $('#st_duplicate').val();
        var st_ngword = $('#st_ngword').val();
        var st_count = $('#st_count').val();
        // バリデーション
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
        if(st_product == 1 || st_oil == 1 || st_input == 1 || st_diff == 1 || st_term == 1 || st_shop == 1 || st_duplicate == 1 || st_ngword == 1 || st_count == 1) {
            check_ng = true;
        }
        if(modal_receipt_no == '' || modal_tel == '' || modal_create == '') {
            check_duplicate = true;
        }
        if(check_oil == '') {
            check_oil_ng = true;
        }
        if(action == 'pre_accept' && check_oil_ng == true && (st_product !== '0' || st_oil !== '0' || st_inpuf !== '0' || st_diff !== '0')) {
            alert('確認が完了していません。');
            return;
        } else if (action == 'pre_accept' && (check_ng == true || check_duplicate == true)){
            alert('確認が完了していません。');
            return;
        }
        // 送信データ
        $data ={
            url: './ajax/from_staff.php',
            type: 'POST',
            data:{
                user_id: user_id,
                modal_receipt_no: modal_receipt_no,
                modal_tel: modal_tel,
                modal_create: modal_create,
                check_oil: check_oil,
                memo: memo,
                modal_data_no: modal_data_no,
                action: action,
                st_product: st_product,
                st_oil: st_oil,
                st_input: st_input,
                st_diff: st_diff,
                st_term: st_term,
                st_shop: st_shop,
                st_duplicate: st_duplicate,
                st_ngword: st_ngword,
                st_count: st_count,
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
        var check_oil = $('#check_oil').val();
        var memo = $('#memo').val();
        var modal_data_no = $('#modal_data_no').html();
        var action = $(this).attr('id');
        var st_product = $('#st_product').val();
        var st_oil = $('#st_oil').val();
        var st_input = $('#st_input').val();
        var st_diff = $('#st_diff').val();
        var st_term = $('#st_term').val();
        var st_shop = $('#st_shop').val();
        var st_duplicate = $('#st_duplicate').val();
        var st_ngword = $('#st_ngword').val();
        var st_count = $('#st_count').val();
        // バリデーション
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
        if(st_product == 1 || st_oil == 1 || st_input == 1 || st_diff == 1 || st_term == 1 || st_shop == 1 || st_duplicate == 1 || st_ngword == 1 || st_count == 1) {
            check_ng = true;
        }
        if(modal_receipt_no == '' || modal_tel == '' || modal_create == '') {
            check_duplicate = true;
        }
        if(check_oil == '') {
            check_oil_ng = true;
        }
        if(action == 'accept' && check_oil_ng == true && (st_product !== '0' || st_oil !== '0' || st_inpuf !== '0' || st_diff !== '0')) {
            alert('確認が完了していません。');
            return;
        } else if (action == 'accept' && (check_ng == true || check_duplicate == true)){
            alert('確認が完了していません。');
            return;
        }
        // 送信データ
        $data ={
            url: './ajax/from_admin.php',
            type: 'POST',
            data:{
                user_id: user_id,
                modal_receipt_no: modal_receipt_no,
                modal_tel: modal_tel,
                modal_create: modal_create,
                check_oil: check_oil,
                memo: memo,
                modal_data_no: modal_data_no,
                action: action,
                st_product: st_product,
                st_oil: st_oil,
                st_input: st_input,
                st_diff: st_diff,
                st_term: st_term,
                st_shop: st_shop,
                st_duplicate: st_duplicate,
                st_ngword: st_ngword,
                st_count: st_count,
            },
            dataType: "json",
        };
        callFrontAjax($data, from_staff);
    });
    function from_staff(data){
        if(data.double == true) {
            alert('重複しています。');
        }
        if(data.result == 'pre_accept') {
            alert('仮承認しました。');
            $("#modal").hide();
            $('#id_'+data.back_id).addClass('change');
            $('#id_'+data.back_id).children('.now_status').html('済（仮承認）');
        }
        if(data.result == 'pre_reject') {
            alert('仮否認しました。');
            $("#modal").hide();
            $('#id_'+data.back_id).addClass('change');
            $('#id_'+data.back_id).children('.now_status').html('済（仮否認）');
        }
        if(data.result == 'pre_reject_duplicate') {
            alert('仮否認したレシートは重複したレシートでした。');
            $("#modal").hide();
            $('#id_'+data.back_id).addClass('change');
            $('#id_'+data.back_id).children('.now_status').html('済（仮否認）');
        }
        if(data.result == 'pre_confirm_duplicate') {
            alert('判断不可にしたレシートは重複したレシートでした。');
            $("#modal").hide();
            $('#id_'+data.back_id).addClass('change');
            $('#id_'+data.back_id).children('.now_status').html('済（判断不可）');
        }
        if(data.result == 'pre_confirm') {
            alert('判断不可で送信しました。');
            $("#modal").hide();
            $('#id_'+data.back_id).addClass('change');
            $('#id_'+data.back_id).children('.now_status').html('済（判断不可）');
        }
        if(data.result == 'pre_illegal') {
            alert('不正疑いで送信しました。');
            $("#modal").hide();
            $('#id_'+data.back_id).addClass('change');
            $('#id_'+data.back_id).children('.now_status').html('済（不正）');
        }
        if(data.result == 'accept') {
            alert('承認しました。');
            $('#id_'+data.back_id).addClass('change');
            $('#id_'+data.back_id).children('.now_status').html('済（承認）');
            $("#modal").hide();
        }
        if(data.result == 'reject') {
            alert('否認しました。');
            $('#id_'+data.back_id).addClass('change');
            $('#id_'+data.back_id).children('.now_status').html('済（否認）');
            $("#modal").hide();
        }
        if(data.result == 'reject_duplicate') {
            alert('否認したレシートは重複したレシートでした。');
            $('#id_'+data.back_id).addClass('change');
            $('#id_'+data.back_id).children('.now_status').html('済（否認）');
            $("#modal").hide();
        }
        if(data.result == 'confirm_duplicate') {
            alert('判断不可にしたレシートは重複したレシートでした。');
            $('#id_'+data.back_id).addClass('change');
            $('#id_'+data.back_id).children('.now_status').html('済（判断不可）');
            $("#modal").hide();
        }
        if(data.result == 'confirm') {
            alert('判断不可で送信しました。');
            $('#id_'+data.back_id).addClass('change');
            $('#id_'+data.back_id).children('.now_status').html('済（不可）');
            $("#modal").hide();
        }
        if(data.result == 'illegal') {
            alert('不正で送信しました。');
            $('#id_'+data.back_id).addClass('change');
            $('#id_'+data.back_id).children('.now_status').html('済（不正）');
            $("#modal").hide();
        }
    }
    $(function() {
		$.datepicker.setDefaults($.datepicker.regional["ja"]);
        $('#modal_create').datepicker({
            dateFormat: 'yy-mm-dd',
            language: 'ja',
        });
	});
}());










