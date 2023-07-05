<?php

namespace Tests\Acceptance;

use Tests\Support\AcceptanceTester;

class IndexTesteCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function buscarResultadosNaPaginaTest(AcceptanceTester $I)
    {
		$I->amOnPage('/');
		$I->see('Nosso');
    }
}

?>
