Vagrant::Config.run do |config|
  # All Vagrant configuration is done here. For a detailed explanation
  # and listing of configuration options, please view the documentation
  # online.

  # Every Vagrant virtual environment requires a box to build off of.
  config.vm.box = "precise"

  # The url from where the 'config.vm.box' box will be fetched if it
  # doesn't already exist on the user's system.
  config.vm.box_url = "https://s3-us-west-2.amazonaws.com/squishy.vagrant-boxes/precise64_squishy_2013-02-09.box"

  # Boot with a GUI so you can see the screen. (Default is headless)
  # config.vm.boot_mode = :gui

  # Memory setting for Vagrant < 0.90
  # config.vm.customize do |vm|
  #   vm.memory_size = 1024
  # end

  # Memory setting for Vagrant >= 0.90
  config.vm.customize ["modifyvm", :id, "--memory", "2048"]

  # Network setting for Vagrant < 0.90
  # config.vm.network("192.168.33.10")

  # Network setting for Vagrant >= 0.90
  config.vm.network :hostonly, "192.168.33.10"

  config.vm.share_folder("public", "/vagrant/public", "./public", :owner => "www-data", :group => "www-data")
  # config.vm.share_folder("vagrant-root", "/vagrant", ".")
  config.vm.share_folder("vagrant-root", "/vagrant", ".", :nfs => true)
  # config.vm.share_folder("v-apt", "/var/cache/apt", "~/temp/vagrant_aptcache/apt", :nfs => true)

  config.vm.provision :chef_solo do |chef|
    # This path will be expanded relative to the project directory
    chef.cookbooks_path = ["cookbooks/site-cookbooks", "cookbooks/drupal-cookbooks"]
    chef.roles_path = "roles"

    # This role represents our default Drupal development stack.
    chef.add_role("drupal_lamp_varnish_dev")
    # Install an example D7 install at drupal.vbox.local.
    # chef.add_recipe('drupal::example')
    # This is basically the Vagrant role.
    chef.json.merge!({
        :www_root => '/vagrant/public',
        :mysql => {
          :server_root_password => "root" # TODO Hardcoded MySQL root password.
        },
        :hosts => {
          :localhost_aliases => ["dev.bfi.local", "challenge.dev.bfi.local", "ideaindex.dev.bfi.local"]
        }
      })
  end
end
