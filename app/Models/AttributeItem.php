<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class AttributeItem extends Model
{
    use SoftDeletes;

    /**
     * @var string[]
     */
    protected array $dates = ['deleted_at'];

    /**
     * @var string[]
     */
    protected $fillable = ['attribute_id', 'title', 'status'];

    /**
     * @return BelongsTo
     */
    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

    /**
     * @return HasOne
     */
    public function attributeItemColor()
    {
        return $this->hasOne(AttributeItemColor::class);
    }

    /**
     * @return BelongsTo
     */
    public function ProductAttribute()
    {
        return $this->belongsTo(ProductAttribute::class);
    }

    /**
     * @return string
     */
    public static function getAttributeItem($id, $field)
    {
        if ($id) {
            $attributeItem = AttributeItem::find($id);

            return $attributeItem->$field;
        }

        return '';
    }

    /**
     * @return string
     */
    public static function findPaletteByItem($attribute_item_id)
    {
        $item_color = AttributeItemColor::where('attribute_item_id', $attribute_item_id)->first();
        if ($item_color) {
            $color = Color::find($item_color->color_id);
            if ($color != null) {
                return $color->color_palette;
            }
        }

        return '';
    }
}
