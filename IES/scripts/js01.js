// JavaScript Document
$(document).ready(function() {
	$('#mail_list .subjects').bind('mousemove',function(e1) {
		var id=$(this).attr("id");
		var cssObj={
					'position':'absolute',
					'left':(e1.pageX+10),
					'top':(e1.pageY+15),
					'visibility':'visible',
					'font-family':'verdana',
					'font-size':'12px',
					'font-weight':'bold',
					'color':'#fff',
					'background-color':'#000',
					//'height':'200px',
					'width':'300px',
					'max-height':'300px',
					'overflow':'hidden'
		}
		$.post("./getdata.php",{msgid: id }, function(data) {
   			$('#mail_content').html(data);
		});
		$('#mail_content').css(cssObj);
	}).mouseout(function(){
		var cssObj2={
					'visibility':'hidden'
		}
		$('#mail_content').css(cssObj2);
	});
	$('input[name=uid]').focusin(function(){
		var cssObj={
					'text-align':'center',
					'visibility': 'visible',
					'font-size':'14px',
					'width':'98%',
					//'background-color':'#ddd',
					'margin':'0 0 20px 0',
					'padding':'2px',
					//'margin-top':'40px'
		}
		//alert("hello");
		$('.avail').css(cssObj);
		$(this).keyup(function(e){
			$.post('./getdata.php',{'checkfor': $(this).val()},function(data){
				$('.avail').html(data);
			});
		});
	}).focusout(function(){
		var cssObj2={
					'visibility': 'hidden'
		}
		$('.avail').css(cssObj2);
	});
});