<?php

namespace Like\GithubApi\Tests;

use Like\GithubApi\Api;
use PHPUnit\Framework\TestCase;

class ApiTest extends TestCase {
	public function testInstance() {
		$api = new Api( getenv('GITHUB_TOKEN') );
		$this->assertInstanceOf(Api::class, $api);
		$api->pullRequestComment('likesistemas', 'github-api', 1, "Test comment.");
	}
}
