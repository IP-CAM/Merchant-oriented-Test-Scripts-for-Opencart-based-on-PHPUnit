<?php

namespace cases\admin;

use \PHPUnit\Framework\TestCase;
use \library\DatabaseExecutor;

class DownloadsTest extends TestCase
{
    private function _downloads()
    {
        $dbx = new DatabaseExecutor();
        $downloads = $dbx->downloads();

        assert(count($downloads) > 0, "Your store does not have downloadable products.");
        return $downloads;
    }

    public function testDownloadableFilesMustBeZipFormat()
    {
        $downloads = $this->_downloads();

        foreach ($downloads as $download) {
            $extension = pathinfo(basename($download["mask"]))["extension"];
            $this->assertEquals("zip", $extension, "Offer downloads in .zip file format only.");
        }
    }

    public function testDownloadShouldExist()
    {
        $downloads = $this->_downloads();

        foreach ($downloads as $download) {
            $download['filename'] = basename($download['filename']);
            $masked_file = DIR_STORAGE . "download/{$download['filename']}";

            $download_exists = is_file($masked_file);
            $this->assertTrue($download_exists, "Missing download file for id #{$download['download_id']}: {$download['name']}.");
        }
    }

    public function testDownloadableProductHasAFileLinked()
    {
        $downloads = $this->_downloads();

        $dbx = new DatabaseExecutor();
        $downloadable_products = $dbx->downloadable_products();
        foreach ($downloadable_products as $product) {
            // check downloadable record exists
            $download_found = false;
            foreach ($downloads as $download) {
                if ($download["product_id"] == $product["product_id"]) {
                    $download_found = true;
                }
            }

            $this->assertTrue($download_found, "Failed linking a downloadable product for Product ID: #{$product['product_id']}.");
        }
    }

    // for each downloadable product
    // download product is masked
    // download product is actively linked
    // customer who purchased a download can successfully download file
    // download links are protected with login
    // logged in customer cannot download another file, unless purchased

    // SELECT product_id FROM `oc_product` WHERE tax_class_id=10;

    public function testAddMimeColumn()
    {
        // Add file size, file MIME, and hash signature to a downloadable file.
        //
        //apply file size limits
        //restrict others but .zip: reject!
        //A product can have multiple files attached. All files should exist.
        $this->markTestSkipped();
    }

    public function testAddSizeColumn()
    {
        $this->markTestSkipped();
    }

    public function testAddHashColumn()
    {
        $this->markTestSkipped();
    }
}
