<?php

class Accueil_test extends TestCase
{
	public function test_index()
	{
		$output = $this->request('GET', 'Accueil/index');
		$this->assertContains('Bienvenu sur le site pour le cours UX!', $output);
	}

}
