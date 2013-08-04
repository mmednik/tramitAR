<?php 
	include('lib/class.MySQL.php');
	$oMySQL = new MySQL('tramites','root','mysql');
	$modalTramite = $oMySQL->ExecuteSQL('SELECT * FROM tramites WHERE idtramites=' . $_POST['id']);
	$tituloTags = $oMySQL->ExecuteSQL('SELECT DISTINCT label FROM tags WHERE idtramites=' . $_POST['id']); 
    
    $miniTags = '<ul class="mini-tags">';
	foreach($tituloTags as $tituloTag) {
		$miniTags .= '<li><a class="btn btn-default btn-mini';
		if(isset($tituloTag['label'])): $miniTags .= ' ' .$tituloTag['label'];else:$miniTags .= ' ' . $tituloTag;endif;
		$miniTags .= '" disabled="disabled">';
		if(isset($tituloTag['label'])): 
			$miniTags .= $tituloTag['label'];
		else:
			$miniTags .= $tituloTag;
		endif;
		$miniTags .= '</a></li>';
	}
	$miniTags .= '</ul>';

	$html = '' .
	'<div class="modal-dialog">'.
   	'	<div class="modal-content">'.
	'      <div class="modal-header">'.
	'        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>'.
	'        <h3 class="modal-title">' . utf8_encode($modalTramite['titulo']) . '</h3>'.
	'        <h4 class="modal-subtitle">(Cod. ' . utf8_encode($modalTramite['codigo']) . ') ' . utf8_encode($modalTramite['organismo']) . '</h4>'.	
	'      </div>'.
	'      <div class="modal-body">'.
	'			<div class="accordion" id="accordionTramite">';
	if(strlen($modalTramite['en_que_consiste'])>0) {
		$html .= ''.
	'				<div class="accordion-group">'.
	'					<div class="accordion-heading">'.
	'						<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionTramite" href="#collapse-1">En que consiste</a>'.
	'					</div>'.
	'					<div id="collapse-1" class="accordion-body collapse in">'.
	'						<div class="accordion-inner">'.
	'							<p>' . utf8_encode($modalTramite['en_que_consiste']) . '</p>'.
	'						</div>'.
	'					</div>'.
	'				</div>';
	}
	if(strlen($modalTramite['requisitos'])>0) {
		$html .= ''.
	'				<div class="accordion-group">'.
	'					<div class="accordion-heading">'.
	'						<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionTramite" href="#collapse-2">Requisitos</a>'.
	'					</div>'.
	'					<div id="collapse-2" class="accordion-body collapse">'.
	'						<div class="accordion-inner">'.
	'							<p>' . utf8_encode($modalTramite['requisitos']) . '</p>'.
	'						</div>'.
	'					</div>'.
	'				</div>';
	}
	if(strlen($modalTramite['como_se_hace_el_tramite'])>0) {
		$html .= ''.
	'				<div class="accordion-group">'.
	'					<div class="accordion-heading">'.
	'						<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionTramite" href="#collapse-3">Como se hace el tramite</a>'.
	'					</div>'.
	'					<div id="collapse-3" class="accordion-body collapse">'.
	'						<div class="accordion-inner">'.
	'							<p>' . utf8_encode($modalTramite['como_se_hace_el_tramite']) . '</p>'.
	'						</div>'.
	'					</div>'.
	'				</div>';
	}
	if(strlen($modalTramite['quien_puede_o_debe_efectuarlo'])>0) {
		$html .= ''.
	'				<div class="accordion-group">'.
	'					<div class="accordion-heading">'.
	'						<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionTramite" href="#collapse-4">Quien puede o debe efectuarlo</a>'.
	'					</div>'.
	'					<div id="collapse-4" class="accordion-body collapse">'.
	'						<div class="accordion-inner">'.
	'							<p>' . utf8_encode($modalTramite['quien_puede_o_debe_efectuarlo']) . '</p>'.
	'						</div>'.
	'					</div>'.
	'				</div>';
	}
	if(strlen($modalTramite['que_vigencia_tiene_el_documento'])>0) {
		$html .= ''.
	'				<div class="accordion-group">'.
	'					<div class="accordion-heading">'.
	'						<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionTramite" href="#collapse-5">Que vigencia tiene el documento</a>'.
	'					</div>'.
	'					<div id="collapse-5" class="accordion-body collapse">'.
	'						<div class="accordion-inner">'.
	'							<p>' . utf8_encode($modalTramite['que_vigencia_tiene_el_documento']) . '</p>'.
	'						</div>'.
	'					</div>'.
	'				</div>';
	}
	if(strlen($modalTramite['cuantas_veces_deberia_asistir_al_organismo'])>0) {
		$html .= ''.
	'				<div class="accordion-group">'.
	'					<div class="accordion-heading">'.
	'						<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionTramite" href="#collapse-6">Cuatas veces deberia asistir al organismo</a>'.
	'					</div>'.
	'					<div id="collapse-6" class="accordion-body collapse">'.
	'						<div class="accordion-inner">'.
	'							<p>' . utf8_encode($modalTramite['cuantas_veces_deberia_asistir_al_organismo']) . '</p>'.
	'						</div>'.
	'					</div>'.
	'				</div>';
	}
	if(strlen($modalTramite['tiempo_desde_la_solicitud_hasta_la_entrega'])>0) {
		$html .= ''.
	'				<div class="accordion-group">'.
	'					<div class="accordion-heading">'.
	'						<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionTramite" href="#collapse-7">Tiempo desde la solicitud hasta la entrega</a>'.
	'					</div>'.
	'					<div id="collapse-7" class="accordion-body collapse">'.
	'						<div class="accordion-inner">'.
	'							<p>' . utf8_encode($modalTramite['tiempo_desde_la_solicitud_hasta_la_entrega']) . '</p>'.
	'						</div>'.
	'					</div>'.
	'				</div>';
	}
	if(strlen($modalTramite['donde_se_puede_realizar'])>0) {
		$html .= ''.
	'				<div class="accordion-group">'.
	'					<div class="accordion-heading">'.
	'						<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionTramite" href="#collapse-8">Donde se puede realizar</a>'.
	'					</div>'.
	'					<div id="collapse-8" class="accordion-body collapse">'.
	'						<div class="accordion-inner">'.
	'							<p>' . utf8_encode($modalTramite['donde_se_puede_realizar']) . '</p>'.
	'						</div>'.
	'					</div>'.
	'				</div>';
	}
	if(strlen($modalTramite['cuando_es_necesario_realizar_el_tramite'])>0) {
		$html .= ''.
	'				<div class="accordion-group">'.
	'					<div class="accordion-heading">'.
	'						<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionTramite" href="#collapse-9">Cuando es necesario realizar el tramite</a>'.
	'					</div>'.
	'					<div id="collapse-9" class="accordion-body collapse">'.
	'						<div class="accordion-inner">'.
	'							<p>' . utf8_encode($modalTramite['cuando_es_necesario_realizar_el_tramite']) . '</p>'.
	'						</div>'.
	'					</div>'.
	'				</div>';
	}
	if(strlen($modalTramite['observaciones'])>0) {
		$html .= ''.
	'				<div class="accordion-group">'.
	'					<div class="accordion-heading">'.
	'						<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionTramite" href="#collapse-10">Observaciones</a>'.
	'					</div>'.
	'					<div id="collapse-10" class="accordion-body collapse">'.
	'						<div class="accordion-inner">'.
	'							<p>' . utf8_encode($modalTramite['observaciones']) . '</p>'.
	'						</div>'.
	'					</div>'.
	'				</div>';
	}
	$html .= ''.
	'			</div>'.
	'      </div>'.
	'      <div class="modal-footer">'.
	$miniTags .
	'      </div>'.
	'    </div>'.
	'</div>';

	echo $html;
?>
    
      

  

     