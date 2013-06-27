<?php

/**
 * Global Functions
 * - these are available to call directly outside of a class scope
 */  
# A simple Array to Object conversion using PHP's built in JSON functionality
function array_to_object( $arr ) {
	return json_decode( json_encode($arr) );
}


class CSS {
	
	public $stylesheet;
	
	public function __construct() {
		$this->stylesheet = new CSS_Stylesheet();
		# $this->rule_blocks = new stdClass();
		# then... $this->rule_blocks->wrapper->header->_rules = array(rule1, rule2);
		# ...but this doesn't allow for 'names' to begin with '#' or '.'!!				
	}
	
	
	protected function is_valid_selector( $selector ) {
		if( empty($selector) || !is_string($selector) )
			return false; # throw error "empty selector"
			
		if( preg_match('/[\s#\._a-zA-Z0-9-,:>]+{/gm') )
			return true;
		# else throw error "invalid selector"
	}
	
	
	public function new_rule_block( $selector ) {
		# check selector is valid
        if( !$this->is_valid_selector($selector) ) {
        	throw new Exception('Invalid selector string: ' $selector);
        }
        
        # create temporary storage var
        $selectors = array(); 
        
        ## split selector string
		# - first separate at commas (if present)
		if( strpos($selector, ',') ) {
			$selectors = explode(',', $selector);	
		}
		
		# - then at spaces (if present)
		# (remeber to check if multiple selectors exist from the comma split)
		if( empty($selectors) ) {
			$selectors = explode(' ', $selector);
			
		}
		else {
			# handle multiple selectors from comma split here...
			
		}
		
	}
	
	
	protected function find_rule_block( $sel ) {
		$blocks = $this->rule_blocks;
		if( array_key_exists($sel, $blocks) ) {
			return $blocks[$sel];
		}
		
		
	}
	
	private function create_selector( $selector ) {
		if( is_string($selector) ) {
			if( !strpos($selector, ',') ) {
				if( !strpos($selector, ' ') )
					return new CSSRuleBlock($selector);
				else
					throw new Exception('Selector string contains spaces!');
			}
			else
				throw new Exception('Multiple, comma separated selectors detected!');
		}
		else throw new Exception('Selector is not of type <em>string</em>!');
	}
	
	
	private function create_nested_selectors( $selectors ) {
		if( !is_array($selectors) )
			throw new Exception('Nested selectors not an array!');
		
		if( count($selectors) > 1 ) {
			$styles = array();
			$rules = array('_rules', '');
			
			while( !empty($selectors) ) {
				
				if( !empty($styles) ) {
					$selector = array_pop($selectors);
					$data = $styles;
					$styles = array_merge( array($selector => $data), $rules );
				}
				
				else {
					$selector = array_pop($selectors);
					$styles[$selector] = $rules;
				}
				
			}
			
			$this->stylesheet->styles = array_to_object($styles);
			
		}
		else {
			$selector = $selectors[0];
			$this->stylesheet->styles = (object) array( $selector => $rules);
		}
	}
	
}


class CSS_Stylesheet extends CSS {
	
	public $charset;
	public $styles;
	
	protected function __construct( $charset = 'UTF-8'  ) {
		$this->charset = $charset;
		$this->styles = array();
	}
	
}


class CSSRuleBlock extends CSS {
	
	public $selector;
	public $_rules;
	
	protected function __construct( $selector, $rules = array('_rules', '') ) {
		$this->selector = $selector;
		$this->_rules = $rules;
	}
	
	
	public function set_selector( $selector ) {
		if( !$this->is_valid_selector($selector) )
        	throw new Exception('Invalid selector string: ' $selector);
        
        else $this->selector = $selector;
	}
	
	
	public function add_rule( $property, $value ) {
		$this->_rules[$property] = $value;
		# ~ OR ~
		# $this->_rules[] = array($property => $value); ???
	}
	
	public function add_rules( $rules = array() ) {
		if( !is_array($rules) || empty($rules) ) {
			throw new Exception('Invalid or empty array data!');
		}
		
		# check for indexed array
		if( is_numeric( key($rules) ) ) {
			reset($rules); # reset internal pointer (just in case)
			foreach( $rules as $rule ) {
				$prop = key($rule);
				$val = $rule[$prop];
				$this->add_rule($prop, $val);
			}
		}
		
		# otherwise array is associative
		else array_push( $this->_rules, $rules );
	}
	
	
}

# ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

$stylesheet = new CSS();

$_wrapper = $stylesheet->new_rule_block('#wrapper');
$_wrapper->add_rule('height', '360px');
$_wrapper->add_rules( array(
  'margin'  	=> '0 auto',
  'min-width'   => '600px',
  'max-width'	=> '1200px'
));

$_page_header = $stylesheet->new_rule_block('#page .header'),
$_page_header->add_rules( array(
	'border'    	=> '1px solid #ccc',
	'border-radius' => $_page_header->border_radius('4px'),
	'box-shadow'    => $_page_header->box_shadow('1px 1px 4px rgba(0,0,0,.4)')
));

# ~~ OR ~~
$_page_header->add_rules( array(
	'border'    	=> '1px solid #ccc',
	$_page_header->border_radius('4px'),
	$_page_header->box_shadow('1px 1px 4px rgba(0,0,0,.4)')
));

# ~~ OR OR ~~
$_page_header->add_rule('border', '1px solid #ccc');
$_page_header->border_radius('4px');
$_page_header->box_shadow('1px 1px 4px rgba(0,0,0,.4)');

# ~~ OR OR ~~
$_page_header->add_rule('border', '1px solid #ccc');
$_page_header = $CSS->CSS3->border_radius('4px', $page_header);
$_page_header .= $CSS->CSS3->box_shadow('1px 1px 4px rgba(0,0,0,.4)', $page_header); # does .= work for arrays?


?>