<?php

namespace nibinpaul\analytics;

use yii\helpers\Html;

/**
 * This is just an example.
 */
class Analytics extends \yii\base\Widget {

    public $connect = null;
    public $startDate;
    public $endDate;
    public $metrics = 'ga:sessions';
    public $dimensions = 'ga:browser';
    public $container_id = 'analayticsData';
//    public $sort=false,$filters=false;
    public $options = [];
    public $chartType = 'LINE';
    public $view_id;
    public $accesstoken;

    const SESSIONS = 'sessions';
    const VISITORS = 'visitors';
    const COUNTRIES = 'countries';
    const TOTAl_SESSIONS = 'total_sessions';
    const TOTAL_USERS = 'total_users';
    const TOTAL_PAGE_VIEWS = 'total_page_views';
    const AVERAGE_SESSION_LENGTH = 'average_session_length';

    /**
     * Initializes the widget
     */
    public function init() {
        parent::init();

        $this->connect = new Connect;
        // Set default values
        // @todo Find a better way to do this
        if (!isset($this->startDate)) {
            $this->startDate = date('Y-m-d', strtotime('-1 month'));
        }
        if (!isset($this->endDate)) {
            $this->endDate = date('Y-m-d');
        }
    }

    public function run() {

        $view = \Yii::$app->getView();
        $view->registerJs("
            (function(w,d,s,g,js,fs){
              g=w.gapi||(w.gapi={});g.analytics={q:[],ready:function(f){this.q.push(f);}};
              js=d.createElement(s);fs=d.getElementsByTagName(s)[0];
              js.src='https://apis.google.com/js/platform.js';
              fs.parentNode.insertBefore(js,fs);js.onload=function(){g.load('analytics');};
            }(window,document,'script'));
            ");
        $show = Html::tag('div', '', ['id' => $this->container_id]);
        $chartvar = 'chart' . mt_rand(111111, 999999999);
        $additionalParams = [];
        if (!empty($this->options)) {
            foreach ($this->options as $key => $option) {
                $additionalParams[] = "'" . $key . "':'" . $option . "'";
            }
        }

        $view->registerJs("gapi.analytics.ready(function() {
gapi.analytics.auth.authorize({
    'serverAuth': {
      'access_token': '" . $this->connect->accessToken . "'
    }
  });
  var " . $chartvar . " = new gapi.analytics.googleCharts.DataChart({
    query: {
      'ids': '" . $this->view_id . "', // <-- Replace with the ids value for your view.
      'start-date': '" . $this->startDate . "',
      'end-date': '" . $this->endDate . "',
      'metrics': '" . $this->metrics . "',
      'dimensions': '" . $this->dimensions . "',
       " . implode(',', $additionalParams) . "
    },
    chart: {
      'container': '" . $this->container_id . "',
      'type': '" . $this->chartType . "',
      'options': {
        'width': '100%'
      }
    }
  });
  " . $chartvar . ".execute();
  });");
        return $show;
    }

}
