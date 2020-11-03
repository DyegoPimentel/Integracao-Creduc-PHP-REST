	// Inicio da integração com o vestibularonline.com.br
	public function enviarDadosAPIVestibular($cadastro){
		
		$url = 'http://homologacao-integracao.vestibularonline.com.br/api/Vestibular/CadastrarDadosInscricaoCandidato/?token=';
        $ch = curl_init($url);
        $data = (object)array(
			'cadastro_candidato' => [
				'dados' => [
					'Id' => $cadastro->id,
					'NomeCompleto' => $cadastro->nome,
					'Email' => $cadastro->email,
					'CPF' => $cadastro->cpf,
					'TelefoneCelular' => $cadastro->telefone
					]
				],
			
			'inscricao_candidato' => [
				'dados' => [
					'LeadReferencia' =>[
						'Id' => $cadastro->id,							
						'Nome' => $cadastro->nome
					],
					'NumeroInscricao' => $cadastro->id,
					'DataProva' => $cadastro->data_agendada,
					'PeriodoLevito' => '2020-2'
					]
			]        
        );
        $options = array(
            'http' => array(
                'method'  => 'POST',
                'content' => json_encode( $data ),
                'header'=>  "Content-Type: application/json\r\n" .
                    "Accept: application/json\r\n"
            )
        );
        $payload = json_encode(array("dados" => $data));
        //codificando o json, padrão
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        //colocando que o tipo de paramtro é um json
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        //Retorna a resposta em vez de emitir
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //execução da resposta
        $result = curl_exec($ch);
        //var_dump($result);
        //fechando a conexão.
		curl_close($ch);
      
	}
	// Fim da integração com o vestibularonline.com.br
