<?php 

namespace Web\Http\Controllers\Interfaces;

interface IApiDAO {
	
	function show($request, $response, $args);
	
	function drop($request, $response, $args);
	
	function update($request, $response, $args);
	
	function create($request, $response, $args);
	
} 