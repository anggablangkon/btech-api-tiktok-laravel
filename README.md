# btech-api-tiktok-laravel

TikTok Shop API wrapper untuk Laravel 10+  
Mendukung GET & POST generic endpoint dengan auto generate `sign` & `timestamp`.

## Cara Pakai

instal dengan perintah :  
composer require btech-api/tiktok-laravel

Kemudian Setting pada file .env dan sesuaikan credential nya
TIKTOK_APP_KEY=your_app_key
TIKTOK_APP_SECRET=your_app_secret
TIKTOK_ACCESS_TOKEN=your_access_token
TIKTOK_SHOP_ID=your_shop_id
TIKTOK_SHOP_CIPHER=your_shop_cipher

Kemudian jalankan
php artisan vendor:publish --provider="BtechApi\TiktokLaravel\TikTokShopServiceProvider" --tag=config


Contoh Penggunaan Di Controller :

```php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TikTokShop; // facade yang disediakan package

class OrderController extends Controller
{
    public function index()
    {
        // Mengambil list order
        $orders = TikTokShop::post('order/202309/orders/search', [
            'page_size' => 10
        ]);

        return response()->json($orders);
    }

    public function shippingLabel($orderId)
    {
        $response = TikTokShop::get('logistics/shipping_document', [
            'document_type' => 'SHIPPING_LABEL',
            'order_id' => $orderId
        ]);

        return response()->json($response);
    }
}
