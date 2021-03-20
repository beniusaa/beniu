<?php
if(substr(basename($_SERVER['PHP_SELF']), 0, 11) == "imEmailForm") {
	include '../res/x5engine.php';
	$form = new ImForm();
	$form->setField('Nombre', @$_POST['imObjectForm_1_1'], '', false);
	$form->setField('Email', @$_POST['imObjectForm_1_2'], '', false);
	$form->setField('Teléfono', @$_POST['imObjectForm_1_3'], '', false);
	$form->setField('Mensaje', @$_POST['imObjectForm_1_4'], '', false);

	if(@$_POST['action'] != 'check_answer') {
		if(!isset($_POST['imJsCheck']) || $_POST['imJsCheck'] != '14B813558761350D143E2BC0DFFDD21C' || (isset($_POST['imSpProt']) && $_POST['imSpProt'] != ""))
			die(imPrintJsError());
		$form->mailToOwner($_POST['imObjectForm_1_2'] != "" ? $_POST['imObjectForm_1_2'] : 'info@beniu.es', 'info@beniu.es', 'Consulta Beniu.es', '', false);
		$form->mailToCustomer('info@beniu.es', $_POST['imObjectForm_1_2'], 'Confirmación de su consulta en Beniu', 'Muchas gracias por contactar con Beniu. 

Analizaremos su consulta y enviaremos una respuesta lo antes posible.

Un saludo,

Equipo de Beniu', false);
		@header('Location: ../index.html');
		exit();
	} else {
		echo $form->checkAnswer(@$_POST['id'], @$_POST['answer']) ? 1 : 0;
	}
}

// End of file