<table align="left" width="100%" border="0" cellpadding="0" cellspacing="0">
<tbody>
<tr>
    <td align="center" style="padding:0 70px;text-align: center;">
        <font color="#CB2228" size="5" style="font-size: 23px;line-height: 1.2;" face="Arial, Helvetica, sans-serif">
                <b>Наши новинки!</b>
        </font>
        <br>
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
                        <?php foreach($photos as $key=>$photo) :?>
                            <?php if(($key+1)%2 == 1):?><tr valign="top" align="right" style="line-height: 2;"><?php endif; ?>
                                <td align="left">
                                    <font size="3" style="font-size: 16px;" color="#1868a0" face="Arial, Helvetica, sans-serif">
                                        <a href="http://<?= Yii::app()->params['domain'] ?>/<?= $photo->category ?>/<?= $photo->article ?>" target="_blank" style="text-decoration: none;">
                                            <font size="3" style="font-size: 16px;color: #CB2228; display: block; text-align: center; width: 225px;" color="#1868a0" face="Arial, Helvetica, sans-serif"><?= $photo->title ?> арт. <?= $photo->article ?></font>
                                            <img src="http://<?= $photo->getFullPreviewUrl(); ?>" style="width: 225px; height: 300px;">
                                        </a>
                                    </font>
                                </td>
                            <?php if(($key+1)%2 == 2):?></tr>
                            <tr>
                                <td height="10" colspan="3"></td>
                            </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </td>
            </tr>
            </tbody>
        </table>
    </td>
</tr>
<tr>
    <td align="center" style="padding:20px 30px;text-align: center;">
        <font size="5" style="font-size: 19px;line-height: 1.2;" face="Arial, Helvetica, sans-serif">
            ... и многое другое! Все новинки можно посмотреть на нашем сайте <b><a href="http://<?= Yii::app()->params['domain'] ?>" target="_blank" style="text-decoration: none;"><font size="3" style="font-size: 23px;color: #CB2228; text-align: center; width: 225px;" color="#1868a0" face="Arial, Helvetica, sans-serif"><?= Yii::app()->params['domain'] ?></font></a></b>
        </font>
        <br>
    </td>
</tr>
</tbody>
</table>