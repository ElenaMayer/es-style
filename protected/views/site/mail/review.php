<table align="left" width="100%" border="0" cellpadding="0" cellspacing="0">
<tbody>
<tr>
    <td align="center" style="padding:0 70px;text-align: center;">
        <font color="#CB2228" size="5" style="font-size: 23px;line-height: 1.2;" face="Arial, Helvetica, sans-serif">
            <b>Новый отзыв<?php if ($comment->user_id && !empty($comment->user->orders)):?> по заказу<?php endif;?></b>
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
                                    <b>Имя</b>
                                </font>
                            </td>
                            <td style="text-align: right;">
                                <font size="3" style="font-size: 16px;" color="#333333" face="Arial, Helvetica, sans-serif">
                                    <?= $comment->name ?>
                                </font>
                            </td>
                        </tr>
                        <tr valign="top" align="left" style="height: 25px;">
                            <td width="100">
                                <font size="3" style="font-size: 16px;" color="#333333" face="Arial, Helvetica, sans-serif">
                                    <b>Email</b>
                                </font>
                            </td>
                            <td style="text-align: right;">
                                <font size="3" style="font-size: 16px;" color="#333333" face="Arial, Helvetica, sans-serif">
                                    <?= $comment->email ?>
                                </font>
                            </td>
                        </tr>
                        <?php if ($comment->city):?>
                            <tr valign="top" align="left" style="height: 25px;">
                                <td width="100">
                                    <font size="3" style="font-size: 16px;" color="#333333" face="Arial, Helvetica, sans-serif">
                                        <b>Город</b>
                                    </font>
                                </td>
                                <td style="text-align: right;">
                                    <font size="3" style="font-size: 16px;" color="#333333" face="Arial, Helvetica, sans-serif">
                                        <?= $comment->city ?>
                                    </font>
                                </td>
                            </tr>
                        <?php endif;?>
                        <?php if ($comment->rating):?>
                            <tr valign="top" align="left" style="height: 25px;">
                                <td width="100">
                                    <font size="3" style="font-size: 16px;" color="#333333" face="Arial, Helvetica, sans-serif">
                                        <b>Рейтинг</b>
                                    </font>
                                </td>
                                <td style="text-align: right;">
                                    <font size="3" style="font-size: 16px;" color="#333333" face="Arial, Helvetica, sans-serif">
                                        <?= $comment->rating ?>
                                    </font>
                                </td>
                            </tr>
                        <?php endif;?>
                        <tr valign="top" align="left" style="height: 25px;">
                            <td width="100">
                                <font size="3" style="font-size: 16px;" color="#333333" face="Arial, Helvetica, sans-serif">
                                    <b>Комментарий</b>
                                </font>
                            </td>
                            <td style="text-align: right;">
                                <font size="3" style="font-size: 16px;" color="#333333" face="Arial, Helvetica, sans-serif">
                                    <?= $comment->comment ?>
                                </font>
                            </td>
                        </tr>
                        <tr>
                            <td height="10" colspan="2"></td>
                        </tr>
                        <?php if ($comment->img):?>
                            <tr valign="top" align="left" style="height: 25px;">
                                <td width="100">
                                    <font size="3" style="font-size: 16px;" color="#333333" face="Arial, Helvetica, sans-serif">
                                        <b>Фото</b>
                                    </font>
                                </td>
                                <td style="text-align: right;">
                                    <font size="3" style="font-size: 16px;" color="#333333" face="Arial, Helvetica, sans-serif">
                                        <img src="http://<?php echo Yii::app()->params['domain']; ?>/data/comment/<?= $comment->img ?>" border="0" style="border:none;text-decoration:none;line-height:0;vertical-align:top;display:block;padding:0px;margin:0px;" hspace="0" vspace="0">
                                    </font>
                                </td>
                            </tr>
                        <?php endif;?>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr valign="top" align="left" style="height: 25px;">
                <td width="100">
                    <font size="3" style="font-size: 16px;" color="#333333" face="Arial, Helvetica, sans-serif">
                        <b><a href="http://<?= Yii::app()->params['domain'] ?>/admin/fromMail?action=rejectReview&review_id=<?php $comment->id?>&hash=<?= Yii::app()->userForMail->hash ?>" target="_blank">
                            <font size="3" style="font-size: 16px;color: #CB2228;" color="#1868a0" face="Arial, Helvetica, sans-serif">Отклонить отзыв</font>
                        </a></b>
                    </font>
                </td>
                <td width="100">
                    <font size="3" style="font-size: 16px;" color="#333333" face="Arial, Helvetica, sans-serif">
                        <b><a href="http://<?= Yii::app()->params['domain'] ?>/admin/fromMail?action=sendCouponMail&review_id=<?php $comment->id?>&hash=<?= Yii::app()->userForMail->hash ?>" target="_blank">
                            <font size="3" style="font-size: 16px;color: #CB2228;" color="#1868a0" face="Arial, Helvetica, sans-serif">Отправить купон</font>
                        </a></b>
                    </font>
                </td>
            </tr>
            </tbody>
        </table>
        <?php if ($comment->user_id && !empty($comment->user->orders)):?>
            <table align="center" width="100%" border="0" cellpadding="0" cellspacing="0">
                <tbody>
                    <?php foreach ($comment->user->orders as $order):?>
                        <tr valign="top" align="left" style="height: 25px;">
                            <td style="width: 100%;">
                                <font size="3" style="font-size: 16px;" color="#333333" face="Arial, Helvetica, sans-serif">
                                    <b>Заказ от <?= $order->addressee ?> (<?= $order->date_create ?>)</b>
                                </font>
                            </td>
                        </tr>
                        <tr valign="top" align="left" style="height: 25px;">
                            <td>
                                <?php foreach($order->cartItems as $cartItem) :?>
                                    <font size="3" style="font-size: 16px;" color="#1868a0" face="Arial, Helvetica, sans-serif">
                                        <a href="http://<?= Yii::app()->params['domain'] ?>/<?= $cartItem->photo->category ?>/<?= $cartItem->photo->article ?>" target="_blank">
                                            <font size="3" style="font-size: 16px;color: #CB2228;" color="#1868a0" face="Arial, Helvetica, sans-serif"><?= $cartItem->photo->title ?> арт. <?= $cartItem->photo->article ?></font>
                                        </a> <?= $cartItem->size ?>р. <?= $cartItem->count ?> шт. <?= $cartItem->new_price > 0 ? $cartItem->new_price*$cartItem->count : $cartItem->price*$cartItem->count ?>&nbsp;руб.
                                    </font>
                                    </br></br>
                                <?php endforeach; ?>
                                </font>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td height="10" colspan="2"></td>
                    </tr>
                </tbody>
            </table>
        <?php endif;?>
    </td>
</tr>
</tbody>
</table>