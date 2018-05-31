<?php include("include/classes/session.php"); ?>

<?php if (($session->logged_in)){ header('Location: /dashboard.php'); } else {	?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ingresar / Entrar | CAE - Control y Asistencia de Empleados</title>

		<!-- Foundation framework -->
			<link rel="stylesheet" href="/foundation/stylesheets/foundation.css" />
			<link rel="stylesheet" href="/css/style.css" />

		<!-- Favicons and the like (avoid using transparent .png) -->
			<link rel="shortcut icon" href="/favicon.ico" />
			<link rel="apple-touch-icon-precomposed" href="/icon.png" />
	</head>
	<body class="ptrn_a grdnt_a">
		<div class="container">
            <div class="row">
                <div class="eight columns centered">
                    
                </div>
            </div>
			<div class="row">
				<div class="eight columns centered">
					<div class="login_box">
						<div class="lb_content">
                            <div class="login_logo"><img style="height: 30px;" src="/img/logo.png" alt="" /></div>
							<div class="cf">
								<h2 class="lb_ribbon lb_blue"><span>Bienvenido, Ingrese sus datos.</span><span style="display:none">Ups... Sin Clave</span></h2>
								<a href="#" class="right small sl_link">
									<span>¿Olvido Su Contraseña?</span>
									<span style="display:none">Volver / Regresar</span>
								</a>
							</div>
							<div class="row m_cont">
								<div class="eight columns centered">
									<div class="l_pane">
										<form action="/logsing/" method="post" class="nice" id="l_form">
											<div class="sepH_c">
												<div class="elVal">
													<label for="username">Usuario</label><?php echo $form->error("user"); ?>
													<input type="text" id="username" name="user" class="oversize expand input-text" value="<?php echo $form->value("user"); ?>" />
												</div>
												<div class="elVal">
													<label for="password">Contraseña</label><?php echo $form->error("pass"); ?>
													<input type="password" id="password" name="pass" class="oversize expand input-text" value="<?php echo $form->value("pass"); ?>" />
												</div>
											</div>
											<div class="cf">
												<input type="hidden" name="sublogin" value="1">
												<input type="submit" class="button small radius right black" value="Ingresar" />
											</div>
										</form>
									</div>
									<div class="l_pane" style="display:none">
										<form action="dashboard.html" method="post" class="nice" id="rp_form">
											<div class="sepH_c">
												<p class="sepH_b">Porfavor ingrese su correo electronico y le haremos llegar su contraseña o una nueva, gracias.</p>
												<div class="elVal">
													<label for="upname">E-mail:</label>
													<input type="text" id="upname" name="upname" class="oversize expand input-text" />
												</div>
											</div>
											<div class="cf">
												<input type="submit" class="button small radius right black" value="Solicitar" />
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<script src="/js/jquery.min.js"></script>
		<script src="/js/s_scripts.js"></script>
		<script src="/lib/validate/jquery.validate.min.js"></script>
		<script>
			$(document).ready(function() {
				$(".sl_link").click(function(event){
					$('.l_pane').slideToggle('normal').toggleClass('dn');
					$('.sl_link,.lb_ribbon').children('span').toggle();
					event.preventDefault();
				});

				$("#l_form").validate({
					highlight: function(element) {
						$(element).closest('.elVal').addClass("form-field error");
					},
					unhighlight: function(element) {
						$(element).closest('.elVal').removeClass("form-field error");
					},
					rules: {
						username: "required",
						password: "required"
					},
					messages: {
						username: "Please enter your username (type anything)",
						password: "Please enter a password (type anything)"
					},
					errorPlacement: function(error, element) {
						error.appendTo( element.closest(".elVal") );
					}
				});

				$("#rp_form").validate({
					highlight: function(element) {
						$(element).closest('.elVal').addClass("form-field error");
					},
					unhighlight: function(element) {
						$(element).closest('.elVal').removeClass("form-field error");
					},
					rules: {
						upname: {
							required: true,
							email: true
						}
					},
					messages: {
						upname: "Please enter a valid email address"
					},
					errorPlacement: function(error, element) {
						error.appendTo( element.closest(".elVal") );
					}
				});
			});
		</script>
	</body>
</html>

 
<?php
}
?>