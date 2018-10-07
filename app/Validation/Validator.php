<?php 
	namespace App\Validation;

	use Respect\Validation\Validator as Respect;
	use Respect\Validation\Exceptions\NestedValidationException;
	
	class Validator
	{
		protected $erros;
		
		public function validate($request, array $rules)
		{

			foreach ($rules as $field => $rule) {
				try {
					$rule->setName($field)->assert($request->getParam($field));
				} catch(NestedValidationException $e) {
				   return $this->erros[$field] = $e->getMessages();
				}
			}	
		}
	}
?>