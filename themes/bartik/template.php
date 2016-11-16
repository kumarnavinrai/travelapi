<?php

$urlforform = "http://travelpainters.com/travel/";

global $base_url;   // Will point to http://www.example.com

if(strpos($base_url, "travelpainters.local"))
{
  
}
elseif(strpos($base_url, "flyoticket.com"))
{
 if (!isset($_SERVER['HTTPS']) or $_SERVER['HTTPS'] == 'off' ) {
    $serverhost = str_replace("www.", "", $_SERVER['HTTP_HOST']);
    $redirect_url = "https://" . $serverhost . $_SERVER['REQUEST_URI'];
    header("Location: $redirect_url");
    exit();
}

  
}

/**
 * Add body classes if certain regions have content.
 */
function bartik_preprocess_html(&$variables) {

  $node = menu_get_object();

  if ($node && $node->nid) {
    $variables['theme_hook_suggestions'][] = 'html__' . $node->type;
  }
  if (!empty($variables['page']['featured'])) {
    $variables['classes_array'][] = 'featured';
  }

  if (!empty($variables['page']['triptych_first'])
    || !empty($variables['page']['triptych_middle'])
    || !empty($variables['page']['triptych_last'])) {
    $variables['classes_array'][] = 'triptych';
  }

  if (!empty($variables['page']['footer_firstcolumn'])
    || !empty($variables['page']['footer_secondcolumn'])
    || !empty($variables['page']['footer_thirdcolumn'])
    || !empty($variables['page']['footer_fourthcolumn'])) {
    $variables['classes_array'][] = 'footer-columns';
  }
  
  
  global $user;
	$role=$user->roles;

	if(isset($node->type) &&$node->type == 'flightbooking' && (in_array('subadmin',$role) || in_array('cce',$role)))
	{
		$variables['theme_hook_suggestion'] = 'html__subadminflightbookings';
	}

  
  // Add conditional stylesheets for IE
  drupal_add_css(path_to_theme() . '/css/ie.css', array('group' => CSS_THEME, 'browsers' => array('IE' => 'lte IE 7', '!IE' => FALSE), 'preprocess' => FALSE));
  drupal_add_css(path_to_theme() . '/css/ie6.css', array('group' => CSS_THEME, 'browsers' => array('IE' => 'IE 6', '!IE' => FALSE), 'preprocess' => FALSE));
}



function bartik_preprocess_user_register_form(&$vars) {
  $args = func_get_args();
  array_shift($args);
  $form_state['build_info']['args'] = $args; 
  $vars['form'] = drupal_build_form('user_register_form', $form_state['build_info']['args']);
}

/**
 * Override or insert variables into the page template for HTML output.
 */
function bartik_process_html(&$variables) { 
  // Hook into color.module.
  if (module_exists('color')) {
    _color_html_alter($variables);
  }
  if(isset($urlforform) == true)
  {
    $variables['urlforform'] = $urlforform;
  }  
}


function bartik_preprocess_page(&$vars, $hook) { 
  if (isset($vars['node'])) {
    // If the node type is "blog_madness" the template suggestion will be "page--blog-madness.tpl.php".
    $vars['theme_hook_suggestions'][] = 'page__'. $vars['node']->type;
  }

  $header = drupal_get_http_header("status");
   if($header == "404 Not Found") {    
     $vars['theme_hook_suggestions'][] = 'page__404';
   }elseif ($header == "403 Forbidden") {
     $vars['theme_hook_suggestions'][] = 'page__403';
  }
  
   if ($node = menu_get_object()) {
    $vars['node'] = $node;
	global $user;
	$role=$user->roles;
	if($node->type == 'flightbooking' && (in_array('subadmin',$role) || in_array('cce',$role)))
	{
		$vars['theme_hook_suggestion'] = 'page__subadminflightbookings';
	}
	
  }   
 
}

/**
 * Override or insert variables into the page template.
 */
function bartik_process_page(&$variables) {
  if(isset($urlforform) == true)
  {  
    $variables['urlforform'] = $urlforform;
  }  
  // Hook into color.module.
  if (module_exists('color')) {
    _color_page_alter($variables);
  }
  // Always print the site name and slogan, but if they are toggled off, we'll
  // just hide them visually.
  $variables['hide_site_name']   = theme_get_setting('toggle_name') ? FALSE : TRUE;
  $variables['hide_site_slogan'] = theme_get_setting('toggle_slogan') ? FALSE : TRUE;
  if ($variables['hide_site_name']) {
    // If toggle_name is FALSE, the site_name will be empty, so we rebuild it.
    $variables['site_name'] = filter_xss_admin(variable_get('site_name', 'Drupal'));
  }
  if ($variables['hide_site_slogan']) {
    // If toggle_site_slogan is FALSE, the site_slogan will be empty, so we rebuild it.
    $variables['site_slogan'] = filter_xss_admin(variable_get('site_slogan', ''));
  }
  // Since the title and the shortcut link are both block level elements,
  // positioning them next to each other is much simpler with a wrapper div.
  if (!empty($variables['title_suffix']['add_or_remove_shortcut']) && $variables['title']) {
    // Add a wrapper div using the title_prefix and title_suffix render elements.
    $variables['title_prefix']['shortcut_wrapper'] = array(
      '#markup' => '<div class="shortcut-wrapper clearfix">',
      '#weight' => 100,
    );
    $variables['title_suffix']['shortcut_wrapper'] = array(
      '#markup' => '</div>',
      '#weight' => -99,
    );
    // Make sure the shortcut link is the first item in title_suffix.
    $variables['title_suffix']['add_or_remove_shortcut']['#weight'] = -100;
  }
  
}

/**
 * Implements hook_preprocess_maintenance_page().
 */
function bartik_preprocess_maintenance_page(&$variables) {
  // By default, site_name is set to Drupal if no db connection is available
  // or during site installation. Setting site_name to an empty string makes
  // the site and update pages look cleaner.
  // @see template_preprocess_maintenance_page
  if (!$variables['db_is_active']) {
    $variables['site_name'] = '';
  }
  drupal_add_css(drupal_get_path('theme', 'bartik') . '/css/maintenance-page.css');
}

/**
 * Override or insert variables into the maintenance page template.
 */
function bartik_process_maintenance_page(&$variables) {
  // Always print the site name and slogan, but if they are toggled off, we'll
  // just hide them visually.
  $variables['hide_site_name']   = theme_get_setting('toggle_name') ? FALSE : TRUE;
  $variables['hide_site_slogan'] = theme_get_setting('toggle_slogan') ? FALSE : TRUE;
  if ($variables['hide_site_name']) {
    // If toggle_name is FALSE, the site_name will be empty, so we rebuild it.
    $variables['site_name'] = filter_xss_admin(variable_get('site_name', 'Drupal'));
  }
  if ($variables['hide_site_slogan']) {
    // If toggle_site_slogan is FALSE, the site_slogan will be empty, so we rebuild it.
    $variables['site_slogan'] = filter_xss_admin(variable_get('site_slogan', ''));
  }
}

/**
 * Override or insert variables into the node template.
 */
function bartik_preprocess_node(&$variables) {
  if ($variables['view_mode'] == 'full' && node_is_page($variables['node'])) {
    $variables['classes_array'][] = 'node-full';
  }
  
  //Added for flightbooking to show SUBADMIN and a FLIGHTUSER
  $node=$variables['node'];
  global $user;

	$role=$user->roles;

	
	if($node->type == 'flightbooking' && (in_array('subadmin',$role) || in_array('cce',$role)))
	{
	
	//echo "<pre>";
	//die('rahul');
		$variables['theme_hook_suggestion'] = 'node__subadminflightbookings';
	}
  
	
	//if($node->type == 'flightbooking' && strpos($_SERVER['HTTP_REFERER'], 'allflights') !== false)
	//{
	//	$variables['theme_hook_suggestion'] = 'node__subadminflightbookings';
	//}
  
}

/**
 * Override or insert variables into the block template.
 */
function bartik_preprocess_block(&$variables) {
  // In the header region visually hide block titles.
  if ($variables['block']->region == 'header') {
    $variables['title_attributes_array']['class'][] = 'element-invisible';
  }
}

/**
 * Implements theme_menu_tree().
 */
function bartik_menu_tree($variables) {
  return '<ul class="menu clearfix">' . $variables['tree'] . '</ul>';
}

/**
 * Implements theme_field__field_type().
 */
function bartik_field__taxonomy_term_reference($variables) {
  $output = '';

  // Render the label, if it's not hidden.
  if (!$variables['label_hidden']) {
    $output .= '<h3 class="field-label">' . $variables['label'] . ': </h3>';
  }

  // Render the items.
  $output .= ($variables['element']['#label_display'] == 'inline') ? '<ul class="links inline">' : '<ul class="links">';
  foreach ($variables['items'] as $delta => $item) {
    $output .= '<li class="taxonomy-term-reference-' . $delta . '"' . $variables['item_attributes'][$delta] . '>' . drupal_render($item) . '</li>';
  }
  $output .= '</ul>';

  // Render the top-level DIV.
  $output = '<div class="' . $variables['classes'] . (!in_array('clearfix', $variables['classes_array']) ? ' clearfix' : '') . '"' . $variables['attributes'] .'>' . $output . '</div>';

  return $output;
}


function bartik_theme(){    
  $items = array();   
      
  $items['user_login'] = array(   
    'render element' => 'form',   
    'path' => drupal_get_path('theme', 'bartik') . '/templates',    
    'template' => 'user-login',   
    'preprocess functions' => array(    
       'bartik_preprocess_user_login'   
    ),    
  );    
  $items['user_register_form'] = array(   
    'render element' => 'form',   
    'path' => drupal_get_path('theme', 'bartik') . '/templates',    
    'template' => 'user-register-form',   
    'preprocess functions' => array(    
      'bartik_preprocess_user_register_form'    
    ),    
  );    
  $items['user_pass'] = array(    
    'render element' => 'form',   
    'path' => drupal_get_path('theme', 'bartik') . '/templates',    
    'template' => 'user-pass',    
    'preprocess functions' => array(    
      'bartik_preprocess_user_pass'   
    ),    
  );    
    $items['flightbooking_node_form'] = array(    
    'render element' => 'form',   
    'path' => drupal_get_path('theme', 'bartik') . '/templates',    
    'template' => 'editflightbooking-node-form',  
	//'arguments'=>array('form' => null),  
    
  );
  
  	

  return $items;    
}   
/*    
function bartik_preprocess_user_login(&$vars) {   
  $vars['intro_text'] = t('This is my awesome login form');   
}   
function bartik_preprocess_user_register_form(&$vars) {   
  $vars['intro_text'] = t('This is my super awesome reg form');   
}   
function bartik_preprocess_user_pass(&$vars) {    
  $vars['intro_text'] = t('This is my super awesome request new password form');    
}   
*/