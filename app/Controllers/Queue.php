<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\ModelQueue;

class Queue extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $modelQueue = new ModelQueue();
        // $data = $modelQueue->join('bengkel', 'queue.id_bengkel', '=', 'bengkel.id')
        // ->join('users', 'queue.id_user', '=', 'users.id')
        // ->select('queue.id' ,'bengkel.nama','users.username',
        //             'queue.no_antrian','queue.kerusakan',
        //             'queue.tanggal');

        // $modelQueue->select('*');
        // $modelQueue->join('bengkel', 'bengkel.id = queue.id_bengkel');
        // $modelQueue->join('users', 'users.id = queue.id_user');
        // $data = $modelQueue->get();

        $data = $modelQueue->findAll();
        
        $response =
            $data
        ;

        return $this->respond($response, 200);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
               // $rules = [
        //     'username'            => 'required',
        //     'password'            => 'required',
        //     'email'               => 'required',
        //     'birth'               => 'required',
        //     'phone'               => 'required|numeric',    
        // ];

        // if($this->validate($rules)){

            $model = new ModelQueue();
            $data = json_decode(trim(file_get_contents('php://input')), true) ?? $this->request->getPost();
            // $data["password"] = password_hash($data["password"], PASSWORD_DEFAULT);

            if (!$model->save($data)) {
                $response = [
                    'status' => 404,
                    'error' => true,
                    'message' => $model->errors(),
                ];
                return $this->respond($response, 404);
            }

                    
        $response = [
            'status' => 201,
            'error' => "false",
            'message' => "Berhasil Menambah Queue",
            'data' => $data
        ];

        return $this->respond($response, 201);
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        //
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $modelQueue = new ModelQueue();

        $cekData = $modelQueue->find($id);

        if($cekData) {
            $modelQueue->delete($id);
            $response = [
                'status' => 200,
                'error' => null,
                'message' => "Data berhasil dihapus"
            ];
            return $this->respondDeleted($response);
        }else {
            return $this->failNotFound('Data tidak ditemukan');
        }
    }
}
