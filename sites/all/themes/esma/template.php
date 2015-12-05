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
function esma_date_nav_title($params) {
  $granularity = $params['granularity'];
  $view = $params['view'];
  $date_info = $view->date_info;
  $link = !empty($params['link']) ? $params['link'] : FALSE;
  $format = !empty($params['format']) ? $params['format'] : NULL;
  switch ($granularity) {
    case 'year':
      $title = $date_info->year;
      $date_arg = $date_info->year;
      break;
    case 'month':
      $format = !empty($format) ? $format : (empty($date_info->mini) ? 'F Y' : 'F');
      $title = date_format_date($date_info->min_date, 'custom', $format);
      global $language;
      if ($language -> language == 'ru') {
        $title_array = explode(' ', $title);
        $month_ru_names = array(
            1 => 'Январь',
            2 => 'Февраль',
            3 => 'Март',
            4 => 'Апрель',
            5 => 'Май',
            6 => 'Июнь',
            7 => 'Июль',
            8 => 'Август',
            9 => 'Сентябрь',
            10 => 'Октябрь',
            11 => 'Ноябрь',
            12 => 'Декабрь',
        );
        $title_array[0] = $month_ru_names[$date_info->month];
        $title = implode(' ', $title_array);
      }
      $date_arg = $date_info->year . '-' . date_pad($date_info->month);
      break;
    case 'day':
      $format = !empty($format) ? $format : (empty($date_info->mini) ? 'l, F j, Y' : 'l, F j');
      $title = date_format_date($date_info->min_date, 'custom', $format);
      $title = $date_info->day . ' ' . date_format_date($date_info->min_date, 'custom', 'F') . ' ' . $date_info->year;
      $date_arg = $date_info->year . '-' . date_pad($date_info->month) . '-' . date_pad($date_info->day);
      break;
    case 'week':
      $format = !empty($format) ? $format : (empty($date_info->mini) ? 'F j, Y' : 'F j');
      $title = t('Week of @date', array('@date' => date_format_date($date_info->min_date, 'custom', $format)));
      $date_arg = $date_info->year . '-W' . date_pad($date_info->week);
      break;
  }
  if (!empty($date_info->mini) || $link) {
    // Month navigation titles are used as links in the mini view.
    $attributes = array('title' => t('View full page month'));
    $url = date_pager_url($view, $granularity, $date_arg, TRUE);
    return l($title, $url, array('attributes' => $attributes));
  }
  else {
    return $title;
  }
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


