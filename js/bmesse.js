"use strict"

$(document).ready(function(){
	var charDom = [];
	var p = function(dom){
		chatDom.push(dom);
	}
	// Container
	p('<div id="bms_messages_container">');
		// Header
		p('<div id="bms_chat_header">');
			p('<div id="bms_chat_user_status">');
				p('<div id="bms_status_icon">●</div>')
				p('<div id="bms_chat_user_name">user</div>');
			p('</div>');
		p('</div>');
		// TimeLine
		p('<div id="bms_messages">');
			// Message(left hand side)
			p('<div class="bms_message bms_left">');
				p('<div class="bms_message_box">');
					p('<div class="bms_message_content">');
						p('<div class="bms_message_text">ほうほうこりゃー便利じゃないか</div>');
					p('</div>');
				p('</div>');
			p('</div>');
			p('<div class="bms_clear"></div>');
			// Message(right hand side)
			p('<div class="bms_message bms_right">');
				p('<div class="bms_message_box">');
					p('<div class="bms_message_content">');
						p('<div class="bms_message_text">うん、まあまあいけとるな</div>');
					p ('</div>');
				p('</div>');
			p('</div>');
			p('<div class="bms_clear"></div>');
		p('</div>');
		// TextBox, SendButton
		p('<div id="bms_send">');
			p('<textarea id="bms_send_message"></textarea>');
			p('<div id="bms_send_btn">Send</div>');
		p('</div>');

		$('#your_container').append(chatDom.join(''));
})