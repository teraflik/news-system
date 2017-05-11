(function() {
	$('.modal-toggle').on('click', function() {
		$.ajax({
			type: "GET",
			url: 'view.php?id=' + $(this).data('id'),
			dataType: 'html',
			success: function(data) {
				var htmlData = data;
				$('<div class="modal fade" id="#newsModal">' + htmlData + '</div>').modal();
			}
		});
	});
})(jQuery);

$(document).on("click", "#submit-comment", function() {
	console.log('do something');
	var commentval = $("#commentBox").val();
	if (!commentval.trim()) {

	} else {
		var url = 'comment.php?id=' + $(this).data('newsid');
		$('#commentBox').val('');
		$.post(url, { comment: commentval },
			function(data) {
				$(".commentclass").append(data);
			});
		var num = $('.fa-comment').val();
		num = parseInt(num);
		num = num+1;
		console.log('num:' + num);
		$('.fa-comment').val(' '+num);
	}
});

$(document).ready(function() {
	$('.right-corder-container-button').click(function() {
		$('.fa-refresh').addClass('spinclass');
		$('.long-text').text("Refreshing...");
		$.ajax({
			type: "POST",
			url: "index.php",
			data: { action: "refresh" }
		}).done(function(msg) {
			location.reload();
		});

});
	$(".right-corder-container-button").hover(function() {
		$(".long-text").addClass("show-long-text");
	}, function() {
		$(".long-text").removeClass("show-long-text");
	});

	$('.favourite').click(function() {
		var button = $(this).children('i');
		if (button.hasClass('fa-star-o')) {
			//button is unpressed
			$.post("favourites.php", { newsid: $(this).data('newsid'), action: "add" },
				function(data) {
					button.removeClass('fa-star-o').addClass('fa-star');
				}
			);
		} else {
			//button is pressed, toggle it back
			$.post("favourites.php", { newsid: $(this).data('newsid'), action: "remove" },
				function(data) {
					button.removeClass('fa-star').addClass('fa-star-o');
				}
			);
		}
	});
});
