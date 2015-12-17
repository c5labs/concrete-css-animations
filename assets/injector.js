(function ($) {
    "use strict";

    var classes = {
        animations : [
            'bounceInRight',
            'bounceInLeft',
            'bounceInUp',
            'bounceInDown',
            'fadeIn',
            'fadeOut',
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
        ],
        modifiers: [
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
        ]
    };

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
                var tags = classes.animations.concat(classes.modifiers);

                appendTags($s2, tags);

                injected = true;
            }
        } 
        else {
            injected = false;
        }

        removeClasses();
    }

    function getAnimationClassString(delimiter)
    {
        if (!delimiter) {
            delimiter = ', .';
        }

        return (delimiter ? '.' : '') + classes.animations.join(delimiter);
    }

    function removeClasses()
    {
        $('.animated-css-class')
            .removeClass(getAnimationClassString(' ') + ' animated');
    }

    if (CCM_EDIT_MODE) {
        window.cssAnimationsPackage = {
            animations: classes.animations.concat(classes.modifiers),
        };
        setInterval(injectClasses, 500);
    } else {
        $(getAnimationClassString())
            .wrap($('<div class="animatedParent animateOnce"></div>'))
            .addClass('animated animated-css-class');
    }

}(jQuery));