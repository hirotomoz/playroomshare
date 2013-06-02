<?php $this->setLayoutVar('title', 'MYRESERVE') ?>

<h2>予約システム　私の予約</h2>
<div id="myreserve">
    <div id="mytop">
        <?php echo $this->escape($user['user_name']); ?>様
        <div class="contentsblock">
            <h3>メニュー</h3>
            <a href='/free/reserve/customer/reserveadd'>予約する</a>
            <a href='/free/reserve/customer/reservemod'>予約を変更する</a>
            <a href='/free/reserve/customer/myprofile'>プロフィールを変更する</a>
        </div>
    </div>
    <div id="mynews">
        <div class="contentsblock">
            <h3>お知らせ</h3>
        </div>
    </div>
    <div id="mystatus">
        <div class="contentsblock">
            <h3>予約状況</h3>
        </div>
    </div>
</div>