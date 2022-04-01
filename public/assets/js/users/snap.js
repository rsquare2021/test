(function(){
	//////////////////////////////////////////////////////////////////////
	// ユーザーエージェント
	//////////////////////////////////////////////////////////////////////
	const ua = navigator.userAgent;
    if ((ua.indexOf('iPhone') > -1 || (ua.indexOf('Android') > -1 && ua.indexOf('Mobile') > -1)) || (ua.indexOf('iPad') > -1 || ua.indexOf('Android') > -1)) {
        // スマートフォン&タブレット
    } else {
    }
	//////////////////////////////////////////////////////////////////////
	// 変数セット
	//////////////////////////////////////////////////////////////////////
	var campaign_id = $("#cam_id").val(); //キャンペーンID
	var str = ""; //レシート文字
	var tel = ""; //電話番号
	var no = ""; //レシートNo
	var pay_date = ""; //発行日
	var time = ""; //発行時間
	var shopNg = 0; //特定店舗
	var isDouble = 0; //重複
	var term = 0; //期間
	var re_oil = ''; //入力した数量
	var base_oil = ''; //レシート数量
	var len_ng = 0; //文字数チェック
	var com = ''; //会社名
	var isAcceptAll = 0; //撮り直し
	var items = Array(); //商品配列
	var isMulti = 0; //同じ商品名が複数
	var ocr_lists = $('#ocr_lists').val();
	ocr_lists = ocr_lists.split(',');

	//////////////////////////////////////////////////////////////////////
	// 関数
	//////////////////////////////////////////////////////////////////////
	$.extend({
		//////////////////////////////////////////////////////////////////////
		// エラーリダイレクト
		attention: function (data) {
			var campaign = $("#cam_id").val();
			window.location.href = '/'+campaign+'/dashboard/snap/error/';
		},
		//////////////////////////////////////////////////////////////////////
		// 送信完了
		sendComplete: function (data) {
			var campaign = $("#cam_id").val();
			window.location.href = '/'+campaign+'/dashboard/snap/complete/';
		},
		//////////////////////////////////////////////////////////////////////
		// ローディング開始
		loading_start: function () {
			$('.loading').show();
			$('body').addClass('overflow_hidden');
		},
		//////////////////////////////////////////////////////////////////////
		// ローディング終了
		loading_end: function () {
			$('.loading').hide();
			$('body').removeClass('overflow_hidden');
		},
		//////////////////////////////////////////////////////////////////////
		// inputに追加（通常とNGワード共通の値）
		input_values: function () {
			var val = $("#res_input").val();
			var itemsStr = "";
			tel = tel.replace(/-/g, '');
			tel = tel.replace(/-/g, '');
			if(items.length > 0){
				for(var n=0;n<items.length;n++){
					if(n != 0){
						itemsStr += "&I";
					}
					itemsStr += items[n][0]+"&C"+items[n][1];
				}
			}
			$('input[name="str"]').val(str);
			$('input[name="tel"]').val(tel);
			$('input[name="no"]').val(no);
			$('input[name="pay_date"]').val(pay_date);
			$('input[name="time"]').val(time);
			$('input[name="point"]').val(re_point);
			$('input[name="val"]').val(val);
			$('input[name="base_oil"]').val(base_oil);
			$('input[name="products"]').val(itemsStr);
			$('input[name="shopNg"]').val(shopNg);
			$('input[name="com"]').val(com);
			$('input[name="isDouble"]').val(isDouble);
			$('input[name="isMulti"]').val(isMulti);
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
		shopNg = 0;
		items = Array();
		isAcceptAll = 0;
		isDouble = 0;
		isMulti = 0;
	}
	//////////////////////////////////////////////////////////////////////
	// チェック
	//////////////////////////////////////////////////////////////////////
	function checkStatus(){
		$('a.blue_btn.mt-3').hide();
		$('#footer_menu').hide();
		//return
		if(isAcceptAll == 1){
			$("#snap_ok").show();
			return
		}
		//////////////////////////////////////////////////////////////////////
		// 送信前処理
		tel = tel.replace(/-/g, '');
		tel = tel.replace(/-/g, '');
		pay_date = pay_date.replace(/[年月]/g, '-').replace("日","");
		pay_date = pay_date.slice( 0, 10 );
		time = time.replace(/\s+/g, "");
		var dateInt = pay_date.replace(/[^0-9]/g, '')-0;
		var re_value = $('#res_input').val();
		var re_point = $('.point_input').html();
		dateInt = parseInt(dateInt);
		$data ={
			url: '/'+campaign_id+'/dashboard/snap/before_post_receipt',
			type: 'POST',
			data:{
				pay_date: pay_date,
				tel: tel,
				time: time,
				re_value: re_value,
				dateInt: dateInt,
				items: items,
				re_value: re_value,
				re_point: re_point,
				len_ng: len_ng,
				str: str,
			},
			dataType:'json',
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
		};
		callFrontAjax($data, firstCheck);

		// 共通input
		$.input_values();
		function firstCheck(data){
			$.loading_end();
			if(data.result == false) {
				if(data.ng == 'ng') {
					alert('本キャンペーン対象外のレシートのため、申し訳ありませんが読み取りできません。 (81)');
					$.attention();
				}else if(data.double == 'other') {
					$('input[name="isDouble"]').val(1);
					alert(data.alert);
					isAcceptAll = 1;
					$(".camera_link").val("このまま送信");
					$("#snap_error").show();
					$("#snap_ok").show();
					return
				} else {
					alert(data.alert);
					$.attention();
				}
			} else if(data.result == true && data.shop == 'illegal') {
				$.loading_end();
				$('input[name="shopNg"]').val(1);
				$("#snap_ok").show();
			}else if(data.result == true) {
				$.loading_end();
				$("#snap_ok").show();
			}
		}
	}

	//////////////////////////////////////////////////////////////////////
	// 送信ボタン
	//////////////////////////////////////////////////////////////////////
	$("#sendBtn").on("click",function(){
		$.loading_start();
		//////////////////////////////////////////////////////////////////////
		// 送信データ成形
		var blob = image2blob($("#camImage").get(),true);
		var data = new FormData();
		data.append("image", blob);
		data.append('str',$('input[name="str"]').val());
		data.append('tel',$('input[name="tel"]').val());
		data.append('no',$('input[name="no"]').val());
		data.append('pay_date',$('input[name="pay_date"]').val());
		data.append('time',$('input[name="time"]').val());
		data.append('point',$('input[name="point"]').val());
		data.append('val',$('input[name="val"]').val());
		data.append('base_oil',$('input[name="base_oil"]').val());
		data.append('products',$('input[name="products"]').val());
		data.append('shopNg',$('input[name="shopNg"]').val());
		data.append('com',$('input[name="com"]').val());
		data.append('isDouble',$('input[name="isDouble"]').val());
		data.append('isMulti',$('input[name="isMulti"]').val());
		//////////////////////////////////////////////////////////////////////
		// Ajax post
		$data ={
			url: '/'+campaign_id+'/dashboard/snap/post_receipt',
			type: 'POST',
			data: data,
			contentType: false,
			processData: false,
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
		};
		callFrontAjax($data, function(data){
			$.loading_end();
			if(data.result == true) {
				$.sendComplete();
			} else {
				$.attention();
			}
		});
	});

	//////////////////////////////////////////////////////////////////////
	// 照合対照の変数セット
	//////////////////////////////////////////////////////////////////////
	var searchList = [
						[/\d{2,5}-\d{1,4}-\d{4}/gi,"tel"],
						[/(20\d{2})年(\d{2})月(\d{2})./,"日付"],
						[/(\d{2}):(\d{2})/,"時間"],
						[/レシートN[O0o]\d{2,6}-\d{2,6}/,"レシートNo"],
						[/合計[¥羊张]\d{0,3},\d{3}/,"合計金額"],
						[/(20\d{2})-(\d{2})-(\d{2})./,"日付"],
					];
	var searchCnt = [/\d{1,3}.\d{2}[L]/]

	$("#image_area").hide();

	// 撮り直し場合
	$("#re_fileInput").change(function(e){
		reset();
        sendImage(this);
    });

	//エラーによる取り直し
	$("#error_fileInput").change(function(e){
		reset();
		isAcceptAll = 1;
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
							"type":"TEXT_DETECTION",
							"maxResults":3
							}
						]
						}
					]
				}
				// APIへ
				$data ={
					url: "https://vision.googleapis.com/v1/images:annotate?key=AIzaSyB2dmlvYZtnRK3FE_egOD-VSQHLNsUH9kU",
					type: 'POST',
					data:JSON.stringify(data),
					contentType: 'application/json',
					dataType: "json",
					processData: false
				};
				// 返却データ成形 & 返却後フロント処理
				callFrontAjax($data, function(data){
					console.log(data);
					var array = new Array();
					$("#res").empty();
					var ano = data["responses"][0]["textAnnotations"];
					if(ano == undefined) {
						alert('必要な情報が読み取れません。\nお手数ですが、再撮影してください。 (00)');
						$.attention();
					}
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
										if(throwList.indexOf(temp[i][2]) != -1 && temp[i-1][3].vertices[1].x+thx > temp[i][3].vertices[1].x){
											text += " 　 　";
										}
									}
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
					var itemList = [ocr_lists,];
					var params = ["","","","",""];
					var itemListC = itemList;

					for(var n=0;n<texts.length;n++){
						for(var i=0;i<itemListC.length;i++){
							for(var m=0;m<itemListC[i].length;m++){
								var flag = false
								var res = texts[n].indexOf(itemListC[i][m]);

								if(res != -1){
									var ary = Array();
									ary.push([itemListC[i][m]]);
									for(var k=n;k<n+2;k++){
										for(var j=0;j<searchCnt.length;j++){
											var res = searchCnt[j].exec(texts[k].replace(/[oOO]/g, '0').replace(/[ 　]/g, ''));
											if(res != null){
												ary.push(/\d{1,3}.\d{2}/.exec(texts[k].replace(/[oOO]/g, '0').replace(/[ 　]/g, ''))[0]);
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

                        var desc = ano[0]["description"];
                        for(var i=0;i<searchList.length;i++){
                            var res = searchList[i][0].exec(desc);
                            if(res != null){
                                if(i == 3){
                                    params[i] = /\d{2,6}-\d{2,6}/.exec(desc)[0];
                                }
                                else if(i == 4){
                                    var num = /\d{0,3},\d{3}/.exec(desc)[0];
                                    params[i] = num.replace(/,/g,'');
                                }
                                else{
                                    params[i] = res[0];
                                }
                            }
                        }
					}

					var $res = $("<div id='debug' style='display:none;'><p>↓↓↓デバッグ↓↓↓</p></div>")
					$("#snap_ok").append($res);

					tel = params[0];
					if(params[1]) {
						pay_date = params[1];
					} else if(params[5]) {
						pay_date = params[5];
					}

					// 例外店舗処理
					$('input[name="level1_lists"]').each(function(){
						re_tel = tel;
						re_tel = re_tel.replace(/-/g, '');
						re_tel = re_tel.replace(/-/g, '');
						var target_tel = $(this).attr('id');
						var target_value = $(this).val();
						target_value = target_value.split(',');
						if(re_tel == target_tel) {
							itemList = [target_value,];
						} else {
							itemList = [ocr_lists,];
						}
					});

					if(items.length > 0){
						for(var n=0;n<items.length;n++){
							$res.append("<p>"+items[n][0]+"aa:"+items[n][1]+"</p>");
							if(items[n][1] != ""){
								re_oil = items[n][1];
								base_oil = items[n][1];
								re_oil = re_oil.replace(/\s+/g, "");
								re_oil = re_oil.replace(/,/g, '.');
								$("#res_input").val(re_oil);
								var po = Math.floor(re_oil/25);
								re_point = po;
								$("#get_point").html('<span class="point_input">'+po+'</span>' + ' pts');
								var value_array = base_oil.toString().split('.');
								if(value_array[1]) {
									var len = value_array[1].length;
									if(len == 2) {
										len_ng = 0;
									} else {
										len_ng = 1;
									}
								}
							}
						}
						
					}

					if(itemList.length > 0){
						for(var n=0;n<itemList.length;n++){
							if(itemList[n].length > 0){
								for(var i=0;i<itemList[n].length;i++){
									var count = (desc.match(new RegExp(itemList[n][i], "g")) || [] ).length;
									if(count > 1){
										isMulti = 1;
									}
									console.log("count:"+count)
								}
							}
						}
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
					
					time = params[2];
					no = params[3];
					total = params[4];///\d{0,3},\d{3}/.exec(params[4]).replace(/,/g,'');

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

					checkStatus()

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

		var base64 = canvas.toDataURL("image/jpeg", 0.5);
		return base64;

	}

	// リサイズ
	function image2blob(img,isResize){

		var image = new Image();
		image.src = $(img).attr("src");
		var maxWidth = 3024.0/4;
		var maxHeight = 4032.0/4;
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

		var base64 = canvas.toDataURL("image/jpeg", 0.3);

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
                .always( function(data) {
        });
    }

}());













