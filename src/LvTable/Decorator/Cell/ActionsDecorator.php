<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace SIGA\LvTable\Decorator\Cell;

use SIGA\LvTable\Decorator\Exception;

class ActionsDecorator extends AbstractCellDecorator
{

    /**
     * Template
     * @var string
     */
    protected $view;

    /**
     * Template
     * @var string
     */
    protected $template = 'cell.actions';

    /**
     * Array of variables
     * @var null | array
     */
    protected $vars = ['edit', 'show', 'destroy'];

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

        if (isset($options['view'])) {
            $this->view = $options['view'];
        }

        if (isset($options['template'])) {
            $this->template = $options['template'];
        }
        if (isset($options['vars'])) {
            $this->vars = is_array($options['vars']) ? $options['vars'] : array($options['vars']);
        }

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

            $this->getCell()->getTable()->setModel($actualRow);
            $values[$var]['url'] = $this->getCell()->getTable()->getActionKey($var, $this->params);
            $values[$var]['icon'] = $this->getCell()->getTable()->getIcon($var, $this->params);
            $values[$var]['class'] = $this->getCell()->getTable()->getClass($var, $this->params);
            $values[$var]['view'] = $this->view ?  $this->view : $var;
        }
       return view(sprintf("lv-table::%s", $this->template), [
           'actions'=>$values
       ]);
    }
}
