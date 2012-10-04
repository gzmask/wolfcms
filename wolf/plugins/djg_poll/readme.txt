How to install

    Copy files to wolf/plugins/djg_poll directory
    Enter the admin page installation and activate the plugin.
    Append to layout:
    <!-- djg_poll --><link type="text/css" href="<?php echo URL_PUBLIC; ?>wolf/plugins/djg_poll/assets/djg_poll_frontend.css" rel="stylesheet" /><script type="text/javascript" src="<?php echo URL_PUBLIC; ?>djg_poll_assets.js"></script><!-- end djg_poll --> 

Required - jQuery in fronted
offline - <script type="text/javascript" src="http://repozytor/wolf_test/wolf/plugins/djg_poll/assets/jquery-1.7.2.min.js"></script>
online - <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
Example use

    Insert to page content or sidebar:
    <?php if (Plugin::isEnabled('djg_poll')) djg_poll_show_newest_poll(); ?>
    <?php if (Plugin::isEnabled('djg_poll')) djg_poll_show_poll_by_id(1); ?>
    <?php if (Plugin::isEnabled('djg_poll')) djg_poll_show_random_poll(); ?>
    <?php if (Plugin::isEnabled('djg_poll')) djg_poll_show_archive(); ?>

History version

    0.0.1 - beta

Translations

    Deutsch translation - soon
    Netherlands translation - soon
    Russian translation - soon

Used in plugin

    icons - http://www.iconfinder.com/search/?q=iconset%3Afatcow
    function - truncate by Dejan Andjelkovic <dejan79@gmail.com>