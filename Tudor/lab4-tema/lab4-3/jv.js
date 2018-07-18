$(document).ready(function() {
    var app = {
        cards: [1, 1, 2, 2, 3, 3, 4, 4, 5, 5, 6, 6],
        init: function() {
            app.assignCards();
        },

        assignCards: function() {
            $('.card').each(function(index) {
                $(this).attr('data-card-value', app.cards[index]);
            });
            app.clickHandlers();
        },
        clickHandlers: function() {
            $('.card').on('click', function() {
                $(this).html('<p>' + $(this).data('cardValue') + '</p>').addClass('selected');
                app.checkMatch();
            });
        },
        checkMatch: function() {
            if ($('.selected').length === 2) {
                if ($('.selected').first().data('cardValue') == $('.selected').last().data('cardValue')) {
                    $('.selected').each(function() {
                        $(this).animate({
                            opacity: 0
                        }).removeClass('unmatched');
                    });
                    $('.selected').each(function() {
                        $(this).removeClass('selected');
                    });
                    app.checkWin();
                } else {
                    setTimeout(function() {
                        $('.selected').each(function() {
                            $(this).html('').removeClass('selected');
                        });
                    }, 1000);
                }
            }
        },
    };
    app.init();
});