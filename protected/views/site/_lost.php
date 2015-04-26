<div id="lost_form" style="display: none;">
    <form class="form lost-form">
        <div class="h2">Восстановление пароля</div>
        <div class="popup__error hidden"></div>
        <div class="popup__info">Пожалуйста, введите Ваш адрес электронной почты, на который мы можем выслать Ваш новый пароль.</div>
        <dl class="form__widget" data-form-widget="email">
            <dt class="form__widget-label">Эл. почта</dt>
            <dd class="form__widget-content">
                <input type="email" name="email" class="text-field" value="" data-form-control="email" maxlength="50">
                <div class="form__error" data-form-error="email"></div>
                <div class="form__hint" style="display:none;"></div>
            </dd>
        </dl>
        <div class="form__controls">
            <button type="submit" class="button button_blue">
                <span class="button__title">Восстановить</span>
            </button>
            <span class="lost-form__login link">Вспомнил</span>
        </div>
    </form>
</div>