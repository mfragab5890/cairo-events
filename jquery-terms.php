jQuery.fn.terms_agree = function(content_area, selector) {
    var body = $(body);
    $(this).click(function() {
        body.css("height", "auto").css("height", body.height()); // Prevent page flicker on slideup
        if ($(content_area).html() == "") {
            $(content_area).load( $(this).attr("href") + (selector ? " " + selector : "") );
        }
        $(content_area).slideToggle();
        return false;
    });
}
$(function() {
    $("#terms").terms_agree("#content-area", "#small-print");
});