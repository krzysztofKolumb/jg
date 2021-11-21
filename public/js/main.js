!(function (e) {
    function a(e, a) {
        (r = ++n / s), TweenLite.to(l, 0.7, { progress: r, ease: Linear.easeNone });
    }
    function o() {
        (r = Math.round(100 * l.progress())), e(".txt-perc").text(r + "%");
    }
    function t() { var a = new TimelineMax(); return (a.to(e(".progress"), 0.3, { autoAlpha: 0, ease: Back.easeIn }).to(e(".txt-perc"), 0.3, { y: 30, autoAlpha: 0, ease: Back.easeIn }, 0.1).to(e(".txt-intro"), 0.3, { autoAlpha: 0 }).set(e("body"), { className: "-=is-loading" }).set(e("#intro"), { className: "+=is-loaded" }).to(e("#preloader"), 1, { autoAlpha: 0, ease: Power4.easeInOut }, "-=0.2").set(e("#preloader"), { className: "+=is-hidden" }).from(e("#intro .title"), 1.1, { autoAlpha: 0, ease: Power1.easeOut }, "-=0.1").from(e("#intro p"), 1, { autoAlpha: 0, ease: Power1.easeOut }, "-=0.2").from(e("footer"), 0.7, { y: 50, autoAlpha: 0, ease: Power1.easeOut }, "-=0.9"), a); }
    var n = 0,
        s = e(".bcg").length,
        r = 0, i = e(".menu-button"), p = e(".page-nav");
    e(".bcg")
        .imagesLoaded({ background: !0 })
        .progress(function (e, o) {
            a();
        });
    var l = new TimelineMax({ paused: !0, onUpdate: o, onComplete: t });
    l.to(e(".progress span"), 1, { width: "100%", ease: Linear.easeNone }),
        i.on("click", function () {
            e(this).toggleClass("is-open"), p.toggleClass("on-click");
        }),
        i.has("is-open") &&
        p.has("on-click") &&
        e("#intro, main, .container, .img-container").on("click", function () {
            i.removeClass("is-open"), p.removeClass("on-click");
        }),
        new TimelineMax()
            .to(e(".page-header .logo h1"), 1.5, { autoAlpha: 1, ease: Power1.easeNone }, 0.1)
            .to(e(".page-header .logo p"), 1.5, { autoAlpha: 1, ease: Power1.easeNone }, "-=1.3")
            .to(e(".page-header .menu-button"), 1, { autoAlpha: 1, ease: Power1.easeNone }, "-=1.3")
            .to(e(".title-container span"), 0, { y: 120, ease: Power1.easeNone }, "-=2")
            .staggerTo(e(".title-container span"), 0.8, { y: 0, autoAlpha: 1, ease: Power1.easeNone }, 0.1, "-=1.8")
            .to(e(".grid"), 1, { autoAlpha: 1, ease: Power1.easeNone }, "-=1.2")
            .to(e(".about-container figure"), 1, { autoAlpha: 1, ease: Power1.easeNone }, "-=1.2")
            .to(e(".about-container .about-description"), 1.2, { autoAlpha: 1, ease: Power1.easeNone }, "-=1")
            .to(e("footer .wrapper p"), 1.2, { autoAlpha: 1, ease: Power1.easeNone }, "-=1")
            .to(e("footer .wrapper a"), 1.2, { autoAlpha: 1, ease: Power1.easeNone }, "-=2");
})(jQuery);
