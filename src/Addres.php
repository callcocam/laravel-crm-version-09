<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace SIGA;

use Illuminate\Database\Eloquent\Model;
use SIGA\Sluggable\HasSlug;
use SIGA\Sluggable\SlugOptions;

class Addres extends Model
{

    use TableTrait, HasSlug;

    public $incrementing = false;

    protected $keyType = "string";

    protected $table="address";

    protected $fillable =[ 'tenant_id','zip','city','state','country', 'street','district','number','complement','status', 'updated_at','created_at'];

    public function addresable(){

        return $this->morphTo();
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
}
