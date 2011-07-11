<?php
class IndexControllerTest extends ControllerTestCase 
{
	public function testIndex()
	{
		$this->dispatch("/");		
		
		$this->assertController("index");
		$this->assertAction("index");
		$this->assertResponseCode(200);
	}
	
}