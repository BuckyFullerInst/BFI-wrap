name "solr_server"
description "Installing solr and dependencies"
run_list(
  "recipe[solr]"
)
# TODO Add recipe to create dev sites via Drush make.
