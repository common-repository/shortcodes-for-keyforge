<?php
ob_start();
?>
<style>
.keyforgecard { color: #440044; text-decoration: underline;}
.jsm_keyforge_card_tooltip:hover .jsm_keyforge_card_tooltip_img{
display: inline;
display:inline; position:absolute;

}
.jsm_keyforge_card_tooltip_img{
    display: none;
 z-index:10;display:none; padding:14px 20px;
    margin-top:0px; margin-left:100px;
    width:250px; line-height:16px; -webkit-filter: drop-shadow(10px 10px 10px #222); filter: drop-shadow(10px 10px 10px #222);}
</style>
<span class="jsm_keyforge_card_tooltip">
  <span class="jsm_keyforge_card_tooltip_img"><img src="<?= $card['img_url']?>"/></span>
  <span class="keyforgecard"><?= $card['name']?></span>
</span>
<?php
$ret = ob_get_clean();
?>
