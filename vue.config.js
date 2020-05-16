module.exports = {
	pluginOptions: {
		'style-resources-loader': {
			preProcessor: 'stylus',
			patterns: ['\\src\\styles\\imports.styl']
		}
	},
	devServer: {
		proxy: {
			'^/api': {
				target: 'http://localhost:3333/',
				ws: true,
				changeOrigin: true
			}
		}
	}
}
