<table align="left" width="100%" border="0" cellpadding="0" cellspacing="0">
<tbody>
<tr>
    <td align="center" style="padding:0 70px;text-align: center;">
        <font color="#CB2228" size="5" style="font-size: 23px;line-height: 1.2;" face="Arial, Helvetica, sans-serif">
                <b>Скидка <?= $coupon->sale ?><?php if($coupon->type == 'percent') :?>%<?php else :?> рублей<?php endif; ?> в подарок!</b>
        </font>
        <br>
        <br>
    </td>
</tr>
<tr>
    <td style="padding:0 30px;">
        <font color="#CB2228" size="5" style="font-size: 20px;line-height: 1.2;" face="Arial, Helvetica, sans-serif">
            <b>Ваш купон на скидку: <font color="black"><?= $coupon->coupon ?></font></b>
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
                        &#10004 Купон действителен на <?php if(!$coupon->category) :?>весь ассортимент<?php else :?>все <?= Yii::app()->params['categories'][$coupon->category];?><?php endif; ?> интернет-магазина<?php if($coupon->type == 'percent') :?>, за исключением товаров со скидкой<?php endif; ?>.
                    </font>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="padding:15px 30px;6">
                    <font size="5" style="font-size: 16px;line-height: 1.2;" face="Arial, Helvetica, sans-serif">
                        &#10004 Купон действителен до <b><?= $this->dateFormat($coupon->until_date) ?></b>.
                    </font>
                    <br>
                </td>
            </tr>
            <?php if(!$coupon->is_reusable) :?>
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