;(function($, window, document, undefined) {
    'use strict';

    var $win             = $(window);
    var $doc             = $(document);
    var $html            = $(document.documentElement);
    var $nav             = $('#nav');
    var poppedBalloons   = [];
    var activeCurrency   = window.activeCurrency ? window.activeCurrency : 'usd';
    var currencyOptions  = window.currencyOptions ? window.currencyOptions : {};

    /**
     * Sets visibility classes to buttons in the
     * header based on a container's attributes
     *
     * @param  {Object} $container      DOM Element
     * @return {Void}
     */
    function setVisibilityStates($container) {
        var shouldShowNavButton     = $container.data('show-nav-button');
        var shouldShowBalanceButton = $container.data('show-balance-button');
        var shouldShowBackButton    = $container.data('show-back-button');
        var shouldHideBalloon       = typeof $container.data('show-balloon') === 'undefined' ? true : !$container.data('show-balloon');
        var backButtonURL           = typeof $container.data('back-url') === 'undefined' ? '#' : $container.data('back-url');
        var backButtonText          = typeof $container.data('back-text') === 'undefined' ? '' : $container.data('back-text');

        $('#btn-back')
            .toggleClass('hidden', !shouldShowBackButton)
            .attr('href', backButtonURL)
            .find('small')
            .text(backButtonText);

        $('#nav-open').toggleClass('hidden', !shouldShowNavButton);
        $('#btn-balance').toggleClass('hidden', !shouldShowBalanceButton);
        $('#balloon').toggleClass('hidden', shouldHideBalloon);

        setTimeout(function() {
            $container.animate({
                opacity: 1
            }, 500, 'linear');
        }, 100);
    };

    /**
     * Load HTML page
     *
     * @param  {String}  url            URL to the page
     * @param  {Boolean} changeState    Whether the browser history state should change
     *
     * @return {Void}
     */
    function loadPage(url, changeState) {
        $nav.removeClass('nav-visible');

        $.ajax({
            method  : 'GET',
            url     : url,
            success : function(response) {
                var $markup     = $(response);
                var $cnt        = $('#cnt');
                var $main       = $markup.find('.main');
                var $newCnt     = prepareContent($markup.find('#cnt'));
                var $balloon    = $('#balloon');
                var $newBalloon = $markup.find('#ballon');

                if ( !$newCnt.length ) {
                    return;
                };

                $html
                    .removeClass('app-elements-loaded')
                    .addClass('app-in-transition');

                $cnt.fadeOut(function() {
                    $cnt[0].parentNode.replaceChild($newCnt[0], $cnt[0]);

                    if ( !$balloon.length && $newBalloon.length ) {
                        $newBalloon.insertBefore('.main');
                    };

                    $html
                        .removeClass('app-in-transition')
                        .addClass('app-elements-loaded');

                    if ( url !== location.href ) {
                        history.pushState(null, null, url);
                    };

                    setVisibilityStates($main);
                });
            },
            error   : function(jqXHR, textStatus, errorThrown) {
                // console.log(textStatus + ': ' + errorThrown);
            }
        });
    };

    function prepareContent($content) {
        $content
            .find('.currency')
                .text(activeCurrency.toUpperCase());
        if (currencyOptions[activeCurrency]) {
            $content
                .find('.currency-mark')
                    .text(currencyOptions[activeCurrency].mark);
        }
        $content
            .find('[value="' + activeCurrency + '"]')
                .attr('checked', true);
        $content
            .find('.ballons-popped li')
                .each(function(){
                    var $this = $(this);

                    for (var i = 0; i < poppedBalloons.length; i++) {
                        if (poppedBalloons[i] === $this.index()) {
                            $this.addClass('balloon-popped');
                            break;
                        }
                    }
                });

        return $content;
    }

    /**
     * Checks a form's validity
     *
     * @param  {Object} $form           DOM Element
     *
     * @return {Boolean}
     */
    function isFormInvalid($form) {
        var $fields = $form.find('[required]');
        var all     = $fields.length;
        var i;

        for ( i = 0; i < all; i++ ) {
            var $field = $fields.eq(i);

            if ($field.data('validate') === 'min' && parseFloat($field.val()) < currencyOptions[activeCurrency].minimum) {
                return true;
            } else if ( $.trim($field.val()) === '' ) {
                return true;
            };
        };

        return false;
    };

    // Event Listeners
    $html
        // .on('click', '.js-link-internal', function(event) {
        //     event.preventDefault();
        //     loadPage(this.href, true);
        // })
        .on('submit', 'form', function(event) {
            var $form = $(this);
            $form.find('[type="submit"]').prop('disabled', true);
        })
        // .on('click', '.ballons-popped a', function(event){
        //     event.preventDefault();

        //     poppedBalloons.push($(this).closest('li').index());
        // })
        .on('change', '[name="currency"]', function(event) {
            $('#btn-select-currency').removeAttr('disabled');
            activeCurrency = this.value;
        })
        // .on('click', '#button-start', function(event) {
        //     event.preventDefault();

        //     $html.addClass('app-hiding');

        //     setTimeout(function() {
        //         $html.addClass('app-loaded');
        //     }, 800);
        // })
        .on('click', '#nav-open', function(event) {
            event.preventDefault();

            $nav.addClass('nav-visible');
        })
        .on('click', '.js-edit-currency', function(e){
            e.preventDefault();

            $('#currency-modal').addClass('modal-visible');
        })
        .on('click', '#nav-close', function(event) {
            event.preventDefault();

            $nav.removeClass('nav-visible');
        })
        .on('click', '#btn-back', function(event) {
            event.preventDefault();

            if ( this.getAttribute('href') === '#' ) {
                history.back();
            } else {
                loadPage(this.href, true);
            };
        })
        .on('click touchstart', '.js-expand', function(e){
            e.preventDefault();

            $(this)
                .closest('.widget')
                    .toggleClass('widget-expanded')
                    .find('.widget-body')
                        .slideToggle();
        })
        .on('click focus', '[data-toggle="modal"]', function(event) {
            event.preventDefault();

            $(this.getAttribute('data-target')).addClass('modal-visible');
        })
        .on('click', '.modal-close', function(event) {
            event.preventDefault();

            $(this)
                .closest('.modal')
                .removeClass('modal-visible');
            $win.trigger('modal-close');
        })
        .on('click', '.js-select-card', function(event) {
            event.preventDefault();
            var $link = $(this);
            var $cardId = $link.data('cardid');
            var $currency = $link.data('currency');
            var $currencyMark = $link.data('currencymark');

            $('#selected-card-id').val($cardId);
            $('#selected-currency').val($currency);
            $('.form-currency-mark').text($currencyMark);
            $('.form-currency').text($currency);


            $($link.data('target'))
                .find('strong')
                    .text($link.find('strong').text())
                .end()
                .find('small')
                    .text(' - ' + $link.find('> small').text())
                .end()
                .closest('.form-controls')
                    .addClass('form-controls-set')
                    .find('.field')
                    .val($link.find('strong').text())
                    .trigger('input');

            $link
                .closest('.modal')
                .removeClass('modal-visible');
        })
        .on('input', '.form-funds .field', function() {
            var $form     = $(this).closest('form');
            var isInvalid = isFormInvalid($form);

            $form.find('[type="submit"]').prop('disabled', isInvalid);
            $form.toggleClass('form-error', isInvalid);
        })

        .on('click', '.nav', function(event) {
            var $target = $(event.target);

            if ( !$target.hasClass('nav-container') && !$target.parents('.nav-container').length ) {
                $(this).removeClass('nav-visible');
            };
        })
        .on('click', '#copy-link', function(event) {
            event.preventDefault();
            var $this = $(this);
            var $url = $this.data('url');

            copyToClipboard($this.data('url'));


            $this.addClass('clicked');
        })
        .on('click', '[data-toggle="tab"]', function(event) {
            event.preventDefault();

            var $tabLink = $(this);
            var $tab     = $($tabLink.attr('href'));

            $tabLink
                .add($tab)
                .addClass('current')
                    .siblings()
                    .removeClass('current');
        });

    $win
        .on('modal-close', function(){
            prepareContent($('body'));
        })
        .on('load', function(event) {
            $html.addClass('app-loading');

            prepareContent($('body'));

            setVisibilityStates($('.main'));
        })
        .on('popstate', function(event) {
            loadPage(event.target.location.href, false);
        });

    function copyToClipboard(text) {
        var textArea = document.createElement('textarea');
        // Place in top-left corner of screen regardless of scroll position.
        textArea.style.position = 'fixed';
        textArea.style.top = 0;
        textArea.style.left = 0;

        // Ensure it has a small width and height. Setting to 1px / 1em
        // doesn't work as this gives a negative w/h on some browsers.
        textArea.style.width = '2em';
        textArea.style.height = '2em';

        // We don't need padding, reducing the size if it does flash render.
        textArea.style.padding = 0;

        // Clean up any borders.
        textArea.style.border = 'none';
        textArea.style.outline = 'none';
        textArea.style.boxShadow = 'none';

        // Avoid flash of white box if rendered for any reason.
        textArea.style.background = 'transparent';


        textArea.value = text;

        document.body.appendChild(textArea);

        textArea.select();

        try {
            var successful = document.execCommand('copy');
            var msg = successful ? 'successful' : 'unsuccessful';
            console.log('Copying text command was ' + msg);
        } catch (err) {
            console.log('Oops, unable to copy');
        }

        document.body.removeChild(textArea);
    }

    $('.close-error').on('click', function(){
        $('.error-wrap').fadeOut();
    });
})(jQuery, window, document);
