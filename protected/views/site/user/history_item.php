<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(/data/images/bg/history.jpg) no-repeat scroll center center / cover ;">
    <div class="ht__bradcaump__wrap">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="bradcaump__inner">
                        <nav class="bradcaump-inner">
                            <a class="breadcrumb-item" href="/">Главная</a><span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                            <a href="/history" class="breadcrumb-item">Мои заказы</a>
                            <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                            <span class="breadcrumb-item active">Заказ № <?= $order->id ?></span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Bradcaump area -->
<div class="cart-main-area ptb--120 bg__white lc">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="table-content table-responsive">
                    <table>
                        <thead>
                        <tr>
                            <th class="product-thumbnail">Товар</th>
                            <th class="product-name">Название</th>
                            <th class="product-size">Размер</th>
                            <th class="product-price">Цена</th>
                            <th class="product-quantity">Количество</th>
                            <th class="product-subtotal">Сумма</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($order->cartItems as $cartItem) :?>
                            <?php $this->renderPartial('user/_history_item_base', array('cartItem'=>$cartItem)); ?>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12 smt-40 xmt-40 history_item_total">
                        <div class="htc__cart__total">
                            <h6>Итого</h6>
                            <div class="cart__desk__list">
                                <ul class="cart__desc">
                                    <li>Подитог</li>
                                    <?php if($order->sale > 0) :?><li>Скидка</li><?php endif; ?>
                                    <?php if($order->coupon_id) :?><li>Купон</li><?php endif; ?>
                                    <li>Доставка</li>
                                </ul>
                                <ul class="cart__price">
                                    <li><?= $order->subtotal ?>₽</li>
                                    <?php if($order->sale > 0) :?><li>- <?= $order->sale ?>₽</li><?php endif; ?>
                                    <?php if($order->coupon_id) :?><li>- <?= $order->coupon_sale ? $order->coupon_sale : 0 ?>₽</li><?php endif; ?>
                                    <li><?= $order->shipping ?>₽</li>
                                </ul>
                            </div>
                            <div class="cart__total">
                                <span>Итого</span>
                                <span><?= $order->total ?>₽</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>