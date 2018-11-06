<?php
defined( '_JEXEC' ) or die;

class plgContentPlg_sumdu_youtube extends JPlugin
{
	/**
	 * Load the language file on instantiation. Note this is only available in Joomla 3.1 and higher.
	 * If you want to support 3.0 series you must override the constructor
	 *
	 * @var    boolean
	 * @since  3.1
	 */
    protected $autoloadLanguage = true;

	function onContentPrepare($context, &$article, &$params, $limitstart = 0) {
        $pregYoutube = '/(\{youtube\s?src\=\"(.+?)\"\s?(width\=\"(.+?)\")?\s?(height\=\"(.+?)\")?\})(\{\/youtube\})/s';
        $youtubeWindow = [];
        while (preg_match($pregYoutube, $article->text, $segments)) {
            $url = $segments[2];
            $width = $segments[4];
            $height = $segments[6];

            if (!isset($width) || empty($width)) {
                $width = $this->params->get('width');
            }
            
            if (!isset($height) || empty($height)) {
                $height = $this->params->get('height');
            } 

            $preparedText = '<iframe width="'. $width .'" height="'. $height .'" src="'. $url .'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
            $article->text = str_replace($segments[0], $preparedText, $article->text);
        }
        
		return true;
    }
}
?>
