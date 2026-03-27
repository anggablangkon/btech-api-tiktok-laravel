# btech-api-tiktok-laravel

TikTok Shop API wrapper untuk Laravel 10+  
Mendukung GET & POST generic endpoint dengan auto generate `sign` & `timestamp`.

## Cara Pakai

```php
use TikTokShop;

$orders = TikTokShop::post('order/202309/orders/search', ['page_size' => 10]);# btech-api-tiktok-laravel
