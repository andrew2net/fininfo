<?php

class SiteController extends Controller {

  /**
   * Declares class-based actions.
   */
  public function actions() {
    return array(
      // captcha action renders the CAPTCHA image displayed on the contact page
      'captcha' => array(
        'class' => 'CCaptchaAction',
        'backColor' => 0xFFFFFF,
      ),
        // page action renders "static" pages stored under 'protected/views/site/pages'
        // They can be accessed via: index.php?r=site/page&view=FileName
//      'page' => array(
//        'class' => 'CViewAction',
//      ),
    );
  }

  /**
   * This is the default 'index' action that is invoked
   * when an action is not explicitly requested by users.
   */
  public function actionIndex() {
    $model = Page::model()->findByAttributes(array('url' => '/'));

    $this->render('index', array('model' => $model));
  }

  /**
   * This is the action to handle external exceptions.
   */
  public function actionError() {
    if ($error = Yii::app()->errorHandler->error) {
      if (Yii::app()->request->isAjaxRequest)
        echo $error['message'];
      else
        $this->render('error', $error);
    }
  }

  /**
   * Displays the contact page
   */
//  public function actionContact() {
//    $model = new ContactForm;
//    if (isset($_POST['ContactForm'])) {
//      $model->attributes = $_POST['ContactForm'];
//      if ($model->validate()) {
//        $name = '=?UTF-8?B?' . base64_encode($model->name) . '?=';
//        $subject = '=?UTF-8?B?' . base64_encode($model->subject) . '?=';
//        $headers = "From: $name <{$model->email}>\r\n" .
//            "Reply-To: {$model->email}\r\n" .
//            "MIME-Version: 1.0\r\n" .
//            "Content-Type: text/plain; charset=UTF-8";
//
//        mail(Yii::app()->params['adminEmail'], $subject, $model->body, $headers);
//        Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
//        $this->refresh();
//      }
//    }
//    $this->render('contact', array('model' => $model));
//  }

  /**
   * Displays the login page
   */
  public function actionLogin() {
    $model = new LoginForm;

    // if it is ajax validation request
    if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
      echo CActiveForm::validate($model);
      Yii::app()->end();
    }

    // collect user input data
    if (isset($_POST['LoginForm'])) {
      $model->attributes = $_POST['LoginForm'];
      // validate user input and redirect to the previous page if valid
      if ($model->validate() && $model->login())
        $this->redirect('/private');
    }
    // display the login form
    $this->render('login', array('model' => $model));
  }

  /**
   * Logs out the current user and redirect to homepage.
   */
  public function actionLogout() {
    Yii::app()->user->logout();
    $this->redirect(Yii::app()->homeUrl);
  }

  public function actionPage() {
    if (isset($_GET['url']))
      $url = $_GET['url'];
    else
      throw new CHttpException(404, "Страница не найдена");

    $model = Page::model()->findByAttributes(array('url' => $url));
    if (!$model)
      throw new CHttpException(404, "Страница {$url} не найдена");
    $this->setPageTitle(Yii::app()->name . ' - ' . $model->title);
    $this->render('page', array(
      'model' => $model,
        )
    );
  }

  public function actionGetChartsData() {
    $charts = Chart::model()->findAllByAttributes(array('active' => true));
    /* @var $chart Chart */
    $chartsData = array();
    foreach ($charts as $chart) {
      $data = self::getChartData($chart->subscription_type_id, $chart->start, $chart->end);
      $chartsData[] = array(
        'title' => $chart->subscriptionType->portid . " " . $chart->subscriptionType->symid . ', ' .$chart->subscriptionType->description,
        'data' => json_encode($data, JSON_NUMERIC_CHECK),
      );
    }
    echo json_encode($chartsData);

    Yii::app()->end();
  }

  public function actionNews($id) {
    $model = News::model()->findByPk($id);
    $this->render('news', array('model' => $model));
  }

  public function actionChart() {
    $this->render('chart');
  }

  public function actionGetChartData($type) {
    $data = self::getChartData($type);

    /* @var $subscriptionType SubscriptionType */
    $subscriptionType = SubscriptionType::model()->findByPk($type);

    $responce = array(
      'description' => $subscriptionType->description,
      'data' => json_encode($data, JSON_NUMERIC_CHECK),
    );
    echo json_encode($responce);
    Yii::app()->end();
  }

  private static function getChartData($type_id, $start = null, $end = null) {
    $tradeData = TradeData::model()->findAll(array(
      'select' => 'date, profit',
      'order' => 'date',
      'condition' => '(date>=:start OR :start IS NULL) AND (date<=:end OR :end IS NULL) AND subscription_type_id=:sbid',
      'params' => array(':start' => $start, ':end' => $end, ':sbid' => $type_id),
    ));
    /* @var $tradeData TradeData[] */

    $data = array(
      'cols' => array(
        array('type' => 'date', 'label' => 'Date'),
        array('type' => 'number', 'label' => 'Profit')
      ),
      'rows' => array()
    );

    foreach ($tradeData as $value) {
      $date = date_parse($value->date);
      $year = $date["year"];
      $month = $date['month'] - 1;
      $day = $date['day'];
      $profit = $value->profit;
      $data['rows'][] = array('c' => array(
          array('v' => "Date($year, $month, $day)"),
          array('v' => $profit)
      ));
    }
    return $data;
  }

}
