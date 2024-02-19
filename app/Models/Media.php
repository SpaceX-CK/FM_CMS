<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Media extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'media';

    protected $fillable = [
        'mediable_type', 'mediable_id', 'collection_name', 'name',
        'file_name', 'file_path', 'mime_type', 'size_in_bytes', 'order_column'
    ];
    
    const COLLECTION_DEFAULT = 'default';
    const COLLECTION_IMAGE = 'image';
    const COLLECTION_DOCUMENT = 'document';
    
    // const COLLECTION_BANNER = 'banner';
    const COLLECTION_PRODUCT = 'product';
    const COLLECTION_PRODUCT_HOME = 'product-home';

    const COLLECTION_PRODUCTS = 'products';
    const COLLECTION_PRODUCTS_MOBILE = 'products-mobile';

    const COLLECTION_SHOP = 'shop';
    const COLLECTION_CATEGORY = 'category';
    const COLLECTION_CATEGORY_MOBILE = 'category-mobile';
    const COLLECTION_ARTICLE = 'article';
    // const COLLECTION_PROMOTION = 'promotion';
    // const COLLECTION_BRAND = 'brand';

    // const BANNER_IMAGE_PATH = self::COLLECTION_BANNER . '/{id}/' . self::COLLECTION_IMAGE;
    const PRODUCT_IMAGE_PATH = self::COLLECTION_PRODUCT . '/{id}/' . self::COLLECTION_IMAGE;
    const PRODUCT_HOME_IMAGE_PATH = self::COLLECTION_PRODUCT_HOME . '/{id}/' . self::COLLECTION_IMAGE;

    const PRODUCTS_IMAGE_PATH = self::COLLECTION_PRODUCTS . '/{id}/' . self::COLLECTION_IMAGE;
    const PRODUCTS_MOBILE_IMAGE_PATH = self::COLLECTION_PRODUCTS_MOBILE . '/{id}/' . self::COLLECTION_IMAGE;
    const SHOP_IMAGE_PATH = self::COLLECTION_SHOP . '/{id}/' . self::COLLECTION_IMAGE;
    const ARTICLE_IMAGE_PATH = self::COLLECTION_ARTICLE . '/{id}/' . self::COLLECTION_IMAGE;
    const CATEGORY_IMAGE_PATH = self::COLLECTION_CATEGORY . '/{id}/' . self::COLLECTION_IMAGE;
    const CATEGORY_MOBILE_IMAGE_PATH = self::COLLECTION_CATEGORY . '/{id}/' . self::COLLECTION_IMAGE;
    // const PROMOTION_IMAGE_PATH = self::COLLECTION_PROMOTION . '/{id}/' . self::COLLECTION_IMAGE;
    // const BRAND_IMAGE_PATH = self::COLLECTION_BRAND . '/{id}/' . self::COLLECTION_IMAGE;

    const EXTENSION_JPG = 'jpg';
    const EXTENSION_JPEG = 'jpeg';
    const EXTENSION_PNG = 'png';
    const EXTENSION_PDF = 'pdf';
    const EXTENSION_GIF = 'gif';

    public function mediable()
    {
        return $this->morphTo();
    }

    // Functions
    public static function supportedImageExtensions(): array
    {
        return [
            self::EXTENSION_JPG,
            self::EXTENSION_JPEG,
            self::EXTENSION_PNG
        ];
    }

    public static function applicationDocumentExtensions(): array
    {
        return array_merge(self::supportedImageExtensions(), [self::EXTENSION_PDF]);
    }

    // Set Attributes
    public function setFilePathAttribute($value)
    {
        $this->attributes['file_path'] = ltrim($value, '\\');
    }

    // Get Attributes
    public function getFullFilePathAttribute()
    {
        // getFullFilePathAttribute become full_file_path
        return asset($this->file_path);
    }

    public function getNoPreviewAttribute()
    {
        return asset('images/nopreview.png');
    }
}
