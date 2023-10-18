<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\OrderModel;
use App\Models\ProductModel;

class Order extends ResourceController
{
    use ResponseTrait;

    // create
    public function create()
    {
        // Pastikan Anda telah memuat model OrderModel dan ProductModel sebelumnya

        // Ambil data pesanan yang dikirim dalam permintaan
        $requestData = $this->request->getJSON(); // Ini asumsi data dikirim dalam format JSON

        // Validasi data pesanan (pastikan data sesuai dengan kebutuhan Anda)

        // Misalnya, Anda dapat memeriksa apakah item pesanan ada dalam database (produk yang valid)
        $productModel = new ProductModel();
        $product = $productModel->find($requestData[0]['product_id']);


        if (!$product || !property_exists($product, 'inventory')) {
            return $this->fail('Produk tidak valid atau tidak ditemukan.', 404);
        }

        // Cek stok produk sebelum menambahkan pesanan
        $requestedQuantity = $requestData[0]['quantity'];

        if ($product->inventory >= $requestedQuantity) {
            // Buat data pesanan
            $orderData = [
                'product_id' => $requestData[0]['product_id'],
                'quantity'   => $requestedQuantity,
                // Tambahkan kolom lain sesuai kebutuhan Anda
            ];

            // Kurangi stok produk
            $productModel->update($product->product_id, ['inventory' => $product->inventory - $requestedQuantity]);

            // Simpan pesanan ke database
            $orderModel = new OrderModel();
            $orderModel->insert($orderData);

            // Siapkan respons
            $response = [
                'status'   => 201,
                'error'    => null,
                'messages' => [
                    'success' => 'Pesanan berhasil dibuat.'
                ]
            ];

            return $this->respondCreated($response);
        } else {
            return $this->fail('Stok produk tidak mencukupi.', 400);
        }
    }

    public function index()
    {
        $model = new OrderModel();
        $data['order'] = $model->orderBy('order_item_id', 'DESC')->findAll();
        return $this->respond($data);
    }
}
