'use strict';

module.exports = function (grunt) {
    grunt.loadNpmTasks("grunt-contrib-clean");
    grunt.loadNpmTasks("grunt-contrib-watch");
    grunt.loadNpmTasks("grunt-contrib-compass");
    grunt.loadNpmTasks("grunt-autoprefixer");

    var path = require('path');

    grunt.initConfig({
        project: {
            root: path.join(__dirname) + '/skin/frontend/pc/default'
        },
        watch: {
            scss: {
                files: ['<%= project.root %>/scss/*.scss'],
                tasks: ['compass:server', 'autoprefixer']
            }
        },
        clean: {
            server: {
                files: [{
                    dot: true,
                    src: ['<%= project.root %>/scss/*.{css,map}']
                }]
            }
        },
        compass: {
            options: {
                sassDir: '<%= project.root %>/scss',
                cssDir: '<%= project.root %>/scss',
                relativeAssets: false,
                assetCacheBuster: false,
                sourcemap: true,
                noLineComments:true,
                outputStyle:'compact',
                raw: 'Sass::Script::Number.precision = 10\n'
            },
            server: {
                options: {
                    debugInfo: false
                }
            }
        },
        autoprefixer: {
            options: {
                browsers: ['last 5 version']
            },
            server: {
                options: {
                    map: true
                },
                files: [{
                    expand: true,
                    cwd: '<%= project.root %>/scss',
                    src: ['*.css'],
                    dest: '<%= project.root %>/scss'
                }]
            }
        }
    });

    grunt.registerTask('default', [
        'clean:server',
        'compass',
        'autoprefixer:server',
        'watch'
    ]);

};
