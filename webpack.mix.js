const mix = require('laravel-mix');

module.exports = {
    rules: [
        {
            test: /\.s(c|a)ss$/,
            use: [
                'vue-style-loader',
                'css-loader',
                {
                    loader: 'sass-loader',
                    // Requires sass-loader@^8.0.0
                    options: {
                        implementation: require('sass'),
                        sassOptions: {
                            fiber: require('fibers'),
                            indentedSyntax: true // optional
                        },
                    },
                },
            ],
        },
    ],
};

mix.copyDirectory('node_modules/@fortawesome/fontawesome-free/svgs', 'public/svgs')
    .copyDirectory('node_modules/@fortawesome/fontawesome-free/sprites', 'public/sprites')
    .copyDirectory('node_modules/@fortawesome/fontawesome-free/webfonts', 'public/webfonts')
    .js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');

if (mix.config.hmr) {
    mix.webpackConfig({
        output: {
            chunkFilename: '[name].js',
        }
    });
} else {
    mix.webpackConfig({
        output: {
            publicPath: '/',
            chunkFilename: '[name].[chunkhash].js',
        }
    });
}

mix.setPublicPath('public');
mix.setResourceRoot('../');
