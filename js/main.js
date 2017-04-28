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
