<div class="de-footer">
	<div class="container">
		<div class="row">
			<div class="col-3">
				
				
			</div>
			<div class="col-6">
				<div class="de-links">
					<h3><?=$lang['home']['links']?></h3>
					<?php
					$sql = $db->query("SELECT * FROM ".prefix."pages WHERE footer = 0 ORDER BY sort ASC LIMIT 12");
          if($sql->num_rows):
          $i = 1;
          while($rs = $sql->fetch_assoc()):
          ?>
          <a href="<?=path?>/pages.php?id=<?=$rs['id']?>&t=<?=fh_seoURL($rs['title'])?>"><i class="fas fa-long-arrow-alt-right"></i> <?=$rs['title']?></a>
          <?php
          $i++;
          if($i==7){
            echo'</div><div class="de-links"><h3>&nbsp;</h3>';
            $i=0;
          }
          endwhile;
          endif;
          $sql->close();
          ?>
				</div>
			</div>
			
		</div>
	</div>

</div><!-- End footer -->

</div><!-- End wrapper -->
</div><!-- End Scroller -->




<?php if(!us_level): ?>
<form id="sendsignin">
<div class="modal fade newmodal" id="loginModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"><?=$lang['login']['title']?></h4>
				<button type="button" class="close" data-dismiss="modal">×</button>
			</div>
			<div class="modal-body">
				<div class="form-group de-form-icon">
					<span><i class="icons icon-user"></i></span>
					<input type="text" name="sign_name" placeholder="<?=$lang['login']['username']?>">
				</div>
				<div class="form-group de-form-icon">
					<span><i class="icons icon-key"></i></span>
					<input type="password" name="sign_pass" placeholder="<?=$lang['login']['password']?>">
				</div>
				<div class="row">
					<div class="col">
						<div class="form-group">
							<input type="checkbox" name="sign_type" id="ck1" value="1" class="choice">
							<label for="ck1"><?=$lang['login']['keep']?></label>
						</div>
					</div>
				</div>
				<div class="de-msg"></div>
				<button type="submit"><?=$lang['login']['btn']?></button>
				<?php if(site_register): ?>
				<p><?=$lang['login']['footer']?> <b><a data-toggle="modal" href="#registerModal"><?=$lang['login']['footer_l']?></a></b></p>
				<?php endif; ?>

				<?php if(site_register && (login_facebook || login_twitter || login_google)): ?>
				<div class="de-social-login">
					<b><?=$lang['login']['social']?></b>
					<?php if(login_facebook): ?>
					<a class="facebook" href="<?=$facebookLoginUrl?>"><i class="fab fa-facebook"></i></a>
					<?php endif; ?>
					<?php if(login_twitter): ?>
					<a class="twitter" href="<?=$twitterLoginUrl?>"><i class="fab fa-twitter"></i></a>
					<?php endif; ?>
					<?php if(login_google): ?>
					<a class="google" href="<?=$googleLoginUrl?>"><i class="fab fa-google"></i></a>
					<?php endif; ?>
				</div>
				<?php endif; ?>
			</div>

		</div>
	</div>
</div>
</form>



<?php if(site_register): ?>
<form id="sendsignup">
	<div class="modal fade newmodal" id="registerModal">
		<div class="modal-dialog">
			<div class="modal-content">

				<div class="modal-header">
					<h4 class="modal-title"><?=$lang['signup']['title']?></h4>
					<button type="button" class="close" data-dismiss="modal">×</button>
				</div>

				<div class="modal-body">
					<div class="form-group de-form-icon">
						<span><i class="icons icon-user"></i></span>
						<input type="text" name="reg_name" placeholder="<?=$lang['signup']['username']?>">
					</div>
					<div class="form-group de-form-icon">
						<span><i class="icons icon-key"></i></span>
						<input type="password" name="reg_pass" placeholder="<?=$lang['signup']['password']?>">
					</div>
					<div class="form-group de-form-icon">
						<span><i class="icons icon-lock-open"></i></span>
						<input type="password" name="reg_repass" placeholder="<?=$lang['signup']['rpassword']?>">
					</div>
					<div class="form-group de-form-icon">
						<span><i class="icons icon-envelope"></i></span>
						<input type="text" name="reg_email" placeholder="<?=$lang['signup']['email']?>">
						<p class="small text-info"><i class="fas fa-info-circle"></i> <?=$lang['signup']['email_p']?></p>
					</div>
					<div class="de-msg"></div>
					<button type="submit"><?=$lang['signup']['btn']?></button>

					<?php if(site_register && (login_facebook || login_twitter || login_google)): ?>
					<div class="de-social-login">
						<b><?=$lang['signup']['social']?></b>
						<?php if(login_facebook): ?>
						<a class="facebook" href="<?=$facebookLoginUrl?>"><i class="fab fa-facebook"></i></a>
						<?php endif; ?>
						<?php if(login_twitter): ?>
						<a class="twitter" href="<?=$twitterLoginUrl?>"><i class="fab fa-twitter"></i></a>
						<?php endif; ?>
						<?php if(login_google): ?>
						<a class="google" href="<?=$googleLoginUrl?>"><i class="fab fa-google"></i></a>
						<?php endif; ?>
					</div>
					<?php endif; ?>
				</div>

			</div>
		</div>
	</div>
</form>
<?php endif; ?>
<?php else: ?>
	<form id="sendpassword">
		<div class="modal fade newmodal" id="passwordModal">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title"><?=$lang['header']['change_password']?></h4>
						<button type="button" class="close" data-dismiss="modal">×</button>
					</div>
					<div class="modal-body">
						<div class="form-row">
							<div class="col">
								<div class="form-group de-form-icon">
									<span><i class="icons icon-key"></i></span>
									<input type="password" name="oldpass" placeholder="<?=$lang['header']['change_pass_i1']?>">
								</div>
							</div>
							<div class="col">
								<div class="form-group de-form-icon">
									<span><i class="icons icon-key"></i></span>
									<input type="password" name="newpass" placeholder="<?=$lang['header']['change_pass_i2']?>">
								</div>
							</div>
						</div>
						<div class="de-msg"></div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="de-btn"><?=$lang['header']['change_pass_bt']?></button>
					</div>
				</div>
			</div>
		</div>
	</form>
	<form id="sendtestimonial">
		<div class="modal fade newmodal" id="testimonialModal">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title"><?=$lang['header']['testimonial_h']?></h4>
						<button type="button" class="close" data-dismiss="modal">×</button>
					</div>
					<?php $rs_testimonial = db_rs("testimonials WHERE author = '".us_id."'"); ?>
					<?php if (!$rs_testimonial): ?>
					<div class="modal-body">
						<textarea name="testimonial" placeholder="<?=$lang['header']['testimonial_i']?>"></textarea>
						<div class="de-msg"></div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="de-btn"><?=$lang['header']['testimonial_b']?></button>
					</div>
				<?php else: ?>
					<div class="modal-body"><p class="bg-light text-dark p-3"><?php echo $rs_testimonial['content'] ?></p></div>
				<?php endif; ?>
				</div>
			</div>
		</div>
	</form>

<?php endif; ?>

<form id="senditemtocart">
<div class="modal fade newmodal" id="addtocartModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<div class="modal-body">
				<div id="de-getmodalitem"><i class="fas fa-spinner fa-pulse fa-fw"></i> <?=$lang['loading']?></div>
				<div class="de-msg"></div>
			</div>
		</div>
	</div>
</div>
</form>

<?php
include __DIR__."/scripts.php";
?>

</body>
</html>
