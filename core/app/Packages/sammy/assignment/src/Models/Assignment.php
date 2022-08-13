<?php
namespace Sammy\Assignment\Models;

/**
 * Permission Model Class
 *
 *
 * @category   Models
 * @package    Model
 * @author     Nishan Randika <nishanr@craftbyorange.com>
 *
 */
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assignment extends Model
{

    /**
     * table row delete
     */
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'assignment_request';

    /**
     * The attributes that are not assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * get customer each outlet
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
//    public function comments()
//    {
//        return $this->hasMany('App\Comment');
//    }
}
