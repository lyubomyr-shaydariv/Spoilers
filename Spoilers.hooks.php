<?php
/**
 * Spoilers
 * Spoilers Hooks
 *
 * @author: Telshin
 * @license: LGPLv3 http://opensource.org/licenses/lgpl-3.0.html
 * @package: Spoilers
 * @link: http://www.mediawiki.org/wiki/Extension:Spoilers
 */
class Spoilers {
	/**
	 * Hooks Initialized
	 *
	 * @var		boolean
	 */
	private static $initialized = false;

	/**
	 * Initiates some needed classes.
	 *
	 * @access	public
	 * @return	void
	 */
	static public function init() {
		global $wgOut;

		if (!self::$initialized) {
			$wgOut->addModules('ext.spoilers');
			self::$initialized = true;
		}
	}

	/**
	 * Sets up this extensions parser functions.
	 *
	 * @access		public
	 * @param		Parser	$parser
	 * @internal	param	\Parser $object object passed as a reference.
	 * @return		boolean	true
	 */
	static public function onParserFirstCallInit( Parser &$parser ) {
		$parser->setHook( "spoiler", "Spoilers::parseSpoilerTag" );

		return true;
	}

	/**
	 * Parses the <spoiler> tag.
	 *
	 * @access	public
	 * @param	string	User input between <spoiler>
	 * @param	array	Array of arguments from the opening spoiler tag.
	 * @param	object	Mediawiki Parser Object
	 * @param	object	PPFrame object
	 * @return	string	HTML
	 */
	static public function parseSpoilerTag( $input, array $args, Parser $parser, PPFrame $frame ) {
		self::init();
		$renderedInput = $parser->recursiveTagParse( $input );
		$output =	"<div class='spoilers'>
						<div class='spoilers-button-container'>
							<span class='spoilers-button'>
								<span class='spoilers-show'>" . ( isset( $args['show'] ) ? htmlentities( $args['show'], ENT_QUOTES) : wfMessage('spoilers_show_default' )->text() ) . "</span>
								<span class='spoilers-hide' style='display:none;'>" . ( isset( $args['hide'] ) ? htmlentities( $args['hide'], ENT_QUOTES ) : wfMessage('spoilers_hide_default')->text() ) . "</span>
							</span>
						</div>
						<div class='spoilers-body' style='display:none;'></div>
						<!--{$renderedInput}-->
					</div>";
		return $output;
	}
}
