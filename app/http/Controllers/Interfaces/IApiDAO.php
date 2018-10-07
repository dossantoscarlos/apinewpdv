<?php 

namespace App\Http\Controllers\interfaces;

interface IApiDAO {
	
	function show($request, $response, $args);
	
	function drop($request, $response, $args);
	
	function update($request, $response, $args);
	
	function create($request, $response, $args);
	
} 