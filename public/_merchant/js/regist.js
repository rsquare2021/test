// 目次
// 1_メールアドレス登録
// 2_パスコード認証
// 3_会員登録完了

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// 1_メールアドレス登録
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$('#regist').on('click', function(){
	$data ={
		url: './ajax/regist_mail.php',
		type: 'POST',
		data:{
			mail: $('#mail').val()
		},
		dataType:'json'
	};
	callFrontAjax($data, registMail);
});
function registMail(data){
	if(data["code"]){
		alert("code:"+data["code"]);
	}
	window.location.href = "./auth_register_code.php";
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// 2_パスコード認証
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$('#regist_code').on('click', function(){
	$data ={
		url: './ajax/regist_code.php',
		type: 'POST',
		data:{
			mail: $('#mail').val(),
			code: $('#code').val()
		},
		dataType:'json'
	};
	callFrontAjax($data, registCode);
});
function registCode(data){
	if(data.result == 'false' ) {
		alert('パスコードに誤りがあります。');
	} else {
		//alert('会員登録が完了しました！');
		window.location.href = "./auth_register_detail.php";
	}
}
// 

/////

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// 3_会員登録完了
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$('#regist_complete').on('click', function(){
	$data ={
		url: './ajax/regist.php',
		type: 'POST',
		data:{
			mail: $('#mail').val(),
			password: $('#password').val()
		},
		dataType:'json'
	};
	callFrontAjax($data, registComplete);
});
function registComplete(data){
	if(data.result == 'already' ) {
		alert('メールアドレスが不正です。メールアドレス認証を再度行ってください。');
		window.location.href = "./auth_register.php";
	} else if(data.result == 'double') {
		alert('IDが既に使用されています。別のIDを入力してください。');
	} else {
		alert('会員登録が完了しました！');
		window.location.href = "./auth_login.php";
	}
}