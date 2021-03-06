<?php

/**
 * Controller for actions on articles
 *
 * @package Controller
 * @created 2018-03-02
 * @version 1.0
 * @author AnhMH
 * @copyright Oceanize INC
 */
class Controller_Articles extends \Controller_App {

    /**
     * Get list
     */
    public function action_list() {
        return \Bus\Articles_List::getInstance()->execute();
    }
    
    /**
     * Disable
     */
    public function action_disable() {
        return \Bus\Articles_Disable::getInstance()->execute();
    }
}
