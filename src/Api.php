<?php

namespace Like\GithubApi;

use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Client;

class Api {

	/**
	 * Token for communication with GitHub.
	 *
	 * @var string
	 */
	private $token;

	/**
	 * Base URL for communication.
	 *
	 * @var Client
	 */
	private $client;

	const DEFAULT_BASE_URL = 'https://api.github.com';

	public function __construct($token, $baseUrl=self::DEFAULT_BASE_URL) {
		$this->token = $token;
		$this->client = new Client([
			'base_uri' => $baseUrl,
		]);
	}

	public function pullRequestComment($ower, $repo, $prNumber, $body) {
		$this->request(
			"/repos/{$ower}/{$repo}/issues/${prNumber}/comments",
			['body' => $body]
		);
	}

	public function request($url, array $body) {
		try {
			$this->client->request('POST', $url, [
				'body' => json_encode($body),
				'auth' => ['token', $this->token],
			]);
		} catch (RequestException $ex) {
			throw new RequestErrorException("Error on comment in github: {$ex->getMessage()}", 0, $ex);
		}
	}
}
