<?php
namespace cases\admin;

use \PHPUnit\Framework\TestCase;
use \library\admin as admin;

class ExtensionsTest extends TestCase
{
	public function testCustomExtensionTablesPresent()
    {
        $admin = new admin();
        $tables = $admin->tables();
        
        $names = [];
        foreach($tables as $table)
        {
            $names[] = $table["TABLE_NAME"];
        }

        /**
         * Tables that are installed and used by third party extensions.
         */
        $searches = [
            "tw_price_history",
            "tw_manufacturer_prices",
        ];

        foreach($searches as $table)
        {
            $this->assertTrue(in_array($table, $names), "Extension table `{$table}` is not available.");
        }
    }
}
