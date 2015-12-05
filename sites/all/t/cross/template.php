<?php

function cross_preprocess_page(&$variables) {
  if (isset($variables['node'])) {
    $variables['theme_hook_suggestions'][] = 'page__node__'.$variables['node']->type;
  }

}


/* Листалка для нод */

function next_page_link($node){
	$next_nid = db_query("
		SELECT nid FROM {node}
		WHERE created > :created AND type = :type AND status = 1
		LIMIT 1",
		array(':created' => $node->created,':type' => $node->type))
	->fetchObject();
	if($next_nid) {
		return '/'.drupal_get_path_alias('node/'.$next_nid->nid);
	}
	else {
		return false;
	}
}

function previous_page_link($node){
	$next_nid = db_query("
		SELECT nid FROM {node}
		WHERE created < :created AND type = :type AND status = 1
		ORDER BY created DESC
		LIMIT 1",
		array(':created' => $node->created,':type' => $node->type))
	->fetchObject();
	if($next_nid) {
		return '/'.drupal_get_path_alias('node/'.$next_nid->nid);
	}
	else {
		return false;
	}
}      


/****** breadcrumb *******/
/*
function cross_breadcrumb($variables) {

  $breadcrumb = $variables['breadcrumb'];
   
  if (arg(0) == 'node') {
    if (is_numeric(arg(1))) {
      $node = node_load(arg(1));
      if ($node->type == 'product') {
        $terms =  taxonomy_get_parents_all($node->field_referances_tax['und'][0]['tid']);
        $terms = array_reverse($terms);
        foreach ($terms as $term) {
          $breadcrumb[] = '<a href="/'. drupal_get_path_alias('taxonomy/term/'. $term->tid) .'">'. $term->name .'</a>';
        }
      }

      if (!drupal_is_front_page()) {
        $breadcrumb[] = $node->title;
      }
    }
  }
 
  if (arg(0) == 'taxonomy') {
    if (is_numeric(arg(2))) {
    $term = taxonomy_term_load(arg(2));
    $breadcrumb[] = $term->name;
    }
  }

  $output = implode('<i> » </i>', $breadcrumb);
  return $output;

}

function phptemplate_breadcrumb($breadcrumb) {
    if (count($breadcrumb) > 1) {
        return implode(' » ', $breadcrumb);
    }
}
*/
?>