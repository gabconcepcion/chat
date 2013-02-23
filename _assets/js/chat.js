var oChat = {

	_hasPendingRequest:false,

	init: function(oConfig)
	{
		this.url = oConfig.url;
		this.messageElem = $('#'+oConfig.messageElem);
		this.nameElem = $('#'+oConfig.nameElem);
		this.btn = $('#'+oConfig.btn);

		this.btn.click(this.sendChat);
		this.observe();
	},

	sendChat: function()
	{
		$.ajax({
		   url: oChat.url,
		   type: "POST",
		   async:true,
		   data: {
		      message: oChat.messageElem.val(),
		      name: oChat.nameElem.val()
		   },
		   success: oChat.onObserveSuccess
		});
	},

	onObserveSuccess: function(oResult)
	{
		for(var i in m = oResult)
			if($('#chatId'+m[i].id).length==0)
				$('#message_log').append(
					'<div id="chatId'+m[i].id+'">'+
					m[i].name+': '+m[i].msg+' ('+m[i].mdate+')'+
					'</div>'
				);
		oChat._hasPendingRequest = false;
		oChat.observe();
	},

	observe: function()
	{
		if(!oChat._hasPendingRequest)
		{
			oChat._hasPendingRequest = true;
			$.ajax({
			   url: oChat.url,
			   type: "POST",
		   	   async:true,
			   data: {},
		   		success: oChat.onObserveSuccess
			});
		}
	}
};

(function(){
	oChat.init({
		url: 'http://localhost/chat/ajax-send-message',
		messageElem: 'chat_message',
		nameElem:'chat_name',
		btn: 'btnSend'
	});
})();