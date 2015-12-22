<table align="left" width="100%" border="0" cellpadding="0" cellspacing="0">
<tbody>
<tr>
    <td align="center" style="padding:0 70px;">
        <font color="#CB2228" size="5" style="font-size: 23px;line-height: 1.2;" face="Arial, Helvetica, sans-serif">
            <b>Заказ №<?= $order->id ?> создан.</b>
        </font>
        <br>
    </td>
</tr>
<tr>
    <td>
        <table align="center" width="100%" border="0" cellpadding="0" cellspacing="0">
            <tbody>
            <tr>
                <td colspan="5" height="30"></td>
            </tr>
            <tr valign="top">
                <td>
                    <table align="center" width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tbody>
                        <tr valign="top" align="left" style="height: 25px;">
                            <td width="100">
                                <font size="3" style="font-size: 16px;" color="#333333" face="Arial, Helvetica, sans-serif">
                                    <b>Получатель</b>
                                </font>
                            </td>
                            <td style="text-align: right;">
                                <font size="3" style="font-size: 16px;" color="#333333" face="Arial, Helvetica, sans-serif">
                                    <?= $order->addressee ?>
                                </font>
                            </td>
                        </tr>
                        <tr>
                            <td height="10" colspan="2"></td>
                        </tr>
                        <tr valign="top" align="left" style="height: 25px;">
                            <td width="100">
                                <font size="3" style="font-size: 16px;" color="#333333" face="Arial, Helvetica, sans-serif">
                                    <b>Телефон</b>
                                </font>
                            </td>
                            <td style="text-align: right;">
                                <font size="3" style="font-size: 16px;" color="#333333" face="Arial, Helvetica, sans-serif">
                                    <?= $order->phone ?>
                                </font>
                            </td>
                        </tr>
                        <tr>
                            <td height="10" colspan="2"></td>
                        </tr>
                        <tr valign="top" align="left" style="height: 25px;">
                            <td>
                                <font size="3" style="font-size: 16px;" color="#333333" face="Arial, Helvetica, sans-serif">
                                    <b>Оплата</b>
                                </font>
                            </td>
                            <td style="text-align: right;">
                                <font size="3" style="font-size: 16px;" color="#333333" face="Arial, Helvetica, sans-serif">
                                    <?= Yii::app()->params['paymentMethod'][$order->payment_method];?><br>
                                </font>
                            </td>
                        </tr>
                        <tr>
                            <td height="10" colspan="2"></td>
                        </tr>
                        <tr valign="top" align="left" style="height: 25px;">
                            <td>
                                <font size="3" style="font-size: 16px;" color="#333333" face="Arial, Helvetica, sans-serif">
                                    <b>Доставка</b>
                                </font>
                            </td>
                            <td style="text-align: right;">
                                <font size="3" style="font-size: 16px;line-height: 1.3;" color="#333333" face="Arial, Helvetica, sans-serif">
                                    <?= Yii::app()->params['shippingMethod'][$order->shipping_method];?> (<?= $order->shipping ?>&nbsp;р.)<br>
                                    <?= $order->address;?>
                                </font>
                            </td>
                        </tr>
                        <tr>
                            <td height="10" colspan="2"></td>
                        </tr>
                        <tr valign="top" align="left" style="height: 25px;">
                            <td>
                                <font size="3" style="font-size: 16px;" color="#333333" face="Arial, Helvetica, sans-serif">
                                    <b>К оплате</b>
                                </font>
                            </td>
                            <td style="text-align: right;">
                                <font size="3" style="font-size: 16px;" color="#333333" face="Arial, Helvetica, sans-serif">
                                    <?= $order->total ?>&nbsp;р.<br>
                                </font>
                            </td>
                        </tr>
                        <tr>
                            <td height="10" colspan="2"></td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            </tbody>
        </table>
    </td>
</tr>
<tr bgcolor="#ffffff">
    <td>
        <table align="center" width="100%" border="0" cellpadding="0" cellspacing="0">
            <tbody>
            <tr>
                <td colspan="5" height="30"></td>
            </tr>
            <tr valign="top">
                <td width="600">
                    <table align="center" width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tbody>
                        <tr valign="top" align="right">
                            <td width="315" align="left">
                                <font size="2" style="font-size: 16px;" color="#333333" face="Arial, Helvetica, sans-serif"><b>Заказ</b></font>
                            </td>
                            <td width="70">
                                <font size="2" color="#333333" face="Arial, Helvetica, sans-serif" style="font-size: 16px;"><b>Размер</b></font>
                            </td>
                            <td width="70">
                                <font size="2" color="#333333" face="Arial, Helvetica, sans-serif" style="font-size: 16px;"><b>Кол-во</b></font>
                            </td>
                            <td width="105">
                                <font size="2" color="#333333" face="Arial, Helvetica, sans-serif" style="font-size: 16px;"><b>Со скидкой</b></font>
                            </td>
                        </tr>
                        <?php foreach($order->cartItems as $cartItem) :?>
                            <tr>
                                <td height="10" colspan="3"></td>
                            </tr>
                            <tr valign="top" align="right" style="line-height: 2;">
                                <td align="left">
                                    <font size="3" style="font-size: 16px;" color="#1868a0" face="Arial, Helvetica, sans-serif">
                                        <a href="http://<?= Yii::app()->params['domain'] ?>/<?= $cartItem->photo->category ?>/<?= $cartItem->photo->article ?>" target="_blank">
                                            <font size="3" style="font-size: 16px;color: #CB2228;" color="#1868a0" face="Arial, Helvetica, sans-serif"><?= $cartItem->photo->title ?> арт. <?= $cartItem->photo->article ?></font>
                                        </a>
                                    </font>
                                </td>
                                <td style="text-align: center;">
                                    <font size="3" style="font-size: 16px;" color="#333333" face="Arial, Helvetica, sans-serif"><?= $cartItem->size ?></font>
                                </td>
                                <td style="text-align: center;">
                                    <font size="3" style="font-size: 16px;" color="#333333" face="Arial, Helvetica, sans-serif"><?= $cartItem->count ?></font>
                                </td>
                                <td style="text-align: center;">
                                    <font size="3" style="font-size: 16px;" color="#333333" face="Arial, Helvetica, sans-serif">
                                        <?= $cartItem->new_price > 0 ? $cartItem->new_price*$cartItem->count : $cartItem->price*$cartItem->count ?>&nbsp;р.
                                    </font>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                        <tr valign="top" align="right" style="line-height: 2;">
                            <td align="left">
                                <font size="3" style="font-size: 16px;" color="#333333" face="Arial, Helvetica, sans-serif">
                                    Доставка
                                </font>
                            </td>
                            <td></td>
                            <td></td>
                            <td style="text-align: center;">
                                <font size="3" style="font-size: 16px;" color="#333333" face="Arial, Helvetica, sans-serif">
                                    <?= $order->shipping ?>&nbsp;р.
                                </font>
                            </td>
                        </tr>
                        <tr valign="top" align="right" style="line-height: 2;">
                            <td align="left">
                                <font size="3" style="font-size: 16px;" color="#333333" face="Arial, Helvetica, sans-serif">
                                    Итого
                                </font>
                            </td>
                            <td></td>
                            <td style="text-align: center;">
                                <font size="3" style="font-size: 16px;" color="#333333" face="Arial, Helvetica, sans-serif">
                                    <?= count($order->cartItems) ?>
                                </font>
                            </td>
                            <td style="text-align: center;">
                                <font size="3" style="font-size: 16px;" color="#333333" face="Arial, Helvetica, sans-serif">
                                    <b><?= $order->total ?>&nbsp;р.</b>
                                </font>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            </tbody>
        </table>
    </td>
</tr>
<tr bgcolor="#ffffff">
    <td>
        <table align="center" width="100%" border="0" cellpadding="0" cellspacing="0">
            <tbody>
            <tr>
                <td colspan="5" height="30"></td>
            </tr>
            <tr valign="top">
                <td width="72"></td>
                <td width="594">
                    <table align="center" width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tbody>
                        <tr>
                            <td height="40"></td>
                        </tr>
                        <tr>
                            <td align="left">
                                <font size="3" style="font-size: 16px;" color="#333333" face="Arial, Helvetica, sans-serif"></font>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </td>
                <td width="70"></td>
            </tr>
            <tr>
                <td colspan="5" height="30"></td>
            </tr>
            </tbody>
        </table>
    </td>
</tr>
</tbody>
</table>