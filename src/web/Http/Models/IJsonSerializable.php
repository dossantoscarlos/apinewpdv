<?php 

namespace Web\Http\Models;

interface IJsonSerializable 
{
	public function jsonSerialize() : array;
}