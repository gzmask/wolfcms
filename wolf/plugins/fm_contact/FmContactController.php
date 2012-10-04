<?php
/*  
 * @package Plugins
 * fm_contact - A contact form pulgin for Wolf CMS for HTML 
 * Copyright (C) 2012 Fredy Mettler <homepage@hotmail.ch> 
 * @author Fredy Mettler <homepage@hotmail.ch> 
 *  Version 1.0.0  
 */
class FmContactController extends PluginController {
    function __construct() {
        AuthUser::load();
        if ( ! AuthUser::isLoggedIn()) {
            redirect(get_url('login'));
        }
 
        $this->setLayout('backend');
        $this->assignToLayout('sidebar', new View('../../plugins/fm_contact/views/sidebar'));
    }

	public function index()
	{
		$this->settings();
	}

	/*
	 * Load documentation subpage view
	 */
	public function documentation()
	{
		$this->display('fm_contact/views/documentation');
	}

  public function settings() {
    $this->display('fm_contact/views/settings');
    }
}