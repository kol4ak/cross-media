<?php 
/**
 * @file
 * Alpha's theme implementation to display a single Drupal page.
 */
?>
<div<?php print $attributes; ?>>
  <?php if (isset($page['header'])) : ?>
    <?php print render($page['header']); ?>
  <?php endif; ?>
  
  <?php if (isset($page['content'])) : ?>
    <?php if ($tabs): ?>
      <div class="tabs">
        <?php print render($tabs); ?>
      </div>
    <?php endif; ?>
    <?php print render($page['content']); ?>
  <?php endif; ?>  
  
  <?php if (isset($page['footer'])) : ?>
    <?php print render($page['footer']); ?>
  <?php endif; ?>
</div>