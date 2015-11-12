<div class="customer">
    <div class="table__column table__column_left">
        <ul class="leftside-menu">
            <li class="leftside-menu__item">
                <a href="/customer/">Мои данные</a>
            </li>
            <li class="leftside-menu__item">
                <a href="/history/">Мои заказы</a>
            </li>
            <li class="leftside-menu__item">
                <a href="/cart/">Моя корзина</a>
            </li>
        </ul>
    </div>
    <div class="table__column table__column_right">
        <div class="table__cell account">
            <h1 class="account-header__title">Мои данные</h1>
            <?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
                'id'=>'user_data-form',
                'htmlOptions' => array('class' => 'user-form'),
            )); ?>

                <div class="row">
                    <?php echo $form->textFieldGroup($model, 'surname', array('placeholder'=>'')); ?>
                </div>
                <div class="row">
                    <?php echo $form->textFieldGroup($model, 'name', array('placeholder'=>'')); ?>
                </div>
                <div class="row">
                    <?php echo $form->textFieldGroup($model, 'middlename', array('placeholder'=>'')); ?>
                </div>
                <div class="row">
                    <?php echo $form->textFieldGroup($model, 'phone', array('placeholder'=>'+7')); ?>
                </div>
                <div class="row">
                    <div class="form-group">
                        <?php echo $form->textField($model, 'email', array('disabled'=>"disabled", 'class' => 'form-control')); ?>
                        <?php echo $form->labelEx($model,'email'); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group subscribed">
                        <?php echo $form->checkBox($model,'is_subscribed'); ?>
                        <?php echo $form->labelEx($model,'is_subscribed'); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group few_field">
                        <?php echo $form->labelEx($model,'date_of_birth'); ?>
                        <?php echo $form->dropDownList($model,'date', $model->getDatesArray(), array('class' => 'form-control left_field')); ?>
                        <?php echo $form->dropDownList($model,'month', $model->getMonthsArray(), array('class' => 'form-control middle_field')); ?>
                        <?php echo $form->dropDownList($model,'year', $model->getYearsArray(), array('class' => 'form-control')); ?>
                    </div>
                </div>
                <div class="row sex">
                    <?php echo $form->dropDownListGroup($model, 'sex', array(
                        'widgetOptions' => array(
                            'data' => ['female'=>'Женский', 'male'=>'Мужской'],
                            'htmlOptions' => array('class' => 'form-control'),
                        ))); ?>
                </div>
                <div class="row buttons">
                    <button class="btn btn-default" type="submit" type="button">Сохранить</button>
                </div>
            <?php $this->endWidget(); ?>


            <h2 class="account-header__title">Данные для отправки</h2>
            <?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
                'id'=>'user_address-form',
                'htmlOptions' => array('class' => 'user-form'),
            )); ?>
                <div class="row">
                    <?php echo $form->textFieldGroup($model, 'postcode', array('placeholder'=>'')); ?>
                </div>
                <div class="row">
                    <div class="form-group address">
                        <?php echo $form->labelEx($model,'address'); ?>
                        <?php echo $form->textField($model, 'address', array('placeholder'=>'', 'class' => 'form-control')); ?>
                    </div>
                </div>
                <div class="row buttons">
                    <button class="btn btn-default" type="submit" type="button">Сохранить</button>
                </div>
            <?php $this->endWidget(); ?>

            <h2 class="account-header__title">Сменить пароль</h2>
            <?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
                'id'=>'user_password-form',
                'htmlOptions' => array('class' => 'user-form'),
            )); ?>
            <div class="row">
                <?php echo $form->passwordFieldGroup($modelPass, 'password_old', array('placeholder'=>'')); ?>
            </div>
            <div class="row">
                <?php echo $form->passwordFieldGroup($modelPass, 'password_new', array('placeholder'=>'')); ?>
            </div>
            <div class="row">
                <?php echo $form->passwordFieldGroup($modelPass, 'password2', array('placeholder'=>'')); ?>
            </div>
            <div class="row buttons">
                <button class="btn btn-default" type="submit" type="button">Сохранить</button>
            </div>
            <?php $this->endWidget(); ?>

        </div>
    </div>
</div>



