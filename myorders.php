<?php

include __DIR__."/header.php";

if(!us_level){
	fh_go(path);
	exit;
}

?>
<div class="de-breadcrumb-p">
	<div class="container">
		<h3><?=$lang['myorders']['title']?></h3>
		<p><?=$lang['myorders']['desc']?></p>
	</div>
</div>

<div class="container">

	<div class="de-cart-body">
		<?php
		$sql = $db->query("SELECT * FROM ".prefix."orders WHERE author = '".us_id."' ORDER BY id DESC LIMIT {$startpoint} , {$limit}");
		if($sql->num_rows):
		while($rs = $sql->fetch_assoc()):
			$cart = json_decode($rs['order_cart'], true);
			$rsi  = db_rs("items WHERE id = '{$cart['item_id']}'");

			$item_size = isset($cart['item_size']) ? db_unserialize([$rsi['sizes'], $cart['item_size']]) : '';
		?>
		<div class="de-cart-body">
			<div class="media">
				<div class="media-left"><div class="de-thumb"><img src="<?=path?>/<?=$rsi['image']?>" alt="<?=$rsi['name']?>" onerror="this.src='<?=noimage?>'"></div></div>
				<div class="media-body">
					<div class="de-dtable">
						<div class="de-vmiddle">
							<div class="de-title"><h3><a href="#"><?=$rsi['name']?><?php if($item_size): ?><strong class="de-color"> (<?=$item_size['name']?>)</strong><?php endif; ?></a></h3></div>
							<div class="de-extra">
								<strong><i class="fas fa-money-bill-wave"></i> <?=$cart['item_quantities']?> x <a><?=dollar_sign.($item_size ? $item_size['price'] : $rsi['selling_price'])?></a></strong>
								<strong> - <i class="far fa-clock"></i> <?=fh_ago($rs['created_at'])?></strong>
								<a href="<?=path?>/restaurants.php?id=<?=$rs['restaurant']?>"><strong> - <i class="fas fa-store"></i> <?=db_get("restaurants", "name", $rs['restaurant'])?></strong></a>
							</div>
							<div class="de-extra"><small><?=str_replace("+", " ", $cart['item_note'])?></small></div>
							<div class="de-extra">
								<?php
								if($cart['item_extra']):
								foreach($cart['item_extra'] as $k => $extra):
									$extra = db_unserialize([$rsi['extra'], $extra]);
								?>
									<span><?=$extra['name']?> <b class="de-extraprice"><?=dollar_sign.$extra['price']?></b></span>
								<?php
								endforeach;
								endif;
								?>
							</div>
							<div class="de-options">
								<?php if($rs['status']!=2): ?>
									<a href="#" class="de-delivered tips" data-id="<?=$rs['id']?>"><i class="fas fa-check"></i><b><?=$lang['myorders']['make_it_delivered']?></b></a>
								<?php endif; ?>
								<?php if($rs['status']==2): ?>
								<a data-toggle="modal" href="#myModal" class="de-additemreview tips" data-id="<?=$rsi['id']?>"><i class="fas fa-star"></i> <b><?=$lang['myorders']['add_your_review']?></b></a>
								<a class="de-delivered"><i class="fas fa-check"></i> <?=$lang['myorders']['delivered']?></a>
								<?php elseif($rs['status']==1): ?>
									<a class="de-delivered wdth bg-v"><i class="fas fa-truck"></i> <?=$lang['myorders']['intheway']?></a>
								<?php else: ?>
								<a class="de-awaiting"><i class="fas fa-clock"></i> <?=$lang['myorders']['awaiting']?></a>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php endwhile; ?>
		<?php echo fh_pagination("orders WHERE author = '".us_id."'",$limit, path."/myorders.php?") ?>
		<?php include __DIR__."/partials/newreview.php"; ?>
		<?php else: ?>
			<div class="text-center"><?=$lang['alerts']['no-data']?></div>
		<?php endif; ?>
	</div>

</div>

<?php
include __DIR__."/footer.php";
