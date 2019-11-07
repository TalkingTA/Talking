<?php
  class Util{
  public function importarVariaveis($dados){
   for ($i = 0; $i < count($dados); $i++) {
	while (list($chave,$valor) = each($dados)) {
				global $$chave;
				$$chave = $valor;
	}
   }
  }
}
?>  
