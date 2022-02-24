window.addEventListener('beforeunload', function(e) {
		$.ajax({
			url:'c.php',
			data:{chat:$('#chatbox').val(),ajaxleave:true},
			method:'post',
			success:function(data){
				$('#result').html(data); // Get the chat records and add it to result div
				$('#chatbox').val(''); //Clear chat box after successful submition
				document.getElementById('result').scrollTop=document.getElementById('result').scrollHeight; // Bring the scrollbar to bottom of the chat resultbox in case of long chatbox
			}
		})
});
// Javascript function to submit new chat entered by user
function strip_tags(str, allow){
 // making sure the allow arg is a string containing only tags in lowercase (<a><b><c>)
 allow = (((allow || '') + '').toLowerCase().match(/<[a-z][a-z0-9]*>/g) || []).join('');

 var tags = /<\/?([a-z][a-z0-9]*)\b[^>]*>/gi;
 var commentsAndPhpTags = /<!--[\s\S]*?-->|<\?(?:php)?[\s\S]*?\?>/gi;
 return str.replace(commentsAndPhpTags, '').replace(tags, function ($0, $1) {
 return allow.indexOf('<' + $1.toLowerCase() + '>') > -1 ? $0 :'';
 });
}
function submitchat(){
		if($('#chat').val()=='' || $('#chatbox').val()==' ') return false;
		$.ajax({
			url:'c.php',
			data:{chat:$('#chatbox').val(),ajaxsend:true},
			method:'post',
			success:function(data){
				$('#result').html(data); // Get the chat records and add it to result div
				$('#chatbox').val(''); //Clear chat box after successful submition
				document.getElementById('result').scrollTop=document.getElementById('result').scrollHeight; // Bring the scrollbar to bottom of the chat resultbox in case of long chatbox
			}
		})
		return false;
};

// Function to continously check the some has submitted any new chat
function check() {
    $.ajax({
        url:'c.php',
        data:{ajaxget:true},
        method:'post',
        success:function(data){
            $('#result').html(data);
            setTimeout(check, 500);
        }
    });
}

check();

// Online
function ocheck() {
    $.ajax({
        url:'c.php',
        data:{ajaxonline:true},
        method:'post',
        success:function(data){
            $('#online').html(data);
            setTimeout(ocheck, 500);
        }
    });
}

ocheck();
// Function to chat history
$(document).ready(function(){
	$('#clear').click(function(){
		if(!confirm('Are you sure you want to clear chat?'))
			return false;
		$.ajax({
			url:'c.php',
			data:{username:"<?php echo $_SESSION['username'] ?>",ajaxclear:true},
			method:'post',
			success:function(data){
				$('#result').html(data);
			}
		})
	})
})
//Joined?
$.ajax({
	url:'c.php',
	data:{username:"<?php echo $_SESSION['username'] ?>",ajaxjoin:true},
	method:'post',
	success:function(data){
                $('#result').html(data);
	}
})
