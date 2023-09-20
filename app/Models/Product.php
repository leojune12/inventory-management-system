<?php

namespace App\Models;

use App\Models\Unit;
use App\Models\Category;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'product_code',
        'buying_price',
        'selling_price',
        'category_id',
        'unit_id',
        'stock',
        'description',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['product_photo', 'created_at_date', 'updated_at_date'];

     /**
     * Set single file collection
     */
    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('product_photos')
            ->singleFile();
    }

    /**
     * Get the product photo.
     */
    protected function productPhoto(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getFirstMediaUrl('product_photos'),
        );
    }

    /**
     * Get the category.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the unit.
     */
    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

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

    /**
     * Get all of the purhcases.
     */
    public function purchases(): HasManyThrough
    {
        return $this->hasManyThrough(
            Purchase::class,
            PurchaseItem::class,
            'product_id', // Foreign key on the environments table...
            'id', // Foreign key on the deployments table...
            'id', // Local key on the projects table...
            'purchase_id' // Local key on the environments table...
        );
    }
}
