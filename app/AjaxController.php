<?php
require '../vendor/autoload.php';

use TodosProject\GlobalModel;

$global_model = new GlobalModel();

if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {

    $response = [];

    $action = isset($_POST['action'])? $_POST['action']: '';
    $data = isset($_POST['data'])? $_POST['data']: [];
     
    switch($action){

        case 'insert':
            $name = (isset($data['name'])? $data['name']: '');
            $response = [
                'id'        => $global_model->insert('todo_tasks', $name),
                'name'      => $name,
                'status'    => 'active',
            ];
            break;

        case 'update':
            $name   = (isset($data['name'])? $data['name']: '');
            $id     = (isset($data['id'])? $data['id']: '');
            $status = (isset($data['status'])? $data['status']: 'active');
            $global_model->update_row('todo_tasks', $id, $name, $status);
            $response = [
                'id' => $id,
                'name' => $name,
                'status' => $status,
            ];
            break;

        case 'delete':
            $id = (isset($data['id'])? $data['id']: '');
            $response = [
                'id'        => $global_model->delete_row('todo_tasks', $id),
                'name'      => $name,
                'status'    => 'delete',
            ];

        case 'deleteCompleted':
            $global_model->delete_completed_task('todo_tasks');
            $response = [
                'status' => 'deleteCompleted',
            ];

        default:

    }

    echo json_encode($response);

}

if( $_SERVER['REQUEST_METHOD'] === 'GET' ){
    $getData = $global_model->fetchAllData('todo_tasks', 'id');
    echo json_encode($getData);
}