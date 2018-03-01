<!-- Start Bradcaump area -->
<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(/data/images/bg/customer.jpg) no-repeat scroll center center / cover ;">
    <div class="ht__bradcaump__wrap">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="bradcaump__inner">
                        <nav class="bradcaump-inner">
                            <a class="breadcrumb-item" href="/">Главная</a>
                            <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                            <span class="breadcrumb-item active">Мои данные</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Bradcaump area -->
<!-- Start Contact Area -->
<section class="htc__contact__area ptb--70 bg__white lc">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 col-sm-12 col-xs-12">
                <?php $this->renderPartial('user/_user_menu'); ?>
            </div>
            <div class="col-md-9 col-sm-12 col-xs-12">
                <div class="contact-form-wrap">
                    <div class="col-xs-12">
                        <?php if(Yii::app()->user->is_wholesaler): ?>
                            <h2 class="title__line--6 red">Оптовый аккаунт</h2>
                            <h2 class="title__line--3">Данные заказчика</h2>
                        <?php else: ?>
                            <h2 class="title__line--3">Мои данные</h2>
                        <?php endif;?>
                    </div>
                    <div class="col-xs-12">
                        <div id="customer_person_data">
                            <?php $this->renderPartial('user/_customer_person_data', array('model'=>$model)); ?>
                        </div>
                        <div id="customer_shipping_data">
                            <?php $this->renderPartial('user/_customer_shipping_data', array('model'=>$model)); ?>
                        </div>
                        <div id="customer_password_data">
                            <?php $this->renderPartial('user/_customer_password_data', array('model'=>$model)); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Contact Area -->

<script>
    $( "body" ).on("click", "#submit-button", function() {
        form_id = "#" + $(this).parents('form').attr('id');
        $.ajax({
            url: "",
            data: $( "form" + form_id ).serialize(),
            type: "POST",
            dataType: "html",
            success: function (data) {
                if (data) {
                    $( "div" + form_id ).html(data);
                }
            }
        });
    });
</script>

