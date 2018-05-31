	
<div class="six columns">
						<div class="row">
							<div class="five phone-two columns">
								<div id="logo">
									<img src="/img/logo.png" />
								</div>
							</div>
							<div class="seven phone-two columns">
								<form action="search.php" style="display:none" id="search_box" method="post">
									<input name="query" id="query" type="text" size="40" placeholder="Find a city&hellip;" autocomplete="off" />
								</form>
							</div>
						</div>
					</div>
					<div class="six columns">
						<div class="user_box cf">
							<div class="user_avatar">
								<img src="/img/user_female.png" alt="" />
							</div>
							<div class="user_info user_sep">
								<p class="sepH_a">
									<strong><a href="/perfil.php?userid=<?php echo $session->userid ?>"><?php echo $session->username ?></a></strong>
								</p>
								<span>
									<a href="/miperfil.php" class="sep">Editar Perfil</a>
									<a href="/process.php">Salir</a>
								</span>
							</div>
							<div class="ntf_bar user_sep">
								<a href="/#ntf_mail_panel" class="ntf_item" style="background-image: url(/img/ico/icSw2/32-Mail.png)">
									<span class="ntf_tip ntf_tip_red"><span>12</span></span>
								</a>
								<a href="/#ntf_tickets_panel" class="ntf_item" style="background-image: url(/img/ico/icSw2/32-Day-Calendar.png)">
									<span class="ntf_tip ntf_tip_red"><span>122</span></span>
								</a>
								<a href="/#ntf_comments_panel" class="ntf_item" style="background-image: url(/img/ico/icSw2/32-Speech-Bubble.png)">
									<span class="ntf_tip ntf_tip_blue"><span>8</span></span>
								</a>
							</div>
						</div>
					</div>