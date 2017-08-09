<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

require APPPATH . '/libraries/REST_Controller.php'; 

class Tasks extends REST_Controller 
{ 
	// método construtor
	function __construct() 
	{
		parent::__construct(); 

		// model
		$this->load->model('Tasks_model','TasksMDL');
    }

    //Essa função vai responder pela rota /api/tasks sob o método GET
    public function index_get()
    {
    	// Recupera o ID diretamente da URL
        $id = (int) $this->uri->segment(3);

        // Valida o ID
        if ($id <= 0)
        {
            // Lista as tasks
            // Converte a data de modificação
        	$tasks = $this->TasksMDL->Get(null, "id, titulo, status");
        } else {
            // Lista os dados da tasks conforme o ID solicitado
        	$tasks = $this->TasksMDL->Get($id, "*, date_format(data_modificacao,'%d/%m/%Y %H:%i:%s') as dt_modificacao, date_format(data_conclusao,'%d/%m/%Y %H:%i:%s') as dt_conclusao");
        }

        // verifica se existem tasks e faz o retorno da requisição
        // usando os devidos cabeçalhos
        if ($tasks) {
            $response['data'] = $tasks;
            $this->response($response, REST_Controller::HTTP_OK);
        } else {
            $this->response(null,REST_Controller::HTTP_NO_CONTENT);
        }
    }

    //Essa função vai responder pela rota /api/tasks sob o método POST
    public function index_post()
    {
        // recupera os dados informado no formulário
        $task = $this->post();

        // processa o insert no banco de dados
        $insert = $this->TasksMDL->Insert($task);

        // define a mensagem do processamento
        $response['message'] = $insert['message'];

        // verifica o status do insert para retornar o cabeçalho corretamente
        // e a mensagem
        if ($insert['status']) {
            $this->response($response, REST_Controller::HTTP_OK); // 200
        } else {
            $this->response($response, REST_Controller::HTTP_BAD_REQUEST); // 400
        }
    }

    //Essa função vai responder pela rota /api/tasks sob o método PUT
    public function index_put()
    {
        // recupera os dados informado no formulário
        $task = $this->put();

        // Recupera o ID diretamente da URL
        $task_id = $this->uri->segment(3);
        
        //Valida o ID
        if ($task_id <= 0)
        {
            // Define a mensagem de retorno
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // 400
        }
     		
		// processa o update no banco de dados
        $update = $this->TasksMDL->Update('id',$task_id, $task);

        // define a mensagem do processamento
        $response['message'] = $update['message'];

        // verifica o status do update para retornar o cabeçalho corretamente
        // e a mensagem
        if ($update['status']) {
            $this->response($response, REST_Controller::HTTP_OK); // 200
        } else {
            $this->response($response, REST_Controller::HTTP_BAD_REQUEST); // 400
        }
    }

    //Essa função vai responder pela rota /api/tasks sob o método DELETE
    public function index_delete()
    {
        // Recupera o ID diretamente da URL
        $id = (int) $this->uri->segment(3);

        // Valida o ID
        if ($id <= 0)
        {
            // Define a mensagem de retorno
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // 400
        }
        // Executa a remoção do registro no banco de dados
        $delete = $this->TasksMDL->Delete('id',$id);

        // define a mensagem do processamento
        $response['message'] = $delete['message'];

        // verifica o status do insert para retornar o cabeçalho corretamente
        // e a mensagem
        if ($delete['status']) {
            $this->response($response, REST_Controller::HTTP_OK); // 200
        } else {
            $this->response($response, REST_Controller::HTTP_BAD_REQUEST); // 400
        }
    }

}