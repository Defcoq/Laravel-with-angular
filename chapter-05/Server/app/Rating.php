<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Rating",
 *     required={"bike_id", "user_id", "rating"},
 *     @OA\Property(
 *          property="biker_id",
 *          type="integer",
 *          description="Bike id",
 *          example="1"
 *    ),
 *     @OA\Property(
 *          property="user_id",
 *          type="integer",
 *          description="User id",
 *          example="2"
 *    ),
 *     @OA\Property(
 *          property="rating",
 *          type="integer",
 *          description="Vote by rating",
 *          example="10"
 *    )
 * )
 */

class Rating extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bike_id',
        'user_id',
        'rating'
    ];

    /**
     * Relationship.
     *
     * @var string
     */

    public function bike() {
      return $this->belongsTo('App\Bike');
    }
}
