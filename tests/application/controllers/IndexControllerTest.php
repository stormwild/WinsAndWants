<?php
class IndexControllerTest extends ControllerTestCase 
{
	public function testIndex()
	{
		$this->dispatch("/");
		
		//echo $this->getResponse()->getBody();
		
		$this->assertController("index");
		$this->assertAction("index");
		$this->assertResponseCode(200);
	}
	
}