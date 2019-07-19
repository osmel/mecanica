<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view( 'mecanica2/header' ); ?>
<?php echo $map['js']; ?>	
<?php $this->load->view( 'mecanica2/navbar' ); ?>
<style>
.navbar-brand{
	
}
body{
	
	background-image: none;
            background-position: center center;
            background-image: url(img/mecanica1/backmeca1.jpg);
}
</style>

		<div class="row home">	
			<div class="container">							
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="col-lg-5 col-md-5 centralhome imagendecupon text-center">
							<img src="<?php echo base_url()?>img/mecanica2/localizador.png" class="separador">
							
							<button class="miposicion" style="border:0px;background-color:transparent">
								<img src="<?php echo base_url()?>img/mecanica2/usarubi.png" class="separador">
							</button>

							
							
							<!--
							<div class="form-group">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<input type="text" class="form-control" id="" name="" placeholder="CIUDAD O MUNICIPIO">
									<span class="help-block" style="color:white;" id="msg_calle"> </span> 
								</div>
							</div>	

							<div class="form-group">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<input type="text" class="form-control" id="" name="" placeholder="COLONIA">
									<span class="help-block" style="color:white;" id="msg_calle"> </span> 
								</div>
							</div>	

							-->

			            <div class="form-group" style="    display: inline-block;">
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<span style="font-size: 25px;color:#ffffff">Escribe algo para obtener resultados</span>
											<input  identificador="" type="text" name="editar_localizador" 
											 identificador_vendedor = "0"
											 class="buscar_localizador form-control typeahead tt-query" autocomplete="off" spellcheck="false" placeholder="CIUDAD O MUNICIPIO...">
											 <span class="help-block" style="color:white;" id="msg_calle"> </span> 
										</div>
				        </div> 


			            <div class="form-group" style="    display: inline-block;">
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<span style="font-size: 25px;color:#ffffff;margin-top:25px">Escribe algo para obtener resultados</span>
											<input  identificador="" type="text" name="editar_cp" 
											 identificador_vendedor = "0"
											 class="buscar_cp form-control typeahead tt-query" autocomplete="off" spellcheck="false" placeholder="Cod. Postal">
											 <span class="help-block" style="color:white;" id="msg_calle"> </span> 
										</div>
				        </div> 


							
							<!-- <img src="<?php echo base_url()?>img/mecanica2/buscarti.png" class="separador"> -->
							
						</div>
						<div id="mipos" class="col-lg-7 col-md-7 col-sm-12 col-xs-12 centralhome centralhome2">
						<?php //echo $map['js']; ?>
							<?php echo $map['html']; ?>

						</div>	

						
					</div>			
				</div>
			</div>




<?php $this->load->view( 'mecanica2/footer' ); ?>