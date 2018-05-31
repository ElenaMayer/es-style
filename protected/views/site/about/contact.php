<!-- Start Bradcaump area -->
<div class="ht__bradcaump__area bradcaump--2">
    <div class="google__map">
        <div class="map-contacts">
            <div id="googleMap2"></div>
        </div>
    </div>
    <div class="ht__bradcaump__wrap">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="bradcaump__inner">
                        <nav class="bradcaump-inner">
                            <a class="breadcrumb-item" href="/">Главная</a>
                            <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                            <span class="breadcrumb-item active">Контакты</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Bradcaump area -->
<!-- Start Contact Area -->
<section class="htc__contact__area ptb--70 bg__white">
    <div class="container-fluid">
        <div class="row">
            <!-- Start Single Address -->
            <div class="col-md-4 col-lg-4 col-sm-6 col-xs-12">
                <div class="address">
                    <div class="address__icon">
                        <i class="icon-location-pin icons"></i>
                    </div>
                    <div class="address__details">
                        <h2 class="ct__title">Точка розничной продажи</h2>
                        <p>Новосибирск, Мичурина 12 - Ряд №6 Место №184</p>
                    </div>
                </div>
            </div>
            <!-- End Single Address -->
            <!-- Start Single Address -->
            <div class="col-md-4 col-lg-4 col-sm-6 col-xs-12 xmt-40">
                <div class="address--2">
                    <p><a href="#"><i class="icon-call-end icons"></i><?= Yii::app()->params['phone'] ?></a></p>
                    <p><a href="#"><i class="icon-envelope icons"></i><?= Yii::app()->params['email'] ?></a></p>
                </div>
            </div>
            <!-- End Single Address -->
            <!-- Start Single Address -->
            <div class="col-md-4 col-lg-4 col-sm-6 col-xs-12 smt-40 xmt-40">
                <div class="address">
                    <div class="address__icon">
                        <i class="icon-clock icons"></i>
                    </div>
                    <div class="address__details">
                        <h2 class="ct__title">Часы работы</h2>
                        <p>10:00 - 18:00 Без выходных</p>
                    </div>
                </div>
            </div>
            <!-- End Single Address -->
        </div>
    </div>
</section>
<!-- End Contact Area -->

<!-- Google Map js -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDBzF-LWrGJIo9GgIu9QVisHPWAvWwlo_8"></script>
<script src="/js/contact-map.js?1"></script>