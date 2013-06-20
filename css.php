<?php

class CSS {
	
	protected $rule_blocks_reference;
	public $rule_blocks;
	
	public function __construct() {
		$this->rule_blocks_reference = array();
		$this->rule_blocks = array();
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
		if( strpos($step, ',') ) {
			$selectors = explode(',', $selector);	
		}
		
		# - then at spaces (if present)
        if( strstr($selector, ' ') ) {
        	# if multiple selectors present (from commas)
        	if( !empty($selectors) ) {
        		foreach( $selectors as $sel ) {
					$sel = explode(' ', $sel);
				}
			}
			else
				$selectors = explode(' ', $selector);
		}
		
		return new CSSRuleBlock();
	}
	
	
	protected function find_rule_block( $sel ) {
		$blocks = $this->rule_blocks;
		if( array_key_exists($sel, $blocks) ) {
			return $blocks[$sel];
		}
		
		
	}
	
	private function create_rule_object( $selector ) {
		$new_rule_block = new CSSRuleBlock();
		$nrb = $this->rule_blocks[] = $new_rule_block;
		
		// set up reference
		
		end($nrb);
		$this->rule_blocks_reference[key($nrb)] = $selector;
		reset($nrb);
	}
}


class CSSRuleBlock extends CSS {
	
	public $selector;
	public $_rules;
	
	protected function __construct( $selector ) {
		$this->_rules = array();
		$this->selector = $selector;
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