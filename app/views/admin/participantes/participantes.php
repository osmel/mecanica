<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view('admin/header'); ?>
<?php $this->load->view( 'admin/navbar' ); ?>

	<?php
	 	if (!isset($retorno)) {
	      	$retorno ="admin";
	    }
	?>    

	<div class="container">

		
		<div class="row">

			<br>
				<div class="col-xs-12 col-sm-12 col-md-12 marginbuttom">
				<div class="col-xs-12 col-sm-12 col-md-12"><h4>Participantes</h4></div>
			</div>	
			
			<!--
			<div class="col-xs-12 col-sm-4 col-md-3 marginbuttom">
				<a href="<?php echo base_url(); ?>historico_participantes" type="button" class="btn btn-success btn-block">Histórico de accesos</a>
			</div> -->

			
		
			<div class="col-sm-3 col-md-3 marginbuttom">
				<a id="exportar_reportes" nombre="reportes_participante" type="button" class="btn btn-success btn-block">Exportar</a>
			</div>

			<div class="col-xs-12 col-sm-4 col-md-3 marginbuttom">
				<a id="exportar_reportes" nombre="exportar_todo" type="button" class="btn btn-success btn-block">Exportar todo</a>
			</div>


		</div>
		<br>
		<div class="container row">
		<div class="panel panel-primary">
			<div class="panel-heading">Listado de participantes</div>
			<div class="panel-body">
			<div class="col-md-12">
				
				<div class="table-responsive">

					<section>
						<table id="tabla_participantes" class="display table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
							<thead>
								<tr>


									<th class="text-center cursora" width="10%">Fecha Creación</th>
									<th class="text-center cursora" width="10%">TICKETS REGISTRADOS</th>
									<th class="text-center cursora" width="10%">TOTAL DE PUNTOS DE FACEBOOK</th>
									<th class="text-center cursora" width="10%">TOTAL DE PUNTOS ACUMULADOS</th>

									<th class="text-center cursora" width="10%">Sem. 1</th>
									<th class="text-center cursora" width="10%">Sem. 2</th>
									<th class="text-center cursora" width="10%">Sem. 3</th>		
									<th class="text-center cursora" width="10%">Sem. 4</th>								

									<th class="text-center cursora" width="10%">Sem. 5</th>
									<th class="text-center cursora" width="10%">Sem. 6</th>		
									<th class="text-center cursora" width="10%">Sem. 7</th>								

										
									<th class="text-center cursora" width="15%">Nombre</th>
									<th class="text-center cursora" width="10%">Nick</th>
									<th class="text-center cursora" width="10%">Contraseña</th>
									
									<th class="text-center cursora" width="15%">Email </th>
									<th class="text-center cursora" width="10%">Telefono</th>									
									
									<th class="text-center cursora" width="10%">Fecha. Nac.</th>
									<th class="text-center cursora" width="10%">Detalles</th>





								</tr>
							</thead>
						</table>
					</section>
				</div>
			</div>
		</div>
		</div>
		
		<div class="row">

			<div class="col-sm-8 col-md-9"></div>
			<div class="col-sm-4 col-md-3">
				<a href="<?php echo base_url(); ?><?php echo $retorno; ?>" class="btn btn-danger btn-block"><i class="glyphicon glyphicon-backward"></i> Regresar</a>
			</div>

		</div>
		<br/>
	</div>

<?php $this->load->view('admin/footer'); ?>


<div class="modal fade bs-example-modal-lg" id="modalMessage2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
        <div class="modal-content"></div>
    </div>
</div>	
	

<div class="modal fade bs-example-modal-lg" id="modalMessage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
        <div class="modal-content"></div>
    </div>
</div>	