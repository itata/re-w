function initSparkline() {
    $(".sparkline").each(function() {
        var a = $(this);
        a.sparkline("html", a.data())
    })
}

function skinChanger() {
    $(".choose-skin li").on("click", function() {
        var a = $("body"),
            b = $(this),
            c = $(".choose-skin li.active").data("theme");
        $(".choose-skin li").removeClass("active"), a.removeClass("theme-" + c), b.addClass("active"), a.addClass("theme-" + b.data("theme"))
    })
}
$(function() {
    "use strict";
    skinChanger(), initSparkline(), setTimeout(function() {
        $(".page-loader-wrapper").fadeOut()
    }, 50)
}), $(document).ready(function() {
    $("#main-menu").metisMenu(), $("#left-sidebar .sidebar-scroll").slimScroll({
        height: "calc(100vh - 65px)",
        wheelStep: 10,
        touchScrollStep: 50,
        color: "#efefef",
        size: "2px",
        borderRadius: "3px",
        alwaysVisible: !1,
        position: "right"
    }), $(".cwidget-scroll").slimScroll({
        height: "263px",
        wheelStep: 10,
        touchScrollStep: 50,
        color: "#efefef",
        size: "2px",
        borderRadius: "3px",
        alwaysVisible: !1,
        position: "right"
    }), $(".btn-toggle-fullwidth").on("click", function() {
        $("body").hasClass("layout-fullwidth") ? ($("body").removeClass("layout-fullwidth"), $(this).find(".fa").toggleClass("fa-arrow-left fa-arrow-right")) : ($("body").addClass("layout-fullwidth"), $(this).find(".fa").toggleClass("fa-arrow-left fa-arrow-right"))
    }), $(".btn-toggle-offcanvas").on("click", function() {
        $("body").toggleClass("offcanvas-active")
    }), $("#main-content").on("click", function() {
        $("body").removeClass("offcanvas-active")
    }), $(".dropdown").on("show.bs.dropdown", function() {
        $(this).find(".dropdown-menu").first().stop(!0, !0).animate({
            top: "100%"
        }, 200)
    }), $(".dropdown").on("hide.bs.dropdown", function() {
        $(this).find(".dropdown-menu").first().stop(!0, !0).animate({
            top: "80%"
        }, 200)
    }), $('.navbar-form.search-form input[type="text"]').on("focus", function() {
        $(this).animate({
            width: "+=50px"
        }, 300)
    }).on("focusout", function() {
        $(this).animate({
            width: "-=50px"
        }, 300)
    }), $('[data-toggle="tooltip"]').length > 0 && $('[data-toggle="tooltip"]').tooltip(), $('[data-toggle="popover"]').length > 0 && $('[data-toggle="popover"]').popover(), $(window).on("load", function() {
        $("#main-content").height() < $("#left-sidebar").height() && $("#main-content").css("min-height", $("#left-sidebar").innerHeight() - $("footer").innerHeight())
    }), $(window).on("load resize", function() {
        $(window).innerWidth() < 420 ? $(".navbar-brand logo.svg").attr("src", "assets/images/logo-icon.svg") : $(".navbar-brand logo-icon.svg").attr("src", "assets/images/logo.svg")
    })
}), $.fn.clickToggle = function(a, b) {
    return this.each(function() {
        var c = !1;
        $(this).bind("click", function() {
            return c ? (c = !1, b.apply(this, arguments)) : (c = !0, a.apply(this, arguments))
        })
    })
}, $(".select-all").on("click", function() {
    this.checked ? $(this).parents("table").find(".checkbox-tick").each(function() {
        this.checked = !0
    }) : $(this).parents("table").find(".checkbox-tick").each(function() {
        this.checked = !1
    })
}), $(".checkbox-tick").on("click", function() {
    $(this).parents("table").find(".checkbox-tick:checked").length == $(this).parents("table").find(".checkbox-tick").length ? $(this).parents("table").find(".select-all").prop("checked", !0) : $(this).parents("table").find(".select-all").prop("checked", !1)
});
