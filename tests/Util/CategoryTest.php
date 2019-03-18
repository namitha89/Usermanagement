<?php 
namespace App\Tests\Util;

use App\Controller\Category;
use PHPUnit\Framework\TestCase;

class CategoryTest extends TestCase
{

	public function testShow(){
	  
          $Category = new Category();
          $results = $Category->show(1)
	}
}
