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

/**
 * Class FiguresRegistry
 * Реестр синглтон фигур
 */
class FiguresRegistry
{
    use singleTone;

    private $_figures = [];

    public static function addFigures($figures)
    {
        foreach ($figures as $figure) {
            self::getInstance()->_figures[] = $figure;
        }
        return self::getInstance();
    }

    public static function getFigures()
    {
        return self::getInstance()->_figures;
    }

    protected function init()
    {

    }
}

/**
 * Class ManageFormat
 * Супер Тип форматов
 */
abstract class ManageFormat
{
    protected $registryShapes;

    abstract public function make();

    public function __construct(FiguresRegistry $figuresRegistry)
    {
        $this->registryShapes = $figuresRegistry;
    }
}

/**
 * Class ManagePlots
 * формат для точек
 */
class ManagePlots extends ManageFormat
{
    public function make()
    {
        //TODO: use $this->registryShapes->getFigures()
        echo 'готовим точки';
    }
}

/**
 * Class ManageImage
 * Формат для изображения
 */
class ManageImage extends ManageFormat
{
    public function make()
    {
        //TODO: use $this->registryShapes->getFigures()
        echo 'готовим картинку';
    }
}

/**
 * Class ManageJson
 * Формат для json
 */
class ManageJson extends ManageFormat
{
    public function make()
    {
        echo 'готовим json:' . PHP_EOL;
        print_r(json_encode($this->registryShapes->getFigures()));
    }
}

/**
 * Class FigureManager
 * Менеджер фигур
 */
class FigureManager
{
    public function __construct(manageFormat $manageFormat)
    {
        $manageFormat->make();
        echo PHP_EOL . PHP_EOL;
    }
}


$shapes = [
    ['type' => 'circle', 'params' => [10, 20, 30]],
    ['type' => 'circle', 'params' => [100, 200, 300]],
];

$image = [
    ['type' => 'circle', 'params' => [10, 20, 30]],
    ['type' => 'circle', 'params' => [100, 200, 300]],
    ['type' => 'triangle', 'params' => [200, 10, 200, 300]],
];


FiguresRegistry::addFigures($shapes);

FiguresRegistry::addFigures($image);

FiguresRegistry::addFigures([
    ['type' => 'circle', 'params' => [10, 20, 30]],
    ['type' => 'circle', 'params' => [100, 200, 300]],
    ['type' => 'triangle', 'params' => [200, 10, 200, 300]]
]);



$figureManager = new FigureManager(new ManagePlots(FiguresRegistry::getInstance()));
$figureManager = new FigureManager(new ManageJson(FiguresRegistry::getInstance()));
$figureManager = new FigureManager(new ManageImage(FiguresRegistry::getInstance()));

echo PHP_EOL;