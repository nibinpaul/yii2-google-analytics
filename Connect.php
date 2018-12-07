<?php

namespace nibinpaul\analytics;

use yii;
/**
 * This is just an example.
 */
class Connect extends \yii\base\Action {

    public $connection = null,$jsonPath='@backend/assets/certificate/service-account-credentials.json';
    public $accessToken;
    public function __construct() {
        parent::init();
        $this->connection = $this->connect();
    }
    public function Connect(){
        $client=new \Google_Client();
        $client->setApplicationName("tanmia");
        $client->setScopes(\Google_Service_Analytics::ANALYTICS_READONLY);
        $client->setAuthConfigFile(\yii::getAlias($this->jsonPath));
        $client->refreshTokenWithAssertion();
        $token = $client->getAccessToken();
        $this->accessToken = $token['access_token'];
        return $this->accessToken;
    }

}
