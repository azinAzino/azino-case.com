
require('./trans');
require('./old');
require('./common');
require('./socket');

var lastFrameTime = (new Date).valueOf();;

function Parallax(e) {
    return e = e || {}, this.nameSpaces = {
        wrapper: e.wrapper || ".parallax",
        overlay: e.overlay || ".c-parallax",
        layers: e.layers || ".parallax__layer",
        deep: e.deep || "data-parallax-deep"
    }, this.init = function() {
        for (var e = this, t = document.querySelectorAll(this.nameSpaces.wrapper), n = document.querySelectorAll(this.nameSpaces.overlay), o = [], r = 0; r < n.length; r++) ! function(r) {
            $(window).outerWidth();
            for (var i = t[r].querySelectorAll(e.nameSpaces.layers), a = [], s = i.length - 1; 0 <= s; s--) {
                var l = getComputedStyle(i[s]);
                a.push({
                    dom: i[s],
                    deep: Number(i[s].getAttribute(e.nameSpaces.deep)),
                    disallow: i[s].getAttribute("data-parallax-disallow"),
                    width: Number(i[s].offsetWidth),
                    height: Number(i[s].offsetHeight),
                    left: Number(l.left.replace("px", "")),
                    top: Number(l.top.replace("px", ""))
                })
            }
            o.push(a), n[r].addEventListener("mousemove", function(e) {
                if (16 < (new Date).valueOf() - lastFrameTime) {
                    lastFrameTime = (new Date).valueOf();
                    for (var t = e.clientX, n = e.clientY, i = [], a = 0; a < o[r].length; a++)
                        if ("both" != o[r][a].disallow) {
                            var s = "x" == o[r][a].disallow ? 0 : o[r][a].width * t / (100 * o[r][a].deep),
                                l = "y" == o[r][a].disallow ? 0 : o[r][a].height * n / (100 * o[r][a].deep) * 5;
                            i.push({
                                dom: o[r][a].dom,
                                itemX: s,
                                itemY: l
                            })
                        }
                    u = i, requestAnimationFrame(function() {
                        for (var e = u.length - 1; 0 <= e; e--) u[e].dom.style.transform = "translate3d(-50%, -50%, 0px) translate3d(" + u[e].itemX + "px," + u[e].itemY + "px, 0)"
                    })
                }
                var u
            })
        }(r)
    }, this.init(), this
}

$(function(){
    new Parallax;
})