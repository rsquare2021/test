// JavaScript Document

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// ログイン
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$('#klik').on('click', function(){
	$data ={
		url: '/_merchant/ajax/login.php',
		type: 'POST',
		data:{
			mail: $('#mail').val(),
			password:  $('#password').val()
		},
		dataType:'json'
	};
	callFrontAjax($data, login);
});

function login(data){
	if(data.result === 'false'){
		alert('IDとパスワードが一致しませんでした');
	} else {
		window.location.href = "/merchant/list";
	}
//	$.each(data, function(key, value){
//		$('#result').append("<div>ID：" + value.project_id + "</div><div>案件名：" + value.property_name + "</div><div>作成者：" + value.created_user_id + "</div><div>作成日：" + value.created_at + "</div><div>更新日：" + value.updated_at + "</div><a id=\""+ value.project_id + "\" href=\"#\" class=\"delete_btn\">削除</a>　<a id=\""+ value.project_id + "\" href=\"#\" class=\"project_move\">閲覧</a><br><br>");
//	});
}

