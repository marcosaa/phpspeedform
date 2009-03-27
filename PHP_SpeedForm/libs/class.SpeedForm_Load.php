<?php

	/**
	 * Carrega Strings JSON ou XML e gera o Formula'rio final
	 * 
	 * @package PHPSpeedForm
	 * @author Moisés Paes Sena <moisespsena@gmail.com>
	 * @link http://code.google.com/p/phpspeedform/source/browse/trunk/PHP_SpeedForm/libs/class.SpeedForm_Load.php
	 * @copyright GPL
     * @since 2009-03-27
	 * @version 1.0
	 */
	class SpeedForm_Load {
		/**
		 * Armazena todos os itens do formuario em forma de array numerico
		 *
		 * @var array
		 */
		private $formList = array();
		
		/**
		 * Path da Classe SpeedForm
		 *
		 * @var string
		 */
		private $SFPath = './class.SpeedForm.php';
		
		/**
		 * Objeto da Classe SpeedForm
		 *
		 * @var object
		 */
		private $SF;
		
		/**
		 * Objeto da Classe SpeedForm_ObjectProperties
		 *
		 * Conte'm todas as informacoes e atributos para cada cada objeto especifico do formula'rio
		 * @var object
		 */
		private $FMOP;
		
		/**
		 * Ma'scaras
		 *
		 * Array nume'rico com o nome dos campo e suas respectivas ma'scaras
		 * <code>
		 * 		$mask = array(
		 * 			array( 'field' => 'field_name', 'mask' => 'filed_mask' ),
		 * 			array( 'field' => 'field_name2', 'mask' => 'filed_mask2' )			
		 * 		);
		 * </code>
		 * @var array
		 */
		private $mask;
		
		/**
		 * Ma'scaras ordenadas pela mascara
		 *
		 * Array nume'rico com o nome dos campo e suas respectivas ma'scaras
		 * <code>
		 * 		$mask = array(
		 * 			'mask' => array( 'field_name', 'fiel_name2' ),
		 * 			'mask2' => array( 'field_name', 'fiel_name2' )			
		 * 		);
		 * </code>
		 * @var array
		 */
		private $mask_cat;
		
		/**
		 * Campos de Peenchimento Obrigato'rio
		 *
		 * Array nume'rico com o nome dos campos de preenchimento Obrigato'rio
		 * <code>
		 * 		$required = array(
		 * 			'field1',
		 * 			'field2',
		 * 			'field3'	
		 * 		);
		 * </code>
		 * @var array
		 */
		private $required;
		
		/**
		 * Carregamento das Propriedades
		 *
		 * Se as propriedades vindas de uma string XML ou JSON foram bem sucedias, sera TRUE, caso contra'rio, FALSE
		 * @var boolean
		 */
		private $loaded = false;
		
		/**
		 * Execucao do Me'todo Create
		 *
		 * Se o meto'do Create foi Executado, TRUE, caso contra'rio, FALSE
		 * @var boolean
		 */
		private $create = false;
		
		/**
		 * Execucao do Me'todo loadedNames
		 *
		 * Se o meto'do loadedNames foi Executado, TRUE, caso contra'rio, FALSE
		 * @var boolean
		 */
		private $loaded_names = false;
		
		/**
		 * Atributos do Formulario atual
		 *
		 * @var array
		 */
		private $form_attributes = array();
		
		/**
		 * Nome de todos os campos
		 *
		 * @var array
		 */
		private $names = array();
		
		/**
		 * Valores a serem atribuídos aos campos
		 * @var array
		 */
		private $newValues = array();
		
		/**
		 * Define um caminho para a class SpeedForm
		 * 
		 * O path aqui definido so e valido se a class SpeedForm estiver no mesmo
		 * diretorio da classe atual, caso contrario, devera ser setado manualmente
		 * o path da mesma.
		 * @return unknown_type
		 */
		public function __construct() {
			$file = strtr( __FILE__, '\\', '/' );
			$dir = substr($file,0,strrpos($file, '/')+1);
			$this->setSpeedFormPath( $dir . 'class.SpeedForm.php' );
		}
		
		/**
		 * Cria um Lista de Objetos de Formulario a Partir de uma string XML ou JSON va'lida
		 *
		 * @param string $json_xml string JSON ou XML va'lida
		 * @return false se o argumento passado nao for uma string JSON ou XML v'alida
		 */
		public function Load( $json_xml ) {
			if( !is_string( $json_xml ) ) return false;
			// Verifica se foi carregada por qualquer um dos me'todos
			if( !$this->loadJSON( $json_xml ) && !$this->loadXML( $json_xml ) )
				// se nao foi carregado, Retorna FALSE
				return false;
			else
				return true;
		}
		
		/**
		 * Cria um Lista de Objetos de Formulario a Partir de uma string XML va'lida
		 *
		 * @param string $str_xml string XML va'lida
		 * @return boolean false se a string passada como argumento nao for uma string XML da Classe FormManipulate va'lida
		 */
		public function loadXML( $str_xml = '' ) {
			// Verifica a Variavel passada como argumento e' uma strig XML va'lida, da Classe FormManipulate, caso nao seja, Retorna FALSE
			if( !preg_match( '/^<\?xml[^(\?>)]+\?>\s*<FormManipulate[^>]+>.*<\/FormManipulate\>$/', preg_replace( '/\n+|\t+/', '', $str_xml ) ) ) 
				return false;
			// Cria o Objeto SimpleXML com as propriedades
			$SXML = new SimpleXMLElement( $str_xml );
			// Criamos um array que contera' as propriedades do objeto $SXML
			$arr = $this->objectToArray( $SXML );
			// Fazemos uma nova verificacao para saber se existe o item FormObject
			if( !isset( $arr[ 'FormObject'] ) ) return false;
			// Envia o array com as propriedades e objetos para o meto'do que ira adicionar itens 'a lista
			$this->generateList( $arr[ 'FormObject'] );
			// Retorna TRUE
			return $this->loaded = true;
		}
		
		/**
		 * Cria uma Lista de Objetos a patir de uma string JSON
		 *
		 * @param string $str_json string JSON va'lida
		 * @return boolean false se a string passada como argumento nao for uma string JSON va'lida
		 */
		public function loadJSON( $str_json ) {
			// Verifica a Variavel passada como argumento e' uma strig JSON va'lida, caso nao seja, Retorna FALSE
			if( !preg_match( '/^[\{\[]([\w\W]+)[\}\]]$/', $str_json ) ) return false;
			// Convertemo a String JSON num array associativo com objetos da stdClass
			//echo '<pre>'.print_r($str_json,true).'</pre>';
			if( !$JSON = json_decode( $str_json ) ) return false;
			// Criamos um array que contera' as propriedades do objeto JSON
			$arr = $this->objectToArray( $JSON );
			// Remove os indices de informacao
			self::unsetInfoIndex( $arr );
			// e envia para o meto'do que ira adicionar itens 'a lista
			$this->generateList( $arr );
			
			// Retorna TRUE
			return $this->loaded = true;
		}
		
		/**
		 * Adiciona um item 'a matriz de configuracoes dos objetos do formulario
		 *
		 * Exemplo:
		 * <code>
		 * 		$config = array(
		 * 			'type' => 'html',
		 * 			'content' => '<p>teste</p>'
		 * 		);
		 * 		
		 * 		$FM->addItem( $config );
		 * </code>
		 * @param array $data
		 */
		public function addItem( array $data ) {
			$this->formList[] = $data;
		}
		
		/**
		 * Remove os Indices de informacoes de Exportacao da matriz
		 *
		 * @param array $data
		 */
		private static function unsetInfoIndex( &$data ) {
			unset( $data['version'], $data['author'], $data['contact'], $data['blog'], $data['date'] );
		}
		
		/**
		 * Define o Path da Class SpeedForm
		 *
		 * Exemplo:
		 * <code>
		 * 		$FM->setFormAttributes('classes/class.SpeedForm.php');
		 * </code>
		 * @param string $path Patch da classe SpeedForm
		 */
		public function setSpeedFormPath( $path ) {
			$this->SFPath = $path;
		}
		
		/**
		 * Define os Atributos do Formulário
		 *
		 * Exemplo:
		 * <code>
		 * 		$FM->setFormAttributes(array(
		 * 			'action' => 'recebe.php',
		 * 			'name'   => 'my_form',
		 * 			'id'     => 'id_my_form'
		 * 		));
		 * </code>
		 * @param array $attributes Matriz associativa, onde os indices sao os atributos e seus valores, os valores dos atributos
		 */
		public function setFormAttributes( array $attributes ) {
			unset( $this->formList['form'] );
			$this->form_attributes = $attributes;
		}
		
		/**
		 * Cria o Formula'rio
		 *
		 * @return string HTML do Formula'rio renderizado
		 */
		public function Create( &$FMOP_object = NULL ) {
			// Carrega a Classe SpeedForm e define um Objeto da mesma, caso nao for bem-sucedido, retorna FALSE
			if( !$this->loadSpeedForm() ) return false;
			// Configura as Propriedades do Objeto $this->SF 
			$this->configObjectsProperties( $FMOP_object );
			// O me'todo create foi executado
			$this->create = true; 
			// Carrega os Itens e retorna o Formula'rio
			$form_data = $this->SF->Contents( $this->loadFormObject( $this->formList ), false );
			return $this->SF->Form( $this->form_attributes, $form_data, true );
		}
		
		/**
		 * Retorna uma String JSON formatada com todas as Propriedades de Criacao do Formula'rio 
		 *
		 * @return string JSON
		 */
		public function getJSON() {
			return json_encode( $this->formList );
		}
		
		/**
		 * Retorna uma matriz com as Ma'scaras, sendo estas uma matriz numerica com o nomes dos campos
		 *
		 * Retorna um Array nume'rico com o nome dos campo e suas respectivas ma'scaras
		 * <code>
		 * 		$mask = array(
		 * 			array( 'field' => 'field_name', 'mask' => 'filed_mask' ),
		 * 			array( 'field' => 'field_name2', 'mask' => 'filed_mask2' )
		 * 		);
		 * </code>
		 * @return array Ma'scaras
		 */
		public function getMaskCat() {
			// Se as Propriedades ainda nao foram criadas, retorna nulo
			if( !$this->loaded ) return NULL;
			
			// Se o meto'do Create e loadedNames nao foram executados 
			if( !$this->create && !$this->loaded_names ) {
				// executa o me'todo loadedNames
				$this->loadNames( $this->formList );
				// O me'todo loadedNames foi executado
				$this->loaded_names = true;
			}
			
			// retorna o array com as ma'scaras
			return isset( $this->names[ 'mask_cat' ] ) ? $this->names[ 'mask_cat' ] : array();
		}
		
		/**
		 * Retorna as Ma'scaras
		 *
		 * Retorna um Array nume'rico com o nome dos campo e suas respectivas ma'scaras
		 * <code>
		 * 		$mask = array(
		 * 			array( 'field' => 'field_name', 'mask' => 'filed_mask' ),
		 * 			array( 'field' => 'field_name2', 'mask' => 'filed_mask2' )
		 * 		);
		 * </code>
		 * @return array Ma'scaras
		 */
		public function getMask() {
			// Se as Propriedades ainda nao foram criadas, retorna nulo
			if( !$this->loaded ) return NULL;
			
			// Se o meto'do Create e loadedNames nao foram executados 
			if( !$this->create && !$this->loaded_names ) {
				// executa o me'todo loadedNames
				$this->loadNames( $this->formList );
				// O me'todo loadedNames foi executado
				$this->loaded_names = true;
			}
			
			// retorna o array com as ma'scaras
			return isset( $this->names[ 'mask' ] ) ? $this->names[ 'mask' ] : array();
		}
		
		/**
		 * Retorna os Campos de peenchimento obrigato'rio
		 *
		 * Retorna um Array nume'rico com o nome dos campo de preenchimento obrigato'rio
		 * <code>
		 * 		$required = array(
		 * 			'field1',
		 * 			'field2',
		 * 			'field3'	
		 * 		);
		 * </code>
		 * @return array Ma'scaras
		 */
		public function getRequired() {
			// Se as Propriedades ainda nao foram criadas, retorna nulo
			if( !$this->loaded ) return NULL;
			
			// Se o meto'do Create e loadedNames nao foram executados 
			if( !$this->create && !$this->loaded_names ) {
				// executa o me'todo loadedNames
				$this->loadNames( $this->formList );
				// O me'todo loadedNames foi executado
				$this->loaded_names = true;
			}
			
			// Retorna o array com os campos obrigato'rios
			return isset( $this->names[ 'required' ] ) ? $this->names[ 'required' ] : array();
		}
		
		/**
		 * Retorna uma matriz associativa contendo o nome,
		 * o rotulo e o tipo do campo
		 * 
		 * <code>
		 * 		$fields = array(
		 * 			array(
		 * 				'name' => 'field_name',
		 * 				'label' => 'field_label',
		 * 				'type' => 'text'
		 * 			),
		 * 			array(
		 * 				'name' => 'field_name',
		 * 				'label' => 'field_label',
		 * 				'type' => 'checkbox'
		 * 			)
		 * 		);
		 * </code>
		 * @return array
		 */
		public function getNames() {
			// Se as Propriedades ainda nao foram criadas, retorna nulo
			if( !$this->loaded ) return NULL;
			
			// Se o meto'do Create e loadedNames nao foram executados 
			if( !$this->create && !$this->loaded_names ) {
				// executa o me'todo loadedNames
				$this->loadNames( $this->formList );
				// O me'todo loadedNames foi executado
				$this->loaded_names = true;
			}
			return isset( $this->names[ 'all' ] ) ? $this->names[ 'all' ] : array();
		}
		
		/**
		 * Retorna uma matriz numerica contendo apenas
		 * os nomes de todos os campos
		 * @return array
		 */
		public function getJustNames() {
			// Se as Propriedades ainda nao foram criadas, retorna nulo
			if( !$this->loaded ) return NULL;
			
			// Se o meto'do Create e loadedNames nao foram executados 
			if( !$this->create && !$this->loaded_names ) {
				// executa o me'todo loadedNames
				$this->loadNames( $this->formList );
				// O me'todo loadedNames foi executado
				$this->loaded_names = true;
			}
			$names = isset( $this->names[ 'all' ] ) ? $this->names[ 'all' ] : array();
			
			if( count( $names > 0 ) ) {
				$_names = array();
				
				foreach( $names as &$v )
					$_names[] = &$v[ 'name' ];
					
				return $_names;
			}
			else return $names;
		}
		
		/**
		 * Retorna uma String XML formatado
		 * 
		 * String este que podera ser carregado mais tarde pelo objeto FormManipulate
		 * @param boolen $concat[optional] se TRUE, concatena a string XML
		 * @return String
		 */
		public function getXML($concat = false) {
			$xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>"
				. ( $concat ? "\r\n" : '' )
				. "<FormManipulate version=\"1.0\" date=\"" . date('Y-m-d H:i:s') . "\">";

				foreach( $this->formList as &$v )
					$xml .= self::toRecursiveItemXML( $v, "\r\n", $concat );
					
			$xml .= ( $concat ? "\r\n" : '' ) . "</FormManipulate>";
			
			return $xml;
		}
		
		/**
		 * Gera uma string XML com a lista de intens de formulario
		 * 
		 * @param array $current item do array pai
		 * @param string $space String de concatenacao
		 * @return string
		 */
		private static function toRecursiveItemXML( &$current, $space, $concat ) {
			$xml = '';
			$space = $space . "\t";
			
			$xml .= ( $concat ? $space : '' ) . '<FormObject>';
			
			foreach( $current as $k => &$v ) {
				if( $k == 'group_elements' ) {
					$xml .= ( $concat ? $space . "\t" : '' ) . "<" . $k . ">";
						foreach( $v as $i => &$c ){
							$xml .= ( $concat ? $space . "\t\t" : '' ) . "<item>";
								foreach( $c as $r => &$m ) {
									$xml .= ( $concat ? $space . "\t\t\t" : '' ) . "<" . $r . ">" . $m . "</" . $r . ">";
								}
							$xml .= ( $concat ? $space . "\t\t" : '' ) . "</item>";
						}
					$xml .= ( $concat ? $space . "\t" : '' ) . "</" . $k . ">";
				}
				else if( $k != 'childs' )
					$xml .= ( $concat ? $space . "\t" : '' ) . "<" . $k . ">" . $v . "</" . $k . ">";
			};
			
			if( isset($current[ 'childs' ]) ) {
				$xml .= ( $concat ? $space . "\t" : '' ) . "<childs>";
				
				foreach($current[ 'childs' ] as &$v )
					$xml .= self::toRecursiveItemXML( $v, $space. "\t", $concat );
				
				$xml .= ( $concat ? $space . "\t" : '' ) . "</childs>" ;
			}
			
			$xml .= ( $concat ? $space : '' ) . "</FormObject>";
			
			return $xml;
		}
		
		/**
		 * Adiciona itens a propriedade fm_list
		 *
		 * @param array $arr
		 * @access private
		 */
		private function generateList( array $arr ) {
			// Verifica se o argumento recebido é uma lista(array numerico) ou propriedades de um objeto do Form(array associativo)
			// Se for propriedades do form, cria uma lista
			if( self::isAssocArray( $arr ) )
				$arr = array( $arr );
			
			// Caso seja um array numerico, ou seja uma lista de itens de formulario,
			// cria-se os objetos na lista de itens do FormManipulate
			if( self::isNumericArray( $arr ) )
				foreach( $arr as $v )
					$this->formList[] = self::checkProperties( $v );
		}

		/**
		 * Valida os i'ndices do array recebido para serem usados como 
		 * propriedades de Objetos de Formulario na Classe FormManipulate 
		 *
		 * @param array $properties
		 * @access private
		 */
		private static function checkProperties( array &$properties ) {
			// Propriedades validadas
			$props = array();
			// Se as propriedades passadas como argumento forem um array
			if( is_array( $properties ) ) {
				// Varro o array
				foreach( $properties as $k => $v ) {
					// Caso o item atual seja um array
					if( is_array( $v ) ) {
						// Caso o nome do item atual seja CHILDS, significa que ele tem que ser um array,
						// Uma vez que ele pode possuir va'rios itens do formulario dentro dele
						if( strtoupper( $k ) == 'CHILDS' ) {
							// Caso o item CHILDS tenha itens
							if( count( $v ) > 0 ) {
								// Se ele veio a partir de uma string JSON, 
								// ou tenha Vindo do objeto SimpleXMLElement 
								// ( caso os elementos que tinham dentro dele foram deletados, sobrara' 
								// o i'ndice zero (0) que sera' uma string, e nao um array, como deve ser )  
								// ele sera' inteiramente um array nume'rico
								if( self::isNumericArray( $v ) ) {
									// Assim sendo, childs sera' um array
									// e os itens deste array serao arrays que terao suas propriedades
									foreach( $v as $c ) {
										// veio restritamente de uma string JSON, e nao do SimpleXML
										// que tem apenas um i'ndice, o zero (0) e e' uma string: properties = array( 'childs' => array( 0 => '' ) )
										if( is_array( $c ) )
											$props[ $k ][] = self::checkProperties( $c );
									}
								}
								// Caso o item CHILDS tenha vindo de uma String que veio do Objeto SimpleXML,
								// tera' o item FormObject
								else if( isset( $v[ 'FormObject' ] ) ) {
									// Se este item, FormObject, for um array associativo,
									// significa que o item Childs tem apenas um item 
									if( self::isAssocArray( $v[ 'FormObject' ] ) && count( $v[ 'FormObject' ] ) > 0 ) {
										// Tendo apenas um item o item Childs e' um array com apenas o item zero(0)									
										$props[ $k ] = array( self::checkProperties( $v[ 'FormObject' ] ) );
									}
									// Se este item, FormObject, for um array nume'rico,
									// significa que o item Childs possui va'rios itens 
									if( self::isNumericArray( $v[ 'FormObject' ] ) && count( $v[ 'FormObject' ] ) > 0 ) {
										// Assim sendo, childs sera' um array
										// e os itens deste array serao objetos que terao suas propriedades
										foreach( $v[ 'FormObject' ] as $c ) {
											$props[ $k ][] = self::checkProperties( $c );
										}
									}
								}
							}
						}
						else if( strtoupper( $k ) == 'GROUP_ELEMENTS' ) {
							// Caso o item CHILDS tenha itens
							if( count( $v ) > 0 ) {
								// Se ele veio a partir de uma string JSON,
								// ele sera' inteiramente um array nume'rico 
								if( self::isNumericArray( $v ) ) {
									// Assim sendo, childs sera' um array
									// e os itens deste array serao arrays que terao suas propriedades
									foreach( $v as $c ) {
										$props[ $k ][] = self::checkProperties( $c );
									}
								}
								// Caso o item CHILDS tenha vindo de uma String que veio do Objeto SimpleXML,
								// tera' o item FormObject
								else if( isset( $v[ 'item' ] ) ) {
									// Se este item, FormObject, for um array associativo,
									// significa que o item Childs tem apenas um item 
									if( self::isAssocArray( $v[ 'item' ] ) && count( $v[ 'item' ] ) > 0 ) {
										// Tendo apenas um item o item Childs e' um array com apenas o item zero(0)									
										$props[ $k ] = array( self::checkProperties( $v[ 'item' ] ) );
									}
									// Se este item, FormObject, for um array nume'rico,
									// significa que o item Childs possui va'rios itens 
									if( self::isNumericArray( $v[ 'item' ] ) && count( $v[ 'item' ] ) > 0 ) {
										// Assim sendo, childs sera' um array
										// e os itens deste array serao objetos que terao suas propriedades
										reset( $v[ 'item' ] );
										while( $c = current( $v[ 'item' ] ) ) {
											$props[ $k ][] = self::checkProperties( $c );
											next( $v[ 'item' ] );
										}
									}
								}
							}
						}
						// Caso o nome do item atual nao seja CHILDS e e' um array,
						// Significa que ele e' uma string vazia que se tornou um array pelo parse
						// do Objeto SimpleXML
						else {
							// Redefinimos o Valor deste item para vazio
							$props[ $k ] = '';
						}
					}
					// Caso o item atual nao seja um array
					else {
						$props[ $k ] = $v;
					}
				}
				// Retorna o array com as novas Propriedades
				return $props;
			}
			// se nao for array
			return false;
		}
		
		/**
		 * Converte um Objeto em um Array associativo
		 *
		 * @param object|array $obj_array objeto a ser convertido para array
		 * @return array
		 * @access private
		 */
		private function objectToArray( &$obj_array ) {
			// Coverte a variavel recebida como argumento em array
			$obj_array = (array) $obj_array;
			$arr = array();
			foreach( $obj_array as $k => $v ){
				if( is_object( $v ) || is_array( $v ) ) $arr[ $k ] = $this->objectToArray( $v );
				else if( is_string( $v ) ) {
					$v = trim( $v );
					if( $v == 'true' )
						$arr[ $k ] = true;
					else if ( $v == 'false' )
						$arr[ $k ] = false;
					else 
						$arr[ $k ] = $v;
				}
				else 
					$arr[ $k ] = $v;
			}
			return $arr;
		}
		
		/**
		 * Verifica se o Array passado como argumento conte'm 
		 * apenas i'ndices numericos
		 *
		 * @param array $array Array a ser analisadp
		 * @return boolean TRUE se todos os i'ndices forem 
		 * nume'ricos ou, FALSE caso nao seja
		 * @access private
		 */
		private static function isNumericArray( &$array = array() ) {
			// se o array passado como argumento nao tiver indices Retorna FALSEE
			if( count( $array ) == 0 ) return false;
			
			// Varremos o array em busca de algum indice nao nume'erico, se for encontrado Retorna FALSE
			reset( $array );
			while( $k = key( $array ) ) {
				if( !is_numeric( $k ) ) return false;
				next( $array );
			}
			reset( $array );
			// Retorna TRUE
			return true;
		}
		
		/**
		 * Verifica se o Array passado como argumento conte'm apenas 
		 * i'ndices nao-nume'ricos
		 *
		 * @param array $array Array a ser analisado
		 * @return boolean TRUE se todos os i'ndices nao forem nume'ricos, 
		 * FALSE caso sejam
		 * @access private
		 */
		private static function isAssocArray( &$array = array() ) {
			// se o array passado como argumento nao tiver indices Retorna FALSE
			if( count( $array ) == 0 ) return false;
			
			// Varremos o array em busca de algum indice nume'erico, se for encontrado Retorna FALSE
			foreach( $array as $k => $v ) {
				if( !is_string( $k ) ) return false;
			}
			
			// Retorna TRUE
			return true;
		}
		
		/**
		 * Define as Propriedades do Objeto SpeedForm
		 *
		 * @param object $object
		 * @return void
		 */
		private function configObjectsProperties( &$object = NULL ) {
			// Se um Objeto novo for Carregado, sera o padrao, caso contrario,
			// criamos um novo objeto da Classe SpeedForm_ObjectProperties
			// e suas propriedades serao as padroes do Objeto SpeedForm
			$this->FMOP = is_object( $object ) ? $object : new SpeedForm_ObjectProperties();
			
			// Carregamos todas as Propriedades
			$this->SF->setList( $this->FMOP->getList() );
			$this->SF->setListAttributes( $this->FMOP->getListAttributes() );
			$this->SF->setListEvenClassName( $this->FMOP->getListEvenClassName() );
			$this->SF->setListOddClassName( $this->FMOP->getListOddClassName() );
			$this->SF->setListRoot( $this->FMOP->getListRoot() );
			$this->SF->setListRootAttributes( $this->FMOP->getListRootAttributes() );
			$this->SF->setListRootEvenClassName( $this->FMOP->getListRootEvenClassName() );
			$this->SF->setListRootOddClassName( $this->FMOP->getListRootOddClassName() );
			$this->SF->setNewLine( $this->FMOP->getNewLine() );
			$this->SF->setNewLineContent( $this->FMOP->getNewLineContent() );
			$this->SF->setParentCheckbox( $this->FMOP->getParentCheckbox(0), $this->FMOP->getParentCheckbox(1) );
			$this->SF->setParentRadio( $this->FMOP->getParentRadio(0), $this->FMOP->getParentRadio(1) );
			$this->SF->setLabelTitle( $this->FMOP->getLabelTitle() );
			$this->SF->setCharSep( $this->FMOP->getCharSep() );
			$this->SF->setRequiredAttributes( $this->FMOP->getRequiredAttributes() );
			$this->SF->setCheckboxGroupLabel( $this->FMOP->getCheckboxGroupLabel(0), $this->FMOP->getCheckboxGroupLabel(1) );
			$this->SF->setRadioGroupLabel( $this->FMOP->getRadioGroupLabel(0), $this->FMOP->getRadioGroupLabel(1) );
			$this->SF->setRequiredAsterisk( $this->FMOP->getRequiredAsterisk(0), $this->FMOP->getRequiredAsterisk(1) );
		}
		
		/**
		 * Inclui a Classe SpeedForm e cria o Objeto SF
		 * 
		 * @return boolean TRUE Se o Path for correto e a 
		 * Classe existir, caso contra'rio, FALSE
		 */
		private function loadSpeedForm() {
			// Verifica se o Path da Classe es ta coreto
			if( file_exists( $this->SFPath ) ) {
				// Inclui a Classe
				include_once( $this->SFPath );
				// Verifica se a Classe Existe
				if( class_exists( 'SpeedForm' ) ) {
					// Cria o Objeto SF
					$this->SF = new SpeedForm();
					// Retorna sucesso
					return true;
				}
				else
					// Caso Contra'rio
					return false;
			}
			else
				// Caso o Path da Classe esteja Errado
				return false;
		}
		
		/**
		 * Carrega os Arrays Mask e Required
		 *
		 * Este me'todo so' sera' executado caso o me'todo Create nao tenha sido executado 
		 * @param array $properties
		 * @return void
		 */
		private function loadNames( &$properties ) {
			if( self::isNumericArray( $properties ) ) {
				foreach( $properties as $v )
					$this->loadNames( $v );
			}
			else {
				if( isset( $properties[ 'type' ] ) ) {
					$properties[ 'type' ] = trim( strtoupper( $properties[ 'type' ] ) );
					
					if( isset( $properties['name'] ) && $properties[ 'type' ] != 'RADIO' ) {
						if( empty( $properties[ 'label' ] ) )
							$label = NULL;
						else
							$label = &$properties[ 'label' ];
							
						if( isset( $properties[ 'required' ] ) && $properties[ 'required' ] == true )
							$this->names['required'][] = array( 'name' => &$properties[ 'name' ], 'label' => &$label, 'type' => &$properties[ 'type' ] );
						
						$this->names[ 'all' ][] = array( 'name' => &$properties[ 'name' ], 'label' => &$label, 'type' => &$properties[ 'type' ] );
					}
					
					switch( $properties[ 'type' ] ) {
						case 'TEXT' :
							if( isset( $properties[ 'name' ] ) ) {
								if( !empty( $properties[ 'mask' ] ) ) {
									$this->names[ 'mask_cat' ][ $properties[ 'mask' ] ][] = array( 'name' => &$properties[ 'name' ], 'label' => &$label, 'type' => &$properties[ 'type' ] );
									$this->names[ 'mask' ][] = array( 'name' => &$properties[ 'name' ], 'label' => &$label, 'mask' => &$properties[ 'mask' ], 'type' => &$properties[ 'type' ] ); 
								}
							}
							
							break;
							
						case 'FIELDSET' :
							if( isset( $properties[ 'childs' ] ) && count( $properties[ 'childs' ] ) > 0 ) {
								
								reset( $properties[ 'childs' ] );
								while( $c = current( $properties[ 'childs' ] ) ) {
									$this->loadNames( $c );
									next( $properties[ 'childs' ] );
								}
							}
							break;
							
						case 'RADIO' :
							if( empty( $properties[ 'label_group' ] ) )
								$label = NULL;
							else
								$label = &$properties[ 'label_group' ];
							
							if( isset( $properties[ 'required' ] ) && $properties[ 'required' ] == true )
								$this->names['required'][] = array( 'name' => &$properties[ 'name' ], 'label' => &$label, 'type' => &$properties[ 'type' ] );
							
							$this->names[ 'all' ][] = array( 'name' => &$properties[ 'name' ], 'label' => &$label, 'type' => &$properties[ 'type' ] );
							
							break;
					}
				}
			}
		}
		
		public function addValues( array $values ) {
			$this->newValues = $values;
			$this->loadToAddValues( $this->formList );
		}
		
		/**
		 * Recarrega as propriedades adicionando valores aos campos
		 *
		 * @param array $properties
		 * @return string $html
		 */
		private function loadToAddValues( array &$properties ) {
			if( self::isNumericArray( $properties ) ) {
				foreach( $properties as &$v )
					$this->loadToAddValues( $v, true );
			}
			else {
				if( isset( $properties[ 'type' ] ) ) {
					$properties[ 'type' ] = trim( strtoupper( $properties[ 'type' ] ) );
					
					switch( $properties[ 'type' ] ) {
						case 'TEXT' :
							if( isset( $properties[ 'name' ] ) && isset( $this->newValues[ $properties[ 'name' ] ] ) )
								$properties[ 'value' ] = $this->newValues[ $properties[ 'name' ] ];
							
							break;
							
						case 'TEXTAREA' :
							if( isset( $properties[ 'name' ] ) && isset( $this->newValues[ $properties[ 'name' ] ] ) )
								$properties[ 'value' ] = $this->newValues[ $properties[ 'name' ] ];
								
							break;
							
						case 'CHECKBOX' : 
							if( isset( $properties[ 'name' ] ) && isset( $this->newValues[ $properties[ 'name' ] ] ) )
								$properties[ 'active' ] = empty( $this->newValues[ $properties[ 'name' ] ] ) ? false : true;
							
							break;
							
						case 'CHECKBOXGROUP' :
							if( isset( $properties[ 'group_elements' ] ) && count( $properties[ 'group_elements' ] ) > 0 ) {
								foreach( $properties[ 'group_elements' ] as &$v )
									$this->loadToAddValues( $v );
							}
							
							break;
							
						case 'RADIO' :
							if( isset( $properties[ 'name' ] ) && isset( $this->newValues[ $properties[ 'name' ] ] ) ) {
								foreach( $properties[ 'group_elements' ] as &$v )
									$v[ 'active' ] = ( $v[ 'value' ] == $this->newValues[ $properties[ 'name' ] ] ) ? true : false;
							}
							
							break;
							
						case 'FIELDSET' :
							if( isset( $properties[ 'childs' ] ) && count( $properties[ 'childs' ] ) > 0 ) {
								foreach( $properties[ 'childs' ] as &$c ) {
									$current_child = $this->loadToAddValues( $c );
								}
							}
							
							break;
							
						case 'SELECT' : 
							if( isset( $properties[ 'name' ] ) && isset( $this->newValues[ $properties[ 'name' ] ] ) ) {
								foreach( $properties[ 'group_elements' ] as &$v )
									$v[ 'active' ] = ( $v[ 'value' ] == $this->newValues[ $properties[ 'name' ] ] ) ? true : false;
							}
							
							break;
							
						case 'HIDDEN' :
							if( isset( $properties[ 'name' ] ) && isset( $this->newValues[ $properties[ 'name' ] ] ) )
								$properties[ 'value' ] == $this->newValues[ $properties[ 'name' ] ];
								
							break;
					}
				}
			}
		}
		
		/**
		 * Carrega um Objeto de Formulario
		 *
		 * @param array $properties
		 * @return string $html
		 */
		private function loadFormObject( array &$properties, $html = false, $group = false ) {
			$form_objects = array();
			
			if( self::isNumericArray( $properties ) ) {
				foreach( $properties as &$v ) {
					$item = &$this->loadFormObject( $v, true );
					if( !empty( $item ) )
						$form_objects[] = $item;
				}
			}
			else {
				if( isset( $properties[ 'type' ] ) ) {
					$properties[ 'type' ] = trim( strtoupper( $properties[ 'type' ] ) );
					
					if( !empty( $properties['name'] ) && $properties[ 'type' ] != 'RADIO' ) {
						if( empty( $properties[ 'label' ] ) )
							$label = NULL;
						else
							$label = $properties[ 'label' ];
							
						if( isset( $properties[ 'required' ] ) && $properties[ 'required' ] == true ) {
							$this->names['required'][] = array( 'name' => &$properties[ 'name' ], 'label' => &$label, 'type' => &$properties[ 'type' ] );
							$properties[ 'label' ] = '*' . self::issetIndexTo( $properties, 'label' );
						}
						
						$this->names[ 'all' ][] = array( 'name' => &$properties[ 'name' ], 'label' => &$label, 'type' => &$properties[ 'type' ] );
					}
					
					switch( $properties[ 'type' ] ) {
						case 'FORM' :
							unset( $properties['type'] );
							$this->form_attributes = $properties;
							break;
							
						case 'TEXT' :
							if( isset( $properties[ 'name' ] ) ) {
								if( !empty( $properties[ 'mask' ] ) ) {
									$this->names[ 'mask_cat' ][ $properties[ 'mask' ] ][] = array( 'name' => &$properties[ 'name' ], 'label' => &$label );
									$this->names[ 'mask' ][] = array( 'name' => &$properties[ 'name' ], 'label' => &$label, 'mask' => &$properties[ 'mask' ] ); 
								}
								
								$form_objects[] = $this->SF->Text( 
									self::issetIndexTo( $properties, 'label' ), 
									$this->FMOP->getTextAttributes(
										array(
											'name' => $properties[ 'name' ], 
											'title' => self::issetIndexTo( $properties, 'description' ),
											'maxlength' => self::issetIndexTo( $properties, 'maxlength' ),
											'value' => self::issetIndexTo( $properties, 'value' )
										)
									),
									$this->FMOP->getLabelTextAttributes()
								)
								. $this->FMOP->getComplement( self::issetIndexTo( $properties, 'complement' ) )
								. $this->FMOP->getComment( self::issetIndexTo( $properties, 'comment' ) );
							}
							
							break;
							
						case 'TEXTAREA' :
							if( isset( $properties[ 'name' ] ) ) {
								$form_objects []= $this->SF->Textarea(
									self::issetIndexTo( $properties, 'label' ),
									$this->FMOP->getTextareaAttributes(
										array(
											'name'      => $properties[ 'name' ],
											'value'     => self::issetIndexTo( $properties, 'value' ),
											'title'     => self::issetIndexTo( $properties, 'description' ),
											'maxlength' => self::issetIndexTo( $properties, 'maxlength' )
										)
									),
									$this->FMOP->getLabelTextareaAttributes(),
									$this->FMOP->getTextareaNewLine()
								)
								. $this->FMOP->getComment( self::issetIndexTo( $properties, 'comment' ) );
							}
							break;
							
						case 'CHECKBOX' : 
							if( isset( $properties[ 'name' ] ) ) {
								$attributes = array(
										'name'      => $properties[ 'name' ],
										'title'     => self::issetIndexTo( $properties, 'description' )
									);
								
								if( isset( $properties[ 'active' ] ) && $properties[ 'active' ] == true )
									$attributes[ 'checked' ] = 'checked';
									
								$form_objects[] = $this->SF->Checkbox(array(
									self::issetIndexTo( $properties, 'label' ),
									$attributes,
									array()
								));
							}
							
							break;
							
						case 'CHECKBOXGROUP' :
							if( isset( $properties[ 'group_elements' ] ) && count( $properties[ 'group_elements' ] ) > 0 ) {
								$elements = array();
								
								foreach( $properties[ 'group_elements' ] as $v ) {
									$elements[] = array( 
											$v[ 'label' ], 
											array( 'name' => $v[ 'name' ] ) ,
											$this->FMOP->getLabelCheckboxAttributes() 
										);
									if( $v[ 'active' ] ) $elements[ count( $elements )-1 ][ 1 ][ 'checked' ] = 'checked';
								}
								
								$form_objects[] = $this->SF->Checkbox(
										array( 
											self::issetIndexTo( $properties, 'label_group' ),
											array(), 
											$this->FMOP->getCheckboxAttributes() 
										),
										$elements
									);
							}
							
							break;
							
						case 'RADIO' :
							if( isset( $properties[ 'name' ] ) ) {
								if( empty( $properties[ 'label_group' ] ) )
									$label = NULL;
								else
									$label = &$properties[ 'label_group' ];
									
								if( isset( $properties[ 'required' ] ) && $properties[ 'required' ] == true )
									$this->names['required'][] = array( 'name' => &$properties[ 'name' ], 'label' => &$label );
								
								$this->names[ 'all' ][] = array( 'name' => &$properties[ 'name' ], 'label' => &$label, 'type' => &$properties[ 'type' ] );
						
								$elements = array();
								
								reset( $properties[ 'group_elements' ] );
								
								while( $v = current( $properties[ 'group_elements' ] ) ) {
									$elements[] = array( 
										self::issetIndexTo( $v, 'label' ), 
										array( 'value' => self::issetIndexTo( $v, 'value' ) ),
										$this->FMOP->getLabelRadioAttributes()
									);
									if( isset( $v[ 'active' ] ) && $v[ 'active' ] == true ) $elements[ count( $elements )-1 ][ 1 ][ 'checked' ] = 'checked';
									
									next( $properties[ 'group_elements' ] );
								}
								
								$form_objects[] = $this->SF->Radio(
										array( 
											self::issetIndexTo( $properties, 'label_group' ), 
											array(),
											$this->FMOP->getRadioAttributes( array( 'name' => $properties[ 'name' ] ) )
										),
										$elements
									);
							}
							
							break;
							
						case 'FIELDSET' :
							if( isset( $properties[ 'childs' ] ) && count( $properties[ 'childs' ] ) > 0 ) {
								$childs = array();
								
								foreach( $properties[ 'childs' ] as &$c ) {
									$current_child = $this->loadFormObject( $c, true );
									
									if( !empty( $current_child ) )
										$childs[] = $current_child; 
								}
								
								if( count( $childs ) > 0 ) {
									$form_objects[] = $this->SF->Group( 
										self::issetIndexTo( $properties, 'label' ), 
										$this->FMOP->getLegendAttributes(), 
										$this->FMOP->getFieldsetAttributes(), 
										$childs
									);
								}
							}
							
							break;
							
						case 'SELECT' : 
							if( isset( $properties[ 'name' ] ) && isset( $properties[ 'group_elements' ] ) && count( $properties[ 'group_elements' ] ) > 0 ) {
								$elements = array();						
								$active = '';
								
								foreach( $properties[ 'group_elements' ] as &$v ) {
									if( isset( $v[ 'active' ] ) && $v[ 'active' ] == true )
										$active = !empty( $v[ 'value' ] ) ? $v[ 'value' ] : $v[ 'text' ];
									
									$elements[] = array( $v[ 'group' ] , $v[ 'value' ], $v[ 'text' ] );
								}
								
								$form_objects[] = $this->SF->Select(
									self::issetIndexTo( $properties, 'label' ),
									$elements,
									$this->FMOP->getSelectAttributes( 
										array( 
											'name' => self::issetIndexTo( $properties, 'name' ), 
											'title' => self::issetIndexTo( $properties, 'description' )
										) 
									),
									$active,
									$this->FMOP->getSelectOptInit(),
									array(),
									$this->FMOP->getLabelSelectAttributes()
								)
								. $this->FMOP->getComment( self::issetIndexTo( $properties, 'comment' ) );
							}
							
							break;
							
						case 'HIDDEN' :
							$form_objects[ 'HIDDEN' ][] = $this->SF->Hidden( self::issetIndexTo( $properties, 'name' ), self::issetIndexTo( $properties, 'value' ) );
							
							break;
						
						case 'HTML' :
							$form_objects[] = $this->FMOP->getHTML( self::issetIndexTo( $properties, 'content' ) );
							
							break;
					}
				}
			}
			// Se for o elemento de um Fieldset, retorna apenas o HTML, caso contrario, o array com o HTML de cada elemento
			return $html && is_array( $form_objects ) ? ( isset( $form_objects[ 0 ] ) ? $form_objects[ 0 ] : NULL ) : $form_objects;
		}
		
		/**
		 * Valida a existência de um I'ndice em um array
		 *
		 * @param array $array array alvo
		 * @param string|integer $index I'ndice a ser validado
		 * @return string Se o i'ndice existir, o seu valor, caso contra'rio, vazio.
		 */
		private static function issetIndexTo( array $array, $index ) {
			return isset( $array[ $index ] ) ? $array[ $index ] : '';
		}
	}	
?>