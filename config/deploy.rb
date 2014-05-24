# config valid only for Capistrano 3.1
lock '3.1.0'

set :application, 'Wedding Vale!!!'
set :repo_url, 'ssh://git@errethak.be:9000/samWedding'
# Default branch is :master
set :branch, 'default'

# Default deploy_to directory is /var/www/my_app
set :deploy_to, '/var/www/vhosts/ilikecodeine.com'

# Default value for :scm is :git
set :scm, :git

#set :deploy_subdir, 'webroot'

#set :linked_files, %w{webroot/protected/config/db.php webroot/protected/runtime/application.log}

# Default value for :format is :pretty
# set :format, :pretty

# Default value for :log_level is :debug
# set :log_level, :debug

# Default value for :pty is false
# set :pty, true

# Default value for :linked_files is []
# set :linked_files, %w{config/database.yml}

# Default value for linked_dirs is []
# set :linked_dirs, %w{bin log tmp/pids tmp/cache tmp/sockets vendor/bundle public/system}

# Default value for default_env is {}
# set :default_env, { path: "/opt/ruby/bin:$PATH" }

# Default value for keep_releases is 5
# set :keep_releases, 5

namespace :deploy do

  desc 'Restarting application'
  task :restart do
    on roles(:app) do
      execute "sudo service php5-fpm restart"
    end
  end

  after :published, :restart
	
  desc 'Composer install'
  task :composer_install do
    run "composer install --working-dir #{latest_release}"
  end
  after :updated, :composer_install

end

