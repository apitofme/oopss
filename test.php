<?php
# Simple Array to Object conversion using PHP's built in JSON functionality
function array_to_object( $arr ) {
	return json_decode( json_encode($arr) );
}

$S1 = new stdClass();
$arr1 = array(
	'#wrapper' => array(
#		'_rules' => array('rule1', 'rule2'),
		'.header' => array(
#			'_rules' => array('rule1', 'rule2'),
			'ul.menu' => array(
#				'_rules' => array('rule1', 'rule2')
			)
		)
	)
);
reset($arr1);
$S1->styles = array_to_object($arr1);
var_dump( $S1 );


$S2 = new stdClass();
$arr2 = array('#wrapper');
#$arr2 = array('#wrapper', '.header', 'ul.menu');

#$current = current($arr2);
#$next = next($arr2);
#$last = end($arr2);
#$prev = prev($arr2);

$arr3 = array();
$rules = array( '_rules' => '');
if( count($arr2) > 1 ) {
	
	while( !empty($arr2) ) {
		
		if( !empty($arr3) ) {
			$selector = array_pop($arr2);
			$data = $arr3;
			$arr3 = array_merge( array($selector => $data), $rules );
		}
		
		else {
			$selector = array_pop($arr2);
			$arr3[$selector] = $rules;
		}
		
	}
	
	$S2->styles = array_to_object($arr3);
	
}
else {
	$selector = $arr2[0];
	#$S2->styles = (object) array( $selector => $rules);
	$S2->styles = array_to_object( array($selector => $rules) );
}

var_dump( $arr3 );
var_dump( $S2 );

/*
$styles = array();

$styles['#wrapper'] = array('_rules' => array('rule1', 'rule2'));
$styles['#wrapper']['.header'] = array('_rules' => array('rule1', 'rule2'));
$styles['#wrapper']['.footer'] = array('_rules' => array('rule1', 'rule2'));

var_dump($styles);
print '<hr />';

$site_title = array(
	'#wrapper' => array(
		'.header' => array(
			'.title' => array(
				'_rules' => array('rule1', 'rule2')
			)
		)
	)
);

$styles = array_merge_recursive($styles, $site_title);
var_dump($styles);

print '<hr />';


$main = array(
	'#main' => array(
		'_rules' => array('rule1', 'rule2'),
		'.header' => array(
			'_rules' => array('rule1', 'rule2')
		),
		'.footer' => array(
			'_rules' => array('rule1', 'rule2')
		)
	)
);

$styles = array_merge_recursive($styles, $main);
var_dump($styles);

print '<hr />';
*/
?>