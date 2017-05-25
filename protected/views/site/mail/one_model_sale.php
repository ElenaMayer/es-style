<table align="left" width="100%" border="0" cellpadding="0" cellspacing="0">
    <tbody>
    <tr>
        <td align="center" style="padding:0 70px;text-align: center;">
            <font color="#CB2228" size="5" style="font-size: 23px;line-height: 1.2;" face="Arial, Helvetica, sans-serif">
                Только сегодня! Скидка <?= $params['sale'] ?><?php if($params['saleType'] == 'percent') :?>%<?php else :?> рублей<?php endif; ?> на <br> <b><?= $model->title ?></b>!
            </font>
            <br>
            <br>
        </td>
    </tr>
    <tr>
        <td align="center">
            <font size="3" style="font-size: 16px;" color="#1868a0" face="Arial, Helvetica, sans-serif">
                <a href="http://<?= Yii::app()->params['domain'] ?>/<?= $model->category ?>/<?= $model->article ?>" target="_blank" style="text-decoration: none;">
                    <img src="http://<?= $model->getFullImageUrl(); ?>" style="width: 360px; height: 480px;">
                </a>
            </font>
        </td>
    </tr>

    <tr>
        <td align="center" style="padding:0 70px;text-align: center;">
            <font size="5" style="font-size: 23px;line-height: 1.2;" face="Arial, Helvetica, sans-serif">
                <br>
                Старая цена <s><?= $model->old_price ?> руб.</s>
                <br><br>
                Новая цена <b style="font-size: 30px;color: #cb2228;"><?= $model->price?> руб.</b><br>
            </font>
        </td>
    </tr>
    <tr>
        <td align="center" style="padding:0 70px;text-align: center;">
            <br>
            <br>
            <a href="http://<?= Yii::app()->params['domain'] ?>/<?= $model->category ?>/<?= $model->article ?>" target="_blank" style="text-decoration: none;">
                <font color="#CB2228" size="5" style="font-size: 23px;line-height: 1.2;" face="Arial, Helvetica, sans-serif">Заказать сейчас!</font>
            </a>
            <br>
            <br>
        </td>
    </tr>
    </tbody>
</table>