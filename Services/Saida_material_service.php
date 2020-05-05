<?php
	
	class Saida_material_service{

		public $saida_material;
		public $conexao;

		public function __construct(Saida_material $saida_material,Conexao $conexao){
			$this->saida_material=$saida_material;
			$this->conexao=$conexao->conectar();
		}	
		
		public function registroSaida(){
			$query="insert into tb_saida_material
			(id_hospital,data,hora,saida_para,registro,paciente_empresa_setor,responsavel)
			values(:id_hospital, now(), now(), :saida_para, :registro, :paciente_empresa_setor, :responsavel)";
			$stmt=$this->conexao->prepare($query);
			$stmt->bindValue(':id_hospital',$this->saida_material->__get('id_hospital'));
			$stmt->bindValue(':saida_para',$this->saida_material->__get('saida_para'));
			$stmt->bindValue(':registro',$this->saida_material->__get('registro'));
			$stmt->bindValue(':paciente_empresa_setor',$this->saida_material->__get('paciente_empresa_setor'));
			$stmt->bindValue(':responsavel',$this->saida_material->__get('responsavel'));
			$stmt->execute();
		}
		public function obterUltimoCadastro(){
			$query="select * from tb_saida_material where id_hospital= :id_hospital order by id desc limit 1";
			$stmt=$this->conexao->prepare($query);
			$stmt->bindValue(':id_hospital',$this->saida_material->__get('id_hospital'));
			$stmt->execute();
			return $stmt->fetch();
		}
		public function listaMateriaisSaida(){
			$query="select *,TIME_FORMAT(inicio_ciclo, '%H:%i') as inicio_ciclo,TIME_FORMAT(fim_ciclo, '%H:%i') as fim_ciclo,TIME_FORMAT(horario_134, '%H:%i') as horario,DATE_FORMAT(data, '%d/%m/%Y') as data from tb_materiais_processados where id_hospital = :id_hospital";
			$stmt=$this->conexao->prepare($query);
			$stmt->bindValue(':id_hospital',$this->saida_material->__get('id_hospital'));
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
	}
?>