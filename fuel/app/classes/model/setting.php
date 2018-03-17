<?php

use Fuel\Core\DB;

/**
 * Any query in Model Version
 *
 * @package Model
 * @created 2017-10-29
 * @version 1.0
 * @author AnhMH
 */
class Model_Setting extends Model_Abstract {
    
    /** @var array $_properties field of table */
    protected static $_properties = array(
        'id',
        'cate_id',
        'name',
        'description',
        'content',
        'image',
        'is_default',
        'is_home_slide',
        'is_hot',
        'type',
        'created',
        'updated',
        'disable'
    );

    protected static $_observers = array(
        'Orm\Observer_CreatedAt' => array(
            'events'          => array('before_insert'),
            'mysql_timestamp' => false,
        ),
        'Orm\Observer_UpdatedAt' => array(
            'events'          => array('before_update'),
            'mysql_timestamp' => false,
        ),
    );

    /** @var array $_table_name name of table */
    protected static $_table_name = 'settings';

    /**
     * Get general
     *
     * @author AnhMH
     * @param array $param Input data
     * @return int|bool User ID or false if error
     */
    public static function get_general($param)
    {
        // Init
        $result = array();
        
        // Get cates
        $result['cates'] = Model_Cate::get_all(array(
            'get_sub_cates' => 1
        ));
        
        // Get lastest post
        
        $result['latest_post'] = Model_Post::get_all(array(
            'page' => 1,
            'limit' => 6
        ));
        
        // Get setting
        $result['settings'] = array(
            'web_title' => 'Con Là Tất Cả',
            'web_description' => '',
            'web_keyword' => '',
            'facebook' => 'https://www.facebook.com/pageconlatatca',
            'twitter' => 'https://twitter.com/',
            'instagram' => 'https://www.instagram.com/conlatatcainfo/',
            'google_plus' => 'https://plus.google.com/u/0/113674456774184840341?hl=vi'
        );
                
        // Return
        return $result;
    }
}
