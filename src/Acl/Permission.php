<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace SIGA\Acl;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use SIGA\Acl\Concerns\RefreshesPermissionCache;
use SIGA\Acl\Contracts\Permission as PermissionContract;
use SIGA\Sluggable\HasSlug;
use SIGA\Sluggable\SlugOptions;
use SIGA\TableTrait;

class Permission extends Model implements PermissionContract
{
    use RefreshesPermissionCache,TableTrait, HasSlug;

    public $incrementing = false;

    protected $keyType = "string";
    /**
     * The attributes that are fillable via mass assignment.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug', 'groups', 'description', 'status','created_at','updated_at'];

    /**
     * Permissions can belong to many roles.
     *
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(config('acl.models.role'))->withTimestamps();
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
}
