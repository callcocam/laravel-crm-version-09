<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace SIGA\LvTable\Decorator\Cell;

use SIGA\LvTable\Decorator\Exception;

class ViewDecorator extends AbstractCellDecorator
{

    /**
     * Template
     * @var string
     */
    protected $template;

    /**
     * Array of variables
     * @var null | array
     */
    protected $vars;

    /**
     * Array of variables
     * @var null | array
     */
    protected $params = [];

    /**
     * Constructor
     *
     * @param array $options
     * @throws Exception\InvalidArgumentException
     */
    public function __construct(array $options = [])
    {

        if (!isset($options['template'])) {
            throw new Exception\InvalidArgumentException('path key in options argument requred');
        }

        $this->template = $options['template'];
        $this->vars = is_array($options['vars']) ? $options['vars'] : array($options['vars']);

        if(isset($options['params']))
          $this->params = is_array($options['params']) ? $options['params'] : [$options['params']];
    }

    /**
     * Rendering decorator
     *
     * @param string $context
     * @return string
     */
    public function render($context)
    {
        $values = [];

        foreach ($this->vars as $var) {
            $actualRow = $this->getCell()->getActualRow();
            $values[$var]['url'] = $actualRow->getAction($var, $this->params);
            $values[$var]['icon'] = $actualRow->getIcon($var, $this->params);
            $values[$var]['class'] = $actualRow->getClass($var, $this->params);
        }
       return view(sprintf("lv-table::%s", $this->template), [
           'actions'=>$values
       ]);
    }
}
