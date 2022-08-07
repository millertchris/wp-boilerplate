const path = require("path");
const HtmlWebpackPlugin = require("html-webpack-plugin");
const { CleanWebpackPlugin } = require("clean-webpack-plugin");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const CssMinimizerPlugin = require("css-minimizer-webpack-plugin");

const pages = "./src/pages";
const fs = require("fs");
const htmlPageNames = [];

fs.readdirSync(pages).forEach((file) => {
	if (file.includes(".html")) {
		htmlPageNames.push(file);
	}
});

// let htmlPageNames = ["single", "404"];
let multipleHtmlPlugins = htmlPageNames.map((file) => {
	return new HtmlWebpackPlugin({
		template: `src/pages/${file}`, // relative path to the HTML files
		filename: `${file}`, // output HTML files
		// minify: true,
		// chunks: [`${name}`], // respective JS files
	});
});

module.exports = {
	mode: "development",
	entry: ["./src/js/index.js"],
	output: {
		filename: "[name].js",
		path: path.resolve(__dirname, "dist"),
		publicPath: "",
	},
	devtool: "inline-source-map",
	// devServer: {
	// 	contentBase: "./dist",
	// },
	module: {
		rules: [
			{
				test: /\.(png|svg|jpg|jpeg|gif|mp3)$/i,
				type: "asset/resource",
				generator: {
					//If emitting file, the file path is
					filename: "images/[name][ext][query]",
				},
			},
			{
				test: /\.s[ac]ss$/i,
				use: [
					// fallback to style-loader in development
					process.env.NODE_ENV !== "production"
						? "style-loader"
						: MiniCssExtractPlugin.loader,
					"css-loader",
					"sass-loader",
				],
			},
		],
	},
	plugins: [
		new CleanWebpackPlugin({
			cleanStaleWebpackAssets: false,
		}),
		new MiniCssExtractPlugin({
			// Options similar to the same options in webpackOptions.output
			// both options are optional
			filename: "[name].css",
			chunkFilename: "[id].css",
		}),
	].concat(multipleHtmlPlugins),
	optimization: {
		minimizer: [
			// For webpack@5 you can use the `...` syntax to extend existing minimizers (i.e. `terser-webpack-plugin`), uncomment the next line
			// `...`,
			new CssMinimizerPlugin(),
		],
	},
};
