<?php
/**
 * DokuWiki Plugin nsiconinsearch (Action Component)
 *
 * @license GPL 2 http://www.gnu.org/licenses/gpl-2.0.html
 * @author  Christoph Ziehr <info@einsatzleiterwiki.de>
 */

// TO DO
// Höhe selbst festlegen per conf, Hinweis dass kleine Bilder verwendet werden sollten

// must be run within Dokuwiki
if (!defined('DOKU_INC')) {
    die();
}

class action_plugin_nsiconinsearch extends DokuWiki_Action_Plugin
{

    public function register(Doku_Event_Handler $controller)
    {
        $controller->register_hook('SEARCH_RESULT_PAGELOOKUP', 'BEFORE', $this, 'pagelookup',array());
        $controller->register_hook('SEARCH_RESULT_FULLPAGE', 'BEFORE', $this, 'fullpage',array());
    }

    public function pagelookup(Doku_Event $event, $param)
    {
        // get the first level namespace
        $actual_ns = strtok ( $event->data['page'] , (':') );
        // check if an icon exists for the first level namespace, if yes show it for the search result
        if (file_exists('data/media/'.$actual_ns.'/'.$this->getConf('iconfile'))) {
            $icon = " <img src=\"lib/exe/fetch.php?media=". $actual_ns .":". $this->getConf('iconfile') ."\" alt=\"". $actual_ns ."\" width=\"". $this->getConf('iconwidth') ."\" height=\"". $this->getConf('iconheight') ."\">";
            $event->data['listItemContent'][] = $icon;
        }
    }

    public function fullpage(Doku_Event $event, $param)
    {
        // get the first level namespace
        $actual_ns = strtok ( $event->data['page'] , (':') );
        // check if an icon exists for the first level namespace, if yes show it for the search result
        if (file_exists('data/media/'.$actual_ns.'/'.$this->getConf('iconfile'))) {
            $icon = " <img src=\"lib/exe/fetch.php?media=". $actual_ns .":". $this->getConf('iconfile') ."\" alt=\"". $actual_ns ."\" width=\"". $this->getConf('iconwidth') ."\" height=\"". $this->getConf('iconheight') ."\">";
        		$event->data['resultHeader'][] = $icon;
        }
    }
}
