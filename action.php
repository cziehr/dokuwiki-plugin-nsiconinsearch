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
        // Fetch the namespaces in which the icon should be shown from the configuration and save them in an array
        $in_namespaces_array = explode(" ", $this->getConf('in_namespaces'));
	// Compare each namespace from the array with the actual first-level-namespace of the page
        foreach ($in_namespaces_array as $ns_to_compare) {
		// Save the first-level-namespace in the variable $actual_ns
        	$actual_ns = strtok ( $event->data['page'] , (':') );
		// If the actual namespace matches the configured, show the icon
            	if($actual_ns == $ns_to_compare) {
			$icon = " <img src=\"lib/plugins/nsiconinsearch/img/". $actual_ns .".png\" alt=\"". $actual_ns ."\" width=\"20px\" height=\"20px\">";
        		$event->data['listItemContent'][] = $icon;
//			$this->write_debug($event);
			}
		}
	}

    public function fullpage(Doku_Event $event, $param)
    {
        // Fetch the namespaces in which the icon should be shown from the configuration and save them in an array
        $in_namespaces_array = explode(" ", $this->getConf('in_namespaces'));
        // Compare each namespace from the array with the actual first-level-namespace of the page
        foreach ($in_namespaces_array as $ns_to_compare) {
                // Save the first-level-namespace in the variable $actual_ns
                $actual_ns = strtok ( $event->data['page'] , (':') );
                // If the actual namespace matches the configured, show the icon
                if($actual_ns == $ns_to_compare) {
        		$icon = " <img src=\"lib/plugins/nsiconinsearch/img/". $actual_ns .".png\" alt=\"". $actual_ns ."\" width=\"20px\" height=\"20px\">";
        		$event->data['resultHeader'][] = $icon;
//        		$this->write_debug($event);
			}
		}
	}

/*
    function write_debug($data) {
        $text = print_r($data,1);
        $handle = fopen(DOKU_INC ."/nsiconinsearch_debug.txt", "a");

     fwrite($handle,"$text\n");
     fclose($handle);

    }
*/
}
