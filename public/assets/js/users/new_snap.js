(function(){

	//////////////////////////////////////////////////////////////////////
	// 変数セット
	//////////////////////////////////////////////////////////////////////
	var str = "";
	var pay_date = "";
	var tel = ""
	var no = "";
	var time = "";
	var total = "";
	var items = Array();
	var isChangeValue = false;
	var term = 0;
	var re_point = '';
	var re_oil = '';
	var base_oil = '';
	var len_ng = false;
	var com = '';
	var isNg = false;
	var isShopNg = false;
	var double = false;
	var isLightNg = false;
	var isAcceptAll = false;
	var productNg = "0";
	var startTime = $("#start_time").val()-0;
	var endTime = $("#end_time").val()-0;
	var tel_blank = false;
	var er2 = false;
	var er3 = false;
	var er4 = false;

	//////////////////////////////////////////////////////////////////////
	// 関数
	//////////////////////////////////////////////////////////////////////
	$.extend({
		// リロード
		attention: function () {
			var campaign = $("#cam_id").val();
			window.location.href = '/'+campaign+'/dashboard/snap/error/';
			// location.reload();
			// exit();
		},
		// ローディング開始
		loading_start: function () {
			$('.loading').show();
			$('body').addClass('overflow_hidden');
		},
		// ローディング終了
		loading_end: function () {
			$('.loading').hide();
			$('body').removeClass('overflow_hidden');
		},
	});

	//////////////////////////////////////////////////////////////////////
	// リセット
	//////////////////////////////////////////////////////////////////////
	function reset(){
		$("#res_input").val("");
		$("#get_point").text("");
		$("#error_reason").empty();
		$("#sendBtn").text("送信");
		str = "";
		tel = "";
		pay_date = "";
		no = "";
		total = "";
		isChangeValue = false;
		isNg = false;
		isLightNg = false;
		items = Array();
		isAcceptAll = false;
	}



	//////////////////////////////////////////////////////////////////////
	// チェック
	//////////////////////////////////////////////////////////////////////
	function checkStatus(){
		//return
		if(isAcceptAll){
			$("#snap_ok").show();
			return
		}
		//////////////////////////////////////////////////////////////////////
		// 1_不正レシートの最初のチェック
		if(isNg == false) {
			// $data ={
			// 	url: '/assets/ajax/post_receipt.php',
			// 	type: 'POST',
			// 	data:{
			// 		campaign_id: $("#cam_id").val(),
			// 		user_id: $("#user_id").val(),
			// 		isNg: 1,
			// 	},
			// 	dataType:'json'
			// };
			// alert('不正なレシートです。');
			// $.attention();
		//////////////////////////////////////////////////////////////////////
		// 2_期間の最初のチェック
		if(pay_date != "" && time != ""){
			var dateInt = pay_date.replace(/[^0-9]/g, '')-0;
			if(dateInt < startTime || dateInt > endTime){
				er2 = true;
				term = 1;
			} else {
				term = 0;
			}
		} else {
			alert('レシート発行日が読み取れません。\nお手数ですが、再撮影してください。');
			$.attention();
		}
		//////////////////////////////////////////////////////////////////////
		// 3_商品の最初のチェック
		if(items.length == 0){
			er3 = true;
			productNg = "1";
		}
		//////////////////////////////////////////////////////////////////////
		// 4_給油量の最初のチェック
		var isError = false;
		var re_value = $('#res_input').val();
		var re_point = $('.point_input').html();
		if(re_value == '' || re_value == null || re_point == '0' || re_point == 'NaN' || len_ng == true) {
			er4 = true;
		}
		//////////////////////////////////////////////////////////////////////
		// 2~4_ステータスチェック
		if(er2) {
			alert('このレシートは対象期間外か読み取り期限を過ぎています。\n読み取り期限は発行日から20日以内です。');
			$.attention();
		} else if(er3 && er4) {
			alert('対象商品がありません。');
			location.reload();
			exit();			
		} else if(er3 || er4) {
			alert('対象商品が読み取れません。\nお手数ですが、再撮影してください。');
			$.attention();
		}
		//////////////////////////////////////////////////////////////////////
		// 5_自分の送信レシートの最初の重複チェック 6_他者の痩身レシートの最初の重複チェック && 店舗情報確認
		tel = tel.replace(/-/g, '');
		tel = tel.replace(/-/g, '');
		pay_date = pay_date.replace(/[年月]/g, '-').replace("日","");
		time = time.replace(/\s+/g, "");
		$data ={
			url: '/assets/ajax/before_post_receipt.php',
			type: 'POST',
			data:{
				campaign_id: $("#cam_id").val(),
				user_id: $("#user_id").val(),
				pay_date: pay_date,
				tel: tel,
				time: time,
				re_value: re_value,
			},
			dataType:'json'
		};
		callFrontAjax($data, firstCheck);
		function firstCheck(data){
			if(data.result == false) {
				if(data.double == 'self') {
					alert('既に送信済みのレシートです。');
					$.attention();
				} else if(data.double == 'other') {
					alert('重複するレシートを検知しました。\nご自身のレシートでお間違いなければ\n「このまま送信」で送信してください。');
					double = true;
					$("#sendBtn").text("このまま送信");
					$.attention();
				} else if(data.shop == 'none') {
					alert('店舗情報が読み取れません。\nお手数ですが、再撮影してください。');
					$.attention();
				} else if(data.shop == 'ng') {
					alert('対象外の店舗です。\n対象店舗にもかかわらずこのエラーが表示された場合は\n「このまま送信」で送信してください。');
					isShopNg = true;
					$("#sendBtn").text("このまま送信");
					isAcceptAll = true;
					$("#snap_error").show();
				}
			}
		}	
		//////////////////////////////////////////////////////////////////////
		// エラー時（今は使用しない）
		if(isError){
			$("#error_reason").append("<p>レシート撮影時の注意事項を確認の上、再度送信してください。</p>");
			$("#snap_error").show();
		}
		else $("#snap_ok").show();
	} else {
		$("#snap_ok").show();
	}
	}



	//////////////////////////////////////////////////////////////////////
	// 送信ボタン
	//////////////////////////////////////////////////////////////////////
	$("#sendBtn").on("click",function(){
		$.loading_start();
		//////////////////////////////////////////////////////////////////////
		// 給油量の自己申告
		if($("#res_input").val() == "" || isNaN($("#res_input").val())){
			alert("数量が読み取れません。");
			return
		}
		//////////////////////////////////////////////////////////////////////
		// 給油量が数字以外
		var oil_check = $('#res_input').val();
		if(oil_check.match(/^([1-9]\d*|0)(\.\d+)?$/)) {
		} else {
			alert("数量が読み取れません。");
			return
		}
		//////////////////////////////////////////////////////////////////////
		// 給油量25Lに対して
		var point = Math.floor($("#res_input").val()/2);
		var po = po;
		//////////////////////////////////////////////////////////////////////
		// 送信データ成形
		tel = tel.replace(/-/g, '');
		tel = tel.replace(/-/g, '');
		pay_date = pay_date.replace(/[年月]/g, '-').replace("日","");
		pay_date = pay_date.slice( 0, 10 ) ;
		var blob = image2blob($("#camImage").get(),true);
		var data = new FormData();
		data.append("image", blob);
		data.append("val",$("#res_input").val());
		data.append("user_id",$("#user_id").val());
		data.append("campaign_id",$("#cam_id").val());
		data.append("start_time",$("#start_time").val());
		data.append("end_time",$("#end_time").val());
		data.append("campaign_shop_tree",$("#campaign_shop_tree").val());
		data.append("pay_date",pay_date);
		data.append("tel",tel);
		data.append("str",str);
		data.append("no",no);
		data.append("term",term);
		data.append("re_point",re_point);
		data.append("base_oil",base_oil);
		data.append("re_oil",re_oil);
		data.append("point",point);
		data.append("productNg",productNg);
		data.append("telBlank",tel_blank);
		data.append("com",com);
		data.append("time",time);
		data.append("total",total);
		if(isAcceptAll)data.append("accept",1);
		else data.append("accept",0);
		if(isChangeValue)data.append("isChange",1);
		else data.append("isChange",0);
		if(isNg)data.append("isNg",1);
		else data.append("isNg",0);
		if(isLightNg)data.append("isLightNg",1);
		else data.append("isLightNg",0);
		if(isShopNg)data.append("isShopNg",1);
		else data.append("isShopNg",0);
		if(double)data.append("double",1);
		else data.append("double",0);
		var itemsStr = "";
		if(items.length > 0){
			for(var n=0;n<items.length;n++){
				if(n != 0){
					itemsStr += "&I";
				}
				itemsStr += items[n][0]+"&C"+items[n][1];
			}
		}
		data.append("products",itemsStr);
		//////////////////////////////////////////////////////////////////////
		// Ajax post
		$data ={
			url: '/assets/ajax/post_receipt.php',
			type: 'POST',
			data:data,
			contentType: false,
			processData: false
		};
		callFrontAjax($data, function(data){
			$.loading_end();
			if(data.result == 'illegal'){
				alert('不正なレシートです。');
				$.attention();
			} else if(data.result) {
				var campaign = $("#cam_id").val();
				window.location.href = '/'+campaign+'/dashboard/snap/complete/';
			} else{
				alert('必要な情報が読み取れません。お手数ですが、再撮影してください。');
				$.attention();
			}
			// 再送信用初期化
			$("#snap_caution").show();
        	$("#snap_error").hide();
        	$("#snap_ok").hide();
    		$("#snap_result").hide();
			$("#fileInput").val("");
			$("#re_fileInput").val("");

			reset();
		});
	});

	// 照合対照の変数セット
	var searchList = [[/\d{2,4}-\d{2,4}-\d{4}/gi,"tel"]
					,[/(20\d{2})年(\d{2})月(\d{2})./,"日付"]
					,[/(\d{2}):(\d{2})/,"時間"]
					,[/レシートN[O0o]\d{2,6}-\d{2,6}/,"レシートNo"]
					,[/合計[¥羊张]\d{0,3},\d{3}/,"合計金額"]];
	var itemList = [["軽油","0216-00","軽数量油","0026-00","轻油","鞋油"]
					,["レギュラー","0026-00"]
					/*,["アド·ブルー","P62"]
					,["ハイオク"]*/
					];
	var searchCnt = [/\d{1,3}.\d{2}[L]/]
	var ngList = ["SS控","SSEえ","サイン","取消","仕入","実在庫","洗車売上","売上エラ","件数"];
	var light_ngList = ["0再","1再","2再","3再","4再","5再","6再","7再","8再","9再","売再","上再","様再","オーソリ"];

	//alert("0532-63-8116".match("/\d{2,4}-\d{2,4}-\d{4}/gi"));

	// フロント獲得ポイント計算
	// $("#res_input").change(function(){
	// 	isChangeValue = true;
	// 	var po = Math.floor($(this).val()/25);
	// 	$("#get_point").text(po+" <span>pts</span>");
	// });
	$(function() {
		var $input = $('#res_input');
		var input_value = '';
		$input.on('input', function(event) {
			input_value = $(this).val();
			if(input_value !== base_oil) {
				isChangeValue = true;
			} else {
				isChangeValue = false;
			}
			var po = Math.floor($(this).val()/2);
			$("#get_point").html('<span class="point_input">'+po+'</span>' + ' pts');
		});
	});

	$("#image_area").hide();

	// 撮り直し場合
	$("#re_fileInput").change(function(e){
		reset();
        sendImage(this);
    });

	//エラーによる取り直し
	$("#error_fileInput").change(function(e){
		reset();
		isAcceptAll = true;
        sendImage(this,true);
    });

	// 撮影後
	$("#fileInput").change(function(e){
		sendImage(this);
	});
	function sendImage(input,isAccept){
		$("#snap_caution").hide();
        $("#snap_error").hide();
        $("#snap_ok").hide();
        $("#snap_result").show();
        $("#sub_title").text("読み取り内容の確認");
		$("#snap_ok").find("#debug").remove();

		// overlay表示
		if(!isAccept) {
			$.loading_start();
		}

        console.log(input.files[0]);
		var file = input.files[0];

		// 画像データ読み取り後の処理
		var reader = new FileReader();
        reader.onload = function(){
			$("#camBtn").css("margin-top","5px");
			$("#camImage").unbind('load');
			$("#camImage").bind('load', function(){
				var base64 = image2base64($("#camImage").get(),true);
				
				if(isAccept){
					checkStatus();
					return;
				}
				
				var noHeader = base64.replace(/^data:image\/(png|jpg|jpeg);base64,/, "")
				var data = {
					"requests":[
						{
						"image":{
							"content":noHeader
						},
						"features":[
							{
							//"type":"DOCUMENT_TEXT_DETECTION",
							"type":"TEXT_DETECTION",
							"maxResults":3
							}
						]
						}
					]
				}
				// APIへ
				$data ={
					url: "https://vision.googleapis.com/v1/images:annotate?key=AIzaSyDsJ6Gbmaww6_7zhh8Ttqga5o3dUzQV3lw",
					type: 'POST',
					data:JSON.stringify(data),
					contentType: 'application/json',
					dataType: "json",
					processData: false
				};
				// 返却データ成形 & 返却後フロント処理
				callFrontAjax($data, function(data){
					console.log(data);
					// overlay非表示
					$.loading_end();
					//console.log(JSON.stringify(data));
					var array = new Array();
					$("#res").empty();
					var ano = data["responses"][0]["textAnnotations"];
					if(ano.length > 1){
						for(var n=1;n<ano.length;n++){
							var x = ano[n].boundingPoly.vertices[0].x;
							var y = ano[n].boundingPoly.vertices[0].y;
							var centerY = y+(ano[n].boundingPoly.vertices[3].y-ano[n].boundingPoly.vertices[0].y)/2+x/10;
							var text = ano[n].description;
							array.push([x,y,text,ano[n].boundingPoly,centerY]);
						}
					}

					if(array.length > 0){
						array.sort(function(a,b){
							
							return a[4]-b[4];
							//return a[1]-b[1];
						});

						var texts = [];

						var oldY = -1;
						var threshold = 10;
						var temp = new Array();
						var res = new Array();

						var throwList = ["-","ー",".",",",":"]; 

						for(var n=0;n<array.length;n++){
							threshold = (array[n][3].vertices[3].y-array[n][3].vertices[0].y)/2*1.4;
							
							var x = array[n][0];
							var y = array[n][3].vertices[0].y+(array[n][3].vertices[3].y-array[n][3].vertices[0].y)/2;//-threshold;

							/*if(array[n][2] == "-"){
								console.log("y:"+y+",oldY"+oldY+"th:"+threshold);
								console.log((oldY-threshold)+" <= "+y+" <= "+oldY+threshold);
							}*/

							if(oldY == -1 || throwList.indexOf(array[n][2]) > -1/*array[n][2] == "-" || array[n][2] == "."*/){
								oldY = y;
							}
							else if(oldY-threshold <= y && y <= oldY+threshold){
								oldY = y;
							}
							else{
								oldY = -1;
								temp.sort(function(a,b){
									return a[0]-b[0];
								});
								var text = "";
								for(var i=0;i<temp.length;i++){
									if(i != 0){
										var thx = (temp[i][3].vertices[1].x-temp[i][3].vertices[0].x);

										//console.log((temp[i-1][3].vertices[1].x+thx)+" > "+temp[i][3].vertices[1].x);
										//console.log(throwList.indexOf(temp[i][2]));
										if(throwList.indexOf(temp[i][2]) != -1 && temp[i-1][3].vertices[1].x+thx > temp[i][3].vertices[1].x){
											text += " 　 　";
										}
									}
									//console.log(temp[i][2]);
									text += temp[i][2];
								}
								res.push(temp);
								texts.push(text);
								temp = [];
							}
							temp.push(array[n]);
							
						}
						temp.sort(function(a,b){
							return a[0]-b[0];
						});
						var text = "";
						for(var n=0;n<temp.length;n++){
							text += temp[n][2];
						}
						res.push(temp);

					}
					console.log(res);

					var itemIndex = new Array();
					var params = ["","","","",""];
					var itemListC = itemList

					for(var n=0;n<texts.length;n++){
						//$("#res").append("<p>"+texts[n]+"</p>");

						for(var i=0;i<itemListC.length;i++){
							for(var m=0;m<itemListC[i].length;m++){
								var flag = false
								var res = texts[n].indexOf(itemListC[i][m]);

								if(res != -1){
									var ary = Array();
									ary.push([itemListC[i][m]]);
									for(var k=n;k<n+2;k++){
										for(var j=0;j<searchCnt.length;j++){
											//console.log(texts[k].replace(/[oO]/g, '0').replace(/[ 　]/g, ''));
											var res = searchCnt[j].exec(texts[k].replace(/[oOO]/g, '0').replace(/[ 　]/g, ''));
											if(res != null){
												//var ary = Array();
												//ary.push([itemListC[i][m]]);
												ary.push(/\d{1,3}.\d{2}/.exec(texts[k].replace(/[oOO]/g, '0').replace(/[ 　]/g, ''))[0]);
												//items.push(ary);
												flag = true;
												break;
											}
										}
										if(flag)break;
									}
									if(!flag)ary.push("");
									items.push(ary);
								}
								if(flag)break;
							}
						}

						for(var i=0;i<searchList.length;i++){
							var res = searchList[i][0].exec(texts[n]);
							if(res != null){
								console.log("res:"+res);
								if(i == 3){
									params[i] = /\d{2,6}-\d{2,6}/.exec(texts[n])[0];
								} 
								else if(i == 4){
									var num = /\d{0,3},\d{3}/.exec(texts[n])[0];
									params[i] = num.replace(/,/g,'');
									
								}
								else{
									params[i] = res[0];
								}
								//$("#res").append("<p>"+searchList[i][1]+":"+res+"</p>");
							}
						}
						
						var ng_search = texts.join("");
						$.each(ngList, function(index, value) {
							var ngword = value;
							if ( ng_search.indexOf(ngword) != -1) {
								// ["SS控","SSEえ","サイン","取消","仕入","実在庫"
								if(ngword == 'SS控') {
									ng1 = true;
								} else if(ngword == 'SSEえ') {
									ng1 = true;
								} else if(ngword == 'サイン') {
									ng2 = true;
								} else if(ngword == '取消') {
									ng3 = true;
								} else if(ngword == '仕入') {
									ng4 = true;
								} else if(ngword == '実在庫') {
									ng5 = true;
								}
								isNg = true;
								// alert('対象外のレシートです。');
							}
						})
						$.each(light_ngList, function(index, value) {
							var ngword = value;
							if ( ng_search.indexOf(ngword) != -1) {
								isLightNg = true;
							}
						})
					}

					
					

					var $res = $("<div id='debug' style='display:none;'><p>↓↓↓デバッグ↓↓↓</p></div>")
					$("#snap_ok").append($res);

					if(items.length > 0){
						for(var n=0;n<items.length;n++){
							$res.append("<p>"+items[n][0]+"aa:"+items[n][1]+"</p>");
							if(items[n][1] != ""){
								re_oil = items[n][1];
								base_oil = items[n][1];
								re_oil = re_oil.replace(/\s+/g, "");
								re_oil = re_oil.replace(/,/g, '.');
								$("#res_input").val(re_oil);
								var po = Math.floor(re_oil/2);
								re_point = po;
								$("#get_point").html('<span class="point_input">'+po+'</span>' + ' pts');
								var value_array = base_oil.toString().split('.');
								var len = value_array[1].length;
								if(len == 2) {
									len_ng = false;
								} else {
									len_ng = true;
								}
							}
						}
						/*$("#res_input").val(items[0][1]);

						var po = Math.floor(items[0][1]/25);
						re_point = po;
						re_oil = items[0][1];
						$("#get_point").html('<span class="point_input">'+po+'</span>' + ' pts');*/
						
					}
					
					$res.append("</br>isAccept："+isAcceptAll+"</br>term："+term+"<br>");

					for(var i=0;i<params.length;i++){
						$res.append("<p>"+searchList[i][1]+":"+params[i]+"</p>");
					}

					$res.append("</br></br>");


					str = "";
					for(var n=0;n<texts.length;n++){
						$res.append("<p>"+texts[n]+"</p>");
						str += texts[n];
					}

					tel = params[0];
					pay_date = params[1];//+" "+params[2];
					time = params[2];
					no = params[3];
					total = params[4];///\d{0,3},\d{3}/.exec(params[4]).replace(/,/g,'');

					checkStatus()

					// 会社名 #debug p
					$('#debug p').each(function(){
						var target = $(this).html();
						if (target.indexOf("会社") >= 0) {
							com = $(this).html();
							$('#com').val(com);
						}
						if (target.indexOf("㈱") >= 0) {
							com = $(this).html();
							$('#com').val(com);
						}
						if (target.indexOf("(株)") >= 0) {
							com = $(this).html();
							$('#com').val(com);
						}
					});

					//$("#res").append("<p>"+JSON.stringify(data)+"</p>");
				});
			});

            $("#camImage").attr("src",reader.result);
			$("#image_area").show();

			
        }
        reader.readAsDataURL(file);
    }

	// リサイズ
	function image2base64(img,isResize){

		var image = new Image();
		image.src = $(img).attr("src");
		var maxWidth = 3024.0;
		var maxHeight = 4032.0;
		//maxWidth /= 2;
		//maxHeight /= 2;
		var width,height;
				
		if(isResize && (image.width > maxWidth || image.height > maxHeight)){
			var ratio = image.width/image.height;
			if(image.width-maxWidth > image.height-maxHeight){
				width = maxWidth;
				height = maxWidth/ratio;
			}
			else{
				width = maxHeight*ratio;
				height = maxHeight;
			}
		}
		else{
			width = image.width;
			height = image.height;
		}
			
		var canvas = document.getElementById("resize_canvas");
		canvas.width = width;
		canvas.height = height;
		var context = canvas.getContext("2d");
		context.clearRect(0,0,width,height);
		context.drawImage(image,0,0,image.width,image.height,0,0,width,height);

		/*var imgData = context.getImageData(0,0,image.width,image.height);

		var data = imgData.data;
			
		var rRate=0.34;
		var gRate=0.33;
		var bRate=0.33;
		
		for(var n=0,len=imgData.width*imgData.height;n<len;n++){
			var r=data[n*4];
    		var g=data[n*4+1];
        	var b=data[n*4+2];        		
        		
        	data[n*4]=Math.round(rRate*r+gRate*g+bRate*b);
    		data[n*4+1]=Math.round(rRate*r+gRate*g+bRate*b);
    		data[n*4+2]=Math.round(rRate*r+gRate*g+bRate*b);
        }

		context.clearRect(0,0,width,height);
		context.putImageData(imgData,0,0);*/

		var base64 = canvas.toDataURL("image/jpeg", 0.5);
		return base64;


		/*var barr, bin, i, len;
		bin = atob(base64.split('base64,')[1]);
		len = bin.length;
		barr = new Uint8Array(len);
		i = 0;
		while (i < len) {
			barr[i] = bin.charCodeAt(i);
			i++;
		}
		blob = new Blob([barr], {type: "image/jpeg"});
		return blob;*/
	}

	// リサイズ
	function image2blob(img,isResize){

		var image = new Image();
		image.src = $(img).attr("src");
		var maxWidth = 3024.0/4;
		var maxHeight = 4032.0/4;
		//maxWidth /= 2;
		//maxHeight /= 2;

		var width,height;
				
		if(isResize && (image.width > maxWidth || image.height > maxHeight)){
			var ratio = image.width/image.height;
			if(image.width-maxWidth > image.height-maxHeight){
				width = maxWidth;
				height = maxWidth/ratio;
			}
			else{
				width = maxHeight*ratio;
				height = maxHeight;
			}
		}
		else{
			width = image.width;
			height = image.height;
		}
			

		var canvas = document.getElementById("resize_canvas");
		canvas.width = width;
		canvas.height = height;
		var context = canvas.getContext("2d");
		context.clearRect(0,0,width,height);
		context.drawImage(image,0,0,image.width,image.height,0,0,width,height);

		var imgData = context.getImageData(0,0,image.width,image.height);

		var data = imgData.data;
			
		var rRate=0.34;
		var gRate=0.33;
		var bRate=0.33;
		
		for(var n=0,len=imgData.width*imgData.height;n<len;n++){
			var r=data[n*4];
    		var g=data[n*4+1];
        	var b=data[n*4+2];        		
        		
        	data[n*4]=Math.round(rRate*r+gRate*g+bRate*b);
    		data[n*4+1]=Math.round(rRate*r+gRate*g+bRate*b);
    		data[n*4+2]=Math.round(rRate*r+gRate*g+bRate*b);
        }

		context.clearRect(0,0,width,height);
		context.putImageData(imgData,0,0);

		var base64 = canvas.toDataURL("image/jpeg", 0.5);

		var barr, bin, i, len;
		bin = atob(base64.split('base64,')[1]);
		len = bin.length;
		barr = new Uint8Array(len);
		i = 0;
		while (i < len) {
			barr[i] = bin.charCodeAt(i);
			i++;
		}
		blob = new Blob([barr], {type: "image/jpeg"});
		return blob;
	}

	// Ajax
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
    }

}());













