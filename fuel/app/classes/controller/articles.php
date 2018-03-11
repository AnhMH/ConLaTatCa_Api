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
     * Get list
     */
    public function action_addupdate() {
        return \Bus\Articles_AddUpdate::getInstance()->execute();
    }
    
    /**
     * Get list
     */
    public function action_detail() {
        return \Bus\Articles_Detail::getInstance()->execute();
    }
    
    /**
     * Disable
     */
    public function action_disable() {
        return \Bus\Articles_Disable::getInstance()->execute();
    }
    
    /**
     * Get home data
     */
    public function action_gethomedata() {
        return \Bus\Articles_GetHomeData::getInstance()->execute();
    }
}
