<?php
ob_start();
$rarity_images = array(
    "Common" => "data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAxMjAgMTIwIiBoZWlnaHQ9IjEyMCIgd2lkdGg9IjEyMCI+CiAgPGRlZnM+CiAgICA8Y2xpcFBhdGggaWQ9ImEiPgogICAgICA8cGF0aCBkPSJNMCA5MGg5MFYwSDB6Ii8+CiAgICA8L2NsaXBQYXRoPgogIDwvZGVmcz4KICA8ZyBjbGlwLXBhdGg9InVybCgjYSkiIHRyYW5zZm9ybT0ibWF0cml4KDEuMzMzMzMgMCAwIC0xLjMzMzMzIDAgMTIwKSIgZmlsbD0iIzVhNTE0NSI+CiAgICA8cGF0aCBkPSJNMTMuNSA0NWMwIDguNjk2IDMuMDc2IDE2LjExNCA5LjIxNiAyMi4yNzIgNi4xNCA2LjE1NyAxMy41NTggOS4yMjggMjIuMjU2IDkuMjI4IDguNjc5IDAgMTYuMTE1LTMuMDcxIDIyLjI3Mi05LjIyOEM3My40MDEgNjEuMTE0IDc2LjUgNTMuNjk2IDc2LjUgNDVjMC04LjY5Ni0zLjA5OS0xNi4xMTUtOS4yNTYtMjIuMjcxLTYuMTU3LTYuMTU4LTEzLjU5My05LjIyOS0yMi4yNzItOS4yMjktOC42OTggMC0xNi4xMTYgMy4wNzEtMjIuMjU2IDkuMjI5QzE2LjU3NiAyOC44ODUgMTMuNSAzNi4zMDQgMTMuNSA0NSIvPgogIDwvZz4KPC9zdmc+Cg==",
    "Uncommon" => "data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAxMjAgMTIwIiBoZWlnaHQ9IjEyMCIgd2lkdGg9IjEyMCI+CiAgPHBhdGggZD0iTTEyIDYwLjAzTDU5Ljk3IDEyIDEwOCA2MC4wMyA1OS45NyAxMDh6IiBmaWxsPSIjNWE1MTQ1Ii8+Cjwvc3ZnPgo=",
    "Rare" => "data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAxMjAgMTIwIiBoZWlnaHQ9IjEyMCIgd2lkdGg9IjEyMCI+CiAgPHBhdGggZD0iTTkuNTYyIDQ0LjExbDM3LjAyMS0yLjc2TDYwLjAwMSA3LjQ0NmwxMy40MTYgMzMuOTAyIDM3LjAyIDIuNzYyLTI4LjczNCAyMi43NzYgOS41MDggMzYuNTYtMzEuMjEtMjAuNzk0LTMxLjIxMSAyMC43OTQgOS40NDUtMzYuNTZ6IiBmaWxsPSIjNWE1MTQ1Ii8+Cjwvc3ZnPgo=",
    "FIXED" => "data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAxMjAgMTIwIiBoZWlnaHQ9IjEyMCIgd2lkdGg9IjEyMCI+CiAgPGRlZnM+CiAgICA8Y2xpcFBhdGggaWQ9ImEiPgogICAgICA8cGF0aCBkPSJNMCA5MGg5MFYwSDB6Ii8+CiAgICA8L2NsaXBQYXRoPgogIDwvZGVmcz4KICA8ZyBjbGlwLXBhdGg9InVybCgjYSkiIHRyYW5zZm9ybT0ibWF0cml4KDEuMzMzMzMgMCAwIC0xLjMzMzMzIDAgMTIwKSIgZmlsbD0iIzVhNTE0NSI+CiAgICA8cGF0aCBkPSJNNTIuNDU5IDM3LjU0MmMtMi4wNi0yLjA2LTQuNTUxLTMuMDgzLTcuNDY3LTMuMDgzLTIuOTE2IDAtNS40MDUgMS4wMzQtNy40NiAzLjA5LTIuMDYgMi4wNTktMy4wODkgNC41NDQtMy4wODUgNy40NTUuMDA0IDIuOTEzIDEuMDMyIDUuMzk4IDMuMDkyIDcuNDU4IDIuMDU5IDIuMDU5IDQuNTQ1IDMuMDg4IDcuNDU3IDMuMDkyIDIuOTEyLjAwNCA1LjM5Ny0xLjAyNiA3LjQ1Ni0zLjA4NiAyLjA1NS0yLjA1NSAzLjA4OS00LjU0NCAzLjA4OS03LjQ2IDAtMi45MTYtMS4wMjMtNS40MDYtMy4wODItNy40NjZtMjcuNjc2IDguODgzbC0uNzM5LjI3OWMtMTkuNTM0IDcuMzcyLTI1Ljc4IDEzLjY2OS0zMi45NjMgMzMuMjk0bC0uMDAxLjAwMmMtLjQ4OCAxLjMzMy0yLjM3MiAxLjMzMy0yLjg2IDAtNy4xODItMTkuNjIxLTEzLjQyMS0yNS45MTEtMzIuOTQ3LTMzLjI4OGwtLjc2LS4yODdjLTEuMzEzLS40OTYtMS4zMTMtMi4zNTMgMC0yLjg1bC43Ni0uMjg3QzMwLjE1MSAzNS45MTEgMzYuMzg5IDI5LjYyMSA0My41NzEgMTB2LS4wMDFjLjQ4OC0xLjMzMiAyLjM3Mi0xLjMzMiAyLjg2MSAwdi4wMDNjNy4xODMgMTkuNjI1IDEzLjQzIDI1LjkyMyAzMi45NjQgMzMuMjk1bC43MzkuMjc5YzEuMzEzLjQ5NiAxLjMxMyAyLjM1NCAwIDIuODQ5Ii8+CiAgPC9nPgo8L3N2Zz4K",
);
$house_images = array(
    "Sanctum" => "https://cdn.keyforgegame.com/media/houses/Sanctum_lUWPG7x.png",
    "Shadows" => "https://cdn.keyforgegame.com/media/houses/Shadows_z0n69GG.png",
    "Untamed" => "https://cdn.keyforgegame.com/media/houses/Untamed_bXh9SJD.png",
    "Logos" => "https://cdn.keyforgegame.com/media/houses/Logos_2mOY1dH.png",
    "Brobnar" => "https://cdn.keyforgegame.com/media/houses/Brobnar_RTivg44.png",
    "Mars" => "https://cdn.keyforgegame.com/media/houses/Mars_CmAUCXI.png",
    "Dis" => "https://cdn.keyforgegame.com/media/houses/Dis_OooSNPO.png",
);
$maverick_image = "<img width='20' src='data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAxMjAgMTIwIiBoZWlnaHQ9IjEyMCIgd2lkdGg9IjEyMCI+CiAgPGRlZnM+CiAgICA8Y2xpcFBhdGggaWQ9ImEiPgogICAgICA8cGF0aCBkPSJNMCA5MGg5MFYwSDB6Ii8+CiAgICA8L2NsaXBQYXRoPgogIDwvZGVmcz4KICA8ZyBjbGlwLXBhdGg9InVybCgjYSkiIHRyYW5zZm9ybT0ibWF0cml4KDEuMzMzMzMgMCAwIC0xLjMzMzMzIDAgMTIwKSIgZmlsbD0iIzVhNTE0NSI+CiAgICA8cGF0aCBkPSJNNTUuOTYyIDU5LjYwNmMwLTYuMDg0LTQuOTMzLTExLjAxNi0xMS4wMTctMTEuMDE2cy0xMS4wMTYgNC45MzItMTEuMDE2IDExLjAxNiA0LjkzMiAxMS4wMTcgMTEuMDE2IDExLjAxNyAxMS4wMTctNC45MzMgMTEuMDE3LTExLjAxNyIvPgogICAgPHBhdGggZD0iTTYxLjAzNCA2My45MTFhMTYuNjIgMTYuNjIgMCAwIDAgLjU4My00LjMwNWMwLTcuNzg4LTUuMzc1LTE0LjMyNy0xMi42MDUtMTYuMTQ5bC00LjA3LTEwLjY5NUw0MC43OSA0My40OGMtNy4xODUgMS44NTQtMTIuNTE3IDguMzcxLTEyLjUxNyAxNi4xMjcgMCAxLjQ5LjIxNSAyLjkyNS41ODIgNC4zLTE2LjQ1My40NS0yMi41OCA2LjU0OC0yMi41OCA2LjU0OGwzOC42MTEtNjAuOTggMzguNzAzIDYwLjk4cy02LjIwOS02LjA4OS0yMi41NTUtNi41NDMiLz4KICA8L2c+Cjwvc3ZnPgo='/>";
?>
<style>
.jsm_keyforge_card_tooltip{
    font-size:0.9em
}
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

	<h2><?= $deck["name"]?></h2>
<table>
<tr>
<?php
foreach($deck["cards"] as $house => $cards){
  $houseImageSrc = $house_images[$house];
?>
	<th><img src="<?= $houseImageSrc?>"/><br><?= $house?></th>
<?php
}
for($x = 0; $x < 12; $x++){
?>
<tr>
<?php
	foreach($deck["cards"] as $house => $cards){
		$card = $cards[$x];
    $cardImageSrc = $card['front_image'];
?>
<td class="jsm_keyforge_card_tooltip">
<span class="jsm_keyforge_card_tooltip_img"><img src="<?= $cardImageSrc ?>"/></span>
<img width="20" src="<?= $rarity_images[$card['rarity']] ?>"/> <b><?= $card['card_number'];?></b> <?= $card['card_title'];?><?= $card['is_maverick'] ? $maverick_image : ""?>
</td>
<?php
	}
?>
</tr>
<?php
}

?>
</table>
<?php
$ret = ob_get_clean();
?>
