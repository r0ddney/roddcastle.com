module.exports = function(grunt) {

	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		uglify: {
			build : {
				src: 'js/*.js',
				dest: 'min/js/script.min.js'
			},
			dev : {
				options: {
					beautify: true,
					mangle: false,
					compress: false,
					preserveComments: 'all'
				},
				src: 'js/*.js',
				dest: 'min/js/script.min.js'
			}
		},
		compass: {
			build: {
				options: {
			        sassDir: 'sass',
			        cssDir: 'css',
			        environment: 'production'
			      }
			},
			dev: { 
		      options: {
		        sassDir: 'sass',
		        cssDir: 'css'
		      }
		    }
		},
		watch : {
			js: {
				files: ['js/*.js'],
				tasks: ['uglify:dev']
			},
			css: {
				files: ['sass/*.scss'],
				tasks: ['compass:dev'],
				options: {
					livereload: 1337
				}
			}
		}
	});

	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-compass');

	grunt.registerTask('default', ['uglify:dev','compass:dev']);
	grunt.registerTask('build', ['uglify:build']);
	
}