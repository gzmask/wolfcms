<?php
/*
 * Wolf CMS - Content Management Simplified. <http://www.wolfcms.org>
 * Copyright (C) 2009-2010 Martijn van der Kleijn <martijn.niji@gmail.com>
 * Copyright (C) 2008 Philippe Archambault <philippe.archambault@gmail.com>
 *
 * This file is part of Wolf CMS. Wolf CMS is licensed under the GNU GPLv3 license.
 * Please see license.txt for the full license text.
 */

/**
 * @package Layouts
 */

/* Security measure */
if (!defined('IN_CMS')) { exit(); }

// Redirect to front page if user doesn't have appropriate roles.
if (!AuthUser::hasPermission('admin_view')) {
    header('Location: '.URL_PUBLIC.' ');
    exit();
}

// Setup some stuff...
$ctrl = Dispatcher::getController(Setting::get('default_tab'));

// Allow for nice title.
// @todo improve/clean this up.
$title = ($ctrl == 'plugin') ? Plugin::$controllers[Dispatcher::getAction()]->label : ucfirst($ctrl).'s';
if (isset($this->vars['content_for_layout']->vars['action'])) {
    $tmp = $this->vars['content_for_layout']->vars['action'];
    $title .= ' - '.ucfirst($tmp);

    if ($tmp == 'edit' && isset($this->vars['content_for_layout']->vars['page'])) {
        $tmp = $this->vars['content_for_layout']->vars['page'];
        $title .= ' - '.$tmp->title;
    }
}
?>
<!doctype html>
<html lang="en">
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title><?php echo Setting::get('admin_title'), ' - ', $title; ?></title>

        <link rel="shortcut icon" type="image/vnd.microsoft.icon" href="/admin/themes/<?php echo Setting::get('theme'); ?>/favicon.ico" />
        <link rel="stylesheet" type="text/css" href="<?php echo URI_PUBLIC; ?>wolf/admin/themes/<?php echo Setting::get('theme'); ?>/screen.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="/admin/themes/handcraft/css/styles.css" />
        
        <!-- IE6 PNG support fix -->
        <!--[if lt IE 7]>
        <script type="text/javascript" charset="utf-8" src="<?php echo URI_PUBLIC; ?>wolf/admin/javascripts/unitpngfix.js"></script>
        <![endif]-->
        <script type="text/javascript" charset="utf-8" src="<?php echo URI_PUBLIC; ?>wolf/admin/javascripts/cp-datepicker.js"></script>
        <script type="text/javascript" charset="utf-8" src="<?php echo URI_PUBLIC; ?>wolf/admin/javascripts/wolf.js"></script>
        <script type="text/javascript" charset="utf-8" src="<?php echo URI_PUBLIC; ?>wolf/admin/javascripts/jquery-1.4.2.min.js"></script> 
        <script type="text/javascript" charset="utf-8" src="<?php echo URI_PUBLIC; ?>wolf/admin/javascripts/jquery-ui-1.8.5.custom.min.js"></script>
	<script type="text/javascript" charset="utf-8" src="<?php echo URI_PUBLIC; ?>wolf/admin/javascripts/jquery.ui.nestedSortable.js"></script>
        <script type="text/javascript" charset="utf-8" src="<?php echo URI_PUBLIC; ?>wolf/admin/markitup/jquery.markitup.js"></script>
   
    </head>
    <body>
        <header>
            <div id="logo"><a href="<?php echo URL_PUBLIC ?>"><?php echo Setting::get('admin_title') ?></a></div>
            <ul id="user-controls">
                <li><?php echo __('You are currently logged in as'); ?> <a href="<?php echo get_url('user/edit/' . AuthUser::getId()); ?>"><?php echo AuthUser::getRecord()->name; ?></a> | </li>
                <li><a href="<?php echo get_url('login/logout'); ?>"><?php echo __('Logout'); ?></a> | </li>
                <li><a id="site-view-link" href="http://localhost/073/" target="_blank"><?php echo __('View Site');?></a></li>
            </ul>
        </header>

        <nav>
            <ul>
                <li<?php if ($ctrl == 'page') echo ' class="current"'; ?>>
                    <a href="<?php echo get_url('page'); ?>">
                    <?php echo __('Pages'); ?> <span class="counter"><?php echo Record::countFrom('Page') ?></span>
                    </a>
                </li>
                <?php if (AuthUser::hasPermission('administrator,developer')): ?>
                <li<?php if ($ctrl == 'snippet') echo ' class="current"'; ?>><a href="<?php echo get_url('snippet'); ?>"><?php echo __('Snippets'); ?> <span class="counter"><?php echo Record::countFrom('Snippet') ?></span></a></li>
                <li<?php if ($ctrl == 'layout') echo ' class="current"'; ?>><a href="<?php echo get_url('layout'); ?>"><?php echo __('Layouts'); ?> <span class="counter"><?php echo Record::countFrom('Layout') ?></span></a></li>
                <?php endif; ?>
                <?php foreach (Plugin::$controllers as $plugin_name => $plugin): ?>
                    <?php if ($plugin->show_tab && (AuthUser::hasPermission($plugin->permissions) || AuthUser::hasPermission('administrator'))): ?>
                        <?php Observer::notify('view_backend_list_plugin', $plugin_name, $plugin); ?>
                        <li <?php if ($ctrl == 'plugin' && $action == $plugin_name)
                    echo ' class="current"'; ?>><a href="<?php echo get_url('plugin/' . $plugin_name); ?>"><?php echo __($plugin->label); ?></a></li>
                        <?php endif; ?>
                    <?php endforeach; ?>
            </ul>			

            <?php if (AuthUser::hasPermission('administrator')): ?>
                <ul class="right">
                    <li<?php if ($ctrl == 'setting' && $action == 'plugin')
                echo ' class="current"'; ?>><a href="<?php echo get_url('setting/plugin'); ?>"><?php echo __('Plugins'); ?></a></li>
                    <li<?php if ($ctrl == 'setting' && $action != 'plugin')
                        echo ' class="current"'; ?>><a href="<?php echo get_url('setting'); ?>"><?php echo __('Settings'); ?></a></li>
                    <li<?php if ($ctrl == 'user')
                        echo ' class="current"'; ?>><a href="<?php echo get_url('user'); ?>"><?php echo __('Users'); ?></a></li>
                </ul>
            <?php endif; ?>
        </nav>

        <div id="content" <?php if (isset($sidebar) && trim($sidebar) != '') { echo ' class="use-sidebar sidebar-at-side2"'; }?>>

            <?php if (isset($section_bar)) { ?>
                <div id="section-bar">
                    <?php echo $section_bar; ?>
                </div> <!-- #section_bar -->
            <?php } ?>

            <?php if (isset($page_bar)) { ?>
                <div id="page-bar">
                    <?php echo $page_bar; ?>
                </div> <!-- #page_bar -->
            <?php } ?>

            <section id="page-content">
                <?php echo $content_for_layout; ?>
            </section>
                
            <aside id="sidebar">
                <!-- sidebar -->
                <?php if (isset($sidebar) && trim($sidebar) != '') {
                echo $sidebar;
                } ?>
                <!-- end sidebar -->
            </aside>

            <div class="clearer">&nbsp;</div>

        </div>            
        
        <footer>
            <p>
                <?php echo __('Thank you for using'); ?> <a href="http://www.wolfcms.org/" target="_blank">Wolf CMS</a> <?php echo CMS_VERSION; ?> | <a href="http://forum.wolfcms.org/" target="_blank"><?php echo __('Feedback'); ?></a> | <a href="http://wiki.wolfcms.org/" target="_blank"><?php echo __('Documentation'); ?></a>
            </p>
            <?php if (DEBUG): ?>
            <p class="stats">
                <?php echo __('Page rendered in'); ?> <?php echo execution_time(); ?> <?php echo __('seconds'); ?>
                | <?php echo __('Memory usage:'); ?> <?php echo memory_usage(); ?>
            </p>
            <?php endif; ?>
        </footer>

    </body>
</html>
