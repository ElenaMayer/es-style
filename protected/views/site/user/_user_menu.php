<div class="table__column table__column_left">
    <ul class="leftside-menu">
        <li class="leftside-menu__item">
            <?php if(Yii::app()->controller->action->id == 'customer') :?>
                <h2 class="title__line--4-2"><strong>Мои данные</strong></h2>
            <?php else: ?>
                <h2 class="title__line--4-2"><a href="/customer/">Мои данные</a></h2>
            <?php endif ?>
        </li>
        <li class="leftside-menu__item">
            <?php if(Yii::app()->controller->action->id == 'history') :?>
                <h2 class="title__line--4-2"><strong>Мои заказы</strong></h2>
            <?php elseif(Yii::app()->controller->action->id == 'historyItem') :?>
                <h2 class="title__line--4-2"><a href="/history/"><strong>Мои заказы</strong></a></h2>
            <?php else: ?>
                <h2 class="title__line--4-2"><a href="/history/">Мои заказы</a></h2>
            <?php endif ?>
        </li>
        <li class="leftside-menu__item">
            <h2 class="title__line--4-2"><a href="/cart/">Моя корзина</a></h2>
        </li>
    </ul>
</div>