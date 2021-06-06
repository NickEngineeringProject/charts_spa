const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js').vue();

mix.postCss('resources/css/app.css', 'public/css', [require('tailwindcss'),]);

mix.webpackConfig({
    output: {
        chunkFilename: 'js/chunks/[name].js',
    },
});

mix.sourceMaps();
