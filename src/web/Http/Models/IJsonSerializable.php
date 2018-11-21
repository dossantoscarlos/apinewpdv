<?php 

namespace Web\http\Models\;

interface IJsonSerializable 
{
	public function jsonSerialize() : array;
}