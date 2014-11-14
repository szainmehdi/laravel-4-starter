module.exports = function (grunt) {

    //Initializing the configuration object
    grunt.initConfig({

        // Task configuration
        concat: {
            options: {
                separator: ';'
            },
            js_frontend: {
                src: [
                    './bower_components/jquery/dist/jquery.js',
                    './bower_components/bootstrap/dist/js/bootstrap.js',
                    './bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.js',
                    './assets/js/vendor/*.js',
                    './assets/js/frontend.js'
                ],
                dest: './public/js/frontend.js'
            }
        },
        less: {
            development: {
                options: {
                    compress: true
                },
                files: {
                    "./public/css/frontend.css": "./assets/less/frontend/frontend.less"
                }
            }
        },
        uglify: {
            options: {
                mangle: false  // Use if you want the names of your functions and variables unchanged
            },
            frontend: {
                files: {
                    './public/js/frontend.min.js': './public/js/frontend.js'
                }
            },
            etc: {
                files: [
                    {
                        expand: true,
                        cwd: 'app/assets/js/etc/',
                        src: '**/*.js',
                        dest: 'public/js/etc'
                    }
                ]
            }
        },
        phpunit: {
            classes: {
                dir: 'app/tests/'   //location of the tests
            },
            options: {
                bin: 'vendor/bin/phpunit',
                colors: true
            }
        },
        watch: {
            js_etc: {
                files: ['./assets/js/etc/*.js'],
                tasks: ['uglify:etc'],
                options: {livereload: true}
            },
            js_frontend: {
                files: [
                    //watched files
                    './bower_components/jquery/dist/jquery.js',
                    './bower_components/bootstrap/dist/js/bootstrap.js',
                    './bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.js',
                    './assets/js/vendor/*.js',
                    './assets/js/frontend.js'
                ],
                tasks: [
                    'concat:js_frontend',
                    'uglify:frontend'
                ],
                options: {
                    livereload: true
                }
            },
            less: {
                files: [
                    './assets/less/**/*.less',
                    './bower_components/**/*.less'
                ],
                tasks: ['less'],
                options: {
                    livereload: true
                }
            },
            tests: {
                files: [
                    'app/**/*.php'
                ],
                tasks: ['phpunit']
            }
        },
        dist: {}
    });

    // // Plugin loading
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-phpunit');

    // Task definition
    grunt.registerTask('default', ['build', 'watch']);

    grunt.registerTask('build', 'Run all necessary deployment tasks.', function () {
        grunt.task.run(['concat', 'uglify', 'less']);
    });

};