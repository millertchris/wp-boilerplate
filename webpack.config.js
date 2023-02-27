const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const BrowserSyncPlugin = require("browser-sync-webpack-plugin");
var path = require("path");

// change these variables to fit your project
const jsPath = "./src/js";
const cssPath = "./src/scss";
const outputPath = "dist";
const localDomain = "http://wp-boilerplate.local";
const entryPoints = {
	// 'app' is the output name, people commonly use 'bundle'
	// you can have more than 1 entry point
	app: jsPath + "/index.js",
	admin: cssPath + "/styles/admin.scss",
	main: cssPath + "/styles/main.scss",
};

module.exports = {
	entry: entryPoints,
	output: {
		path: path.resolve(__dirname, outputPath),
		filename: "[name].js",
		publicPath: "",
	},
	plugins: [
		new MiniCssExtractPlugin({
			filename: "[name].css",
		}),

		// Uncomment this if you want to use CSS Live reload
		new BrowserSyncPlugin(
			{
				proxy: localDomain,
				files: [outputPath + "/*.css", outputPath + "/*.js"],
				injectCss: true,
			},
			{ reload: false }
		),
	],
	module: {
		rules: [
			{
				test: /\.?js$/,
				exclude: /node_modules/,
				use: {
					loader: "babel-loader",
					options: {
						presets: ["@babel/preset-env", "@babel/preset-react"],
					},
				},
			},
			{
				test: /\.s?[c]ss$/i,
				use: [MiniCssExtractPlugin.loader, "css-loader", "sass-loader"],
			},
			{
				test: /\.sass$/i,
				use: [
					MiniCssExtractPlugin.loader,
					"css-loader",
					{
						loader: "sass-loader",
						options: {
							sassOptions: { indentedSyntax: true },
						},
					},
				],
			},
			{
				test: /\.(png|svg|jpg|jpeg|gif)$/i,
				type: "asset/resource",
			},
			{
				test: /\.(woff|woff2|eot|ttf|otf)$/i,
				type: "asset/resource",
			},
		],
	},
};
