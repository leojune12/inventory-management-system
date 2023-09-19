<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supplier extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'address',
        'shop_name',
        'bank_name',
        'account_holder',
        'account_number',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['created_at_date', 'updated_at_date'];

    /**
     * Get created at.
     */
    protected function createdAtDate(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->created_at->diffForHumans(),
        );
    }

    /**
     * Get updated at.
     */
    protected function updatedAtDate(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->updated_at->diffForHumans(),
        );
    }
}
