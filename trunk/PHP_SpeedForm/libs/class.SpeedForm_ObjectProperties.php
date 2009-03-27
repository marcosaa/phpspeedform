<?php
	/**
	 * Configura as propriedades padrões dos Objetos do Formulário
	 * @package PHPSpeedForm
	 * @author Moisés Paes Sena <moisespsena@gmail.com>
	 * @link http://code.google.com/p/phpspeedform/source/browse/trunk/PHP_SpeedForm/libs/class.SpeedForm_ObjectProperties.php
	 * @copyright GPL
     * @since 2009-03-27
	 * @version 1.0
	 */
	class SpeedForm_ObjectProperties {
		/**
		 * Conteu'do HTML que renderizara' o coment'ario do objeto do formula'rio
		 *
		 * Deve conter {COMMENT}, que sera' substitui'do pelo comenta'rio correspondente
		 * @var string
		 */
		private $comment = '<div class="comment">{COMMENT}</div>';
		
		/**
		 * Define um novo conteu'udo HTML para o Comenta'rio
		 *
		 * Deve obrigatoriamente, possuir {COMMENT}, que sera' substitui'do pelo comenta'rio do objeto correspondente 
		 * @param string $comment
		 */
		public function setComment( $comment ) {
			if( ereg( '\{COMMENT\}', $comment ) )
				$this->comment = $comment;
		}
		
		/**
		 * Retorna o Coment'ario formatado
		 *
		 * @param string $comment
		 * @return string comenta'rio formatado
		 */
		public function getComment( $comment ) {
			return !empty( $comment ) ? str_replace( '{COMMENT}', $comment, $this->comment ) : '';
		}
		
		/**
		 * Conteu'do HTML que renderizara' o coplemento do objeto do formula'rio
		 *
		 * Deve conter {COMPLEMENT}, que sera' substitui'do pelo complemento correspondente
		 * @var string
		 */
		private $complement = '<span class="complement">{COMPLEMENT}</span>';
		
		/**
		 * Define um novo conteu'udo HTML para o Complemento
		 *
		 * Deve obrigatoriamente, possuir {COMPLEMENT}, que sera' substitui'do pelo complemento do objeto correspondente 
		 * @param string $comment
		 */
		public function setComplement( $complement ) {
			if( ereg( '\{COMPLEMENT\}', $complement ) )
				$this->complement = $complement;
		}
		
		/**
		 * Retorna o Complemento formatado
		 *
		 * @param string $complement
		 * @return string complemento formatado
		 */
		public function getComplement( $complement ) {
			return !empty( $complement ) ? str_replace( '{COMPLEMENT}', $complement, $this->complement ) : '';
		}
		
		/**
		 * Conteu'do HTML que renderizara' o HTML como objeto do formula'rio
		 *
		 * Deve conter {HTML}, que sera' substitui'do pelo html correspondente
		 * @var string
		 */
		private $html = '{HTML}';
		
		/**
		 * Define um novo conteu'udo HTML para o Complemento
		 *
		 * Deve obrigatoriamente, possuir {COMPLEMENT}, que sera' substitui'do pelo complemento do objeto correspondente 
		 * @param string $comment
		 */
		public function setHTML( $html ) {
			if( ereg( '\{HTML\}', $html ) )
				$this->html = $html;
		}
		
		/**
		 * Retorna o HTML formatado
		 *
		 * @param string $html
		 * @return string html formatado
		 */
		public function getHTML( $html ) {
			return !empty( $html ) ? str_replace( '{HTML}', $html, $this->html ) : '';
		}
		
		/**
		 * Atributos padronizados dos inputs do tipo Text
		 *
		 * @var array
		 */
		private $text_attributes = array();
		
		/**
		 * Define os Atributos dos inputs do tipo Text
		 *
		 * @param array $attributes
		 */
		public function setTextAttributes( $attributes ) {
			$this->text_attributes = $attributes;
		}
		
		/**
		 * Retorna os Atributos dos inputs do tipo Text
		 *
		 * @return array
		 */
		public function getTextAttributes( $attributes = array() ) {
			return array_merge( $this->text_attributes, $attributes );
		}
		
		/**
		 * Attributos padronizados dos label dos inputs do tipo Text
		 *
		 * @var array
		 */
		private $label_text_attributes = array();
		
		/**
		 * Atributos do Label dos inputs do tipo Text
		 *
		 * @param array $attributes
		 */
		public function setLabelTextAttributes( $attributes ) {
			$this->label_text_attributes = $attributes;
		}
		
		/**
		 * Retorna os Atributos do Label dos inputs do tipo Text
		 *
		 * @param array $attributes
		 * @return array
		 */
		public function getLabelTextAttributes( $attributes = array() ) {
			return array_merge( $this->label_text_attributes, $attributes );
		}
		
		/**
		 * Atributos padronizados dos Textareas
		 *
		 * @var array
		 */
		private $textarea_attributes = array();
		
		/**
		 * Define os Atributos dos Textareas
		 *
		 * @param array $attributes
		 */
		public function setTextareaAttributes( $attributes ) {
			$this->textarea_attributes = $attributes;
		}
		
		/**
		 * Retorna os Atributos dos Textareas
		 *
		 * @return array
		 */
		public function getTextareaAttributes( $attributes = array() ) {
			return array_merge( $this->textarea_attributes, $attributes );
		}
		
		/**
		 * Attributos padronizados dos label dos Textareas
		 *
		 * @var array
		 */
		private $label_textarea_attributes = array();
		
		/**
		 * Atributos do Label dos Textareas
		 *
		 * @param array $attributes
		 */
		public function setLabelTextareaAttributes( $attributes ) {
			$this->label_textarea_attributes = $attributes;
		}
		
		/**
		 * Retorna os Atributos do Label dos Textareas
		 *
		 * @param array $attributes
		 * @return array
		 */
		public function getLabelTextareaAttributes( $attributes = array() ) {
			return array_merge( $this->label_textarea_attributes, $attributes );
		}
		
		/**
		 * Quebra de linha do Textarea
		 *
		 * Permissao para que o textarea sobra uma quebra de linha logo depois do seu label,
		 * sendo portanto renderizado na linha posterior ao seu label
		 * @var unknown_type
		 */
		private $textarea_new_line = false;
		
		/**
		 * Define a permissao de quebra de linha do Textarea
		 *
		 * @param boolean $new_line
		 */
		public function setTextareaNewLine( $new_line = false ) {
			$this->textarea_new_line = $new_line;
		}
		
		/**
		 * Retorna a permissao de quebra de linha do textarea
		 *
		 * @return boolean
		 */
		public function getTextareaNewLine() {
			return $this->textarea_new_line;
		}
		
		/**
		 * Atributos padronizados dos inputs do tipo Checkbox
		 *
		 * @var array
		 */
		private $checkbox_attributes = array();
		
		/**
		 * Define os Atributos dos inputs do tipo Checkbox
		 *
		 * @param array $attributes
		 */
		public function setCheckboxAttributes( $attributes ) {
			$this->checkbox_attributes = $attributes;
		}
		
		/**
		 * Retorna os Atributos dos inputs do tipo Checkbox
		 *
		 * @return array
		 */
		public function getCheckboxAttributes( $attributes = array() ) {
			return array_merge( $this->checkbox_attributes, $attributes );
		}
		
		/**
		 * Attributos padronizados dos inputs do tipo Checkbox
		 *
		 * @var array
		 */
		private $label_checkbox_attributes = array();
		
		/**
		 * Atributos do Label dos inputs do tipo Checkbox
		 *
		 * @param array $attributes
		 */
		public function setLabelCheckboxAttributes( $attributes ) {
			$this->label_checkbox_attributes = $attributes;
		}
		
		/**
		 * Retorna os Atributos do Label dos inputs do tipo Checkbox
		 *
		 * @param array $attributes
		 * @return array
		 */
		public function getLabelCheckboxAttributes( $attributes = array() ) {
			return array_merge( $this->label_checkbox_attributes, $attributes );
		}
		
		/**
		 * Atributos padronizados dos inputs do tipo Radio
		 *
		 * @var array
		 */
		private $radio_attributes = array();
		
		/**
		 * Define os Atributos dos inputs do tipo Radio
		 *
		 * @param array $attributes
		 */
		public function setRadioAttributes( $attributes ) {
			$this->radio_attributes = $attributes;
		}
		
		/**
		 * Retorna os Atributos dos inputs do tipo Radio
		 *
		 * @return array
		 */
		public function getRadioAttributes( $attributes = array() ) {
			return array_merge( $this->radio_attributes, $attributes );
		}
		
		/**
		 * Attributos padronizados dos inputs do tipo Radio
		 *
		 * @var array
		 */
		private $label_radio_attributes = array();
		
		/**
		 * Atributos do Label dos inputs do tipo Radio
		 *
		 * @param array $attributes
		 */
		public function setLabelRadioAttributes( $attributes ) {
			$this->label_radio_attributes = $attributes;
		}
		
		/**
		 * Retorna os Atributos do Label dos inputs do tipo Radio
		 *
		 * @param array $attributes
		 * @return array
		 */
		public function getLabelRadioAttributes( $attributes = array() ) {
			return array_merge( $this->label_radio_attributes, $attributes );
		}
		
		/**
		 * Atributos padronizados dos Selects
		 *
		 * @var array
		 */
		private $select_attributes = array();
		
		/**
		 * Define os Atributos dos Selects
		 *
		 * @param array $attributes
		 */
		public function setSelectAttributes( $attributes ) {
			$this->select_attributes = $attributes;
		}
		
		/**
		 * Retorna os Atributos dos Selects
		 *
		 * @return array
		 */
		public function getSelectAttributes( $attributes = array() ) {
			return array_merge( $this->select_attributes, $attributes );
		}
		
		/**
		 * Attributos padronizados dos label dos Selects
		 *
		 * @var array
		 */
		private $label_select_attributes = array();
		
		/**
		 * Atributos do Label dos Selects
		 *
		 * @param array $attributes
		 */
		public function setLabelSelectAttributes( $attributes ) {
			$this->label_select_attributes = $attributes;
		}
		
		/**
		 * retorna os Atributos do Label dos Selects
		 *
		 * @param array $attributes
		 * @return array
		 */
		public function getLabelSelectAttributes( $attributes = array() ) {
			return array_merge( $this->label_select_attributes, $attributes );
		}
		
		/**
		 * Option de I'ndice "0" do Select
		 *
		 * @var array
		 */
		private $select_opt_init = array( '', '---  SELECIONE  ---' );
		
		/**
		 * Define o Texto e o Valor do input de i'ndice "0" do Select
		 *
		 * @param string $text Texto do Option
		 * @param string $value Valor do Option
		 * @return void
		 */
		public function setSelectOptInit( $text, $value = '' ) {
			$this->select_opt_init = array( $value, $text );
		}
		/**
		 * Retorna o Texto e o Valor do input de i'ndice "0" do Select
		 *
		 * @return array array( Valor, Texto )
		 */
		public function getSelectOptInit( $index = NULL ) {
			return is_numeric( $index ) ? $this->select_opt_init[ $index ] : $this->select_opt_init;
		}
		
		/**
		 * Atributos padronizados dos Fieldsets
		 *
		 * @var array
		 */
		private $fieldset_attributes = array();
		
		/**
		 * Atributos dos Fieldsets
		 *
		 * @param array $attributes
		 */
		public function setFieldsetAttributes( $attributes ) {
			$this->fieldset_attributes = $attributes;
		}
		
		/**
		 * retorna os Atributos dos Fieldsets
		 *
		 * @param array $attributes
		 * @return array
		 */
		public function getFieldsetAttributes( $attributes = array() ) {
			return array_merge( $this->fieldset_attributes, $attributes );
		}
		
		/**
		 * Attributos padronizados dos Legends
		 *
		 * @var array
		 */
		private $legend_attributes = array();
		
		/**
		 * Atributos do Label dos Legends
		 *
		 * @param array $attributes
		 */
		public function setLegendAttributes( $attributes ) {
			$this->legend_attributes = $attributes;
		}
		
		/**
		 * retorna os Atributos dos Legends
		 *
		 * @param array $attributes
		 * @return array
		 */
		public function getLegendAttributes( $attributes = array() ) {
			return array_merge( $this->legend_attributes, $attributes );
		}
		
		/**
		 * Propriedades do Parent do input Checkbox
		 *
		 * @var array
		 */
		private $parent_checkbox = array( 'span', array() );
		
		/**
		 * Define as propriedades do Parent do input checkbox
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
			$this->parent_checkbox = array( $tag, $attributes );
		}
		
		/**
		 * Retorna as propriedades do Parent do input Checkbox
		 * 
		 * @return array
		 */
		public function getParentCheckbox( $index = NULL ) {
			return is_numeric( $index ) ? $this->parent_checkbox[ $index ] : $this->parent_checkbox;
		}
		
		/**
		 * Propriedades do Parent do input Radio
		 *
		 * @var array
		 */
		private $parent_radio = array( 'span', array() );
		
		/**
		 * Define as propriedades do Parent do input Radio
		 * 
		 * @param string $tag nome da tag
		 * @param array $attributes attributos
		 * @return void
		 */
		public function setParentRadio( $tag = 'span', $attributes = array() ) {
			if( is_array( $tag ) ) {
				$attributes = $tag;
				$tag = 'span';
			}
			$this->parent_radio = array( $tag, $attributes );
		}
		
		/**
		 * Retorna as propriedades do Parent do input Radio
		 * 
		 * @return array
		 */
		public function getParentRadio( $index = NULL ) {
			return is_numeric( $index ) ? $this->parent_radio[ $index ] : $this->parent_radio;
		}
		
		/**
		 * Propriedades do Label do Grupo de Checkbox
		 *
		 * @var array
		 */
		private $checkbox_group_label = array( 'div', array() );
		
		/**
		 * Define a Tag e os Attributos do Label de grupos de Checkbox
		 * 
		 * @param string $tag nome da tag
		 * @param array $attributes attributos
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
		 * Retorna as propriedades da tag do Label de grupos de Checkbox
		 * 
		 * @return array
		 */
		public function getCheckboxGroupLabel( $index = NULL ) {
			return is_numeric( $index ) ? $this->checkbox_group_label[ $index ] : $this->checkbox_group_label;
		}
		
		/**
		 * Propriedades do Label do Grupo de Radio
		 *
		 * @var array
		 */
		private $radio_group_label = array( 'div', array() );
		
		/**
		 * Define a Tag e os Attributos do Label de grupos de Radios
		 * 
		 * @param string $tag nome da tag
		 * @param array $attributes attributos
		 * @return void
		 */
		public function setRadioGroupLabel( $tag = 'div', $attributes = array() ) {
			if( is_array( $tag ) ) {
				$attributes = $tag;
				$tag = 'div';
			}
			$this->radio_group_label = array( $tag, $attributes, '*' );
		}
		
		/**
		 * Retorna as propriedades da tag do Label de grupos de Radios
		 * 
		 * @return array numeric
		 */
		public function getRadioGroupLabel( $index = NULL ) {
			return is_numeric( $index ) ? $this->radio_group_label[ $index ] : $this->radio_group_label;
		}
		
		/**
		 * Propriedades da Tag que conte'm o Asterisk do Label dos objetos obrigato'rios
		 *
		 * @var array numeric
		 */
		private $required_asterisk = array( 'span', array() );
		
		/**
		 * Define as propriedades da tag que conte'm o Asterisk do Label dos objetos obrigato'rios
		 * 
		 * @param string $tag nome da tag
		 * @param array $attributes attributos (array associativo)
		 * @return void
		 */
		public function setRequiredAsterisk( $tag = 'span', $attributes = array() ) {
			if( is_array( $tag ) ) {
				$attributes = $tag;
				$tag = 'span';
			}
			$this->required_asterisk = array( $tag, $attributes );
		}
		
		/**
		 * Retorna as propriedades da tag que conte'm o Asterisk do Label dos objetos obrigato'rios
		 * 
		 * @return array numerico
		 */
		public function getRequiredAsterisk( $index = NULL ) {
			return is_numeric( $index ) ? $this->required_asterisk[ $index ] : $this->required_asterisk;
		}
		
		/**
		 * Atributos padroes para os objetos obrigato'rios
		 *
		 * @var array associativo
		 */
		private $required_attributes = array();
		
		/**
		 * Define os Attributos padroes para inputs obrigato'rios
		 *
		 * @param array $attributes attributos (array associativo)
		 * @return void
		 */
		public function setRequiredAttributes( $attributes = array() ) {
			$this->required_attributes = $attributes;
		}
		
		/**
		 * Retorna os Atributos dos Campos Obrigato'rios
		 *
		 * @return array associativo
		 */
		public function getRequiredAttributes() {
			return $this->required_attributes;
		}
		
		/**
		 * Lista nos Fieldsets
		 *
		 * Permite ou nao que os itens dos Fieldsets seja armazenados em uma lista.
		 * Isto permite que tais itens possam ser visualmente mais bem trabalhados com CSS
		 * @var boolean
		 */
		private $list = false;
		
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
		 * Retorna a permissao da criacao de Lista nos Fieldsets
		 *
		 * @return boolean
		 */
		public function getList(){
			return $this->list;
		}
		
		/**
		 * Atributos da Listas nos Fieldsets
		 *
		 * @var array
		 */
		private $list_attributes = array();
		
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
		 * Retorna os Attributos da Lista nos Fieldsets
		 * 
		 * @return array
		 */
		public function getListAttributes() {
			return $this->list_attributes;
		}
		
		/**
		 * Valor do atributo "class" do item de i'ndice PAR da lista nos Fieldsets
		 *
		 * @var string
		 */
		private $list_even_class_name = '';
		
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
		 * Retorna o valor do atributo "class" para os itens de i'ndice PAR da lista nos Fieldsets
		 *
		 * @return string valor do atributo classe
		 */		
		public function getListEvenClassName() {
			return $this->list_even_class_name;
		}
		
		/**
		 * Valor do atributo "class" do item de i'ndice I'MPAR da lista nos Fieldsets
		 *
		 * @var string
		 */
		private $list_odd_class_name = '';
		
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
		 * Retorna o valor do atributo "class" para os itens de i'ndice I'MPAR da lista nos Fieldsets
		 *
		 * @return string valor do atributo classe
		 */			
		public function getListOddClassName() {
			return $this->list_odd_class_name;
		}
		
		/**
		 * Lista no Formula'rio
		 *
		 * Permite ou nao que os childs do Formula'rio sejam renderizados em forma de lista.
		 * Isto permite que tais itens possam ser visualmente mais bem trabalhados com CSS
		 * @var boolean
		 */
		private $list_root = false;
		
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
		 * Retorna a permissao da criacao de Lista no Formula'rio
		 *
		 * @return boolean
		 */
		public function getListRoot(){
			return $this->list_root;
		}
		
		/**
		 * Atributos da Lista no Formula'rio
		 *
		 * @var array
		 */
		private $list_root_attributes = array();
		
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
		 * Retorna os Attributos da Lista do formulario
		 * 
		 * @return array
		 */
		public function getListRootAttributes() {
			return $this->list_root_attributes;
		}
		
		/**
		 * Valor do atributo "class" do item de i'ndice PAR da lista no Formula'rio
		 *
		 * @var string
		 */
		private $list_root_even_class_name = '';
		
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
		 * Retorna o valor do atributo "class" para os itens de i'ndice PAR da lista no Formula'rio
		 *
		 * @return string valor do atributo classe
		 */		
		public function getListRootEvenClassName() {
			return $this->list_root_even_class_name;
		}
		
		/**
		 * Valor do atributo "class" do item de i'ndice I'MPAR da lista no Formula'rio
		 *
		 * @var string
		 */
		private $list_root_odd_class_name = '';
		
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
		 * Retorna o valor do atributo "class" para os itens de i'ndice I'MPAR da lista no Formula'rio
		 *
		 * @return string valor do atributo classe
		 */			
		public function getListRootOddClassName() {
			return $this->list_root_odd_class_name;
		}
		
		/**
		 * Permite ou nao que haja a cricao de quebra de linha automa'tica entre os itens do Formula'rio
		 *
		 * @var boolean
		 */
		private $new_line = true;
		
		/**
		 * Define a permissao de criacao de quebra de linha automa'tica entre os objetos do Formula'rio
		 *
		 * @param boolean $new_line
		 * @return void
		 */
		public function setNewLine( $new_line = true ) {
			$this->new_line = $new_line;
		}
		
		/**
		 * Retorna a permissao para a criacao de quebra de linha automa'tica entre os objetos do Formula'rio
		 *
		 * @return boolean
		 */
		public function getNewLine() {
			return $this->new_line;
		}
		
		/**
		 * Co'digo HTML responsa'vel pela quebra de linha automa'tica entre os itens do Formula'rio
		 *
		 * @var string
		 */
		private $new_line_content = '<br style="clear:both" />';
		
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
		 * Retorna o Co'digo HTML responsa'vel pela quebra auma'tica de linha entre os itens do Formula'rio
		 *
		 * @return string
		 */
		public function getNewLineContent() {
			return $this->new_line_content;
		}
		
		/**
		 * Caractere de Separacao entre Label e Input
		 *
		 * @var string
		 */
		private $char_sep = ':';
		
		/**
		 * Define o Caractere de Separacao entre Label e Input
		 *
		 * @param string $char_sep
		 * @return void
		 */
		public function setCharSep( $char_sep = ':' ) {
			$this->char_sep = $char_sep;
		}
		
		/**
		 * Retorna o Caractere de Separacao entre Label e Input
		 *
		 * @return string
		 */
		public function getCharSep() {
			return $this->char_sep;
		}
		
		/**
		 * Permissao de Adicionar o atributo title ao Label para que este seja exatamente igual ao do Objeto cujo Label se Refere
		 *
		 * @var boolean
		 */
		private $label_title = true;
		
		/**
		 * Define a Permissao de Adicionar o atributo title ao Label para que este seja exatamente igual ao do Objeto cujo Label se Refere
		 *
		 * @param boolean $permission
		 * @return void
		 */
		public function setLabelTitle( $permission = true ) {
			$this->label_title = $permission;
		}
		
		/**
		 * Retorna a Permissao de Adicionar o atributo title ao Label para que este seja exatamente igual ao do Objeto cujo Label se Refere
		 *
		 * @return boolean
		 */
		public function getLabelTitle() {
			return $this->label_title;
		}
	}
?>