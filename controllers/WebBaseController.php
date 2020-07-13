<?php
/**
 * Created by PhpStorm.
 * User: jun
 * Date: 2019/3/10
 * Time: 下午3:30
 */

namespace app\controllers;


use app\models\Blacklist;
use Yii;
use yii\filters\auth\QueryParamAuth;
use yii\web\Controller;
use yii\web\Response;

class WebBaseController extends Controller {
    public $account;
    public $mobile;
    public $whiteList = ['', 'site/index', 'site/mine','site/login','site/oauth', 'user/login','site/black'];

    /**
     * @return void
     * @throws \Throwable
     */
}
