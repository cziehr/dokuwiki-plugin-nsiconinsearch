<?php
/**
 * DokuWiki Plugin nsiconinsearch (Action Component)
 *
 * @license GPL 2 http://www.gnu.org/licenses/gpl-2.0.html
 * @author  Christoph Ziehr <info@einsatzleiterwiki.de>
 */

// must be run within Dokuwiki
if (!defined('DOKU_INC')) {
    die();
}

class action_plugin_nsiconinsearch extends DokuWiki_Action_Plugin
{

    /**
     * Registers a callback function for a given event
     *
     * @param Doku_Event_Handler $controller DokuWiki's event controller object
     *
     * @return void
     */
    public function register(Doku_Event_Handler $controller)
    {
        $controller->register_hook('SEARCH_RESULT_PAGELOOKUP', 'BEFORE', $this, 'handle_search_result_pagelookup');
        $controller->register_hook('SEARCH_RESULT_FULLPAGE', 'BEFORE', $this, 'handle_search_result_fullpage');
    }

    /**
     * [Custom event handler which performs action]
     *
     * Called for event:
     *
     * @param Doku_Event $event  event object by reference
     * @param mixed      $param  [the parameters passed as fifth argument to register_hook() when this
     *                           handler was registered]
     *
     * @return void
     */

    public function handle_search_result_pagelookup(Doku_Event $event, $param)
    {
        $icon = "<p>TEST</p>";
        $event->data['listItemContent'][] = $icon;
    }

    public function handle_search_result_fullpage(Doku_Event $event, $param)
    {
        $icon = "<p>TEST</p>";
        $event->data['resultHeader'][] = $icon;
    }
}
