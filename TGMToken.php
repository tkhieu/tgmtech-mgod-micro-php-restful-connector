<?php
/**
 * TGMToken FileAPI Class
 */
class TGMToken
{
	protected $secret = 'nekotmgt';
	protected $hash_formula = '$signature === md5($secret)';
	protected $signature;
	protected $params;

	public function __construct($signature, $params)
	{
		$this->signature = $signature;
		$this->params = $params;
	}

	public function setSecret($secret)
	{
		$this->secret = $secret;
	}

	public function setHashFormula($formula)
	{
		$this->hash_formula = $formula;
	}

	public function isValid()
	{
		$secret		= $this->secret;
		$signature	= null; 
		$result		= false;

		extract($this->params);

		$code = '$signature = ' . $this->hash_formula . ';';
		eval($code);

		return ($this->signature === $signature);
	}
}
