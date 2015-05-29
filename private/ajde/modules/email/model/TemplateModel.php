<?php

class TemplateModel extends Ajde_Model_With_I18n
{
	protected $_autoloadParents = true;
	protected $_displayField = 'name';

    public function displayLang()
    {
        Ajde::app()->getDocument()->getLayout()->getParser()->getHelper()->requireCssPublic('core/flags.css');

        $lang = Ajde_Lang::getInstance();
        $currentLang = $this->get('lang');
        if ($currentLang) {
            $image = '<img src="" class="flag flag-' . strtolower(substr($currentLang, 3, 2)) . '" alt="' . $currentLang . '" />';
            return $image . $lang->getNiceName($currentLang);
        }
        return '';
    }

    /**
     * @return TemplateModel
     */
    public function getMaster()
    {
        return parent::getMaster();
    }

    public function getContent($markup = '', $inlineCss = true)
    {
        $content = $markup . parent::getContent();
        $master = $this->getMaster()->hasLoaded() ? $this->getMaster() : false;
        $style = $this->hasNotEmpty('style') ? $this->getStyle() : false;

        if ($style) {
            $stylesheet = PUBLIC_DIR . 'css' . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'email' . DIRECTORY_SEPARATOR . $style . '.css';
            if (!is_file($stylesheet)) {
                throw new Ajde_Exception('Stylesheet ' . $stylesheet . ' not found');
            }
            $stylesheetContent = file_get_contents($stylesheet);
            $content = "<html><body><style>" . $stylesheetContent . "</style>" . $content . "</body></html>";
        }

        if ($master) {
            $masterContent = $master->getContent('', false);
            $content = str_replace('%body%', $content, $masterContent);
        }

        if ($inlineCss && ($style || ($master && $master->getStyle()))) {
            $content = html_entity_decode( self::inlineCss($content) );
        }

        return $content;
    }

    public static function inlineCss($html)
    {
        $url = 'https://inlinestyler.torchbox.com:443/styler/convert/';
        $data = array(
            'returnraw' => '1',
            'source' => $html
        );
        return Ajde_Http_Curl::post($url, $data);
    }

    public function getSubject()
    {
        return parent::getSubject();
    }
}
