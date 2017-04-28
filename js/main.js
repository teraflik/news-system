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

(function() {
    $('.submit-comment').on('click', function() {
        var commentval = $("#commentBox").val();
        $.ajax({
            type: "POST",
            url: 'view.php?id=' + $(this).data('id'),
            data: commentVal,
            success: function(html) {
                alert("Success!");
                var htmlData = html;
                $('#newsModal').close();
                $('<div class="modal fade" id="#newsModal">' + htmlData + '</div>').modal();
            }
        });
    });
})(jQuery);

$(document).ready(function() {
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
