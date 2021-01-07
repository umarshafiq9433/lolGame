	//Livechat
	$(function(){
		$(document).on('submit','#chat', function(){
			var message = $.trim($("#message").val());
			document.getElementById('message').value = "";

			if(message != "")
			{
				$.ajax({
					type: 'POST',
					data: '&message=' + message,
					url: '../assets/class/ChatPoster.php',
					success: function(data)
					{
					}
				});
			}else{
				alert("Enter a message");
			}
		});

		function getMessages(){
			$.get('../assets/class/getMessages.php', function(data) {
				$("#messages").html(data);
			});
		}

		setInterval(function() {
			getMessages();
		},5000);
	});