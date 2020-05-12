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

class File extends Model
{

    use TableTrait, HasSlug;

    public $incrementing = false;

    protected $keyType = "string";

    protected $table="files";

    protected $fillable =[ 'tenant_id','name','slug','status', 'updated_at','created_at'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
}
