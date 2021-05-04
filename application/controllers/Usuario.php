<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usuario extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('usuario_model');
		$this->load->helper('url_helper');
	}
	public function get_usuario()
	{

		header("Access-Control-Allow-Origin: *");
		//$products = $this->usuario_model->get_usuario();
		//$this->output->set_content_type('application/json')->set_output(json_encode($products));

		//ou

		$json = array();
		$dados = $this->usuario_model->get_usuario();
		foreach ($dados as $row) {

			$json[] = array(
				'id' => $row->id,
				'usuario' => $row->usuario,
				'nome_completo' => $row->nome_completo,
			);
		}
		$response['data'] = $json;
		echo json_encode($response);
	}


	public function products()
	{
		header("Access-Control-Allow-Origin: *");
		$products = $this->Product_action->get_products();
		$this->output->set_content_type('application/json')->set_output(json_encode($products));
	}

	public function getProduct($id)
	{

		header('Access-Control-Allow-Origin: *');

		$product = $this->usuario_model->get_product($id);



		$productData = array(
			'id' => $product->id,
			'product_name' => $product->usuario,
			'product_price' => $product->nome_completo,
			//'product_description' => $product->product_description
			// 'product_image' => $product->product_image
		);

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($productData));
	}

	public function createProduct()
	{
		header("Content-type:application/json");
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
		header('Access-Control-Allow-Headers: token, Content-Type');

		$requestData = json_decode(file_get_contents('php://input'), true);

		if (!empty($requestData)) {

			$productName = $requestData['product_name'];
			$productPrice = $requestData['product_price'];
			$productDescription = $requestData['product_description'];
			// $productImage = $requestData['product_image'];

			$productData = array(
				'product_name' => $productName,
				'product_price' => $productPrice,
				'product_description' => $productDescription
				// 'product_image' =>$productImage
			);

			$id = $this->Product_action->insert_product($productData);

			$response = array(
				'status' => 'success',
				'message' => 'Product added successfully'
			);
		} else {
			$response = array(
				'status' => 'error'
			);
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($response));
	}

	public function updateProduct($id)
	{
		header("Content-type:application/json");
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
		header('Access-Control-Allow-Headers: token, Content-Type');

		$requestData = json_decode(file_get_contents('php://input'), true);

		if (!empty($requestData)) {

			$productName = $requestData['product_name'];
			$productPrice = $requestData['product_price'];
			$productDescription = $requestData['product_description'];
			// $productImage = $requestData['product_image'];

			$productData = array(
				'product_name' => $productName,
				'product_price' => $productPrice,
				'product_description' => $productDescription
				// 'product_image' =>$productImage
			);

			$id = $this->Product_action->update_product($id, $productData);

			$response = array(
				'status' => 'success',
				'message' => 'Product updated successfully.'
			);
		} else {
			$response = array(
				'status' => 'error'
			);
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($response));
	}

	public function deleteProduct($id)
	{
		header("Content-type:application/json");
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
		header('Access-Control-Allow-Headers: token, Content-Type');

		$product = $this->Product_action->delete_product($id);
		$response = array(
			'message' => 'Product deleted successfully.'
		);

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($response));
	}
}
