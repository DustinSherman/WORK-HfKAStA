let forEach = function (t, o, r) {
    if ("[object Object]" === Object.prototype.toString.call(t))
        for (var c in t) Object.prototype.hasOwnProperty.call(t, c) && o.call(r, t[c], c, t);
    else
        for (var e = 0, l = t.length; l > e; e++) o.call(r, t[e], e, t)
};

let hamburger = document.getElementById('hamburger');
let nav = document.getElementById("nav");

let languageSwitch = document.getElementById('language-switch');
let homeLink = document.getElementById('home-link');

let wrapper = document.getElementById('wrapper');

let pageElevator = document.getElementById('page-elevator');

let footer = document.getElementById('footer');
let footerHeight = document.getElementById('footer').offsetHeight;

let documentHeight = document.body.clientHeight;

window.onload = function () {
    scroll();
    setTickerValues();
    setWrapperPadding();
    getSubMenuHeights();
};

window.onscroll = function () {
    scroll();
};

window.onresize = function () {
    footerHeight = document.getElementById('footer').offsetHeight;

    scroll();
    setTickerValues();
    setWrapperPadding();
}

// Toogle Classes on hamburger Menu
hamburger.addEventListener("click", function () {
    this.classList.toggle("is-active");
    nav.classList.toggle("is-open");
}, false);

function scroll() {
    let elementTop = 0;
    let tickerHeight = 40;

    if (window.innerWidth >= 768) {
        tickerHeight = 50;
    }

    // Move Hamburger Menu & language switch
    if (window.pageYOffset <= 100) {
        if (window.pageYOffset <= tickerHeight) {
            elementTop = (tickerHeight - window.pageYOffset);
        } else {
            elementTop = 0;
        }
    }

    hamburger.style.top = elementTop + 'px';
    nav.style.top = elementTop + 'px';
    languageSwitch.style.top = elementTop + 'px';
    if (homeLink != null) {
        homeLink.style.top = elementTop + 'px';
    }

    // Show / Hide Page-Elevator
    if (pageElevator != null) {
        if (window.innerWidth >= 768) {
            if (window.pageYOffset > 400) {
                pageElevator.classList.add('show');
            } else {
                pageElevator.classList.remove('show');
            }
        }
    }
}

// Set animation values for ticker
function setTickerValues() {
    let ticker = document.getElementById('ticker');
    let tickerWidth = -ticker.clientWidth / tickerNewsCount;
    let tickerDuration = ticker.clientWidth * .01;
    let target = document.querySelector('#ticker-style');
    let style = document.createElement('style');

    style.innerHTML = ('.ticker-wrap .ticker {-webkit-animation-duration: ' + tickerDuration + 's;animation-duration: ' + tickerDuration + 's;} @-webkit-keyframes ticker {0% {-webkit-transform: translate3d(0, 0, 0);transform: translate3d(0, 0, 0);visibility: visible;}100% {-webkit-transform: translate3d(' + tickerWidth + 'px, 0, 0);transform: translate3d(' + tickerWidth + 'px, 0, 0);}}@keyframes ticker {0% {-webkit-transform: translate3d(0, 0, 0);transform: translate3d(0, 0, 0); visibility: visible;}100% {-webkit-transform: translate3d(' + tickerWidth + 'px, 0, 0);transform: translate3d(' + tickerWidth + 'px, 0, 0);}}')

    target.parentNode.insertBefore(style, target.nextSibling);
}

// Padding for wrapper and sticky footer
function setWrapperPadding() {
    wrapper.style.paddingBottom = footerHeight + 'px';
    footer.style.marginTop = -footerHeight + 'px';
}

// Open Sub-Menus
var navParents = document.querySelectorAll(".dropdown-btn");

if (navParents.length > 0) {
    forEach(navParents, function (navParent) {
        navParent.addEventListener("click", function () {
            let me = this;

            forEach(navParents, function (navParent) {
                if (navParent != me) {
                    navParent.parentNode.classList.remove("is-open");
                }
            });
            this.parentNode.classList.toggle("is-open");
        }, false);
    });
}

// Dont send empty searches
const form = document.querySelector('#search-form');
const searchfield = document.querySelector('#search-field');

form.addEventListener('submit', evt => {
    if (searchfield.value == '') {
        evt.preventDefault();
    }
})

// Get heights of sub-menus
function getSubMenuHeights() {
    let navPoints = nav.querySelectorAll(".menu > .menu-item");

    let iterate = 1;
    let css = '';

    console.log(navPoints.length);

    if (navPoints.length > 0) {
        forEach(navPoints, function (navPoint) {
            if (navPoint.classList.contains('menu-item-has-children')) {
                let subMenu = navPoint.querySelector('.sub-menu');
                subMenu.style.height = 'auto';
                let tmpHeight = subMenu.offsetHeight;
                subMenu.style.removeProperty('height');

                css = css.concat('nav li:nth-child(' + iterate + ').is-open .sub-menu {height:' + tmpHeight + 'px}');
            }

            iterate++;
        })
    }

    let target = document.querySelector('#ticker-style');
    let style = document.createElement('style');

    style.innerHTML = css;

    target.parentNode.insertBefore(style, target.nextSibling);
}