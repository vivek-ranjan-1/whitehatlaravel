<?php 

namespace App\Services\SocialMedia;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Credential;

class SocialMediaController extends Controller {
    
    /**
     * Social Media/Graph APIs controller
     *
     * @Author- Mr. Vivek Ranjan
     * @Contact No.- 9827029863 / 9400365935
     * @email- 16cs086vive@gmail.com
     * @App-version 1.0
     * @description Social Media/Graph Apis controller
     *
     * @Functions- Social Media/Graph Apis controller
     */ 
    
    private $clientId;
    private $userId;
    private $clientSecret;
    private $token;
    private $pageToken;

    public function __construct() {
        $this->loadCredentials();
    }

    /**
     * Load credentials from database
     */
    private function loadCredentials() {
        $credentials = Credential::firstOrFail();
        $this->clientId = $credentials->client_id;
        $this->userId = $credentials->user_id;
        $this->clientSecret = $credentials->client_secret;
        $this->token = $credentials->token;
    }

    /**
     * Make a cURL request and return the response
     *
     * @param string $url
     * @return object|false
     */
    private function makeApiRequest($url) {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30); // Set timeout for the cURL request

        $result = curl_exec($ch);

        if (curl_errno($ch)) {
            Log::error('CURL error: ' . curl_error($ch));
            curl_close($ch);
            return false;
        }

        curl_close($ch);

        return json_decode($result);
    }

    /**
     * Helper method to construct Facebook Graph API URL
     * 
     * @param string $endpoint
     * @param array $params
     * @return string
     */
    private function constructUrl($endpoint, array $params = []) {
        $url = "https://graph.facebook.com/{$endpoint}?";
        return $url . http_build_query($params);
    }

    /**
     * Fetch the Facebook Page access token
     *
     * @return string|false
     */
    public function getPageToken() {
        try {
            $url = $this->constructUrl("{$this->clientId}/accounts", [
                'access_token' => $this->token
            ]);

            $response = $this->makeApiRequest($url);
            
            if ($response && isset($response->data) && count($response->data) > 0) {
                // Assuming the first page token in the response is the required one
                $this->pageToken = $response->data[0]->access_token;
                return $this->pageToken;
            }

            Log::error('No page token found in the response.');
            return false;
        } catch (\Exception $e) {
            Log::error('Error fetching page token: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Refresh the Facebook page token using the exchange token method
     *
     * @return mixed
     */
    public function refreshPageToken() {
		try {
			// Prepare the parameters for the long-lived token exchange
			$params = [
				'grant_type' => 'fb_exchange_token',
				'client_id' => $this->userId, // your App's client_id
				'client_secret' => $this->clientSecret, // your App's client_secret
				'fb_exchange_token' => $this->token // the short-lived token you currently have
			];

			// Construct the URL to request the long-lived token
			$url = $this->constructUrl('v16.0/oauth/access_token', $params);

			// Make the API request to refresh the token
			$response = $this->makeApiRequest($url);

			if ($response && isset($response->access_token)) {
				$newToken = $response->access_token;

				// Save the new long-lived token in the database
				$credentials = Credential::firstOrFail();
				$credentials->token = $newToken;
				$credentials->save();

				return $newToken;
			}

			Log::error('Unable to refresh token: ' . json_encode($response));
			return false;
		} catch (\Exception $e) {
			Log::error('Error refreshing page token: ' . $e->getMessage());
			return false;
		}
	}

    
    /**
     * Fetch data from Facebook Graph API
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function fetchData() {
        $token = $this->getPageToken();

        if (!$token) {
            return response()->json([
                'message' => 'Unable to fetch access token',
                'status' => false
            ], 500);
        }

        $url = $this->constructUrl('v21.0/me', [
            'fields' => 'id,name,posts.limit(10){full_picture,message,created_time,permalink_url}',
            'access_token' => $token
        ]);

        // Make the API request to fetch the data
        $response = $this->makeApiRequest($url);

        return response()->json($response);
    }
}
