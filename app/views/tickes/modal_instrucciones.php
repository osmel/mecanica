<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php
 	if (!isset($retorno)) {
      	$retorno ="registro_ticket";
    }
 $hidden = array('nada'=>'nada'); 

 ?>
  
<?php //echo form_open('validar_confirmar_juego', array('class' => 'form-horizontal','id'=>'form_sino','name'=>$retorno, 'method' => 'POST', 'role' => 'form', 'autocomplete' => 'off' ) ,   $hidden ); ?>
	
		

<div class="preguntas">
        <div class="col-md-12 text-center">
        	<span class="titular1">
        		RESPONDE A LA SIGUIENTE TRIVIA PARA OBTENER TUS PUNTOS
        	</span>
        	<span class="pregunta">
        		  <?php echo $pregunta->pregunta; ?>
        	</span>
        	<ul class="opcionesrespuesta">
        		<li>A) <?php echo $pregunta->a; ?></li>
        		<li>B) <?php echo $pregunta->b; ?></li>
        	</ul>
        	
        </div>
</div> 



	</div>
	<div class="modal-footer">
		<div class="cont">
			<!--<button type="button" class="close continuar ingresar" data-dismiss="modal" aria-label="Close">
				
					CONTINUAR
				
			</button> -->
			<div class="col-md-6 text-center">
                <button class="btn_respuesta" fig="1" resp="a">A)</button>
        	</div>
        	<div class="col-md-6 text-center">
        		<button class="btn_respuesta" fig="1" resp="b">B)</button>
        	</div>
        	
		</div>
	</div>





	
	
<?php //echo form_close(); ?>
