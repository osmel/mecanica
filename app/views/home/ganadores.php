<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view( 'home/header' ); ?>
<?php $this->load->view( 'home/navbar' ); ?>
<style>
.logoderecha{
	display: none;
}
</style>
<style>

body{
	
	
            background-position: center center;
            background-image: url(img/mecanica1/backmeca1.jpg);
}
</style>
 <?php 
	 if ($this->session->userdata('session_participante') == true) { 
      	$retorno ="registro_ticket";
    } else {
        $retorno ="registro_usuario/<?php echo base64_encode(1); ?>";
    }

?>	

		<div class="container home">								
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<h1>Ganadores</h1>
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
							<h2>¡FELICIDADES A LOS GANADORES DE VIAJE DOBLE A CANCÚN!</h2>
<br>
<p>Gregorio Jacobo Nava</p>
<p>José Pulido Rivera</p>
<p>Jonathan Uriel Ramos Islas</p>
<p>Nohemí Juárez Rojas</p>
<p>Salvador Ortega Santana</p>
<p>Sandra Cristina Sánchez Lárraga</p>
<p>Leticia Santana Rodríguez		</p>
						</div>
<br><br><br>


<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
							<h2>¡FELICIDADES A LOS GANADORES DE MONEDEROS ELECTRÓNICOS DE<br> MERCADO LIBRE®!</h2>
<br>
<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center">
<p>Mónica Ávila Rodríguez</p>
<p>Pedro Adrián Beltrán Figueroa</p>
<p>Evelyn Álvarez Guerrero</p>
<p>Brandon Alfredo Olvera García</p>
<p>Raúl Cruz Meza</p>
<p>Gabriela Domínguez Maya</p>
<p>Juan Gabriel Ponce Montoya</p>
<p>José Luis Guerrero Corella</p>
<p>Salvador Ortega Santana</p>
<p>Jonathan Pérez González</p>
<p>Emmanuel Morales Santana</p>
<p>Eva Fabiola Vázquez Cruces</p>
<p>Delfino Soto Soto</p>
<p>Martha Patricia Villanueva Márquez</p>
<p>Gabriela Cruz Argonza</p>
<p>Verónica Sánchez González</p>
<p>José Guadalupe Vázquez Fritsche</p>
<p>Araceli Jaime Meuly</p>
<p>Jonathan Uriel Ramos Islas</p>
<p>Germán García Meza</p>
<p>Amalia Magdalena García Aguirre</p>
<p>Carlos Nemesio Martínez Castellanos</p>

</div>
<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center">
<p>Jaime Valencia Sánchez</p>
<p>J Jesús Andrade Domínguez</p>
<p>Leticia Santana Rodríguez</p>
<p>Sandra Cristina Sánchez Lárraga</p>
<p>Itzel Ariadne Cruz Ramírez</p>
<p>María Reina Navarro Reyes</p>
<p>Tania Ivette Pérez Aguilar</p>
<p>José Pulido Rivera</p>
<p>José Antonio Pineda Montaño</p>
<p>Pedro Javier Mendoza Navarro</p>
<p>Gregorio Jacobo Nava</p>
<p>Juan Carlos González Venegas</p>
<p>Beatriz Cuéllar Robles</p>
<p>María José Valenzuela Cervantes</p>
<p>Leonardo Ledesma Alexander</p>
<p>Hortencia Urbán Solano</p>
<p>Ivet Sinai Olvera García</p>
<p>Arisaid Mobonnai López de la Fuente de la Cruz</p>
<p>Nohemí Juárez Rojas</p>
<p>Haniel Rafael Valencia Vázquez</p>
<p>Silvia Angélica Pérez Avedillo</p>
<p>Javier Eliseo Gálvez Ramírez</p>
<p>Wendy Ruth del Carmen Vázquez González</p>
<p>Daniel Ortega Sánchez</p>
<p>Ernesto Martín Urzúa</p>
<p>Mariana Zoé Cruces Pérez</p>
</div>


						</div>

						
						
					</div>
					
				</div>
			</div>


<?php $this->load->view( 'home/footer' ); ?>


</script>