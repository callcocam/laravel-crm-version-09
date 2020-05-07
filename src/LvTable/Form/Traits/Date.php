<?php


namespace SIGA\LvTable\Form\Traits;


use Carbon\Carbon;

trait Date
{

    protected $options = [];
    /**
     * @param array $options
     * @return array
     */
    public function setDaterangepicker($options = []){
        $this->options = array_merge([
            'Today'        => [Carbon::today()->toDateString(), Carbon::today()->toDateString()],
            'Yesterday'    => [Carbon::yesterday()->toDateString(), Carbon::yesterday()->toDateString()],
            'Last 7 Days'  => [Carbon::today()->subDays(6)->toDateString(), Carbon::today()->toDateString()],
            'Last 14 Days' => [Carbon::today()->subDays(13)->toDateString(), Carbon::today()->toDateString()],
            'Last 30 Days' => [Carbon::today()->subDays(29)->toDateString(), Carbon::today()->toDateString()],
            'This Month'   => [Carbon::today()->startOfMonth()->toDateString(), Carbon::today()->endOfMonth()->toDateString()],
            'Last Month'   => [Carbon::today()->subMonth()->firstOfMonth()->toDateString(), Carbon::today()->subMonth()->lastOfMonth()->toDateString()],

        ],$options);
        //$this->options['startDate'] = $this->startDate();
        // $this->options['endDate'] = $this->endDate();
    }

    /**
     * @param array $options
     * @return array
     */
    public function getDaterangepicker(){
        if(!$this->options)
            $this->setDaterangepicker();

        return $this->options;
    }

    protected function startDate($start = 29){
        return Carbon::today()->subDays($start);
    }

    protected function endDate($end = 0){
        return Carbon::today()->addDays($end);
    }

    protected function ranges(){
        return $this->translate([
            'Today'        => [Carbon::today()->toDateString(), Carbon::today()->toDateString()],
            'Yesterday'    => [Carbon::yesterday()->toDateString(), Carbon::yesterday()->toDateString()],
            'Last 7 Days'  => [Carbon::today()->subDays(6)->toDateString(), Carbon::today()->toDateString()],
            'Last 14 Days' => [Carbon::today()->subDays(13)->toDateString(), Carbon::today()->toDateString()],
            'Last 30 Days' => [Carbon::today()->subDays(29)->toDateString(), Carbon::today()->toDateString()],
            'This Month'   => [Carbon::today()->startOfMonth()->toDateString(), Carbon::today()->endOfMonth()->toDateString()],
            'Last Month'   => [Carbon::today()->subMonth()->firstOfMonth()->toDateString(), Carbon::today()->subMonth()->lastOfMonth()->toDateString()],

        ]);
    }
    private function translate($options){
        $translate = [];

        if($options){

            foreach ($options as $key => $range){

                $translate[__($key)] = $range;
            }

        }
        return $translate;
    }

}
