(function ( $ ) {
    $.fn.test = function(options) {
        let settings = $.extend({
            time: 3000,
            top:"25px",
        }, options );
        let progress_time = 300;
        let end_time = settings.time + progress_time;
        let progress_css_time = settings.time/1000; 
        this.toggleClass("active");
        $(".progress").toggleClass("active");

        $(":root").css({
            "--time": progress_css_time+"s",
            "--top": settings.top,
        });
        let action_class = this;
        let timer1, timer2;
        timer1 = setTimeout(() => {
            this.removeClass("active");
        }, settings.time); //1s = 1000 milliseconds

        timer2 = setTimeout(() => {
            $(".progress").removeClass("active");
        }, end_time);

        $(".close").on("click", function(){
            action_class.removeClass("active");
            setTimeout(() => {
                $(".progress").removeClass("active");
            },progress_time);
    
            clearTimeout(timer1);
            clearTimeout(timer2);
    
        });
    };
}( jQuery ));

(function ( $ ) {
    $.fn.test1 = function() {
        this.on("click",function(options){
            let settings = $.extend({
                time: 3000,
                top:"25px",
            }, options );
            let progress_time = 300;
            let end_time = settings.time + progress_time;
            let progress_css_time = settings.time/1000;
            $(".cus_toast").toggleClass("active");
            $(".progress").toggleClass("active");
    
            $(":root").css({
                "--time": progress_css_time+"s",
                "--top": settings.top,
            });

            let timer1, timer2;
            timer1 = setTimeout(() => {
                $(".cus_toast").removeClass("active");
            }, settings.time); //1s = 1000 milliseconds

            timer2 = setTimeout(() => {
                $(".progress").removeClass("active");
            }, end_time);

            $(".close").on("click", function(){
                $(".cus_toast").removeClass("active");
                setTimeout(() => {
                    $(".progress").removeClass("active");
                },progress_time);
        
                clearTimeout(timer1);
                clearTimeout(timer2);
            });
        });

    };
}(jQuery));