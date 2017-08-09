<?php
 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Tasks_model extends CI_Model 
{
	// Método construtor
    public function __construct() {
        parent::__construct();
    }

	/*
     * Método que irá listar todos os usuários
     * recebe como parâmetro os campos a serem retornados
     */
    public function Get($id = null, $fields = '*')
    {
        $this->db->select($fields);
        $this->db->from('tasks');

        // Se o id for passado como parâmetro
        if ($id != null && $id >=0 ) {
        	$this->db->where('id', $id);
        }

        $this->db->order_by('data_cadastro','DESC');
        return $this->db->get()->result_array();
    }

    /*
     * Método que irá fazer a validação dos dados e processar o insert na tabela
     * recebe como parâmetro o array com os dados vindos do formulário
     */
    function Insert($dados) 
    {
        if (!isset($dados)) {

            $response['status'] = false;
            $response['message'] = "Dados não informados.";
        } else {

            // setamos os dados que devem ser validados
            $this->form_validation->set_data($dados);

            // definimos as regras de validação
            $this->form_validation->set_rules('titulo','Título','required|min_length[2]|trim');

            // executamos a validação e verificamos o seu retorno
            // caso haja algum erro de validação, define no array $response
            // o status e as mensagens de erro
            if ($this->form_validation->run() === false) {

                $response['status'] = false;
                $response['message'] = validation_errors();
            } else {

                //executamos o insert
                $status = $this->db->insert('tasks', $dados);

                // verificamos o status do insert
                if ($status) {
                    $response['status'] = true;
                    $response['message'] = "Task criada com sucesso.";
                } else {
                    $response['status'] = false;
                    $response['message'] = $this->db->error_message();
                }
            }
        }
        // retornamos as informações sobre o insert
        return $response;
    }

    /*
     * Método que irá fazer a validação dos dados e processar o update na tabela
     * recebe como parâmetro o array com os dados vindos do formulário
     */
    function Update($field, $value, $dados)
    {
        if (!isset($dados) || !isset($field) || !isset($dados)) {

            $response['status'] = false;
            $response['message'] = "Dados não informados.";
        } else {

        	$status = null;

        	if (isset($dados['titulo'])) {
	            // setamos os dados que devem ser validados
	            $this->form_validation->set_data($dados);

	            // definimos as regras de validação
	            $this->form_validation->set_rules('titulo','Título','required|min_length[2]|trim');

	            // executamos a validação e verificamos o seu retorno
	            // caso haja algum erro de validação, define no array $response
	            // o status e as mensagens de erro
	            if ($this->form_validation->run() === false) {

	                $response['status'] = false;
	                $response['message'] = validation_errors();
	            } else {

	                //executamos o update
	                $this->db->where($field, $value);
	                $status = $this->db->update('tasks', $dados);
	            }
            } elseif (isset($dados['status'])) {

            	//executamos o update
                $this->db->set($this->_setTaskConcluida($dados));
                $this->db->where($field, $value);
                $status = $this->db->update('tasks');
            }

            // verificamos o status do insert
            if ($status) {
                $response['status'] = true;
                $response['message'] = "Task atualizada com sucesso.";
            } else {
                $response['status'] = false;
                $response['message'] = $this->db->error_message();
            }
        }
        // retornamos as informações sobre o update
        return $response;
    }

    /*
     * Método que irá fazer a remoção dos dados
     * Recebe como parâmetro o campo e o valor a serem usados na cláusula where
     */
    function Delete($field, $value)
    {
        if (is_null($field) || is_null($value)) {

            $response['status'] = false;
            $response['message'] = "Dados não informados.";
        } else {

            // executamos o delete
            $this->db->where($field, $value);
            $status =  $this->db->delete('tasks');

            // verificamos o status do procedimento de remoção
            if ($status) {
                $response['status'] = true;
                $response['message'] = "Task removida com sucesso.";
            } else {
                $response['status'] = false;
                $response['message'] = $this->db->error_message();
            }
        }
        // retornamos as informações sobre o status do procedimento
        return $response;
    }

    /*
     * Método que irá preparar os dados para update
     */
    private function _setTaskConcluida($dados)
    {
    	date_default_timezone_set('America/Sao_Paulo');

    	// se a Task for reaberta, retira data de conclusão
    	if ($dados['status'] == 0){
    		$data_conclusao = date('Y-m-d H:i:s');
    	}
    	else {
    		$data_conclusao = null;
    	}

    	return array(
    		'status' => $dados['status'],
    		'data_conclusao' => $data_conclusao
		);
    }
}