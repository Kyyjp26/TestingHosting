<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PenjualanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'IDtrans' => $this->IDtrans,
            'IDproduk' => $this->IDproduk,
            'tanggal' => $this->tanggal,
            'qty' => $this->qty,
            'hargajual' => $this->hargajual,
            'dibayar' => $this->dibayar,
            'kembali' => $this->kembali
        ];
    }
}
