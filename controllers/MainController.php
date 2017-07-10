<?php

namespace app\controllers;

use app\models\News;
use app\models\Themes;
use yii\data\Pagination;
use yii\web\Controller;

class MainController extends Controller
{
    public function actionIndex($attr = null, $value = null)
    {
        $news = News::find()->all();
        $themes = Themes::find()->all();
        $newsYears = $this->createArrayOfMonths($news);
        $selectedNews = null;
        $pages = null;
        if ($attr == 'year' || $attr == 'month') {
            if ($attr == 'year') {
                $startDate = $value . '-01-01';
                $finishDate = $value + 1;
                $finishDate = $finishDate . '-01-01';
            } elseif ($attr == 'month') {
                $daysInMonth = date('t', strtotime($value));
                $startDate = substr_replace($value, '01', 8, 2);
                $finishDate = substr_replace($value, $daysInMonth, 8, 2);
            }
            $query = News::find()
                ->where(['>=', 'date', $startDate])
                ->andWhere(['<=', 'date', $finishDate]);
        }
        if ($attr == 'theme') {
            $query = News::find()
                ->where(['theme_id' => $value]);
        }
        if (isset($query)) {
            $countQuery = clone $query;
            $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 5]);
            $selectedNews = $query->offset($pages->offset)
                ->limit($pages->limit)
                ->all();
        }
        return $this->render('index', [
            'newsYears' => $newsYears,
            'themes' => $themes,
            'selectedNews' => $selectedNews,
            'pages' => $pages]);
    }

    private function createArrayOfMonths($array)
    {
        $arrayOfYears = $this->createArrayofYears($array);
        foreach ($arrayOfYears as $key => $value) {
            $start = $key . '-01-01';
            $finish = $key . '-12-31';
            $temperArray = $this->cutPeriod($array, $start, $finish);
            $arrayOfMonths = [];
            foreach ($temperArray as $item) {
                $arrayOfMonths[] = $this->translateMonth(date('M', strtotime($item->date)));
            }
            $arrayOfMonths = array_unique($arrayOfMonths);
            $arrayOfMonths = array_flip($arrayOfMonths);
            foreach ($arrayOfMonths as $keys => $values) {
                $arrayOfMonths[$keys] = array();
                foreach ($temperArray as $item) {
                    if ($keys == $this->translateMonth(date('M', strtotime($item->date)))) {
                        $arrayOfMonths[$keys][] = $item;
                    }
                }
            }
            $arrayOfYears[$key] = $arrayOfMonths;
        }
        return $arrayOfYears;
    }

    private function createArrayOfYears($array)
    {
        $arrayOfYears = [];
        foreach ($array as $value) {
            $arrayOfYears[] = date('Y', strtotime($value->date));
        }
        $arrayOfYears = array_unique($arrayOfYears);
        $arrayOfYears = array_flip($arrayOfYears);
        foreach ($arrayOfYears as $key => $value) {
            $arrayOfYears[$key] = [];
        }
        return $arrayOfYears;
    }

    private function cutPeriod($array, $startDate, $finishDate)
    {
        $cutArray = [];
        $startDate = strtotime($startDate);
        $finishDate = strtotime($finishDate);
        foreach ($array as $value) {
            if ((strtotime($value->date) >= $startDate) &&
                (strtotime($value->date) <= $finishDate)
            ) {
                $cutArray[] = $value;
            }
        }
        return $cutArray;
    }

    private function translateMonth($month)
    {
        $russMonth = '';
        switch ($month) {
            case 'Jan':
                $russMonth = 'Январь';
                break;
            case 'Feb':
                $russMonth = 'Февраль';
                break;
            case 'Mar':
                $russMonth = 'Март';
                break;
            case 'Apr':
                $russMonth = 'Апрель';
                break;
            case 'May':
                $russMonth = 'Май';
                break;
            case 'Jun':
                $russMonth = 'Июнь';
                break;
            case 'Jul':
                $russMonth = 'Июль';
                break;
            case 'Aug':
                $russMonth = 'Август';
                break;
            case 'Sep':
                $russMonth = 'Сентябрь';
                break;
            case 'Oct':
                $russMonth = 'Октябрь';
                break;
            case 'Nov':
                $russMonth = 'Ноябрь';
                break;
            case 'Dec':
                $russMonth = 'Декабрь';
                break;
        }
        return $russMonth;
    }
}