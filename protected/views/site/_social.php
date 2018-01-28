<?php
$url = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$image = 'http://'.$_SERVER['HTTP_HOST'].$model->getOriginalUrl();
?>
<li>
    <a href="https://vk.com/share.php?url=<?=$url?>&title=<?=$model->title?>&image=<?= $image ?>" target="_blank">
        <i class="zmdi zmdi-vk"></i>
    </a>
</li>
<li>
    <a href="https://twitter.com/intent/tweet?text=<?=$model->title?>&url=<?=$url?>" target="_blank">
        <i class="zmdi zmdi-twitter"></i>
    </a>
</li>
<li>
    <a href="https://www.facebook.com/sharer.php?src=sp&u=<?=$url?>&title=<?=$model->title?>&picture=<?= $image ?>" target="_blank">
        <i class="zmdi zmdi-facebook"></i>
    </a>
</li>
<li><a href="https://connect.ok.ru/offer?url=<?=$url?>&title=<?=$model->title?>&imageUrl=<?= $image ?>" target="_blank">
        <i class="zmdi zmdi-odnoklassniki"></i>
    </a>
</li>
<li>
    <a href="whatsapp://send?text=<?=$url?>&nbsp;<?=$model->title?>" target="_blank">
        <i class="zmdi zmdi-whatsapp"></i>
    </a>
</li>