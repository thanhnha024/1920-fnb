const path = require("path");
const webpack = require("webpack");
// Init Config Webpack
require("dotenv-extended").load();
const BrowserSyncPlugin = require("browser-sync-webpack-plugin");
// Css extraction and minification
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const CssMinimizerPlugin = require("css-minimizer-webpack-plugin");

// Clean out build dir in-between builds
const { CleanWebpackPlugin } = require("clean-webpack-plugin");

// Define Theme name
const themeName = process.env.THEME_NAME ? process.env.THEME_NAME : "zippy";
const destChildTheme = "./src/wp-content/themes/" + themeName + "-child";
const localDomain = process.env.PROJECT_HOST
  ? process.env.PROJECT_HOST
  : "http://localhost:68";

// Define Work path
const destFileCss = destChildTheme + "/assets/sass/app.scss";
const destFileJs = destChildTheme + "/assets/js/app.js";
const destOutput = destChildTheme + "/assets/dist";

module.exports = [
  {
    stats: "minimal",
    entry: {
      main: [destFileCss, destFileJs],
    },
    output: {
      filename: destOutput + "/js/[name].min.js",
      path: path.resolve(__dirname),
    },
    module: {
      rules: [
        // js babelization
        {
          test: /\.(js|jsx)$/,
          exclude: /node_modules/,
          loader: "babel-loader",
        },
        // sass compilation
        {
          test: /\.(sass|scss)$/,
          use: [
            MiniCssExtractPlugin.loader,
            {
              loader: "css-loader",
              options: { url: false },
            },
            {
              loader: "sass-loader",
              options: {
                sourceMap: true,
                sassOptions: {
                  outputStyle: "compressed",
                },
                additionalData: `@import "${destChildTheme}/assets/sass/_mixins";`,
              },
            },
          ],
        },
        // Font files
        {
          test: /\.(woff|woff2|ttf|otf)$/,
          loader: "file-loader",
          include: path.resolve(__dirname, "../"),

          options: {
            name: "[hash].[ext]",
            outputPath: "fonts/",
          },
        },
        // loader for images and icons (only required if css references image files)
        {
          test: /\.(png|jpg|gif)$/,
          type: "asset/resource",
          generator: {
            filename: destOutput + "/build/img/[name][ext]",
          },
        },
      ],
    },
    plugins: [
      // Get ENV Variables
      // clear out build directories on each build
      new CleanWebpackPlugin({
        cleanOnceBeforeBuildPatterns: [
          destOutput + "/css/*",
          destOutput + "/js/*",
        ],
      }),
      // css extraction into dedicated file
      new MiniCssExtractPlugin({
        filename: destOutput + "/css/main.min.css",
      }),
      new webpack.ProvidePlugin({
        $: "jquery",
        jQuery: "jquery",
      }),
      new BrowserSyncPlugin(
        {
          proxy: localDomain,
          files: [
            destOutput + "/*/*.css",
            destOutput + "/*/*.js",
            destChildTheme + "/*.php",
            destChildTheme + "/*/*.php",
          ],
          injectCss: true,
        },
        { reload: false }
      ),
    ],
    optimization: {
      // minification - only performed when mode = production
      minimizer: [
        // js minification - special syntax enabling webpack 5 default terser-webpack-plugin
        `...`,
        // css minification
        new CssMinimizerPlugin(),
      ],
    },
  },
];
