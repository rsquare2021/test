// エンドユーザー
// メニューボタン
$(document).on('click','.menu_btn',function(){
    $('.user_menu').toggle();
});
$('#top').on('click','.signin_btn',function(){
    $('#login_modal').modal('show');
});
// アカウント作成バリデーション
$(function(){
    $('.user_menu').hide();
    $('.mail_check_mark').hide();
    $('.pass_check_mark').hide();
});
$('#signup_mail').on('input', function(event) {
    var mail = $('#username').val();
    var mail_confirm = $('#username_confirm').val();
    var mail_pre = 'ng';
    var pass = $('#password').val();
    var pass_confirm = $('#password_confirm').val();
    var pass_length = pass.length;
    $('#password').blur(function() {
        if(pass_length < 8) {
            $('.pass_alert_miman').show();
        } else {
            $('.pass_alert_miman').hide();
        }
        if(pass.match(/^(?=.*?[a-z])(?=.*?[A-Z])(?=.*?\d)[a-zA-Z\d]{8,100}$/)) {
            $('.pass_alert_moji').hide();
        } else {
            $('.pass_alert_moji').show();
        }
    });
    $('#password_confirm').blur(function() {
        if(pass == pass_confirm) {
            $('.pass_alert_confirm').hide();
        } else {
            $('.pass_alert_confirm').show();
        }
    });
    // メール：半角英数字で一致
    if(mail !== '' && mail_confirm !== '' && mail.match(/^[A-Za-z0-9]{1}[A-Za-z0-9_.-]*@{1}[A-Za-z0-9_.-]{1,}.[A-Za-z0-9]{1,}$/)) {
        if(mail == mail_confirm && 0 > mail.indexOf("+")) {
            var mail_check = 'ok';
        }
    }
    // パスワード：半角英数字かつ8桁以上で一致
    if(pass !== '' && pass_confirm !== '' && pass.match(/^(?=.*?[a-z])(?=.*?[A-Z])(?=.*?\d)[a-zA-Z\d]{8,100}$/) && pass_length >= 8) {
        if(pass == pass_confirm) {
            var pass_check = 'ok';
        }
    }
    // if (0 == mail.indexOf("+")) {
    //     mail_pre = 'ok';
    // } else {
    // }
    
    // チェックマーク
    if(mail_check == 'ok') {
        $('.mail_check_mark').show();
    } else {
        $('.mail_check_mark').hide();
    }
    if(pass_check == 'ok') {
        $('.pass_check_mark').show();
    } else {
        $('.pass_check_mark').hide();
    }
    // ボタン制御
    if(mail_check == 'ok' && pass_check == 'ok') {
        $('.register_confirm_btn').removeClass('noevent');
    } else {
        $('.register_confirm_btn').addClass('noevent');
    }
});
// アカウント作成確認画面
$('#signup_mail').ready(function(){
    $('#register_confirm').hide();
});
$('#signup_mail').on('click','.register_confirm_btn',function(){
    // メールアドレスセット
    var mail = $('#username').val();
    $('.mail_confirm_text').html('');
    $('.mail_confirm_text').html(mail);
    $('#register_input').hide();
    $('#register_confirm').show();
});
$('#signup_mail').on('click','.register_confirm_back_btn',function(){
    $('#register_input').show();
    $('#register_confirm').hide();
});

// メールアドレス編集バリデーション
$('#mail_change').on('input', function(event) {
    var mail = $('#username').val();
    var mail_confirm = $('#username_confirm').val();
    // メール：半角英数字で一致
    if(mail !== '' && mail_confirm !== '' && mail.match(/^[A-Za-z0-9]{1}[A-Za-z0-9_.-]*@{1}[A-Za-z0-9_.-]{1,}.[A-Za-z0-9]{1,}$/)) {
        if(mail == mail_confirm) {
            var mail_check = 'ok';
        }
    }
    // チェックマーク
    if(mail_check == 'ok') {
        $('.mail_check_mark').show();
    } else {
        $('.mail_check_mark').hide();
    }
    // ボタン制御
    if(mail_check == 'ok') {
        $('.submit').removeClass('noevent');
    } else {
        $('.submit').addClass('noevent');
    }
});

// パスワードリセット
$('#password_reset').on('input', function(event) {
    var mail = $('#username').val();
    // メール：半角英数字で一致
    if(mail !== '' && mail.match(/^[A-Za-z0-9]{1}[A-Za-z0-9_.-]*@{1}[A-Za-z0-9_.-]{1,}.[A-Za-z0-9]{1,}$/)) {
        var mail_check = 'ok';
    }
    // チェックマーク
    if(mail_check == 'ok') {
        $('.mail_check_mark').show();
    } else {
        $('.mail_check_mark').hide();
    }
    // ボタン制御
    if(mail_check == 'ok') {
        $('.register_confirm_btn').removeClass('noevent');
    } else {
        $('.register_confirm_btn').addClass('noevent');
    }
});

// パスワード変更
$('#password_change').on('input', function(event) {
    var pass = $('#password').val();
    var pass_confirm = $('#password_confirm').val();
    var pass_length = pass.length;
    $('#password').blur(function() {
        if(pass_length < 8) {
            $('.pass_alert_miman').show();
        } else {
            $('.pass_alert_miman').hide();
        }
        if(pass.match(/^(?=.*?[a-z])(?=.*?[A-Z])(?=.*?\d)[a-zA-Z\d]{8,100}$/)) {
            $('.pass_alert_moji').hide();
        } else {
            $('.pass_alert_moji').show();
        }
    });
    $('#password_confirm').blur(function() {
        if(pass == pass_confirm) {
            $('.pass_alert_confirm').hide();
        } else {
            $('.pass_alert_confirm').show();
        }
    });
    // パスワード：半角英数字かつ8桁以上で一致
    if(pass !== '' && pass_confirm !== '' && pass.match(/^(?=.*?[a-z])(?=.*?[A-Z])(?=.*?\d)[a-zA-Z\d]{8,100}$/) && pass_length >= 8) {
        if(pass == pass_confirm) {
            var pass_check = 'ok';
        }
    }
    // チェックマーク & ボタン制御
    if(pass_check == 'ok') {
        $('.pass_check_mark').show();
        $('.submit').removeClass('noevent');
    } else {
        $('.pass_check_mark').hide();
        $('.submit').addClass('noevent');
    }
});

// 応募履歴ページ
$('#mypage_history').on('click','.deli_edit',function(){
    $('#editModal').modal('show');
});
$('#mypage_regist_mail').on('click','.confirm',function(){
});

// カメラリンク
$('#cam').on('click','.camera_link',function(){
    $('#extention').modal('show');
});
$(function() {
    $('.lineup.products li').matchHeight();
});
$(function(){
    $(".product_search dt").on("click", function() {
        $(this).next().slideToggle();
        $(this).toggleClass("active");
    });
});

const slideLength = document.querySelectorAll('.swiper-container .swiper-slide').length;
if (slideLength > 1) {
    var mySwiper = new Swiper('.swiper-container', {
        spaceBetween: 30,
        slidesPerView: 1,
        autoHeight: true,
        loop: true,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev'
        },
        pagination: {
            el: '.swiper-pagination',
            type: 'bullets',
            clickable: true
        }
    });
}

$(function(){
    let $swiperContainer = $('.recommend');
    let mySwiper = new Swiper($swiperContainer,{
    loop: true,
    speed: 800,
    slidesPerView: 2,
    centeredSlides : true,
    spaceBetween: 20,
	initialSlide: 0,
    pagination: {
        el: '.swiper-pagination',
        type: 'bullets',
        clickable: true
    }
    });
});

// 景品一覧検索
$(document).ready(function(){
    $('.pre_search a').each(function(){
        var replace = null;
        var replace = $(this).attr('href').replace(/dashboard\/point\/gift/g,'list');
        $(this).attr('href',replace);
    });
});

// 景品画像
$(document).ready(function(){
    $('.products li a .img img').each(function(){
        var src = $(this).attr('src');
        var re_src = src.replace("-0.jpg", "-1.jpg");
        $(this).attr('src',re_src);
    });
});

// 景品詳細
const gifteebox_unit_price = 100;

$('body').on('click','.order_confirm_btn',function(){
    var order_name = $('.order_name').html();
    var use_point = $('.used_point').html();
    var quantity = $('#quantity').val();
    var used_point = parseInt(use_point) * parseInt(quantity);
    var has_point = $('.has_point').html();
    var after_point = parseInt(has_point) - parseInt(used_point);
    var valiation = $('#valiation option:selected').text();
    var product_id = $('#valiation option:selected').val();
    var is_giftee_box = $('.is_giftee_box').val();
    if(after_point < 0) {
        $('.modal-body .order_confirm_btn').val('ポイントが不足しています');
        $('.modal-body .order_confirm_btn').prop('disabled',true);
    } else {
        $('.modal-body .order_confirm_btn').val('交換する');
        $('.modal-body .order_confirm_btn').prop('disabled',false);
    }
    $('.pro_name_disp').html();
    $('.total_use_point_disp').html();
    $('.total_has_point_disp').html();
    $('.after_point_disp').html();
    $('.quantity_disp').html();
    $('.valiation_disp').html();
    $('.pro_name').val();
    $('.total_use_point').val();
    $('.total_has_point').val();
    $('.after_point').val();
    $('.quantity').val();
    $('.valiation').val();
    $('.product_id').val();
    $('.pro_name_disp').html(order_name);
    $('.total_use_point_disp').html(used_point);
    $('.total_has_point_disp').html(has_point);
    $('.after_point_disp').html(after_point);
    if(!is_giftee_box) {
        $('.quantity_disp').html(quantity);
    }
    else {
        $('.quantity_disp').html(quantity * gifteebox_unit_price);
    }
    $('.valiation_disp').html(valiation);
    $('.pro_name').val(order_name);
    $('.total_use_point').val(used_point);
    $('.total_has_point').val(has_point);
    $('.after_point').val(after_point);
    $('.quantity').val(quantity);
    $('.valiation').val(valiation);
    $('.product_id').val(product_id);
    if(!valiation) {
        $('.valiation_conf').remove();
    }
    $('#order_confirm').modal('show');
    exit;
});
$('#gift_point_detail .modal').ready(function(){
    if($('.modal').hasClass('noset_mail')) {
        $('#mail_modal').modal('show');
    } else {
    }
});
// gifteeboxの金額を選択したとき、必要ポイントを連動させる。
$('#quantity').on('change', function(e) {
    if(!$('.is_giftee_box').val()) return true;
    let use_point = $('.used_point').html();
    $('.used_point_disp').html($(this).val() * use_point + ' ');
});

// 発送先住所セット
$('#used_address').change(function() {
    // 変数セット
    var company_name = $("#used_address option:selected").data("company_name");
    var personal_name = $("#used_address option:selected").data("personal_name");
    var personal_name_kana = $("#used_address option:selected").data("personal_name_kana");
    var zip = $("#used_address option:selected").data("zip");
    var pref = $("#used_address option:selected").data("pref");
    var add01 = $("#used_address option:selected").data("add01");
    var add02 = $("#used_address option:selected").data("add02");
    var add03 = $("#used_address option:selected").data("add03");
    var tel = $("#used_address option:selected").data("tel");
    var delivery_time_id = $("#used_address option:selected").data("delivery_time_id");
    // 情報置き換え
    $('#company_name').val(company_name);
    $('#personal_name').val(personal_name);
    $('#personal_name_kana').val(personal_name_kana);
    $('#zip').val(zip);
    $('#pref').val(pref);
    $('#add01').val(add01);
    $('#add02').val(add02);
    $('#add03').val(add03);
    $('#tel').val(tel);
    $('#delivery_time').val(delivery_time_id);
});

// 発送先確認
$(function() {
    $('#confirm_view').hide();
    $('.require_error').hide();
    $('.kana_error').hide();
    $('.half_error').hide();
});
$('body').on('click','.confirm_btn',function(){
    $('html,body').animate({ scrollTop: 0 }, '1');
    // 必須バリデーション
    var required_count = 0;
    var required = 0;
    var kana_count = 0;
    var kana = 0;
    var half_count = 0;
    var half = 0;
    var page_id = $('body').attr('id');
    if(page_id !== 'exchange_edit') {
        var checkbox_check = 0;
        var checkbox_check_conf = 'ng';
        $('.question input').each(function(){
            if($(this).prop("checked")) {
                checkbox_check++;
            }
        });
        if(checkbox_check > 0) {
            checkbox_check_conf = 'ok';
            $('.check_require').hide();
        } else {
            checkbox_check_conf = 'ng';
            $('.check_require').show();
        }
    } else {
        var checkbox_check_conf = 'ok';
    }
    $('.required').each(function(){
        required_count++;
        var text = $(this).val();
        if(text) {
            $(this).next('.require_error').hide();
            required++;
        } else {
            $(this).next('.require_error').show();
        }
    });
    if(required_count == required) {
        var required_conf = 'ok';
    }
    // カタカナバリデーション
    $('.kana').each(function(){
        kana_count++;
        var text = $(this).val();
        if(text.match(/^[ァ-ンー][ァ-ンー 　]*$/)) {
            $(this).next().next('.kana_error').hide();
            kana++;
        } else {
            $(this).next().next('.kana_error').show();
        }
    });
    if(kana_count == kana) {
        var kana_conf = 'ok';
    }
    // 半角英数字バリデーション
    $('.half').each(function(){
        half_count++;
        var text = $(this).val();
        if(text.match(/^[a-zA-Z0-9!-/:-@¥[-`{-~]*$/)) {
            $(this).next().next('.half_error').hide();
            half++;
        } else {
            $(this).next().next('.half_error').show();
        }
    });
    if(half_count == half) {
        var half_conf = 'ok';
    }
    // 変数セット
    var company_name = $('#company_name').val();
    var personal_name = $('#personal_name').val();
    var personal_name_kana = $('#personal_name_kana').val();
    var zip = $('#zip').val();
    var pref = $('#pref').val();
    var add01 = $('#add01').val();
    var add02 = $('#add02').val();
    var add03 = $('#add03').val();
    var tel = $('#tel').val();
    var delivery_time = $('#delivery_time option:selected').text();
    // 確認画面初期化
    $('.confirm_text').each(function(){
        $(this).html('');
    });
    // 確認画面整形
    $('.conf_company_name').html(company_name);
    $('.conf_personal_name').html(personal_name);
    $('.conf_personal_name_kana').html(personal_name_kana);
    $('.conf_zip').html(zip);
    $('.conf_pref').html(pref);
    $('.conf_add01').html(add01);
    $('.conf_add02').html(add02);
    $('.conf_add03').html(add03);
    $('.conf_tel').html(tel);
    $('.conf_delivery_time').html(delivery_time);
    $('#order_confirm').modal('show');
    // 確認画面出力
    if(required_conf == 'ok' && kana_conf == 'ok' && half_conf == 'ok' && checkbox_check_conf == 'ok') {
        $('#input_view').hide();
        $('#confirm_view').show();
    }
});
$('body').on('click','.back_btn',function(){
    $('html,body').animate({ scrollTop: 0 }, '1');
    $('#input_view').show();
    $('#confirm_view').hide();
});
// 郵便番号から自動入力
$('.ajaxzip3').on('click', function(){
    AjaxZip3.zip2addr('post_code','','prefectures','municipalities','address_code');
    AjaxZip3.onSuccess = function() {
        $('.addr3').focus();
    };
    AjaxZip3.onFailure = function() {
        alert('郵便番号に該当する住所が見つかりません');
    };
    return false;
});
$(function(){
    function insertStr(input){
      return input.slice(0, 3) + '-' + input.slice(3,input.length);
    }  
    $('input[name="post_code"]').on('keyup',function(e){
      var input = $(this).val();  
      var key = event.keyCode || event.charCode;
      if( key == 8 || key == 46 ){
        return false;
      }
      if(input.length === 3){
        $(this).val(insertStr(input));
      }
    });
    $('input[name="post_code"]').on('blur',function(e){
      var input = $(this).val();  
      if(input.length >= 3 && input.substr(3,1) !== '-'){
        $(this).val(insertStr(input));
      }
    });
});

// 交換景品の個数を所持ポイントから計算
$('#gift_point_detail').ready(function(){
    var has_point = $('.has_point').html();
    var use_point = $('.used_point').html();
    var quantity = Math.floor(has_point / use_point);
    $(function(){
        let $quantity = $('#quantity');
        if(!$('.is_giftee_box').val()) {
            // 通常景品
            for (var i = 1; i <= quantity; i++){
                $quantity.append('<option value="'+i+'">'+i+'</option>');
            }
        }
        else {
            // // giftee box
            // let options = [
            //     200, 500, 1000, 2000, 3000, 7000, 10000, 15000, 20000, 30000,
            // ];
            // options.filter(e => e <= quantity * gifteebox_unit_price).forEach(e => {
            //     $quantity.append('<option value="'+(e/gifteebox_unit_price)+'">'+e+'</option>');
            // });
        }
    });
    // 交換可能個数が0個の場合
    if(quantity <= 0) {
        // ポイントが足りないことを伝える
        $('.nodelivered').remove();
        $('#nodelivered_text').append('<p class="attention">ポイントが足りません</p>');
        // 交換ボタンを押せなくする
        $('.order_confirm_btn').each(function(){
            $(this).remove();
        });
    }
});

// 景品交換履歴
$('.select_ex_status').change(function() {
    var select = $(this).val();
    $('.ex_lists').hide();
    if(select == '0') {
        $('.ex_lists').show();
    } else {
        $('.status'+select).show();
    }
});

// 新規会員登録
$('#accept').on('click', function() {
    $('.blue_btn').toggleClass('noactive');
    $('.line_login').toggleClass('noactive');
});

// 店舗一覧
$(document).on('click','#shops dt',function(){
    $('#shops dd').not($(this).next('dd')).hide();
    $(this).next('dd').slideToggle();
    $(this).toggleClass("active");
});

// カテゴリー選択
$('.select_cat').change(function() {
    var catid = $('.select_cat option:selected').data('catid');
    var cat_name = $('.select_cat option:selected').data('catname');
    $('input[name="category_id"]').val(catid);
    $('input[name="category_name"]').val(cat_name);
});

// ポイント選択
$('.select_point').change(function() {
    var min_point = $('.select_point option:selected').data('min_point');
    var max_point = $('.select_point option:selected').data('max_point');
    var point_name = $('.select_point option:selected').data('point_name');
    $('input[name="min_point"]').val(min_point);
    $('input[name="max_point"]').val(max_point);
});

// レシートステータス
$('#receipt_list').ready(function(){
    $('#receipt_list .re_list').each(function(){
        var status = $(this).children().children().children().children('.status_value').html();
        var sts = status.split('');
        var st = '';
        $.each(sts, function(index, value) {
            if(index == 0) { //対象商品
                if(value == "1") {
                    st += "<p>対象商品の有無を確認してください。対象商品があれば数量を入力してください。</p>";
                }
            } else if(index == 1) { //給油量
                if(value == "1") {
                    st += "<p>最低給油量に達しているか確認してください。</p>";
                } else if(value == "2") {
                    st += "<p>数量が読み取れません。</p>";
                }
            } else if(index == 2) { //自己申告
                if(value == "1") {
                    st += "<p>ユーザーが入力した給油量が正しいか確認してください。</p>";
                }
            } else if(index == 3) { //給油差
                if(value == "1") {
                    st += "<p>読み取った給油量とユーザーによって入力された給油量に差異があります。</p>";
                }
            } else if(index == 4) { //対象期間
                if(value == "1") {
                    st += "<p>レシート発行日時が対象期間外です。</p>";
                } else if(value == "2") {
                    st += "<p>レシート発行日時が読み取れません。</p>";
                }
            } else if(index == 5) { //対象店舗
                if(value == "1") {
                    st += "<p>対象外の店舗です。</p>";
                } else if(value == "2") {
                    st += "<p>店舗が読み取れません。</p>";
                }
            } else if(index == 6) { //重複
                if(value == "1") {
                    st += "<p>既に登録されているレシートです。</p>";
                }
            } else if(index == 7) { //NGワード
                if(value == "1") {
                    st += "<p>対象外のレシートである可能性が高いです。</p>";
                } else if(value == "2") {
                    st += "<p>再発行レシートです。この応募者が過去に再発行レシートを送信していないか確認してください。</p>";
                }
            } else if(index == 8) { //強制送信
                if(value == "1") {
                    st += "<p>強制送信されたレシートです。</p>";
                }
            } else {
            }
        });
        $(this).children().children().children().children('.status_detail').html(st);
    });
});

// パスワード目視ボタン
$(document).on("click", ".toggle_showing_password", function() {
    // input:password の直後に i が存在する想定。
    $eye_button = $(this);
    $password_textbox = $eye_button.prev("input");
    if($eye_button.hasClass("fa-eye-slash")) {
        $eye_button.removeClass("fa-eye-slash").addClass("fa-eye");
        $password_textbox.prop("type", "text");
    }
    else {
        $eye_button.removeClass("fa-eye").addClass("fa-eye-slash");
        $password_textbox.prop("type", "password");
    }
    $password_textbox.focus();
});

// デートピッカー
$(function() {
    $.datepicker.setDefaults($.datepicker.regional["ja"]);
    $('.datepicker').datepicker({
        dateFormat: 'yy-mm-dd',
        language: 'ja',
    });
});