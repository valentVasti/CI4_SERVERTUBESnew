<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\ModelBengkel;

class Bengkel extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $modelBengkel = new ModelBengkel();
        $data = $modelBengkel->findAll();
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
        $modelUser = new ModelBengkel();

        $data = $modelUser->orLike('id', $id)->get()->getResult();

        if($data!=null){
            // $response = [
            //     'message' => "Data ditemukan!",
            //     'data' => $data
            // ];
            $response =
                $data
            ;
        }else{
            $response = [
                'message' => "Data tidak ditemukan!",
                'data' => null
            ];
        }

        return $this->respond($response, 200);
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

            $model = new ModelBengkel();
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
            'message' => "Berhasil Register",
            'data' => $data
        ];

        return $this->respond($response, 201);

        // }
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
        $model = new ModelBengkel();
        $data = json_decode(trim(file_get_contents('php://input')), true) ?? $this->request->getVar();

        // $data = [
        //     'nama' => $this->request->getVar("nama"),
        //     'alamat' => $this->request->getVar("alamat"),
        //     'jamOperasional' => $this->request->getVar("jamOperasional"),
        //     'jenis' => $this->request->getVar("jenis"),
        // ];

        $data = $this->request->getRawInput();

        if(!$model->update($id, $data)) {
            $response = [
                'status' => 404,
                'error' => true,
                'message' => $model->errors(),
            ];
            return $this->respond($response, 404);
        }else{
            $response = [
                'status' => 201,
                'error' => "false",
                'message' => "Berhasil Edit Bengkel",
                'data' => $data
            ];
    
            return $this->respond($response, 201);
        }              
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $modelBengkel = new ModelBengkel();

        $cekData = $modelBengkel->find($id);

        if($cekData) {
            $modelBengkel->delete($id);
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
