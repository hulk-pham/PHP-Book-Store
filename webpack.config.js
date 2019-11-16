const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const {CleanWebpackPlugin} = require('clean-webpack-plugin');

module.exports = {
    entry: [
        './resource/scss/main.scss',
        './resource/js/main.js'
    ],
    mode: "development",
    output: {
        path: path.resolve(__dirname, 'public/bundles'),
        filename: '[name].js'
    },
    module: {
        rules: [
            {
                test: /\.(sa|sc)ss$/,
                use: [
                    MiniCssExtractPlugin.loader,
                    'css-loader',
                    'sass-loader'
                ]
            },
        ]
    },
    plugins: [
        new MiniCssExtractPlugin({
            path: path.resolve(__dirname, 'public/bundles'),
            filename: '[name].css',
        }),
        new CleanWebpackPlugin(),
    ],
    watch: true
};
