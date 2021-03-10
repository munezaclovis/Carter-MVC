<?php
use Core\Router;
use Core\H;
use App\Models\Users;

	$menu = Router::getMenu('menu_acl');
	$currentPage = H::currentPage();
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light navbar-custom">
	<a class="navbar-brand-custom" href="<?=PROOT?>"><img src="<?=LOGO?>"></a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_menu" aria-controls="main_menu" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="main_menu">
		<ul class="navbar-nav mr-auto">
			<?php foreach ($menu as $key => $value):
				$active = '';
				$active = ($value == $currentPage)?'active' : '';?>
				<?php if (is_array($value)):?>
					<li class="nav-item nav-item-custom dropdown <?=$active?>">
						<a class="nav-link nav-link-custom dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?=$key?></a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<?php foreach ($value as $k => $v):
								$active = ($v == $currentPage)?'active' : '';?>
								<?php if ($k == 'separator'): ?>
									<div class="dropdown-divider"></div>
								<?php else: ?>
									<a class="dropdown-item <?=$active?>" href="<?=$v?>"><?=$k?></a>
								<?php endif ?>
							<?php endforeach ?>
						</div>
					</li>
				<?php elseif($key == 'Logout' || $key == 'Login' || $key == 'Account'):
					$active = ($value == $currentPage)?'active' : '';?>
					</ul>
					<ul class="navbar-nav mrl-auto">
						<?php if($key == 'Account'):?>
							<li class="nav-item nav-item-custom <?=$active?>">
								<?php if (Users::currentUser()): ?>
									<a class="nav-link nav-link-custom" href="<?=$value?>"><?=$key?>(<b><?=Users::currentUser()->lname?></b>)</a>
								<?php endif ?>
							</li>
						<?php else: ?>
							<li class="nav-item nav-item-custom <?=$active?>">
								<a class="nav-link nav-link-custom" href="<?=$value?>"><?=$key?></a>
							</li>
						<?php endif ?>
				<?php else: ?>
					<li class="nav-item nav-item-custom <?=$active?>">
						<a class="nav-link nav-link-custom" href="<?=$value?>"><?=$key?></a>
					</li>
				<?php endif ?>
			<?php endforeach ?>
		</ul>
	</div>
</nav>