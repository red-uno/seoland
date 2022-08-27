<div class="nav-item d-flex">
    <a href="#" class="nav-link py-1 d-flex align-items-center text-secondary" id="dark-mode" data-enable="tooltip" title="{{ __('Change theme') }}">
        @include('icons.contrast', ['class' => 'width-4 height-4 fill-current ' . (__('lang_dir') == 'rtl' ? 'ml-2' : 'mr-2')])
        <span class="text-muted">{{ config('settings.dark_mode') == 1 ? __('Dark') : __('Light') }}</span>
    </a>
</div>

<script>
    'use strict';

    window.addEventListener('DOMContentLoaded', function () {
        // Change the css file on input checkbox change
        document.querySelector('#dark-mode') && document.querySelector('#dark-mode').addEventListener('click', function (e) {
            e.preventDefault();

            // Update the CSS source
            document.querySelector('#app-css').setAttribute('href', '{{ asset('css/app'. (__('lang_dir') == 'rtl' ? '.rtl' : '')) }}' + (document.querySelector('html').classList.contains('dark') ? '' : '.dark') + '.css');

            // Update the text
            this.querySelector('span').textContent = document.querySelector('html').classList.contains('dark') ? '{{ __('Light') }}' : '{{ __('Dark') }}';

            // Update the dark mode cookie
            setCookie('dark_mode', (document.querySelector('html').classList.contains('dark') ? 0 : 1), new Date().getTime() + (10 * 365 * 24 * 60 * 60 * 1000), '/');

            // Update the CSS class
            if (document.querySelector('html').classList.contains('dark')) {
                document.querySelector('html').classList.remove('dark');
            } else {
                document.querySelector('html').classList.add('dark');
            }
        });
    });
</script>