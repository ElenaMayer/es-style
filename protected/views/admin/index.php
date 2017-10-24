<?php

$this->pageTitle=Yii::app()->name;
?>

<h1>Добро пожаловать в <i>админку!</i></h1>

<p>Инструкция для чайников:</p>
<ul>
	<li>Загрузка фоток находится в разделе <code>Галерея</code></li>
    <li>Новости добавлять в разделе <code>Новости</code></li>
    <li>Заказы смотреть в разделе <code>Заказы</code></li>
    <li>Прайсы загружать в разделе <code>Прайсы</code></li>
	<li>Чтоб добавить фото, нажать кнопку <code>Добавить</code></li>
    <li>Чтоб сохранить фото, нажать кнопку <code>Сохранить</code></li>
    <li>Чтоб отредактировать фото, нажать на <code>Зеленый карандашик</code></li>
    <li>Чтоб удалить фото, нажать на <code>Красный крестик</code>, но лучше этого не делать, вместо этого:</li>
    <li>Чтоб удалить фото с сайта, нажать на <code>Голубую иконку с надписью Show</code></li>
</ul>

<p>Рассылки из консоли:</p>
<ul>
    <li>Новиночная рассылка <code>php yiic mail newPhotos</code></li>
    <li>Рассылка "Отзыв за купон" <code>php yiic mail reviewForCouponMail --test=0 --count=all</code></li>
    <li>Купон на скидку 200 рублей <code>php yiic mail saleMail --sendToOrderedUser=0</code></li>
    <li>Скидка на одну модель <code>php yiic mail oneModelSaleMail --article=11010 --sale=20 --saleType=percent --sendToOrderedUser=0</code></li>
    <li>Новостная рассылка <code>php yiic mail NewsMail --news_id=1 --sendToOrderedUser=0</code></li>
</ul>