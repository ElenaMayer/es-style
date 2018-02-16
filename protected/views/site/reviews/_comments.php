<!-- Start Comment Area -->
<div class="htc__comment__area">
    <h4 class="title__line--5">Всего отзывов: <?= $pagination->itemCount ?></h4>
    <div class="ht__comment__content">
        <?php if (!empty($reviews)): ?>
            <?php foreach($reviews as $key => $review): ?>
                <!-- Start Single Comment -->
                <div class="comment">
                    <div class="ht__comment__details">
                        <div class="ht__comment__title">
                            <h2><?= $review->name ?><?php if ($review->city): ?> (<?= $review->city ?>)<?php endif; ?></h2>
                        </div>
                        <span><?= $this->dateFormatWithTime($review->date_create) ?></span>
                        <?php if($review->rating):?>
                            <div class="rating">
                                <i class="review_rating_icon"></i>
                                <i class="review_rating_icon <?php if($review->rating < 2 ):?>disabled<?php endif; ?>"></i>
                                <i class="review_rating_icon <?php if($review->rating < 3 ):?>disabled<?php endif; ?>"></i>
                                <i class="review_rating_icon <?php if($review->rating < 4 ):?>disabled<?php endif; ?>"></i>
                                <i class="review_rating_icon <?php if($review->rating < 5 ):?>disabled<?php endif; ?>"></i>
                            </div>
                        <?php endif; ?>
                        <p><?= $review->comment ?></p>
                        <div class="comment__thumb">
                            <?php if ($review->img): ?>
                                <img src="<?= $review->getImageUrl(); ?>" alt="<?= $review->name ?>">
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <!-- End Single Comment -->
                <?php if ($review->answer): ?>
                    <!-- Start Single Comment -->
                    <div class="comment comment--reply">
                        <div class="ht__comment__details">
                            <div class="ht__comment__title">
                                <h2>Елена Администратор</h2>
                            </div>
                            <span><?= $this->dateFormatWithTime($review->answer->date_create) ?></span>
                            <p><?= $review->answer->comment ?></p>
                        </div>
                    </div>
                    <!-- End Single Comment -->
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
<!-- End Comment Area -->