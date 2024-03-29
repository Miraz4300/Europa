

<ul class="de-main-stats">
	<li>
		<div class="de-box">
			<span><i class="icon-wallet icons"></i></span>
			<b><?=db_rows("orders")?></b><br /><small>Total Orders</small>
		</div>
	</li>
	<li>
		<div class="de-box">
			<span><i class="icon-star icons"></i></span>
			<b><?=db_rows("payments")?></b><br /><small>Total Payments</small>
		</div>
	</li>
	<li>
		<div class="de-box">
			<span><i class="fas fa-store"></i></span>
			<b><?=db_rows("restaurants")?></b><br /><small>Total Restaurants</small>
		</div>
	</li>
	<li>
		<div class="de-box">
			<span><i class="fas fa-pizza-slice"></i></span>
			<b><?=db_rows("items")?></b><br /><small>Total Items</small>
		</div>
	</li>
</ul>

<ul class="de-main-stats">
	<li class="thr">
		<div class="de-box">
			<span><i class="fas fa-comments-dollar"></i></span>
			<b><?=fh_cp_amount("orders", "payment_amount", " GROUP BY transaction_id")?></b><br /><small>Orders amount</small>
		</div>
	</li>
	<li class="thr">
		<div class="de-box">
			<span><i class="fas fa-file-invoice-dollar"></i></span>
			<b><?=fh_cp_amount("payments", "price")?></b><br /><small>Payments amount</small>
		</div>
	</li>
	<li class="thr">
		<div class="de-box">
			<span><i class="fas fa-search-dollar"></i></span>
			<b><?=fh_cp_amount("taxes", "taxes")?></b><br /><small>Taxes amount</small>
		</div>
	</li>
</ul>

<div class="row">
	<div class="col-8">
		<div class="de-order-chart de-box">
			<h3>
				Orders Statistics
				<span class="ptcporders" rel="days">Days</span>
				<span class="ptcporders" rel="months">Months</span>
			</h3>
			<div class="p-4 pl-5 pr-5"><canvas id="orders-cporders"></canvas></div>

		</div>
	</div>
	<div class="col-4">
		<div class="de-order-chart de-box">
			<h3>Orders by gender</h3>
			<div class="p-4"><canvas id="orders-cpgender"></canvas></div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-3">
		<div class="de-order-chart de-box">
			<h3>24h Payments</h3>
			<div class="de-content">
				<ul>
					<?php
					$sql = $db->query("SELECT * FROM ".prefix."payments WHERE date >= '".(time() - 3600*24)."' ORDER BY id DESC") or die ($db->error);
					if($sql->num_rows):
					while($rs = $sql->fetch_assoc()):
					?>
					<li>
						<div class="media">
							<div class="media-left">
								<div class="de-thumb"><img src="<?=db_get("users", "photo", $rs['author'])?>" onerror="this.src='<?=nophoto?>'" /></div>
							</div>
							<div class="media-body">
								<?=fh_user($rs['author'])?>
								<p>
									<span><i class="far fa-clock"></i> <?=fh_ago($rs['date'])?></span>
									<span><i class="fas fa-comment-dollar"></i> $<?=$rs['price']?></span>
								</p>
							</div>
						</div>
					</li>
					<?php
					endwhile;
					else:
						echo '<li class="text-center">'.$lang['alerts']['no-data'].'</li>';
					endif;
					$sql->close();
					?>
				</ul>
			</div>
		</div>
	</div>
	<div class="col-3">
		<div class="de-order-chart de-box">
			<h3>24h Orders</h3>
			<div class="de-content de-scroll">
				<ul>
					<?php
					$sql = $db->query("SELECT * FROM ".prefix."orders WHERE created_at >= '".(time() - 3600*24)."' ORDER BY id DESC") or die ($db->error);
					if($sql->num_rows):
					while($rs = $sql->fetch_assoc()):
						$cart = json_decode($rs['order_cart'], true);
						$rsi  = db_rs("items WHERE id = '{$cart['item_id']}'");
						$item_size = isset($cart['item_size']) ? db_unserialize([$rsi['sizes'], $cart['item_size']]) : '';
					?>
					<li>
						<div class="media">
							<div class="media-left">
								<div class="de-thumb"><img src="<?=$rsi['image']?>" onerror="this.src='<?=noimage?>'" /></div>
							</div>
							<div class="media-body">
								<a href="<?=path?>/restaurants.php?id=<?=$rsi['restaurant']?>&t=<?=fh_seoURL(db_get("restaurants", "name", $rsi['restaurant']))?>"><?=$rsi['name']?></a>

								<p>
									<span><i class="far fa-clock"></i> <?=fh_ago($rs['created_at'])?></span>
									<span><i class="fas fa-money-bill-wave"></i> <?=$cart['item_quantities']?> x <?=dollar_sign.($item_size ? $item_size['price'] : $rsi['selling_price'])?></span>
								</p>
							</div>
						</div>
					</li>
					<?php
					endwhile;
					else:
						echo '<li class="text-center">'.$lang['alerts']['no-data'].'</li>';
					endif;
					$sql->close();
					?>
				</ul>
			</div>
		</div>
	</div>
	<div class="col-3">
		<div class="de-order-chart de-box">
			<h3>24h Restaurants</h3>
			<div class="de-content de-scroll">
				<ul>
					<?php
					$sql = $db->query("SELECT * FROM ".prefix."restaurants WHERE created_at >= '".(time() - 3600*24)."' ORDER BY id DESC") or die ($db->error);
					if($sql->num_rows):
					while($rs = $sql->fetch_assoc()):
					?>
					<li>
						<div class="media">
							<div class="media-left">
								<div class="de-thumb"><img src="<?=$rs['photo']?>" onerror="this.src='<?=noimage?>'" /></div>
							</div>
							<div class="media-body">
								<a href="<?=path?>/restaurants.php?id=<?=$rs['id']?>&t=<?=fh_seoURL($rs['name'])?>"><?=$rs['name']?></a>

								<p>
									<span><i class="far fa-clock"></i> <?=fh_ago($rs['created_at'])?></span>
									<span><i class="fas fa-poll"></i> <?=db_rows("items WHERE restaurant = '{$rs['id']}'")?> items</span>
								</p>
							</div>
						</div>
					</li>
					<?php
					endwhile;
					else:
						echo '<li class="text-center">'.$lang['alerts']['no-data'].'</li>';
					endif;
					$sql->close();
					?>
				</ul>
			</div>
		</div>
	</div>
	<div class="col-3">
		<div class="de-order-chart de-box">
			<h3>24h Items</h3>
			<div class="de-content de-scroll">
				<ul>
					<?php
					$sql = $db->query("SELECT * FROM ".prefix."items WHERE created_at >= '".(time() - 3600*24)."' ORDER BY id DESC") or die ($db->error);
					if($sql->num_rows):
					while($rs = $sql->fetch_assoc()):
					?>
					<li>
						<div class="media">
							<div class="media-left">
								<div class="de-thumb"><img src="<?=$rs['image']?>" onerror="this.src='<?=noimage?>'" /></div>
							</div>
							<div class="media-body">
								<a href="<?=path?>/restaurants.php?id=<?=$rs['restaurant']?>&t=<?=fh_seoURL(db_get("restaurants", "name", $rs['restaurant']))?>"><?=$rs['name']?></a>

								<p>
									<span><i class="far fa-clock"></i> <?=fh_ago($rs['created_at'])?></span>
									<span><i class="fas fa-poll"></i> <?=db_rows("orders WHERE item = '{$rs['id']}'")?> items</span>
								</p>
							</div>
						</div>
					</li>
					<?php
					endwhile;
					else:
						echo '<li class="text-center">'.$lang['alerts']['no-data'].'</li>';
					endif;
					$sql->close();
					?>
				</ul>
			</div>
		</div>
	</div>
</div>
