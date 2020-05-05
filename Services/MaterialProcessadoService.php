<?php
	//classe contém as regras de negocio referente ao modelo de usuario
	class MaterialProcessadoService{

		public $material_processado;
		public $conexao;

		public function __construct(MaterialProcessado $material_processado,Conexao $conexao){
			$this->material_processado=$material_processado;
			$this->conexao=$conexao->conectar();
		}	
		public function registroProcessados(){
			$query="insert into tb_materiais_processados
			(id_hospital,responsavel_por,lote,inicio_ciclo,fim_ciclo,numero_do_ciclo,pressao,temperatura_interna,horario_134,data,hora)
			values(:id_hospital, :responsavel_por, :lote, :inicio_ciclo, :fim_ciclo, :numero_do_ciclo, :pressao, :temperatura_interna, :horario_134, now(), now() )";
			$stmt=$this->conexao->prepare($query);
			$stmt->bindValue(':id_hospital',$this->material_processado->__get('id_hospital'));
			$stmt->bindValue(':responsavel_por',$this->material_processado->__get('responsavel_por'));
			$stmt->bindValue(':lote',$this->material_processado->__get('lote'));
			$stmt->bindValue(':inicio_ciclo',$this->material_processado->__get('inicio_ciclo'));
			$stmt->bindValue(':fim_ciclo',$this->material_processado->__get('fim_ciclo'));
			$stmt->bindValue(':numero_do_ciclo',$this->material_processado->__get('numero_do_ciclo'));
			$stmt->bindValue(':pressao',$this->material_processado->__get('pressao'));
			$stmt->bindValue(':temperatura_interna',$this->material_processado->__get('temperatura_interna'));
			$stmt->bindValue(':horario_134',$this->material_processado->__get('horario_134'));
			$stmt->execute();
		}
		public function obterUltimoCadastro(){
			$query="select * from tb_materiais_processados where id_hospital= :id_hospital order by id desc limit 1";
			$stmt=$this->conexao->prepare($query);
			$stmt->bindValue(':id_hospital',$this->material_processado->__get('id_hospital'));
			$stmt->execute();
			return $stmt->fetch();
		}
		public function listaMateriaisProcessados(){
			$query="select *,TIME_FORMAT(inicio_ciclo, '%H:%i') as inicio_ciclo,TIME_FORMAT(fim_ciclo, '%H:%i') as fim_ciclo,TIME_FORMAT(horario_134, '%H:%i') as horario,DATE_FORMAT(data, '%d/%m/%Y') as data from tb_materiais_processados where id_hospital = :id_hospital";
			$stmt=$this->conexao->prepare($query);
			$stmt->bindValue(':id_hospital',$this->material_processado->__get('id_hospital'));
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
					
	}
?>