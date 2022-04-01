$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    },
});

// レシート画像取得
$(document).on('click','.re_img_get',function(){
    $('.re_body img').attr('src','');
    var receipt_path = $(this).data('receipt_path');
    $.ajax({
        url: "/admin/re/img/get",
        type: "get",
        data: {
            receipt_path: receipt_path,
        },
    })
    .then(
        (data) => {
            $('.re_body img').attr('src',data);
        },
        (error) => {
            console.log(error);
        }
    );
});
$(document).on('click','.merchant_img_get',function(){
    $('.re_body img').attr('src','');
    var receipt_path = $(this).data('receipt_path');
    $.ajax({
        url: "/merchant/img/get",
        type: "get",
        data: {
            receipt_path: receipt_path,
        },
    })
    .then(
        (data) => {
            $('.re_body img').attr('src',data);
        },
        (error) => {
            console.log(error);
        }
    );
});
$('#kengen0').on('click','.confirm_product',function(){
    var validation = false;
    var mk_time1 = $('input[name="mk_time1"]').val();
    var mk_time2 = $('input[name="mk_time2"]').val();
    var error = 0;
    $(this).toggleClass('active');
    $('.confirm_product').each(function(){
        if($(this).hasClass('active')) {
        } else {
            error = 1;
        }
    });
    if(error == 0) {
        $('.meken_btns button').prop('disabled',false);
    } else {
        $('.meken_btns button').prop('disabled',true);
    }
});
$(document).on('click','.meken_btns input',function(){
    return false;
});

// 目検複数商品
$(document).on('click','.set_value_plus',function(){
    $('<div class="inputs mb-2"><input class="multi_value form-control" type="text" name="multi_value[]" value="0.00"> L</div>').appendTo('.value_td');
});
// 目検商品追加リアルタイム計算
$(function() {
    // var $input = $('.set_value');
    // var input_value = '';
    // $input.on('input', function() {
    //     input_value = $(this).val();
    //     var length = input_value.length();
    //     alert(length);
        // var val = '';
        // var total = 0.00;
        // total = parseFloat(total);
        // input_value = $(this).val();
        // $('.multi_value').each(function(){
        //     val = parseFloat($(this).val());
        //     total += parseFloat(total) + parseFloat(val);
        // });
        // $('input[name="mk_value"]').val(total);
    // });
});
// 応募管理
$('#project_apply').on('click','.apply_admin_status .status_content',function(){
    let $button = $(this);
    let apply_id = $button.parent().data("id");
    let new_status_id = $button.data("new_status_id");
    $.ajax({
        url: "apply/status",
        type: "post",
        data: {
            apply_id: apply_id,
            new_status_id: new_status_id,
        },
    })
    .then(
        (data) => {
            $button.parent('div').parent('td').children('div').children('.status_content').removeClass('active');
            $button.addClass('active');
            $button.parents("tr").find(".status_name").text(data);
        },
        (error) => {
            console.log(error);
        }
    );
});

// エンドユーザー一覧
$('body').on('click','.select_reset_btn',function(){
    $('#re_select input[type="text"]').each(function(){
        $(this).val('');
    });
    $('.default').prop('checked',true);
    $('.custom-checkbox input[type="checkbox"]').each(function(){
        $(this).prop('checked',false);
    });
    $('.custom-control-label').each(function(){
        $(this).removeClass('active');
    });
    $('select[name="mk_company"] option').each(function(){
        $(this).prop('selected',false);
    });
});

// レシート一覧
$('#re_select').on('click','.custom-checkbox label',function(){
    $(this).toggleClass('active');
});
$(function() {
    $.datepicker.setDefaults($.datepicker.regional["ja"]);
    $('.datepicker').datepicker({
        dateFormat: 'yy-mm-dd',
        language: 'ja',
    });
    $('.datepicker2').datepicker({
        dateFormat: 'yy-mm-dd',
        language: 'ja',
    });
});
$('body').on('click','.meken_submit',function(){
    var id = $(this).parent('td').data('id');
    var action = $(this).attr('id');
    var status = $(this).parent('td').data('status');
    var date = $('.re_date'+id).val();
    var time = $('.re_time'+id).val();
    var value = $('.re_value'+id).val();
    var point = $('.re_point'+id).val();
    $data ={
		url: '/assets/ajax/meken_edit.php',
		type: 'POST',
		data:{
			id: id,
            action: action,
            status: status,
            date: date,
            time: time,
            value: value,
            point: point,
		},
		dataType:'json'
	};
	callFrontAjax($data, meken_edit);
});
function meken_edit(data){
    var id = data.id;
    var status = data.status;
    $('#'+id).children('.status').html(status);
	alert('登録しました。');
}


// ユーザー管理
$('.user_list').on('click','.user_edit_button',function(){
    // ユーザー情報値取得
    var id = $(this).parent().parent().find('.user_id').html();
    var name = $(this).parent().parent().find('.user_name').html();
    var company = $(this).parent().parent().find('.user_company').html();
    var mail = $(this).parent().parent().find('.user_mail').html();
    var pass = $(this).parent().parent().find('.user_pass').html();
    $('#editModalLabel').html(name + '　のユーザー情報編集');
    $('#user_edit_name').val(name);
    $('#user_edit_company').val(company);
    $('#user_edit_mail').val(mail);
    $('#user_edit_pass').val(pass);
    $('.user_edit_btn').attr('id','user_edit_btn' + id);
});

// 所属会社追加
$('body').on('click','.tree_add',function(){
    $('.company_wrap').append('<select class="form-control user_company mt-2"><option>選択してください</option><option>ENEOS WING 全店舗</option></select>');
    $('body').find('.bs-tooltip').tooltip();
});

// ツリー支社追加
$('body').on('click','.sub_add_btn',function(){
    var count = $('#sub_count').val();
    var count = parseInt(count)+1;
    $('#sub_count').val(count);
    var insert_id = 'pre_tree_sub-'+count;
    var sub = $('.sub_add_name').val();
    $('.sub_wrap').append('\
        <li id="'+insert_id+'">\
            <span class="caret caret-down"><text>'+sub+'</text><a class="tree_sub_delete bs-tooltip" data-original-title="支社削除" title="支社削除"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus-circle"><circle cx="12" cy="12" r="10"></circle><line x1="8" y1="12" x2="16" y2="12"></line></svg></a><a class="tree_edit bs-tooltip" data-original-title="支社編集" title="支社名編集"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg></a></span>\
            <ul class="nested mt-1">\
                <div class="area_add_bloc">\
                    <input type="text" class="mb-2 area_add_name" name="" placeholder="エリア名">\
                    <a class="area_add_btn"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg></a>\
                </div>\
            </ul>\
        </li>\
    ');
    $('.sub_add_name').val('');
    $('body').find('.bs-tooltip').tooltip();
});

// ツリーエリア追加
$('body').on('click','.area_add_btn',function(){
    var count = $('#area_count').val();
    var count = parseInt(count)+1;
    $('#area_count').val(count);
    var insert_id = 'pre_tree_area-'+count;
    var area = $('.area_add_name').val();
    $(this).parent().parent('ul').append('\
        <li id="'+insert_id+'">\
            <span class="caret caret-down"><text>'+area+'</text><a class="tree_area_delete bs-tooltip" title="エリア削除"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus-circle"><circle cx="12" cy="12" r="10"></circle><line x1="8" y1="12" x2="16" y2="12"></line></svg></a><a class="tree_edit bs-tooltip" title="エリア名編集"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg></a></span>\
            <ul class="nested">\
                <div class="shop_add_bloc">\
                    <input type="text" class="mb-2 shop_add_name" name="" placeholder="店舗名">\
                    <a class="shop_add_btn bs-tooltip" title="店舗追加"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg></a>\
                </div>\
            </ul>\
        </li>\
    ');
    $('.area_add_name').val('');
    $('body').find('.bs-tooltip').tooltip();
});

// ツリー店舗追加
$('body').on('click','.shop_add_btn',function(){
    var count = $('#shop_count').val();
    var count = parseInt(count)+1;
    $('#shop_count').val(count);
    var insert_id = 'pre_tree_shop-'+count;
    var shop = $('.shop_add_name').val();
    $(this).parent().parent('ul').append('\
        <li id="'+insert_id+'">\
            <text>'+shop+'</text><a class="tree_shop_delete bs-tooltip" title="店舗削除"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus-circle"><circle cx="12" cy="12" r="10"></circle><line x1="8" y1="12" x2="16" y2="12"></line></svg></a><a class="tree_edit bs-tooltip" title="店舗名編集"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg></a>\
        </li>\
    ');
    $('.area_add_name').val('');
    $('body').find('.bs-tooltip').tooltip();
});

// ツリー支社・エリア編集
$('body').on('click','.tree_edit',function(){
    var id = $(this).parent().parent('li').attr('id');
    var target_name = $(this).parent('span').text();
    $('#edit_target').val(id);
    $('#editModal .modal-title').html('<span class="edit_target_name">'+target_name+'</span>の編集');
    $('#editModal .modal-body #tree_edit_name').val(target_name);
    $('#editModal').modal('show');
    exit;
});
$('body').on('click','.tree_edit_btn',function(){
    var target = $('#edit_target').val();
    var edit_name = $('#tree_edit_name').val();
    var edit_parent = $('.edit_target_name').text();
    $('#edit_target').val('');
    $('#'+target+'>span text').text(edit_name);
    if(edit_parent == edit_name) {
    } else {
        $('#'+target).addClass('edit');
    }
});

// ツリー店舗編集
$('body').on('click','.tree_edit_shop',function(){
    var id = $(this).parent('li').attr('id');
    var target_name = $(this).parent('li').text();
    $('#edit_shop_target').val(id);
    $('#editShopModal .modal-title').html('<span class="edit_shop_target_name">'+target_name+'</span>の編集');
    $('#editShopModal .modal-body #tree_edit_shop_name').val(target_name);
    $('#editShopModal').modal('show');
    exit;
});
$('body').on('click','.tree_edit_shop_btn',function(){
    var target = $('#edit_shop_target').val();
    var edit_name = $('#tree_edit_shop_name').val();
    var edit_parent = $('.edit_target_shop_name').text();
    $('#edit_shop_target').val('');
    $('#'+target+' text').text(edit_name);
    if(edit_parent == edit_name) {
    } else {
        $('#'+target).addClass('edit');
    }
});
$(function(){
    var i = 1;
    $('.shop_elem').each(function(){
        $(this).attr('data-shop',i);
        i++;
    });
});


// ツリー支社削除
$('body').on('click','.shisha_delete',function(){
    var id = $(this).parent().parent('li').data('office');
    $('.shop_delete_btn').attr('id','shishaDelete');
    $('#delete_target').val(id);
    $('.modal-title').html('支社削除');
    $('.modal-body p').html('この支社を本当に削除してよろしいですか？');
    $('#deleteModal').modal('show');
    exit;
});
$('body').on('click','.shop_delete_btn',function(){
    var del = $(this).attr('id');
    var target = $('#delete_target').val();
    var target_area = $('#delete_target_area').val();
    var target_shop = $('#delete_target_shop').val();
    if(del == 'shishaDelete') {
        $('[data-office="'+target+'"]').remove();
    } else if(del == 'areaDelete') {
        $('[data-office="'+target+'"][data-area="'+target_area+'"]').remove();
    } else {
        $('[data-shop="'+target_shop+'"]').remove();
    }
    $('#delete_target').val('');
    $('#delete_target_area').val('');
    $('#delete_target_shop').val('');
});

// ツリーエリア削除
$('body').on('click','.area_delete',function(){
    var office_id = $(this).parent().parent('li').data('office');
    var area_id = $(this).parent().parent('li').data('area');
    $('.shop_delete_btn').attr('id','areaDelete');
    $('#delete_target').val(office_id);
    $('#delete_target_area').val(area_id);
    $('.modal-title').html('エリア削除');
    $('.modal-body p').html('この支社を本当に削除してよろしいですか？');
    $('#deleteModal').modal('show');
    exit;
});

// ツリー店舗削除
$('body').on('click','.shop_delete',function(){
    var office_id = $(this).parent().parent('li').data('office');
    var area_id = $(this).parent().parent('li').data('area');
    var shop_id = $(this).parent().parent('li').data('shop');
    $('.shop_delete_btn').attr('id','shopDelete');
    $('#delete_target').val(office_id);
    $('#delete_target_area').val(area_id);
    $('#delete_target_shop').val(shop_id);
    $('.modal-title').html('店舗削除');
    $('.modal-body p').html('この店舗を本当に削除してよろしいですか？');
    $('#deleteModal').modal('show');
    exit;
});

// ツリー制御
$('body').on('click','.caret',function(){
    $(this).toggleClass('caret-down');
    $(this).next('ul').toggleClass('active');
});
$('#edit_mode').on('click', function() {
    if ( $(this).prop('checked') == false ) {
        $('.caret a').each(function(){
            $(this).hide();
        });
        $('#shop_tree_edit form input').each(function(){
            $(this).prop('disabled',true);
        });
        $('#shop_tree_edit button').hide();
    } else {
        $('.caret a').each(function(){
            $(this).show();
        });
        $('#shop_tree_edit form input').each(function(){
            $(this).prop('disabled',false);
        });
        $('#shop_tree_edit button').show();
    }
});


// 会社管理
$('.company_list').on('click','.company_edit_button',function(){
    var id = $(this).parent().parent().find('.company_id').html();
    var company_name = $(this).parent().parent().find('.company_name').html();
    var company_sub_name = $(this).parent().parent().find('.company_sub_name').html();
    var company_depart = $(this).parent().parent().find('.company_depart').html();
    $('#companyEditModalLabel').html(company_name + '　の情報編集');
    $('#company_edit_name').val(company_name);
    $('#company_edit_sub_name').val(company_sub_name);
    $('#company_edit_depart').val(company_depart);
    $('.company_edit_btn').attr('id','company_edit_btn' + id);
});

// 会社支社追加
$('#company_edit').on('click','.company_shisha_add',function(){
    var company_sub_name = '';
    var company_depart = '';
    var company_sub_name = $('.company_sub_name').val();
    var company_depart = $('.company_depart').val();
    $('#company_add').append('<div class="company_shisha_add"><input type="text" class=""></div>');
    $('body').find('.bs-tooltip').tooltip();
});

// ユーザー管理
$('.shop_list').on('click','.shop_edit_button',function(){
    // ユーザー情報値取得
    var id = $(this).parent().parent().find('.shop_id').html();
    var name = $(this).parent().parent().find('.shop_name').html();
    var company = $(this).parent().parent().find('.user_company').html();
    var mail = $(this).parent().parent().find('.user_mail').html();
    var pass = $(this).parent().parent().find('.user_pass').html();
    $('#shopEditModalLabel').html(name + '　のユーザー情報編集');
    $('#shop_edit_name').val(name);
    $('#user_edit_company').val(company);
    $('#user_edit_mail').val(mail);
    $('#user_edit_pass').val(pass);
    $('.user_edit_btn').attr('id','user_edit_btn' + id);
});

// ユーザー会社管理
$('.user_shop_target').on('click','.user_shop_add',function(){
    $('.user_shop_target input[type="checkbox"]:checked').each(function(){
        var target = $(this).attr('id');
        $('#' + target).prop("checked", false);
        $('.' + target).addClass('move');
        $('.' + target).insertBefore('.user_shop_list tbody tr:first-child');
    });
});
$('.user_shop_list').on('click','.user_shop_remove',function(){
    $('.user_shop_list input[type="checkbox"]:checked').each(function(){
        var target = $(this).attr('id');
        $('#' + target).prop("checked", false);
        $('.' + target).addClass('move');
        $('.' + target).insertBefore('.user_shop_target tbody tr:first-child');
    });
});

// ユーザー担当
$(function(){
    // カウント事前処理
    var area_total = 0;
    $('#charge .area').each(function(){
        var area = $(this).data('area');
        var leng = $('.shop_area-'+area).length;
        var sel = 0;
        $('.count-total-'+area).html(leng);
        $('.count-select-'+area).html(sel);
    });
    // 会社チェック
    $('#charge .company').change(function() {
        var company = $(this).data('company');
        var prop = $(this).prop('checked');
        if(prop) {
            // 左サイドバー
            $('.company-'+company+'.sub_company').each(function(){
                $(this).prop('checked',true);
            });
            $('.company-'+company+'.area').each(function(){
                $(this).prop('checked',true);
            });
            $('.company-'+company+'.area').prop('disabled', true);
            $('.company-'+company+'.sub_company').prop('disabled', true);
            // 店舗リスト
            $('.charge_list .shop_company-'+company).each(function(){
                $(this).prop('checked',true);
                $(this).prop('disabled', true);
            });
            // カウント
            $('.company-'+company+'.area').each(function(){
                var area = $(this).data('area');
                var leng = $('.shop_area-'+area).length;
                $('.count-select-'+area).html(leng);
            });
            // 送信用クラス削除
            $(this).parent().parent().find('.sub_send').removeClass('sub_send');
            $(this).parent().parent().find('.area_send').removeClass('area_send');
            $(this).parent().parent().find('.shop_send').removeClass('shop_send');
            $('.s_company-'+company+'.shop_ul').each(function(){
                $(this).removeClass('shop_send');
            });
        } else {
            // 左サイドバー
            $('.company-'+company+'.sub_company').each(function(){
                $(this).prop('checked',false);
            });
            $('.company-'+company+'.area').each(function(){
                $(this).prop('checked',false);
            });
            $('.company-'+company+'.area').prop('disabled', false);
            $('.company-'+company+'.sub_company').prop('disabled', false);
            // 店舗リスト
            $('.charge_list .shop_company-'+company).each(function(){
                $(this).prop('checked',false);
                $(this).prop('disabled', false);
            });
            // カウント
            $('.company-'+company+'.area').each(function(){
                var area = $(this).data('area');
                var leng = 0;
                $('.count-select-'+area).html(leng);
            });
            // 送信用クラス追加
            $(this).parent().parent().find('.sub_ul').addClass('sub_send');
            $(this).parent().parent().find('.area_ul').addClass('area_send');
            $('.s_company-'+company+'.shop_ul').each(function(){
                $(this).addClass('shop_send');
            });
        }
    });
    // 支社チェック
    $('#charge .sub_company').change(function() {
        var company = $(this).data('company');
        var prop = $(this).prop('checked');
        var sub = $(this).data('sub');
        if(prop) {
            // 左サイドバー
            $('.company-'+company+'.area.sub-' + sub).each(function(){
                $(this).prop('checked',true);
            });
            // 店舗リスト
            $('.shop_sub-' + sub).each(function(){
                $(this).prop('checked',true);
            });
            // カウント
            $('.sub-'+sub).each(function(){
                var area = $(this).data('area');
                area_total = $('.shop_area-'+area+':checked').length;
                $('.count-select-'+area).html(area_total);
            });
            // 送信用クラス削除
            $(this).parent().parent().find('.area_send').removeClass('area_send');
            $('.s_company-'+company+'.shop_send').each(function(){
                $(this).removeClass('shop_send');
            });
        } else {
            // 左サイドバー
            $('.area.sub-' + sub).each(function(){
                $(this).prop('checked',false);
            });
            // 店舗リスト
            $('.charge_list .shop_sub-' + sub).each(function(){
                $(this).prop('checked',false);
            });
            // カウント
            $('#charge .sub-'+sub).each(function(){
                var area = $(this).data('area');
                area_total = $('.shop_area-'+area+':checked').length;
                $('.count-select-'+area).html(area_total);
            });
            // 送信用クラス追加
            $(this).parent().parent().find('.area_ul').addClass('area_send');
            $('.shop_ul.s_company-'+company).each(function(){
                $(this).addClass('shop_send');
            });
        }
    });
    // エリアチェック
    $('#charge .area').change(function() {
        var prop = $(this).prop('checked');
        var sub = $(this).data('sub');
        var area = $(this).data('area');
        if(prop) {
            // 店舗リスト
            $('.charge_list .shop_area-' + area).each(function(){
                $(this).prop('checked',true);
            });
            // カウント
            $('#charge .sub-'+sub).each(function(){
                var area = $(this).data('area');
                area_total = $('.shop_area-'+area+':checked').length;
                $('.count-select-'+area).html(area_total);
            });
            // 送信用クラス削除
            $('.s_area-'+area+'.shop_send').each(function(){
                $(this).removeClass('shop_send');
            });
        } else {
            // 左サイドバー
            $('.sub_company.sub-' + sub).each(function(){
                $(this).prop('checked',false);
            });
            // 店舗リスト
            $('.charge_list .shop_area-' + area).each(function(){
                $(this).prop('checked',false);
            });
            // カウント
            $('#charge .sub-'+sub).each(function(){
                var area = $(this).data('area');
                area_total = $('.shop_area-'+area+':checked').length;
                $('.count-select-'+area).html(area_total);
            });
            // 送信用クラス追加
            $('.shop_ul.s_area-'+area).each(function(){
                $(this).addClass('shop_send');
            });
            $('.area_'+sub+'_wrap .area_ul').addClass('area_send');
        }
    });
    // 店舗リストチェック
    $('.charge_list input').change(function() {
        var company = $(this).data('company');
        var prop = $(this).prop('checked');
        var sub = $(this).data('shop_sub');
        var area = $(this).data('shop_area');
        var area_select = 0;
        var sub_select = 0;
        if(prop) {
            // 店舗リスト エリア判定
            $('.charge_list .shop_area-' + area).each(function(){
                var prop = $(this).prop('checked');
                if(prop) {
                    area_select = area_select +1;
                    area_total = $('.shop_area-'+area+':checked').length;
                    $('.count-select-'+area).html(area_total);
                } else {
                    area_select = area_select -100000;
                }
            });
            // 店舗リスト 支社判定
            $('.charge_list .shop_sub-' + sub).each(function(){
                var prop = $(this).prop('checked');
                if(prop) {
                    sub_select = sub_select +1;
                } else {
                    sub_select = sub_select -100000;
                }
            });
        } else {
            // 左サイドバー
            $('.sub_company.sub-' + sub).each(function(){
                $(this).prop('checked',false);
            });
            $('.area.area-' + area).each(function(){
                $(this).prop('checked',false);
            });
            area_total = $('.shop_area-'+area+':checked').length;
            $('.count-select-'+area).html(area_total);
        }
        if(area_select > 0) {
            $('.area.area-' + area).each(function(){
                $(this).prop('checked',true);
            });
        } else {
            // 送信用クラス追加
            $('.shop_ul.s_area-'+area).each(function(){
                $(this).addClass('shop_send');
            });
        }
        if(sub_select > 0) {
            $('.sub_company.sub-' + sub).each(function(){
                $(this).prop('checked',true);
                // 送信用クラス削除
                $(this).parent().parent().find('.area_send').removeClass('area_send');
                $('.s_sub-'+sub+'.shop_send').each(function(){
                    $(this).removeClass('shop_send');
                });
            });
        } else {
            // 送信用クラス追加
            $('.sub_company.sub-' + sub).each(function(){
                $(this).parent().parent().find('.area_ul').addClass('area_send');
            });
        }
    });
    // 担当登録ボタン
    $('#charge').on('click','.charge_edit_btn',function(){
        // 会社選択判定
        var company = $('#charge .company:checked').length;
        if(company) {
            // 会社情報セット
            var company_data = [];
            $('#charge .company:checked').each(function(){
                var company = $(this).data('company');
                company_data.push(company);
            });
            // ポストする会社ID
            alert('会社：'+company_data);
        }
        // 支社選択判定
        var sub_company = $('#charge .sub_send .sub_company:checked').length;
        if(sub_company) {
            // 支社情報セット
            var sub_data = [];
            $('#charge .sub_send .sub_company:checked').each(function(){
                var sub = $(this).data('sub');
                sub_data.push(sub);
            });
            // ポストする支社ID
            alert('支社：'+sub_data);
        }
        // エリア選択判定
        var area = $('#charge .area_send .area:checked').length;
        if(area) {
            // エリア情報セット
            var area_data = [];
            $('#charge .area_send .area:checked').each(function(){
                var area = $(this).data('area');
                area_data.push(area);
            });
            // ポストするエリアID
            alert('エリア：'+area_data);
        }
        // 店舗選択判定
        var shop = $('#charge .shop_send .shop:checked').length;
        if(shop) {
            // 店舗情報セット
            var shop_data = [];
            $('#charge .shop_send .shop:checked').each(function(){
                var shop = $(this).data('shop');
                shop_data.push(shop);
            });
            // ポストする店舗ID
            alert('店舗：'+shop_data);
        }
    });
});

// 応募（発送先表示非表示切り替え） *エンドユーザーの処理含む
$(function() {
    $('#apply #zero-config .deli').hide();
    $('#check').on('click', function() {
        if ( $(this).prop('checked') == false ) {
            $('#apply #zero-config th').show();
            $('#apply #zero-config td').show();
            $('#apply #zero-config .deli').hide();
            $('#apply #zero-config .all').show();
        } else {
            $('#apply #zero-config th').hide();
            $('#apply #zero-config td').hide();
            $('#apply #zero-config .deli').show();
            $('#apply #zero-config .all').show();
        }
    });
    $('#enduser_apply #zero-config .deli').hide();
    $('#check').on('click', function() {
        if ( $(this).prop('checked') == false ) {
            $('#enduser_apply #zero-config th').show();
            $('#enduser_apply #zero-config td').show();
            $('#enduser_apply #zero-config .deli').hide();
            $('#enduser_apply #zero-config .all').show();
        } else {
            $('#enduser_apply #zero-config th').hide();
            $('#enduser_apply #zero-config td').hide();
            $('#enduser_apply #zero-config .deli').show();
            $('#enduser_apply #zero-config .all').show();
        }
    });
});

// キャンペーン景品登録
$('#project_product_create').on('click','.course_duplicate',function(){
    $('.course_wrap:first-child').clone(true).appendTo('#course');
});

// キャンペーン景品コース追加
$('body').on('click','#course_add',function(){
    // 追加タブカウント
    var count = $('#tab_count').val();
    var count = parseInt(count);
    $('#tab_count').val(count);
    // タブメニュー追加
    $('.nav-tabs').append('\
        <li class="nav-item">\
            <a class="nav-link" id="pre_c'+count+'-tab" data-toggle="tab" href="#pre_c'+count+'">コース名</a><a class="course_delete bs-tooltip" title="コース削除"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus-circle"><circle cx="12" cy="12" r="10"></circle><line x1="8" y1="12" x2="16" y2="12"></line></svg></a>\
        </li>\
    ');
    // 追加ボタン再セット
    $('#course_add').parent('li').remove();
    $('.nav-tabs').append('\
        <li class="nav-item">\
            <a class="nav-link" id="course_add">＋</a>\
        </li>\
    ');
    // タブコンテンツ追加
    $('.tab-content').append('\
        <div class="tab-pane fade" id="pre_c'+count+'" data-index="'+count+'">\
            <div class="dup_bloc">\
                <input type="hidden" name="courses['+count+'][id]" value="">\
                <table class="table">\
                    <tr>\
                        <td>コース名</td>\
                        <td><input type="text" class="form-control course_name" data-name_id="pre_c'+count+'" name="courses['+count+'][name]"></td>\
                    </tr>\
                    <tr>\
                        <td>交換ルール</td>\
                        <td>\
                            <select class="form-control user_company">\
                                <option>選択してください</option>\
                                <option>交換ルール1</option>\
                                <option>交換ルール2</option>\
                            </select>\
                        </td>\
                    </tr>\
                    <tr>\
                        <td>必要ポイント</td>\
                        <td><input type="text" class="form-control" name="courses['+count+'][point]"></td>\
                    </tr>\
                    <tr>\
                        <td>当選確率</td>\
                        <td><input type="text" class="form-control" name="courses['+count+'][win_rate]"></td>\
                    </tr>\
                </table>\
                <div class="product_list">\
                    <a class="btn btn-primary mb-4 product_search">景品追加</a>\
                    <table id="zero-config" class="table table-hover user_list" style="width:100%">\
                        <thead>\
                            <tr>\
                                <th>景品名</th>\
                                <th>景品カテゴリー</th>\
                                <th>当選本数</th>\
                                <th class="no-content"></th>\
                            </tr>\
                        </thead>\
                        <tbody>\
                        </tbody>\
                    </table>\
                </div>\
            </div>\
        </div>\
    ');
    $('body').find('.bs-tooltip').tooltip();
});

// キャンペーン景品コース名初期セット
$('.course_name').each(function(){
    var id = $(this).data('name_id');
    var name = $('#'+id+'-tab').html();
    $(this).val(name);
});

// キャンペーン景品コース名編集
$(document).on('keyup','.course_name', function(){
    var id = $(this).data('name_id');
    var val = $(this).val();
    $('#'+id+'-tab').html(val);
});

// キャンペーン景品コース削除
$('body').on('click','.course_delete',function(){
    var id = $(this).parent('li').find('.nav-link').attr('id');
    var id = id.replace('-tab','');
    $('#delete_target').val(id);
    $('.modal-title').html('コース削除');
    $('.modal-body p').html('このコースを本当に削除してよろしいですか？');
    $('#deleteModal').modal('show');
    exit;
});
$('body').on('click','.course_delete_btn',function(){
    var id = $('#delete_target').val();
    $('#'+id+'-tab').parent('li').remove();
    $('#'+id).remove();
    $('.tooltip').removeClass('show');
});

// キャンペーン景品・景品検索
$('body').on('click','.product_search',function(){
    var name = $(this).parent().parent('.dup_bloc').find('.course_name').val();
    var parent = $(this).parent().parent().parent('.tab-pane').attr('id');
    $('.modal #parent').val(parent);
    $('#productModal').find('.modal-title').html(name+'の景品編集');
    $('#productModal input[type="checkbox"]').prop("checked", false);
    $(this).parent().parent('.dup_bloc').find('tbody tr').each(function(){
        var id = $(this).data('id');
        $('#pro_check'+id).prop("checked", true);
        $('#pro_check'+id).removeClass('yet');
    });
    $('#productModal').modal('show');
});

// キャンペーン景品コースに景品追加
$('body').on('click','.pro_listup_btn',function(){
    // チェックボックス周回
    $('.modal input[type="checkbox"]').each(function(){
        var id = $(this).data('id');
        var name = $('#pro'+id+' .pro_name').html();
        var cat = $('#pro'+id+' .pro_cat').html();
        var zaiko = $('#pro'+id+' .pro_zaiko').html();
        var prop = $(this).prop('checked');
        var parent = $('#parent').val();
        var input_attr_name = "courses[" + $("#"+parent).data("index") + "]";
        // チェックボックス選択確認
        if(prop) {
            // 未登録確認
            if($(this).hasClass('yet')) {
                // リストに追加
                $('#'+parent+' .product_list tbody').append('\
                    <tr id="pro_list'+id+'" data-id="'+id+'">\
                        <td class="pro_name">'+name+'</td>\
                        <td class="pro_cat">\
                            <select class="form-control" name="">\
                                <option value="">選択してください</option>\
                                <option value="1">カテゴリー1</option>\
                                <option value="2">カテゴリー2</option>\
                            </select>\
                        </td>\
                        <td class="pro_zaiko">\
                            <input type="text" class="form-control" name="'+input_attr_name+'[products]['+id+'][win_limit]" value="'+zaiko+'">\
                        </td>\
                        <td>\
                            <input type="hidden" name="'+input_attr_name+'[products]['+id+'][id]" value="">\
                            <input type="hidden" name="'+input_attr_name+'[products]['+id+'][product][id]" value="'+id+'">\
                            <input type="hidden" name="'+input_attr_name+'[products]['+id+'][product][name]" value="'+name+'">\
                            <a class="btn btn-outline-danger mb-2 pro_delete_btn">削除</a>\
                        </td>\
                    </tr>\
                ');
            }
        } else {
            // リストから削除
            // $('#pro_list'+id).remove();
        }
    });
});

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















