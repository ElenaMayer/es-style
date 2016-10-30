<table align="left" width="100%" border="0" cellpadding="0" cellspacing="0">
<tbody>
<tr>
    <td align="center" style="padding:0 70px;text-align: center;">
        <font color="#CB2228" size="5" style="font-size: 23px;line-height: 1.2;" face="Arial, Helvetica, sans-serif">
                <b>Скидка <?php $coupon->sale ?>% в подарок!</b>
        </font>
        <br>
        <br>
    </td>
</tr>
<tr>
    <td style="padding:15px 30px;">
        <font size="5" style="font-size: 16px;line-height: 1.2;" face="Arial, Helvetica, sans-serif">
            Спасибо за отзыв, нам очень важно Ваше мнение!
        </font>
        <br>
    </td>
</tr>
<tr>
    <td align="center" style="padding:0 70px;text-align: center;">
        <font color="#CB2228" size="5" style="font-size: 23px;line-height: 1.2;" face="Arial, Helvetica, sans-serif">
            <b>Ваш купон на скидку: <?php $coupon->coupon ?></b>
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
                        &#10003 Чтобы воспользоваться скидкой, введите номер купона на нашем сайте в специальное поле в карзине или при оформлении заказа.
                    </font>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="padding:15px 30px;6">
                    <font size="5" style="font-size: 16px;line-height: 1.2;" face="Arial, Helvetica, sans-serif">
                        &#10003 Купон действителен на весь ассортимент интернет-магазина, за исключением товаров со скидкой.
                    </font>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="padding:15px 30px;6">
                    <font size="5" style="font-size: 16px;line-height: 1.2;" face="Arial, Helvetica, sans-serif">
                        &#10004 Купон действителен до <?php $this->dateFormat($coupon->until_date) ?>.
                    </font>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="padding:15px 30px;6">
                    <font size="5" style="font-size: 16px;line-height: 1.2;" face="Arial, Helvetica, sans-serif">
                        &#10004 Купон действителен на один заказ.
                    </font>
                    <br>
                </td>
            </tr>
            </tbody>
        </table>
    </td>
</tr>
</tbody>
</table>