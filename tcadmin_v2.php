<?php
# CONFIGURAÇÃO DE IDENTIFICAÇÃO DO MÓDULO.

$modulo_servidor['tcadmin_v2']=array(

	'nome'=>"tcadmin_v2",			/* informar o nome do modulo conforme nome do arquivo (respeitando maiusculas e minúsculas).
										   Não usar caracteres especiais ou espaços */
	
	'nome_visivel'=>"TCAdmin Module v2" /*Nome do seu módulo visível no painel HOSTMGR*/
);

#CAMPOS/CONFIGURAÇÕES DO SERVIDOR PARA INTEGRAÇÃO.

/*nesta etapa são criados os campos necessários para conexão junto a API (normalmente logins, tokens, chaves de acesso e etc...
			*Configurações -> servidores -> servidor -> configurações do modulo*/

$modulo_servidor_campos['tcadmin_v2']=array(
	
	/* 
	array( TIPO, ROTULO, NOME, LARGURA, ALTURA, OBRIGATORIO, VALORES, HELPER );
	
	- TIPO			->	tipo de campo ( textfield, password, textarea, select, radio e checkbox)
	- ROTULO		->	Nome do campo (visível)
	- NOME			->	ID do campo (usado na programação)
	- LARGURA		->	largura em pixels
	- ALTURA		->	altura em linhas (apenas para textareas)
	- OBRIGATORIO	->	definir como obrigatorio 
	
							true 	-> cadastrar e editar
							false 	-> não é obrigatorio
							CAD 	-> obrigatório apenas no cadastro
													
	- VALORES		->	array de valores para determinados campos
	
							checkbox	->		array('valor se marcado', 'opção a ser marcada')
							select		->		array('opcao1'=>'valor opcao1', 'opcao2'=>'valor opcao2')
							radio		->		array('opcao1'=>'valor opcao1', 'opcao2'=>'valor opcao2')
	
	
	- HELPER		->	texto de complemento/helper
	
							Rótulo: [|||||||||||||||||||||||||] Texto inserido no Helper
	
*/

	array('textfield',	'Login:',				'login',	300,	'',		true,	'',		''),
	array('password',	'Senha:',				'senha',	300,	'',		false,	'',		'Para não alterar, deixe em branco'),
	array('checkbox',	'&nbsp;',			'defaultport',		300,	10,		true,	array('SIM','Usar porta padrão'),		''),
	array('textfield',	'Porta Personalizada:',				'customport',	300,	'',		true,	'',		''),
);

/*Nesta etapa você deve definir os campos de configuração para os produtos, como espaço em disco, plano, usuarios, bitrate e etc...
		*Configurações -> produtos e serviços -> produto -> configurações do modulo*/
		
$modulo_servidor_produto['tcadmin_v2']=array(
	// Game Information
	array('textfield',	'ID de Jogo:',	'gameid',	300,	'',		false,	'',		'Apenas caso deseje criar um serviço de jogo. <strong>Deixe em branco para não utilizar</strong>.'),
	array('textfield',	'Slots de Jogo:',	'gameslots',	300,	'',		false,	'',		'Apenas caso deseje criar um serviço de jogo. <strong>Deixe em branco para não utilizar</strong>.'),
	array('checkbox',	'Utilizar Marca (Jogo):',	'gamebranded',	300,	'',		false,	array('SIM','Possui marca'),		'Apenas caso deseje criar um serviço de jogo.'),
	array('textfield',	'ID do datacenter de Jogo:',	'gamedatacenter',	300,	'',		false,	'',		'Apenas caso deseje criar um serviço de jogo. <strong>Deixe em branco para não utilizar</strong>.'),

	// Voice Information
	array('textfield',	'ID de Voz:',	'voiceid',	300,	'',		false,	'',		'Apenas caso deseje criar um serviço de voz. Utilize <code>TEAMSPEAK3</code> para servidor TeamSpeak 3. <strong>Deixe em branco para não utilizar</strong>.'),
	array('textfield',	'Slots de Voz:',	'voiceslots',	300,	'',		false,	'',		'Apenas caso deseje criar um serviço de voz. <strong>Deixe em branco para não utilizar</strong>.'),
	array('checkbox',	'Utilizar Marca (Voz):',	'voicebranded',	300,	'',		false,	array('SIM','Possui marca'),		'Apenas caso deseje criar um serviço de voz.'),
	array('textfield',	'ID do datacenter de Voz:',	'voicedatacenter',	300,	'',		false,	'',		'Apenas caso deseje criar um serviço de voz. <strong>Deixe em branco para não utilizar</strong>.'),
);

?>