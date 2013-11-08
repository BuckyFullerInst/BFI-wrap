$return = FALSE;

if ($node = menu_get_object()) {
  global $user;
  if (isset($user->roles[9]) || isset($user->roles[3])) {		// For review team

    $user_rids = relation_query('user', $user->uid)
      ->related('node', $node->nid)
      ->execute();
    $user_rels = entity_load('relation', array_keys($user_rids));
    
    if (count($user_rels) == 1) {
      $user_rel_wrapper = entity_metadata_wrapper('relation', reset($user_rels));
      $round_node = $node->field_project_round['und'][0]['value'];    // Matching against current round of project node
      switch ($round_node) {    // Matching current node round to user-authorized rounds
        case 1:
        if ($user_rel_wrapper->field_project_review_r1_auth->value() && !$user_rel_wrapper->field_project_review_r1_in->value()) $return = TRUE;
          break;
        case 2:
          if ($user_rel_wrapper->field_project_review_r2_auth->value() && !$user_rel_wrapper->field_project_review_r2_in->value()) $return = TRUE;
          break;
        case 3:
          if ($user_rel_wrapper->field_project_review_r3_auth->value() && !$user_rel_wrapper->field_project_review_r3_in->value()) $return = TRUE;
          break;
      }
    }
  }
}


return $return;
