<?php
/**
 * Class SampleTest
 *
 * @package Wwd_Mailer
 */

/**
 * Sample test case.
 */
class UserTest extends WP_UnitTestCase {

	/**
	 * A single example test.
	 */
	function test_user() {
		// Replace this with some actual testing code.

		run_wwd_mailer();
		$str = return_string();

		$mailer = new Wwd_Mailer_Mail();
		$str = $mailer->messaging('success','willhoneywill@mail.com');

		$this->assertEquals('Email successfully sent to willhoneywill@mail.com', $str);
	}
}
