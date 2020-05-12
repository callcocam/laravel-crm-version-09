<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace SIGA;

use Illuminate\Database\Eloquent\SoftDeletes;
use SIGA\Tenant\BelongsToTenants;

trait TableTrait
{

    use SoftDeletes, BelongsToTenants;

    protected $source;
    protected $endpoint;

    protected $model;

    /**
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function file()
    {
        return $this->morphMany(File::class, 'fileable');
    }

    /**
     * @return mixed
     */
    public function getSource()
    {
        if($this->source)
         return $this->source;

        $this->source = $this->query();

        return $this->source;
    }



}
