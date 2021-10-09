<?php

include __DIR__."/header.php";

$rs = db_rs("pages WHERE id = '{$id}'");

?>

<div class="de-breadcrumb-p">
	<div class="container">
		<div class="de-dtable"><div class="de-vmiddle"><h3><?=$rs['title']?></h3></div></div>
	</div>
</div>

<div class="container">
	<div class="de-box"><?=fh_bbcode($rs['content'])?></div>
</div>


<?php
include __DIR__."/footer.php";
