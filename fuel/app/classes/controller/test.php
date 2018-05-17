<?php

/**
 * Controller_Test
 *
 * @package Controller
 * @created 2016-08-31
 * @version 1.0
 * @author KienNH
 * @copyright Oceanize INC
 */
class Controller_Test extends \Controller_Rest {

    /**
     * 
     */
    public function action_index() {
        $param = array(
            'keyword' => 'con la tat ca',
            'limit' => 50
        );
        $data = Lib\Ytb::retrieve_my_upload($param);
        echo '<pre>';
        print_r($data);
        die();
        echo date('Y-m-d H:i:s');
        echo '<br/>';
        echo date_default_timezone_get();
        exit;
    }
    
    /**
     * Show PHP info
     */
    public function action_phpinfo() {
        phpinfo();
        exit;
    }
      /**
     *  
     * @return boolean Action Conf of TestController
     */
    public function action_conf($config = 'upload') {
        include_once APPPATH . "/config/auth.php";
        echo '<pre>';
        print_r( \Config::load($config, true));
        echo '</pre>';
    }
    
    /**
     * Test mail
     */
    public function action_mail() {
        include_once APPPATH . "/config/auth.php";
        if (empty($_GET['to'])) {
            die('Missing TO address: ?to=xxx@yyy.zzz');
        }
        echo !extension_loaded('openssl')? "openssl not available" : "openssl available";
        $to = $_GET['to'];
        $email = \Email::forge('jis');
        
        echo '<pre>';
        print_r($email->config['phpmailer']);
        echo '</pre>';
        
        $email->from(Config::get('system_email.noreply'), 'Quick No reply');
        $email->subject('[Hosty test SMTP]Subject');
        $email->html_body('[Hosty test SMTP]Body');
        $email->to($to);
        try {
            if ($email->send()) {
                echo 'OK';
            } else {
                echo 'NG';
            }
        } catch (\EmailSendingFailedException $e) {
            echo '<pre>';
            print_r($e);
            echo '</pre>';
        } catch (\EmailValidationFailedException $e) {
    		echo '<pre>';
            print_r($e);
            echo '</pre>';
    	} catch (Exception $e) {
            echo '<pre>';
            print_r($e);
            echo '</pre>';
        }
    }
}
