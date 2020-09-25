            <?php if (!is_front_page()) : ?>
                <?php get_template_part( 'template-parts/elevator' ); ?>
            <?php endif; ?>

        </main>

        <?php get_template_part( 'template-parts/main-navigation' ); ?>

    </div>

    <footer id="footer">
        <?php
            wp_nav_menu( 
                array(
                    'theme_location' => 'footer',
                    'menu' => 'Footer'
                )
            ); 
        ?>
    </footer>
    
    <script>
        var forEach=function(t,o,r){if("[object Object]"===Object.prototype.toString.call(t))for(var c in t)Object.prototype.hasOwnProperty.call(t,c)&&o.call(r,t[c],c,t);else for(var e=0,l=t.length;l>e;e++)o.call(r,t[e],e,t)};

        var hamburgers = document.querySelectorAll(".hamburger");
        var nav = document.getElementById("nav");
        let footerHeight = document.getElementById('footer').clientHeight;
        let hamburger = document.getElementById('hamburger');
        let languageSwitch = document.getElementById('language-switch');
        let homeLink = document.getElementById('home-link');

        let documentHeight = document.body.clientHeight;

        // Toogle Classes on hamburger Menu
        hamburger.addEventListener("click", function() {
            this.classList.toggle("is-active");
            nav.classList.toggle("is-open");
            // Fix try for correct nav
            // document.body.classList.toggle("nav-is-open");
            document.body.scrollTop = 0; // For Safari
            document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
        }, false);
 
        // Page Elevator
        let pageElevator = document.getElementById('page-elevator');
        
        if (pageElevator != null) {
            pageElevator.addEventListener("click", function() {
                document.body.scrollTop = 0; // For Safari
                document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
            })
        }
        

        window.onscroll = function() {
            scroll();
        };

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

        // Open Sub-Menus
        var navParents = document.querySelectorAll(".dropdown-btn");

        if (navParents.length > 0) {
            forEach(navParents, function(navParent) {
                navParent.addEventListener("click", function() {
                    let me = this;

                    forEach(navParents, function(navParent) {
                        if (navParent != me) {
                            navParent.parentNode.classList.remove("is-open");
                        }
                    });
                    this.parentNode.classList.toggle("is-open");
                }, false);
            });
        }

        // Set animation values for ticker
        window.onresize = setTickerValues;
        window.onload = setTickerValues;

        function setTickerValues() {
            let ticker = document.getElementById('ticker');
            let tickerWidth = -ticker.clientWidth/tickerNewsCount;

            // document.documentElement.style.setProperty('--ticker-width', tickerWidth + 'px');

            let tickerDuration = ticker.clientWidth * .01;

            // document.documentElement.style.setProperty('--ticker-duration', tickerDuration + 's');

            let target = document.querySelector('#ticker-style');

            let style = document.createElement('style');

            style.innerHTML = ('.ticker-wrap .ticker {-webkit-animation-duration: ' + tickerDuration + 's;animation-duration: ' + tickerDuration + 's;} @-webkit-keyframes ticker {0% {-webkit-transform: translate3d(0, 0, 0);transform: translate3d(0, 0, 0);visibility: visible;}100% {-webkit-transform: translate3d(' + tickerWidth + 'px, 0, 0);transform: translate3d(' + tickerWidth + 'px, 0, 0);}}@keyframes ticker {0% {-webkit-transform: translate3d(0, 0, 0);transform: translate3d(0, 0, 0); visibility: visible;}100% {-webkit-transform: translate3d(' + tickerWidth + 'px, 0, 0);transform: translate3d(' + tickerWidth + 'px, 0, 0);}}')
        
            target.parentNode.insertBefore(style, target.nextSibling);
        }

        // Dont send empty searches
        const form = document.querySelector('#search-form');
        const searchfield = document.querySelector('#search-field');

        form.addEventListener('submit', evt => {
            if (searchfield.value == '') {
                evt.preventDefault();
            }
        })
    </script>
    <div id="ticker-style"></div>
    <!--
    <style>
        .ticker-wrap .ticker {
            -webkit-animation-duration: var(--ticker-width);
            animation-duration: var(--ticker-width);
        }

        @-webkit-keyframes ticker {
            0% {
                -webkit-transform: translate3d(0, 0, 0);
                transform: translate3d(0, 0, 0);
                visibility: visible;
            }

            100% {
                -webkit-transform: translate3d(var(--ticker-width), 0, 0);
                transform: translate3d(var(--ticker-width), 0, 0);
            }
        }

        @keyframes ticker {
            0% {
                -webkit-transform: translate3d(0, 0, 0);
                transform: translate3d(0, 0, 0);
                visibility: visible;
            }

            100% {
                -webkit-transform: translate3d(var(--ticker-width), 0, 0);
                transform: translate3d(var(--ticker-width), 0, 0);
            }
        }
    </style>
    -->
    </body>

    <?php wp_footer(); ?>

</html>