<table align="left" width="100%" border="0" cellpadding="0" cellspacing="0">
    <tbody>
    <tr>
        <td align="center" style="padding:0 70px;text-align: center;">
            <font color="#CB2228" size="5" style="font-size: 23px;line-height: 1.2;" face="Arial, Helvetica, sans-serif">
                <b>Только сегодня! Скидка <?= $params['sale'] ?><?php if($params['saleType'] == 'percent') :?>%<?php else :?> рублей<?php endif; ?> на платье <?= $model->title ?>!</b>
            </font>
            <br>
            <br>
        </td>
    </tr>
    <tr>
        <td align="center" style="padding:0 70px;text-align: center;">
            <font color="#CB2228" size="5" style="font-size: 23px;line-height: 1.2;" face="Arial, Helvetica, sans-serif">
                Старая цена <b><?= $model->old_price ?> руб.</b> - Новая цена <b><?= $model->price?>) руб.</b> ?>!
            </font>
            <br>
            <br>
        </td>
    </tr>
    <tr>
        <td align="center">
            <font size="3" style="font-size: 16px;" color="#1868a0" face="Arial, Helvetica, sans-serif">
                <a href="http://<?= Yii::app()->params['domain'] ?>/<?= $model->category ?>/<?= $model->article ?>" target="_blank" style="text-decoration: none;">
                    <font size="3" style="font-size: 16px;color: #CB2228; display: block; text-align: center; width: 225px;" color="#1868a0" face="Arial, Helvetica, sans-serif"><?= $model->title ?> арт. <?= $model->article ?></font>
                    <img src="http://<?= $model->getFullPreviewUrl(); ?>" style="width: 225px; height: 300px;">
                </a>
            </font>
        </td>
    </tr>
    </tbody>
</table>