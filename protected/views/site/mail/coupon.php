<table align="left" width="100%" border="0" cellpadding="0" cellspacing="0">
<tbody>
<tr>
    <td align="center" style="padding:0 70px;text-align: center;">
        <font color="#CB2228" size="5" style="font-size: 23px;line-height: 1.2;" face="Arial, Helvetica, sans-serif">
                <b>Скидка <?= $model->sale ?><?php if($model->type == 'percent') :?>%<?php else :?> рублей<?php endif; ?> в подарок!</b>
        </font>
        <br>
        <br>
    </td>
</tr>
<tr>
    <td align="center" style="padding:0 30px;text-align: center;">
        <font color="#CB2228" size="5" style="font-size: 20px;line-height: 1.2;" face="Arial, Helvetica, sans-serif">
            <b>Ваш купон на скидку: <font color="black"><?= $model->coupon ?></font></b>
        </font>
        <br>
        <br>
    </td>
</tr>
<tr bgcolor="#ffffff">
    <td>
        <table align="center" width="100%" border="0" cellpadding="0" cellspacing="0">
            <tbody>
            <tr>
                <td style="padding:15px 30px;">
                    <font size="5" style="font-size: 16px;line-height: 1.2;" face="Arial, Helvetica, sans-serif">
                        &#10004 Чтобы воспользоваться скидкой, введите номер купона на нашем сайте в специальное поле в карзине или при оформлении заказа.
                    </font>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="padding:15px 30px;6">
                    <font size="5" style="font-size: 16px;line-height: 1.2;" face="Arial, Helvetica, sans-serif">
                        &#10004 Купон действителен на <?php if(!$model->category) :?>весь ассортимент<?php else :?>все <?= Yii::app()->params['categories'][$model->category];?><?php endif; ?> интернет-магазина<?php if($model->type == 'percent') :?>, включая товары со скидкой<?php endif; ?>.
                    </font>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="padding:15px 30px;6">
                    <font size="5" style="font-size: 16px;line-height: 1.2;" face="Arial, Helvetica, sans-serif">
                        &#10004 Купон действителен до <b><?= $this->dateFormat($model->until_date) ?></b>.
                    </font>
                    <br>
                </td>
            </tr>
            <?php if(!$model->is_reusable) :?>
                <tr>
                    <td style="padding:15px 30px;6">
                        <font size="5" style="font-size: 16px;line-height: 1.2;" face="Arial, Helvetica, sans-serif">
                            &#10004 Купон действителен на один заказ.
                        </font>
                        <br>
                    </td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </td>
</tr>
</tbody>
</table>