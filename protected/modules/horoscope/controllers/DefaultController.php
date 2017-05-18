<?php

class DefaultController extends Controller {

    public $signsOfYears = [
        1900 => 'rat',
        1901 => 'ox',
        1902 => 'tiger',
        1903 => 'rabbit',
        1904 => 'dragon',
        1905 => 'snake',
        1906 => 'horse',
        1907 => 'goat',
        1908 => 'monkey',
        1909 => 'rooster',
        1910 => 'dog',
        1911 => 'pig'
    ];
    public $colorsOfYears = [
        1900 => 'white',
        1901 => 'white',
        1902 => 'black',
        1903 => 'black',
        1904 => 'green',
        1905 => 'green',
        1906 => 'red',
        1907 => 'red',
        1908 => 'yellow',
        1909 => 'yellow'
    ];
    public $defaultYear = 1990;

	public function actionIndex() {
        $this->pageTitle='Мой гороскоп от '.Yii::app()->params['domain'];
        if($_GET){
            $year = $_GET['year'];
            $month = $_GET['month'];
            $day = $_GET['day'];
            $sex = $_GET['sex'];

            $signByYear = $this->getSignOfYear($year);
            $signByDate = $this->getSignByDate($month, $day);
            $colorByYear = $this->getColorOfYear($year);

            $description = 'Мой знак по восточному календарю - '. HoroscopeSignByYear::getColorString($colorByYear, $signByYear) . ' ' . HoroscopeSignByYear::getSignString($signByYear) . '. ' .
                'Мой знак зодиака - '. HoroscopeSignByMonth::getSignString($signByDate) . '. ' .
                'Мои цвета - '. HoroscopeColorBySign::getColorsStringBySigns([$signByDate, $signByYear]) . '. ';
            $this->render('index', [
                'year' => $year,
                'month' => $month,
                'day' => $day,
                'sex' => $sex,
                'signByYear' => $signByYear,
                'signByDate' => $signByDate,
                'colorByYear' => $colorByYear,
                'models' => HoroscopeModelByColor::getModelsByColors(HoroscopeColorBySign::getColorsArrayBySigns([$signByDate, $signByYear])),
                'horoscopeByYear' => HoroscopeSignByYear::model()->findByAttributes(['sign'=>$signByYear]),
                'horoscopeByMonth' => HoroscopeSignByMonth::model()->findByAttributes(['sign'=>$signByDate]),
                'horoscopeByYearAndMonth' => HoroscopeYearAndMonth::model()->findByAttributes(['sign_by_year'=>$signByYear, 'sign_by_month'=>$signByDate]),
                'description' => $description,
            ]);
        } else {
            $this->render('index', ['year' => $this->defaultYear]);
        }
	}

    public function getSignOfYear($yearVar){
        foreach ($this->signsOfYears as $year => $color){
            if (($yearVar-$year)%12 == 0)
                return $color;
        }
    }

	public function getColorOfYear($yearVar){
	    foreach ($this->colorsOfYears as $year => $color){
	        if (($yearVar-$year)%10 == 0)
	            return $color;
        }
	}

    public function getSignByDate($month, $day){
        $sign = "";
        if (( $month == 3 && $day >= 21 ) || ( $month == 4 && $day <= 19 )) {
            $sign = "aries";
        } elseif (( $month == 4 && $day >= 20 ) || ( $month == 5 && $day <= 20 )) {
            $sign = "taurus";
        } elseif (( $month == 5 && $day >= 21 ) || ( $month == 6 && $day <= 20 )) {
            $sign = "gemini";
        } elseif (( $month == 6 && $day >= 21 ) || ( $month == 7 && $day <= 22 )) {
            $sign = "cancer";
        } elseif (( $month == 7 && $day >= 23 ) || ( $month == 8 && $day <= 22 )) {
            $sign = "leo";
        } elseif (( $month == 8 && $day >= 23 ) || ( $month == 9 && $day <= 22 )) {
            $sign = "virgo";
        } elseif (( $month == 9 && $day >= 23 ) || ( $month == 10 && $day <= 22 )) {
            $sign = "libra";
        } elseif (( $month == 10 && $day >= 23 ) || ( $month == 11 && $day <= 21 )) {
            $sign = "scorpio";
        } elseif (( $month == 11 && $day >= 22 ) || ( $month == 12 && $day <= 21 )) {
            $sign = "sagittarius";
        } elseif (( $month == 12 && $day >= 22 ) || ( $month == 1 && $day <= 19 )) {
            $sign = "capricorn";
        } elseif (( $month == 1 && $day >= 20 ) || ( $month == 2 && $day <= 18 )) {
            $sign = "aquarius";
        } elseif (( $month == 2 && $day >= 19 ) || ( $month == 3 && $day <= 20 )) {
            $sign = "pisces";
        }
        return $sign;
    }

}