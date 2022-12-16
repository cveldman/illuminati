<?php

namespace Deployer;

require 'recipe/laravel.php';
require 'contrib/npm.php';

// Config

set('repository', 'https://github.com/cveldman/illuminati');
set('ssh_multiplexing', false);

add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

// Hosts

host('192.168.1.43')
    ->set('remote_user', 'admin')
    ->set('deploy_path', '~/tester.appsmederij.nl');

// Tasks

task('deploy:packages', function () {
    run('cd {{release_or_current_path}} && npm install');
    run('cd {{release_or_current_path}} && npm run build');
});

// Hooks

after('deploy:vendors', 'deploy:packages');
after('deploy:failed', 'deploy:unlock');
