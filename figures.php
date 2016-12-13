<?php

/**
 * Created by PhpStorm.
 * User: vadim
 * Date: 13.12.16
 * Time: 19:44
 */
trait singleTone
{
    protected static $_instance;

    final protected function __construct()
    {
        $this->init();
    }

    final public function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self;
        }
        return self::$_instance;
    }

    final protected function __wakeup()
    {
    }

    final protected function _clone()
    {
    }

}

class FiguresRegistry
{
    use singleTone;

    private $_figures = [];

    public static function addFigures($figures)
    {
        foreach ($figures as $figure) {
            self::getInstance()->_figures[] = $figure;
        }
    }

    public static function getFigures()
    {
        return self::getInstance()->_figures;
    }

    protected function init()
    {

    }
}

abstract class ManageFormat
{
    protected $registryShapes;

    abstract public function make();

    public function __construct(FiguresRegistry $figuresRegistry)
    {
        $this->registryShapes = $figuresRegistry;
    }
}

class ManagePlots extends ManageFormat
{
    public function make()
    {
        //TODO: use $this->registryShapes->getFigures()
        echo 'готовим точки' . PHP_EOL;
    }
}

class ManageImage extends ManageFormat
{
    public function make()
    {
        //TODO: use $this->registryShapes->getFigures()
        echo 'готовим картинку' . PHP_EOL;
    }
}

class ManageJson extends ManageFormat
{
    public function make()
    {
        print_r(json_encode($this->registryShapes->getFigures()));
    }
}

class FigureManager
{
    public function __construct(manageFormat $manageFormat)
    {
        $manageFormat->make();
    }
}


$shapes = [
    ['type' => 'circle', 'params' => [10, 20, 30]],
    ['type' => 'circle', 'params' => [100, 200, 300]]
];


FiguresRegistry::addFigures($shapes);
$figureManager = new FigureManager(new ManageImage(FiguresRegistry::getInstance()));
$figureManager = new FigureManager(new ManagePlots(FiguresRegistry::getInstance()));
$figureManager = new FigureManager(new ManageJson(FiguresRegistry::getInstance()));
echo PHP_EOL;