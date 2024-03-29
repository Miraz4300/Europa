<?php

include __DIR__."/head.php";

if(us_level != 6){
	fh_go(path);
	exit;
}

?>

<div id="full-page-container" class="de-dashboard<?=$pg?>">
<div class="de-wrapper">

	<div class="de-nav">
		<div class="de-logo">
			<a href="#"><i class="fas fa-hamburger"></i> <b>Europa</b></a>
		</div>
		<div class="de-menu">
			<ul>
				<li><a href="<?=path?>"><i class="icon-globe icons"></i> <b><?=$lang['header']['home']?></b></a></li>
				<li<?=($pg==""?' class="de-active"':'')?>>
					<a href="<?=path?>/dashboard.php"><i class="icon-speedometer icons"></i> <b><?=$lang['header']['dashboard']?></b></a>
				</li>
				
				<li class="<?=(in_array($pg, ['menu', 'categories', 'cuisines', 'items'])?'de-active ':'')?> de-droped">
					<a href="#"><i class="icon-layers icons"></i> <b><?=$lang['dash']['menu']?></b></a>
					<ul class="de-drop">
						<li><a href="<?=path?>/dashboard.php?pg=restaurants"><i class="icon-notebook icons"></i> <?=$lang['header']['restaurants']?></a></li>
						<li><a href="<?=path?>/dashboard.php?pg=menu"><i class="icon-layers icons"></i> <?=$lang['dash']['all_menus']?></a></li>
						<li><a href="<?=path?>/dashboard.php?pg=cuisines"><i class="fas fa-utensils"></i> <?=$lang['dash']['cuisines']?></a></li>
						<li><a href="<?=path?>/dashboard.php?pg=items"><i class="fas fa-pizza-slice"></i> <?=$lang['dash']['items']?></a></li>
						<li><a href="<?=path?>/dashboard.php?pg=reviews"><i class="icon-star icons"></i> <?=$lang['dash']['reviews']?></a></li>
					</ul>
				</li>
				<li><a href="<?=path?>/dashboard.php?pg=users"><i class="icon-people icons"></i> <b><?=$lang['dash']['users']?></b></a></li>
				<li><a href="<?=path?>/dashboard.php?pg=orders"><i class="icon-wallet icons"></i> <b><?=$lang['dash']['orders']?></b></a></li>
				<li><a href="<?=path?>/dashboard.php?pg=payments"><i class="fas fa-money-bill-wave"></i> <b><?=$lang['dash']['payments']?></b></a></li>
				<li><a href="<?=path?>/dashboard.php?pg=testimonials"><i class="icon-speech icons"></i>
					<?php
					$head_testimonials = db_rows("testimonials WHERE status = 0");
					if($head_testimonials) echo "<small class='bg-r'>".$head_testimonials."</small>";
					?>
					<b><?=$lang['header']['testimonial']?></b></a></li>
				<li><a href="<?=path?>/dashboard.php?pg=pages"><i class="icon-docs icons"></i> <b><?=$lang['dash']['pages']?></b></a></li>
				<li><a href="<?=path?>/dashboard.php?pg=settings"><i class="icon-settings icons"></i> <b><?=$lang['dash']['settings']?></b></a></li>
				<li><a href="<?=path?>/dashboard.php?pg=withdraw"><i class="fas fa-hand-holding-usd"></i> <b><?=$lang['dash']['withdraw']?></b></a></li>
			</ul>
		</div>
	</div>
	<div class="de-dash">
		<div class="de-topmenu">
			<div class="de-search">
				<div class="de-input">
					<input type="text" name="search" placeholder="<?=$lang['header']['search']?>">
					<i class="icons icon-magnifier"></i>
					<div class="sresults"></div>
				</div>
			</div>
			<div class="de-menu">
				<ul>
					<li class="de-msg">
						<a href="<?=path?>/dashboard.php?pg=withdraw">
						<i class="fas fa-hand-holding-usd"></i>
						<?php
						$head_withdraw = db_rows("withdraws WHERE status = 0");
						if($head_withdraw) echo "<b>".$head_withdraw."</b>";
						?>
					</a>
					</li>
					<li class="de-img">
						<div class="de-thumb"><img src="<?=path?>/<?=us_photo?>" onerror="this.src='<?=nophoto?>'"></div>
					</li>
					<li class="de-author">
						<?=us_username?>
					</li>
				</ul>
			</div>
		</div>
		<div class="de-body">
			<?php
			switch ($pg) {
				case 'restaurants' : include __DIR__ ."/cpanel/restaurants.php"; break;
				case 'menu'        : include __DIR__ ."/cpanel/menu.php"; break;
				case 'cuisines'    : include __DIR__ ."/cpanel/cuisines.php"; break;
				case 'items'       : include __DIR__ ."/cpanel/items.php"; break;
				case 'plans'       : include __DIR__ ."/cpanel/plans.php"; break;
				case 'payments'    : include __DIR__ ."/cpanel/payments.php"; break;
				case 'settings'    : include __DIR__ ."/cpanel/settings.php"; break;
				case 'pages'       : include __DIR__ ."/cpanel/pages.php"; break;
				case 'testimonials': include __DIR__ ."/cpanel/testimonials.php"; break;
				case 'reviews'     : include __DIR__ ."/cpanel/reviews.php"; break;
				case 'orders'      : include __DIR__ ."/cpanel/orders.php"; break;
				case 'users'       : include __DIR__ ."/cpanel/users.php"; break;
				case 'withdraw'    : include __DIR__ ."/cpanel/withdraw.php"; break;

				default            : include __DIR__ ."/cpanel/main.php"; break;
			}

			?>
			<div class="de-copy">
				<h3>&nbsp;</h3>
				Copyright &copy; 2020 <a href="<?=path?>">Europa</a>. All Rights Reserved.
			</div>
		</div>
	</div>

</div>
</div>

<?php

include __DIR__."/scripts.php";
