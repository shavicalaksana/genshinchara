<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Genshin extends REST_Controller
{

    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->database();
        $this->methods['index_get']['limit'] = 2;
        $this->methods['index_post']['limit'] = 3;
        $this->methods['index_put']['limit'] = 3;
        $this->methods['index_delete']['limit'] = 1;
    }

    function index_get()
    {
        $id = $this->get('id');
        if ($id == '') {
            $VGoXhgQ9w6 = $this->db->get('genshinchara')->result();
        } else {
            $this->db->where('id', $id);
            $VGoXhgQ9w6 = $this->db->get('genshinchara')->result();
        }
        $this->response($VGoXhgQ9w6, 200);
    }

    function index_post()
    {
        $data = array(
            'id'           => $this->post('id'),
            'nama'          => $this->post('nama'),
            'des'    => $this->post('des')
        );
        $insert = $this->db->insert('genshinchara', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_put()
    {
        $id = $this->put('id');
        $data = array(
            'id'       => $this->put('id'),
            'nama'          => $this->put('nama'),
            'des'    => $this->put('des')
        );
        $this->db->where('id', $id);
        $update = $this->db->update('genshinchara', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_delete()
    {
        $id = $this->delete('id');
        $this->db->where('id', $id);
        $delete = $this->db->delete('genshinchara');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}
