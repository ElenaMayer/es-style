<!-- Start Bradcaump area -->
<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(/data/images/bg/history.jpg) no-repeat scroll center center / cover ;">
    <div class="ht__bradcaump__wrap">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="bradcaump__inner">
                        <nav class="bradcaump-inner">
                            <a class="breadcrumb-item" href="/">Главная</a>
                            <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                            <span class="breadcrumb-item active">Мои заказы</span>
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
                        <h2 class="title__line--3">Мои заказы</h2>
                    </div>
                    <div class="col-xs-12">
                        <?php if(!empty($history)) :?>
                            <div class="wishlist-table table-responsive">
                                <table>
                                    <thead>
                                    <tr>
                                        <th class="product-thumbnail">Заказ</th>
                                        <th class="product-remove"><span class="nobr">Дата</span></th>
                                        <th class="product-name"><span class="nobr">Адресат</span></th>
                                        <th class="product-price"><span class="nobr"> Сумма заказа </span></th>
                                        <th class="product-stock-stauts"><span class="nobr"> Статус </span></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($history as $order) :?>
                                    <tr>
                                        <td class="product-thumbnail"><a href="/history/<?= $order->id ?>" class="orders__cell-link"><?= $order->id ?></a></td>
                                        <td class="product-thumbnail"><?= date("d.m.Y", strtotime($order->date_create)); ?></td>
                                        <td class="product-name"><?= $order->user->name ?> <?= $order->user->surname ?></td>
                                        <td class="product-price"><span class="amount"><?= $order->total ?>₽</span></td>
                                        <td class="product-stock-status"><span class="wishlist-in-stock"><?=Yii::app()->params['orderStatuses'][$order->status]?></span></td>
                                    </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else :?>
                            <div class="order_empty"><h3>У Вас пока нет заказов</h3></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Contact Area -->
