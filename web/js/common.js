$(document).ready(function(){
    // 导航栏
    var navlist = $(".nav_list>li");
    navlist.hover(function(){
        $(this).find(".subNav_c").stop();
        $(this).find(".subNav_c").slideDown();
    },function(){
        $(this).find(".subNav_c").hide();
    });

    // 返回顶部
    var toTopBtn = $('.btn_toTop');
    toTopBtn.click(function(){
        $('body,html').animate({ scrollTop: 0 }, 500);
    });
});