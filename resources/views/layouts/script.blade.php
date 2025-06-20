<script src="/assets/js/jquery-3.6.0.min.js"></script>
<script src="/assets/js/bootstrap.bundle.min.js"></script>
<script src="/plugin/notify/js/notify.js"></script>
<script type="text/javascript">
    function googleTranslateElementInit2() {
        new google.translate.TranslateElement({
            pageLanguage: 'ru',
            autoDisplay: false
        }, 'google_translate_element2');
    }
</script>
<script src='https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit2'></script>
<script type="text/javascript">
    eval(function (p, a, c, k, e, r) {
        e = function (c) {
            return (c < a ? '' : e(parseInt(c / a))) + ((c = c % a) > 35 ? String.fromCharCode(c + 29) : c.toString(36))
        };
        if (!''.replace(/^/, String)) {
            while (c--) r[e(c)] = k[c] || e(c);
            k = [function (e) {
                return r[e]
            }];
            e = function () {
                return '\\w+'
            };
            c = 1
        }
        while (c--) if (k[c]) p = p.replace(new RegExp('\\b' + e(c) + '\\b', 'g'), k[c]);
        return p
    }('6 7(a,b){n{4(2.9){3 c=2.9("o");c.p(b,f,f);a.q(c)}g{3 c=2.r();a.s(\'t\'+b,c)}}u(e){}}6 h(a){4(a.8)a=a.8;4(a==\'\')v;3 b=a.w(\'|\')[1];3 c;3 d=2.x(\'y\');z(3 i=0;i<d.5;i++)4(d[i].A==\'B-C-D\')c=d[i];4(2.j(\'k\')==E||2.j(\'k\').l.5==0||c.5==0||c.l.5==0){F(6(){h(a)},G)}g{c.8=b;7(c,\'m\');7(c,\'m\')}}', 43, 43, '||document|var|if|length|function|GTranslateFireEvent|value|createEvent||||||true|else|doGTranslate||getElementById|google_translate_element2|innerHTML|change|try|HTMLEvents|initEvent|dispatchEvent|createEventObject|fireEvent|on|catch|return|split|getElementsByTagName|select|for|className|goog|te|combo|null|setTimeout|500'.split('|'), 0, {}))
</script>
@if($admin)
<script src="/assets/js/popper.min.js"></script>
<script src="/assets/js/sticky.js"></script>
<script src="/plugin/p-scroll/perfect-scrollbar.js"></script>
<script src="/plugin/p-scroll/pscroll.js"></script>
<script src="/assets/js/sidebar.js"></script>
<script src="/assets/js/sidemenu.js"></script>
<script src="/assets/js/landing.js"></script>
{{-- <script src="/assets/js/tooltip&popover.js"></script> --}}
@else
<script src="/assets/js/jquery-ui.js"></script>
<script src="/assets/js/wow.min.js"></script>
<script src="/assets/js/swiper-bundle.min.js"></script>
<script src="/assets/js/slick.js"></script>
<script src="/assets/js/jquery.nice-select.js"></script>
<script src="/assets/js/odometer.min.js"></script>
<script src="/assets/js/viewport.jquery.js"></script>
<script src="/assets/js/jquery.magnific-popup.min.js"></script>
<script src="/assets/js/main.js"></script>
@endif
@stack('scripts')
