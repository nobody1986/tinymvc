// refresh money
function refreshMoney() {
    $.post('/ajax/money', function(data) {
        $('#money').html(data);
    });
}

var moveEnd = function(obj){
	obj.focus();
	var len = obj.value.length;
	if (document.selection) {
		var sel = obj.createTextRange();
		sel.moveStart('character',len);
		sel.collapse();
		sel.select();
	} else if (typeof obj.selectionStart == 'number' && typeof obj.selectionEnd == 'number') {
		obj.selectionStart = obj.selectionEnd = len;
	}
}

// reply a reply
function replyOne(username){
    replyContent = $("#reply_content");
	oldContent = replyContent.val();
	prefix = "@" + username + " ";
	newContent = ''
	if(oldContent.length > 0){
	    if (oldContent != prefix) {
	        newContent = oldContent + "\n" + prefix;
	    }
	} else {
	    newContent = prefix
	}
	replyContent.focus();
	replyContent.val(newContent);
	moveEnd($("#reply_content"));
}

// send a thank to reply
function thankReply(replyId, token) {
    $.post('/thank/reply/' + replyId + "?t=" + token, function() {
        $('#thank_area_' + replyId).addClass("thanked").html("感谢已发送");
        refreshMoney();
    });
}

// send a thank to topic
function thankTopic(topicId, token) {
    $.post('/thank/topic/' + topicId + "?t=" + token, function(data) {
        $('#topic_thank').html('<span class="f11 gray" style="text-shadow: 0px 1px 0px #fff;">感谢已发送</span>');
        refreshMoney();
    });
}

// for GA
function recordOutboundLink(link, category, action) {
    try {
        var pageTracker=_gat._getTracker("UA-11940834-2");
        pageTracker._trackEvent(category, action);
        // setTimeout('document.location = "' + link.href + '"', 100)
    } catch(err) {}
}


