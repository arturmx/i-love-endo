<?php $cookiesFields = get_field('footer_cookies_info', 2); ?>

<?php if ($cookiesFields && get_cookies_by_name('cookies_accepted') !== 'yes') : ?>
    <div class="cookies-info-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-7 col-xl-8">
                    <?php echo $cookiesFields; ?>
                </div>
                <div class="col-12 col-lg-5 col-xl-4 text-right">
                    <span class="button-default close">Zgadzam się, przejdź do serwisu</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Cookies modal JS -->
    <script type="text/javascript">
        function cookiesInfoBox () {
            var $button = document.querySelector(".cookies-info-wrapper .close");
            var $wrapper = document.querySelector(".cookies-info-wrapper");

            $button.onclick = function(){ closeCookiesInfoContaine (); };

            // Show cookies info
            if (getCookie('cookies_accepted') !== 'yes') {
                setTimeout(function() {
                    $wrapper.classList.add("up");
                }, 500);
            }

            /**
             * Close info box
             */
            function closeCookiesInfoContaine () {
                $wrapper.classList.add("down");
                
                setTimeout(function() { 
                    document.body.removeChild($wrapper); 
                    setCookie('cookies_accepted', 'yes', 365);
                }, 500); 
            }
            
            /**
             * Set Cookie
             *
             * @param {string} cname
             * @param {string} value
             * @param {int} days
             */
            function setCookie(cname, value, days) {
                var d = new Date();
                d.setTime(d.getTime() + (days*24*60*60*1000));
                var expires = "expires="+ d.toUTCString();
                document.cookie = cname + "=" + value + ";" + expires + ";path=/";
            }

            /**
             * Get cookie by name
             *
             * @param {string} name
             * @returns {any}
             */
            function getCookie(name) {
                var v = document.cookie.match('(^|;) ?' + name + '=([^;]*)(;|$)');
                return v ? v[2] : null;
            }
        }
        cookiesInfoBox ();
    </script>

<?php endif;