module.exports = function(grunt) {
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-compass');

	
	grunt.initConfig ({
	
		uglify: {
			my_target: {
				files: {
					'js/script.js': ['_/js/script.js']
					// '_/js/script.js': ['_/components/js/*.js'] <<this would uglify all js files
				} //files
			} //my_target
		}, //uglify
		
		compass: {
			dev: {
				options: {
					config: 'config.rb'
				} //options
			} //dev
		}, //compass	
		
		watch: {
			options: { livereload: true },
			scripts: {
				files: ['_/js/*.js'],
				tasks: ['uglify']
			}, // scripts
			sass: {
				files: ['_/sass/*.scss'],
				tasks: ['compass:dev']	
			}, //sass
			html: {
				files: ['*.html']
			} //html
		} // watch
	}) // initConfig
	grunt.registerTask('default', 'watch');
} //exports
