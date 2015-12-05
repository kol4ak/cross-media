  <div id="page-wrapper"><div id="page">

    <div id="header"><div class="section">

      <?php if ($logo): ?>
        <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo">
          <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
        </a>
      <?php endif; ?>

      <?php print render($page['header']); ?>

            <?php if ($secondary_menu): ?>
                <div id="secondary-menu" class="navigation">
                    <?php print theme('links__system_secondary_menu', array(
                        'links' => $secondary_menu,
                        'attributes' => array(
                            'id' => 'secondary-menu-links',
                            'class' => array('links', 'inline', 'clearfix'),
                        ),
                        'heading' => array(
                            'text' => t('Secondary menu'),
                            'level' => 'h2',
                            'class' => array('element-invisible'),
                        ),
                    )); ?>
                </div> <!-- /#secondary-menu -->
            <?php endif; ?>

    </div></div> <!-- /#header -->

    <?php if ($page['top_content']): ?>
    <div id="top-content" class="clearfix"><div class="section">
      <?php print render($page['top_content']); ?>
    </div></div> <!-- /.section, /#navigation -->
    <?php endif; ?>

   <!--  <?php if ($breadcrumb): ?>
      <div id="breadcrumb"><div class="section"><//?php print $breadcrumb; ?></div></div>
    <?php endif; ?> -->

    <?php print $messages; ?>

    <div id="main-wrapper"><div id="main" class="clearfix"><div class="section">
      <?php if ($page['sidebar_first']): ?>
        <div id="sidebar-first" class="sidebar">
          <?php print render($page['sidebar_first']); ?>
        </div> <!-- /#sidebar-first -->
      <?php endif; ?>

      <div id="content">
        <a id="main-content"></a>
        <?php  print render($title_prefix); ?>
        <?php if ($title): ?><h1 class="title" id="page-title"><?php print $title; ?></h1><?php endif; ?>
        <?php print render($title_suffix); ?>

        <?php if ($tabs): ?><div class="tabs"><?php print render($tabs); ?></div><?php endif; ?>
        <?php print render($page['help']); ?>
        <?php if ($action_links): ?><ul class="action-links"><?php print render($action_links); ?></ul><?php endif; ?>
        <?php print render($page['content']);?>
      </div> <!-- /#content -->

      <?php if ($page['sidebar_second']): ?>
        <div id="sidebar-second" class="sidebar">
          <?php print render($page['sidebar_second']); ?>
        </div> <!-- /#sidebar-second -->
      <?php endif; ?>

    </div></div></div> <!-- /#main, /#main-wrapper -->

    <div id="add-space" class="clearfix"></div>
  </div></div> <!-- /#page, /#page-wrapper -->

  <div id="footer-wrapper"><div id="footer"><div class="section">
    <?php print render($page['footer']); ?>
  </div></div></div> <!-- /#footer, /#footer-wrapper -->

