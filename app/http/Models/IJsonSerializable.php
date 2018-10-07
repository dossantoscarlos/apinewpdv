<?php 

namespace App\Http\Models;

interface IJsonSerializable 
{
	public function jsonSerialize() : array;
}