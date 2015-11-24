<div class="table__column table__column_left">
    <ul class="leftside-menu">
        <li class="leftside-menu__item">
            <?php if(Yii::app()->controller->action->id == 'customer') :?>
                <strong>Мои данные</strong>
            <?php else: ?>
                <a href="/customer/">Мои данные</a>
            <?php endif ?>
        </li>
        <li class="leftside-menu__item">
            <?php if(Yii::app()->controller->action->id == 'history') :?>
                <strong>Мои заказы</strong>
            <?php elseif(Yii::app()->controller->action->id == 'historyItem') :?>
                <a href="/history/"><strong>Мои заказы</strong></a>
            <?php else: ?>
                <a href="/history/">Мои заказы</a>
            <?php endif ?>
        </li>
        <li class="leftside-menu__item">
            <a href="/cart/">Моя корзина</a>
        </li>
    </ul>
</div>