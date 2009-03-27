<?php
   /**
     * Classe SpeedForm.class.php
     * @author Moise's Sena
     * @version 1.0 - 2008-11-03
     * <sena.andromeda@gmail.com>
     * 
     * Permite a criaçao de Formularios HTML Dinâmicos
     */
	 
	/**
	  *	Depois da documentaçao
	  * Segue um bom exemplo de uso da Class
	 */

	/*
		USAGE:
			
			PROPERTIES:
			    
			    $sf->list             = true; // permite que o formulario seja criado usando listas nao-ordenadas
				$sf->new_line         = false; // add "<br>" to end
				$sf->new_line_content = '<div style="clear:both;" />'
	            $sf->char_sep         = ':'; // to end Label
				$sf->label_title      = true; // permite que o label tenha ou nao o attributo title igual ao objeto referenciado
				
				// to LI diff
				$sf->class_list_even  = 'myclass_even';
				$sf->class_list_odd   = 'myclass_odd';
			
			METHODS:
				
				FORM / FORMFILE:
					
					FormFile :
						Funciona como o metodo Form, pore'm adiciona o atributo "enctype" com value "multipart/form-data"
					
					SINTAXE:
						*	$sf->FormFile( $action:string, $method:string ) {*}
						*		or
						*	op 1. $sf->Form( $action:string, $method:string ) {*}
						*		or
						*	op 2. $sf->Form( $action:string, $method:string, $contents:string[HTML], $return:boolean{false} )
						*		or
						*	op 3. $sf->Form( $attributes:array[assoc], $contents:string[HTML], $return:boolean{false} )
						
					
					EXEMPLES:
					
						op 1:
						
							$sf = new SpeedForm();
							$sf->Form( 'recepty.php', 'POST' );
							$sf->Text( 'Name', 'name', 'Insert to name' );
							
							echo $sf->Create();
								// or
							$sf->PrintForm();
						_______________________________________________
						
						op 2:
						
							$sf = new SpeedForm();
							$sf->Form( 
								'recepty.php', 
								'POST', 
								$sf->Text( 'Name', 'name', 'Insert to name' )
							);
							
							echo $sf->Create();
								// or
							$sf->PrintForm();
						_______________________________________________
						
						op 2 ( $return = true ) :
						
							$sf = new SpeedForm();
							$myForm = $sf->Form( 
								'recepty.php', 
								'POST', 
								$sf->Text( 'Name', 'name', 'Insert to name' ),
								true
							);
							
							echo $myForm;
						_______________________________________________
						
						op 3 :
						
							$sf = new SpeedForm();
							$sf->Form( 
								array( 
									'target' => 'myIframe',
									'action' => 'recepty.php',
									'method' => 'POST',
									'class' => 'myFormClass'
								), 
								$sf->Text( 'Name', 'name', 'Insert to name' )
							);
							
							echo $sf->Create();
								// or
							$sf->PrintForm();
						_______________________________________________
						
						op 3 ( $return = true ) :
						
							$sf = new SpeedForm();
							$myForm = $sf->Form( 
								array( 
									'target' => 'myIframe',
									'action' => 'recepty.php',
									'method' => 'POST',
									'class' => 'myFormClass'
								), 
								$sf->Text( 'Name', 'name', 'Insert to name' ),
								true
							);
							
							echo $myForm;
						_______________________________________________
						
					{*}	armazena numa variavel a tag form, enquanto vai setando os objetos,
						para depois recupera-los com "$sf->Create()" ou "$sf->PrintForm()"
						
						
				TEXT:
					
					SINTAXE :
					
						*	op 1. Text( label:string, name:string, title:string, maxlength:number, value:string )
						*		or
						* 	op 2. Text( label:string, attributes:array[assoc], label_attributes:array[assoc] )
						*		or
						*	op 3. Text( array( args op1 ):numeric, array( args op1 ):numeric [...] )
						*		or
						*	op 4. Text( array( args op2 ):numeric, array( args op2 ):numeric [...] )
									
					EXAMPLES :
						
						$sf->Text( 'Text1', 'my_name', 'my_title', 10, 'my_value' )
						
						$sf->Text( 'Text2', array( 'name' => 'my_name2', 'class' => 'my_class2', 'value' => 'my_value2' ), array( 'class' => 'label_class2' ) )
						
						$sf->Text(
							array( 'Text3', array( 'name' => 'my_name4', 'title' => 'my_title3', 'value' => 'my_value3' ), array( 'class' => 'label_class3' ) )
							array( 'Text4', 'my_name4', 'my_title4', 15, 'my_value4' )
						)
						
				HIDDEN:
					
					SINTAXE :
					
						*	op 1. Hidden( $name:string, $value:string )
						*		or
						* 	op 2. Hidden( $name:string, $value:string, $attributes:array[assoc] )
						*		or
						*	op 3. Hidden( $array( args op1 or op2 ):numeric, array( args op1 or op2 ):numeric [...] )
									
					EXAMPLES :
						
						$sf->Hidden( 'my_name', 'my value' )
						
						$sf->Hidden( 'my_name2', 'my value 2', array( 'id' => 'myHidden' ) )
						
						$sf->Hidden(
							array( 'my_name', 'my value' ),
							array( 'my_name2', 'my value 2', array( 'id' => 'myHidden' ) )
						)
					
				IMAGE:
				
					SINTAXE :
					
						*	op 1. Image( $src:string, $title:string, $alt:string )
						*		or
						* 	op 2. Image( $src:string, $attributes:array[assoc] )
						*		or
						*	op 3. Image( $src( args op1 or op2 ):numeric, array( args op1 or op2 ):numeric [...] )
									
					EXAMPLES :
						
						$sf->Image( 'img.jpg', 'Click to submit', 'Send' )
						
						$sf->Image( 'img.jpg', array( 'id' => 'outer', 'onclick' => 'alert( "outer" );return false;' ))
						
						$sf->Image(
							array( 'img.jpg', 'Click to Submit', 'Send' ),
							array( 'img.jpg', array( 'id' => 'outer', 'onclick' => 'alert( "outer" );return false;' ))
						)
					
				BUTTON:
				
					SINTAXE :
					
						*	op 1. Button( $value:string, $title:string, $selector_class_id:string )
						*		or
						* 	op 2. Button( $value:string, $attributes:array[assoc] )
						*		or
						*	op 3. Button( $array( args op1 or op2 ):numeric, array( args op1 or op2 ):numeric [...] )
									
					EXAMPLES :
						
						$sf->Button( 'Cancel', 'Click to cancel', '#myId .myClass1 .myClass2' )
						
						$sf->Button( 'Outer', array( 'id' => 'outer', 'onclick' => 'alert( "outer" );' ))
						
						$sf->Button(
							array( 'Cancel', 'Click to cancel', '#myId .myClass1 .myClass2' ),
							array( 'Outer', array( 'id' => 'outer', 'onclick' => 'alert( "outer" );' ))
						)
					
				TAG BUTTON:
				
					SINTAXE :
					
						*	op 1. tgButton( $contents:string, $attributes:array[assoc] )
						*		or
						*	op 2. tgButton( $array( $contents:string, $attributes:array[assoc] ):numeric, arg1[...], $return_html:boolean{false} )
									
					EXAMPLES :
						
						$sf->Button( 'Outer', array( 'id' => 'outer', 'onclick' => 'alert( "outer" );' ))
						
						$sf->Button(
							array( 'Cancel', 'Click to cancel', '#myId .myClass1 .myClass2' ),
							array( 'Outer', array( 'id' => 'outer', 'onclick' => 'alert( "outer" );' ))
						)
					
				SUBMIT / RESET:
				
					SINTAXE :
					
						*	op 1. Submit( $value:string, $title:string, $selector_class_id:string )
						*		or
						* 	op 2. Submit( $value:string, $attributes:array[assoc] )
									
					EXAMPLES :
						
						$sf->Submit( 'Send', 'Click to Send Form', '#myId .myClass1 .myClass2' )
						
						$sf->Submit( 'Send', array( 'id' => 'send', 'class' => 'myClass' ) )
				
				CHECKBOX / OPTIONS:
					
					SINTAXE :
					
						*	op 1. Checkbox( array( $label:string, $attributes:array[assoc], $label_attributes:array[assoc] ):parms )
						*		or
						*	op 2. Checkbox( array( parms[op 1]:array, parms[op 1]:array ), $return_array:boolean{false} )
						*		or
						*	op 3. Checkbox( $text_group:string, array( parms[op 1]:array, parms[op 1]:array ), $return_array:boolean{false} )
									
					EXAMPLES :
					
						$sf->Checkbox( array( 'ChkBox1', array( 'id' => 'ChkBox1' ), array( 'id' => 'label_id1' )) )
						
						$sf->Checkbox(
							array(
								array( 'ChkBox4', array( 'id' => 'ChkBox4' ), array( 'id' => 'label_id4' ) ),
								array( 'ChkBox5', array( 'id' => 'ChkBox5' ), array( 'id' => 'label_id5' ) )
							)
						)
						
						$sf->Checkbox(
							array(
								array( 'ChkBox2', array( 'id' => 'ChkBox2' ), array( 'id' => 'label_id2' ) ),
								array( 'ChkBox3', array( 'id' => 'ChkBox3' ), array( 'id' => 'label_id3' ) )
							)
							,true
						)
						
						$sf->Checkbox(
							'My CheckBoxes Group 1',
							array(
								array( 'ChkBox6', array( 'id' => 'ChkBox6' ), array( 'id' => 'label_id6' ) ),
								array( 'ChkBox7', array( 'id' => 'ChkBox7' ), array( 'id' => 'label_id7' ) )
							)
						)
						
						$sf->Checkbox(
							array( 'My CheckBoxes Group 2', array( 'class' => 'chk_group' ), array( 'name' => 'test' ) ),
							array(
								array( 'ChkBox6', array( 'id' => 'ChkBox6' ), array( 'id' => 'label_id6' ) ),
								array( 'ChkBox7', array( 'id' => 'ChkBox7' ), array( 'id' => 'label_id7' ) )
							)
						)
						
						$sf->Checkbox(
							array( array( 'name' => 'test' ) ),
							array(
								array( 'ChkBox6', array( 'id' => 'ChkBox6' ), array( 'id' => 'label_id6' ) ),
								array( 'ChkBox7', array( 'id' => 'ChkBox7' ), array( 'id' => 'label_id7' ) )
							)
						)
						
						$sf->Radio(
							array( array( 'name' => 'sexo' ) ),
							array(
								array( 'ChkBox6', array( 'id' => 'ChkBox6' ), array( 'class' => 'ckb_class' ) ),
								array( 'ChkBox7', array( 'id' => 'ChkBox7' ), array( 'class' => 'ckb_class' ) )
							), true
						)
	                    
	            FILE:
	                
	                SINTAXE:
	                    
	                    *   op 1. File( $attributes:array[assoc] )
	                    *       or
	                    *   op 2. File( $label:string, $name:string, $max_file_size:numeric[bytes], $label_attributes:array[assoc])
	                    *       or
	                    *   op 3. File( $label:string, $attributes:array[assoc], $max_file_size:numeric[bytes], $label_attributes:array[assoc] )
	                
	                EXAMPLES:
	                    
	                    $sf->File( array( 'id' => 'label_id', 'class' => 'class1 class2', 'name' => 'my_file' ) )
	                    
	                    $sf->File( 'My File', 'filedata', 1024, array( 'id' => 'label_id' ) )
	                    
	                    $sf->File( 'My File', array( 'id' => 'file_id', 'name' => 'my_file' ), 1024, array( 'id' => 'label_id' ) )
				
				TEXTAREA:
					
					SINTAXE:
						
						*	op 1. Textarea( $attributes:array[assoc] )
						*		or
						*	op 2. Textarea( $label:string, $attributes:array[assoc], $label_attributes:array[assoc] )
						
					EXAMPLES:
						
						$sf->Textarea( array( 'cols'=>100, 'rows'=>30 ) )
						
						$sf->Textarea( 'My Textarea', array( 'cols'=>100, 'rows'=>30 ), array( 'id' => 'label_id' ) )
				
				SELECT:
				
					SINTAXE:
					
						*   op 1. Select( 
						*   	$label:string,  
						*   	$data:array,  
						*   	$attributes:array[assoc],  
						*   	$selected:string|number,  
						*   	$init:array|string,  
						*   	$opt_attr:array[assoc]  
						*   )
					
					EXAMPLES:
						
						// Normal
						$sf->Select(
							'my Select',
							array( 1, 2, 3, 4, 5 ),
							array( 'id' => 'meu_select', 'class' => 'myclass myclass2' ),
							3,
							'SELECIONE',
							array( 'onclick' => 'javascript:alert( this.value );' )
						)
						
						// Value, Text
						$sf->Select(
							'my Select',
							array(
								array( 'a', 1 ),
								array( 'b', 2 ),
								array( 'c', 3 )
							),
							array( 'id' => 'meu_select', 'class' => 'myclass myclass2' ),
							'c',
							'SELECIONE',
							array( 'onclick' => 'javascript:alert( this.value );' )
						)
						
						// Groups
						$sf->Select(
							'my Select',
							array(
								array( 'grupo 2', 3, 'text3' ),
								array( 'grupo 2', 4, 'text4' ),
								array( 'grupo 1', 1, 'text1' ),
								array( 'grupo 1', 2, 'text2' ),
								array( 'grupo 2', 5, 'text5' ),
								array( '', 6, 'text6' ),
								array( '', 7, 'text7' )
							),
							array( 'id' => 'meu_select', 'class' => 'myclass myclass2', 'title' => 'selecione um dos Itens' ),
							3,
							'SELECIONE',
							array( 'onclick' => 'javascript:alert( this.value );' )
						)
				
				PARENT CHECKBOX OU RADIO :
					
					Adiciona uma tag pai ao input checkbox e radio:
					
						* <span>
						*	<input type="checkbox" />
						* </span>
					
					SINTAXE:
						
						* op 1. parentCheckAndRadio( $tag:string, $attributes:array[assoc] );
						*		or
						* op 2. parentCheckAndRadio( $attributes:array[assoc] );
					
					EXAMPLES:
						
						$sf->parentCheckAndRadio( array( 'class' => 'check_radio' ) );
						
						$sf->parentCheckAndRadio( 'div', array( 'class' => 'check_radio' ) );
				
				
				SET LIST ATTRIBUTES :
				
					Adiciona attributos à lista de conteúdo do Formulario
					
						SINTAXE:
						
							*
							*	setListAttributes( $attributes:array[assoc] );
							*
							
						EXAMPLE:
							
							$sf->setListAttributes( array( 'class' => 'obricatorio' ) );
				
				
				SET REQUIRED ATTRIBUTES :
				
					Adiciona attributos específicos à um objeto cujo label começa com "*"
					
						SINTAXE:
						
							*
							*	setRequiredAttributes( $attributes:array[assoc] );
							*
							
						EXAMPLE:
							
							$sf->setRequiredAttributes( array( 'class' => 'obricatorio' ) );
							
				
				SET CHECK RADIO GROUP LABEL:
					
					Define uma Tag e adiciona Attributos à tag do Label de Grupos de Checkbox e Radios
					
						* <span class="check_group">
						*	Checkbox Group
						* </span>
					
					SINTAXE:
						
						* op 1. setCheckRadioGroupLabel( $tag:string, $attributes:array[assoc] );
						*		or
						* op 2. setCheckRadioGroupLabel( $attributes:array[assoc] );
					
					EXAMPLES:
						
						$sf->setCheckRadioGroupLabel( array( 'class' => 'check_radio' ) );
						
						$sf->setCheckRadioGroupLabel( 'div', array( 'class' => 'check_radio' ) );
	*/
	
	/**
	
		EXAMPLE:
					
			<?php
				
				include_once( 'SpeedForm.class.php5' );
				
				$sf = new SpeedForm();
				$sf->list             = true;
				$sf->class_list_even  = 'alter';
				$sf->class_list_odd   = 'noalter';
				$sf->new_line_content = '<div style="clear:both;" />';
				
				$sf->parentCheckAndRadio( array( 'class' => 'check_radio' ) );
				$sf->setRequiredAttributes( array( 'class' => 'obrigatorio' ) );
				$sf->setListAttributes( array( 'class' => 'minha_lista' ) );
				$sf->setCheckboxGroupLabel( 'span', array( 'class' => 'chk_group' ) );
				$sf->setRadioGroupLabel( 'span', array( 'class' => 'chk_group' ) );
				$f = $sf->FormFile(
					'data.php',
					'POST',
					$sf->Contents(
						$sf->Group(
							'My Selects',
							'', '',
							$sf->Select(
								'*my Select',
								array(
									array( 'a', 1 ),
									array( 'b', 2 ),
									array( 'c', 3 )
								),
								array( 'id' => 'meu_select', 'class' => 'myclass myclass2' ),
								'',
								'SELECIONE',
								array( 'onclick' => 'javascript:alert( this.value );' )
							),
							$sf->Select(
								'*my Select',
								array( 'Primeiro', 'Segundo', 'Terceiro', 'Quarto' ),
								'',
								'Primeiro',
								'SELECIONE',
								array( 'onclick' => 'javascript:alert( this.value );' )
							),
							$sf->Select(
								'*my Select',
								array(
									array( 'a', 1 ),
									array( 'b', 2 ),
									array( 'c', 3 )
								),
								'',
								'c',
								'SELECIONE',
								array( 'onclick' => 'javascript:alert( this.value );' )
							)
						),
						$sf->Group(
							'Outer',
							'', '',
							$sf->Checkbox(
								array( 'Descendência:', '', array( 'name' => 'data' ) ),
								array(
									array( 'Afro', '', array( 'class' => 'ckb_class' ) ),
									array( 'Inglês', '', array( 'class' => 'ckb_class' ) )
								), true
							),
							$sf->Radio(
								array( 'Sexo:', array( 'class' => 'chk_group outer_group' ), array( 'name' => 'sexo' ) ),
								array(
									array( 'Masculino', '', array( 'class' => 'ckb_class' ) ),
									array( 'Feminino', '', array( 'class' => 'ckb_class' ) )
								), true
							)
						),
						$sf->Group(
							'Files',
							'', '',
							$sf->File( array( 'id' => 'label_id', 'class' => 'class1 class2', 'name' => 'my_file' ) ),
							$sf->File( '*My File', 'filedata', 1024, array( 'id' => 'label_id' ) ),
							$sf->File( '*My File 2', array( 'id' => 'file_id', 'name' => 'my_file' ), 1024, array( 'id' => 'label_id' ) )
						),
						$sf->Group(
							'Textarea',
							'', '',
							$sf->Textarea( array( 'cols' => 60, 'rows' => 2 ) ),
							$sf->Textarea( '*My Textarea', array( 'cols' => 60, 'rows' => 2 ), array( 'id' => 'label_id', 'class' => 'textarea' ) ),
							$sf->Textarea( array( 'cols' => 60, 'rows' => 2, 'value' => 'Conteúdo do Textarea' ) ),
							$sf->Textarea( '*My Textarea 2', array( 'cols' => 60, 'rows' => 2, 'value' => 'Conteúdo do Textarea 2' ), array( 'id' => 'label_id', 'class' => 'textarea' ) )
						),
						$sf->Group(
							'My Texts',
							'', '',
							$sf->Text( '*Text1', 'my_name', 'my_title', 10, 'my_value' ).'<span>Maximo de 10 caracters</span>',
							$sf->Text( '*Text2', array( 'name' => 'my_name2', 'class' => 'my_class2', 'value' => 'my_value2' ), array( 'class' => 'label_class2' ) ),
							$sf->Text( '*Text3', '', array( 'class' => 'datas' ) ),
							$sf->Text(
								array( '*Text4', array( 'name' => 'my_name4', 'title' => 'my_title4', 'value' => 'my_value4' ), array( 'class' => 'label_class4' ) ),
								array( '*Text5', 'my_name5', 'my_title5', 12, 'my_value5' )
							),
							$sf->Text(
								array( '*Dados', 'meu_nome', 'meu_titulo', '111111111111' ),
								array( '*Dados1', 'meu_nome2', 'meu_titulo2', '2222222' ),
								array( '*Dados2', 'meu_nome3', 'meu_titulo3', '33333333' ),
								array( '*Dados3', 'meu_nome4', 'meu_titulo4', '44444444444' )
							),
							'<div style="text-align:center">'.
							$sf->Button(
								array( 'Enviar', array( 'id' => 'meu_button' ) ),
								array( 'Cancelar', 'Clicque para cancelar', '#meuId .class1 .class2' )
							).
							$sf->Submit( 'Salvar', 'Clique para salvar os seus Dados', '#meuId .class1 .class2' ).
							$sf->Reset( 'Limpar', 'Clique para limar o formulario', '#meuId .class1 .class2' )
							.'</div>'
						),
						$sf->Hidden( array( 'name' => 'label_id' ) ),
						$sf->Hidden( array( 'nome', 'Moises' ), array( 'sobrenome', 'Sena' ), array( 'Idade', 18 ) )
					)
				);
				
			?>
			<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
				<head>
					<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
					<title>SpeedForm</title>
					<style type="text/css">
									
						*{
							font-family:Verdana, Geneva, sans-serif;
						}
						.alter {
							background:#eee;
						}
						.noalter {
							background:#white;
						}
						
						input[type=text] {
							border:1px solid #999;
							width:200px;
							margin:2px 0;
						}
						
						UL.minha_lista {
							list-style:none;
							margin:0;
							padding:5px;
						}
						
						UL.minha_lista LI {
							padding:2px;
							height:100%;
						}
						
						fieldset {
							border:2px solid #CCC;
							padding:0;
						}
						
						legend {
							color:#666;
							font-weight:bold;
							font-size:14px;
							margin-left:5px;
						}
						
						label {
							font-size:12px;
							display:block;
							width:150px;
							background:#ddd;
							padding:5px 2px;
							float:left;
							text-align:right;
							margin-right:3px;
							font-weight:bold;
							color:#666;
						}
						
						.check_radio {
							float:left;
							display:block;
							height:21px;
							padding-top:3px;
							background:#ddd;
							margin-right:2px;
						}
						
						.chk_group {
							font-weight:bold;
							font-size:13px;
							color:#666;
							padding-top:5px;
						}
						
						.ckb_class {
							text-align:left;
							float:left;
							background:none;
						}
						
						span {
							font-size:11px;
						}
						
						label.textarea {
							text-align:left;
							background:transparent;
						}
						
						label span {
							color:red;
							font-weight:bold;
						}
						
						.obrigatorio {
						}
						
					</style>
				</head>
				<body>
					<?php
						$sf->PrintForm();
					?>
				</body>
			</html>


	*/
    
	class SpeedForm {
		
		/**
		 * Lista nos Fieldsets
		 *
		 * Permite ou nao que os itens dos Fieldsets seja armazenados em uma lista.
		 * Isto permite que tais itens possam ser visualmente mais bem trabalhados com CSS
		 * @var boolean
		 */
		private $list = false;
		
		/**
		 * Atributos da Listas nos Fieldsets
		 *
		 * @var array
		 */
		private $list_attributes = array();
		
		/**
		 * Valor do atributo "class" do item de i'ndice PAR da lista nos Fieldsets
		 *
		 * @var string
		 */
		private $list_even_class_name = '';
		
		/**
		 * Valor do atributo "class" do item de i'ndice I'MPAR da lista nos Fieldsets
		 *
		 * @var string
		 */
		private $list_odd_class_name = '';
		
		/**
		 * Lista no Formula'rio
		 *
		 * Permite ou nao que os childs do Formula'rio sejam renderizados em forma de lista.
		 * Isto permite que tais itens possam ser visualmente mais bem trabalhados com CSS
		 * @var boolean
		 */
		private $list_root = false;
		
		/**
		 * Atributos da Lista no Formula'rio
		 *
		 * @var array
		 */
		private $list_root_attributes = array();
		
		/**
		 * Define o valor do atributo "class" para os itens de i'ndice PAR da lista no Formula'rio
		 *
		 * @param string $class_name
		 * @return void
		 */		
		private $list_root_even_class_name = '';
		
		/**
		 * Valor do atributo "class" do item de i'ndice I'MPAR da lista no Formula'rio
		 *
		 * @var string
		 */
		private $list_root_odd_class_name = '';
		
		/**
		 * Permite ou nao que haja a cricao de quebra de linha automa'tica entre os itens do Formula'rio
		 *
		 * @var boolean
		 */
		private $new_line = true;
		
		/**
		 * Co'digo HTML responsa'vel pela quebra de linha automa'tica entre os itens do Formula'rio
		 *
		 * @var string
		 */
		private $new_line_content = '<br style="clear:both;" />';
		
		/**
		 * Caractere de Separacao entre Label e Input
		 *
		 * @var string
		 */
		private $char_sep = ':';
		
		/**
		 * Permissao de Adicionar o atributo title ao Label para que 
		 * este seja exatamente igual ao do Objeto cujo Label se Refere
		 *
		 * @var boolean
		 */
		private $label_title = true;
		
		/**
		 * Permissao para adicionar ou nao um separador entre
		 * o rotulo e o campo, por defaul, TRUE
		 * 
		 * @var boolean
		 */
		private $set_sep = true; 
		
		/**
		 * Propriedades do Parent do input Checkbox
		 *
		 * @var array
		 */
		private $parent_checkbox = '';
		
		/**
		 * Propriedades do Parent do input Radio
		 *
		 * @var array
		 */
		private $parent_radio = '';
		
		/**
		 * Propriedades do Label do Grupo de Checkbox
		 *
		 * @var array
		 */
		private $checkbox_group_label = array( 'div', array() ); 
		
		/**
		 * Propriedades do Label do Grupo de Radio
		 *
		 * @var array
		 */
		private $radio_group_label = array( 'div', array() );
		
		/**
		 * Atributos padroes para os objetos obrigato'rios
		 *
		 * @var array associativo
		 */
		private $required_attributes = array();
		
		/**
		 * Propriedades da Tag que conte'm o Asterisk do Label dos objetos obrigato'rios
		 *
		 * @var array numeric
		 */
		private $required_asterisk = '';
		
		// private
		
		// Dados
		private $var_contents         = '{CONTENTS}';
		
		private $datas                    = array(); // array com todo o HTML
		private $new_form                 = ''; // Form HTML
		private $new_legend               = ''; // legend HTML
		
		/**
		 * Construtor
		 * @return unknown_type
		 */
		public function __construct() {
			$this->setRequiredAsterisk();
		}
		
		/**
		 * Define a permissao de criacao de lista nos Fieldsets
		 *
		 * @param boolean $create_list
		 * @return void
		 */
		public function setList( $create_list = true ) {
			$this->list = $create_list;
		}
		
		/**
		 * Define os Attributos da Lista nos Fieldsets
		 * 
		 * @param array $attributes attributos
		 * @return void
		 */
		public function setListAttributes( $attributes = array() ) {
			$this->list_attributes = $attributes;
		}
		
		/**
		 * Define o valor do atributo "class" para os itens de i'ndice PAR da lista nos Fieldsets
		 *
		 * @param string $class_name
		 * @return void
		 */		
		public function setListEvenClassName( $class_name ) {
			$this->list_even_class_name = $class_name;
		}
		
		/**
		 * Define o valor do atributo "class" para os itens de i'ndice I'MPAR da lista nos Fieldsets
		 *
		 * @param string $class_name
		 * @return void
		 */
		public function setListOddClassName( $class_name ) {
			$this->list_odd_class_name = $class_name;
		}
		
		/**
		 * Define a permissao de criacao de lista no Formula'rio
		 *
		 * @param boolean $create_list
		 * @return void
		 */
		public function setListRoot( $create_list = true ) {
			$this->list_root = $create_list;
		}
		
		/**
		 * Define os Attributos da Lista no Formula'rio
		 * 
		 * @param array $attributes attributos
		 * @return void
		 */
		public function setListRootAttributes( $attributes = array() ) {
			$this->list_root_attributes = $attributes;
		}
		
		/**
		 * Define o valor do atributo "class" para os itens de i'ndice PAR da lista no Formula'rio
		 *
		 * @param string $class_name
		 * @return void
		 */		
		public function setListRootEvenClassName( $class_name ) {
			$this->list_root_even_class_name = $class_name;
		}
		
		/**
		 * Define o valor do atributo "class" para os itens de i'ndice I'MPAR da lista no Formula'rio
		 *
		 * @param string $class_name
		 * @return void
		 */
		public function setListRootOddClassName( $class_name ) {
			$this->list_root_odd_class_name = $class_name;
		}
		
		/**
		 * Permite ou nao a quebra de linha automa'tica entre os objetos do Formula'rio
		 *
		 * @param boolean $new_line
		 * @return void
		 */
		public function setNewLine( $new_line = true ) {
			$this->new_line = $new_line;
		}
		
		/**
		 * Define o Co'digo HTML resposa'vel pela quebra de linha automa'tica
		 *
		 * @param string $content
		 * @return void
		 */
		public function setNewLineContent( $content ) {
			$this->new_line_content = $content;
		}
		
		/**
		 * Define o parent para o input checbox
		 * 
		 * @tag string nome da tag
		 * @attributes array attributos
		 * @return void
		 */
		public function setParentCheckbox( $tag = 'span', $attributes = array() ) {
			if( is_array( $tag ) ) {
				$attributes = $tag;
				$tag = 'span';
			}
			$this->parent_checkbox = $this->createTag( $tag, $attributes, $this->var_contents );
		}
		
		/**
		 * Define o parent para o input Radio
		 * 
		 * @tag string nome da tag
		 * @attributes array attributos
		 * @return void
		 */
		public function setParentRadio( $tag = 'span', $attributes = array() ) {
			if( is_array( $tag ) ) {
				$attributes = $tag;
				$tag = 'span';
			}
			$this->parent_radio = $this->createTag( $tag, $attributes, $this->var_contents );
		}
		
		/**
		 * Define a Tag e os Attributos do Label de grupos de Checkbox
		 * 
		 * @tag string nome da tag
		 * @attributes array attributos
		 * @return void
		 */
		public function setCheckboxGroupLabel( $tag = 'div', $attributes = array() ) {
			if( is_array( $tag ) ) {
				$attributes = $tag;
				$tag = 'div';
			}
			$this->checkbox_group_label = array( $tag, $attributes, '*' );
		}
		
		/**
		 * Define a Tag e os Attributos do Label de grupos de Radios
		 * 
		 * @tag string nome da tag
		 * @attributes array attributos
		 * @return unknown_type
		 */
		public function setRadioGroupLabel( $tag = 'div', $attributes = array() ) {
			if( is_array( $tag ) ) {
				$attributes = $tag;
				$tag = 'div';
			}
			$this->radio_group_label = array( $tag, $attributes, '*' );
		}
		
		/**
		 * Define o parent para o Asterisk do Label
		 * 
		 * @tag string nome da tag
		 * @attributes array attributos
		 * @return unknown_type
		 */
		public function setRequiredAsterisk( $tag = 'span', $attributes = array() ) {
			if( is_array( $tag ) ) {
				$attributes = $tag;
				$tag = 'span';
			}
			$this->required_asterisk = $this->createTag( $tag, $attributes, '*'	);
		}
		
		/**
		 * Define os Attributos padroes para inputs obrigato'rios
		 * 
		 * @attributes array attributos
		 * @return unknown_type
		 */
		public function setRequiredAttributes( $attributes = array() ) {
			$this->required_attributes = $attributes;
		}
		
		/**
		 * Define o Caractere de Separacao entre Label e Input
		 *
		 * @param string $char_sep
		 */
		public function setCharSep( $char_sep = ':' ) {
			$this->char_sep = $char_sep;
		}
		
		/**
		 * Define a Permissao de Adicionar o atributo title ao Label para que este seja exatamente igual ao do Objeto cujo Label se Refere
		 *
		 * @param boolean $permission
		 */
		public function setLabelTitle( $permission = true ) {
			$this->label_title = $permission;
		}
		
		/**
		 * Inicializa a criacao de um novo formula'rio
		 * 
		 * @return string
		 */
		public function Form() {
			$args = func_get_args();
			return $this->formArguments( $args );
		}
		
		/**
		 * Inicializa a criacao de um novo formula'rio definindo o atributo Encitype como multipart/form-data
		 * 
		 * @return string
		 */
		public function FormFile() {
			$args = func_get_args();
			return $this->formArguments( $args, true );
		}
		
		/**
		 * Valida os Argumentos dos methods Form e FormFile
		 * 
		 * @return unknown_type
		 */
		private function formArguments( $args = array(), $file = false ) {
			if( is_array( $args[ 0 ] ) ) {
				if( $file ) $args[ 0 ][ 'enctype' ] = 'multipart/form-data';
				if( $this->isStringIndex( $args, 1 ) && $content = $args[ 1 ] ) {
					if( $this->isBoolIndex( $args, 2 ) && $args[ 2 ] ) return $this->createTag( 'form', $args[ 0 ], $content );
					else $this->new_form = $this->createTag( 'form', $args[ 0 ], $content );
				}
				else $this->new_form = $this->createTag( 'form', $args[ 0 ], $this->var_contents );
			}
			else if( $this->isStringIndex( $args, 0 ) && $this->isStringIndex( $args, 1 ) ) {
				$attributes[ 'action' ] = $args[ 0 ];
				$attributes[ 'method' ] = $args[ 1 ];
				
				if( $file ) $attributes[ 'enctype' ] = 'multipart/form-data';
				
				if( $this->isStringIndex( $args, 2 ) && $content = $args[ 2 ] ) {
					if( $this->isBoolIndex( $args, 3 ) && $args[ 3 ] ) return $this->createTag( 'form', $attributes, $content );
					else $this->new_form = $this->createTag( 'form', $attributes, $content );
				}
				else
					$this->new_form = $this->createTag( 'form', $attributes, $this->var_contents );
			}
		}
        
		/**
		 * Retorna o HTML do Formula'rio
		 * 
         * @return string HTML
		 */
        public function Create() {
            return str_replace(
				$this->var_contents,
				implode( '', $this->datas ),
				$this->new_form
			);
        }
        
        /**
         * Imprime o HTML do Formula'rio na pa'gina
         *  
         * @return void
         */
        public function PrintForm() {
            echo $this->Create();
        }
        
		/**
		 * Cria o HTML renderizando em forma de lista
		 *
		 * @param string $html_1 HTML
		 * @param string $html_2 HTML
		 * @param string $html_n HTML
		 * @return string HTML
		 */
		public function Contents( $html_1 = '', $html_2 = '', $html_n = '' ) {
			$args         = func_get_args();
			$last_arg     = $args[ count( $args )-1 ];
			$return_array = NULL;
			$hidden = '';
			
			if( gettype( $last_arg ) == 'boolean' ) {
				$return_array = $last_arg;
				array_pop( $args );
			}
			
			if( is_array( $args[ 0 ] ) ) $args = $args[ 0 ];
			
			if( isset( $args[ 'HIDDEN' ] ) && !is_null( $return_array ) && !$return_array ) {
				$hidden = $args[ 'HIDDEN' ];
				unset( $args[ 'HIDDEN' ] );
				if( is_array( $hidden ) ) $hidden = implode( '', $hidden );
			}
			
			$ret = is_null( $return_array ) ? implode( '', $args ) : ( $return_array ? $args : $this->formList( $args, true, true, true ).$hidden );
			
			if( is_string( $ret ) ) {
				$func = create_function( '$match', 'return "\n\t" . $match . "\n\t";');
				$ret = preg_replace( "/(<[^<]+>)/e",'$func("\\1")', $ret);
				$ret = preg_replace( "/(\n\t)+/","\\1", $ret);
			}
			
			return $ret;
		}
		
		/**
		 * Cria Fieldset personalizado
		 *
		 * @param string $legend
		 * @param array $legend_attributes
		 * @param array $fieldset_attributes
		 * @return string conteu'do HTML
		 */
		public function Group( $legend = '', $legend_attributes = array(), $fieldset_attributes = array() ) {
			$args     = func_get_args();
			$contents = array();
			$qnt_args = count( $args );
			$return   = false;
			$lastArg  = false;
			$alastArg = true;
			$list     = true;
			if( $qnt_args > 3 ) {
				$contents     = array_slice( $args, 3 );
				$new_contents = array();
				$lastArg      = $args[ count( $args )-1 ];
				$alastArg     = $args[ count( $args )-2 ];
				
				if( gettype( $lastArg ) == 'boolean' ) {
					array_pop( $contents );
					$return = $lastArg;
				
					if( gettype( $alastArg ) == 'boolean' ) {
						array_pop( $contents );
						$list = $alastArg;
					}
				}
				
				foreach( $contents as &$v ) 
					if( is_array( $v ) ) foreach( $v as &$c )$new_contents[] = $c;
					else $new_contents[] = $v;
					
				if( count( $new_contents ) != 0 ) $contents = $new_contents;
			}
			
			$content = $this->createTag( 
				'fieldset', 
				$this->isIssetIndexTo( $args, 2 ), 
				$this->createTag( 'legend', 
					$this->isIssetIndexTo( $args, 1, '' ), 
					$this->isIssetIndexTo( $args, 0, '' )
				).
				$this->formList( $contents , true, $list )
			);
			
			if( !$return )$this->datas[] = $content;
			return $content;
		}
		
		/**
		 * Cria um ou va'rios inputs do tipo Text
		 * 
         * @return XHTML:string or array
		 */
        public function Text() {
            $args = func_get_args();
			$type = 'text';
			
			if( is_array( $args[ 0 ] ) ) {
				$inputs = array();
				
				foreach( $args as $v ) {
					$inputs[] = $this->Text( 
						$this->isIssetIndexTo( $v, 0 ), 
						$this->isIssetIndexTo( $v, 1 ),
						$this->isIssetIndexTo( $v, 2 ),
						$this->isIssetIndexTo( $v, 3 ),
						$this->isIssetIndexTo( $v, 4 , array() )
					);
				}
				
				return $inputs;
			}
			else if( $this->isStringIndex( $args, 1 ) && !empty( $args[ 1 ] ) ) {
				$args[ 0 ]  = $this->isStringIndexTo( $args, 0 );
				$attributes = array( 'type' => $type, 'name' => $args[ 1 ] );
				if( $this->isStringIndex( $args, 2 ) ) $attributes[ 'title' ] = $args[ 2 ];
				if( $this->isStringIndex( $args, 3 ) || $this->isNumberIndex(  $args, 3  ) ) $attributes[ 'maxlength' ] = $args[ 3 ];
				if( $this->isStringIndex( $args, 4 ) ) $attributes[ 'value' ] = $args[ 4 ];
				
				$label_attributes = $this->isArrayIndexTo( $args, 2 );
				
				if( $this->label_title && isset( $attributes[ 'title' ] ) ) $label_attributes[ 'title' ] = $attributes[ 'title' ];
				
				if( $required = $this->checkRequired( $args[ 0 ], $attributes ) ) {
					$args[ 0 ]  = $required[ 0 ];
					$attributes = $required[ 1 ];
				}
				
				return $this->Input( 
					$args[ 0 ], 
					$attributes, 
					$label_attributes 
				);
			}
			else {
				$args[ 0 ]        = $this->isStringIndexTo( $args, 0 );
				$attributes       = array_merge( $this->isArrayIndexTo( $args, 1 ), array( 'type' => $type ) );
				$label_attributes = $this->isArrayIndexTo( $args, 2 );
				
				if( $this->label_title && isset( $attributes[ 'title' ] ) ) $label_attributes[ 'title' ] = $attributes[ 'title' ];
				
				if( $required = $this->checkRequired( $args[ 0 ], $attributes ) ) {
					$args[ 0 ]  = $required[ 0 ];
					$attributes = $required[ 1 ];
				}
				
				return $this->Input( 
					$args[ 0 ], 
					$attributes, 
					$label_attributes 
				);
			}
        }
        
        /**
         * Cria um ou varios inputs do tipo Hidden
         * 
         * @param $attributes
         * @return XHTML:string
         */
        public function Hidden( $name = '', $value = '' ) {
            $attributes[ 'type' ]  = 'hidden';
            $attributes[ 'style' ] = 'position:absolute;left:-50000px;';
			$args = func_get_args();
			
			if( $this->isStringIndex( $args, 0 ) ) {
				$attributes[ 'name' ] = $args[ 0 ];
				if( $this->isStringOrNumberIndex( $args, 1 ) ) $attributes[ 'value' ] = $args[ 1 ];
				if( $this->isArrayIndex( $args, 2 ) ) $attributes = array_merge( $args[ 2 ], $attributes );
			}
			else if( $this->isArrayIndex( $args, 0 ) ) {
				$elems = array();
				foreach( $args as $v ) {
					$elems[] = $this->Hidden( 
						$this->isStringIndexTo( $v, 0 ), 
						$this->isStringOrNumberIndexTo( $v, 1 ), 
						$this->isArrayIndexTo( $v, 2 ) 
					);
				}
				
				return implode( '', $elems );
			}
			
            return $this->Input( $attributes );
        }
        
        /**
         * Cria um Input do tipo Submit
         * 
         * @param $label
         * @param $attributes
         * @param $selector_class_id
         * @return XHTML:string
         */
        public function Submit( $label, $attributes = array(), $selector_class_id = '' ) {
            if( is_string( $attributes ) ) $attributes = array( 'title' => $attributes );
            $attributes[ 'type' ]  = 'submit';
            $attributes[ 'value' ] = $label;
            if( !empty( $selector_class_id ) ) $attributes = array_merge( $attributes, $this->selectorClassId( $selector_class_id ) );
            return $this->Input( $attributes );
        }
        
        /**
         * Cria um Input do tipo Reset
         * 
         * @param $label
         * @param $attributes
         * @param $selector_class_id
         * @return XHTML:string
         */
        public function Reset( $label, $attributes = array(), $selector_class_id = '' ) {
            if( is_string( $attributes ) ) $attributes = array( 'title' => $attributes );
            $attributes[ 'type' ]  = 'reset';
            $attributes[ 'value' ] = $label;
            if( !empty( $selector_class_id ) ) $attributes = array_merge( $attributes, $this->selectorClassId( $selector_class_id ) );
            return $this->Input( $attributes );
        }
        
        /**
         * Cria um ou varios Buttons
         * 
         * @param $value
         * @param $attributes
         * @return XHTML:string
         */
        public function tgButton( $contents, $attributes = array()) {
			$args = func_get_args();
			
			if( is_array( $contents ) ) {
				$buttons = array();
				foreach( $args as $c )
					if( is_string( $c[ 0 ] ) && is_array( $c ) )
						$buttons[] = $this->tgButton( $c[ 0 ], $this->isArrayIndexTo( $c, 1 ) );
				
				if( is_bool( $contents[ count( $contents-1 ) ] ) && $contents[ count( $contents-1 ) ] ) return implode( '', $buttons );
				else return $buttons;
			}
			else return $this->createTag( 'button', $attributes, $contents );
        }
        
        /**
         * Cria um ou varios Inputs do tipo Button
         * 
         * @param $value
         * @param $attributes
         * @return XHTML:string
         */
        public function Button( $value, $attributes = array()) {
			$args = func_get_args();
            return $this->buttonOrImage( 'button', $args );
        }
        
        /**
         * Cria um ou varios Inputs do tipo Imagem
         * 
         * @param $src
         * @param $attributes
         * @return XHTML:string
         */
        public function Image( $src, $attributes = array()) {
			$args = func_get_args();
            return $this->buttonOrImage( 'image', $args );
        }
        
        /**
         * Cria um ou varios Inputs do tipo Button ou Imagem
         * 
         * @param $type
         * @param $args
         * @return XHTML:string
         */
        private function buttonOrImage( $type, $args ) {
			$label      = $args[ 0 ];
			$attributes = $args[ 1 ];
			$attr_value = $type == 'button' ? 'value' : 'src';
            if( is_array( $label ) ) {
                $inputs = array();
                $sep    = '';
                
                if( is_string( $args[ count( $args )-1 ] ) ) {
                    $sep = $args[ count( $args )-1 ];
                    array_pop( $args );
                }
                
                foreach( $args as $v ) {
                    if( $this->isStringIndex( $v, 1 ) && !empty( $v[ 1 ] ) ) {
                        $attributes = array( 'type' => $type, $attr_value => $v[ 0 ] );
                        if( $this->isStringIndexTo( $v, 1 ) ) $attributes[ 'title' ] = $v[ 1 ];
                        if( $this->isStringIndexTo( $v, 2 ) ) $attributes = array_merge( $attributes, $this->selectorClassId( $v[ 2 ]) );
                        $inputs[] = $this->Input( $attributes );
                    }
                    else{
                        $attributes = $this->isArrayIndexTo( $v, 1 );
                        $attributes[ 'type' ]  = $type;
                        $attributes[ $attr_value ] = $v[ 0 ];
                        $inputs[] = $this->Input( $attributes );
                    }   
                }
                return implode( $sep, $inputs );
            }
            else if ( $this->isStringIndex( $args, 1 ) && !empty( $args[ 1 ] ) ) {
                $attributes = array( 'type' => $type, $attr_value => $args[ 0 ] );
                if( $this->isStringIndexTo( $args, 1 ) ) $attributes[ 'title' ] = $args[ 1 ];
                if( $this->isStringIndexTo( $args, 2 ) ) $attributes = array_merge( $attributes, $this->selectorClassId( $v[ 2 ]) );
                return $this->Input( $attributes );
            }
            else {
                $attributes[ 'type' ]  = $type;
                $attributes[ $attr_value ] = $label;
                return $this->Input( $attributes );
            }
        }
        
        /**
         * Cria um ou varios Inputs do tipo Checkbox
         * 
         * @param $text_group
         * @param $elements
         * @param $to_array
         * @return XHTML:string or array
         */
        public function Checkbox( $text_group = '', $elements = false, $to_array = false ) {
            return $this->checkboxAndRadio( 'checkbox', $text_group, $elements, $to_array );
        }
        
        /**
         * Cria um ou varios Inputs do tipo Radio
         * 
         * @param $text_group
         * @param $elements
         * @param $to_array
         * @return XHTML:string or array
         */
        public function Radio( $text_group = '', $elements = false ,$to_array = false ) {
            return $this->checkboxAndRadio( 'radio', $text_group, $elements, $to_array );
        }
        
        /**
         * Cria um ou varios Inputs do tipo File
         * 
         * @param $label
         * @param $attributes
         * @param $max_file_size
         * @param $label_attributes
         * @return unknown_type
         */
        public function File( $label = '', $attributes = array(), $max_file_size = '', $label_attributes = array() ) {
            $args = func_get_args();
            $args[ 0 ] = $this->isIssetIndexTo( $args, 0 );
            $args[ 1 ] = $this->isIssetIndexTo( $args, 1, array() );
            $args[ 2 ] = $this->isIssetIndexTo( $args, 2 );
            $args[ 3 ] = $this->isIssetIndexTo( $args, 3, array() );
            
            if( is_array( $args[ 0 ] ) ) {
                $attributes = $args[ 0 ];
                $label = '';
                
                if( is_string( $args[ 1 ] ) || is_numeric( $args[ 1 ] ) ) $max_file_size = $args[ 1 ];
                if( is_array( $args[ 2 ] ) ) $label_attributes = $args[ 2 ];
				if( $this->label_title && isset( $attributes[ 'title' ] ) ) $label_attributes[ 'title' ] = $attributes[ 'title' ];
            }
            
            if( is_string( $attributes ) )$attributes = array( 'name' => $attributes );
			
            $attributes[ 'type' ] = 'file';
			
			if( $required = $this->checkRequired( $label, $attributes ) ) {
				$label  = $required[ 0 ];
				$attributes = $required[ 1 ];
			}
            
            return ( 
                !empty( $max_file_size ) ? 
                    $this->Hidden( array( 'name' => 'MAX_FILE_SIZE', 'value' => $max_file_size ) )
                : 
                    ''
                ).
                $this->Input( $label, $attributes, $label_attributes );
        }
        
        /**
         * Cria um Textarea
         * 
         * @param string $attributes_or_label
         * @param array $attributes_input
         * @param array $label_attributes
         * @return string HTML
         */
        public function Textarea( $attributes_or_label = array(), $attributes_input = array(), $label_attributes = array(), $new_line = false ) {
            $args = func_get_args();
            $new_line = is_bool( $args[ count( $args )-1 ] ) ? $args[ count( $args )-1 ] : $new_line;
        	
        	if( is_array( $attributes_or_label ) ) {
                if( isset( $attributes_or_label[ 'value' ] ) ) {
                    $value = $attributes_or_label[ 'value' ];
                    unset( $attributes_or_label[ 'value' ] );
					if( empty( $value ) ) $value = ' ';
				}
                else $value = '';
                
                return $this->createTag( 'textarea', $attributes_or_label, $value );
            }
            else if( is_string( $attributes_or_label ) ) {
                $attributes_input          = $this->compareDefaultArray( $attributes_input, array( 'id' => $this->Rand() ) );
                $label_attributes[ 'for' ] = $attributes_input[ 'id' ];
                
                if( isset( $attributes_input[ 'value' ] ) ) {
                    $value = $attributes_input[ 'value' ];
                    unset( $attributes_input[ 'value' ] );
                }
                else $value = ' ';
                
				// Verifica se o campo e' obrigatorio
				if( $required = $this->checkRequired( $attributes_or_label, $attributes_input ) ) {
					$attributes_or_label  = $required[ 0 ];
					$attributes_input     = $required[ 1 ];
				}
				
				$texarea = $this->createTag( 'textarea', $attributes_input, $value );
				
                return $this->Label( 
					$attributes_or_label, 
					$label_attributes, 
					$new_line ? $this->newLine( $texarea, true, true ) : $texarea
				);
            }
            else return '';
        }
		
		/**
		 * Cria um Novo Select
		 *
		 * @param string $label
		 * @param array $data
		 * @param array $attributes
		 * @param string $selected
		 * @param array $init
		 * @param array $opt_attributes
		 * @return string HTML
		 */
		public function Select( $label, $data, $attributes = array(), $selected = 0, $init = array(), $opt_attributes = array(), $label_attr = array() ) {
			// argumentos
			$args       = func_get_args();
			// label
			$label      = $this->isStringIndexTo( $args, 0 );
			// dados:array
			$data       = $this->isArrayIndexTo( $args, 1 );
			// atributos do Select
			$attributes = $this->isArrayIndex( $args, 2 ) ? $args[ 2 ] : array( 'name' => $args[ 2 ] );
			// value selected
			$selected   = $this->isStringOrNumberIndexTo( $args, 3 );
			// option de indice 0, array ou string
			$init       = $this->isArrayIndex( $args, 4 ) ? $args[ 4 ] : ( $this->isStringIndex( $args, 4 ) ? array( '', $args[ 4 ] ) : false );
			// atributes dos options
			$opt_attr   = $this->isArrayIndexTo( $args, 5 );
			
			$options    = array();
			$select     = '';
			
			// Se o $label nao for vazio, aplica uma ID no Select, caso nao exista, e um attributo FOR no label, cria o HTML Label
			if( !empty( $label ) ) {
				// Verifica se o select e' obrigatorio
				if( $required = $this->checkRequired( $label, $attributes ) ) {
					$label      = $required[ 0 ];
					$attributes = $required[ 1 ];
				}
				
				$attributes = $this->compareDefaultArray( $attributes, array( 'id' => $this->Rand() ) );
				$label_attr = array_merge( $label_attr, array( 'for' => $attributes[ 'id' ] ) );
				if( $this->label_title && isset( $attributes[ 'title' ] ) ) $label_attr[ 'title' ] = $attributes[ 'title' ];
				$label      = $this->Label( $label, $label_attr );
			}
			
			/* caso haja grupos:
			 *	
			 *	array(
			 *		array( 'GRUPO 1', 1, 'text1' ),
			 *		array( 'GRUPO 1', 2, 'text2' ),
			 *		array( 'GRUPO 2', 3, 'text3' ),
			 *		array( 'GRUPO 2', 4, 'text4' ),
			 *		array( 'GRUPO 2', 5, 'text5' )
			 *	); 
			 */
			if( $this->isArrayIndex( $data, 0 ) && count( $data[ 0 ] ) == 3 ) {
				$data = $this->arrayAssocToNumeric( $data );
				$groups = array();
				
				// Ordena os Grupos
				foreach( $data as $v ) {
					$groups_index = trim( strtoupper( preg_replace( '/[^\w]/', '_', $v[ 0 ] ) ) );
					$groups_index = empty( $groups_index ) ? '_NOT_GROUP_' : $groups_index;
					
					if( !isset( $groups[ $groups_index ] ) ) $groups[ $groups_index ] = array( $v[ 0 ], array( array( $v[ 1 ], $v[ 2 ] ) ) );
					else $groups[ $groups_index ][ 1 ][] = array( $v[ 1 ], $v[ 2 ] );
				}
				
				$not_group = $this->isArrayIndexTo( $groups, '_NOT_GROUP_' );
				unset( $groups[ '_NOT_GROUP_' ] );
				
				// Sorteia em ordem alfabe'tica
				asort( $groups );
				
				$optgroup = array();
				
				// Monta os grupos
				foreach( $groups as $v ) {
					foreach( $v[ 1 ] as $c ) {
						$c[ 0 ] = trim( $c[ 0 ] );
						$c[ 1 ] = trim( $c[ 1 ] );
						
						$opt_attr[ 'value' ] = $c[ 0 ];
						if( $selected == $c[ 0 ] ) 
							$options[] = $this->createTag( 'option', array_merge( $opt_attr, array( 'selected' => 'selected' ) ), $c[ 1 ] );
						else $options[] = $this->createTag( 'option', $opt_attr, $c[ 1 ] );
					}
					$optgroup[] = $this->createTag( 'optgroup', array( 'label' => $v[ 0 ] ), implode( '', $options ) );
					$options = array();
				}
				
				$options = $optgroup;
				
				// Caso exista Options sem grupo
				if( count( $not_group ) > 0 ) {
					foreach( $not_group[ 1 ] as $c ) {
						$c[ 0 ] = trim( $c[ 0 ] );
						$c[ 1 ] = trim( $c[ 1 ] );
						
						$opt_attr[ 'value' ] = $c[ 0 ];
						if( $selected == $c[ 0 ] ) {
							// adiciona-se o novo input no final do array $options
							array_push( $options, $this->createTag( 'option', array_merge( $opt_attr, array( 'selected' => 'selected' ) ), $c[ 1 ] ) );
						}
						else {						
							// adiciona-se o novo input no final do array $options
							array_push( $options, $this->createTag( 'option', $opt_attr, $c[ 1 ] ) );
						}
					}
				}
			}
			// caso $data = array( array( 1, 'Primeiro' ), array( 2, 'Segundo' ), array( 3, 'Terceiro' ) )
			else if( $this->isArrayIndex( $data, 0 ) && count( $data[ 0 ] ) == 2 ) {
				$data = $this->arrayAssocToNumeric( $data );
				foreach( $data as $v ) {				
					$v[ 0 ] = trim( $v[ 0 ] );
					$v[ 1 ] = trim( $v[ 1 ] );
					$opt_attr[ 'value' ] = $v[ 0 ];
					if( $selected == $v[ 0 ] ) 
						$options[] = $this->createTag( 'option', array_merge( $opt_attr, array( 'selected' => 'selected' ) ), $v[ 1 ] );
					else $options[] = $this->createTag( 'option', $opt_attr, $v[ 1 ] );
				}
			}
			// caso $data = array( 'Primeiro', 'Segundo', 'Terceiro' )
			else {
				foreach( $data as $v ) {
					$v = trim( $v );
					$opt_attr[ 'value' ] = $v;
					if( $selected == $v ) 
						$options[] = $this->createTag( 'option', array_merge( $opt_attr, array( 'selected' => 'selected' ) ), $v );
					else $options[] = $this->createTag( 'option', $opt_attr, $v );
				}
			}
			
			// Verifica se existe o option de index 0, caso verdairo, adiciona-o ao inicio do array de dados
			if( $init ) array_unshift( $options, $this->createTag( 'option', array( 'value' => $init[ 0 ] ), $init[ 1 ] ) );
			$select = $this->createTag( 'select', $attributes, implode( '', $options ) );
			
			return $label.$select;
		}
        
        /**
         * Insere co'dios HTML no conteúdo do Formulario
         * 
         * @param $content
         * @param $return
         * @return unknown_type
         */
        public function HTML( $content = '', $return = false ) {
            return $return ? $content : $this->datas[] = $content;
        }
		
        /**
         * Cria um Novo Label
         * 
		 * @param string  $text Texto do Label
		 * @param array   $attributes Atributos do Lebel
		 * @param string  $contents Campo a que o label se referencia
		 * @param boolean $first[optional] Se o campo fica antes ou depois do Label
		 * @return string HTML Label
         */
		private function Label( $text = '', $attributes = array() , $contents = '', $first = false ) {
			$label = ( $first ? $contents : '' )
				.( !empty( $text ) ?
				  	$this->createTag( 
						'label', 
						$attributes, 
						$text.
						( 
							!empty( $this->char_sep ) && $this->set_sep ? 
								$this->char_sep.' ' 
							: 
								'' 
						) 
					)
				:
					''
				)
				.( !$first ? $contents : '' );
			
			if( !$this->set_sep ) $this->set_sep = true;
			return $label;
		}
		
		/**
		 * Cria um Novo Input
		 * 
		 * @param $attributes_or_label
		 * @param $attributes_input
		 * @param $label_attributes
		 * @return unknown_type
		 */
		private function Input( $attributes_or_label, $attributes_input = array(), $label_attributes = array() ) {
			if( is_array( $attributes_or_label ) ) return $this->createTag( 'input', $attributes_or_label );
			else if( is_string( $attributes_or_label ) ) {
				$attributes_input = $this->compareDefaultArray( $attributes_input, array( 'id' => $this->Rand() ) );
				$label_attributes[ 'for' ] = $attributes_input[ 'id' ];
				return $this->Label( 
						$attributes_or_label, 
						$label_attributes, 
						$this->createTag( 'input', $attributes_input )
					);
			}
		}
		
		/**
		 * Valida os Attributos dos me'todos Checkbox e Radio
		 * 
		 * @param $type
		 * @param $text_group
		 * @param $elements
		 * @param $to_array
		 * @return unknown_type
		 */
		private function checkboxAndRadio( $type, $text_group = '', $elements = false, $to_array = false ) {
						
			if( gettype( $elements ) == 'boolean' && is_array( $text_group ) ) 
				/*
					
					$sf->Checkbox(
						array(
							array(
								'ChkBox2',
								array( 'id' => 'ChkBox2' ),
								array( 'id' => 'label_id2' )
							),
							array(
								'ChkBox3',
								array( 'id' => 'ChkBox3' ),
								array( 'id' => 'label_id3' )
							)
						)
						,true
					)
					
				*/
				
				return $this->newCheckboxOrRadios( $type, $text_group, false, $elements );
			
			else if( is_array( $text_group ) && is_array( $elements ) ) {
				/*
					$sf->Checkbox(
						array( 'My CheckBoxes Group 1', array( 'class' => 'chk_group' ), array( 'name' => 'test' ) ),
						array(
							array( 'ChkBox6', array( 'id' => 'ChkBox6' ), array( 'id' => 'label_id6' ) ),
							array( 'ChkBox7', array( 'id' => 'ChkBox7' ), array( 'id' => 'label_id7' ) )
						)
					)
				*/
				
				if( is_array( $text_group[ 0 ] ) ) {
					foreach ( $elements as $i => $v ) {
						$elements[ $i ][ 1 ] = array_merge( 
							$this->isArrayIndexTo( $elements[ $i ], 1 ), 
							$text_group[ 0 ] 
						);
					}
					
					$text_group = '';
				}
				else {
					if( $this->isArrayIndex( $text_group, 2 ) ) {
						foreach ( $elements as $i => $v ) {
							$elements[ $i ][ 1 ] = array_merge( 
								$this->isArrayIndexTo( $elements[ $i ], 1 ), 
								$text_group[ 2 ] 
							);
						}
					}
					
					$text_group = (
						$this->createTag( 
							$type == 'checkbox' ? $this->checkbox_group_label[ 0 ] : $this->radio_group_label[ 0 ],
							$this->isArrayIndex( $text_group, 1 ) && count( $text_group[ 1 ] ) > 0 ? $text_group[ 1 ] : ( $type == 'checkbox' ? $this->checkbox_group_label[ 1 ] : $this->radio_group_label[ 1 ] ), 
							$text_group[ 0 ] 
						)
					);
				}
				
				if( $to_array )	{
					$ret[] = $text_group;
					$ret = array_merge( $ret, $this->newCheckboxOrRadios( $type, $elements, false, $to_array ) );
					return $ret;
				}
				else return $text_group.$this->newCheckboxOrRadios( $type, $elements, false, false );
			}
			else {
				/*
					$sf->Checkbox(
						'My CheckBoxes Group 1',
						array( 'ChkBox6', array( 'id' => 'ChkBox6' ), array( 'id' => 'label_id6' ) )
					)
				*/
				$text_group = (
					!empty( $text_group ) ? 
						$this->createTag( 
							( $type == 'checkbox' ? $this->checkbox_group_label[ 0 ] : $this->radio_group_label[ 0 ] ),
							( $type == 'checkbox' ? $this->checkbox_group_label[ 1 ] : $this->radio_group_label[ 1 ] ), 
							$text_group 
						) 
					: 
						''
				);
				
				return $text_group.
					$this->newCheckboxOrRadios( 
						$type, 
						$elements, 
						empty( $text_group ) ? false : true 
					);
			}
		}
		
		/**
		 * Cria um Novo Checkbox ou Radio
		 *
		 * @param string $type "checkbox" ou "radio"
		 * @param array $elements propriedades de um, ou uma lista com va'rios
		 * @param boolean $prev se o label vai ficar antes do objeto TRUE, se depois, FALSE
		 * @param boolean $array retorna em forma de array, TRUE, se HTML, FALSE 
		 * @return array se $array for TRUE e string, se $array for FALSE
		 */
		private function newCheckboxOrRadios( $type, $elements , $prev = false, $array = false ) {
			$parent = $type == 'checkbox' ? $this->parent_checkbox : $this->parent_radio;
			// Se e' um array de elementos
			if( $this->isArrayIndex( $elements, 0 ) ) {
				foreach( $elements as $i => $v ) {	
					$this->set_sep             = false;
					$label                     = isset( $elements[ $i ][ 0 ] ) ? $elements[ $i ][ 0 ] : '';
					
					if( $this->isStringIndex( $elements[ $i ], 1 ) && !empty( $elements[ $i ][ 1 ] ) )
						$elements[ $i ][ 1 ] = array( 'name' => $elements[ $i ][ 1 ] );
						
					$attributes = $this->compareDefaultArray(
						$this->isArrayIndexTo( $elements[ $i ], 1 ),
						array( 'id' => $this->Rand() ) 
					);
					$attributes[ 'type' ]      = $type;
					$label_attributes          = $this->compareDefaultArray(
						$this->isArrayIndexTo( $elements[ $i ], 2 ),
						array() 
					);
					$label_attributes[ 'for' ] = $attributes[ 'id' ];
					
					if( $this->label_title && isset( $attributes[ 'title' ] ) ) $label_attributes[ 'title' ] = $attributes[ 'title' ];
					
					$elems[] = $this->Label( 
						$label, 
						$label_attributes, 
						(
							!empty( $parent ) ?
								str_replace( 
									$this->var_contents, 
									$this->Input( $attributes ),
									$parent
								)
							:
								$this->Input( $attributes )
						),
						true
					);
				}
				// Se e' para retornar como um array, retorna o array de elementos,
				// Caso contrario, retorna o HTML com uma quebra de linha entre os elementos
				return $array ? $elems : implode( $this->new_line_content, $elems );
			}
			// Caso um u'nico elemento
			else {
				$this->set_sep             = false;
				$label                     = isset( $elements [ 0 ] ) ? $elements [ 0 ] : '';
				
				if( $this->isStringIndex( $elements, 1 ) && !empty( $elements[ 1 ] ) )
						$elements[ 1 ] = array( 'name' => $elements[ 1 ] );
						
				$attributes                = $this->compareDefaultArray( $this->isArrayIndexTo( $elements, 1 ), array( 'id' => $this->Rand() ) );
				$attributes[ 'type' ]      = $type;
				$label_attributes          = $this->compareDefaultArray( $this->isArrayIndexTo( $elements, 2 ), array() );
				$label_attributes[ 'for' ] = $attributes[ 'id' ];
			
				$required = $this->checkRequired( $label, $attributes );
				if( $required ) {
					$label  = $required[ 0 ];
					$attributes = $required[ 1 ];
				}
				
				if( $this->label_title && isset( $attributes[ 'title' ] ) ) $label_attributes[ 'title' ] = $attributes[ 'title' ];
				
				return $this->newLine(
							$this->Label( 
								$label, 
								$label_attributes, 
								(
									!empty( $parent ) ?
										str_replace( 
											$this->var_contents, 
											$this->Input( $attributes ),
											$parent
										)
									:
										$this->Input( $attributes )
								), 
								true
							),
							$prev
						);
			}
		}
		
		/**
		 * Joga o pro'ximo objeto HTML para uma nova linha
		 * 
		 * @param $contents
		 * @param $prev
		 * @param $first
		 * @return unknown_type
		 */
		private function newLine( $contents, $prev = false, $first = false ) {
			return $this->new_line ? 
						( is_array( $contents ) ? 
							implode( $this->new_line_content, $contents ) : 
							( $prev ? $this->new_line_content : '' )
								.$contents.
							( !$prev || $first ? $this->new_line_content : '' )
						) : 
					$contents;
		}
		
		/**
		 * Cria uma lista nao ordenada com o conteu'do do Formulario
		 * 
		 * @param array $contents 
		 * @param boolean $add_itens
		 * @param boolean $list
		 * @return string|array
		 */
		public function formList( $contents, $add_itens = true, $list = true, $root = false ) {
			if( $root ) {
				$create_list = $this->list_root;
				$attributes = $this->list_root_attributes;
				$root_index_class_name = true;
			}
			else {
				$create_list = $this->list;
				$attributes = $this->list_attributes;
				$root_index_class_name = false;
			}
					 
			return $create_list && $list ? 
					$this->createTag( 'ul', array_merge( $attributes, array( 'type'=>'none' ) ), $add_itens ? 
						$this->newListItem( $contents, array(), $root_index_class_name ) 
					: 
						$contents
					) 
				: 
					implode( $this->new_line ? $this->new_line_content : '', $contents );
		}
		
		/**
		 * Adciona um novo item 'a lista do Formulario
		 * 
		 * @param $content
		 * @param $attributes
		 * @return unknown_type
		 */
		private function newListItem( $content, $attributes = array(), $root_index_class_name = false ) {
			$class_name = $root_index_class_name ? 
					array( $this->list_root_even_class_name, $this->list_root_odd_class_name )
				:
					array( $this->list_even_class_name, $this->list_odd_class_name );
					
			if( is_array( $content ) ) {
				$r = 0;
				foreach( $content as $i => $v ) {
					if( is_array( $v ) ) {
						$data = $v[ 0 ];
						$attr = $v[ 1 ];
					}
					else {
						$data = $v;
						$attr = $attributes;
					}
					
					// Adiciona a Quebra de Linha
					if( $this->new_line && !empty( $this->new_line_content ) ) $data = $data.$this->new_line_content;
					
					if( !empty( $class_name[ 0 ] ) || !empty( $class_name[ 1 ] ) )
						$attr = $this->addClass( $attr, $r++ % 2 == 0 ? $class_name[ 0 ] : $class_name[ 1 ] );
						
					$content[ $i ] = $this->createTag( 'li', $attr, $data );
				}
			}
			return implode( '', $content );
		}
		
		/**
		 * Cria uma nova Tag com seu attributos
		 * 
		 * @param string    $tag_name    Nome da Tag
		 * @param array     $attributes  Atributos da Tag
		 * @param string    $contents    Conteudo da Tag
		 * @return string
		 */
		private function createTag( $tag_name, $attributes = array(), $contents = false ) {
			$tag_name = strtolower( $tag_name );
			
			return '<'.
				$tag_name.$this->arrayToAttrs( $attributes ).
				( 
				 	$contents || is_string( $contents ) ? 
						'>'.trim( $contents ).'</'.$tag_name.'>' 
					: 
						' />'
				);
		}
		
		/**
		 * Compara duas variaveis, uma string e um array, e retorna a que for do tipo array
		 * 
		 * @param $compare
		 * @param $default
		 * @return unknown_type
		 */
		private function compareDefaultArray( $compare , $default = array() ) {
			if( !is_array( $compare ) ) $compare = $default;
			if( is_array( $compare ) && is_array( $default ) )foreach( $default as $i => $v ) if( !isset( $compare[ $i ] ) ) $compare[ $i ] = $v;
			return $compare;
		}
		
		/**
		 * Adiciona uma nova classe ao atributo "class" do array principal
		 * 
		 * @param $attributes
		 * @param $new_class
		 * @return unknown_type
		 */
		private function addClass( $attributes = array(), $new_class = '' ) {
			if( !empty( $new_class ) ) $attributes[ 'class' ] = isset( $attributes[ 'class' ] ) ? $attributes[ 'class' ].' '.$new_class : $new_class;
			return $attributes;
		}
		
		/**
		 * Retorna a juncao de dois arrays de attributos, adicionando classes, nao substituindo
		 * 
		 * @param $attributes
		 * @param $attributes2
		 * @return unknown_type
		 */
		private function checkAttributesAndAddClass( $attributes = array(), $attributes2 = array() ) {
			if( isset( $attributes[ 'class' ] ) && isset( $attributes2[ 'class' ] ) )
				$attributes2[ 'class' ] = $this->addClass( $attributes[ 'class' ], $attributes2[ 'class' ] );
			
			return array_merge( $attributes, $attributes2 );
		}
		
		/**
		 * Une Indices de arrays com seus valores a fim de retorna um conjunto de attributos HTML
		 * 
		 * @param $array_attributes
		 * @param $array_default_attributes
		 * @return unknown_type
		 */
		private function arrayToAttrs( $array_attributes = array(), $array_default_attributes = array() ) {
			if( !is_array( $array_attributes ) ) return '';
			
			$attributes = array();
			
			if( count( $array_attributes ) > 0 ) {
				foreach( $array_attributes as $i => $v ) {
					$v = trim( $v );
					if( is_string( $v ) || is_numeric( $v ) )
						$attributes[] = strtolower( $i ).'="' . $v . '"';
				}
				$attributes = ' ' . implode( ' ', $attributes );
			}
			else $attributes = '';
			
			return  $attributes;
		}
		
		/**
		 * Retorna um numero Randonico de 32 caracters
		 * 
		 * @return unknown_type
		 */
		private function Rand() {
			return uniqid( "SF_" . rand(), true );
		}
		
		/**
		 * Caso um indice existe e e' booleano, retorna true ou false
		 * 
		 * @param $array
		 * @param $index
		 * @param $value
		 * @return unknown_type
		 */
		private function isBoolIndex( $array = array(), $index = 0, $value = true ) {
			if( isset( $array[ $index ] ) && is_bool( $array[ $index ] ) ) return true;
			else return false;
		}
		
		/**
		 * Caso um indice existe e e' booleano, retorna o value padrao
		 * 
		 * @param $array
		 * @param $index
		 * @param $value
		 * @return unknown_type
		 */
		private function isBoolIndexTo( $array = array(), $index = 0, $value = true ) {
			if( !$this->isBoolIndex( $array, $index ) ) return $value;
			else return $array[ $index ];
		}
		
		/**
		 * Caso um indice nao exista, retorna um novo valor
		 * 
		 * @param $array
		 * @param $index
		 * @param $value
		 * @return unknown_type
		 */
		private function isIssetIndexTo( $array = array(), $index = 0, $value = '' ) {
			if( !isset( $array[ $index ] ) ) return $value;
			else return $array[ $index ];
		}
		
		/**
		 * Retorna true ou false se um Indice de uma array for ou nao um array
		 * 
		 * @param $array
		 * @param $index
		 * @return unknown_type
		 */
		private function isArrayIndex( $array = array(), $index = 0 ) {
			if( isset( $array[ $index ] ) && is_array( $array[ $index ] ) ) return true;
			else return false;
		}
		
		/**
		 * Verifica se o Indice "$index" de um array e' um array, caso false, retorna um array vazrio
		 * 
		 * @param $array
		 * @param $index
		 * @param $value
		 * @return unknown_type
		 */
		private function isArrayIndexTo( $array = array(), $index = 0, $value = array() ) {
			if( $this->isArrayIndex( $array, $index ) ) return $array[ $index ];
			else return $value;
		}
		
		/**
		 * Retorna true ou false se um Indice de uma array for ou nao uma string
		 * 
		 * @param $array
		 * @param $index
		 * @return unknown_type
		 */
		private function isStringIndex( $array = array(), $index = 0 ) {
			if( isset( $array[ $index ] ) && is_string( $array[ $index ] ) ) return true;
			else return false;
		}
		
		/**
		 * Verifica se o Indice "$index" de um array e' uma string, caso false, retorna uma string pre-definida 
		 * 
		 * @param $array
		 * @param $index
		 * @param $value
		 * @return unknown_type
		 */
		private function isStringIndexTo( $array = array(), $index = 0, $value = '' ) {
			if( $this->isStringIndex( $array, $index ) ) return $array[ $index ];
			else return $value;
		}
		
		/**
		 * Retorna true ou false se um Indice de uma array for ou nao uma string
		 * 
		 * @param $array
		 * @param $index
		 * @return unknown_type
		 */
		private function isNumberIndex( $array = array(), $index = 0 ) {
			if( isset( $array[ $index ] ) && is_numeric( $array[ $index ] ) ) return true;
			else return false;
		}
		
		/**
		 * Retorna true ou false se um Indice de uma array for ou nao uma string
		 * 
		 * @param $array
		 * @param $index
		 * @param $value
		 * @return boolean
		 */
		private function isNumberIndexTo( $array = array(), $index = 0, $value = 0 ) {
			if( $this->isNumberIndex( $array, $index ) ) return $array[ $index ];
			else return $value;
		}
		
		/**
		 * Verifica se o Indice "$index" de um array e' uma string ou Number
		 * 
		 * @param $array
		 * @param $index
		 * @param $value
		 * @return boolean
		 */
		private function isStringOrNumberIndex( $array = array(), $index = 0, $value = '' ) {
			if( $this->isStringIndex( $array, $index ) || $this->isNumberIndex( $array, $index ) ) return true;
			else return false;
		}
		
		/**
		 * Verifica se o Indice "$index" de um array e' uma string ou Number, caso false, retorna uma string pre-definida
		 * 
		 * @param $array
		 * @param $index
		 * @param $value
		 * @return unknown_type
		 */
		private function isStringOrNumberIndexTo( $array = array(), $index = 0, $value = '' ) {
			if( $this->isStringIndex( $array, $index ) || $this->isNumberIndex( $array, $index ) ) return $array[ $index ];
			else return $value;
		}
		
		/**
		 * SELETOR: Verifica a existencia de classes e id e retorna um array associativo
		 * 
		 * @param $str
		 * @return unknown_type
		 */
		private function selectorClassId( $str = '' ) {
			$str     = trim( $str );
			$str     = preg_replace( '/(\s )+/', '$1', $str );
			$classId = explode( ' ', $str );
			$ret     = array();
			$id      = array();
			$class   = array();
			
			foreach( $classId as $v ) {
				if( ereg( '^\#', $v ) ) $id[] = str_replace( '#', '', $v );
				if( ereg( '^\.', $v ) ) $class[] = str_replace( '.', '', $v );
			}
			
			if( count( $id > 0 ) ) $ret[ 'id' ] = $id[ 0 ];
			if( count( $class > 0 ) ) $ret[ 'class' ] = implode( ' ', $class );
			
			return $ret;
		}
		
		/**
		 * Converte um array Associativo para um array nume'rico
		 * 
		 * @param $array
		 * @return unknown_type
		 */
		private function arrayAssocToNumeric( $array = array() ) {
			if( !is_array( $array ) ) return $array;
			$new = array();
			foreach( $array as $i => $v ) {
				if( is_array( $v ) ) foreach( $v as $c ) $new[ $i ][] = $c;
			}
			return $new;
		}
		
		/**
		 * Verifica se determinado elemento sao ou nao de preenchimento obrigato'rio
		 * 
		 * @param $label
		 * @param $attributes
		 * @return unknown_type
		 */
		private function checkRequired( $label = '', $attributes = array() ) {
			$label = trim( $label );
			
			if( !empty( $label ) ) {
				if( ereg( '^\*', $label ) ) {
					if( count( $this->required_attributes ) > 0 ) {
						$required_attributes = $this->required_attributes;
						if( isset( $attributes[ 'class' ] ) && isset( $required_attributes[ 'class' ] ) ) {
							$attributes = $this->addClass( $attributes, $required_attributes[ 'class' ] );
							unset( $required_attributes[ 'class' ] );
						}
						$attributes = array_merge( $attributes, $required_attributes );
					}
					
					return array( 
						ereg_replace( '^\*', $this->required_asterisk, $label ), 
						$attributes 
					);
				}
				else return false;
			}
			else return false;
		}
		
	}
?>