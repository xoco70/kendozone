@servers(['web' => ['forge@kendozone']])

@task('deploy', ['on' => 'web'])
    cd my.kendozone.cm
    git pull origin master
    composer install
@endtask