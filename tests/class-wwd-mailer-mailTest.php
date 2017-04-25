<?php 
namespace TDD\Test;
require dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR .'autoload.php';
require dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR .'class-wwd-mailer-mail.php';


use PHPUnit\Framework\TestCase;
use wwd\mailer\mail\Wwd_Mailer_Mail;

class Wwd_Mailer_MailTest extends TestCase {
	public function testTotal() {
		$Receipt = new Wwd_Mailer_Mail();
		$this->assertEquals(
			15,
			$Receipt->total([0,2,5,5]),
			'When summing the total should equal 15'
		);
	}
}