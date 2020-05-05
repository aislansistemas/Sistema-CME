<?php
	class Mensagem {
		private $para = null;
		private $assunto = null;
		private $mensagem = null;
		private $status = array( 'codigo_status' => null, 'descricao_status' => '');

		public function __get($atributo) {
			return $this->$atributo;
		}

		public function __set($atributo, $valor) {
			$this->$atributo = $valor;
		}

	}
?>