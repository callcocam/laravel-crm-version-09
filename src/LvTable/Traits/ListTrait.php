<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace SIGA\LvTable\Traits;

use Illuminate\Database\Eloquent\Model;
use SIGA\Form\EditForm;

trait ListTrait
{


    /**
     * Rendering table
     *
     * @param string $type (html | dataTableAjaxInit | dataTableJson)
     * @param null $template
     * @throws Exception\InvalidArgumentException
     * @return string
     */
    public function render($type = 'html', $template = null)
    {
        if (!$this->isTableInit()) {
            $this->initializable();
        }

        if ($type == 'html') {
            return $this->getRender()->renderTableAsHtml();
        } elseif ($type == 'dataTableJson') {
            return $this->getRender()->renderDataTableJson();
        } elseif ($type == 'custom') {
            return $this->getRender()->renderCustom($template);
        } else {
            throw new Exception\InvalidArgumentException(sprintf('Invalid type %s', $type));
        }

    }



}
