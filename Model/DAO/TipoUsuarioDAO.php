<?php
/*Cadastro os tipos de usuario se e dar informatica, enfermagem, m�dicos, manunte��o, rh. Tem que fazer esse cadastro
 * primeiro para dizer se ele e de qual setor
 * */

include_once 'Conexao/Conexao.php';

class TipoUsuarioDAO {

	private $conn = null;
	
	public function cadastrar() {

		try {
			
			$sql = "INSERT INTO setor (nome_setor, id_hora_entrada, id_hora_saida, status, estado_dias) 
			VALUES ('" . $setor->nome . "', '" . $setor->idHoraEntrada . "', 
			'" . $setor->idHoraSaida . "', '" . $setor->status . "', '" . $setor->estadoDias . "')";
			
			$conn = new Conexao ();
			$conn->openConnect ();
			
			$mydb = mysqli_select_db ( $conn->getCon (), $conn->getBD());
			$resultado = mysqli_query ( $conn->getCon (), $sql );
			
			$conn->closeConnect ();
							
			return true;
			
		} catch ( PDOException $e ) {
			return "erro de banco de dados";
		}
		
	}
	
	//Retorna a lista como todos os setores cadastrado
	public function lista($arrayData){
		
		$arrayNome = array();
		//Tem que fazer um contado de numeros para colocar no array as data 
		//para mostrar na tela inicial do index
		for ($i = 0; $i < count($arrayData); $i++){
				
			$sql = "SELECT DISTINCT(ds.nome), dse.data FROM dias_semanais ds 
					INNER JOIN data_semanais dse ON(ds.id = dse.id_dias_semanais) 
					WHERE dse.data = '".$arrayData[$i]."'";
			
			$conn = new Conexao();
			$conn->openConnect();
			
			$mydb = mysqli_select_db($conn->getCon(), $conn->getBD());
			$resultado = mysqli_query($conn->getCon(), $sql);
			
			$conn->closeConnect ();
			
			
			$array = array();
			while ($row = mysqli_fetch_assoc($resultado)) {
				$array[]=$row;
			}
			$arrayNome[$i] = $array;
		}
		
		return $arrayNome;
		
	}
	
}

?>