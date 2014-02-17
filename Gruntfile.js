/* globals module */
/* globals require */

module.exports = function (grunt) {
    require('time-grunt')(grunt);
    require('load-grunt-tasks')(grunt);

    var directoriesConfig = {
        composer: 'vendor',
        bin: 'bin',
        lib: 'lib',
        tests: 'tests'
    };

    grunt.initConfig({
        directories: directoriesConfig,
        githooks: {
            all: {
                'pre-commit': 'test'
            }
        },
        phplint: {
            options: {
                swapPath: '/tmp'
            },
            all: [
                '<%= directories.lib %>/**/*.php'
            ]
        },
        phpcs: {
            lib: {
                dir: '<%= directories.lib %>'
            },
            options: {
                bin: '<%= directories.bin %>/phpcs',
                standard: 'psr2',
                extensions: 'php'
            }
        },
        phpunit: {
            classes: {
                dir: '<%= directories.tests %>'
            },
            options: {
                bin: '<%= directories.bin %>/phpunit',
                bootstrap: '<%= directories.tests %>/bootstrap.php',
                colors: true
            }
        },
        jsonlint: {
            all: {
                src: [
                    '*.json',
                    '<%= directories.lib %>/Config/**/*.json'
                ]
            }
        }
    });

    grunt.registerTask('default', [
        'githooks',
        'test'
    ]);

    grunt.registerTask('test', [
        'phplint',
        'phpcs',
        'phpunit',
        'jsonlint'
    ]);
};
