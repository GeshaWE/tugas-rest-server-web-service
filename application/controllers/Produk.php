<?php
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class Produk extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Produk_model');
    }

    public function index_get()
    {
        $id = $this->get('id');

        if ($id === null) {
            $product = $this->Produk_model->getproduct();
        } else {
            $product = $this->Produk_model->getproduct($id);
        }

        if ($product) {
            $this->response([
                'status' => true,
                'message' => $product
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'id '. $id . ' tidak ditemukan'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function index_delete()
    {
        $id = $this->delete('id');

        if ($id === null) {
            $this->response([
                'status' => false,
                'message' => 'membutuhkan id'
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {
            if ($this->Produk_model->deleteproduct($id) > 0) {
                $this->response([
                    'status' => true,
                    'id' => $id,
                    'message' => 'data berhasil dihapus'
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'id tidak ada yang cocok'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }

    public function index_post()
    {
        $data = [
            'id' => $this->post('id'),
            'nama_barang' => $this->post('nama_barang'),
            'harga' => $this->post('harga')
        ];

        if ($this->Produk_model->createproduct($data) > 0) {
            $this->response([
                'status' => true,
                'message' => 'berhasil menambahkan data'
            ], REST_Controller::HTTP_CREATED);
        } else {
            $this->response([
                'status' => false,
                'message' => 'gagal menambahkan data'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function index_put()
    {
        $id = $this->put('id');
        $data = [
            'id' => $this->put('id'),
            'nama_barang' => $this->put('nama_barang'),
            'harga' => $this->put('harga'),
        ];

        if ($this->Produk_model->updateproduct($data, $id) > 0) {
            $this->response([
                'status' => true,
                'message' => 'data berhasil diubah'
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'data gagal diubah'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}