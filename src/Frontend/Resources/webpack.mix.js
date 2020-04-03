const mix = require('laravel-mix');

function public_directory(path = '') {
    let publicDirectory = '../../../public';
    // let publicDirectory = './public';

    if (path !== '') {
        publicDirectory += '/';
    }

    return `${publicDirectory}${path}`;
}

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

mix.webpackConfig({
    resolve: {
        extensions: ['.js', '.vue', '.json'],
        alias: {
            // app
            '@components':
                __dirname + '/app/components',
            '@core':
                __dirname + '/app/core',
            '@plugins':
                __dirname + '/app/core/plugins',
            '@modules':
                __dirname + '/app/modules',

            // assets
            '@assets':
                __dirname + '/assets',

            // translations
            '@translations':
                __dirname + '/translations',
        },
    },
});

mix.copyDirectory('node_modules/@fortawesome/fontawesome-free/svgs', public_directory('svgs'))
    .copyDirectory('node_modules/@fortawesome/fontawesome-free/sprites', public_directory('sprites'))
    .copyDirectory('node_modules/@fortawesome/fontawesome-free/webfonts', public_directory('webfonts'))
    .js('app/app.js', public_directory('js/app.js'))
    .sass('app/sass/base.scss', public_directory('css/app.css'));

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

mix.setPublicPath(public_directory());
mix.setResourceRoot(public_directory('../'));
