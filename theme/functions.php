<?php
/**
 * Theme related functions. 
 *
 */
 
/**
 * Get title for the webpage by concatenating page specific title with site-wide title.
 *
 * @param string $title for this page.
 * @return string/null wether the favicon is defined or not.
 */
function get_title($title) {
  global $conDB;
  return $title . (isset($conDB['title_append']) ? $conDB['title_append'] : null);
}

/**
 * Create a navigation bar / menu for the site.
 *
 * @param string $menu for the navigation bar.
 * @return string as the html for the menu.
 */
function get_navbar($menu) {
  $html = "<nav class='{$menu['class']}'>\n";
  foreach($menu['items'] as $item) {
    $selected = $menu['callback_selected']($item['url']) ? " class='selected' " : null;
    $html .= "<a href='{$item['url']}' title='{$item['title']}' {$selected}>{$item['text']}</a>\n";
  }
  $html .= "\n</nav>\n";
  return $html;
}