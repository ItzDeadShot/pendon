<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'requests';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'description',
        'email',
        'phone',
        'status',
        'proof',
        'user_id',
        'item_id',
    ];

    /**
     * Get the user that owns the request.
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the item that owns the request.
     */
    public function item(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

}
