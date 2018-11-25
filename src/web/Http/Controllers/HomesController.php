<?php 

namespace Web\Http\Controllers;

class HomesController extends Controller 
{
	public function show ($request, $response , $args)
	{
		return $this->view->render($response,'home.html');
	}
}