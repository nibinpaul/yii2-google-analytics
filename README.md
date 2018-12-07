Google Analytics
================
Show google analaytics data chart in your dashboard using [Google Analytics Embeded API](https://developers.google.com/analytics/devguides/reporting/embed/v1/).

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist nibinpaul/yii2-google-analytics "*"
```

or add

```
"nibinpaul/yii2-google-analytics": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
<?= \nibinpaul\analytics\Analytics::widget(['analyticsID'=>'ga:*********]); ?>
```



- Required properties
    - **analyticsID** Google analyticsID.You can get the this value from [this link](https://ga-dev-tools.appspot.com/account-explorer/).
- Optional properties
    - **startDate** Start date for fetching Analytics data. Requests can specify a start date formatted as YYYY-MM-DD, or as a relative date (e.g., today, yesterday, or NdaysAgo where N is a positive integer). Defaut to - 30daysAgo
    - **endDate** End date for fetching Analytics data. Request can specify an end date formatted as YYYY-MM-DD, or as a relative date (e.g., today, yesterday, or NdaysAgo where N is a positive integer). Defaut to today
    - **metrics** A list of comma-separated metrics, such as ga:sessions,ga:bounces.Default to ga:sessions.
    - **dimensions**  	A list of comma-separated dimensions for your Analytics data, such as ga:browser,ga:city. Default to ga:browser
    - **container_id** The div id to be generated default to analayticsData.Add if uses more than one widget.
    - **extraFields** The extra fields as array which are specified in [this link](https://developers.google.com/analytics/devguides/reporting/core/v3/reference#q_summary)
    - **chartType** (string)The type of chart to be dispalay. The values may be LINE,BAR,TABLE etc..


Google Authentication
---------------------
Google Authentication is Required to recive the data.

Go to the [Google developers console](https://console.developers.google.com/apis?project=tanmia-224709)

Create a new project (or use an existing project)

Open the project

Enable Analytics API

In Credentials page Create service account key or use Existing key. Download the file in json Format.

Put the file in @app/assets/certificate/service-account-credentials.json(rename the file).

Add the mailId of Service Account (we just created) into user 
Give ServiceAccount Access to the Analytics.(Add new user with Service-account-ID with Read & Analyze permissions)
