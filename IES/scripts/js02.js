// JavaScript Document
$(document).ready(function() {
	$('#mail_list a').bind('mousemove',function(e1) {
		$('#mail_content').removeProp('style');
		var cssObj={
					'position':'absolute',
					'left':(e1.pageX+10),
					'top':(e1.pageY+15),
					'visibility':'visible',
					'background-color':'#d1d1fa',
					'height':'200px',
					'width':'200px',
					'overflow':'hidden'
		}
		$('#mail_content').css(cssObj);
		$.post("../test/new3.php", function(data) {
   			$('#mail_content').text(data);
		});
	}).mouseout(function(){
		var cssObj2={
					'visibility':'hidden'
		}
		$('#mail_content').css(cssObj2);
	});
});