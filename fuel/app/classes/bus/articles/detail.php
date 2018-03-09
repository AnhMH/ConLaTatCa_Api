<?php

namespace Bus;

/**
 * Get detail data
 *
 * @package Bus
 * @created 2017-10-29
 * @version 1.0
 * @author AnhMH
 */
class Articles_Detail extends BusAbstract
{
    /** @var array $_required field require */
    protected $_required = array(
        'id'
    );

    /** @var array $_length Length of fields */
    protected $_length = array(
        
    );

    /** @var array $_email_format field email */
    protected $_email_format = array(
        
    );

    /**
     * Call function get_detail() from model Article
     *
     * @author AnhMH
     * @param array $data Input data
     * @return bool Success or otherwise
     */
    public function operateDB($data)
    {
        try {
            $this->_response = \Model_Article::get_detail($data);
            return $this->result(\Model_Article::error());
        } catch (\Exception $e) {
            $this->_exception = $e;
        }
        return false;
    }
}
