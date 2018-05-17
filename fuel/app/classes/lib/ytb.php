<?php

/**
 * class Util - support functions for Util
 *
 * @package Lib
 * @created 2014-11-25
 * @version 1.0
 * @author thailh
 * @copyright Oceanize INC
 */

namespace Lib;

use Google_Client;
use Google_Service_YouTube;
use Google_Exception;
use Google_Service_Exception;

class Ytb {

    public static $_apiKey = 'AIzaSyBUyxSVxmh4Y3Nzm4wCmpzirtXOOXMcP1w ';
    public static $_clientId = '889646990808-gcpih51d7n57crheink516j2kjb5fnat.apps.googleusercontent.com';
    public static $_clientSecret = 'fCfBRuy5HMFZjm35j0yr_IbN';

    public static function search_by_keyword($param) {
        /*
         * Set $DEVELOPER_KEY to the "API key" value from the "Access" tab of the
         * {{ Google Cloud Console }} <{{ https://cloud.google.com/console }}>
         * Please ensure that you have enabled the YouTube Data API for your project.
         */
        $DEVELOPER_KEY = self::$_apiKey;
        $limit = !empty($param['limit']) ? $param['limit'] : '10';
        if (empty($param['keyword'])) {
            return false;
        }

        $client = new Google_Client();
        $client->setDeveloperKey($DEVELOPER_KEY);

        // Define an object that will be used to make all API requests.
        $youtube = new Google_Service_YouTube($client);

        try {
            $searchResponse = $youtube->search->listSearch('id,snippet', array(
                'q' => $param['keyword'],
                'maxResults' => $limit,
            ));

            return $searchResponse;
        } catch (\Google_Service_Exception $e) {
            return $e->getMessage();
        } catch (\Google_Exception $e) {
            return $e->getMessage();
        }
    }

    public static function retrieve_my_upload() {
        $DEVELOPER_KEY = self::$_apiKey;
        $OAUTH2_CLIENT_ID = self::$_clientId;
        $OAUTH2_CLIENT_SECRET = self::$_clientSecret;

        $client = new Google_Client();
        $client->setDeveloperKey($DEVELOPER_KEY);
        $client->setClientId($OAUTH2_CLIENT_ID);
        $client->setClientSecret($OAUTH2_CLIENT_SECRET);
        $client->setScopes('https://www.googleapis.com/auth/youtube');
        $redirect = filter_var('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'], FILTER_SANITIZE_URL);
        $client->setRedirectUri($redirect);

        // Define an object that will be used to make all API requests.
        $youtube = new Google_Service_YouTube($client);
        // Check if an auth token exists for the required scopes
        $tokenSessionKey = 'token-' . $client->prepareScopes();
        if (isset($_GET['code'])) {
            if (strval($_SESSION['state']) !== strval($_GET['state'])) {
                die('The session state did not match.');
            }

            $client->authenticate($_GET['code']);
            $_SESSION[$tokenSessionKey] = $client->getAccessToken();
            header('Location: ' . $redirect);
        }

        if (isset($_SESSION[$tokenSessionKey])) {
            $client->setAccessToken($_SESSION[$tokenSessionKey]);
        }
        
        return $client->getAccessToken();
        // Check to ensure that the access token was successfully acquired.
//        if ($client->getAccessToken()) {
            $_SESSION[$tokenSessionKey] = $client->getAccessToken();
            try {
                // Call the channels.list method to retrieve information about the
                // currently authenticated user's channel.
                $channelsResponse = $youtube->channels->listChannels('contentDetails', array(
                    'mine' => 'true',
                ));
                
                return $channelsResponse;
            } catch (Google_Service_Exception $e) {
                return $e->getMessage();
            } catch (Google_Exception $e) {
                return $e->getMessage();
            }
//        }
    }

}
