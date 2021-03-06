"use strict";
this.Element && function (t) {
    t.matches = t.matches || t.matchesSelector || t.webkitMatchesSelector || t.msMatchesSelector || function (t) {
        for (var e = (this.parentNode || this.document).querySelectorAll(t), a = -1; e[++a] && e[a] != this; )
            ;
        return !!e[a]
    }
}(Element.prototype), this.Element && function (t) {
    t.closest = t.closest || function (t) {
        for (var e = this; e.matches && !e.matches(t); )
            e = e.parentNode;
        return e.matches ? e : null
    }
}(Element.prototype), "remove" in Element.prototype || (Element.prototype.remove = function () {
    this.parentNode && this.parentNode.removeChild(this)
}), this.Element && function (t) {
    t.matches = t.matches || t.matchesSelector || t.webkitMatchesSelector || t.msMatchesSelector || function (t) {
        for (var e = (this.parentNode || this.document).querySelectorAll(t), a = -1; e[++a] && e[a] != this; )
            ;
        return !!e[a]
    }
}(Element.prototype),
        function () {
            for (var t = 0, e = ["webkit", "moz"], a = 0; a < e.length && !window.requestAnimationFrame; ++a)
                window.requestAnimationFrame = window[e[a] + "RequestAnimationFrame"], window.cancelAnimationFrame = window[e[a] + "CancelAnimationFrame"] || window[e[a] + "CancelRequestAnimationFrame"];
            window.requestAnimationFrame || (window.requestAnimationFrame = function (e) {
                var a = (new Date).getTime(),
                        n = Math.max(0, 16 - (a - t)),
                        o = window.setTimeout(function () {
                            e(a + n)
                        }, n);
                return t = a + n, o
            }), window.cancelAnimationFrame || (window.cancelAnimationFrame = function (t) {
                clearTimeout(t)
            })
        }(), [Element.prototype, Document.prototype, DocumentFragment.prototype].forEach(function (t) {
    t.hasOwnProperty("prepend") || Object.defineProperty(t, "prepend", {
        configurable: !0,
        enumerable: !0,
        writable: !0,
        value: function () {
            var t = Array.prototype.slice.call(arguments),
                    e = document.createDocumentFragment();
            t.forEach(function (t) {
                var a = t instanceof Node;
                e.appendChild(a ? t : document.createTextNode(String(t)))
            }), this.insertBefore(e, this.firstChild)
        }
    })
}), window.KTUtilElementDataStore = {}, window.KTUtilElementDataStoreID = 0, window.KTUtilDelegatedEventHandlers = {};
var KTUtil = function () {
    var t = [],
            e = {
                sm: 544,
                md: 768,
                lg: 1024,
                xl: 1200
            },
            a = function () {
                var e = !1;
                window.addEventListener("resize", function () {
                    clearTimeout(e), e = setTimeout(function () {
                        !function () {
                            for (var e = 0; e < t.length; e++)
                                t[e].call()
                        }()
                    }, 250)
                })
            };
    return {
        init: function (t) {
            t && t.breakpoints && (e = t.breakpoints), a()
        },
        addResizeHandler: function (e) {
            t.push(e)
        },
        removeResizeHandler: function (e) {
            for (var a = 0; a < t.length; a++)
                e === t[a] && delete t[a]
        },
        runResizeHandlers: function () {
            _runResizeHandlers()
        },
        resize: function () {
            if ("function" == typeof Event)
                window.dispatchEvent(new Event("resize"));
            else {
                var t = window.document.createEvent("UIEvents");
                t.initUIEvent("resize", !0, !1, window, 0), window.dispatchEvent(t)
            }
        },
        getURLParam: function (t) {
            var e, a, n = window.location.search.substring(1).split("&");
            for (e = 0; e < n.length; e++)
                if ((a = n[e].split("="))[0] == t)
                    return unescape(a[1]);
            return null
        },
        isMobileDevice: function () {
            return this.getViewPort().width < this.getBreakpoint("lg")
        },
        isDesktopDevice: function () {
            return !KTUtil.isMobileDevice()
        },
        getViewPort: function () {
            var t = window,
                    e = "inner";
            return "innerWidth" in window || (e = "client", t = document.documentElement || document.body), {
                width: t[e + "Width"],
                height: t[e + "Height"]
            }
        },
        isInResponsiveRange: function (t) {
            var e = this.getViewPort().width;
            return "general" == t || ("desktop" == t && e >= this.getBreakpoint("lg") + 1 || ("tablet" == t && e >= this.getBreakpoint("md") + 1 && e < this.getBreakpoint("lg") || ("mobile" == t && e <= this.getBreakpoint("md") || ("desktop-and-tablet" == t && e >= this.getBreakpoint("md") + 1 || ("tablet-and-mobile" == t && e <= this.getBreakpoint("lg") || "minimal-desktop-and-below" == t && e <= this.getBreakpoint("xl"))))))
        },
        getUniqueID: function (t) {
            return t + Math.floor(Math.random() * (new Date).getTime())
        },
        getBreakpoint: function (t) {
            return e[t]
        },
        isset: function (t, e) {
            var a;
            if (-1 !== (e = e || "").indexOf("["))
                throw new Error("Unsupported object path notation.");
            e = e.split(".");
            do {
                if (void 0 === t)
                    return !1;
                if (a = e.shift(), !t.hasOwnProperty(a))
                    return !1;
                t = t[a]
            } while (e.length);
            return !0
        },
        getHighestZindex: function (t) {
            for (var e, a, n = KTUtil.get(t); n && n !== document; ) {
                if (("absolute" === (e = KTUtil.css(n, "position")) || "relative" === e || "fixed" === e) && (a = parseInt(KTUtil.css(n, "z-index")), !isNaN(a) && 0 !== a))
                    return a;
                n = n.parentNode
            }
            return null
        },
        hasFixedPositionedParent: function (t) {
            for (; t && t !== document; ) {
                if (position = KTUtil.css(t, "position"), "fixed" === position)
                    return !0;
                t = t.parentNode
            }
            return !1
        },
        sleep: function (t) {
            for (var e = (new Date).getTime(), a = 0; a < 1e7 && !((new Date).getTime() - e > t); a++)
                ;
        },
        getRandomInt: function (t, e) {
            return Math.floor(Math.random() * (e - t + 1)) + t
        },
        isAngularVersion: function () {
            return void 0 !== window.Zone
        },
        deepExtend: function (t) {
            t = t || {};
            for (var e = 1; e < arguments.length; e++) {
                var a = arguments[e];
                if (a)
                    for (var n in a)
                        a.hasOwnProperty(n) && ("object" == typeof a[n] ? t[n] = KTUtil.deepExtend(t[n], a[n]) : t[n] = a[n])
            }
            return t
        },
        extend: function (t) {
            t = t || {};
            for (var e = 1; e < arguments.length; e++)
                if (arguments[e])
                    for (var a in arguments[e])
                        arguments[e].hasOwnProperty(a) && (t[a] = arguments[e][a]);
            return t
        },
        get: function (t) {
            var e;
            return t === document ? document : t && 1 === t.nodeType ? t : (e = document.getElementById(t)) ? e : (e = document.getElementsByTagName(t)) ? e[0] : (e = document.getElementsByClassName(t)) ? e[0] : null
        },
        getByID: function (t) {
            return t && 1 === t.nodeType ? t : document.getElementById(t)
        },
        getByTag: function (t) {
            var e;
            return (e = document.getElementsByTagName(t)) ? e[0] : null
        },
        getByClass: function (t) {
            var e;
            return (e = document.getElementsByClassName(t)) ? e[0] : null
        },
        hasClasses: function (t, e) {
            if (t) {
                for (var a = e.split(" "), n = 0; n < a.length; n++)
                    if (0 == KTUtil.hasClass(t, KTUtil.trim(a[n])))
                        return !1;
                return !0
            }
        },
        hasClass: function (t, e) {
            if (t)
                return t.classList ? t.classList.contains(e) : new RegExp("\\b" + e + "\\b").test(t.className)
        },
        addClass: function (t, e) {
            if (t && void 0 !== e) {
                var a = e.split(" ");
                if (t.classList)
                    for (var n = 0; n < a.length; n++)
                        a[n] && a[n].length > 0 && t.classList.add(KTUtil.trim(a[n]));
                else if (!KTUtil.hasClass(t, e))
                    for (n = 0; n < a.length; n++)
                        t.className += " " + KTUtil.trim(a[n])
            }
        },
        removeClass: function (t, e) {
            if (t && void 0 !== e) {
                var a = e.split(" ");
                if (t.classList)
                    for (var n = 0; n < a.length; n++)
                        t.classList.remove(KTUtil.trim(a[n]));
                else if (KTUtil.hasClass(t, e))
                    for (n = 0; n < a.length; n++)
                        t.className = t.className.replace(new RegExp("\\b" + KTUtil.trim(a[n]) + "\\b", "g"), "")
            }
        },
        triggerCustomEvent: function (t, e, a) {
            if (window.CustomEvent)
                var n = new CustomEvent(e, {
                    detail: a
                });
            else
                (n = document.createEvent("CustomEvent")).initCustomEvent(e, !0, !0, a);
            t.dispatchEvent(n)
        },
        triggerEvent: function (t, e) {
            var a;
            if (t.ownerDocument)
                a = t.ownerDocument;
            else {
                if (9 != t.nodeType)
                    throw new Error("Invalid node passed to fireEvent: " + t.id);
                a = t
            }
            if (t.dispatchEvent) {
                var n = "";
                switch (e) {
                    case "click":
                    case "mouseenter":
                    case "mouseleave":
                    case "mousedown":
                    case "mouseup":
                        n = "MouseEvents";
                        break;
                    case "focus":
                    case "change":
                    case "blur":
                    case "select":
                        n = "HTMLEvents";
                        break;
                    default:
                        throw "fireEvent: Couldn't find an event class for event '" + e + "'."
                }
                var o = "change" != e;
                (i = a.createEvent(n)).initEvent(e, o, !0), i.synthetic = !0, t.dispatchEvent(i, !0)
            } else if (t.fireEvent) {
                var i;
                (i = a.createEventObject()).synthetic = !0, t.fireEvent("on" + e, i)
            }
        },
        index: function (t) {
            for (var e = (t = KTUtil.get(t)).parentNode.children, a = 0; a < e.length; a++)
                if (e[a] == t)
                    return a
        },
        trim: function (t) {
            return t.trim()
        },
        eventTriggered: function (t) {
            return !!t.currentTarget.dataset.triggered || (t.currentTarget.dataset.triggered = !0, !1)
        },
        remove: function (t) {
            t && t.parentNode && t.parentNode.removeChild(t)
        },
        find: function (t, e) {
            if (t = KTUtil.get(t))
                return t.querySelector(e)
        },
        findAll: function (t, e) {
            if (t = KTUtil.get(t))
                return t.querySelectorAll(e)
        },
        insertAfter: function (t, e) {
            return e.parentNode.insertBefore(t, e.nextSibling)
        },
        parents: function (t, e) {
            function a(t, e) {
                for (var a = 0, n = t.length; a < n; a++)
                    if (t[a] == e)
                        return !0;
                return !1
            }
            return function (t, e) {
                for (var n = document.querySelectorAll(e), o = t.parentNode; o && !a(n, o); )
                    o = o.parentNode;
                return o
            }(t, e)
        },
        children: function (t, e, a) {
            if (t && t.childNodes) {
                for (var n = [], o = 0, i = t.childNodes.length; o < i; ++o)
                    1 == t.childNodes[o].nodeType && KTUtil.matches(t.childNodes[o], e, a) && n.push(t.childNodes[o]);
                return n
            }
        },
        child: function (t, e, a) {
            var n = KTUtil.children(t, e, a);
            return n ? n[0] : null
        },
        matches: function (t, e, a) {
            var n = Element.prototype,
                    o = n.matches || n.webkitMatchesSelector || n.mozMatchesSelector || n.msMatchesSelector || function (t) {
                        return -1 !== [].indexOf.call(document.querySelectorAll(t), this)
                    };
            return !(!t || !t.tagName) && o.call(t, e)
        },
        data: function (t) {
            return t = KTUtil.get(t), {
                set: function (e, a) {
                    void 0 !== t && (void 0 === t.customDataTag && (KTUtilElementDataStoreID++, t.customDataTag = KTUtilElementDataStoreID), void 0 === KTUtilElementDataStore[t.customDataTag] && (KTUtilElementDataStore[t.customDataTag] = {}), KTUtilElementDataStore[t.customDataTag][e] = a)
                },
                get: function (e) {
                    if (void 0 !== t)
                        return void 0 === t.customDataTag ? null : this.has(e) ? KTUtilElementDataStore[t.customDataTag][e] : null
                },
                has: function (e) {
                    return void 0 !== t && (void 0 !== t.customDataTag && !(!KTUtilElementDataStore[t.customDataTag] || !KTUtilElementDataStore[t.customDataTag][e]))
                },
                remove: function (e) {
                    t && this.has(e) && delete KTUtilElementDataStore[t.customDataTag][e]
                }
            }
        },
        outerWidth: function (t, e) {
            if (!0 === e) {
                var a = parseFloat(t.offsetWidth);
                return a += parseFloat(KTUtil.css(t, "margin-left")) + parseFloat(KTUtil.css(t, "margin-right")), parseFloat(a)
            }
            return a = parseFloat(t.offsetWidth)
        },
        offset: function (t) {
            var e, a;
            if (t = KTUtil.get(t))
                return t.getClientRects().length ? (e = t.getBoundingClientRect(), a = t.ownerDocument.defaultView, {
                    top: e.top + a.pageYOffset,
                    left: e.left + a.pageXOffset
                }) : {
                    top: 0,
                    left: 0
                }
        },
        height: function (t) {
            return KTUtil.css(t, "height")
        },
        visible: function (t) {
            return !(0 === t.offsetWidth && 0 === t.offsetHeight)
        },
        attr: function (t, e, a) {
            if (null != (t = KTUtil.get(t)))
                return void 0 === a ? t.getAttribute(e) : void t.setAttribute(e, a)
        },
        hasAttr: function (t, e) {
            if (null != (t = KTUtil.get(t)))
                return !!t.getAttribute(e)
        },
        removeAttr: function (t, e) {
            null != (t = KTUtil.get(t)) && t.removeAttribute(e)
        },
        animate: function (t, e, a, n, o, i) {
            var l = {};
            if (l.linear = function (t, e, a, n) {
                return a * t / n + e
            }, o = l.linear, "number" == typeof t && "number" == typeof e && "number" == typeof a && "function" == typeof n) {
                "function" != typeof i && (i = function () {});
                var r = window.requestAnimationFrame || function (t) {
                    window.setTimeout(t, 20)
                },
                        s = e - t;
                n(t);
                var d = window.performance && window.performance.now ? window.performance.now() : +new Date;
                r(function l(c) {
                    var u = (c || +new Date) - d;
                    u >= 0 && n(o(u, t, s, a)), u >= 0 && u >= a ? (n(e), i()) : r(l)
                })
            }
        },
        actualCss: function (t, e, a) {
            var n, o = "";
            if ((t = KTUtil.get(t)) instanceof HTMLElement != !1)
                return t.getAttribute("kt-hidden-" + e) && !1 !== a ? parseFloat(t.getAttribute("kt-hidden-" + e)) : (o = t.style.cssText, t.style.cssText = "position: absolute; visibility: hidden; display: block;", "width" == e ? n = t.offsetWidth : "height" == e && (n = t.offsetHeight), t.style.cssText = o, t.setAttribute("kt-hidden-" + e, n), parseFloat(n))
        },
        actualHeight: function (t, e) {
            return KTUtil.actualCss(t, "height", e)
        },
        actualWidth: function (t, e) {
            return KTUtil.actualCss(t, "width", e)
        },
        getScroll: function (t, e) {
            return e = "scroll" + e, t == window || t == document ? self["scrollTop" == e ? "pageYOffset" : "pageXOffset"] || browserSupportsBoxModel && document.documentElement[e] || document.body[e] : t[e]
        },
        css: function (t, e, a) {
            if (t = KTUtil.get(t))
                if (void 0 !== a)
                    t.style[e] = a;
                else {
                    var n = (t.ownerDocument || document).defaultView;
                    if (n && n.getComputedStyle)
                        return e = e.replace(/([A-Z])/g, "-$1").toLowerCase(), n.getComputedStyle(t, null).getPropertyValue(e);
                    if (t.currentStyle)
                        return e = e.replace(/\-(\w)/g, function (t, e) {
                            return e.toUpperCase()
                        }), a = t.currentStyle[e], /^\d+(em|pt|%|ex)?$/i.test(a) ? function (e) {
                            var a = t.style.left,
                                    n = t.runtimeStyle.left;
                            return t.runtimeStyle.left = t.currentStyle.left, t.style.left = e || 0, e = t.style.pixelLeft + "px", t.style.left = a, t.runtimeStyle.left = n, e
                        }(a) : a
                }
        },
        slide: function (t, e, a, n, o) {
            if (!(!t || "up" == e && !1 === KTUtil.visible(t) || "down" == e && !0 === KTUtil.visible(t))) {
                a = a || 600;
                var i = KTUtil.actualHeight(t),
                        l = !1,
                        r = !1;
                KTUtil.css(t, "padding-top") && !0 !== KTUtil.data(t).has("slide-padding-top") && KTUtil.data(t).set("slide-padding-top", KTUtil.css(t, "padding-top")), KTUtil.css(t, "padding-bottom") && !0 !== KTUtil.data(t).has("slide-padding-bottom") && KTUtil.data(t).set("slide-padding-bottom", KTUtil.css(t, "padding-bottom")), KTUtil.data(t).has("slide-padding-top") && (l = parseInt(KTUtil.data(t).get("slide-padding-top"))), KTUtil.data(t).has("slide-padding-bottom") && (r = parseInt(KTUtil.data(t).get("slide-padding-bottom"))), "up" == e ? (t.style.cssText = "display: block; overflow: hidden;", l && KTUtil.animate(0, l, a, function (e) {
                    t.style.paddingTop = l - e + "px"
                }, "linear"), r && KTUtil.animate(0, r, a, function (e) {
                    t.style.paddingBottom = r - e + "px"
                }, "linear"), KTUtil.animate(0, i, a, function (e) {
                    t.style.height = i - e + "px"
                }, "linear", function () {
                    n(), t.style.height = "", t.style.display = "none"
                })) : "down" == e && (t.style.cssText = "display: block; overflow: hidden;", l && KTUtil.animate(0, l, a, function (e) {
                    t.style.paddingTop = e + "px"
                }, "linear", function () {
                    t.style.paddingTop = ""
                }), r && KTUtil.animate(0, r, a, function (e) {
                    t.style.paddingBottom = e + "px"
                }, "linear", function () {
                    t.style.paddingBottom = ""
                }), KTUtil.animate(0, i, a, function (e) {
                    t.style.height = e + "px"
                }, "linear", function () {
                    n(), t.style.height = "", t.style.display = "", t.style.overflow = ""
                }))
            }
        },
        slideUp: function (t, e, a) {
            KTUtil.slide(t, "up", e, a)
        },
        slideDown: function (t, e, a) {
            KTUtil.slide(t, "down", e, a)
        },
        show: function (t, e) {
            t.style.display = e || "block"
        },
        hide: function (t) {
            t.style.display = "none"
        },
        addEvent: function (t, e, a, n) {
            void 0 !== (t = KTUtil.get(t)) && t.addEventListener(e, a)
        },
        removeEvent: function (t, e, a) {
            (t = KTUtil.get(t)).removeEventListener(e, a)
        },
        on: function (t, e, a, n) {
            if (e) {
                var o = KTUtil.getUniqueID("event");
                return KTUtilDelegatedEventHandlers[o] = function (a) {
                    for (var o = t.querySelectorAll(e), i = a.target; i && i !== t; ) {
                        for (var l = 0, r = o.length; l < r; l++)
                            i === o[l] && n.call(i, a);
                        i = i.parentNode
                    }
                }, KTUtil.addEvent(t, a, KTUtilDelegatedEventHandlers[o]), o
            }
        },
        off: function (t, e, a) {
            t && KTUtilDelegatedEventHandlers[a] && (KTUtil.removeEvent(t, e, KTUtilDelegatedEventHandlers[a]), delete KTUtilDelegatedEventHandlers[a])
        },
        one: function (t, e, a) {
            (t = KTUtil.get(t)).addEventListener(e, function t(e) {
                return e.target && e.target.removeEventListener && e.target.removeEventListener(e.type, t), a(e)
            })
        },
        hash: function (t) {
            var e, a = 0;
            if (0 === t.length)
                return a;
            for (e = 0; e < t.length; e++)
                a = (a << 5) - a + t.charCodeAt(e), a |= 0;
            return a
        },
        animateClass: function (t, e, a) {
            var n, o = {
                animation: "animationend",
                OAnimation: "oAnimationEnd",
                MozAnimation: "mozAnimationEnd",
                WebkitAnimation: "webkitAnimationEnd",
                msAnimation: "msAnimationEnd"
            };
            for (var i in o)
                void 0 !== t.style[i] && (n = o[i]);
            KTUtil.addClass(t, "animated " + e), KTUtil.one(t, n, function () {
                KTUtil.removeClass(t, "animated " + e)
            }), a && KTUtil.one(t, n, a)
        },
        transitionEnd: function (t, e) {
            var a, n = {
                transition: "transitionend",
                OTransition: "oTransitionEnd",
                MozTransition: "mozTransitionEnd",
                WebkitTransition: "webkitTransitionEnd",
                msTransition: "msTransitionEnd"
            };
            for (var o in n)
                void 0 !== t.style[o] && (a = n[o]);
            KTUtil.one(t, a, e)
        },
        animationEnd: function (t, e) {
            var a, n = {
                animation: "animationend",
                OAnimation: "oAnimationEnd",
                MozAnimation: "mozAnimationEnd",
                WebkitAnimation: "webkitAnimationEnd",
                msAnimation: "msAnimationEnd"
            };
            for (var o in n)
                void 0 !== t.style[o] && (a = n[o]);
            KTUtil.one(t, a, e)
        },
        animateDelay: function (t, e) {
            for (var a = ["webkit-", "moz-", "ms-", "o-", ""], n = 0; n < a.length; n++)
                KTUtil.css(t, a[n] + "animation-delay", e)
        },
        animateDuration: function (t, e) {
            for (var a = ["webkit-", "moz-", "ms-", "o-", ""], n = 0; n < a.length; n++)
                KTUtil.css(t, a[n] + "animation-duration", e)
        },
        scrollTo: function (t, e, a) {
            a = a || 500;
            var n, o, i = (t = KTUtil.get(t)) ? KTUtil.offset(t).top : 0,
                    l = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop || 0;
            i > l ? (n = i, o = l) : (n = l, o = i), e && (o += e), KTUtil.animate(n, o, a, function (t) {
                document.documentElement.scrollTop = t, document.body.parentNode.scrollTop = t, document.body.scrollTop = t
            })
        },
        scrollTop: function (t, e) {
            KTUtil.scrollTo(null, t, e)
        },
        isArray: function (t) {
            return t && Array.isArray(t)
        },
        ready: function (t) {
            (document.attachEvent ? "complete" === document.readyState : "loading" !== document.readyState) ? t() : document.addEventListener("DOMContentLoaded", t)
        },
        isEmpty: function (t) {
            for (var e in t)
                if (t.hasOwnProperty(e))
                    return !1;
            return !0
        },
        numberString: function (t) {
            for (var e = (t += "").split("."), a = e[0], n = e.length > 1 ? "." + e[1] : "", o = /(\d+)(\d{3})/; o.test(a); )
                a = a.replace(o, "$1,$2");
            return a + n
        },
        detectIE: function () {
            var t = window.navigator.userAgent,
                    e = t.indexOf("MSIE ");
            if (e > 0)
                return parseInt(t.substring(e + 5, t.indexOf(".", e)), 10);
            if (t.indexOf("Trident/") > 0) {
                var a = t.indexOf("rv:");
                return parseInt(t.substring(a + 3, t.indexOf(".", a)), 10)
            }
            var n = t.indexOf("Edge/");
            return n > 0 && parseInt(t.substring(n + 5, t.indexOf(".", n)), 10)
        },
        isRTL: function () {
            return "rtl" == KTUtil.attr(KTUtil.get("html"), "direction")
        },
        scrollInit: function (t, e) {
            function a() {
                var a, n;
                n = e.height instanceof Function ? parseInt(e.height.call()) : parseInt(e.height), e.disableForMobile && KTUtil.isInResponsiveRange("tablet-and-mobile") ? (a = KTUtil.data(t).get("ps")) ? (e.resetHeightOnDestroy ? KTUtil.css(t, "height", "auto") : (KTUtil.css(t, "overflow", "auto"), n > 0 && KTUtil.css(t, "height", n + "px")), a.destroy(), a = KTUtil.data(t).remove("ps")) : n > 0 && (KTUtil.css(t, "overflow", "auto"), KTUtil.css(t, "height", n + "px")) : (n > 0 && KTUtil.css(t, "height", n + "px"), KTUtil.css(t, "overflow", "hidden"), (a = KTUtil.data(t).get("ps")) ? a.update() : (KTUtil.addClass(t, "kt-scroll"), a = new PerfectScrollbar(t, {
                    wheelSpeed: .5,
                    swipeEasing: !0,
                    wheelPropagation: !1,
                    minScrollbarLength: 40,
                    maxScrollbarLength: 300,
                    suppressScrollX: "true" != KTUtil.attr(t, "data-scroll-x")
                }), KTUtil.data(t).set("ps", a)))
            }
            t && (a(), e.handleWindowResize && KTUtil.addResizeHandler(function () {
                a()
            }))
        },
        scrollUpdate: function (t) {
            var e;
            (e = KTUtil.data(t).get("ps")) && e.update()
        },
        scrollUpdateAll: function (t) {
            for (var e = KTUtil.findAll(t, ".ps"), a = 0, n = e.length; a < n; a++)
                KTUtil.scrollerUpdate(e[a])
        },
        scrollDestroy: function (t) {
            var e;
            (e = KTUtil.data(t).get("ps")) && (e.destroy(), e = KTUtil.data(t).remove("ps"))
        },
        setHTML: function (t, e) {
            KTUtil.get(t) && (KTUtil.get(t).innerHTML = e)
        },
        getHTML: function (t) {
            if (KTUtil.get(t))
                return KTUtil.get(t).innerHTML
        }
    }
}();
KTUtil.ready(function () {
    KTUtil.init()
}), window.onload = function () {
    KTUtil.removeClass(KTUtil.get("body"), "kt-page--loading")
};
var KTApp = function () {
    var t = {},
            e = function (t) {
                var e = t.data("skin") ? "tooltip-" + t.data("skin") : "",
                        a = "auto" == t.data("width") ? "tooltop-auto-width" : "",
                        n = t.data("trigger") ? t.data("trigger") : "hover";
                t.data("placement") && t.data("placement");
                t.tooltip({
                    trigger: n,
                    template: '<div class="tooltip ' + e + " " + a + '" role="tooltip">                <div class="arrow"></div>                <div class="tooltip-inner"></div>            </div>'
                })
            },
            a = function () {
                $('[data-toggle="kt-tooltip"]').each(function () {
                    e($(this))
                })
            },
            n = function (t) {
                var e = t.data("skin") ? "popover-" + t.data("skin") : "",
                        a = t.data("trigger") ? t.data("trigger") : "hover";
                t.popover({
                    trigger: a,
                    template: '            <div class="popover ' + e + '" role="tooltip">                <div class="arrow"></div>                <h3 class="popover-header"></h3>                <div class="popover-body"></div>            </div>'
                })
            },
            o = function () {
                $('[data-toggle="kt-popover"]').each(function () {
                    n($(this))
                })
            },
            i = function (t, e) {
                t = $(t), new KTPortlet(t[0], e)
            },
            l = function () {
                $('[data-ktportlet="true"]').each(function () {
                    var t = $(this);
                    !0 !== t.data("data-ktportlet-initialized") && (i(t, {}), t.data("data-ktportlet-initialized", !0))
                })
            },
            r = function () {
                new Sticky('[data-sticky="true"]')
            };
    return {
        init: function (e) {
            e && e.colors && (t = e.colors), KTApp.initComponents()
        },
        initComponents: function () {
            $('[data-scroll="true"]').each(function () {
                var t = $(this);
                KTUtil.scrollInit(this, {
                    disableForMobile: !0,
                    handleWindowResize: !0,
                    height: function () {
                        return KTUtil.isInResponsiveRange("tablet-and-mobile") && t.data("mobile-height") ? t.data("mobile-height") : t.data("height")
                    }
                })
            }), a(), o(), $("body").on("click", "[data-close=alert]", function () {
                $(this).closest(".alert").hide()
            }), l(), $(".custom-file-input").on("change", function () {
                var t = $(this).val();
                $(this).next(".custom-file-label").addClass("selected").html(t)
            }), r()
        },
        initTooltips: function () {
            a()
        },
        initTooltip: function (t) {
            e(t)
        },
        initPopovers: function () {
            o()
        },
        initPopover: function (t) {
            n(t)
        },
        initPortlet: function (t, e) {
            i(t, e)
        },
        initPortlets: function () {
            l()
        },
        initSticky: function () {
            r()
        },
        initAbsoluteDropdown: function (t) {
            !function (t) {
                var e;
                t && (t.on("show.bs.dropdown", function (t) {
                    e = $(t.target).find(".dropdown-menu"), $("body").append(e.detach()), e.css("display", "block"), e.position({
                        my: "right top",
                        at: "right bottom",
                        of: $(t.relatedTarget)
                    })
                }), t.on("hide.bs.dropdown", function (t) {
                    $(t.target).append(e.detach()), e.hide()
                }))
            }(t)
        },
        block: function (t, e) {
            var a, n = $(t),
                    o = '<div class="kt-spinner ' + ((e = $.extend(!0, {
                        opacity: .03,
                        overlayColor: "#000000",
                        type: "",
                        size: "",
                        state: "brand",
                        centerX: !0,
                        centerY: !0,
                        message: "",
                        shadow: !0,
                        width: "auto"
                    }, e)).type ? "kt-spinner--" + e.type : "") + " " + (e.state ? "kt-spinner--" + e.state : "") + " " + (e.size ? "kt-spinner--" + e.size : "") + '"></div';
            if (e.message && e.message.length > 0) {
                var i = "blockui " + (!1 === e.shadow ? "blockui" : "");
                a = '<div class="' + i + '"><span>' + e.message + "</span><span>" + o + "</span></div>";
                n = document.createElement("div");
                KTUtil.get("body").prepend(n), KTUtil.addClass(n, i), n.innerHTML = "<span>" + e.message + "</span><span>" + o + "</span>", e.width = KTUtil.actualWidth(n) + 10, KTUtil.remove(n), "body" == t && (a = '<div class="' + i + '" style="margin-left:-' + e.width / 2 + 'px;"><span>' + e.message + "</span><span>" + o + "</span></div>")
            } else
                a = o;
            var l = {
                message: a,
                centerY: e.centerY,
                centerX: e.centerX,
                css: {
                    top: "30%",
                    left: "50%",
                    border: "0",
                    padding: "0",
                    backgroundColor: "none",
                    width: e.width
                },
                overlayCSS: {
                    backgroundColor: e.overlayColor,
                    opacity: e.opacity,
                    cursor: "wait",
                    zIndex: "10"
                },
                onUnblock: function () {
                    n && n[0] && (KTUtil.css(n[0], "position", ""), KTUtil.css(n[0], "zoom", ""))
                }
            };
            "body" == t ? (l.css.top = "50%", $.blockUI(l)) : (n = $(t)).block(l)
        },
        unblock: function (t) {
            t && "body" != t ? $(t).unblock() : $.unblockUI()
        },
        blockPage: function (t) {
            return KTApp.block("body", t)
        },
        unblockPage: function () {
            return KTApp.unblock("body")
        },
        progress: function (t, e) {
            var a = "kt-loader kt-loader--" + (e && e.skin ? e.skin : "light") + " kt-loader--" + (e && e.alignment ? e.alignment : "right") + " kt-loader--" + (e && e.size ? "kt-spinner--" + e.size : "");
            KTApp.unprogress(t), $(t).addClass(a), $(t).data("progress-classes", a)
        },
        unprogress: function (t) {
            $(t).removeClass($(t).data("progress-classes"))
        },
        getStateColor: function (e) {
            return t.state[e]
        },
        getBaseColor: function (e, a) {
            return t.base[e][a - 1]
        }
    }
}();
$(document).ready(function () {
    KTApp.init(KTAppOptions)
}),
        function (e) {
            var a = "KTDatatable",
                    n = KTUtil,
                    o = KTApp;
            if (void 0 === n)
                throw new Error("Util class is required and must be included before KTDatatable");
            e.fn.KTDatatable = function (i) {
                if (0 !== e(this).length) {
                    var l = this;
                    l.debug = !1, l.API = {
                        record: null,
                        value: null,
                        params: null
                    };
                    var r = {
                        isInit: !1,
                        cellOffset: 110,
                        iconOffset: 15,
                        stateId: "meta",
                        ajaxParams: {},
                        pagingObject: {},
                        init: function (t) {
                            var a, n = !1;
                            null === t.data.source && (r.extractTable(), n = !0), r.setupBaseDOM.call(), r.setupDOM(l.table), r.setDataSourceQuery(r.getOption("data.source.read.params.query")), e(l).on("kt-datatable--on-layout-updated", r.afterRender), l.debug && r.stateRemove(r.stateId), e.each(r.getOption("extensions"), function (t, a) {
                                "function" == typeof e.fn.KTDatatable[t] && new e.fn.KTDatatable[t](l, a)
                            }), "remote" !== t.data.type && "local" !== t.data.type || ((!1 === t.data.saveState || !1 === t.data.saveState.cookie && !1 === t.data.saveState.webstorage) && r.stateRemove(r.stateId), "local" === t.data.type && "object" == typeof t.data.source && (l.dataSet = l.originalDataSet = r.dataMapCallback(t.data.source)), r.dataRender()), n && (e(l.tableHead).find("tr").remove(), e(l.tableFoot).find("tr").remove()), r.setHeadTitle(), r.getOption("layout.footer") && r.setHeadTitle(l.tableFoot), void 0 !== t.layout.header && !1 === t.layout.header && e(l.table).find("thead").remove(), void 0 !== t.layout.footer && !1 === t.layout.footer && e(l.table).find("tfoot").remove(), null !== t.data.type && "local" !== t.data.type || (r.setupCellField.call(), r.setupTemplateCell.call(), r.setupSubDatatable.call(), r.setupSystemColumn.call(), r.redraw());
                            var o = !1;
                            return e(window).resize(function () {
                                o || (a = e(this).width(), o = !0), e(this).width() !== a && (a = e(this).width(), r.fullRender())
                            }), e(l).height(""), e(r.getOption("search.input")).on("keyup", function (t) {
                                r.getOption("search.onEnter") && 13 !== t.which || r.search(e(this).val())
                            }), l
                        },
                        extractTable: function () {
                            var t = [],
                                    a = e(l).find("tr:first-child th").get().map(function (a, n) {
                                var o = e(a).data("field");
                                void 0 === o && (o = e(a).text().trim());
                                var l = {
                                    field: o,
                                    title: o
                                };
                                for (var r in i.columns)
                                    i.columns[r].field === o && (l = e.extend(!0, {}, i.columns[r], l));
                                return t.push(l), o
                            });
                            i.columns = t;
                            var o = [],
                                    r = [];
                            e(l).find("tr").each(function () {
                                e(this).find("td").length && o.push(e(this).prop("attributes"));
                                var t = {};
                                e(this).find("td").each(function (e, n) {
                                    t[a[e]] = n.innerHTML.trim()
                                }), n.isEmpty(t) || r.push(t)
                            }), i.data.attr.rowProps = o, i.data.source = r
                        },
                        layoutUpdate: function () {
                            r.setupSubDatatable.call(), r.setupSystemColumn.call(), r.setupHover.call(), void 0 === i.detail && 1 === r.getDepth() && r.lockTable.call(), r.columnHide.call(), r.resetScroll(), r.isLocked() || (r.redraw.call(), r.isSubtable() || !0 !== r.getOption("rows.autoHide") || r.autoHide(), e(l.table).find(".kt-datatable__row").css("height", "")), r.rowEvenOdd.call(), r.sorting.call(), r.scrollbar.call(), r.isInit || (r.dropdownFix(), e(l).trigger("kt-datatable--on-init", {
                                table: e(l.wrap).attr("id"),
                                options: i
                            }), r.isInit = !0), e(l).trigger("kt-datatable--on-layout-updated", {
                                table: e(l.wrap).attr("id")
                            })
                        },
                        lockTable: function () {
                            var t = {
                                lockEnabled: !1,
                                init: function () {
                                    t.lockEnabled = r.lockEnabledColumns(), 0 === t.lockEnabled.left.length && 0 === t.lockEnabled.right.length || t.enable()
                                },
                                enable: function () {
                                    e(l.table).find("thead,tbody,tfoot").each(function () {
                                        var a = this;
                                        0 === e(this).find(".kt-datatable__lock").length && e(this).ready(function () {
                                            !function (a) {
                                                if (e(a).find(".kt-datatable__lock").length > 0)
                                                    r.log("Locked container already exist in: ", a);
                                                else if (0 !== e(a).find(".kt-datatable__row").length) {
                                                    var n = e("<div/>").addClass("kt-datatable__lock kt-datatable__lock--left"),
                                                            o = e("<div/>").addClass("kt-datatable__lock kt-datatable__lock--scroll"),
                                                            i = e("<div/>").addClass("kt-datatable__lock kt-datatable__lock--right");
                                                    e(a).find(".kt-datatable__row").each(function () {
                                                        var t = e("<tr/>").addClass("kt-datatable__row").data("obj", e(this).data("obj")).appendTo(n),
                                                                a = e("<tr/>").addClass("kt-datatable__row").data("obj", e(this).data("obj")).appendTo(o),
                                                                l = e("<tr/>").addClass("kt-datatable__row").data("obj", e(this).data("obj")).appendTo(i);
                                                        e(this).find(".kt-datatable__cell").each(function () {
                                                            var n = e(this).data("locked");
                                                            void 0 !== n ? (void 0 === n.left && !0 !== n || e(this).appendTo(t), void 0 !== n.right && e(this).appendTo(l)) : e(this).appendTo(a)
                                                        }), e(this).remove()
                                                    }), t.lockEnabled.left.length > 0 && (e(l.wrap).addClass("kt-datatable--lock"), e(n).appendTo(a)), (t.lockEnabled.left.length > 0 || t.lockEnabled.right.length > 0) && e(o).appendTo(a), t.lockEnabled.right.length > 0 && (e(l.wrap).addClass("kt-datatable--lock"), e(i).appendTo(a))
                                                } else
                                                    r.log("No row exist in: ", a)
                                            }(a)
                                        })
                                    })
                                }
                            };
                            return t.init(), t
                        },
                        fullRender: function () {
                            e(l.tableHead).empty(), r.setHeadTitle(), r.getOption("layout.footer") && (e(l.tableFoot).empty(), r.setHeadTitle(l.tableFoot)), r.spinnerCallback(!0), e(l.wrap).removeClass("kt-datatable--loaded"), r.insertData()
                        },
                        lockEnabledColumns: function () {
                            var t = e(window).width(),
                                    a = i.columns,
                                    o = {
                                        left: [],
                                        right: []
                                    };
                            return e.each(a, function (e, a) {
                                void 0 !== a.locked && (void 0 !== a.locked.left && n.getBreakpoint(a.locked.left) <= t && o.left.push(a.locked.left), void 0 !== a.locked.right && n.getBreakpoint(a.locked.right) <= t && o.right.push(a.locked.right))
                            }), o
                        },
                        afterRender: function (t, a) {
                            e(l).ready(function () {
                                r.isLocked() && r.redraw(), e(l.tableBody).css("visibility", ""), e(l.wrap).addClass("kt-datatable--loaded"), r.spinnerCallback(!1)
                            })
                        },
                        dropdownFix: function () {
                            var t;
                            e("body").on("show.bs.dropdown", ".kt-datatable .kt-datatable__body", function (a) {
                                t = e(a.target).find(".dropdown-menu"), e("body").append(t.detach()), t.css("display", "block"), t.position({
                                    my: "right top",
                                    at: "right bottom",
                                    of: e(a.relatedTarget)
                                }), l.closest(".modal").length && t.css("z-index", "2000")
                            }).on("hide.bs.dropdown", ".kt-datatable .kt-datatable__body", function (a) {
                                e(a.target).append(t.detach()), t.hide()
                            })
                        },
                        hoverTimer: 0,
                        isScrolling: !1,
                        setupHover: function () {
                            e(window).scroll(function (t) {
                                clearTimeout(r.hoverTimer), r.isScrolling = !0
                            }), e(l.tableBody).find(".kt-datatable__cell").off("mouseenter", "mouseleave").on("mouseenter", function () {
                                if (r.hoverTimer = setTimeout(function () {
                                    r.isScrolling = !1
                                }, 200), !r.isScrolling) {
                                    var t = e(this).closest(".kt-datatable__row").addClass("kt-datatable__row--hover"),
                                            a = e(t).index() + 1;
                                    e(t).closest(".kt-datatable__lock").parent().find(".kt-datatable__row:nth-child(" + a + ")").addClass("kt-datatable__row--hover")
                                }
                            }).on("mouseleave", function () {
                                var t = e(this).closest(".kt-datatable__row").removeClass("kt-datatable__row--hover"),
                                        a = e(t).index() + 1;
                                e(t).closest(".kt-datatable__lock").parent().find(".kt-datatable__row:nth-child(" + a + ")").removeClass("kt-datatable__row--hover")
                            })
                        },
                        adjustLockContainer: function () {
                            if (!r.isLocked())
                                return 0;
                            var t = e(l.tableHead).width(),
                                    a = e(l.tableHead).find(".kt-datatable__lock--left").width(),
                                    n = e(l.tableHead).find(".kt-datatable__lock--right").width();
                            void 0 === a && (a = 0), void 0 === n && (n = 0);
                            var o = Math.floor(t - a - n);
                            return e(l.table).find(".kt-datatable__lock--scroll").css("width", o), o
                        },
                        dragResize: function () {
                            var t, a, n = !1,
                                    o = void 0;
                            e(l.tableHead).find(".kt-datatable__cell").mousedown(function (i) {
                                o = e(this), n = !0, t = i.pageX, a = e(this).width(), e(o).addClass("kt-datatable__cell--resizing")
                            }).mousemove(function (i) {
                                if (n) {
                                    var r = e(o).index(),
                                            s = e(l.tableBody),
                                            d = e(o).closest(".kt-datatable__lock");
                                    if (d) {
                                        var c = e(d).index();
                                        s = e(l.tableBody).find(".kt-datatable__lock").eq(c)
                                    }
                                    e(s).find(".kt-datatable__row").each(function (n, o) {
                                        e(o).find(".kt-datatable__cell").eq(r).width(a + (i.pageX - t)).children().width(a + (i.pageX - t))
                                    }), e(o).children().css("width", a + (i.pageX - t))
                                }
                            }).mouseup(function () {
                                e(o).removeClass("kt-datatable__cell--resizing"), n = !1
                            }), e(document).mouseup(function () {
                                e(o).removeClass("kt-datatable__cell--resizing"), n = !1
                            })
                        },
                        initHeight: function () {
                            if (i.layout.height && i.layout.scroll) {
                                var t = e(l.tableHead).find(".kt-datatable__row").outerHeight(),
                                        a = e(l.tableFoot).find(".kt-datatable__row").outerHeight(),
                                        n = i.layout.height;
                                t > 0 && (n -= t), a > 0 && (n -= a), n -= 2, e(l.tableBody).css("max-height", n), e(l.tableBody).find(".kt-datatable__lock--scroll").css("height", n)
                            }
                        },
                        setupBaseDOM: function () {
                            l.initialDatatable = e(l).clone(), "TABLE" === e(l).prop("tagName") ? (l.table = e(l).removeClass("kt-datatable").addClass("kt-datatable__table"), 0 === e(l.table).parents(".kt-datatable").length && (l.table.wrap(e("<div/>").addClass("kt-datatable").addClass("kt-datatable--" + i.layout.theme)), l.wrap = e(l.table).parent())) : (l.wrap = e(l).addClass("kt-datatable").addClass("kt-datatable--" + i.layout.theme), l.table = e("<table/>").addClass("kt-datatable__table").appendTo(l)), void 0 !== i.layout.class && e(l.wrap).addClass(i.layout.class), e(l.table).removeClass("kt-datatable--destroyed").css("display", "block"), void 0 === e(l).attr("id") && (r.setOption("data.saveState", !1), e(l.table).attr("id", n.getUniqueID("kt-datatable--"))), r.getOption("layout.minHeight") && e(l.table).css("min-height", r.getOption("layout.minHeight")), r.getOption("layout.height") && e(l.table).css("max-height", r.getOption("layout.height")), null === i.data.type && e(l.table).css("width", "").css("display", ""), l.tableHead = e(l.table).find("thead"), 0 === e(l.tableHead).length && (l.tableHead = e("<thead/>").prependTo(l.table)), l.tableBody = e(l.table).find("tbody"), 0 === e(l.tableBody).length && (l.tableBody = e("<tbody/>").appendTo(l.table)), void 0 !== i.layout.footer && i.layout.footer && (l.tableFoot = e(l.table).find("tfoot"), 0 === e(l.tableFoot).length && (l.tableFoot = e("<tfoot/>").appendTo(l.table)))
                        },
                        setupCellField: function (t) {
                            void 0 === t && (t = e(l.table).children());
                            var a = i.columns;
                            e.each(t, function (t, n) {
                                e(n).find(".kt-datatable__row").each(function (t, n) {
                                    e(n).find(".kt-datatable__cell").each(function (t, n) {
                                        void 0 !== a[t] && e(n).data(a[t])
                                    })
                                })
                            })
                        },
                        setupTemplateCell: function (t) {
                            void 0 === t && (t = l.tableBody);
                            var a = i.columns;
                            e(t).find(".kt-datatable__row").each(function (t, n) {
                                var o = e(n).data("obj");
                                if (void 0 !== o) {
                                    var i = r.getOption("rows.callback");
                                    "function" == typeof i && i(e(n), o, t);
                                    var s = r.getOption("rows.beforeTemplate");
                                    "function" == typeof s && s(e(n), o, t), void 0 === o && (o = {}, e(n).find(".kt-datatable__cell").each(function (t, n) {
                                        var i = e.grep(a, function (t, a) {
                                            return e(n).data("field") === t.field
                                        })[0];
                                        void 0 !== i && (o[i.field] = e(n).text())
                                    })), e(n).find(".kt-datatable__cell").each(function (n, i) {
                                        var s = e.grep(a, function (t, a) {
                                            return e(i).data("field") === t.field
                                        })[0];
                                        if (void 0 !== s && void 0 !== s.template) {
                                            var d = "";
                                            "string" == typeof s.template && (d = r.dataPlaceholder(s.template, o)), "function" == typeof s.template && (d = s.template(o, t, l)), "undefined" != typeof DOMPurify && (d = DOMPurify.sanitize(d));
                                            var c = document.createElement("span");
                                            c.innerHTML = d, e(i).html(c), void 0 !== s.overflow && (e(c).css("overflow", s.overflow), e(c).css("position", "relative"))
                                        }
                                    });
                                    var d = r.getOption("rows.afterTemplate");
                                    "function" == typeof d && d(e(n), o, t)
                                }
                            })
                        },
                        setupSystemColumn: function () {
                            if (l.dataSet = l.dataSet || [], 0 !== l.dataSet.length) {
                                var t = i.columns;
                                e(l.tableBody).find(".kt-datatable__row").each(function (a, n) {
                                    e(n).find(".kt-datatable__cell").each(function (a, n) {
                                        var o = e.grep(t, function (t, a) {
                                            return e(n).data("field") === t.field
                                        })[0];
                                        if (void 0 !== o) {
                                            var i = e(n).text();
                                            if (void 0 !== o.selector && !1 !== o.selector) {
                                                if (e(n).find('.kt-checkbox [type="checkbox"]').length > 0)
                                                    return;
                                                e(n).addClass("kt-datatable__cell--check");
                                                var l = e("<label/>").addClass("kt-checkbox kt-checkbox--single").append(e("<input/>").attr("type", "checkbox").attr("value", i).on("click", function () {
                                                    e(this).is(":checked") ? r.setActive(this) : r.setInactive(this)
                                                })).append("&nbsp;<span></span>");
                                                void 0 !== o.selector.class && e(l).addClass(o.selector.class), e(n).children().html(l)
                                            }
                                            if (void 0 !== o.subtable && o.subtable) {
                                                if (e(n).find(".kt-datatable__toggle-subtable").length > 0)
                                                    return;
                                                e(n).children().html(e("<a/>").addClass("kt-datatable__toggle-subtable").attr("href", "#").attr("data-value", i).append(e("<i/>").addClass(r.getOption("layout.icons.rowDetail.collapse"))))
                                            }
                                        }
                                    })
                                });
                                var a = function (a) {
                                    var n = e.grep(t, function (t, e) {
                                        return void 0 !== t.selector && !1 !== t.selector
                                    })[0];
                                    if (void 0 !== n && void 0 !== n.selector && !1 !== n.selector) {
                                        var o = e(a).find('[data-field="' + n.field + '"]');
                                        if (e(o).find('.kt-checkbox [type="checkbox"]').length > 0)
                                            return;
                                        e(o).addClass("kt-datatable__cell--check");
                                        var i = e("<label/>").addClass("kt-checkbox kt-checkbox--single kt-checkbox--all").append(e("<input/>").attr("type", "checkbox").on("click", function () {
                                            e(this).is(":checked") ? r.setActiveAll(!0) : r.setActiveAll(!1)
                                        })).append("&nbsp;<span></span>");
                                        void 0 !== n.selector.class && e(i).addClass(n.selector.class), e(o).children().html(i)
                                    }
                                };
                                i.layout.header && a(e(l.tableHead).find(".kt-datatable__row").first()), i.layout.footer && a(e(l.tableFoot).find(".kt-datatable__row").first())
                            }
                        },
                        adjustCellsWidth: function () {
                            var t = e(l.tableBody).innerWidth() - r.iconOffset,
                                    a = e(l.tableBody).find(".kt-datatable__row:first-child").find(".kt-datatable__cell").not(".kt-datatable__toggle-detail").not(":hidden").length;
                            if (a > 0) {
                                t -= r.iconOffset * a;
                                var n = Math.floor(t / a);
                                n <= r.cellOffset && (n = r.cellOffset);
                                var o = {};
                                e(l.table).find(".kt-datatable__row").find(".kt-datatable__cell").not(".kt-datatable__toggle-detail").not(":hidden").each(function (t, a) {
                                    var i = n,
                                            r = e(a).data("width");
                                    if (void 0 !== r)
                                        if ("auto" === r) {
                                            var s = e(a).data("field");
                                            if (o[s])
                                                i = o[s];
                                            else {
                                                var d = e(l.table).find('.kt-datatable__cell[data-field="' + s + '"]');
                                                i = o[s] = Math.max.apply(null, e(d).map(function () {
                                                    return e(this).outerWidth()
                                                }).get())
                                            }
                                        } else
                                            i = r;
                                    e(a).children().css("width", Math.ceil(i))
                                })
                            }
                            return l
                        },
                        adjustCellsHeight: function () {
                            e.each(e(l.table).children(), function (t, a) {
                                for (var n = e(a).find(".kt-datatable__row").first().parent().find(".kt-datatable__row").length, o = 1; o <= n; o++) {
                                    var i = e(a).find(".kt-datatable__row:nth-child(" + o + ")");
                                    if (e(i).length > 0) {
                                        var l = Math.max.apply(null, e(i).map(function () {
                                            return e(this).outerHeight()
                                        }).get());
                                        e(i).css("height", Math.ceil(l))
                                    }
                                }
                            })
                        },
                        setupDOM: function (t) {
                            e(t).find("> thead").addClass("kt-datatable__head"), e(t).find("> tbody").addClass("kt-datatable__body"), e(t).find("> tfoot").addClass("kt-datatable__foot"), e(t).find("tr").addClass("kt-datatable__row"), e(t).find("tr > th, tr > td").addClass("kt-datatable__cell"), e(t).find("tr > th, tr > td").each(function (t, a) {
                                0 === e(a).find("span").length && e(a).wrapInner(e("<span/>").css("width", r.cellOffset))
                            })
                        },
                        scrollbar: function () {
                            var t = {
                                scrollable: null,
                                tableLocked: null,
                                initPosition: null,
                                init: function () {
                                    var a = n.getViewPort().width;
                                    if (i.layout.scroll) {
                                        e(l.wrap).addClass("kt-datatable--scroll");
                                        var o = e(l.tableBody).find(".kt-datatable__lock--scroll");
                                        e(o).find(".kt-datatable__row").length > 0 && e(o).length > 0 ? (t.scrollHead = e(l.tableHead).find("> .kt-datatable__lock--scroll > .kt-datatable__row"), t.scrollFoot = e(l.tableFoot).find("> .kt-datatable__lock--scroll > .kt-datatable__row"), t.tableLocked = e(l.tableBody).find(".kt-datatable__lock:not(.kt-datatable__lock--scroll)"), r.getOption("layout.customScrollbar") && 10 != n.detectIE() && a > n.getBreakpoint("lg") ? t.initCustomScrollbar(o[0]) : t.initDefaultScrollbar(o)) : e(l.tableBody).find(".kt-datatable__row").length > 0 && (t.scrollHead = e(l.tableHead).find("> .kt-datatable__row"), t.scrollFoot = e(l.tableFoot).find("> .kt-datatable__row"), r.getOption("layout.customScrollbar") && 10 != n.detectIE() && a > n.getBreakpoint("lg") ? t.initCustomScrollbar(l.tableBody) : t.initDefaultScrollbar(l.tableBody))
                                    }
                                },
                                initDefaultScrollbar: function (a) {
                                    t.initPosition = e(a).scrollLeft(), e(a).css("overflow-y", "auto").off().on("scroll", t.onScrolling), !0 !== r.getOption("rows.autoHide") && e(a).css("overflow-x", "auto")
                                },
                                onScrolling: function (a) {
                                    var o = e(this).scrollLeft(),
                                            i = e(this).scrollTop();
                                    n.isRTL() && (o -= t.initPosition), e(t.scrollHead).css("left", -o), e(t.scrollFoot).css("left", -o), e(t.tableLocked).each(function (t, a) {
                                        r.isLocked() && (i -= 1), e(a).css("top", -i)
                                    })
                                },
                                initCustomScrollbar: function (a) {
                                    t.scrollable = a, r.initScrollbar(a), t.initPosition = e(a).scrollLeft(), e(a).off().on("scroll", t.onScrolling)
                                }
                            };
                            return t.init(), t
                        },
                        initScrollbar: function (t, a) {
                            if (t && t.nodeName)
                                if (e(l.tableBody).css("overflow", ""), n.hasClass(t, "ps"))
                                    e(t).data("ps").update();
                                else {
                                    var o = new PerfectScrollbar(t, Object.assign({}, {
                                        wheelSpeed: .5,
                                        swipeEasing: !0,
                                        minScrollbarLength: 40,
                                        maxScrollbarLength: 300,
                                        suppressScrollX: r.getOption("rows.autoHide") && !r.isLocked()
                                    }, a));
                                    e(t).data("ps", o), e(window).resize(function () {
                                        o.update()
                                    })
                                }
                        },
                        setHeadTitle: function (t) {
                            void 0 === t && (t = l.tableHead), t = e(t)[0];
                            var a = i.columns,
                                    o = t.getElementsByTagName("tr")[0],
                                    s = t.getElementsByTagName("td");
                            void 0 === o && (o = document.createElement("tr"), t.appendChild(o)), e.each(a, function (t, a) {
                                var i = s[t];
                                if (void 0 === i && (i = document.createElement("th"), o.appendChild(i)), void 0 !== a.title && (i.innerHTML = a.title, i.setAttribute("data-field", a.field), n.addClass(i, a.class), void 0 !== a.autoHide && (!0 !== a.autoHide ? i.setAttribute("data-autohide-disabled", a.autoHide) : i.setAttribute("data-autohide-enabled", a.autoHide)), e(i).data(a)), void 0 !== a.attr && e.each(a.attr, function (t, e) {
                                    i.setAttribute(t, e)
                                }), void 0 !== a.textAlign) {
                                    var r = void 0 !== l.textAlign[a.textAlign] ? l.textAlign[a.textAlign] : "";
                                    n.addClass(i, r)
                                }
                            }), r.setupDOM(t)
                        },
                        dataRender: function (t) {
                            e(l.table).siblings(".kt-datatable__pager").removeClass("kt-datatable--paging-loaded");
                            var a = function () {
                                l.dataSet = l.dataSet || [], r.localDataUpdate();
                                var t = r.getDataSourceParam("pagination");
                                0 === t.perpage && (t.perpage = i.data.pageSize || 10), t.total = l.dataSet.length;
                                var a = Math.max(t.perpage * (t.page - 1), 0),
                                        n = Math.min(a + t.perpage, t.total);
                                return l.dataSet = e(l.dataSet).slice(a, n), t
                            },
                                    n = function (t) {
                                        var n = function (t, a) {
                                            e(t.pager).hasClass("kt-datatable--paging-loaded") || (e(t.pager).remove(), t.init(a)), e(t.pager).off().on("kt-datatable--on-goto-page", function (n) {
                                                e(t.pager).remove(), t.init(a)
                                            });
                                            var n = Math.max(a.perpage * (a.page - 1), 0),
                                                    o = Math.min(n + a.perpage, a.total);
                                            r.localDataUpdate(), l.dataSet = e(l.dataSet).slice(n, o), r.insertData()
                                        };
                                        if (e(l.wrap).removeClass("kt-datatable--error"), i.pagination)
                                            if (i.data.serverPaging && "local" !== i.data.type) {
                                                var o = r.getObject("meta", t || null);
                                                r.pagingObject = null !== o ? r.paging(o) : r.paging(a(), n)
                                            } else
                                                r.pagingObject = r.paging(a(), n);
                                        else
                                            r.localDataUpdate();
                                        r.insertData()
                                    };
                            "local" === i.data.type || !1 === i.data.serverSorting && "sort" === t || !1 === i.data.serverFiltering && "search" === t ? setTimeout(function () {
                                n(), r.setAutoColumns()
                            }) : r.getData().done(n)
                        },
                        insertData: function () {
                            l.dataSet = l.dataSet || [];
                            var t = r.getDataSourceParam(),
                                    a = t.pagination,
                                    o = (Math.max(a.page, 1) - 1) * a.perpage,
                                    s = Math.min(a.page, a.pages) * a.perpage,
                                    d = {};
                            void 0 !== i.data.attr.rowProps && i.data.attr.rowProps.length && (d = i.data.attr.rowProps.slice(o, s));
                            var c = document.createElement("tbody");
                            c.style.visibility = "hidden";
                            var u = i.columns.length;
                            if (e.each(l.dataSet, function (a, o) {
                                var s = document.createElement("tr");
                                s.setAttribute("data-row", a), e(s).data("obj", o), void 0 !== d[a] && e.each(d[a], function () {
                                    s.setAttribute(this.name, this.value)
                                });
                                for (var p = 0; p < u; p += 1) {
                                    var f = i.columns[p],
                                            g = [];
                                    if (r.getObject("sort.field", t) === f.field && g.push("kt-datatable__cell--sorted"), void 0 !== f.textAlign) {
                                        var v = void 0 !== l.textAlign[f.textAlign] ? l.textAlign[f.textAlign] : "";
                                        g.push(v)
                                    }
                                    void 0 !== f.class && g.push(f.class);
                                    var h = document.createElement("td");
                                    n.addClass(h, g.join(" ")), h.setAttribute("data-field", f.field), void 0 !== f.autoHide && (!0 !== f.autoHide ? h.setAttribute("data-autohide-disabled", f.autoHide) : h.setAttribute("data-autohide-enabled", f.autoHide)), h.innerHTML = r.getObject(f.field, o), s.appendChild(h)
                                }
                                c.appendChild(s)
                            }), 0 === l.dataSet.length) {
                                var p = document.createElement("span");
                                n.addClass(p, "kt-datatable--error"), p.innerHTML = r.getOption("translate.records.noRecords"), c.appendChild(p), e(l.wrap).addClass("kt-datatable--error kt-datatable--loaded"), r.spinnerCallback(!1)
                            }
                            e(l.tableBody).replaceWith(c), l.tableBody = c, r.setupDOM(l.table), r.setupCellField([l.tableBody]), r.setupTemplateCell(l.tableBody), r.layoutUpdate()
                        },
                        updateTableComponents: function () {
                            l.tableHead = e(l.table).children("thead"), l.tableBody = e(l.table).children("tbody"), l.tableFoot = e(l.table).children("tfoot")
                        },
                        getData: function () {
                            var t = {
                                dataType: "json",
                                method: "POST",
                                data: {},
                                timeout: r.getOption("data.source.read.timeout") || 3e4
                            };
                            if ("local" === i.data.type && (t.url = i.data.source), "remote" === i.data.type) {
                                var a = r.getDataSourceParam();
                                r.getOption("data.serverPaging") || delete a.pagination, r.getOption("data.serverSorting") || delete a.sort, t.data = e.extend({}, t.data, a, r.getOption("data.source.read.params")), "string" != typeof (t = e.extend({}, t, r.getOption("data.source.read"))).url && (t.url = r.getOption("data.source.read")), "string" != typeof t.url && (t.url = r.getOption("data.source"))
                            }
                            return e.ajax(t).done(function (t, a, n) {
                                l.lastResponse = t, l.dataSet = l.originalDataSet = r.dataMapCallback(t), r.setAutoColumns(), e(l).trigger("kt-datatable--on-ajax-done", [l.dataSet])
                            }).fail(function (t, a, n) {
                                e(l).trigger("kt-datatable--on-ajax-fail", [t]), e(l.tableBody).html(e("<span/>").addClass("kt-datatable--error").html(r.getOption("translate.records.noRecords"))), e(l.wrap).addClass("kt-datatable--error kt-datatable--loaded"), r.spinnerCallback(!1)
                            }).always(function () {})
                        },
                        paging: function (t, a) {
                            var o = {
                                meta: null,
                                pager: null,
                                paginateEvent: null,
                                pagerLayout: {
                                    pagination: null,
                                    info: null
                                },
                                callback: null,
                                init: function (t) {
                                    o.meta = t, o.meta.page = parseInt(o.meta.page), o.meta.pages = parseInt(o.meta.pages), o.meta.perpage = parseInt(o.meta.perpage), o.meta.total = parseInt(o.meta.total), o.meta.pages = Math.max(Math.ceil(o.meta.total / o.meta.perpage), 1), o.meta.page > o.meta.pages && (o.meta.page = o.meta.pages), o.paginateEvent = r.getTablePrefix(), o.pager = e(l.table).siblings(".kt-datatable__pager"), e(o.pager).hasClass("kt-datatable--paging-loaded") || (e(o.pager).remove(), 0 !== o.meta.pages && (r.setDataSourceParam("pagination", {
                                        page: o.meta.page,
                                        pages: o.meta.pages,
                                        perpage: o.meta.perpage,
                                        total: o.meta.total
                                    }), o.callback = o.serverCallback, "function" == typeof a && (o.callback = a), o.addPaginateEvent(), o.populate(), o.meta.page = Math.max(o.meta.page || 1, o.meta.page), e(l).trigger(o.paginateEvent, o.meta), o.pagingBreakpoint.call(), e(window).resize(o.pagingBreakpoint)))
                                },
                                serverCallback: function (t, e) {
                                    r.dataRender()
                                },
                                populate: function () {
                                    var t = r.getOption("layout.icons.pagination"),
                                            a = r.getOption("translate.toolbar.pagination.items.default");
                                    o.pager = e("<div/>").addClass("kt-datatable__pager kt-datatable--paging-loaded");
                                    var n = e("<ul/>").addClass("kt-datatable__pager-nav");
                                    o.pagerLayout.pagination = n, e("<li/>").append(e("<a/>").attr("title", a.first).addClass("kt-datatable__pager-link kt-datatable__pager-link--first").append(e("<i/>").addClass(t.first)).on("click", o.gotoMorePage).attr("data-page", 1)).appendTo(n), e("<li/>").append(e("<a/>").attr("title", a.prev).addClass("kt-datatable__pager-link kt-datatable__pager-link--prev").append(e("<i/>").addClass(t.prev)).on("click", o.gotoMorePage)).appendTo(n), e("<li/>").append(e("<a/>").attr("title", a.more).addClass("kt-datatable__pager-link kt-datatable__pager-link--more-prev").html(e("<i/>").addClass(t.more)).on("click", o.gotoMorePage)).appendTo(n), e("<li/>").append(e("<input/>").attr("type", "text").addClass("kt-pager-input form-control").attr("title", a.input).on("keyup", function () {
                                        e(this).attr("data-page", Math.abs(e(this).val()))
                                    }).on("keypress", function (t) {
                                        13 === t.which && o.gotoMorePage(t)
                                    })).appendTo(n);
                                    var i = r.getOption("toolbar.items.pagination.pages.desktop.pagesNumber"),
                                            s = Math.ceil(o.meta.page / i) * i,
                                            d = s - i;
                                    s > o.meta.pages && (s = o.meta.pages);
                                    for (var c = d; c < s; c++) {
                                        var u = c + 1;
                                        e("<li/>").append(e("<a/>").addClass("kt-datatable__pager-link kt-datatable__pager-link-number").text(u).attr("data-page", u).attr("title", u).on("click", o.gotoPage)).appendTo(n)
                                    }
                                    e("<li/>").append(e("<a/>").attr("title", a.more).addClass("kt-datatable__pager-link kt-datatable__pager-link--more-next").html(e("<i/>").addClass(t.more)).on("click", o.gotoMorePage)).appendTo(n), e("<li/>").append(e("<a/>").attr("title", a.next).addClass("kt-datatable__pager-link kt-datatable__pager-link--next").append(e("<i/>").addClass(t.next)).on("click", o.gotoMorePage)).appendTo(n), e("<li/>").append(e("<a/>").attr("title", a.last).addClass("kt-datatable__pager-link kt-datatable__pager-link--last").append(e("<i/>").addClass(t.last)).on("click", o.gotoMorePage).attr("data-page", o.meta.pages)).appendTo(n), r.getOption("toolbar.items.info") && (o.pagerLayout.info = e("<div/>").addClass("kt-datatable__pager-info").append(e("<span/>").addClass("kt-datatable__pager-detail"))), e.each(r.getOption("toolbar.layout"), function (t, a) {
                                        e(o.pagerLayout[a]).appendTo(o.pager)
                                    });
                                    var p = e("<select/>").addClass("selectpicker kt-datatable__pager-size").attr("title", r.getOption("translate.toolbar.pagination.items.default.select")).attr("data-width", "60px").val(o.meta.perpage).on("change", o.updatePerpage).prependTo(o.pagerLayout.info),
                                            f = r.getOption("toolbar.items.pagination.pageSizeSelect");
                                    0 == f.length && (f = [10, 20, 30, 50, 100]), e.each(f, function (t, a) {
                                        var n = a;
                                        -1 === a && (n = r.getOption("translate.toolbar.pagination.items.default.all")), e("<option/>").attr("value", a).html(n).appendTo(p)
                                    }), e(l).ready(function () {
                                        e(".selectpicker").selectpicker().on("hide.bs.select", function () {
                                            e(this).closest(".bootstrap-select").removeClass("dropup")
                                        }).siblings(".dropdown-toggle").attr("title", r.getOption("translate.toolbar.pagination.items.default.select"))
                                    }), o.paste()
                                },
                                paste: function () {
                                    e.each(e.unique(r.getOption("toolbar.placement")), function (t, a) {
                                        "bottom" === a && e(o.pager).clone(!0).insertAfter(l.table), "top" === a && e(o.pager).clone(!0).addClass("kt-datatable__pager--top").insertBefore(l.table)
                                    })
                                },
                                gotoMorePage: function (t) {
                                    if (t.preventDefault(), "disabled" === e(this).attr("disabled"))
                                        return !1;
                                    var a = e(this).attr("data-page");
                                    return void 0 === a && (a = e(t.target).attr("data-page")), o.openPage(parseInt(a)), !1
                                },
                                gotoPage: function (t) {
                                    t.preventDefault(), e(this).hasClass("kt-datatable__pager-link--active") || o.openPage(parseInt(e(this).data("page")))
                                },
                                openPage: function (t) {
                                    o.meta.page = parseInt(t), e(l).trigger(o.paginateEvent, o.meta), o.callback(o, o.meta), e(o.pager).trigger("kt-datatable--on-goto-page", o.meta)
                                },
                                updatePerpage: function (t) {
                                    t.preventDefault(), o.pager = e(l.table).siblings(".kt-datatable__pager").removeClass("kt-datatable--paging-loaded"), t.originalEvent && (o.meta.perpage = parseInt(e(this).val())), e(o.pager).find("select.kt-datatable__pager-size").val(o.meta.perpage).attr("data-selected", o.meta.perpage), r.setDataSourceParam("pagination", {
                                        page: o.meta.page,
                                        pages: o.meta.pages,
                                        perpage: o.meta.perpage,
                                        total: o.meta.total
                                    }), e(o.pager).trigger("kt-datatable--on-update-perpage", o.meta), e(l).trigger(o.paginateEvent, o.meta), o.callback(o, o.meta), o.updateInfo.call()
                                },
                                addPaginateEvent: function (t) {
                                    e(l).off(o.paginateEvent).on(o.paginateEvent, function (t, a) {
                                        r.spinnerCallback(!0), o.pager = e(l.table).siblings(".kt-datatable__pager");
                                        var n = e(o.pager).find(".kt-datatable__pager-nav");
                                        e(n).find(".kt-datatable__pager-link--active").removeClass("kt-datatable__pager-link--active"), e(n).find('.kt-datatable__pager-link-number[data-page="' + a.page + '"]').addClass("kt-datatable__pager-link--active"), e(n).find(".kt-datatable__pager-link--prev").attr("data-page", Math.max(a.page - 1, 1)), e(n).find(".kt-datatable__pager-link--next").attr("data-page", Math.min(a.page + 1, a.pages)), e(o.pager).each(function () {
                                            e(this).find('.kt-pager-input[type="text"]').prop("value", a.page)
                                        }), e(o.pager).find(".kt-datatable__pager-nav").show(), a.pages <= 1 && e(o.pager).find(".kt-datatable__pager-nav").hide(), r.setDataSourceParam("pagination", {
                                            page: o.meta.page,
                                            pages: o.meta.pages,
                                            perpage: o.meta.perpage,
                                            total: o.meta.total
                                        }), e(o.pager).find("select.kt-datatable__pager-size").val(a.perpage).attr("data-selected", a.perpage), e(l.table).find('.kt-checkbox > [type="checkbox"]').prop("checked", !1), e(l.table).find(".kt-datatable__row--active").removeClass("kt-datatable__row--active"), o.updateInfo.call(), o.pagingBreakpoint.call()
                                    })
                                },
                                updateInfo: function () {
                                    var t = Math.max(o.meta.perpage * (o.meta.page - 1) + 1, 1),
                                            a = Math.min(t + o.meta.perpage - 1, o.meta.total);
                                    e(o.pager).find(".kt-datatable__pager-info").find(".kt-datatable__pager-detail").html(r.dataPlaceholder(r.getOption("translate.toolbar.pagination.items.info"), {
                                        start: t,
                                        end: -1 === o.meta.perpage ? o.meta.total : a,
                                        pageSize: -1 === o.meta.perpage || o.meta.perpage >= o.meta.total ? o.meta.total : o.meta.perpage,
                                        total: o.meta.total
                                    }))
                                },
                                pagingBreakpoint: function () {
                                    var t = e(l.table).siblings(".kt-datatable__pager").find(".kt-datatable__pager-nav");
                                    if (0 !== e(t).length) {
                                        var a = r.getCurrentPage(),
                                                i = e(t).find(".kt-pager-input").closest("li");
                                        e(t).find("li").show(), e.each(r.getOption("toolbar.items.pagination.pages"), function (l, s) {
                                            if (n.isInResponsiveRange(l)) {
                                                switch (l) {
                                                    case "desktop":
                                                    case "tablet":
                                                        Math.ceil(a / s.pagesNumber), s.pagesNumber, s.pagesNumber;
                                                        e(i).hide(), o.meta = r.getDataSourceParam("pagination"), o.paginationUpdate();
                                                        break;
                                                    case "mobile":
                                                        e(i).show(), e(t).find(".kt-datatable__pager-link--more-prev").closest("li").hide(), e(t).find(".kt-datatable__pager-link--more-next").closest("li").hide(), e(t).find(".kt-datatable__pager-link-number").closest("li").hide()
                                                }
                                                return !1
                                            }
                                        })
                                    }
                                },
                                paginationUpdate: function () {
                                    var t = e(l.table).siblings(".kt-datatable__pager").find(".kt-datatable__pager-nav"),
                                            a = e(t).find(".kt-datatable__pager-link--more-prev"),
                                            n = e(t).find(".kt-datatable__pager-link--more-next"),
                                            i = e(t).find(".kt-datatable__pager-link--first"),
                                            s = e(t).find(".kt-datatable__pager-link--prev"),
                                            d = e(t).find(".kt-datatable__pager-link--next"),
                                            c = e(t).find(".kt-datatable__pager-link--last"),
                                            u = e(t).find(".kt-datatable__pager-link-number"),
                                            p = Math.max(e(u).first().data("page") - 1, 1);
                                    e(a).each(function (t, a) {
                                        e(a).attr("data-page", p)
                                    }), 1 === p ? e(a).parent().hide() : e(a).parent().show();
                                    var f = Math.min(e(u).last().data("page") + 1, o.meta.pages);
                                    e(n).each(function (t, a) {
                                        e(n).attr("data-page", f).show()
                                    }), f === o.meta.pages && f === e(u).last().data("page") ? e(n).parent().hide() : e(n).parent().show(), 1 === o.meta.page ? (e(i).attr("disabled", !0).addClass("kt-datatable__pager-link--disabled"), e(s).attr("disabled", !0).addClass("kt-datatable__pager-link--disabled")) : (e(i).removeAttr("disabled").removeClass("kt-datatable__pager-link--disabled"), e(s).removeAttr("disabled").removeClass("kt-datatable__pager-link--disabled")), o.meta.page === o.meta.pages ? (e(d).attr("disabled", !0).addClass("kt-datatable__pager-link--disabled"), e(c).attr("disabled", !0).addClass("kt-datatable__pager-link--disabled")) : (e(d).removeAttr("disabled").removeClass("kt-datatable__pager-link--disabled"), e(c).removeAttr("disabled").removeClass("kt-datatable__pager-link--disabled"));
                                    var g = r.getOption("toolbar.items.pagination.navigation");
                                    g.first || e(i).remove(), g.prev || e(s).remove(), g.next || e(d).remove(), g.last || e(c).remove()
                                }
                            };
                            return o.init(t), o
                        },
                        columnHide: function () {
                            var t = n.getViewPort().width;
                            e.each(i.columns, function (a, o) {
                                if (void 0 !== o.responsive) {
                                    var i = o.field,
                                            r = e.grep(e(l.table).find(".kt-datatable__cell"), function (t, a) {
                                                return i === e(t).data("field")
                                            });
                                    n.getBreakpoint(o.responsive.hidden) >= t ? e(r).hide() : e(r).show(), n.getBreakpoint(o.responsive.visible) <= t ? e(r).show() : e(r).hide()
                                }
                            })
                        },
                        setupSubDatatable: function () {
                            var t = r.getOption("detail.content");
                            if ("function" == typeof t && !(e(l.table).find(".kt-datatable__subtable").length > 0)) {
                                e(l.wrap).addClass("kt-datatable--subtable"), i.columns[0].subtable = !0;
                                var a = function (a) {
                                    a.preventDefault();
                                    var n = e(this).closest(".kt-datatable__row"),
                                            o = e(n).next(".kt-datatable__row-subtable");
                                    0 === e(o).length && (o = e("<tr/>").addClass("kt-datatable__row-subtable kt-datatable__row-loading").hide().append(e("<td/>").addClass("kt-datatable__subtable").attr("colspan", r.getTotalColumns())), e(n).after(o), e(n).hasClass("kt-datatable__row--even") && e(o).addClass("kt-datatable__row-subtable--even")), e(o).toggle();
                                    var s = e(o).find(".kt-datatable__subtable"),
                                            d = e(this).closest("[data-field]:first-child").find(".kt-datatable__toggle-subtable").data("value"),
                                            c = e(this).find("i").removeAttr("class");
                                    e(n).hasClass("kt-datatable__row--subtable-expanded") ? (e(c).addClass(r.getOption("layout.icons.rowDetail.collapse")), e(n).removeClass("kt-datatable__row--subtable-expanded"), e(l).trigger("kt-datatable--on-collapse-subtable", [n])) : (e(c).addClass(r.getOption("layout.icons.rowDetail.expand")), e(n).addClass("kt-datatable__row--subtable-expanded"), e(l).trigger("kt-datatable--on-expand-subtable", [n])), 0 === e(s).find(".kt-datatable").length && (e.map(l.dataSet, function (t, e) {
                                        return d === t[i.columns[0].field] && (a.data = t, !0)
                                    }), a.detailCell = s, a.parentRow = n, a.subTable = s, t(a), e(s).children(".kt-datatable").on("kt-datatable--on-init", function (t) {
                                        e(o).removeClass("kt-datatable__row-loading")
                                    }), "local" === r.getOption("data.type") && e(o).removeClass("kt-datatable__row-loading"))
                                },
                                        n = i.columns;
                                e(l.tableBody).find(".kt-datatable__row").each(function (t, o) {
                                    e(o).find(".kt-datatable__cell").each(function (t, o) {
                                        var i = e.grep(n, function (t, a) {
                                            return e(o).data("field") === t.field
                                        })[0];
                                        if (void 0 !== i) {
                                            var l = e(o).text();
                                            if (void 0 !== i.subtable && i.subtable) {
                                                if (e(o).find(".kt-datatable__toggle-subtable").length > 0)
                                                    return;
                                                e(o).html(e("<a/>").addClass("kt-datatable__toggle-subtable").attr("href", "#").attr("data-value", l).attr("title", r.getOption("detail.title")).on("click", a).append(e("<i/>").css("width", e(o).data("width")).addClass(r.getOption("layout.icons.rowDetail.collapse"))))
                                            }
                                        }
                                    })
                                })
                            }
                        },
                        dataMapCallback: function (t) {
                            var e = t;
                            return "function" == typeof r.getOption("data.source.read.map") ? r.getOption("data.source.read.map")(t) : (void 0 !== t && void 0 !== t.data && (e = t.data), e)
                        },
                        isSpinning: !1,
                        spinnerCallback: function (t, e) {
                            void 0 === e && (e = l);
                            var a = r.getOption("layout.spinner");
                            void 0 !== a && a && (t ? r.isSpinning || (void 0 !== a.message && !0 === a.message && (a.message = r.getOption("translate.records.processing")), r.isSpinning = !0, void 0 !== o && o.block(e, a)) : (r.isSpinning = !1, void 0 !== o && o.unblock(e)))
                        },
                        sortCallback: function (t, a, n) {
                            var o = n.type || "string",
                                    i = n.format || "",
                                    l = n.field;
                            return e(t).sort(function (t, e) {
                                var n = t[l],
                                        r = e[l];
                                switch (o) {
                                    case "date":
                                        if ("undefined" == typeof moment)
                                            throw new Error("Moment.js is required.");
                                        var s = moment(n, i).diff(moment(r, i));
                                        return "asc" === a ? s > 0 ? 1 : s < 0 ? -1 : 0 : s < 0 ? 1 : s > 0 ? -1 : 0;
                                    case "number":
                                        return isNaN(parseFloat(n)) && null != n && (n = Number(n.replace(/[^0-9\.-]+/g, ""))), isNaN(parseFloat(r)) && null != r && (r = Number(r.replace(/[^0-9\.-]+/g, ""))), n = parseFloat(n), r = parseFloat(r), "asc" === a ? n > r ? 1 : n < r ? -1 : 0 : n < r ? 1 : n > r ? -1 : 0;
                                    case "string":
                                    default:
                                        return "asc" === a ? n > r ? 1 : n < r ? -1 : 0 : n < r ? 1 : n > r ? -1 : 0
                                }
                            })
                        },
                        log: function (t, e) {
                            void 0 === e && (e = ""), l.debug && console.log(t, e)
                        },
                        autoHide: function () {
                            var t = !1,
                                    a = e(l.table).find("[data-autohide-enabled]");
                            a.length && (t = !0, a.hide());
                            var n = function (t) {
                                t.preventDefault();
                                var a = e(this).closest(".kt-datatable__row"),
                                        n = e(a).next();
                                if (e(n).hasClass("kt-datatable__row-detail"))
                                    e(this).find("i").removeClass(r.getOption("layout.icons.rowDetail.expand")).addClass(r.getOption("layout.icons.rowDetail.collapse")), e(n).remove();
                                else {
                                    e(this).find("i").removeClass(r.getOption("layout.icons.rowDetail.collapse")).addClass(r.getOption("layout.icons.rowDetail.expand"));
                                    var o = e(a).find(".kt-datatable__cell:hidden").clone().show();
                                    n = e("<tr/>").addClass("kt-datatable__row-detail").insertAfter(a);
                                    var l = e("<td/>").addClass("kt-datatable__detail").attr("colspan", r.getTotalColumns()).appendTo(n),
                                            s = e("<table/>");
                                    e(o).each(function () {
                                        var t = e(this).data("field"),
                                                a = e.grep(i.columns, function (e, a) {
                                                    return t === e.field
                                                })[0];
                                        e(s).append(e('<tr class="kt-datatable__row"></tr>').append(e('<td class="kt-datatable__cell"></td>').append(e("<span/>").append(a.title))).append(this))
                                    }), e(l).append(s)
                                }
                            };
                            setTimeout(function () {
                                e(l.table).find(".kt-datatable__cell").show(), e(l.tableBody).each(function () {
                                    for (var a = 0; e(this)[0].offsetWidth < e(this)[0].scrollWidth && a < i.columns.length; )
                                        e(l.table).find(".kt-datatable__row").each(function (a) {
                                            var n = e(this).find(".kt-datatable__cell:not(:hidden):not([data-autohide-disabled])").last();
                                            e(n).hide(), t = !0
                                        }), a++
                                }), t && e(l.tableBody).find(".kt-datatable__row").each(function () {
                                    0 === e(this).find(".kt-datatable__toggle-detail").length && e(this).prepend(e("<td/>").addClass("kt-datatable__cell kt-datatable__toggle-detail").append(e("<a/>").addClass("kt-datatable__toggle-detail").attr("href", "").on("click", n).append('<i class="' + r.getOption("layout.icons.rowDetail.collapse") + '"></i>'))), 0 === e(l.tableHead).find(".kt-datatable__toggle-detail").length ? (e(l.tableHead).find(".kt-datatable__row").first().prepend('<th class="kt-datatable__cell kt-datatable__toggle-detail"><span></span></th>'), e(l.tableFoot).find(".kt-datatable__row").first().prepend('<th class="kt-datatable__cell kt-datatable__toggle-detail"><span></span></th>')) : e(l.tableHead).find(".kt-datatable__toggle-detail").find("span")
                                })
                            }), r.adjustCellsWidth.call()
                        },
                        setAutoColumns: function () {
                            r.getOption("data.autoColumns") && (e.each(l.dataSet[0], function (t, a) {
                                0 === e.grep(i.columns, function (e, a) {
                                    return t === e.field
                                }).length && i.columns.push({
                                    field: t,
                                    title: t
                                })
                            }), e(l.tableHead).find(".kt-datatable__row").remove(), r.setHeadTitle(), r.getOption("layout.footer") && (e(l.tableFoot).find(".kt-datatable__row").remove(), r.setHeadTitle(l.tableFoot)))
                        },
                        isLocked: function () {
                            var t = r.lockEnabledColumns();
                            return t.left.length > 0 || t.right.length > 0
                        },
                        isSubtable: function () {
                            return n.hasClass(l.wrap[0], "kt-datatable--subtable") || !1
                        },
                        getExtraSpace: function (t) {
                            return parseInt(e(t).css("paddingRight")) + parseInt(e(t).css("paddingLeft")) + (parseInt(e(t).css("marginRight")) + parseInt(e(t).css("marginLeft"))) + Math.ceil(e(t).css("border-right-width").replace("px", ""))
                        },
                        dataPlaceholder: function (t, a) {
                            var n = t;
                            return e.each(a, function (t, e) {
                                n = n.replace("{{" + t + "}}", e)
                            }), n
                        },
                        getTableId: function (t) {
                            void 0 === t && (t = "");
                            var a = e(l).attr("id");
                            return void 0 === a && (a = e(l).attr("class").split(" ")[0]), a + t
                        },
                        getTablePrefix: function (t) {
                            return void 0 !== t && (t = "-" + t), r.getTableId() + "-" + r.getDepth() + t
                        },
                        getDepth: function () {
                            var t = 0,
                                    a = l.table;
                            do {
                                a = e(a).parents(".kt-datatable__table"), t++
                            } while (e(a).length > 0);
                            return t
                        },
                        stateKeep: function (t, e) {
                            t = r.getTablePrefix(t), !1 !== r.getOption("data.saveState") && (r.getOption("data.saveState.webstorage") && localStorage && localStorage.setItem(t, JSON.stringify(e)), r.getOption("data.saveState.cookie") && Cookies.set(t, JSON.stringify(e)))
                        },
                        stateGet: function (t, e) {
                            if (t = r.getTablePrefix(t), !1 !== r.getOption("data.saveState")) {
                                var a = null;
                                return null != (a = r.getOption("data.saveState.webstorage") && localStorage ? localStorage.getItem(t) : Cookies.get(t)) ? JSON.parse(a) : void 0
                            }
                        },
                        stateUpdate: function (t, a) {
                            var n = r.stateGet(t);
                            null == n && (n = {}), r.stateKeep(t, e.extend({}, n, a))
                        },
                        stateRemove: function (t) {
                            t = r.getTablePrefix(t), localStorage && localStorage.removeItem(t), Cookies.remove(t)
                        },
                        getTotalColumns: function (t) {
                            return void 0 === t && (t = l.tableBody), e(t).find(".kt-datatable__row").first().find(".kt-datatable__cell").length
                        },
                        getOneRow: function (t, a, n) {
                            void 0 === n && (n = !0);
                            var o = e(t).find(".kt-datatable__row:not(.kt-datatable__row-detail):nth-child(" + a + ")");
                            return n && (o = o.find(".kt-datatable__cell")), o
                        },
                        sortColumn: function (t, a, n) {
                            void 0 === a && (a = "asc"), void 0 === n && (n = !1);
                            var o = e(t).index(),
                                    i = e(l.tableBody).find(".kt-datatable__row"),
                                    r = e(t).closest(".kt-datatable__lock").index();
                            -1 !== r && (i = e(l.tableBody).find(".kt-datatable__lock:nth-child(" + (r + 1) + ")").find(".kt-datatable__row"));
                            var s = e(i).parent();
                            e(i).sort(function (t, i) {
                                var l = e(t).find("td:nth-child(" + o + ")").text(),
                                        r = e(i).find("td:nth-child(" + o + ")").text();
                                return n && (l = parseInt(l), r = parseInt(r)), "asc" === a ? l > r ? 1 : l < r ? -1 : 0 : l < r ? 1 : l > r ? -1 : 0
                            }).appendTo(s)
                        },
                        sorting: function () {
                            var t = {
                                init: function () {
                                    i.sortable && (e(l.tableHead).find(".kt-datatable__cell:not(.kt-datatable__cell--check)").addClass("kt-datatable__cell--sort").off("click").on("click", t.sortClick), t.setIcon())
                                },
                                setIcon: function () {
                                    var t = r.getDataSourceParam("sort");
                                    if (!e.isEmptyObject(t)) {
                                        var a = r.getColumnByField(t.field);
                                        if (void 0 === a || void 0 === a.sortable || !1 !== a.sortable) {
                                            var n = e(l.tableHead).find('.kt-datatable__cell[data-field="' + t.field + '"]').attr("data-sort", t.sort),
                                                    o = e(n).find("span"),
                                                    i = e(o).find("i"),
                                                    s = r.getOption("layout.icons.sort");
                                            e(i).length > 0 ? e(i).removeAttr("class").addClass(s[t.sort]) : e(o).append(e("<i/>").addClass(s[t.sort])), e(n).addClass("kt-datatable__cell--sorted")
                                        }
                                    }
                                },
                                sortClick: function (a) {
                                    var o = r.getDataSourceParam("sort"),
                                            s = e(this).data("field"),
                                            d = r.getColumnByField(s);
                                    if ((void 0 === d.sortable || !1 !== d.sortable) && (e(l.tableHead).find("th").removeClass("kt-datatable__cell--sorted"), n.addClass(this, "kt-datatable__cell--sorted"), e(l.tableHead).find(".kt-datatable__cell > span > i").remove(), i.sortable)) {
                                        r.spinnerCallback(!0);
                                        var c = "desc";
                                        r.getObject("field", o) === s && (c = r.getObject("sort", o)), o = {
                                            field: s,
                                            sort: c = void 0 === c || "desc" === c ? "asc" : "desc"
                                        }, r.setDataSourceParam("sort", o), t.setIcon(), setTimeout(function () {
                                            r.dataRender("sort"), e(l).trigger("kt-datatable--on-sort", o)
                                        }, 300)
                                    }
                                }
                            };
                            t.init()
                        },
                        localDataUpdate: function () {
                            var t = r.getDataSourceParam();
                            void 0 === l.originalDataSet && (l.originalDataSet = l.dataSet);
                            var a = r.getObject("sort.field", t),
                                    n = r.getObject("sort.sort", t),
                                    o = r.getColumnByField(a);
                            if (void 0 !== o && !0 !== r.getOption("data.serverSorting") ? "function" == typeof o.sortCallback ? l.dataSet = o.sortCallback(l.originalDataSet, n, o) : l.dataSet = r.sortCallback(l.originalDataSet, n, o) : l.dataSet = l.originalDataSet, "object" == typeof t.query && !r.getOption("data.serverFiltering")) {
                                t.query = t.query || {};
                                var i = function (t) {
                                    for (var e in t)
                                        if (t.hasOwnProperty(e))
                                            if ("string" == typeof t[e]) {
                                                if (t[e].toLowerCase() == s || -1 !== t[e].toLowerCase().indexOf(s))
                                                    return !0
                                            } else if ("number" == typeof t[e]) {
                                                if (t[e] === s)
                                                    return !0
                                            } else if ("object" == typeof t[e] && i(t[e]))
                                                return !0;
                                    return !1
                                },
                                        s = e(r.getOption("search.input")).val();
                                void 0 !== s && "" !== s && (s = s.toLowerCase(), l.dataSet = e.grep(l.dataSet, i), delete t.query[r.getGeneralSearchKey()]), e.each(t.query, function (e, a) {
                                    "" === a && delete t.query[e]
                                }), l.dataSet = r.filterArray(l.dataSet, t.query), l.dataSet = l.dataSet.filter(function () {
                                    return !0
                                })
                            }
                            return l.dataSet
                        },
                        filterArray: function (t, a, n) {
                            if ("object" != typeof t)
                                return [];
                            if (void 0 === n && (n = "AND"), "object" != typeof a)
                                return t;
                            if (n = n.toUpperCase(), -1 === e.inArray(n, ["AND", "OR", "NOT"]))
                                return [];
                            var o = Object.keys(a).length,
                                    i = [];
                            return e.each(t, function (t, l) {
                                var s = l,
                                        d = 0;
                                e.each(a, function (t, e) {
                                    e = e instanceof Array ? e : [e];
                                    var a = r.getObject(t, s);
                                    if (void 0 !== a && a) {
                                        var n = a.toString().toLowerCase();
                                        e.forEach(function (t, e) {
                                            t.toString().toLowerCase() != n && -1 === n.indexOf(t.toString().toLowerCase()) || d++
                                        })
                                    }
                                }), ("AND" == n && d == o || "OR" == n && d > 0 || "NOT" == n && 0 == d) && (i[t] = l)
                            }), t = i
                        },
                        resetScroll: function () {
                            void 0 === i.detail && 1 === r.getDepth() && (e(l.table).find(".kt-datatable__row").css("left", 0), e(l.table).find(".kt-datatable__lock").css("top", 0), e(l.tableBody).scrollTop(0))
                        },
                        getColumnByField: function (t) {
                            var a;
                            if (void 0 !== t)
                                return e.each(i.columns, function (e, n) {
                                    if (t === n.field)
                                        return a = n, !1
                                }), a
                        },
                        getDefaultSortColumn: function () {
                            var t;
                            return e.each(i.columns, function (a, n) {
                                if (void 0 !== n.sortable && -1 !== e.inArray(n.sortable, ["asc", "desc"]))
                                    return t = {
                                        sort: n.sortable,
                                        field: n.field
                                    }, !1
                            }), t
                        },
                        getHiddenDimensions: function (t, a) {
                            var n = {
                                position: "absolute",
                                visibility: "hidden",
                                display: "block"
                            },
                                    o = {
                                        width: 0,
                                        height: 0,
                                        innerWidth: 0,
                                        innerHeight: 0,
                                        outerWidth: 0,
                                        outerHeight: 0
                                    },
                                    i = e(t).parents().addBack().not(":visible");
                            a = "boolean" == typeof a && a;
                            var l = [];
                            return i.each(function () {
                                var t = {};
                                for (var e in n)
                                    t[e] = this.style[e], this.style[e] = n[e];
                                l.push(t)
                            }), o.width = e(t).width(), o.outerWidth = e(t).outerWidth(a), o.innerWidth = e(t).innerWidth(), o.height = e(t).height(), o.innerHeight = e(t).innerHeight(), o.outerHeight = e(t).outerHeight(a), i.each(function (t) {
                                var e = l[t];
                                for (var a in n)
                                    this.style[a] = e[a]
                            }), o
                        },
                        getGeneralSearchKey: function () {
                            var t = e(r.getOption("search.input"));
                            return e(t).prop("name") || e(t).prop("id")
                        },
                        getObject: function (t, e) {
                            return t.split(".").reduce(function (t, e) {
                                return null !== t && void 0 !== t[e] ? t[e] : null
                            }, e)
                        },
                        extendObj: function (t, e, a) {
                            var n = e.split("."),
                                    o = 0;
                            return function t(e) {
                                var i = n[o++];
                                void 0 !== e[i] && null !== e[i] ? "object" != typeof e[i] && "function" != typeof e[i] && (e[i] = {}) : e[i] = {}, o === n.length ? e[i] = a : t(e[i])
                            }(t), t
                        },
                        rowEvenOdd: function () {
                            e(l.tableBody).find(".kt-datatable__row").removeClass("kt-datatable__row--even"), e(l.wrap).hasClass("kt-datatable--subtable") ? e(l.tableBody).find(".kt-datatable__row:not(.kt-datatable__row-detail):even").addClass("kt-datatable__row--even") : e(l.tableBody).find(".kt-datatable__row:nth-child(even)").addClass("kt-datatable__row--even")
                        },
                        timer: 0,
                        redraw: function () {
                            return r.adjustCellsWidth.call(), r.isLocked() && (r.scrollbar(), r.resetScroll(), r.adjustCellsHeight.call()), r.adjustLockContainer.call(), r.initHeight.call(), l
                        },
                        load: function () {
                            return r.reload(), l
                        },
                        reload: function () {
                            return function (t, e) {
                                clearTimeout(r.timer), r.timer = setTimeout(t, e)
                            }(function () {
                                i.data.serverFiltering || r.localDataUpdate(), r.dataRender(), e(l).trigger("kt-datatable--on-reloaded")
                            }, r.getOption("search.delay")), l
                        },
                        getRecord: function (t) {
                            return void 0 === l.tableBody && (l.tableBody = e(l.table).children("tbody")), e(l.tableBody).find(".kt-datatable__cell:first-child").each(function (a, n) {
                                if (t == e(n).text()) {
                                    var o = e(n).closest(".kt-datatable__row").index() + 1;
                                    return l.API.record = l.API.value = r.getOneRow(l.tableBody, o), l
                                }
                            }), l
                        },
                        getColumn: function (t) {
                            return r.setSelectedRecords(), l.API.value = e(l.API.record).find('[data-field="' + t + '"]'), l
                        },
                        destroy: function () {
                            e(l).parent().find(".kt-datatable__pager").remove();
                            var t = e(l.initialDatatable).addClass("kt-datatable--destroyed").show();
                            return e(l).replaceWith(t), e(l = t).trigger("kt-datatable--on-destroy"), r.isInit = !1, t = null
                        },
                        sort: function (t, a) {
                            a = void 0 === a ? "asc" : a, r.spinnerCallback(!0);
                            var n = {
                                field: t,
                                sort: a
                            };
                            return r.setDataSourceParam("sort", n), setTimeout(function () {
                                r.dataRender("sort"), e(l).trigger("kt-datatable--on-sort", n), e(l.tableHead).find(".kt-datatable__cell > span > i").remove()
                            }, 300), l
                        },
                        getValue: function () {
                            return e(l.API.value).text()
                        },
                        setActive: function (t) {
                            "string" == typeof t && (t = e(l.tableBody).find('.kt-checkbox--single > [type="checkbox"][value="' + t + '"]')), e(t).prop("checked", !0);
                            var a = [];
                            e(t).each(function (t, n) {
                                var o = e(n).closest("tr").addClass("kt-datatable__row--active"),
                                        i = e(o).index() + 1;
                                e(o).closest("tbody").find("tr:nth-child(" + i + ")").not(".kt-datatable__row-subtable").addClass("kt-datatable__row--active");
                                var l = e(n).attr("value");
                                void 0 !== l && a.push(l)
                            }), e(l).trigger("kt-datatable--on-check", [a])
                        },
                        setInactive: function (t) {
                            "string" == typeof t && (t = e(l.tableBody).find('.kt-checkbox--single > [type="checkbox"][value="' + t + '"]')), e(t).prop("checked", !1);
                            var a = [];
                            e(t).each(function (t, n) {
                                var o = e(n).closest("tr").removeClass("kt-datatable__row--active"),
                                        i = e(o).index() + 1;
                                e(o).closest("tbody").find("tr:nth-child(" + i + ")").not(".kt-datatable__row-subtable").removeClass("kt-datatable__row--active");
                                var l = e(n).attr("value");
                                void 0 !== l && a.push(l)
                            }), e(l).trigger("kt-datatable--on-uncheck", [a])
                        },
                        setActiveAll: function (t) {
                            var a = e(l.table).find("> tbody, > thead").find("tr").not(".kt-datatable__row-subtable").find('.kt-datatable__cell--check [type="checkbox"]');
                            t ? r.setActive(a) : r.setInactive(a)
                        },
                        setSelectedRecords: function () {
                            return l.API.record = e(l.tableBody).find(".kt-datatable__row--active"), l
                        },
                        getSelectedRecords: function () {
                            return r.setSelectedRecords(), l.API.record = l.rows(".kt-datatable__row--active").nodes(), l.API.record
                        },
                        getOption: function (t) {
                            return r.getObject(t, i)
                        },
                        setOption: function (t, e) {
                            i = r.extendObj(i, t, e)
                        },
                        search: function (t, a) {
                            void 0 !== a && (a = e.makeArray(a)), n = function () {
                                var n = r.getDataSourceQuery();
                                if (void 0 === a && void 0 !== t) {
                                    var o = r.getGeneralSearchKey();
                                    n[o] = t
                                }
                                "object" == typeof a && (e.each(a, function (e, a) {
                                    n[a] = t
                                }), e.each(n, function (t, a) {
                                    ("" === a || e.isEmptyObject(a)) && delete n[t]
                                })), r.setDataSourceQuery(n), i.data.serverFiltering || r.localDataUpdate(), r.dataRender("search")
                            }, o = r.getOption("search.delay"), clearTimeout(r.timer), r.timer = setTimeout(n, o);
                            var n, o
                        },
                        setDataSourceParam: function (t, a) {
                            l.API.params = e.extend({}, {
                                pagination: {
                                    page: 1,
                                    perpage: r.getOption("data.pageSize")
                                },
                                sort: r.getDefaultSortColumn(),
                                query: {}
                            }, l.API.params, r.stateGet(r.stateId)), l.API.params = r.extendObj(l.API.params, t, a), r.stateKeep(r.stateId, l.API.params)
                        },
                        getDataSourceParam: function (t) {
                            return l.API.params = e.extend({}, {
                                pagination: {
                                    page: 1,
                                    perpage: r.getOption("data.pageSize")
                                },
                                sort: r.getDefaultSortColumn(),
                                query: {}
                            }, l.API.params, r.stateGet(r.stateId)), "string" == typeof t ? r.getObject(t, l.API.params) : l.API.params
                        },
                        getDataSourceQuery: function () {
                            return r.getDataSourceParam("query") || {}
                        },
                        setDataSourceQuery: function (t) {
                            r.setDataSourceParam("query", t)
                        },
                        getCurrentPage: function () {
                            return e(l.table).siblings(".kt-datatable__pager").last().find(".kt-datatable__pager-nav").find(".kt-datatable__pager-link.kt-datatable__pager-link--active").data("page") || 1
                        },
                        getPageSize: function () {
                            return e(l.table).siblings(".kt-datatable__pager").last().find("select.kt-datatable__pager-size").val() || 10
                        },
                        getTotalRows: function () {
                            return l.API.params.pagination.total
                        },
                        getDataSet: function () {
                            return l.originalDataSet
                        },
                        hideColumn: function (t) {
                            e.map(i.columns, function (e) {
                                return t === e.field && (e.responsive = {
                                    hidden: "xl"
                                }), e
                            });
                            var a = e.grep(e(l.table).find(".kt-datatable__cell"), function (a, n) {
                                return t === e(a).data("field")
                            });
                            e(a).hide()
                        },
                        showColumn: function (t) {
                            e.map(i.columns, function (e) {
                                return t === e.field && delete e.responsive, e
                            });
                            var a = e.grep(e(l.table).find(".kt-datatable__cell"), function (a, n) {
                                return t === e(a).data("field")
                            });
                            e(a).show()
                        },
                        nodeTr: [],
                        nodeTd: [],
                        nodeCols: [],
                        recentNode: [],
                        table: function () {
                            if (void 0 !== l.table)
                                return l.table
                        },
                        row: function (t) {
                            return r.rows(t), r.nodeTr = r.recentNode = e(r.nodeTr).first(), l
                        },
                        rows: function (e) {
                            return r.isLocked() ? r.nodeTr = r.recentNode = t(l.tableBody).find(e).filter(".kt-datatable__lock--scroll > .kt-datatable__row") : r.nodeTr = r.recentNode = t(l.tableBody).find(e).filter(".kt-datatable__row"), l
                        },
                        column: function (t) {
                            return r.nodeCols = r.recentNode = e(l.tableBody).find(".kt-datatable__cell:nth-child(" + (t + 1) + ")"), l
                        },
                        columns: function (t) {
                            var a = l.table;
                            r.nodeTr === r.recentNode && (a = r.nodeTr);
                            var n = e(a).find('.kt-datatable__cell[data-field="' + t + '"]');
                            return n.length > 0 ? r.nodeCols = r.recentNode = n : r.nodeCols = r.recentNode = e(a).find(t).filter(".kt-datatable__cell"), l
                        },
                        cell: function (t) {
                            return r.cells(t), r.nodeTd = r.recentNode = e(r.nodeTd).first(), l
                        },
                        cells: function (t) {
                            var a = e(l.tableBody).find(".kt-datatable__cell");
                            return void 0 !== t && (a = e(a).filter(t)), r.nodeTd = r.recentNode = a, l
                        },
                        remove: function () {
                            return e(r.nodeTr.length) && r.nodeTr === r.recentNode && e(r.nodeTr).remove(), r.layoutUpdate(), l
                        },
                        visible: function (t) {
                            if (e(r.recentNode.length)) {
                                var a = r.lockEnabledColumns();
                                if (r.recentNode === r.nodeCols) {
                                    var n = r.recentNode.index();
                                    if (r.isLocked()) {
                                        var o = e(r.recentNode).closest(".kt-datatable__lock--scroll").length;
                                        o ? n += a.left.length + 1 : e(r.recentNode).closest(".kt-datatable__lock--right").length && (n += a.left.length + o + 1)
                                    }
                                }
                                t ? (r.recentNode === r.nodeCols && delete i.columns[n].responsive, e(r.recentNode).show()) : (r.recentNode === r.nodeCols && r.setOption("columns." + n + ".responsive", {
                                    hidden: "xl"
                                }), e(r.recentNode).hide()), r.redraw()
                            }
                        },
                        nodes: function () {
                            return r.recentNode
                        },
                        dataset: function () {
                            return l
                        },
                        gotoPage: function (t) {
                            r.pagingObject.openPage(t)
                        }
                    };
                    if (e.each(r, function (t, e) {
                        l[t] = e
                    }), void 0 !== i)
                        if ("string" == typeof i) {
                            var s = i;
                            void 0 !== (l = e(this).data(a)) && (i = l.options, r[s].apply(this, Array.prototype.slice.call(arguments, 1)))
                        } else
                            l.data(a) || e(this).hasClass("kt-datatable--loaded") || (l.dataSet = null, l.textAlign = {
                                left: "kt-datatable__cell--left",
                                center: "kt-datatable__cell--center",
                                right: "kt-datatable__cell--right"
                            }, i = e.extend(!0, {}, e.fn.KTDatatable.defaults, i), l.options = i, r.init.apply(this, [i]), e(l.wrap).data(a, l));
                    else
                        void 0 === (l = e(this).data(a)) && e.error("KTDatatable not initialized"), i = l.options;
                    return l
                }
                console.log("No KTDatatable element exist.")
            }, e.fn.KTDatatable.defaults = {
                data: {
                    type: "local",
                    source: null,
                    pageSize: 10,
                    saveState: {
                        cookie: !1,
                        webstorage: !0
                    },
                    serverPaging: 0,
                    serverFiltering: !1,
                    serverSorting: !1,
                    autoColumns: !1,
                    attr: {
                        rowProps: []
                    }
                },
                layout: {
                    theme: "default",
                    class: "kt-datatable--brand",
                    scroll: !1,
                    height: null,
                    minHeight: 300,
                    footer: !1,
                    header: !0,
                    customScrollbar: !0,
                    spinner: {
                        overlayColor: "#000000",
                        opacity: 0,
                        type: "loader",
                        state: "brand",
                        message: !0
                    },
                    icons: {
                        sort: {
                            asc: "flaticon2-arrow-up",
                            desc: "flaticon2-arrow-down"
                        },
                        pagination: {
                            next: "flaticon2-next",
                            prev: "flaticon2-back",
                            first: "flaticon2-fast-back",
                            last: "flaticon2-fast-next",
                            more: "flaticon-more-1"
                        },
                        rowDetail: {
                            expand: "fa fa-caret-down",
                            collapse: "fa fa-caret-right"
                        }
                    }
                },
                sortable: !0,
                resizable: !1,
                filterable: !1,
                pagination: 0,
                editable: !1,
                columns: [],
                search: {
                    onEnter: !1,
                    input: null,
                    delay: 400
                },
                rows: {
                    callback: function () {},
                    beforeTemplate: function () {},
                    afterTemplate: function () {},
                    autoHide: !0
                },
                toolbar: {
                    layout: ["pagination", "info"],
                    placement: ["bottom"],
                    items: {
                        pagination: {
                            type: "default",
                            pages: {
                                desktop: {
                                    layout: "default",
                                    pagesNumber: 5
                                },
                                tablet: {
                                    layout: "default",
                                    pagesNumber: 3
                                },
                                mobile: {
                                    layout: "compact"
                                }
                            },
                            navigation: {
                                prev: !0,
                                next: !0,
                                first: !0,
                                last: !0
                            },
                            pageSizeSelect: []
                        },
                        info: !0
                    }
                },
                translate: {
                    records: {
                        processing: "Please wait...",
                        noRecords: "No records found"
                    },
                    toolbar: {
                        pagination: {
                            items: {
                                default: {
                                    first: "First",
                                    prev: "Previous",
                                    next: "Next",
                                    last: "Last",
                                    more: "More pages",
                                    input: "Page number",
                                    select: "Select page size",
                                    all: "all"
                                },
                                info: "Showing {{start}} - {{end}} of {{total}}"
                            }
                        }
                    }
                },
                extensions: {}
            }
        }(jQuery),
        function (t) {
            t.fn.KTDatatable = t.fn.KTDatatable || {}, t.fn.KTDatatable.checkbox = function (e, a) {
                var n = {
                    selectedAllRows: !1,
                    selectedRows: [],
                    unselectedRows: [],
                    init: function () {
                        n.selectorEnabled() && (e.setDataSourceParam(a.vars.selectedAllRows, !1), e.stateRemove("checkbox"), a.vars.requestIds && e.setDataSourceParam(a.vars.requestIds, !0), t(e).on("kt-datatable--on-reloaded", function () {
                            e.stateRemove("checkbox"), e.setDataSourceParam(a.vars.selectedAllRows, !1), n.selectedAllRows = !1, n.selectedRows = [], n.unselectedRows = []
                        }), n.selectedAllRows = e.getDataSourceParam(a.vars.selectedAllRows), t(e).on("kt-datatable--on-layout-updated", function (a, o) {
                            o.table == t(e.wrap).attr("id") && e.ready(function () {
                                n.initVars(), n.initEvent(), n.initSelect()
                            })
                        }), t(e).on("kt-datatable--on-check", function (a, o) {
                            o.forEach(function (t) {
                                n.selectedRows.push(t), n.unselectedRows = n.remove(n.unselectedRows, t)
                            });
                            var i = {};
                            i.selectedRows = t.unique(n.selectedRows), i.unselectedRows = t.unique(n.unselectedRows), e.stateKeep("checkbox", i)
                        }), t(e).on("kt-datatable--on-uncheck", function (a, o) {
                            o.forEach(function (t) {
                                n.unselectedRows.push(t), n.selectedRows = n.remove(n.selectedRows, t)
                            });
                            var i = {};
                            i.selectedRows = t.unique(n.selectedRows), i.unselectedRows = t.unique(n.unselectedRows), e.stateKeep("checkbox", i)
                        }))
                    },
                    initEvent: function () {
                        t(e.tableHead).find('.kt-checkbox--all > [type="checkbox"]').click(function (o) {
                            if (n.selectedRows = n.unselectedRows = [], e.stateRemove("checkbox"), t(this).is(":checked") ? n.selectedAllRows = !0 : n.selectedAllRows = !1, !a.vars.requestIds) {
                                t(this).is(":checked") && (n.selectedRows = t.makeArray(t(e.tableBody).find('.kt-checkbox--single > [type="checkbox"]').map(function (e, a) {
                                    return t(a).val()
                                })));
                                var i = {};
                                i.selectedRows = t.unique(n.selectedRows), e.stateKeep("checkbox", i)
                            }
                            e.setDataSourceParam(a.vars.selectedAllRows, n.selectedAllRows), t(e).trigger("kt-datatable--on-click-checkbox", [t(this)])
                        }), t(e.tableBody).find('.kt-checkbox--single > [type="checkbox"]').click(function (o) {
                            var i = t(this).val();
                            t(this).is(":checked") ? (n.selectedRows.push(i), n.unselectedRows = n.remove(n.unselectedRows, i)) : (n.unselectedRows.push(i), n.selectedRows = n.remove(n.selectedRows, i)), !a.vars.requestIds && n.selectedRows.length < 1 && t(e.tableHead).find('.kt-checkbox--all > [type="checkbox"]').prop("checked", !1);
                            var l = {};
                            l.selectedRows = t.unique(n.selectedRows), l.unselectedRows = t.unique(n.unselectedRows), e.stateKeep("checkbox", l), t(e).trigger("kt-datatable--on-click-checkbox", [t(this)])
                        })
                    },
                    initSelect: function () {
                        n.selectedAllRows && a.vars.requestIds ? (e.hasClass("kt-datatable--error") || t(e.tableHead).find('.kt-checkbox--all > [type="checkbox"]').prop("checked", !0), e.setActiveAll(!0), n.unselectedRows.forEach(function (t) {
                            e.setInactive(t)
                        })) : (n.selectedRows.forEach(function (t) {
                            e.setActive(t)
                        }), !e.hasClass("kt-datatable--error") && t(e.tableBody).find('.kt-checkbox--single > [type="checkbox"]').not(":checked").length < 1 && t(e.tableHead).find('.kt-checkbox--all > [type="checkbox"]').prop("checked", !0))
                    },
                    selectorEnabled: function () {
                        return t.grep(e.options.columns, function (t, e) {
                            return t.selector || !1
                        })[0]
                    },
                    initVars: function () {
                        var t = e.stateGet("checkbox");
                        void 0 !== t && (n.selectedRows = t.selectedRows || [], n.unselectedRows = t.unselectedRows || [])
                    },
                    getSelectedId: function (t) {
                        if (n.initVars(), n.selectedAllRows && a.vars.requestIds) {
                            void 0 === t && (t = a.vars.rowIds);
                            var o = e.getObject(t, e.lastResponse) || [];
                            return o.length > 0 && n.unselectedRows.forEach(function (t) {
                                o = n.remove(o, parseInt(t))
                            }), o
                        }
                        return n.selectedRows
                    },
                    remove: function (t, e) {
                        return t.filter(function (t) {
                            return t !== e
                        })
                    }
                };
                return e.checkbox = function () {
                    return n
                }, "object" == typeof a && (a = t.extend(!0, {}, t.fn.KTDatatable.checkbox.default, a), n.init.apply(this, [a])), e
            }, t.fn.KTDatatable.checkbox.default = {
                vars: {
                    selectedAllRows: "selectedAllRows",
                    requestIds: "requestIds",
                    rowIds: "meta.rowIds"
                }
            }
        }(jQuery);
var defaults = {
    layout: {
        icons: {
            pagination: {
                next: "flaticon2-next",
                prev: "flaticon2-back",
                first: "flaticon2-fast-back",
                last: "flaticon2-fast-next",
                more: "flaticon-more-1"
            },
            rowDetail: {
                expand: "fa fa-caret-down",
                collapse: "fa fa-caret-right"
            }
        }
    }
};
KTUtil.isRTL() && (defaults = {
    layout: {
        icons: {
            pagination: {
                next: "flaticon2-back",
                prev: "flaticon2-next",
                first: "flaticon2-fast-next",
                last: "flaticon2-fast-back"
            },
            rowDetail: {
                collapse: "fa fa-caret-down",
                expand: "fa fa-caret-right"
            }
        }
    }
}), $.extend(!0, $.fn.KTDatatable.defaults, defaults);
var KTDialog = function (t) {
    var e, a = this,
            n = KTUtil.get("body"),
            o = {
                placement: "top center",
                type: "loader",
                width: 100,
                state: "default",
                message: "Loading..."
            },
            i = {
                construct: function (t) {
                    return i.init(t), a
                },
                init: function (t) {
                    a.events = [], a.options = KTUtil.deepExtend({}, o, t), a.state = !1
                },
                show: function () {
                    return i.eventTrigger("show"), e = document.createElement("DIV"), KTUtil.setHTML(e, a.options.message), KTUtil.addClass(e, "kt-dialog kt-dialog--shown"), KTUtil.addClass(e, "kt-dialog--" + a.options.state), KTUtil.addClass(e, "kt-dialog--" + a.options.type), "top center" == a.options.placement && KTUtil.addClass(e, "kt-dialog--top-center"), n.appendChild(e), a.state = "shown", i.eventTrigger("shown"), a
                },
                hide: function () {
                    return e && (i.eventTrigger("hide"), e.remove(), a.state = "hidden", i.eventTrigger("hidden")), a
                },
                eventTrigger: function (t) {
                    for (var e = 0; e < a.events.length; e++) {
                        var n = a.events[e];
                        n.name == t && (1 == n.one ? 0 == n.fired && (a.events[e].fired = !0, n.handler.call(this, a)) : n.handler.call(this, a))
                    }
                },
                addEvent: function (t, e, n) {
                    return a.events.push({
                        name: t,
                        handler: e,
                        one: n,
                        fired: !1
                    }), a
                }
            };
    return a.setDefaults = function (t) {
        o = t
    }, a.shown = function () {
        return "shown" == a.state
    }, a.hidden = function () {
        return "hidden" == a.state
    }, a.show = function () {
        return i.show()
    }, a.hide = function () {
        return i.hide()
    }, a.on = function (t, e) {
        return i.addEvent(t, e)
    }, a.one = function (t, e) {
        return i.addEvent(t, e, !0)
    }, i.construct.apply(a, [t]), a
},
        KTHeader = function (t, e) {
            var a = this,
                    n = KTUtil.get(t),
                    o = KTUtil.get("body");
            if (void 0 !== n) {
                var i = {
                    classic: !1,
                    offset: {
                        mobile: 150,
                        desktop: 200
                    },
                    minimize: {
                        mobile: !1,
                        desktop: !1
                    }
                },
                        l = {
                            construct: function (t) {
                                return KTUtil.data(n).has("header") ? a = KTUtil.data(n).get("header") : (l.init(t), l.build(), KTUtil.data(n).set("header", a)), a
                            },
                            init: function (t) {
                                a.events = [], a.options = KTUtil.deepExtend({}, i, t)
                            },
                            build: function () {
                                var t = 0,
                                        e = !0;
                                KTUtil.getViewPort().height;
                                !1 === a.options.minimize.mobile && !1 === a.options.minimize.desktop || window.addEventListener("scroll", function () {
                                    var n, i, r, s = 0;
                                    KTUtil.isInResponsiveRange("desktop") ? (s = a.options.offset.desktop, n = a.options.minimize.desktop.on, i = a.options.minimize.desktop.off) : KTUtil.isInResponsiveRange("tablet-and-mobile") && (s = a.options.offset.mobile, n = a.options.minimize.mobile.on, i = a.options.minimize.mobile.off), r = window.pageYOffset, KTUtil.isInResponsiveRange("tablet-and-mobile") && a.options.classic && a.options.classic.mobile || KTUtil.isInResponsiveRange("desktop") && a.options.classic && a.options.classic.desktop ? r > s ? (KTUtil.addClass(o, n), KTUtil.removeClass(o, i), e && (l.eventTrigger("minimizeOn", a), e = !1)) : (KTUtil.addClass(o, i), KTUtil.removeClass(o, n), 0 == e && (l.eventTrigger("minimizeOff", a), e = !0)) : (r > s && t < r ? (KTUtil.addClass(o, n), KTUtil.removeClass(o, i), e && (l.eventTrigger("minimizeOn", a), e = !1)) : (KTUtil.addClass(o, i), KTUtil.removeClass(o, n), 0 == e && (l.eventTrigger("minimizeOff", a), e = !0)), t = r)
                                })
                            },
                            eventTrigger: function (t, e) {
                                for (var n = 0; n < a.events.length; n++) {
                                    var o = a.events[n];
                                    o.name == t && (1 == o.one ? 0 == o.fired && (a.events[n].fired = !0, o.handler.call(this, a, e)) : o.handler.call(this, a, e))
                                }
                            },
                            addEvent: function (t, e, n) {
                                a.events.push({
                                    name: t,
                                    handler: e,
                                    one: n,
                                    fired: !1
                                })
                            }
                        };
                return a.setDefaults = function (t) {
                    i = t
                }, a.on = function (t, e) {
                    return l.addEvent(t, e)
                }, l.construct.apply(a, [e]), !0, a
            }
        },
        KTMenu = function (t, e) {
            var a = this,
                    n = !1,
                    o = KTUtil.get(t),
                    i = KTUtil.get("body");
            if (o) {
                var l = {
                    accordion: {
                        slideSpeed: 200,
                        autoScroll: !1,
                        autoScrollSpeed: 1200,
                        expandAll: !0
                    },
                    dropdown: {
                        timeout: 500
                    }
                },
                        r = {
                            construct: function (t) {
                                return KTUtil.data(o).has("menu") ? a = KTUtil.data(o).get("menu") : (r.init(t), r.reset(), r.build(), KTUtil.data(o).set("menu", a)), a
                            },
                            init: function (t) {
                                a.events = [], a.eventHandlers = {}, a.options = KTUtil.deepExtend({}, l, t), a.pauseDropdownHoverTime = 0, a.uid = KTUtil.getUniqueID()
                            },
                            update: function (t) {
                                a.options = KTUtil.deepExtend({}, l, t), a.pauseDropdownHoverTime = 0, r.reset(), a.eventHandlers = {}, r.build(), KTUtil.data(o).set("menu", a)
                            },
                            reload: function () {
                                r.reset(), r.build(), r.resetSubmenuProps()
                            },
                            build: function () {
                                a.eventHandlers.event_1 = KTUtil.on(o, ".kt-menu__toggle", "click", r.handleSubmenuAccordion), ("dropdown" === r.getSubmenuMode() || r.isConditionalSubmenuDropdown()) && (a.eventHandlers.event_2 = KTUtil.on(o, '[data-ktmenu-submenu-toggle="hover"]', "mouseover", r.handleSubmenuDrodownHoverEnter), a.eventHandlers.event_3 = KTUtil.on(o, '[data-ktmenu-submenu-toggle="hover"]', "mouseout", r.handleSubmenuDrodownHoverExit), a.eventHandlers.event_4 = KTUtil.on(o, '[data-ktmenu-submenu-toggle="click"] > .kt-menu__toggle, [data-ktmenu-submenu-toggle="click"] > .kt-menu__link .kt-menu__toggle', "click", r.handleSubmenuDropdownClick), a.eventHandlers.event_5 = KTUtil.on(o, '[data-ktmenu-submenu-toggle="tab"] > .kt-menu__toggle, [data-ktmenu-submenu-toggle="tab"] > .kt-menu__link .kt-menu__toggle', "click", r.handleSubmenuDropdownTabClick)), a.options.scroll && a.options.scroll.height && r.scrollInit()
                            },
                            reset: function () {
                                KTUtil.off(o, "click", a.eventHandlers.event_1), KTUtil.off(o, "mouseover", a.eventHandlers.event_2), KTUtil.off(o, "mouseout", a.eventHandlers.event_3), KTUtil.off(o, "click", a.eventHandlers.event_4), KTUtil.off(o, "click", a.eventHandlers.event_5), KTUtil.off(o, "click", a.eventHandlers.event_6)
                            },
                            scrollInit: function () {
                                a.options.scroll && a.options.scroll.height ? (KTUtil.scrollDestroy(o), KTUtil.scrollInit(o, {
                                    disableForMobile: !0,
                                    resetHeightOnDestroy: !0,
                                    handleWindowResize: !0,
                                    height: a.options.scroll.height
                                })) : KTUtil.scrollDestroy(o)
                            },
                            scrollUpdate: function () {
                                a.options.scroll && a.options.scroll.height && KTUtil.scrollUpdate(o)
                            },
                            scrollTop: function () {
                                a.options.scroll && a.options.scroll.height && KTUtil.scrollTop(o)
                            },
                            getSubmenuMode: function (t) {
                                return KTUtil.isInResponsiveRange("desktop") ? t && KTUtil.hasAttr(t, "data-ktmenu-submenu-toggle") ? KTUtil.attr(t, "data-ktmenu-submenu-toggle") : KTUtil.isset(a.options.submenu, "desktop.state.body") ? KTUtil.hasClasses(i, a.options.submenu.desktop.state.body) ? a.options.submenu.desktop.state.mode : a.options.submenu.desktop.default : KTUtil.isset(a.options.submenu, "desktop") ? a.options.submenu.desktop : void 0 : KTUtil.isInResponsiveRange("tablet") && KTUtil.isset(a.options.submenu, "tablet") ? a.options.submenu.tablet : !(!KTUtil.isInResponsiveRange("mobile") || !KTUtil.isset(a.options.submenu, "mobile")) && a.options.submenu.mobile
                            },
                            isConditionalSubmenuDropdown: function () {
                                return !(!KTUtil.isInResponsiveRange("desktop") || !KTUtil.isset(a.options.submenu, "desktop.state.body"))
                            },
                            resetSubmenuProps: function (t) {
                                var e = KTUtil.findAll(o, ".kt-menu__submenu");
                                if (e)
                                    for (var a = 0, n = e.length; a < n; a++)
                                        KTUtil.css(e[0], "display", ""), KTUtil.css(e[0], "overflow", "")
                            },
                            handleSubmenuDrodownHoverEnter: function (t) {
                                if ("accordion" !== r.getSubmenuMode(this) && !1 !== a.resumeDropdownHover()) {
                                    "1" == this.getAttribute("data-hover") && (this.removeAttribute("data-hover"), clearTimeout(this.getAttribute("data-timeout")), this.removeAttribute("data-timeout")), r.showSubmenuDropdown(this)
                                }
                            },
                            handleSubmenuDrodownHoverExit: function (t) {
                                if (!1 !== a.resumeDropdownHover() && "accordion" !== r.getSubmenuMode(this)) {
                                    var e = this,
                                            n = a.options.dropdown.timeout,
                                            o = setTimeout(function () {
                                                "1" == e.getAttribute("data-hover") && r.hideSubmenuDropdown(e, !0)
                                            }, n);
                                    e.setAttribute("data-hover", "1"), e.setAttribute("data-timeout", o)
                                }
                            },
                            handleSubmenuDropdownClick: function (t) {
                                if ("accordion" !== r.getSubmenuMode(this)) {
                                    var e = this.closest(".kt-menu__item");
                                    "accordion" != e.getAttribute("data-ktmenu-submenu-mode") && (!1 === KTUtil.hasClass(e, "kt-menu__item--hover") ? (KTUtil.addClass(e, "kt-menu__item--open-dropdown"), r.showSubmenuDropdown(e)) : (KTUtil.removeClass(e, "kt-menu__item--open-dropdown"), r.hideSubmenuDropdown(e, !0)), t.preventDefault())
                                }
                            },
                            handleSubmenuDropdownTabClick: function (t) {
                                if ("accordion" !== r.getSubmenuMode(this)) {
                                    var e = this.closest(".kt-menu__item");
                                    "accordion" != e.getAttribute("data-ktmenu-submenu-mode") && (0 == KTUtil.hasClass(e, "kt-menu__item--hover") && (KTUtil.addClass(e, "kt-menu__item--open-dropdown"), r.showSubmenuDropdown(e)), t.preventDefault())
                                }
                            },
                            handleSubmenuDropdownClose: function (t, e) {
                                if ("accordion" !== r.getSubmenuMode(e)) {
                                    var a = o.querySelectorAll(".kt-menu__item.kt-menu__item--submenu.kt-menu__item--hover:not(.kt-menu__item--tabs)");
                                    if (a.length > 0 && !1 === KTUtil.hasClass(e, "kt-menu__toggle") && 0 === e.querySelectorAll(".kt-menu__toggle").length)
                                        for (var n = 0, i = a.length; n < i; n++)
                                            r.hideSubmenuDropdown(a[0], !0)
                                }
                            },
                            handleSubmenuAccordion: function (t, e) {
                                var n, o = e || this;
                                if ("dropdown" === r.getSubmenuMode(e) && (n = o.closest(".kt-menu__item")) && "accordion" != n.getAttribute("data-ktmenu-submenu-mode"))
                                    t.preventDefault();
                                else {
                                    var i = o.closest(".kt-menu__item"),
                                            l = KTUtil.child(i, ".kt-menu__submenu, .kt-menu__inner");
                                    if (!KTUtil.hasClass(o.closest(".kt-menu__item"), "kt-menu__item--open-always") && i && l) {
                                        t.preventDefault();
                                        var s = a.options.accordion.slideSpeed;
                                        if (!1 === KTUtil.hasClass(i, "kt-menu__item--open")) {
                                            if (!1 === a.options.accordion.expandAll) {
                                                var d = o.closest(".kt-menu__nav, .kt-menu__subnav"),
                                                        c = KTUtil.children(d, ".kt-menu__item.kt-menu__item--open.kt-menu__item--submenu:not(.kt-menu__item--here):not(.kt-menu__item--open-always)");
                                                if (d && c)
                                                    for (var u = 0, p = c.length; u < p; u++) {
                                                        var f = c[0],
                                                                g = KTUtil.child(f, ".kt-menu__submenu");
                                                        g && KTUtil.slideUp(g, s, function () {
                                                            r.scrollUpdate(), KTUtil.removeClass(f, "kt-menu__item--open")
                                                        })
                                                    }
                                            }
                                            KTUtil.slideDown(l, s, function () {
                                                r.scrollToItem(o), r.scrollUpdate(), r.eventTrigger("submenuToggle", l)
                                            }), KTUtil.addClass(i, "kt-menu__item--open")
                                        } else
                                            KTUtil.slideUp(l, s, function () {
                                                r.scrollToItem(o), r.eventTrigger("submenuToggle", l)
                                            }), KTUtil.removeClass(i, "kt-menu__item--open")
                                    }
                                }
                            },
                            scrollToItem: function (t) {
                                KTUtil.isInResponsiveRange("desktop") && a.options.accordion.autoScroll && "1" !== o.getAttribute("data-ktmenu-scroll") && KTUtil.scrollTo(t, a.options.accordion.autoScrollSpeed)
                            },
                            hideSubmenuDropdown: function (t, e) {
                                e && (KTUtil.removeClass(t, "kt-menu__item--hover"), KTUtil.removeClass(t, "kt-menu__item--active-tab")), t.removeAttribute("data-hover"), t.getAttribute("data-ktmenu-dropdown-toggle-class") && KTUtil.removeClass(i, t.getAttribute("data-ktmenu-dropdown-toggle-class"));
                                var a = t.getAttribute("data-timeout");
                                t.removeAttribute("data-timeout"), clearTimeout(a)
                            },
                            showSubmenuDropdown: function (t) {
                                var e = o.querySelectorAll(".kt-menu__item--submenu.kt-menu__item--hover, .kt-menu__item--submenu.kt-menu__item--active-tab");
                                if (e)
                                    for (var a = 0, n = e.length; a < n; a++) {
                                        var l = e[a];
                                        t !== l && !1 === l.contains(t) && !1 === t.contains(l) && r.hideSubmenuDropdown(l, !0)
                                    }
                                KTUtil.addClass(t, "kt-menu__item--hover"), t.getAttribute("data-ktmenu-dropdown-toggle-class") && KTUtil.addClass(i, t.getAttribute("data-ktmenu-dropdown-toggle-class"))
                            },
                            createSubmenuDropdownClickDropoff: function (t) {
                                var e, a = (e = KTUtil.child(t, ".kt-menu__submenu") ? KTUtil.css(e, "z-index") : 0) - 1,
                                        n = document.createElement('<div class="kt-menu__dropoff" style="background: transparent; position: fixed; top: 0; bottom: 0; left: 0; right: 0; z-index: ' + a + '"></div>');
                                i.appendChild(n), KTUtil.addEvent(n, "click", function (e) {
                                    e.stopPropagation(), e.preventDefault(), KTUtil.remove(this), r.hideSubmenuDropdown(t, !0)
                                })
                            },
                            pauseDropdownHover: function (t) {
                                var e = new Date;
                                a.pauseDropdownHoverTime = e.getTime() + t
                            },
                            resumeDropdownHover: function () {
                                return (new Date).getTime() > a.pauseDropdownHoverTime
                            },
                            resetActiveItem: function (t) {
                                for (var e, n, i = 0, l = (e = o.querySelectorAll(".kt-menu__item--active")).length; i < l; i++) {
                                    var r = e[0];
                                    KTUtil.removeClass(r, "kt-menu__item--active"), KTUtil.hide(KTUtil.child(r, ".kt-menu__submenu"));
                                    for (var s = 0, d = (n = KTUtil.parents(r, ".kt-menu__item--submenu")).length; s < d; s++) {
                                        var c = n[i];
                                        KTUtil.removeClass(c, "kt-menu__item--open"), KTUtil.hide(KTUtil.child(c, ".kt-menu__submenu"))
                                    }
                                }
                                if (!1 === a.options.accordion.expandAll && (e = o.querySelectorAll(".kt-menu__item--open")))
                                    for (i = 0, l = e.length; i < l; i++)
                                        KTUtil.removeClass(n[0], "kt-menu__item--open")
                            },
                            setActiveItem: function (t) {
                                r.resetActiveItem(), KTUtil.addClass(t, "kt-menu__item--active");
                                for (var e = KTUtil.parents(t, ".kt-menu__item--submenu"), a = 0, n = e.length; a < n; a++)
                                    KTUtil.addClass(e[a], "kt-menu__item--open")
                            },
                            getBreadcrumbs: function (t) {
                                var e, a = [],
                                        n = KTUtil.child(t, ".kt-menu__link");
                                a.push({
                                    text: e = KTUtil.child(n, ".kt-menu__link-text") ? e.innerHTML : "",
                                    title: n.getAttribute("title"),
                                    href: n.getAttribute("href")
                                });
                                for (var o = KTUtil.parents(t, ".kt-menu__item--submenu"), i = 0, l = o.length; i < l; i++) {
                                    var r = KTUtil.child(o[i], ".kt-menu__link");
                                    a.push({
                                        text: e = KTUtil.child(r, ".kt-menu__link-text") ? e.innerHTML : "",
                                        title: r.getAttribute("title"),
                                        href: r.getAttribute("href")
                                    })
                                }
                                return a.reverse()
                            },
                            getPageTitle: function (t) {
                                var e;
                                return KTUtil.child(t, ".kt-menu__link-text") ? e.innerHTML : ""
                            },
                            eventTrigger: function (t, e) {
                                for (var n = 0; n < a.events.length; n++) {
                                    var o = a.events[n];
                                    o.name == t && (1 == o.one ? 0 == o.fired && (a.events[n].fired = !0, o.handler.call(this, a, e)) : o.handler.call(this, a, e))
                                }
                            },
                            addEvent: function (t, e, n) {
                                a.events.push({
                                    name: t,
                                    handler: e,
                                    one: n,
                                    fired: !1
                                })
                            },
                            removeEvent: function (t) {
                                a.events[t] && delete a.events[t]
                            }
                        };
                return a.setDefaults = function (t) {
                    l = t
                }, a.scrollUpdate = function () {
                    return r.scrollUpdate()
                }, a.scrollReInit = function () {
                    return r.scrollInit()
                }, a.scrollTop = function () {
                    return r.scrollTop()
                }, a.setActiveItem = function (t) {
                    return r.setActiveItem(t)
                }, a.reload = function () {
                    return r.reload()
                }, a.update = function (t) {
                    return r.update(t)
                }, a.getBreadcrumbs = function (t) {
                    return r.getBreadcrumbs(t)
                }, a.getPageTitle = function (t) {
                    return r.getPageTitle(t)
                }, a.getSubmenuMode = function (t) {
                    return r.getSubmenuMode(t)
                }, a.hideDropdown = function (t) {
                    r.hideSubmenuDropdown(t, !0)
                }, a.pauseDropdownHover = function (t) {
                    r.pauseDropdownHover(t)
                }, a.resumeDropdownHover = function () {
                    return r.resumeDropdownHover()
                }, a.on = function (t, e) {
                    return r.addEvent(t, e)
                }, a.off = function (t) {
                    return r.removeEvent(t)
                }, a.one = function (t, e) {
                    return r.addEvent(t, e, !0)
                }, r.construct.apply(a, [e]), KTUtil.addResizeHandler(function () {
                    n && a.reload()
                }), n = !0, a
            }
        };
document.addEventListener("click", function (t) {
    var e;
    if (e = KTUtil.get("body").querySelectorAll('.kt-menu__nav .kt-menu__item.kt-menu__item--submenu.kt-menu__item--hover:not(.kt-menu__item--tabs)[data-ktmenu-submenu-toggle="click"]'))
        for (var a = 0, n = e.length; a < n; a++) {
            var o = e[a].closest(".kt-menu__nav").parentNode;
            if (o) {
                var i, l = KTUtil.data(o).get("menu");
                if (!l)
                    break;
                if (!l || "dropdown" !== l.getSubmenuMode())
                    break;
                if (t.target !== o && !1 === o.contains(t.target))
                    if (i = o.querySelectorAll('.kt-menu__item--submenu.kt-menu__item--hover:not(.kt-menu__item--tabs)[data-ktmenu-submenu-toggle="click"]'))
                        for (var r = 0, s = i.length; r < s; r++)
                            l.hideDropdown(i[r])
            }
        }
});
var KTOffcanvas = function (t, e) {
    var a = this,
            n = KTUtil.get(t),
            o = KTUtil.get("body");
    if (n) {
        var i = {},
                l = {
                    construct: function (t) {
                        return KTUtil.data(n).has("offcanvas") ? a = KTUtil.data(n).get("offcanvas") : (l.init(t), l.build(), KTUtil.data(n).set("offcanvas", a)), a
                    },
                    init: function (t) {
                        a.events = [], a.options = KTUtil.deepExtend({}, i, t), a.overlay, a.classBase = a.options.baseClass, a.classShown = a.classBase + "--on", a.classOverlay = a.classBase + "-overlay", a.state = KTUtil.hasClass(n, a.classShown) ? "shown" : "hidden"
                    },
                    build: function () {
                        if (a.options.toggleBy)
                            if ("string" == typeof a.options.toggleBy)
                                KTUtil.addEvent(a.options.toggleBy, "click", function (t) {
                                    t.preventDefault(), l.toggle()
                                });
                            else if (a.options.toggleBy && a.options.toggleBy[0] && a.options.toggleBy[0].target)
                                for (var t in a.options.toggleBy)
                                    KTUtil.addEvent(a.options.toggleBy[t].target, "click", function (t) {
                                        t.preventDefault(), l.toggle()
                                    });
                            else
                                a.options.toggleBy && a.options.toggleBy.target && KTUtil.addEvent(a.options.toggleBy.target, "click", function (t) {
                                    t.preventDefault(), l.toggle()
                                });
                        var e = KTUtil.get(a.options.closeBy);
                        e && KTUtil.addEvent(e, "click", function (t) {
                            t.preventDefault(), l.hide()
                        })
                    },
                    isShown: function (t) {
                        return "shown" == a.state
                    },
                    toggle: function () {
                        l.eventTrigger("toggle"), "shown" == a.state ? l.hide(this) : l.show(this)
                    },
                    show: function (t) {
                        "shown" != a.state && (l.eventTrigger("beforeShow"), l.togglerClass(t, "show"), KTUtil.addClass(o, a.classShown), KTUtil.addClass(n, a.classShown), a.state = "shown", a.options.overlay && (a.overlay = KTUtil.insertAfter(document.createElement("DIV"), n), KTUtil.addClass(a.overlay, a.classOverlay), KTUtil.addEvent(a.overlay, "click", function (e) {
                            e.stopPropagation(), e.preventDefault(), l.hide(t)
                        })), l.eventTrigger("afterShow"))
                    },
                    hide: function (t) {
                        "hidden" != a.state && (l.eventTrigger("beforeHide"), l.togglerClass(t, "hide"), KTUtil.removeClass(o, a.classShown), KTUtil.removeClass(n, a.classShown), a.state = "hidden", a.options.overlay && a.overlay && KTUtil.remove(a.overlay), l.eventTrigger("afterHide"))
                    },
                    togglerClass: function (t, e) {
                        var n, o = KTUtil.attr(t, "id");
                        if (a.options.toggleBy && a.options.toggleBy[0] && a.options.toggleBy[0].target)
                            for (var i in a.options.toggleBy)
                                a.options.toggleBy[i].target === o && (n = a.options.toggleBy[i]);
                        else
                            a.options.toggleBy && a.options.toggleBy.target && (n = a.options.toggleBy);
                        if (n) {
                            var l = KTUtil.get(n.target);
                            "show" === e && KTUtil.addClass(l, n.state), "hide" === e && KTUtil.removeClass(l, n.state)
                        }
                    },
                    eventTrigger: function (t, e) {
                        for (var n = 0; n < a.events.length; n++) {
                            var o = a.events[n];
                            o.name == t && (1 == o.one ? 0 == o.fired && (a.events[n].fired = !0, o.handler.call(this, a, e)) : o.handler.call(this, a, e))
                        }
                    },
                    addEvent: function (t, e, n) {
                        a.events.push({
                            name: t,
                            handler: e,
                            one: n,
                            fired: !1
                        })
                    }
                };
        return a.setDefaults = function (t) {
            i = t
        }, a.isShown = function () {
            return l.isShown()
        }, a.hide = function () {
            return l.hide()
        }, a.show = function () {
            return l.show()
        }, a.on = function (t, e) {
            return l.addEvent(t, e)
        }, a.one = function (t, e) {
            return l.addEvent(t, e, !0)
        }, l.construct.apply(a, [e]), !0, a
    }
},
        KTPortlet = function (t, e) {
            var a = this,
                    n = KTUtil.get(t),
                    o = KTUtil.get("body");
            if (n) {
                var i = {
                    bodyToggleSpeed: 400,
                    tooltips: !0,
                    tools: {
                        toggle: {
                            collapse: "Collapse",
                            expand: "Expand"
                        },
                        reload: "Reload",
                        remove: "Remove",
                        fullscreen: {
                            on: "Fullscreen",
                            off: "Exit Fullscreen"
                        }
                    },
                    sticky: {
                        offset: 300,
                        zIndex: 101
                    }
                },
                        l = {
                            construct: function (t) {
                                return KTUtil.data(n).has("portlet") ? a = KTUtil.data(n).get("portlet") : (l.init(t), l.build(), KTUtil.data(n).set("portlet", a)), a
                            },
                            init: function (t) {
                                a.element = n, a.events = [], a.options = KTUtil.deepExtend({}, i, t), a.head = KTUtil.child(n, ".kt-portlet__head"), a.foot = KTUtil.child(n, ".kt-portlet__foot"), KTUtil.child(n, ".kt-portlet__body") ? a.body = KTUtil.child(n, ".kt-portlet__body") : KTUtil.child(n, ".kt-form") && (a.body = KTUtil.child(n, ".kt-form"))
                            },
                            build: function () {
                                var t = KTUtil.find(a.head, "[data-ktportlet-tool=remove]");
                                t && KTUtil.addEvent(t, "click", function (t) {
                                    t.preventDefault(), l.remove()
                                });
                                var e = KTUtil.find(a.head, "[data-ktportlet-tool=reload]");
                                e && KTUtil.addEvent(e, "click", function (t) {
                                    t.preventDefault(), l.reload()
                                });
                                var n = KTUtil.find(a.head, "[data-ktportlet-tool=toggle]");
                                n && KTUtil.addEvent(n, "click", function (t) {
                                    t.preventDefault(), l.toggle()
                                });
                                var o = KTUtil.find(a.head, "[data-ktportlet-tool=fullscreen]");
                                o && KTUtil.addEvent(o, "click", function (t) {
                                    t.preventDefault(), l.fullscreen()
                                }), l.setupTooltips()
                            },
                            initSticky: function () {
                                a.options.sticky.offset;
                                a.head && window.addEventListener("scroll", l.onScrollSticky)
                            },
                            onScrollSticky: function (t) {
                                var e = a.options.sticky.offset;
                                if (!isNaN(e)) {
                                    var i = document.documentElement.scrollTop;
                                    i >= e && !1 === KTUtil.hasClass(o, "kt-portlet--sticky") ? (l.eventTrigger("stickyOn"), KTUtil.addClass(o, "kt-portlet--sticky"), KTUtil.addClass(n, "kt-portlet--sticky"), l.updateSticky()) : 1.5 * i <= e && KTUtil.hasClass(o, "kt-portlet--sticky") && (l.eventTrigger("stickyOff"), KTUtil.removeClass(o, "kt-portlet--sticky"), KTUtil.removeClass(n, "kt-portlet--sticky"), l.resetSticky())
                                }
                            },
                            updateSticky: function () {
                                var t, e, n;
                                a.head && (KTUtil.hasClass(o, "kt-portlet--sticky") && (t = a.options.sticky.position.top instanceof Function ? parseInt(a.options.sticky.position.top.call()) : parseInt(a.options.sticky.position.top), e = a.options.sticky.position.left instanceof Function ? parseInt(a.options.sticky.position.left.call()) : parseInt(a.options.sticky.position.left), n = a.options.sticky.position.right instanceof Function ? parseInt(a.options.sticky.position.right.call()) : parseInt(a.options.sticky.position.right), KTUtil.css(a.head, "z-index", a.options.sticky.zIndex), KTUtil.css(a.head, "top", t + "px"), KTUtil.css(a.head, "left", e + "px"), KTUtil.css(a.head, "right", n + "px")))
                            },
                            resetSticky: function () {
                                a.head && !1 === KTUtil.hasClass(o, "kt-portlet--sticky") && (KTUtil.css(a.head, "z-index", ""), KTUtil.css(a.head, "top", ""), KTUtil.css(a.head, "left", ""), KTUtil.css(a.head, "right", ""))
                            },
                            remove: function () {
                                !1 !== l.eventTrigger("beforeRemove") && (KTUtil.hasClass(o, "kt-portlet--fullscreen") && KTUtil.hasClass(n, "kt-portlet--fullscreen") && l.fullscreen("off"), l.removeTooltips(), KTUtil.remove(n), l.eventTrigger("afterRemove"))
                            },
                            setContent: function (t) {
                                t && (a.body.innerHTML = t)
                            },
                            getBody: function () {
                                return a.body
                            },
                            getSelf: function () {
                                return n
                            },
                            setupTooltips: function () {
                                if (a.options.tooltips) {
                                    var t = KTUtil.hasClass(n, "kt-portlet--collapse") || KTUtil.hasClass(n, "kt-portlet--collapsed"),
                                            e = KTUtil.hasClass(o, "kt-portlet--fullscreen") && KTUtil.hasClass(n, "kt-portlet--fullscreen"),
                                            i = KTUtil.find(a.head, "[data-ktportlet-tool=remove]");
                                    if (i) {
                                        var l = e ? "bottom" : "top",
                                                r = new Tooltip(i, {
                                                    title: a.options.tools.remove,
                                                    placement: l,
                                                    offset: e ? "0,10px,0,0" : "0,5px",
                                                    trigger: "hover",
                                                    template: '<div class="tooltip tooltip-portlet tooltip bs-tooltip-' + l + '" role="tooltip">                            <div class="tooltip-arrow arrow"></div>                            <div class="tooltip-inner"></div>                        </div>'
                                                });
                                        KTUtil.data(i).set("tooltip", r)
                                    }
                                    var s = KTUtil.find(a.head, "[data-ktportlet-tool=reload]");
                                    if (s) {
                                        l = e ? "bottom" : "top", r = new Tooltip(s, {
                                            title: a.options.tools.reload,
                                            placement: l,
                                            offset: e ? "0,10px,0,0" : "0,5px",
                                            trigger: "hover",
                                            template: '<div class="tooltip tooltip-portlet tooltip bs-tooltip-' + l + '" role="tooltip">                            <div class="tooltip-arrow arrow"></div>                            <div class="tooltip-inner"></div>                        </div>'
                                        });
                                        KTUtil.data(s).set("tooltip", r)
                                    }
                                    var d = KTUtil.find(a.head, "[data-ktportlet-tool=toggle]");
                                    if (d) {
                                        l = e ? "bottom" : "top", r = new Tooltip(d, {
                                            title: t ? a.options.tools.toggle.expand : a.options.tools.toggle.collapse,
                                            placement: l,
                                            offset: e ? "0,10px,0,0" : "0,5px",
                                            trigger: "hover",
                                            template: '<div class="tooltip tooltip-portlet tooltip bs-tooltip-' + l + '" role="tooltip">                            <div class="tooltip-arrow arrow"></div>                            <div class="tooltip-inner"></div>                        </div>'
                                        });
                                        KTUtil.data(d).set("tooltip", r)
                                    }
                                    var c = KTUtil.find(a.head, "[data-ktportlet-tool=fullscreen]");
                                    if (c) {
                                        l = e ? "bottom" : "top", r = new Tooltip(c, {
                                            title: e ? a.options.tools.fullscreen.off : a.options.tools.fullscreen.on,
                                            placement: l,
                                            offset: e ? "0,10px,0,0" : "0,5px",
                                            trigger: "hover",
                                            template: '<div class="tooltip tooltip-portlet tooltip bs-tooltip-' + l + '" role="tooltip">                            <div class="tooltip-arrow arrow"></div>                            <div class="tooltip-inner"></div>                        </div>'
                                        });
                                        KTUtil.data(c).set("tooltip", r)
                                    }
                                }
                            },
                            removeTooltips: function () {
                                if (a.options.tooltips) {
                                    var t = KTUtil.find(a.head, "[data-ktportlet-tool=remove]");
                                    t && KTUtil.data(t).has("tooltip") && KTUtil.data(t).get("tooltip").dispose();
                                    var e = KTUtil.find(a.head, "[data-ktportlet-tool=reload]");
                                    e && KTUtil.data(e).has("tooltip") && KTUtil.data(e).get("tooltip").dispose();
                                    var n = KTUtil.find(a.head, "[data-ktportlet-tool=toggle]");
                                    n && KTUtil.data(n).has("tooltip") && KTUtil.data(n).get("tooltip").dispose();
                                    var o = KTUtil.find(a.head, "[data-ktportlet-tool=fullscreen]");
                                    o && KTUtil.data(o).has("tooltip") && KTUtil.data(o).get("tooltip").dispose()
                                }
                            },
                            reload: function () {
                                l.eventTrigger("reload")
                            },
                            toggle: function () {
                                KTUtil.hasClass(n, "kt-portlet--collapse") || KTUtil.hasClass(n, "kt-portlet--collapsed") ? l.expand() : l.collapse()
                            },
                            collapse: function () {
                                if (!1 !== l.eventTrigger("beforeCollapse")) {
                                    KTUtil.slideUp(a.body, a.options.bodyToggleSpeed, function () {
                                        l.eventTrigger("afterCollapse")
                                    }), KTUtil.addClass(n, "kt-portlet--collapse");
                                    var t = KTUtil.find(a.head, "[data-ktportlet-tool=toggle]");
                                    t && KTUtil.data(t).has("tooltip") && KTUtil.data(t).get("tooltip").updateTitleContent(a.options.tools.toggle.expand)
                                }
                            },
                            expand: function () {
                                if (!1 !== l.eventTrigger("beforeExpand")) {
                                    KTUtil.slideDown(a.body, a.options.bodyToggleSpeed, function () {
                                        l.eventTrigger("afterExpand")
                                    }), KTUtil.removeClass(n, "kt-portlet--collapse"), KTUtil.removeClass(n, "kt-portlet--collapsed");
                                    var t = KTUtil.find(a.head, "[data-ktportlet-tool=toggle]");
                                    t && KTUtil.data(t).has("tooltip") && KTUtil.data(t).get("tooltip").updateTitleContent(a.options.tools.toggle.collapse)
                                }
                            },
                            fullscreen: function (t) {
                                if ("off" === t || KTUtil.hasClass(o, "kt-portlet--fullscreen") && KTUtil.hasClass(n, "kt-portlet--fullscreen"))
                                    l.eventTrigger("beforeFullscreenOff"), KTUtil.removeClass(o, "kt-portlet--fullscreen"), KTUtil.removeClass(n, "kt-portlet--fullscreen"), l.removeTooltips(), l.setupTooltips(), a.foot && (KTUtil.css(a.body, "margin-bottom", ""), KTUtil.css(a.foot, "margin-top", "")), l.eventTrigger("afterFullscreenOff");
                                else {
                                    if (l.eventTrigger("beforeFullscreenOn"), KTUtil.addClass(n, "kt-portlet--fullscreen"), KTUtil.addClass(o, "kt-portlet--fullscreen"), l.removeTooltips(), l.setupTooltips(), a.foot) {
                                        var e = parseInt(KTUtil.css(a.foot, "height")),
                                                i = parseInt(KTUtil.css(a.foot, "height")) + parseInt(KTUtil.css(a.head, "height"));
                                        KTUtil.css(a.body, "margin-bottom", e + "px"), KTUtil.css(a.foot, "margin-top", "-" + i + "px")
                                    }
                                    l.eventTrigger("afterFullscreenOn")
                                }
                            },
                            eventTrigger: function (t) {
                                for (var e = 0; e < a.events.length; e++) {
                                    var n = a.events[e];
                                    n.name == t && (1 == n.one ? 0 == n.fired && (a.events[e].fired = !0, n.handler.call(this, a)) : n.handler.call(this, a))
                                }
                            },
                            addEvent: function (t, e, n) {
                                return a.events.push({
                                    name: t,
                                    handler: e,
                                    one: n,
                                    fired: !1
                                }), a
                            }
                        };
                return a.setDefaults = function (t) {
                    i = t
                }, a.remove = function () {
                    return l.remove(html)
                }, a.initSticky = function () {
                    return l.initSticky()
                }, a.updateSticky = function () {
                    return l.updateSticky()
                }, a.resetSticky = function () {
                    return l.resetSticky()
                }, a.destroySticky = function () {
                    l.resetSticky(), window.removeEventListener("scroll", l.onScrollSticky)
                }, a.reload = function () {
                    return l.reload()
                }, a.setContent = function (t) {
                    return l.setContent(t)
                }, a.toggle = function () {
                    return l.toggle()
                }, a.collapse = function () {
                    return l.collapse()
                }, a.expand = function () {
                    return l.expand()
                }, a.fullscreen = function () {
                    return l.fullscreen("on")
                }, a.unFullscreen = function () {
                    return l.fullscreen("off")
                }, a.getBody = function () {
                    return l.getBody()
                }, a.getSelf = function () {
                    return l.getSelf()
                }, a.on = function (t, e) {
                    return l.addEvent(t, e)
                }, a.one = function (t, e) {
                    return l.addEvent(t, e, !0)
                }, l.construct.apply(a, [e]), a
            }
        },
        KTScrolltop = function (t, e) {
            var a = this,
                    n = KTUtil.get(t),
                    o = KTUtil.get("body");
            if (n) {
                var i = {
                    offset: 300,
                    speed: 600,
                    toggleClass: "kt-scrolltop--on"
                },
                        l = {
                            construct: function (t) {
                                return KTUtil.data(n).has("scrolltop") ? a = KTUtil.data(n).get("scrolltop") : (l.init(t), l.build(), KTUtil.data(n).set("scrolltop", a)), a
                            },
                            init: function (t) {
                                a.events = [], a.options = KTUtil.deepExtend({}, i, t)
                            },
                            build: function () {
                                navigator.userAgent.match(/iPhone|iPad|iPod/i) ? (window.addEventListener("touchend", function () {
                                    l.handle()
                                }), window.addEventListener("touchcancel", function () {
                                    l.handle()
                                }), window.addEventListener("touchleave", function () {
                                    l.handle()
                                })) : window.addEventListener("scroll", function () {
                                    l.handle()
                                }), KTUtil.addEvent(n, "click", l.scroll)
                            },
                            handle: function () {
                                window.pageYOffset > a.options.offset ? KTUtil.addClass(o, a.options.toggleClass) : KTUtil.removeClass(o, a.options.toggleClass)
                            },
                            scroll: function (t) {
                                t.preventDefault(), KTUtil.scrollTop(0, a.options.speed)
                            },
                            eventTrigger: function (t, e) {
                                for (var n = 0; n < a.events.length; n++) {
                                    var o = a.events[n];
                                    o.name == t && (1 == o.one ? 0 == o.fired && (a.events[n].fired = !0, o.handler.call(this, a, e)) : o.handler.call(this, a, e))
                                }
                            },
                            addEvent: function (t, e, n) {
                                a.events.push({
                                    name: t,
                                    handler: e,
                                    one: n,
                                    fired: !1
                                })
                            }
                        };
                return a.setDefaults = function (t) {
                    i = t
                }, a.on = function (t, e) {
                    return l.addEvent(t, e)
                }, a.one = function (t, e) {
                    return l.addEvent(t, e, !0)
                }, l.construct.apply(a, [e]), !0, a
            }
        },
        KTToggle = function (t, e) {
            var a = this,
                    n = KTUtil.get(t);
            KTUtil.get("body");
            if (n) {
                var o = {
                    togglerState: "",
                    targetState: ""
                },
                        i = {
                            construct: function (t) {
                                return KTUtil.data(n).has("toggle") ? a = KTUtil.data(n).get("toggle") : (i.init(t), i.build(), KTUtil.data(n).set("toggle", a)), a
                            },
                            init: function (t) {
                                a.element = n, a.events = [], a.options = KTUtil.deepExtend({}, o, t), a.target = KTUtil.get(a.options.target), a.targetState = a.options.targetState, a.togglerState = a.options.togglerState, a.state = KTUtil.hasClasses(a.target, a.targetState) ? "on" : "off"
                            },
                            build: function () {
                                KTUtil.addEvent(n, "mouseup", i.toggle)
                            },
                            toggle: function (t) {
                                return i.eventTrigger("beforeToggle"), "off" == a.state ? i.toggleOn() : i.toggleOff(), i.eventTrigger("afterToggle"), t.preventDefault(), a
                            },
                            toggleOn: function () {
                                return i.eventTrigger("beforeOn"), KTUtil.addClass(a.target, a.targetState), a.togglerState && KTUtil.addClass(n, a.togglerState), a.state = "on", i.eventTrigger("afterOn"), i.eventTrigger("toggle"), a
                            },
                            toggleOff: function () {
                                return i.eventTrigger("beforeOff"), KTUtil.removeClass(a.target, a.targetState), a.togglerState && KTUtil.removeClass(n, a.togglerState), a.state = "off", i.eventTrigger("afterOff"), i.eventTrigger("toggle"), a
                            },
                            eventTrigger: function (t) {
                                for (var e = 0; e < a.events.length; e++) {
                                    var n = a.events[e];
                                    n.name == t && (1 == n.one ? 0 == n.fired && (a.events[e].fired = !0, n.handler.call(this, a)) : n.handler.call(this, a))
                                }
                            },
                            addEvent: function (t, e, n) {
                                return a.events.push({
                                    name: t,
                                    handler: e,
                                    one: n,
                                    fired: !1
                                }), a
                            }
                        };
                return a.setDefaults = function (t) {
                    o = t
                }, a.getState = function () {
                    return a.state
                }, a.toggle = function () {
                    return i.toggle()
                }, a.toggleOn = function () {
                    return i.toggleOn()
                }, a.toggleOff = function () {
                    return i.toggleOff()
                }, a.on = function (t, e) {
                    return i.addEvent(t, e)
                }, a.one = function (t, e) {
                    return i.addEvent(t, e, !0)
                }, i.construct.apply(a, [e]), a
            }
        },
        KTWizard = function (t, e) {
            var a = this,
                    n = KTUtil.get(t);
            KTUtil.get("body");
            if (n) {
                var o = {
                    startStep: 1,
                    manualStepForward: !1
                },
                        i = {
                            construct: function (t) {
                                return KTUtil.data(n).has("wizard") ? a = KTUtil.data(n).get("wizard") : (i.init(t), i.build(), KTUtil.data(n).set("wizard", a)), a
                            },
                            init: function (t) {
                                a.element = n, a.events = [], a.options = KTUtil.deepExtend({}, o, t), a.steps = KTUtil.findAll(n, '[data-ktwizard-type="step"]'), a.btnSubmit = KTUtil.find(n, '[data-ktwizard-type="action-submit"]'), a.btnNext = KTUtil.find(n, '[data-ktwizard-type="action-next"]'), a.btnPrev = KTUtil.find(n, '[data-ktwizard-type="action-prev"]'), a.btnLast = KTUtil.find(n, '[data-ktwizard-type="action-last"]'), a.btnFirst = KTUtil.find(n, '[data-ktwizard-type="action-first"]'), a.events = [], a.currentStep = 1, a.stopped = !1, a.totalSteps = a.steps.length, a.options.startStep > 1 && i.goTo(a.options.startStep), i.updateUI()
                            },
                            build: function () {
                                KTUtil.addEvent(a.btnNext, "click", function (t) {
                                    t.preventDefault(), i.goNext()
                                }), KTUtil.addEvent(a.btnPrev, "click", function (t) {
                                    t.preventDefault(), i.goPrev()
                                }), KTUtil.addEvent(a.btnFirst, "click", function (t) {
                                    t.preventDefault(), i.goFirst()
                                }), KTUtil.addEvent(a.btnLast, "click", function (t) {
                                    t.preventDefault(), i.goLast()
                                }), KTUtil.on(n, 'a[data-ktwizard-type="step"]', "click", function () {
                                    var t = KTUtil.index(this) + 1;
                                    t !== a.currentStep && i.goTo(t)
                                })
                            },
                            goTo: function (t) {
                                if (!(t === a.currentStep || t > a.totalSteps || t < 0)) {
                                    var e;
                                    if (e = (t = t ? parseInt(t) : i.getNextStep()) > a.currentStep ? i.eventTrigger("beforeNext") : i.eventTrigger("beforePrev"), !0 !== a.stopped)
                                        return !1 !== e && (i.eventTrigger("beforeChange"), a.currentStep = t, i.updateUI(), i.eventTrigger("change")), t > a.startStep ? i.eventTrigger("afterNext") : i.eventTrigger("afterPrev"), a;
                                    a.stopped = !1
                                }
                            },
                            stop: function () {
                                a.stopped = !0
                            },
                            start: function () {
                                a.stopped = !1
                            },
                            isLastStep: function () {
                                return a.currentStep === a.totalSteps
                            },
                            isFirstStep: function () {
                                return 1 === a.currentStep
                            },
                            isBetweenStep: function () {
                                return !1 === i.isLastStep() && !1 === i.isFirstStep()
                            },
                            goNext: function () {
                                return i.goTo(i.getNextStep())
                            },
                            goPrev: function () {
                                return i.goTo(i.getPrevStep())
                            },
                            goLast: function () {
                                return i.goTo(a.totalSteps)
                            },
                            goFirst: function () {
                                return i.goTo(1)
                            },
                            updateUI: function () {
                                var t = "",
                                        e = a.currentStep - 1;
                                t = i.isLastStep() ? "last" : i.isFirstStep() ? "first" : "between", KTUtil.attr(a.element, "data-ktwizard-state", t);
                                var n = KTUtil.findAll(a.element, '[data-ktwizard-type="step"]');
                                if (n && n.length > 0)
                                    for (var o = 0, l = n.length; o < l; o++)
                                        o == e ? KTUtil.attr(n[o], "data-ktwizard-state", "current") : o < e ? KTUtil.attr(n[o], "data-ktwizard-state", "done") : KTUtil.attr(n[o], "data-ktwizard-state", "pending");
                                var r = KTUtil.findAll(a.element, '[data-ktwizard-type="step-info"]');
                                if (r && r.length > 0)
                                    for (o = 0, l = r.length; o < l; o++)
                                        o == e ? KTUtil.attr(r[o], "data-ktwizard-state", "current") : KTUtil.removeAttr(r[o], "data-ktwizard-state");
                                var s = KTUtil.findAll(a.element, '[data-ktwizard-type="step-content"]');
                                if (s && s.length > 0)
                                    for (o = 0, l = s.length; o < l; o++)
                                        o == e ? KTUtil.attr(s[o], "data-ktwizard-state", "current") : KTUtil.removeAttr(s[o], "data-ktwizard-state")
                            },
                            getNextStep: function () {
                                return a.totalSteps >= a.currentStep + 1 ? a.currentStep + 1 : a.totalSteps
                            },
                            getPrevStep: function () {
                                return a.currentStep - 1 >= 1 ? a.currentStep - 1 : 1
                            },
                            eventTrigger: function (t) {
                                for (var e = 0; e < a.events.length; e++) {
                                    var n = a.events[e];
                                    n.name == t && (1 == n.one ? 0 == n.fired && (a.events[e].fired = !0, n.handler.call(this, a)) : n.handler.call(this, a))
                                }
                            },
                            addEvent: function (t, e, n) {
                                return a.events.push({
                                    name: t,
                                    handler: e,
                                    one: n,
                                    fired: !1
                                }), a
                            }
                        };
                return a.setDefaults = function (t) {
                    o = t
                }, a.goNext = function () {
                    return i.goNext()
                }, a.goPrev = function () {
                    return i.goPrev()
                }, a.goLast = function () {
                    return i.goLast()
                }, a.stop = function () {
                    return i.stop()
                }, a.start = function () {
                    return i.start()
                }, a.goFirst = function () {
                    return i.goFirst()
                }, a.goTo = function (t) {
                    return i.goTo(t)
                }, a.getStep = function () {
                    return a.currentStep
                }, a.isLastStep = function () {
                    return i.isLastStep()
                }, a.isFirstStep = function () {
                    return i.isFirstStep()
                }, a.on = function (t, e) {
                    return i.addEvent(t, e)
                }, a.one = function (t, e) {
                    return i.addEvent(t, e, !0)
                }, i.construct.apply(a, [e]), a
            }
        },
        KTAvatar = function (t, e) {
            var a = this,
                    n = KTUtil.get(t);
            KTUtil.get("body");
            if (n) {
                var o = {},
                        i = {
                            construct: function (t) {
                                return KTUtil.data(n).has("avatar") ? a = KTUtil.data(n).get("avatar") : (i.init(t), i.build(), KTUtil.data(n).set("avatar", a)), a
                            },
                            init: function (t) {
                                a.element = n, a.events = [], a.input = KTUtil.find(n, 'input[type="file"]'), a.holder = KTUtil.find(n, ".kt-avatar__holder"), a.cancel = KTUtil.find(n, ".kt-avatar__cancel"), a.src = KTUtil.css(a.holder, "backgroundImage"), a.options = KTUtil.deepExtend({}, o, t)
                            },
                            build: function () {
                                KTUtil.addEvent(a.input, "change", function (t) {
                                    if (t.preventDefault(), a.input && a.input.files && a.input.files[0]) {
                                        var e = new FileReader;
                                        e.onload = function (t) {
                                            KTUtil.css(a.holder, "background-image", "url(" + t.target.result + ")")
                                        }, e.readAsDataURL(a.input.files[0]), KTUtil.addClass(a.element, "kt-avatar--changed")
                                    }
                                }), KTUtil.addEvent(a.cancel, "click", function (t) {
                                    t.preventDefault(), KTUtil.removeClass(a.element, "kt-avatar--changed"), KTUtil.css(a.holder, "background-image", a.src), a.input.value = ""
                                })
                            },
                            eventTrigger: function (t) {
                                for (var e = 0; e < a.events.length; e++) {
                                    var n = a.events[e];
                                    n.name == t && (1 == n.one ? 0 == n.fired && (a.events[e].fired = !0, n.handler.call(this, a)) : n.handler.call(this, a))
                                }
                            },
                            addEvent: function (t, e, n) {
                                return a.events.push({
                                    name: t,
                                    handler: e,
                                    one: n,
                                    fired: !1
                                }), a
                            }
                        };
                return a.setDefaults = function (t) {
                    o = t
                }, a.on = function (t, e) {
                    return i.addEvent(t, e)
                }, a.one = function (t, e) {
                    return i.addEvent(t, e, !0)
                }, i.construct.apply(a, [e]), a
            }
        },
        KTLayout = function () {
            var t, e, a, n, o, i, l, r, s = function () {
                return new KTPortlet("kt_page_portlet", {
                    sticky: {
                        offset: parseInt(KTUtil.css(KTUtil.get("kt_header"), "height")),
                        zIndex: 90,
                        position: {
                            top: function () {
                                var e = 0;
                                return KTUtil.isInResponsiveRange("desktop") ? (KTUtil.hasClass(t, "kt-header--fixed") && (e += parseInt(KTUtil.css(KTUtil.get("kt_header"), "height"))), KTUtil.hasClass(t, "kt-subheader--fixed") && KTUtil.get("kt_subheader") && (e += parseInt(KTUtil.css(KTUtil.get("kt_subheader"), "height")))) : KTUtil.hasClass(t, "kt-header-mobile--fixed") && (e += parseInt(KTUtil.css(KTUtil.get("kt_header_mobile"), "height"))), e
                            },
                            left: function () {
                                var e = 0;
                                return KTUtil.isInResponsiveRange("desktop") && (KTUtil.hasClass(t, "kt-aside--minimize") ? e += 78 : KTUtil.hasClass(t, "kt-aside--enabled") && (e += 255)), e += parseInt(KTUtil.css(KTUtil.get("kt_content"), "paddingLeft"))
                            },
                            right: function () {
                                var e = 0;
                                return KTUtil.isInResponsiveRange("desktop") && (KTUtil.hasClass(t, "kt-aside-secondary--enabled") ? KTUtil.hasClass(t, "kt-aside-secondary--expanded") ? e += 370 : e += 60 : e += parseInt(KTUtil.css(KTUtil.get("kt_content"), "paddingRight"))), KTUtil.get("kt_aside_secondary") && (e += parseInt(KTUtil.css(KTUtil.get("kt_content"), "paddingRight"))), e
                            }
                        }
                    }
                })
            };
            return {
                init: function () {
                    t = KTUtil.get("body"), this.initHeader(), this.initAside(), this.initAsideSecondary(), this.initPageStickyPortlet(), $("#kt_aside_menu, #kt_header_menu").on("click", '.kt-menu__link[href="#"]', function (t) {
                        swal("", "You have clicked on a non-functional dummy link!"), t.preventDefault()
                    })
                },
                initHeader: function () {
                    var t, n, o;
                    n = KTUtil.get("kt_header"), o = {
                        offset: {},
                        minimize: {
                            desktop: !1,
                            mobile: !1
                        }
                    }, (t = KTUtil.attr(n, "data-ktheader-minimize-offset")) && (o.offset.desktop = t), (t = KTUtil.attr(n, "data-ktheader-minimize-mobile-offset")) && (o.offset.mobile = t), new KTHeader("kt_header", o), a = new KTOffcanvas("kt_header_menu_wrapper", {
                        overlay: !0,
                        baseClass: "kt-header-menu-wrapper",
                        closeBy: "kt_header_menu_mobile_close_btn",
                        toggleBy: {
                            target: "kt_header_mobile_toggler",
                            state: "kt-header-mobile__toolbar-toggler--active"
                        }
                    }), e = new KTMenu("kt_header_menu", {
                        submenu: {
                            desktop: "dropdown",
                            tablet: "accordion",
                            mobile: "accordion"
                        },
                        accordion: {
                            slideSpeed: 200,
                            expandAll: !1
                        }
                    }), i = new KTToggle("kt_header_mobile_topbar_toggler", {
                        target: "body",
                        targetState: "kt-header__topbar--mobile-on",
                        togglerState: "kt-header-mobile__toolbar-topbar-toggler--active"
                    }), new KTScrolltop("kt_scrolltop", {
                        offset: 300,
                        speed: 600
                    })
                },
                initAside: function () {
                    var a, l, s, d, c, u, p;
                    s = KTUtil.get("kt_aside"), KTUtil.get("kt_aside_brand"), d = KTUtil.hasClass(s, "kt-aside--offcanvas-default") ? "kt-aside--offcanvas-default" : "kt-aside", o = new KTOffcanvas("kt_aside", {
                        baseClass: d,
                        overlay: !0,
                        closeBy: "kt_aside_close_btn",
                        toggleBy: {
                            target: "kt_aside_mobile_toggler",
                            state: "kt-header-mobile__toolbar-toggler--active"
                        }
                    }), KTUtil.hasClass(t, "kt-aside--fixed") && (KTUtil.addEvent(s, "mouseenter", function (e) {
                        e.preventDefault(), !1 !== KTUtil.isInResponsiveRange("desktop") && (l && (clearTimeout(l), l = null), a = setTimeout(function () {
                            KTUtil.hasClass(t, "kt-aside--minimize") && KTUtil.isInResponsiveRange("desktop") && (KTUtil.removeClass(t, "kt-aside--minimize"), KTUtil.addClass(t, "kt-aside--minimizing"), KTUtil.transitionEnd(t, function () {
                                KTUtil.removeClass(t, "kt-aside--minimizing")
                            }), KTUtil.addClass(t, "kt-aside--minimize-hover"), n.scrollUpdate(), n.scrollTop())
                        }, 50))
                    }), KTUtil.addEvent(s, "mouseleave", function (e) {
                        e.preventDefault(), !1 !== KTUtil.isInResponsiveRange("desktop") && (a && (clearTimeout(a), a = null), l = setTimeout(function () {
                            KTUtil.hasClass(t, "kt-aside--minimize-hover") && KTUtil.isInResponsiveRange("desktop") && (KTUtil.removeClass(t, "kt-aside--minimize-hover"), KTUtil.addClass(t, "kt-aside--minimize"), KTUtil.addClass(t, "kt-aside--minimizing"), KTUtil.transitionEnd(t, function () {
                                KTUtil.removeClass(t, "kt-aside--minimizing")
                            }), n.scrollUpdate(), n.scrollTop())
                        }, 100))
                    })), u = KTUtil.get("kt_aside_menu"), p = "1" === KTUtil.attr(u, "data-ktmenu-dropdown") ? "dropdown" : "accordion", "1" === KTUtil.attr(u, "data-ktmenu-scroll") && (c = {
                        height: function () {
                            var t;
                            return t = KTUtil.isInResponsiveRange("desktop") ? parseInt(KTUtil.getViewPort().height) - parseInt(KTUtil.actualHeight("kt_aside_brand")) - parseInt(KTUtil.getByID("kt_aside_footer") ? KTUtil.actualHeight("kt_aside_footer") : 0) : parseInt(KTUtil.getViewPort().height) - parseInt(KTUtil.getByID("kt_aside_footer") ? KTUtil.actualHeight("kt_aside_footer") : 0), t -= parseInt(KTUtil.css(u, "marginBottom")) + parseInt(KTUtil.css(u, "marginTop"))
                        }
                    }), n = new KTMenu("kt_aside_menu", {
                        scroll: c,
                        submenu: {
                            desktop: p,
                            tablet: "accordion",
                            mobile: "accordion"
                        },
                        accordion: {
                            expandAll: !1
                        }
                    }), KTUtil.get("kt_aside_toggler") && ((i = new KTToggle("kt_aside_toggler", {
                        target: "body",
                        targetState: "kt-aside--minimize",
                        togglerState: "kt-aside__brand-aside-toggler--active"
                    })).on("toggle", function (a) {
                        KTUtil.addClass(t, "kt-aside--minimizing"), KTUtil.get("kt_page_portlet") && r.updateSticky(), KTUtil.transitionEnd(t, function () {
                            KTUtil.removeClass(t, "kt-aside--minimizing")
                        }), e.pauseDropdownHover(800), n.pauseDropdownHover(800), Cookies.set("kt_aside_toggle_state", a.getState())
                    }), i.on("beforeToggle", function (t) {
                        var e = KTUtil.get("body");
                        !1 === KTUtil.hasClass(e, "kt-aside--minimize") && KTUtil.hasClass(e, "kt-aside--minimize-hover") && KTUtil.removeClass(e, "kt-aside--minimize-hover")
                    })), this.onAsideToggle(function (t) {
                        r && r.updateSticky();
                        var e = $(".kt-datatable");
                        e && e.each(function () {
                            $(this).KTDatatable("redraw")
                        })
                    })
                },
                initAsideSecondary: function () {
                    KTUtil.get("kt_aside_secondary") && (l = new KTToggle("kt_aside_secondary_toggler", {
                        target: "body",
                        targetState: "kt-aside-secondary--expanded"
                    })).on("toggle", function (t) {
                        KTUtil.get("kt_page_portlet") && r.updateSticky()
                    })
                },
                initPageStickyPortlet: function () {
                    KTUtil.get("kt_page_portlet") && ((r = s()).initSticky(), KTUtil.addResizeHandler(function () {
                        r.updateSticky()
                    }), s())
                },
                getAsideMenu: function () {
                    return n
                },
                onAsideToggle: function (t) {
                    void 0 !== i.element && i.on("toggle", t)
                },
                getAsideToggler: function () {
                    return i
                },
                openAsideSecondary: function () {
                    l.toggleOn()
                },
                closeAsideSecondary: function () {
                    l.toggleOff()
                },
                getAsideSecondaryToggler: function () {
                    return l
                },
                onAsideSecondaryToggle: function (t) {
                    l && l.on("toggle", t)
                },
                closeMobileAsideMenuOffcanvas: function () {
                    KTUtil.isMobileDevice() && o.hide()
                },
                closeMobileHeaderMenuOffcanvas: function () {
                    KTUtil.isMobileDevice() && a.hide()
                }
            }
        }();
$(document).ready(function () {
    KTLayout.init()
});