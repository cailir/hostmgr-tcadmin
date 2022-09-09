<?php

function tcadmin_v2_apireq($action, $parametros){
	$port = $parametros['servidor']['defaultport'] ? "8880" : $parametros['servidor']['customport'];
	$url = "http://" . $parametros['servidor']['ip'] . ":" . $port . "/Aspx/billingapi.aspx";

	$data = [];
	$data['tcadmin_username'] = $parametros['servidor']['login'];
	$data['tcadmin_password'] = $parametros['servidor']['senha'];
	$data['response_type'] = "text";
	$data['function'] = $action;

	switch ($action) {
		case 'AddPendingSetup':
			// Dados do Cliente
			$data['client_id'] = $parametros['cliente']['id_cliente'];
			$data['user_email'] = $parametros['cliente']['email'] ? $parametros['cliente']['email'] : null;
			$data['user_fname'] = $parametros['cliente']['nome'] ? $parametros['cliente']['nome'] : null;
			$data['user_address1'] = $parametros['cliente']['endereco'] ? $parametros['cliente']['endereco'] : null;
			$data['user_city'] = $parametros['cliente']['cidade'] ? $parametros['cliente']['cidade'] : null;
			$data['user_state'] = $parametros['cliente']['estado'] ? $parametros['cliente']['estado'] : null;
			$data['user_zip'] = $parametros['cliente']['cep'] ? $parametros['cliente']['cep'] : null;
			$data['user_country'] = "BR";
			$data['user_phone1'] = $parametros['cliente']['telefone'] ? $parametros['cliente']['telefone'] : null;
			$data['user_phone2'] = $parametros['cliente']['celular'] ? $parametros['cliente']['celular'] : null;

			// Dados do Usuário
			$data['user_name'] = $parametros['conta']['login'];
			$data['user_password'] = $parametros['conta']['senha'];

			// Dados do serviço de jogo
			$data['game_package_id'] = $parametros['conta']['id_conta'] ? $parametros['conta']['id_conta'] : null;
			$data['game_id'] = $parametros['produto']['gameid'] ? $parametros['produto']['gameid'] : null;
			$data['game_slots'] = $parametros['produto']['gameslots'] ? $parametros['produto']['gameslots'] : null;
			$data['game_branded'] = $parametros['produto']['gamebranded'] ? $parametros['produto']['gamebranded'] : null;
			$data['game_datacenter'] = $parametros['produto']['gamedatacenter'] ? $parametros['produto']['gamedatacenter'] : null;

			// Dados do serviço de voz
			$data['voice_package_id'] = $parametros['conta']['id_conta'] ? $parametros['conta']['id_conta'] : null;
			$data['voice_id'] = $parametros['produto']['voiceid'] ? $parametros['produto']['voiceid'] : null; 
			$data['voice_slots'] = $parametros['produto']['voiceslots'] ? $parametros['produto']['voiceslots'] : null;
			$data['voice_branded'] = $parametros['produto']['voicebranded'] ? $parametros['produto']['voicebranded'] : null;
			$data['voice_datacenter'] = $parametros['produto']['voicedatacenter'] ? $parametros['produto']['voicedatacenter'] : null;
			break;
		case 'SuspendGameAndVoiceByBillingID':
			$data['client_package_id'] = $parametros['conta']['id_conta'] ? $parametros['conta']['id_conta'] : null;
			break;
		case 'UnSuspendGameAndVoiceByBillingID':
			$data['client_package_id'] = $parametros['conta']['id_conta'] ? $parametros['conta']['id_conta'] : null;
			break;
		case 'DeleteGameAndVoiceByBillingID':
			$data['client_package_id'] = $parametros['conta']['id_conta'] ? $parametros['conta']['id_conta'] : null;
			break;
		case 'UpdateSettings':
			// Dados do serviço de jogo
			$data['game_package_id'] = $parametros['conta']['id_conta'] ? $parametros['conta']['id_conta'] : null;
			$data['game_id'] = $parametros['produto']['gameid'] ? $parametros['produto']['gameid'] : null;
			$data['game_slots'] = $parametros['produto']['gameslots'] ? $parametros['produto']['gameslots'] : null;
			$data['game_branded'] = $parametros['produto']['gamebranded'] ? $parametros['produto']['gamebranded'] : null;
			$data['game_datacenter'] = $parametros['produto']['gamedatacenter'] ? $parametros['produto']['gamedatacenter'] : null;

			// Dados do serviço de voz
			$data['voice_package_id'] = $parametros['conta']['id_conta'] ? $parametros['conta']['id_conta'] : null;
			$data['voice_id'] = $parametros['produto']['voiceid'] ? $parametros['produto']['voiceid'] : null; 
			$data['voice_slots'] = $parametros['produto']['voiceslots'] ? $parametros['produto']['voiceslots'] : null;
			$data['voice_branded'] = $parametros['produto']['voicebranded'] ? $parametros['produto']['voicebranded'] : null;
			$data['voice_datacenter'] = $parametros['produto']['voicedatacenter'] ? $parametros['produto']['voicedatacenter'] : null;
			break;
		default:
			break;
	}

	$curl = curl_init();

	curl_setopt_array($curl, array(
	CURLOPT_URL => $url,
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => '',
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 0,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => 'POST',
	CURLOPT_POSTFIELDS => http_build_query($data),
	CURLOPT_HTTPHEADER => array(
		'Content-Type: application/x-www-form-urlencoded'
	),
	));
	
	tcadmin_v2_debug(curl_exec($curl));

	if(curl_errno($ch)) {
		$response = array(curl_error());
	} else {
		$response = array('status'=>'sucesso');
	}

	curl_close($curl);
	return $response;
}

function tcadmin_v2_debug($arr){
	file_put_contents('D:\debug.txt', print_r($arr, true));
}

function tcadmin_v2_acao_criar($parametros){
	return tcadmin_v2_apireq("AddPendingSetup", $parametros);
}

function tcadmin_v2_acao_suspender($parametros){
	return tcadmin_v2_apireq("SuspendGameAndVoiceByBillingID", $parametros);
}

function tcadmin_v2_acao_reativar($parametros){
	return tcadmin_v2_apireq("UnSuspendGameAndVoiceByBillingID", $parametros);
}

function tcadmin_v2_acao_finalizar($parametros){
	return tcadmin_v2_apireq("DeleteGameAndVoiceByBillingID", $parametros);
}


/* CRIANDO FUNÇõES ADICIONAIS */

function tcadmin_v2_acao_alterar_plano($parametros){
	return tcadmin_v2_apireq("UpdateSettings", $parametros);
}

/* ADICIONAR COMANDOS NO ADMIN(adicionar bot�es/comandos para as fun��es adicionais)*/
function tcadmin_v2_comandos_adicionais() {
	//adicionar outros comandos	(criar, suspender, reativar e finalizar s�o definidos automaticamente)
	
	$comandosAdmin=array(
		array("comando"=>"Alterar Plano",	"funcao"=>"acao_alterar_plano"),
	);
	
	return $comandosAdmin;
}


/*ADICIONAR COMANDOS NO PAINEL DO CLIENTE (gerenciamento da conta)*/

function tcadmin_v2_comandos_cliente() {
	//adicionar outros comandos	
	
	$comandosCliente=array(
		/*comandos criar, suspender, reativar e finalizar n�o s�o permitidos*/
		
	);
	
	return $comandosCliente;
}

?>