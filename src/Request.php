<?php

namespace Scene7;

class Request
{
    protected $commands = [];
    protected $layers   = [];
    protected $factory;
    protected $baseUrl;

    public function __construct($baseUrl, $image)
    {
        $this->setBaseUrl($baseUrl);
        $this->image = $image;
    }

    protected function setBaseUrl($url)
    {
        $this->baseUrl = $url;
    }

    public function setFactory(Factory $factory)
    {
        $this->factory = $factory;
        return $this;
    }

    public function getCommands()
    {
        return $this->commands;
    }

    public function getLayers()
    {
        return $this->layers;
    }

    public function getQuery()
    {
        return http_build_query($this->commands);
    }

    public function getUri()
    {
        return $this->baseUrl . '?' . $this->getQuery();
    }

    public function __toString()
    {
        return $this->getUri();
    }

    public function newLayer($id = null)
    {
        if (!($this->factory instanceof Factory)) {
            throw new \RuntimeException('Factory not set');
        }

        if ($id === null) {
            $id = $this->getMaxLayer() + 1;
        }

        $layer = $this->factory->newLayer($id);
        $this->addLayer($layer);
        return $layer;
    }

    public function addLayer(Layer $layer)
    {
        $this->layers[$layer->getId()] = $layer;
        return $this;
    }

    public function setAlign($horizontal, $vertical)
    {
        $horizontal = (float) $horizontal;
        $vertical   = (float) $vertical;
        $this->addCommand(array('align' => $horizontal . ',' . $vertical));
        return $this;
    }

    public function setAnchor($x, $y, $normalized = false)
    {
        $x = (float) $x;
        $y = (float) $y;

        $key = $normalized ? 'anchorN' : 'anchor';
        $this->addCommand(array($key => $x . ',' . $y));
        return $this;
    }

    public function setBackgroundColor($color)
    {
        $this->addCommand(array('bgc' => $color));
    }

    public function setCacheControl()
    {

    }

    public function setCrop($cropX, $cropY, $sizeX, $sizeY, $normalized = false)
    {
        $cropX = (float) $cropX;
        $cropY = (float) $cropY;
        $sizeX = (float) $sizeX;
        $sizeY = (float) $sizeY;

        $key = $normalized ? 'cropN' : 'crop';
        $this->addCommand(array(
            $key => $cropX . ',' . $cropY . ',' . $sizeX . ',' . $sizeY
        ));

        return $this;
    }

    public function setDefaultImage($image)
    {
        $this->addCommand(array('defaultImage' => $image));
        return $this;
    }

    public function setFitMode($mode, $upscale)
    {
        if (!in_array($mode, $this->getAllowedFitModes())) {
            throw new \InvalidArgumentException('Invalid fit mode');
        }

        $upscale = (int) (bool) $upscale;
        $this->addCommand(array('fit' => $mode . ',' . $upscale));
        return $this;
    }

    public function getAllowedFitModes()
    {
        return ['fit', 'constrain', 'crop', 'wrap', 'stretch', 'hfit', 'vfit'];
    }

    public function setFormat($format, $pixelType = '', $compression = '')
    {
        if (!in_array($format, $this->getAllowedFormats())) {
            throw new \InvalidArgumentException('Invalid format type');
        }

        if ($pixelType && !in_array($pixelType, $this->getAllowedPixelTypes())) {
            throw new \InvalidArgumentException('Invalid pixel type');
        }

        if ($compression && !in_array($compression, $this->getAllowedCompressionTypes())) {
            throw new \InvalidArgumentException('Invalid compression type');
        }

        $command = $format;

        if ($pixelType) {
            $command .= ',' . $pixelType;
        }

        if ($compression) {
            $command .= ',' . $compression;
        }

        $this->addCommand(array('fmt' => $command));
        return $this;
    }

    public function getAllowedFormats()
    {
        return ['jpeg', 'png', 'png-alpha', 'tif', 'tif-alpha', 'swf', 'swf-alpha', 'eps', 'gif', 'gif-alpha', 'm3u8', 'f4m'];
    }

    public function getAllowedPixelTypes()
    {
        return ['rgb', 'gray', 'cmyk'];
    }

    public function getAllowedCompressionTypes()
    {
        return ['none', 'lzw', 'zip', 'jpeg'];
    }

    public function setHeight($height)
    {
        $height = (int) $height;
        if ($height < 1) {
            throw new \InvalidArgumentException('Height must be an integer greater than 0');
        }

        $this->addCommand(array('hei' => $height));
        return $this;
    }

    public function setOutputColorProfile($object, $renderIntent = null, $blackpointComp = null, $dither = null)
    {
        if (!in_array($renderIntent, $this->getAllowedRenderIntents())) {
            throw new \InvalidArgumentException('Invalid render intent');
        }
    }

    public function getAllowedRenderIntents()
    {
        return array('perceptual', 'relative', 'saturation', 'absolute');
    }

    public function setEmbedColorProfile($embed)
    {
        $this->addCommand(array('iccEmbed' => (int) (bool) $embed));
        return $this;
    }

    public function setId($id = null)
    {
        $id = $id ?: rand(0, PHP_INT_MAX);
        $this->addCommand(array('id' => (int) $id));
        return $this;
    }

    public function setMaxJpegSize($kilobytes)
    {
        if ($kilobytes > 0) {
            $this->addCommand(array('jpegSize' => (int) $kilobytes));
        }

        return $this;
    }

    public function setLocale($locale)
    {
        $this->addCommand(array('locale' => $locale));
        return $this;
    }

    public function mask($object, $serveOrRender = null, Request $nestedRequest = null)
    {
        if ($serveOrRender !== null && !in_array($serveOrRender, ['is', 'ir'])) {
            throw new \InvalidArgumentException('Invalid server/render type. Must be one of "is" or "ir"');
        }
    }

    public function maskUse()
    {

    }

    public function setEmbedPathData($enable)
    {
        $this->addCommand(array('pathEmbed' => (bool) $enable));
        return $this;
    }

    public function setPrintResolution($dpi)
    {
        $this->addCommand(array('printRes' => (int) $dpi));
        return $this;
    }

    public function setQuality($percentage, $chroma = null)
    {
        $percentage = (int) $percentage;
        if ($percentage < 1 || $percentage > 100) {
            throw new \InvalidArgumentException('Quality percentage must be between 1 and 100');
        }

        $quality = $percentage;
        if ($chroma !== null) {
            $quality .= ',' . ((int) (bool) $chroma);
        }

        $this->addCommand(array('qlt' => $quality));
        return $this;
    }

    public function setColorQuantization($type, $disableDiffuse = false, $numColors = null, $colorList = null)
    {
        if (!in_array($type, $this->getAllowedColorQuantizationTypes())) {
            throw new \InvalidArgumentException('Invalid palette type');
        }

        $quantize = $type;
        if ($disableDiffuse || $numColors !== null || $colorList !== null) {
            $quantize .= ',' . ($disableDiffuse ? 'off' : 'diffuse');
        }

        if ($numColors !== null || $colorList !== null) {
            $quantize .= ',' . $numColors;
        }

        if ($colorList !== null) {
            $quantize .= ',' . $colorList;
        }

        $this->addCommand(array('quantize' => $quantize));
        return $this;
    }

    public function setViewRectangle($coordX, $coordY, $sizeX, $sizeY, $scale = null)
    {
        $coordX = (float) $coordX;
        $coordY = (float) $coordY;
        $sizeX = (float) $sizeX;
        $sizeY = (float) $sizeY;

        $rectangle = $coordX . ',' . $coordY . ',' . $sizeX . ',' . $sizeY;
        if ($scale !== null) {
            $rectangle .= ',' . ((float) $scale);
        }

        $this->addCommand(array('rect' => $rectangle));
        return $this;
    }

    public function getAllowedColorQuantizationTypes()
    {
        return array('adaptive', 'web', 'mac');
    }

    public function setRequestType($type, array $options = array())
    {
        if (!in_array($type, $this->getAllowedRequestTypes())) {
            throw new \InvalidArgumentException('Invalid request type');
        }

        $this->_setRequestType($type, $options);
        return $this;
    }

    protected function _setRequestType($type, array $options = array())
    {
        // Set all of the possible options once so we don't repeat it for each type.
        $responseType = $options['responseType'] ?: null;
        $encoding = $options['encoding'] ?: null;

        if (isset($options['id'])) {
            $this->setId($options['id']);
        }

        if (isset($options['format'])) {
            $this->setFormat($options['format']);
        }

        if (isset($options['file'])) {
            $this->setFile($options['file']);
        }

        if (isset($options['message'])) {
            $this->setMessage($options['message']);
        }

        if (isset($options['value'])) {
            $this->setValue($options['value']);
        }

        switch ($type) {
            case 'catalogprops':
                $this->setRequestTypeCatalogProps($responseType);
                break;
            case 'exists':
                $this->setRequestTypeExists($responseType);
                break;
            case 'imageprops':
                $this->setRequestTypeImageProps($responseType);
                break;
            case 'imageset':
                $this->setRequestTypeImageSet($responseType, $encoding);
                break;
            case 'img':
                $this->setRequestTypeImage();
                break;
            case 'loadcache':
                $this->setRequestTypeLoadCache();
                break;
            case 'map':
                $this->setRequestTypeMap($responseType, $encoding);
                break;
            case 'mask':
                $this->setRequestTypeMask();
                break;
            case 'mbrSet':
                $this->setRequestTypeMultiBitRateData($responseType, $encoding);
                break;
            case 'message':
                $this->setRequestTypeMessage();
                break;
            case 'props':
                $this->setRequestTypeProps($responseType);
                break;
            case 'resolve':
                $this->setRequestTypeResolve();
                break;
            case 'saveToFile':
                $this->setRequestTypeSaveToFile();
                break;
            case 'serverprops':
                $this->setRequestTypeServerProps($responseType);
                break;
            case 'set':
                $this->setRequestTypeSet($responseType, $encoding);
                break;
            case 'targets':
                $this->setRequestTypeTargets($responseType, $encoding);
                break;
            case 'tmb':
                $this->setRequestTypeThumbnail();
                break;
            case 'userdata':
                $this->setRequestTypeUserData($responseType, $encoding);
                break;
            case 'validate':
                $this->setRequestTypeValidate($responseType);
                break;
            case 'xlate':
                $this->setRequestTypeTranslate($responseType);
                break;
            case 'xmp':
                $this->setRequestTypeXmp();
                break;
            default:
                $this->setRequestTypeServerProps($responseType);
        }
    }

    /**
     * This is purely a helper function to lessen the amount of duplicated code
     * @see $this->_setRequestType() for more
     *
     * @param string $requestType
     * @param string|null $responseType
     */
    protected function _setRequestType1($requestType, $responseType = null)
    {
        if ($responseType !== null && !in_array($responseType, $this->getAllowedResponseTypes())) {
            throw new \InvalidArgumentException('Invalid response type');
        }

        $req = $requestType;

        if ($responseType !== null) {
            $req .= ',' . ($responseType ?: 'text');
        }

        $this->addCommand(array('req' => $req));
    }

    /**
     * This is purely a helper function to lessen the amount of duplicated code
     * @see $this->_setRequestType() for more
     *
     * @param string $requestType
     * @param string|null $responseType
     * @param string|null $encoding
     */
    protected function _setRequestType2($requestType, $responseType = null, $encoding = null)
    {
        if ($responseType !== null && !in_array($responseType, $this->getAllowedResponseTypes())) {
            throw new \InvalidArgumentException('Invalid response type');
        }

        $req = $requestType;

        if ($responseType !== null || $encoding !== null) {
            $req .= ',' . ($responseType ?: 'text');
        }

        if ($encoding !== null) {
            // @todo should this just be empty or does it have a default? If it has a default, what is it?
            $req .= ',' . ($encoding ?: 'UTF-8');
        }

        $this->addCommand(array('req' => $req));
    }

    public function setRequestTypeCatalogProps($responseType = null)
    {
        $this->_setRequestType1('catalogprops', $responseType);
        return $this;
    }

    public function setRequestTypeExists($responseType = null)
    {
        $this->_setRequestType1('exists', $responseType);
        return $this;
    }

    public function setRequestTypeImageProps($responseType = null)
    {
        $this->_setRequestType1('imageprops', $responseType);
        return $this;
    }

    public function setRequestTypeImageSet($responseType = null, $encoding = null)
    {
        $this->_setRequestType2('imageset', $responseType, $encoding);
        return $this;
    }

    public function setRequestTypeImage()
    {
        // @todo just unset the data?
        $this->addCommand(array('req' => 'img'));
        return $this;
    }

    public function setRequestTypeLoadCache()
    {
        $this->addCommand(array('req' => 'loadcache'));
        return $this;
    }

    public function setRequestTypeMap($responseType = null, $encoding = null)
    {
        $this->_setRequestType2('map', $responseType, $encoding);
        return $this;
    }

    public function setRequestTypeMask()
    {
        $this->addCommand(array('req' => 'mask'));
        return $this;
    }

    public function setRequestTypeMultiBitRateData($responseType = null, $encoding = null)
    {
        $this->_setRequestType2('mbrSet', $responseType, $encoding);
        return $this;
    }

    public function setRequestTypeMessage()
    {
        $this->addCommand(array('req' => 'message'));
        return $this;
    }

    public function setRequestTypeProps($responseType = null)
    {
        $this->_setRequestType1('props', $responseType);
        return $this;
    }

    public function setRequestTypeResolve()
    {
        $this->addCommand(array('req' => 'resolve'));
        return $this;
    }

    public function setRequestTypeSaveToFile()
    {
        $this->addCommand(array('req' => 'saveToFile'));
        return $this;
    }

    public function setRequestTypeServerProps($responseType = null)
    {
        $this->_setRequestType1('serverprops', $responseType);
        return $this;
    }

    public function setRequestTypeServerStatistics($responseType = null)
    {
        $this->_setRequestType1('serverstatistics', $responseType);
        return $this;
    }

    public function setRequestTypeSet($responseType = null, $encoding = null)
    {
        $this->_setRequestType2('set', $responseType, $encoding);
        return $this;
    }

    public function setRequestTypeTargets($responseType = null, $encoding = null)
    {
        // @todo change to only allow text and xml response type
        $this->_setRequestType2('targets', $responseType, $encoding);
        return $this;
    }

    public function setRequestTypeThumbnail()
    {
        $this->addCommand(array('req' => 'tmb'));
        return $this;
    }

    public function setRequestTypeUserData($responseType = null, $encoding = null)
    {
        // @todo change to only allow text and xml response type
        $this->_setRequestType2('userdata', $responseType, $encoding);
        return $this;
    }

    public function setRequestTypeValidate($responseType = null)
    {
        $this->_setRequestType1('userdata', $responseType);
        return $this;
    }

    public function setRequestTypeTranslate($responseType = null)
    {
        $this->_setRequestType1('xlate', $responseType);
        return $this;
    }

    public function setRequestTypeXmp()
    {
        $this->addCommand(array('req' => 'xmp'));
        return $this;
    }

    public function getAllowedResponseTypes()
    {
        return array('text', 'javascript', 'xml', 'json');
    }

    public function getAllowedRequestTypes()
    {
        return array(
            'catalogprops', 'exists', 'imageprops', 'imageset', 'img', 'loadcache',
            'map', 'mask', 'message', 'props', 'resolve', 'saveToFile', 'serverprops',
            'serverstatistics', 'set', 'targets', 'tmb', 'userdata', 'validate', 'xlate', 'xmp'
        );
    }

    public function setResolution($resolution)
    {
        $this->addCommand(array('res' => (int) $resolution));
        return $this;
    }

    public function setResamplingMode($mode)
    {
        if (!in_array($mode, $this->getAllowedResamplingModes())) {
            throw new \InvalidArgumentException('Invalid resampling mode');
        }

        $this->addCommand(array('resMode' => $mode));
        return $this;
    }

    public function getAllowedResamplingModes()
    {
        return array('bilin', 'bicub', 'sharp2', 'trilin');
    }

    public function setRegionOfInterest($coordX, $coordY, $sizeX, $sizeY)
    {
        $coordX = (int) $coordX;
        $coordY = (int) $coordY;
        $sizeX = (int) $sizeX;
        $sizeY = (int) $sizeY;

        $region = $coordX . ',' . $coordY . ',' . $sizeX . ',' . $sizeY;

        $this->addCommand(array('rgn' => $region));
        return $this;
    }

    public function setScale($factor)
    {
        $factor = (float) $factor;
        if ($factor < 0) {
            throw new \InvalidArgumentException('Factor must be greater than 0');
        }

        $this->addCommand(array('scale' => $factor));
        return $this;
    }

    public function setScaleView($factor)
    {
        $factor = (float) $factor;
        if ($factor < 0) {
            throw new \InvalidArgumentException('Factor must be greater than 0');
        }

        $this->addCommand(array('scl' => $factor));
        return $this;
    }

    public function setTemplate($template)
    {
        $this->addCommand(array('template' => $template));
        return $this;
    }

    public function setType($type)
    {
        $this->addCommand(array('type' => $type));
        return $this;
    }

    public function setWidth($width)
    {
        $width = (int) $width;
        if ($width < 1) {
            throw new \InvalidArgumentException('Width must be an integer greater than 0');
        }

        $this->addCommand(array('wid' => $width));
        return $this;
    }

    public function setXmpEmbed($embed)
    {
        $this->addCommand(array('xmpEmbed' => (int) (bool) $embed));
        return $this;
    }

    public function setMessage($message)
    {
        $this->addCommand(array('message' => $message));
    }

    // from saveToFile req type
    public function setName($name)
    {
        $this->addCommand(array('name' => $name));
        return $this;
    }

    // from saveToFile req type
    public function setTimeout($milliseconds)
    {
        $this->addCommand(array('timeout' => (int) $milliseconds));
        return $this;
    }

    protected function addCommand(array $commands)
    {
        $this->commands = array_merge($this->commands, $commands);
        return $this;
    }

    public function getMaxLayer()
    {
        return max(array_keys($this->layers));
    }
}