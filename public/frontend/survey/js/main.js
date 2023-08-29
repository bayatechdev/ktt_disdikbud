$(function () {
    $("#wizard").steps({
        headerTag: "h4",
        bodyTag: "section",
        transitionEffect: "fade",
        enableAllSteps: true,
        transitionEffectSpeed: 500,
        onStepChanging: function (event, currentIndex, newIndex) {
            if (newIndex === 1) {
                $('.steps ul').addClass('step-2');
            } else {
                $('.steps ul').removeClass('step-2');
            }
            if (newIndex === 2) {
                $('.steps ul').addClass('step-3');
            } else {
                $('.steps ul').removeClass('step-3');
            }

            if (newIndex === 3) {
                $('.steps ul').addClass('step-4');
                $('.actions ul').addClass('step-last');
            } else {
                $('.steps ul').removeClass('step-4');
                $('.actions ul').removeClass('step-last');
            }

            if (newIndex === 4) {
                $('.steps ul').addClass('step-5');
                $('.actions ul').addClass('step-last');
            } else {
                $('.steps ul').removeClass('step-5');
                $('.actions ul').removeClass('step-last');
            }

            if (newIndex === 5) {
                $('.steps ul').addClass('step-6');
                $('.actions ul').addClass('step-last');
            } else {
                $('.steps ul').removeClass('step-6');
                $('.actions ul').removeClass('step-last');
            }

            if (newIndex === 6) {
                $('.steps ul').addClass('step-7');
                $('.actions ul').addClass('step-last');
            } else {
                $('.steps ul').removeClass('step-7');
                $('.actions ul').removeClass('step-last');
            }

            if (newIndex === 7) {
                $('.steps ul').addClass('step-8');
                $('.actions ul').addClass('step-last');
            } else {
                $('.steps ul').removeClass('step-8');
                $('.actions ul').removeClass('step-last');
            }

            if (newIndex === 8) {
                $('.steps ul').addClass('step-9');
                $('.actions ul').addClass('step-last');
            } else {
                $('.steps ul').removeClass('step-9');
                $('.actions ul').removeClass('step-last');
            }

            if (newIndex === 9) {
                $('.steps ul').addClass('step-10');
                $('.actions ul').addClass('step-last');
            } else {
                $('.steps ul').removeClass('step-10');
                $('.actions ul').removeClass('step-last');
            }

            return true;
        },
        labels: {
            finish: "Submit",
            next: "Next",
            previous: "Previous"
        }
    });
    // Custom Steps Jquery Steps
    $('.wizard > .steps li a').click(function () {
        $(this).parent().addClass('checked');
        $(this).parent().prevAll().addClass('checked');
        $(this).parent().nextAll().removeClass('checked');
    });
    // Custom Button Jquery Steps
    $('.forward').click(function () {
        $("#wizard").steps('next');
    })
    $('.backward').click(function () {
        $("#wizard").steps('previous');
    })
    // Checkbox
    $('.checkbox-circle label').click(function () {
        $('.checkbox-circle label').removeClass('active');
        $(this).addClass('active');
    })
})
