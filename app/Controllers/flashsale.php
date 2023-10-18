<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\ProductModel;
use App\Models\FlashSaleModel;
use CodeIgniter\RESTful\ResourceController;



class FlashSaleController extends ResourceController
{
    use ResponseTrait;

    // Controller method to start a flash sale
    public function create()
    {
        // Ambil data penjualan kilat yang dikirim dalam permintaan
        $requestData = $this->request->getJSON(); // Asumsi data dikirim dalam format JSON

        // Validasi data penjualan kilat (pastikan data sesuai dengan kebutuhan Anda)

        // Simpan data penjualan kilat dalam tabel 'flash_sale'
        $flashSaleModel = new FlashSaleModel();
        $flashSaleId = $flashSaleModel->insert([
            'product_id' => json_encode($requestData->product_id),
            'discount' => $requestData->discount,
            'start_date' => date('Y-m-d H:i:s'), // Tanggal dan waktu saat penjualan kilat dimulai
            'end_date' => date('Y-m-d H:i:s', strtotime('+' . $requestData->duration . ' seconds')), // Hitung waktu berakhir dari durasi
        ]);

        // Anda dapat menambahkan logika lain, seperti menandai produk yang berpartisipasi dalam penjualan kilat

        // Siapkan respons
        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Flash sale has started.',
                'flash_sale_id' => $flashSaleId, // ID penjualan kilat yang baru saja dibuat
            ]
        ];

        return $this->respond($response);
    }

    public function processFlashSalePurchase()
    {
        // Implement logic to process flash sale purchases
        // Check if the flash sale is active, validate the purchase, reduce stock, apply discount, etc.

        // Return a response based on the purchase result
        $response = [
            'status'   => 200, // Use an appropriate status code
            'error'    => null,
            'messages' => [
                'success' => 'Purchase successful.'
            ]
        ];

        return $this->respond($response);
    }
}
