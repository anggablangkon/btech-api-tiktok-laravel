<?php

namespace BtechApi\TiktokLaravel;

use Illuminate\Support\Facades\Http;

class TikTokShopService
{
    protected string $appKey;
    protected string $appSecret;
    protected string $accessToken;
    protected string $shopId;
    protected string $shopCipher;

    public function __construct()
    {
        $config = config('tiktok');
        $this->appKey = $config['app_key'];
        $this->appSecret = $config['app_secret'];
        $this->accessToken = $config['access_token'];
        $this->shopId = $config['shop_id'];
        $this->shopCipher = $config['shop_cipher'];
    }

    protected function generateTimestamp(): int
    {
        return now()->timestamp;
    }

    protected function generateSign(int $timestamp): string
    {
        $baseString = "app_key{$this->appKey}shop_id{$this->shopId}timestamp{$timestamp}";
        return hash_hmac('sha256', $baseString, $this->appSecret);
    }

    public function post(string $endpoint, array $body = [], array $queryParams = [])
    {
        $timestamp = $this->generateTimestamp();
        $sign = $this->generateSign($timestamp);

        $query = array_merge($queryParams, [
            'access_token' => $this->accessToken,
            'app_key'      => $this->appKey,
            'shop_id'      => $this->shopId,
            'shop_cipher'  => $this->shopCipher,
            'timestamp'    => $timestamp,
            'sign'         => $sign,
        ]);

        $url = "https://open-api.tiktokglobalshop.com/{$endpoint}";

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'x-tts-access-token' => $this->accessToken,
        ])->post($url . '?' . http_build_query($query), $body);

        return $response->json();
    }

    public function get(string $endpoint, array $queryParams = [])
    {
        $timestamp = $this->generateTimestamp();
        $sign = $this->generateSign($timestamp);

        $query = array_merge($queryParams, [
            'access_token' => $this->accessToken,
            'app_key'      => $this->appKey,
            'shop_id'      => $this->shopId,
            'shop_cipher'  => $this->shopCipher,
            'timestamp'    => $timestamp,
            'sign'         => $sign,
        ]);

        $url = "https://open-api.tiktokglobalshop.com/{$endpoint}";

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'x-tts-access-token' => $this->accessToken,
        ])->get($url . '?' . http_build_query($query));

        return $response->json();
    }
}