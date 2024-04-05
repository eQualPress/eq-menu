jQuery(document).ready(async function ($) {
    const {search} = location;
    const urlParams = new URLSearchParams(search);

    const eq = new eQ('eq-listener');
    const context = JSON.parse(urlParams.get('context'));

    // overload environment lang if set in URL
    if (urlParams.has('lang')) {
        context['lang'] = urlParams.get('lang');
    }

    eq.open(context);
});
