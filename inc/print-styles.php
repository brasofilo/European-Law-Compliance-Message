<?php
! defined( 'ABSPATH' ) AND exit;
/**
 * @package    WordPress
 * @subpackage EU Cookie Law Compliance Message
 */


echo <<<HTML
<style type="text/css">
#cookie {
	{$css['absPosition']}
	left:0;
	top:0;
	width:100%;
	height:100%;
	background:rgb( {$css['backgroundColour']} );
	background:rgba( {$css['backgroundColour']} , {$css['backgroundTransparency']} );
	z-index:9999;
}
#cookie #wrapper {
	padding: {$css['padding']};
}
#cookie h2 {
	color: {$css['titleColour']};
	display: block;
	text-align: center;
	font-family: {$css['titleFont']};
	font-size: {$css['titleSize']} 
}
#cookie p {
	color: {$css['messageColour']};
	display:block;
	font-family: {$css['messageFont']}; 
	font-size: {$css['messageSize']} 
}
#cookie #close{
	text-align:center;
}
#closecookie{
	color: {$css['closeColour']};
	font-family: {$css['closeFont']};
	font-size: {$css['closeSize']};
	text-decoration:none
}
@media only screen and (min-width: 480px) {
	#cookie {
		height:auto;
	}
	#cookie #wrapper{
		max-width: {$css['maxWidth']};
		margin-left:auto;
		margin-right:auto;
	}
	#cookie h2{
		width:18%;
		margin-top:0;
		margin-right:2%;
		float:left;
		text-align:right;
	}
	#cookie p {
		width:68%;
		margin:0 1%;
		float:left;
	}
	#cookie #close{
		width:9%;
		float:right;
	}
}
</style>
HTML;
		
		