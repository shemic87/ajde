<?php

class Ajde_Template_Parser_Phtml_Helper extends Ajde_Object_Standard
{
    /**
     * @var Ajde_Template_Parser
     */
    protected $_parser = null;

    /**
     * @param Ajde_Template_Parser $parser
     */
    public function __construct(Ajde_Template_Parser $parser)
    {
        $this->_parser = $parser;
    }

    /**
     * @return Ajde_Template_Parser
     */
    public function getParser()
    {
        return $this->_parser;
    }

    /**
     * @return Ajde_Document
     */
    public function getDocument()
    {
        if ($this->getParser()->getTemplate()->has('document')) {
            return $this->getParser()->getTemplate()->getDocument();
        } else {
            return Ajde::app()->getDocument();
        }
    }

    /************************
     * Ajde_Component_Js
     ************************/

    /**
     * @param string $name
     * @param string $version
     *
     * @return void
     */
    public function requireJsLibrary($name, $version = false)
    {
        return Ajde_Component_Js::processStatic($this->getParser(), ['library' => $name, 'version' => $version]);
    }

    /**
     * @param string $action
     * @param string $format
     * @param string $base
     * @param int    $position
     *
     * @return void
     */
    public function requireJs(
        $action,
        $format = 'html',
        $base = null,
        $position = Ajde_Document_Format_Html::RESOURCE_POSITION_DEFAULT,
        $arguments = ''
    ) {
        return Ajde_Component_Js::processStatic($this->getParser(), [
            'action'    => $action,
            'format'    => $format,
            'base'      => $base,
            'position'  => $position,
            'arguments' => $arguments,
        ]);
    }

    /**
     * @param string $action
     * @param string $format
     * @param string $base
     *
     * @return void
     */
    public function requireJsFirst($action, $format = 'html', $base = null, $arguments = '')
    {
        return $this->requireJs($action, $format, $base, Ajde_Document_Format_Html::RESOURCE_POSITION_FIRST,
            $arguments);
    }

    /**
     * @param string $action
     * @param string $format
     * @param string $base
     *
     * @return void
     */
    public function requireJsTop($action, $format = 'html', $base = null, $arguments = '')
    {
        return $this->requireJs($action, $format, $base, Ajde_Document_Format_Html::RESOURCE_POSITION_TOP, $arguments);
    }

    /**
     * @param string $filename
     * @param int    $position
     *
     * @return void
     */
    public function requireJsPublic(
        $filename,
        $position = Ajde_Document_Format_Html::RESOURCE_POSITION_DEFAULT,
        $arguments = ''
    ) {
        return Ajde_Component_Js::processStatic($this->getParser(),
            ['filename' => $filename, 'position' => $position, 'arguments' => $arguments]);
    }

    /**
     * @param string $url
     * @param int    $position
     *
     * @return void
     */
    public function requireJsRemote(
        $url,
        $position = Ajde_Document_Format_Html::RESOURCE_POSITION_DEFAULT,
        $arguments = ''
    ) {
        return Ajde_Component_Js::processStatic($this->getParser(),
            ['url' => $url, 'position' => $position, 'arguments' => $arguments]);
    }

    /************************
     * Ajde_Component_Css
     ************************/

    /**
     * @param string $name
     * @param string $version
     *
     * @return void
     */
    public function requireGWebFont($family, $weight = [400], $subset = ['latin'])
    {
        return Ajde_Component_Css::processStatic($this->getParser(),
            ['fontFamily' => $family, 'fontWeight' => $weight, 'fontSubset' => $subset]);
    }

    /**
     * @param string $action
     * @param string $format
     * @param string $base
     * @param int    $position
     *
     * @return void
     */
    public function requireCss(
        $action,
        $format = 'html',
        $base = null,
        $position = Ajde_Document_Format_Html::RESOURCE_POSITION_DEFAULT,
        $arguments = ''
    ) {
        return Ajde_Component_Css::processStatic($this->getParser(), [
            'action'    => $action,
            'format'    => $format,
            'base'      => $base,
            'position'  => $position,
            'arguments' => $arguments,
        ]);
    }

    /**
     * @param string $action
     * @param string $format
     * @param string $base
     *
     * @return void
     */
    public function requireCssFirst($action, $format = 'html', $base = null, $arguments = '')
    {
        return $this->requireCss($action, $format, $base, Ajde_Document_Format_Html::RESOURCE_POSITION_FIRST,
            $arguments);
    }

    /**
     * @param string $action
     * @param string $format
     * @param string $base
     *
     * @return void
     */
    public function requireCssTop($action, $format = 'html', $base = null, $arguments = '')
    {
        return $this->requireCss($action, $format, $base, Ajde_Document_Format_Html::RESOURCE_POSITION_TOP, $arguments);
    }

    /**
     * @param string $filename
     * @param int    $position
     *
     * @return void
     */
    public function requireCssPublic(
        $filename,
        $position = Ajde_Document_Format_Html::RESOURCE_POSITION_DEFAULT,
        $arguments = ''
    ) {
        return Ajde_Component_Css::processStatic($this->getParser(),
            ['filename' => $filename, 'position' => $position, 'arguments' => $arguments]);
    }

    /**
     * @param string $url
     * @param int    $position
     *
     * @return void
     */
    public function requireCssRemote(
        $url,
        $position = Ajde_Document_Format_Html::RESOURCE_POSITION_DEFAULT,
        $arguments = ''
    ) {
        return Ajde_Component_Css::processStatic($this->getParser(),
            ['url' => $url, 'position' => $position, 'arguments' => $arguments]);
    }

    /************************
     * Ajde_Component_Include
     ************************/

    /**
     * @param string $route
     *
     * @return string
     */
    public function includeModule($route, $vars = [])
    {
        return Ajde_Component_Include::processStatic($this->getParser(), ['route' => $route, 'vars' => $vars]);
    }

    /************************
     * Ajde_Component_Form
     ************************/

    /**
     * @param string $route
     * @param mixed  $id
     *
     * @return string
     */
    public function ACForm($route, $id = null, $class = null)
    {
        return Ajde_Component_Form::processStatic($this->getParser(),
            ['route' => $route, 'id' => $id, 'class' => $class]);
    }

    /**
     * @param string $route
     * @param mixed  $id
     *
     * @return string
     */
    public function ACAjaxForm($route, $id = null, $class = null, $format = 'json')
    {
        return Ajde_Component_Form::processStatic($this->getParser(),
            ['route' => $route, 'ajax' => true, 'id' => $id, 'class' => $class, 'format' => $format]);
    }

    /**
     * @param string $target
     *
     * @return string
     */
    public function ACAjaxUpload($name, $options = [], $id = null, $class = null)
    {
        return Ajde_Component_Form::processStatic($this->getParser(),
            ['name' => $name, 'upload' => true, 'options' => $options, 'id' => $id, 'class' => $class]);
    }

    /**
     * @param string $route
     * @param mixed  $id
     *
     * @return string
     */
    public function ACEmbedForm($formId)
    {
        return Ajde_Component_Form::processStatic($this->getParser(), ['embed' => true, 'id' => $formId]);
    }

    /************************
     * Ajde_Component_Image
     ************************/

    /**
     * @param string $target
     *
     * @return string
     */
    public function ACImage($attributes)
    {
        return Ajde_Component_Image::processStatic($this->getParser(), $attributes);
    }

    /**
     * @param string $target
     *
     * @return string
     */
    public function ACLazyImage($attributes)
    {
        return Ajde_Component_Image::processStatic($this->getParser(), array_merge($attributes, ['lazy' => true]));
    }

    /************************
     * Ajde_Component_Qrcode
     ************************/

    /**
     * @param string $target
     *
     * @return string
     */
    public function ACQrcode($attributes)
    {
        return Ajde_Component_Qrcode::processStatic($this->getParser(), $attributes);
    }

    /************************
     * Ajde_Component_Markdown
     ************************/

    /**
     * @param string $target
     *
     * @return string
     */
    public function ACMarkdown($attributes)
    {
        return Ajde_Component_Markdown::processStatic($this->getParser(), $attributes);
    }

    /************************
     * Ajde_Component_Embed
     ************************/

    /**
     * @param string $attributes
     *
     * @return string
     */
    public function ACEmbed($attributes)
    {
        return Ajde_Component_Embed::processStatic($this->getParser(), $attributes);
    }

    /************************
     * Ajde_Component_Crud
     ************************/

    /**
     * @param mixed                   $model
     * @param array|Ajde_Crud_Options $options
     *
     * @return Ajde_Crud
     */
    public function ACCrudList($model, $options = [])
    {
        return Ajde_Component_Crud::processStatic($this->getParser(),
            [
                'list'    => true,
                'model'   => $model,
                'options' => $options,
            ]
        );
    }

    /**
     * @param mixed $model
     *
     * @return Ajde_Crud
     */
    public function ACCrudEdit($model, $id, $options = [])
    {
        return Ajde_Component_Crud::processStatic($this->getParser(),
            [
                'edit'    => true,
                'model'   => $model,
                'id'      => $id,
                'options' => $options,
            ]
        );
    }

    /**
     * @param Ajde_Crud $crud
     *
     * @return string
     */
    public function ACCrudMainFilterBadge($crud, $refresh = false)
    {
        return Ajde_Component_Crud::processStatic($this->getParser(),
            [
                'mainfilter' => true,
                'crud'       => $crud,
                'refresh'    => $refresh,
            ]
        );
    }

    /************************
     * Ajde_Component_String
     ************************/

    /**
     * @param mixed $model
     *
     * @return string
     */
    public function ACString($var)
    {
        return Ajde_Component_String::processStatic($this->getParser(),
            [
                'escape' => true,
                'var'    => $var,
            ]
        );
    }

    public function escape($var)
    {
        return $this->ACString($var);
    }

    public function clean($var)
    {
        return Ajde_Component_String::processStatic($this->getParser(),
            [
                'clean' => true,
                'var'   => $var,
            ]
        );
    }
}
