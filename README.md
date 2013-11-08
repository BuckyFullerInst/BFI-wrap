BFI
===

BFI Site Update

This is the GitHub directory for the dev version of BFI's website presence, kicked off with the redesign/relaunch process in 2013.

This is a general overview of how to make your way around the project.

Installation/First Run
======================

This project is packaged up in a Vagrant box, making it easy to share the same dev environment between differnt platforms. More information on Vagrant can be found at http://www.vagrantup.com/. Vagrant leverages VirtualBox to make a "headless" virtual server, in which to serve up the site.

IMPORTANT: There are a number of steps you need to take before you can run this virtual server (and develop the BFI site) successfully. Please make sure to follow all the instructions below:

1.	Download and Install Vagrant (http://downloads.vagrantup.com/)
2.	Download and Install VirtualBox (https://www.virtualbox.org/wiki/Downloads)
3.	Clone this project (if you haven't already)
4.	Before you launch the Vagrant file for the first time, make sure to copy the ./public/dev.bfi.local directory to a safe place and remove the original files. This is crucial for the way in which the Vagrant file sets up the databases and phpMyAdmin later on.
5.	In terminal, cd into the project directory and enter:
	
		$ vagrant up

6.	Vagrant will work for a minute and prompt you for your local machine's admin password, to set up NFS file sharing on the virtual serve. Enter it, and Vagrant should continue booting up.
7.	In the meantime, open up Vagrantfile and check the URLs listed within:

		:localhost_aliases => ["dev.bfi.local", "challenge.dev.bfi.local", "ideaindex.dev.bfi.local"]

8.	You'll need to add those URLs the /etc/hosts file on your local machine for everything to work smoothly:
	
		192.168.33.10 dev.bfi.local challenge.dev.bfi.local ideaindex.dev.bfi.local

9.	After Vagrant boots up the virtual machine for the first time and you have the command prompt again, make sure to comment out the following line in the Vagrantfile:

		# chef.add_recipe('drupal::example')

10.	If you've removed the ./public/dev.bfi.local directy as detailed above, go to
./public/dev.bfi.local and clear the directory (yes, including all the Drupal files) and copy over all the files from the original public/dev.bfi.local directory you saved before.
10. Once you're done with that, navigate to dev.bfi.local/phpmyadmin and log in with myadmin, myadmin. Drop all tables from the bfi_drupal database and import the desired backup-and-migrate tarball from ./public/dev.bfi.local/private/backup_migrate
11. Once the database is imported, you should be able to work from dev.bfi.local.
12.	If at any point you'd like to add subdomains, make sure to enter them in the two locations mentioned in steps 7 and 8 and do the requisite configuring within the site.
13.	Once you're done working and want to shut down Vagrant, type into Terminal:

		$ vagrant halt

14.	To restart Vagrant, type:

		$ vagrant reload

15.	You can SSH into vagrant via:

		$ vagrant ssh

16.	Once you're done, always make sure to clear all caches, commit, push, and submit a Pull Request on GitHub.
17.	Enjoy!

Files
=====

Files for the project are in:

	./public/dev.bfi.local/www/

which is akin to the public_html folder in a standard shared hosting environment.

Adding another subdomain
===================

Adding another subdomain (if so desired) would take the following steps:

1.	Add new-subdomain.dev.bfi.local to the 192.168.33.10 line in local machine's /etc/hosts file.
2.	Add new-subdomain.dev.bfi.local to the :localhost_aliases array in the Vagrantfile.
3.	Restart the virtual machine:

		$ vagrant reload

FYI: Subdomains in :localhost_aliases array are automatically hardset to alias to dev.bfi.local codebase in

		./cookbooks/drupal-cookbooks/drupal/recipes/drupal_apps.rb

phpMyAdmin
==========

phpMyAdmin can be accessed via http://dev.bfi.local/phpmyadmin, with username: myadmin and password: myadmin.

mySQL
=====

Server settings set:

	thread_stack: 192K
	memory_limit: 256K

Reference
=========

Virtual Machine memory set at: 2048M

This Vagrant environment utilizes the setup in the Drupal Vagrant project at https://drupal.org/project/vagrant, and there is some added documentation on set-up and use at http://webwash.net/tutorials/getting-started-drupal-vagrant.

If you'd like to try this project out on another box, try replacing the following line in the Vagrantfile:

  config.vm.box_url = "http://dl.dropbox.com/u/1537815/precise64.box"

 with a box of your choosing from http://www.vagrantbox.es/.

Jambo!
