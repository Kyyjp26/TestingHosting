<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StokResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'IDproduk' => $this->IDproduk,
            'nama' => $this->nama,
            'hargabeli' => $this->hargabeli,
            'hargajual' => $this->hargajual,
            'stok' => $this->stok,
            'kategori' => $this->kategori
        ];
    }
}
