<table width="590" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#ffffff">
    <tbody>
        <tr>
            <td style="border:none;padding:0px 5px;margin:0px;">
                <span style="text-align:left;font-size: 13px;color: #000000;line-height:16px;font-family: Arial, Tahoma, sans-serif;">
                    <center><span style="text-transform: capitalize;"><b>Здравствуйте, <?= $user->getTitleName(); ?>!</b></span></center>
                    <br><br>
                </span>
            </td>
        </tr>
    </tbody>
</table>
<table width="590" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#ffffff">
    <tbody>
        <tr>
            <td style="padding:0px 0 0 0px">
                <table width="11%" border="0" cellpadding="0" cellspacing="0" align="left">
                    <tbody><tr>
                        <td style="width:65px;border:none;padding:0px;margin:0px;line-height:13px;font-size:12px;color:#000000;" width="65">&nbsp;</td>
                    </tr>
                    </tbody>
                </table>
                <table width="75%" border="0" cellpadding="0" cellspacing="0" align="left">
                    <tbody>
                        <tr>
                            <td style="width:525px;border:none;padding:0 0 20px 0;margin:0px;line-height:20px;font-size:12px;color:#000000;background-color:#ffffff;font-family: Arial, Tahoma, sans-serif;" bgcolor="#ffffff" width="525">
                                Спасибо, что выбрали <a target="_blank" href="http://<?php echo Yii::app()->params['domain']; ?>"><?php echo Yii::app()->params['domain']; ?></a>!<br>
                                Скопируйте новый пароль в соответствующее окно.<br>
                                При повторном входе на сайт рекомендуем Вам сменить пароль.<br>
                                Пожалуйста, используйте следующие данные для входа в Личный кабинет:
                                <br><br>
                                ПАРОЛЬ: <b><?= $user->password_new ?></b>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table width="14%" border="0" cellpadding="0" cellspacing="0" align="left">
                    <tbody>
                        <tr>
                            <td style="width:81px;border:none;padding:0px;margin:0px;line-height:13px;font-size:12px;color:#000000;" width="81">&nbsp;</td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>