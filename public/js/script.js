/* ========================================
    Toggle sidebar
   ====================================== */
$('.navopen').click(function () {
    $('.sidebar').css({left: '0px'});
});
$('.navclose').click(function () {
    $('.sidebar').css({left: '-250px'});
});
/* ========================================
    Check every 5 sec. if something is missing
window.setInterval(() => {

}, 5000);
====================================== */
