<?php

return [
    'secret'=> env('RECAPTCHA_SECRET_KEY'),
    'sitekey'=> env('RECAPTCHA_SITE_KEY'),
    'host_server'=> env('RECAPTCHA_HOST'),
    'score'=> 0.5,
];
