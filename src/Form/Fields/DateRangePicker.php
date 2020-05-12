<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace SIGA\Form\Fields;


use Carbon\Carbon;
use SIGA\Form\Field;

class DateRangePicker extends Field
{

    protected $dateRangeOptions = [];

    /**
     * @var string
     */
    protected $view = 'lv-table::filters.range';

    /**
     * @var array
     */
    protected static $css = [
        'vendor/laravel-admin-ext/daterangepicker/daterangepicker.css',
    ];

    /**
     * @var array
     */
    protected static $js = [
        'vendor/laravel-admin-ext/daterangepicker/daterangepicker.js',
    ];

    protected $elements = [];

    protected $format = 'DD/MM/YYYY';

    protected $template = '';


    public function __construct($data = [])
    {
        foreach ($data as $key => $value){

            $this->__set($key, $value);
        }
    }

    /**
     * @param array $options
     * @return array
     */
    public function setDaterangepicker($options = []){

        $this->dateRangeOptions['ranges'] = $this->translate(array_merge([

            'Today'        => [Carbon::today()->toDateString(), Carbon::today()->toDateString()],
            'Yesterday'    => [Carbon::yesterday()->toDateString(), Carbon::yesterday()->toDateString()],
            'Last 7 Days'  => [Carbon::today()->subDays(6)->toDateString(), Carbon::today()->toDateString()],
            'Last 14 Days' => [Carbon::today()->subDays(13)->toDateString(), Carbon::today()->toDateString()],
            'Last 30 Days' => [Carbon::today()->subDays(29)->toDateString(), Carbon::today()->toDateString()],
            'This Month'   => [Carbon::today()->startOfMonth()->toDateString(), Carbon::today()->endOfMonth()->toDateString()],
            'Last Month'   => [Carbon::today()->subMonth()->firstOfMonth()->toDateString(), Carbon::today()->subMonth()->lastOfMonth()->toDateString()],


        ],$options));

        return $this;
    }

    /**
     * @param array $options
     * @return array
     */
    public function ranges(){

        if(!isset($this->dateRangeOptions['ranges'])){
            $this->setDaterangepicker();
        }
        return $this;
    }

    private function translate($options){
        $translate = [];

        if($options){

            foreach ($options as $key => $range){

                if(is_array($range)){
                    $translate[__($key)] = $this->translate($range);
                }
                else{
                    $translate[__($key)] = $range;
                }
            }

        }
        return $translate;
    }

    /**
     * Set date format.
     *
     * @param $format
     * @return $this
     */
    public function format($format)
    {
        $this->format = $format;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function render()
    {

        $this->ranges();

        \Arr::set($this->dateRangeOptions, 'locale.format', $this->format);

        $global = config('config', []);

        //$options = json_encode(array_merge($global, $this->dateRangeOptions));

        $locale = config('app.locale');

        $start = today()->subDays(29)->toDateString();
        $end=today()->toDateString();

        if(isset($this->value['start'])){
            $start = date_carbom_format($this->value['start'])->format('d/m/Y');
        }
        if(isset($this->value['end'])){
            $end = date_carbom_format($this->value['end'])->format('d/m/Y');
        }
        $this->script = <<<SCRIPT
            moment.locale('$locale');
            initRange('#{$this->name}','$start','$end');
SCRIPT;

        $this->template = sprintf("%s - %s", $start, $end);


        $this->with('elements', $this->elements)
            ->with('script', $this->script)
            ->with('template', $this->template)
            ->with('multiple', $this->multiple);

        return parent::render();
    }

    /**
     * @return array
     */
    public function getElements(): array
    {
        return $this->elements;
    }

    public function getType()
    {
        return 'hidden';
    }
}
