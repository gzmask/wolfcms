<?php

/**
 * Wolf CMS - Content Management Simplified. <http://www.wolfcms.org>
 * Copyright (C) 2008 Martijn van der Kleijn <martijn.niji@gmail.com>
 *
 * This file is part of Wolf CMS.
 *
 * Wolf CMS is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Wolf CMS is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Wolf CMS.  If not, see <http://www.gnu.org/licenses/>.
 *
 * Wolf CMS has made an exception to the GNU General Public License for plugins.
 * See exception.txt for details and the full text.
 */
/**
	* The djg_poll plugin
	* @author Michał Uchnast <djgprv@gmail.com>,
	* @copyright kreacjawww.pl
	* @license http://www.gnu.org/licenses/gpl.html GPLv3 license
*/
/**
	* history version
	* 0.0.1 - to test
*/
Plugin::setInfos(array(
	'id'			=> 'djg_poll',
	'title'			=> __('[djg] Poll'),
	'description'	=> __('Poll'),
	'version'		=> '0.0.1',
	'license'		=> 'GPL',
	'author'		=>	'Michał Uchnast',
	'website'		=>	'http://www.kreacjawww.pl/',
	'update_url'	=> 'http://kreacjawww.pl/public/wolf_plugins/plugin-versions.xml',
	'require_wolf_version' => '0.7.3',
	'type'			=> 'both'
));

define('DJG_POLL_ROOT_DIR', CORE_ROOT . '/plugins/djg_poll/');
define('DJG_POLL_DEBUG', true);
Plugin::addController('djg_poll', __('[djg] Poll'), 'administrator', Plugin::getSetting('showTab','djg_poll'));
include_once('models'.DS.'Djgpoll.php');
include_once('lib'.DS.'phpMyGraph5.0.php');
include_once('lib'.DS.'DateDifference.php');
Dispatcher::addRoute(array(
  '/djg_poll_assets.js' => '/plugin/djg_poll/djg_poll_frontend_assets',
  '/djg_poll_vote.php' => '/plugin/djg_poll/djg_poll_ajax_vote',
  '/djg_poll_chart.php/:any/:any/:num/:any' => '/plugin/djg_poll/djg_poll_chart/$1/$2/$3/$4'
));

/** TEMP function
*/
function djg_poll_vote_test()
{
  $__CMS_CONN__ = Record::getConnection();
	$pollsq = $__CMS_CONN__->query('SELECT pollq_id, pollq_active FROM '.TABLE_PREFIX.'djg_pollsq WHERE pollq_active = 1 ORDER BY pollq_id DESC LIMIT 1');
	$q = $pollsq->fetchAll();
  echo 'cane vote: '.(int)Djgpoll::canVote($q[0]['pollq_id']);
}
function djg_poll_show_poll_by_id($questionId)
{
	echo '<div class="djg_poll">';
    echo Djgpoll::renderPollForm($questionId);
	echo '</div>';
}
function djg_poll_show_random_poll()
{
  $__CMS_CONN__ = Record::getConnection();
	$pollsq = $__CMS_CONN__->query('SELECT pollq_id, pollq_active FROM '.TABLE_PREFIX.'djg_pollsq WHERE pollq_active = 1');
	$q = $pollsq->fetchAll();
  djg_poll_show_poll_by_id($q[rand(0,count($q)-1)]['pollq_id']);
}
function djg_poll_show_newest_poll()
{
  $__CMS_CONN__ = Record::getConnection();
	$pollsq = $__CMS_CONN__->query('SELECT pollq_id, pollq_active FROM '.TABLE_PREFIX.'djg_pollsq WHERE pollq_active = 1 ORDER BY pollq_id DESC LIMIT 1');
	$q = $pollsq->fetchAll();
  djg_poll_show_poll_by_id($q[0]['pollq_id']);
}
function djg_poll_show_archive()
{
  $__CMS_CONN__ = Record::getConnection();
	$pollsq = $__CMS_CONN__->query('SELECT pollq_id,pollq_active FROM '.TABLE_PREFIX.'djg_pollsq WHERE pollq_active = 0 ORDER BY pollq_id DESC');
	$q = $pollsq->fetchAll();
  if (count($q)==0) echo '<p>'.__('No archive polls').'</p>';
  foreach ($q as $row):
    echo Djgpoll::renderPollResults($row['pollq_id']);
  endforeach;
}