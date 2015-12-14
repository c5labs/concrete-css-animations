(function ($) {
    "use strict";

    var classes = [
        'animated',
        'bounceInRight',
        'bounceInLeft',
        'bounceInUp',
        'bounceInDown',
        'fadeInRight',
        'fadeInLeft',
        'fadeInUp',
        'fadeInDown',
        'flipInX',
        'flipInY',
        'rotateIn',
        'rotateInUpLeft',
        'rotateInUpRight',
        'rotateInDownLeft',
        'rotateDownUpRight',
        'rollIn',
        'lightSpeedInRight',
        'lightSpeedInLeft',
        'slow',
        'slower',
        'slowest',
        'delay-250',
        'delay-500',
        'delay-750',
        'delay-1000',
        'delay-1250',
        'delay-1500',
        'delay-1750',
        'delay-2000',
        'delay-2500',
        'delay-2000',
        'delay-2500',
        'delay-3000',
        'delay-3500',
    ];

    var injected = false;

    function appendTags($s2, tags)
    {
        var opts = $s2.data('select2').opts;

        $s2
            .select2('destroy')
            .html('')
            .select2({
                tags: opts.tags.concat(tags),
                separator: " ",
            });
    }

    function injectClasses()
    {
        var $s2 = $('#customClass');

        if ($s2.length > 0) {
            if (!injected) {
                appendTags($s2, classes);
                injected = true;
            }
        } 
        else {
            injected = false;
        }

        removeClasses();
    }

    function removeClasses()
    {
        $('.animated').removeClass(classes.join(' '));
    }

    if (CCM_EDIT_MODE) {
        setInterval(injectClasses, 250);
        
    } else {
        $('.animated').wrap($('<div class="animatedParent animateOnce"></div>'));
    }

}(jQuery));