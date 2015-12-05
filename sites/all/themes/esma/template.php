<?php

/**
 * @file
 * This file is empty by default because the base theme chain (Alpha & Omega) provides
 * all the basic functionality. However, in case you wish to customize the output that Drupal
 * generates through Alpha & Omega this file is a good place to do so.
 * 
 * Alpha comes with a neat solution for keeping this file as clean as possible while the code
 * for your subtheme grows. Please read the README.txt in the /preprocess and /process subfolders
 * for more information on this topic.
 */
/**
 * Implements hook_process().
 */
function omega_bootstrap_process(&$vars, $hook) {
  if (!empty($vars['elements']['#grid']) || !empty($vars['elements']['#data']['wrapper_css'])) {
    if (!empty($vars['elements']['#grid'])) {
      foreach (array('prefix', 'suffix', 'push', 'pull') as $quality) {
        if (!empty($vars['elements']['#grid'][$quality])) {
          array_unshift($vars['attributes_array']['class'], 'offset' . $vars['elements']['#grid'][$quality]); # Добавляем класс offset* региону
        }
      }

      array_unshift($vars['attributes_array']['class'], 'col-md-' . $vars['elements']['#grid']['columns']); # Добавляем класс span* региону
    }
  
    $vars['attributes'] = $vars['attributes_array'] ? drupal_attributes($vars['attributes_array']) : '';
  }

  if (!empty($vars['elements']['#grid_container']) || !empty($vars['elements']['#data']['css'])) {

    if (!empty($vars['elements']['#grid_container'])) {
      $vars['content_attributes_array']['class'][] = 'container'; # Добавляем класс container зоне
    }

    $vars['content_attributes'] = $vars['content_attributes_array'] ? drupal_attributes($vars['content_attributes_array']) : '';
  }

  alpha_invoke('process', $hook, $vars);
}

/**
 * Implements theme_status_messages().
 */
function omega_bootstrap_status_messages($variables) {
  $display = $variables['display'];
  $output = '';

  $status_heading = array(
    'status' => t('Status message'), 
    'error' => t('Error message'), 
    'warning' => t('Warning message'),
  );
  
  $class = array(
    'status' => 'alert alert-success', 
    'error' => 'alert alert-error', 
    'warning' => 'alert',
  );

  foreach (drupal_get_messages($display) as $type => $messages) {
    $output .= "<div class=\"{$class[$type]}\">\n";
    if (!empty($status_heading[$type])) {
      $output .= '<h2 class="element-invisible">' . $status_heading[$type] . "</h2>\n";
    }
    if (count($messages) > 1) {
      $output .= " <ul>\n";
      foreach ($messages as $message) {
        $output .= '  <li>' . $message . "</li>\n";
      }
      $output .= " </ul>\n";
    }
    else {
      $output .= $messages[0];
    }
    $output .= "</div>\n";
  }
  return $output;
}

/**
 * Implements theme_delta_blocks_breadcrumb().
 */
// function omega_bootstrap_delta_blocks_breadcrumb($variables) {
//   $output = '';
   
//   if (!empty($variables['breadcrumb'])) {  
//     if ($variables['breadcrumb_current']) {
//       $variables['breadcrumb'][] = l(drupal_get_title(), current_path(), array('html' => TRUE));
//     }
  
//     $output = '<div id="breadcrumb" class="clearfix"><ul class="breadcrumb">';
//     $switch = array('odd' => 'even', 'even' => 'odd');
//     $zebra = 'even';
//     $last = count($variables['breadcrumb']) - 1;    
    
//     foreach ($variables['breadcrumb'] as $key => $item) {
//       $zebra = $switch[$zebra];
//       $attributes['class'] = array('depth-' . ($key + 1), $zebra);
      
//       if ($key == 0) {
//         $attributes['class'][] = 'first';
//       }
      
//       if ($key == $last) {
//         $attributes['class'][] = 'last';
//       }
//       else {
//         $item .= '<span class="divider">/</span>';
//       }

//       $output .= '<li' . drupal_attributes($attributes) . '>' . $item . '</li>';
//     }
      
//     $output .= '</ul></div>';
//   }
  
//   return $output;
// }


