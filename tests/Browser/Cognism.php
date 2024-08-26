<?php
//
//namespace Tests\Browser;
//
//use Illuminate\Foundation\Testing\DatabaseMigrations;
//use Laravel\Dusk\Browser;
//use Tests\DuskTestCase;
//
//
//class Cognism extends DuskTestCase
//{
//
//    use DatabaseMigrations;
//
//    protected static $isLoggedIn = false;
//    /**
//     * A Dusk test example.
//     */
//    public function testExample(): void
//    {
////        $this->browse(function (Browser $browser) {
////            if (!static::$isLoggedIn) {
////                $this->login($browser);
////                static::$isLoggedIn = true;
////            }
//        $this->browse(function (Browser $browser) {
//        $browser->visit('https://app.cognism.com/auth/sign-in')
//            ->pause(2000)
//            ->assertSee('Log in')
//            ->type('input[placeholder="e.g. john@example.com"]','amir@ak-software.com')
//            ->type('input[placeholder="xxxxxxxx"]','CqhaweNhhLZ8c7z!')
//            ->pause(1000)
//            ->press('Log in')
//            ->pause(4000)
//            ->screenshot('login1')
//
//
//                ->press('Load')
//                ->pause('2000');
////                ->press('All Menu managers in US and EU');
//                    $browser->elements('.t-truncate .ant-dropdown-menu-item')[0]->click();
//                    $browser->pause(2000);
//                        $browser->check('label[ng-checkbox=""]')
//                            ->pause(2000)
//                            ->press('Save to List')
//                            ->pause(1000)
//                            ->screenshot('Save to List')
//                            ->click('input[placeholder="Enter Name or Create New List"]');
//                        $browser->elements('.ant-select-item .ant-select-item-option .ng-star-inserted')[0]->click();
//                      $browser->pause(1000)
//                        ->screenshot(1000)
//                        ->click('.ant-switch')
//                        ->pause(1000)
//                        ->press('Save')
//                        ->pause('2000')
//                          ->screenshot('end');
//
//
////            $page=1;
////            $hasResults = true ;
////            while ($hasResults) {
////                $browser->visit('https://app.cognism.com/search/prospects/person-search?page=' . $page);
////                $browser->pause(4000);
////                $browser->screenshot('login2');
////                $browser->check('label[ng-checkbox=""]')
////                    ->pause(2000)
////                    ->screenshot('checkbox')
////                    ->press('Save to List')
////                    ->pause(1000)
////                    ->click('input[placeholder="Enter Name or Create New List"]')
////                    ->pause(1000);
////                $browser->elements('.ant-select-item .ant-select-item-option .ng-star-inserted')[0]->click();
////                $browser->pause(1000)
////                    ->screenshot(1000)
////                    ->click('.ant-switch')
////                    ->pause(1000)
////                    ->press('Save')
////                    ->pause('2000')
////                    ->screenshot('page'.$page);
////                $page++;
////            }
//
//        });
//    }
//
//}


namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;


class Cognism extends DuskTestCase
{

    use DatabaseMigrations;

    protected static $user;

    public function setUp(): void
    {
        parent::setUp();

        // Einmalige Anmeldung und Sitzung speichern
        if (!static::$user) {
            $this->browse(function ($browser) {
                $browser->visit('https://app.cognism.com/auth/sign-in')
                    ->pause(2000)
                    ->assertSee('Log in')
                    ->type('input[placeholder="e.g. john@example.com"]', 'amir@ak-software.com')
                    ->type('input[placeholder="xxxxxxxx"]', 'CqhaweNhhLZ8c7z!')
                    ->pause(1000)
                    ->press('Log in')
                    ->pause(4000)
                    ->screenshot('login1')
                    ->assertPathIs('https://app.cognism.com/search/prospects/person-search?page=1'); // Anmelde-Weiterleitungs-URL anpassen
            });
            static::$user = true; // Markiere, dass die Anmeldung erfolgt ist
        }
    }

    /**
     * A Dusk test example.
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
//            $browser->visit('https://app.cognism.com/auth/sign-in')
//                ->pause(2000)
//                ->assertSee('Log in')
//                ->type('input[placeholder="e.g. mailto:john@example.com"]', 'mailto:amir@ak-software.com')
//                ->type('input[placeholder="xxxxxxxx"]', 'CqhaweNhhLZ8c7z!')
//                ->pause(1000)
//                ->press('Log in')
//                ->pause(4000)
//                ->screenshot('login1')
            $browser->press('Load')
                ->pause('2000')
                ->press('All Menu managers in US and EU');
//            $browser->elements('.t-truncate .ant-dropdown-menu-item')[0]->click();      //***********error
            $browser->pause(2000);
            for ($i = 2; $i < 14; $i++) {
                $browser->check('label[ng-checkbox=""]')
                    ->pause(2000)
                    ->press('Save to List')
                    ->pause(1000)
                    ->screenshot('Save to List')
                    ->click('input[placeholder="Enter Name or Create New List"]');
                $browser->elements('.ant-select-item .ant-select-item-option .ng-star-inserted')[0]->click();
                $browser->pause(1000)
                    ->screenshot(1000)
                    ->click('.ant-switch')
                    ->pause(1000)
                    ->press('Save')
                    ->pause('2000')
                    ->screenshot('end');
                $browser->click('nz-select[data-cognism="page-select"]');
                $browser->elements('.ant-select-item')[$i]->click();
            }
        });
    }


}
