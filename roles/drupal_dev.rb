name "drupal_dev"
description "Useful tools for Drupal developers."
run_list(
  "recipe[drupal::dev]",
  "recipe[drush::head]",
  "recipe[drush_make]",
  "recipe[phpmyadmin]", # TODO Cookbook needs testing!
  "recipe[webgrind]", # TODO Does this actually work?
  "recipe[xhprof]"  # xhprof doesn't exist for Quantal... yet?
)
# TODO Add recipe to create dev sites via Drush make.
