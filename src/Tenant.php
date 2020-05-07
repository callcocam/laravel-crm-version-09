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


class Tenant extends Model
{
    use TableTrait, HasSlug;

    protected $keyType = "string";

    public $incrementing = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug','domain','main','status', 'updated_at','created_at',
    ];

    public function __construct(array $attributes = [])
    {
       \SIGA\Tenant\Facades\Tenant::disable();

        parent::__construct($attributes);
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function init($columnsView)
    {
        // TODO: Implement init() method.
    }

    public function initQuery($query)
    {
        // TODO: Implement initQuery() method.
    }
}
