<?php

/*
 *  simple HttpRequest example using PHP
 *  tom slankard
 */

class HttpRequest {

  public $url = null;
  public $method = 'GET';
  public $body = null;
  public $headers = Array();
  public $allow_redirect = true;

  public $url_info = null;
  private $host_name = null; 
  private $host_ip = null;
  private $response_body = null;
  private $response_headers = Array();
  private $response_code = null;
  private $response_message = null;
  public $port = null;
  private $verbose = true;

  public function __construct($url, $method = 'GET') {

    $this->url = $url;
    $this->method = $method;

    //  parse url
    $this->url_info = parse_url($url);
    $this->host_name = $this->url_info['host'];
    $this->host_ip = gethostbyname($this->host_name);

    //  get port number given the scheme
    if(!isset($this->url_info['port'])) {
      if($this->url_info['scheme'] == "http")
        $this->port = 80;
      else if($this->url_info['scheme'] == "https")
        $this->port = 443;
    } else {
      $this->port = $this->url_info['port'];
    }

    //  add default headers
    $this->headers["Host"] = "$this->host_name";
    $this->headers["Connection"] = "close";

  }

  private function constructRequest() {
    $path = "/";
    if(isset($this->url_info['path']))
      $path = $this->url_info['path'];

    $req = "$this->method $path HTTP/1.1\r\n";
    foreach($this->headers as $header => $value) {
      $req .= "$header: $value\r\n";
    }
  
    return "$req\r\n";
  }

  ///  reads a line from a file
  function readLine($fp)
  {
    $line = "";

    while (!feof($fp)) {
      $line .= fgets($fp, 2048);
      if (substr($line, -1) == "\n") {
        return rtrim($line, "\r\n");
      }
    }
    return $line;
  }

  public function send() {

    $fp = fsockopen($this->host_ip, $this->port);

    //  construct request
    $request = $this->constructRequest();

    //  write request to socket
    fwrite($fp, $request);

    //  read the status line
    $line = $this->readline($fp);
    $status = explode(" ", $line);

    //  make sure the HTTP version is valid
    if(!isset($status[0]) || !preg_match("/^HTTP\/\d+\.?\d*/", $status[0]))
     // die("Couldn't get HTTP version from response.");
		echo ("Couldn't get HTTP version from response.");

    //  get the response code
    if(!isset($status[1]))
      echo ("Couldn't get HTTP response code from response."); //was die
    else $this->response_code = $status[1];
    
    //  get the reason, e.g. "not found"
    if(!isset($status[2]))
      echo ("Couldn't get HTTP response reason from response."); //was die
    else $this->response_reason = $status[2];

    //  read the headers
    do {
      $line = $this->readLine($fp);
      if($line != "") { 
        $header = split(":", $line);

        $this->response_headers[$header[0]] = ltrim($header[1]);
      }
    } while(!feof($fp) && $line != "");

    //  read the body
    $this->response_body = "";
    do {
      $line = $this->readLine($fp); {
      if($line)
        $this->response_body .= "$line\n";
      }
    } while(!feof($fp));

    //  close the connection
    fclose($fp);

    return TRUE;
  }

  public function getStatus() {
    return $this->response_code;
  }

  public function getHeaders() {
    return $this->response_headers;
  }

  public function getResponseBody() {
    return $this->response_body;
  }

}


echo ("http.php starting");
// $req = new HttpRequest("http://www.iana.org/domains/example/", "GET");
//$req = new HttpRequest("http://abacuz.net/receive-post.php?mame=fred", "GET");
$req = new HttpRequest("https://www.googleapis.com/oauth2/v3/tokeninfo?id_token=eyJhbGciOiJSUzI1NiIsImtpZCI6ImQ3YThiNzVmMmE2NWQ4Yjc4MDMzZjI5ZmUyNjZhYmVhODU5MWE2YzYifQ.eyJpc3MiOiJhY2NvdW50cy5nb29nbGUuY29tIiwiYXRfaGFzaCI6IjFETkdUQUkxX2RsejRPZFpGbkRocWciLCJhdWQiOiI2NDA5MTE5NzE5NDYtcDRpZWJ2a2w0M3Q0M29ndHM5ZzkwaXVuMGdlcmEzMTcuYXBwcy5nb29nbGV1c2VyY29udGVudC5jb20iLCJzdWIiOiIxMTEzNDA1Mjg2NDU3NDEzNzgzNzkiLCJlbWFpbF92ZXJpZmllZCI6dHJ1ZSwiYXpwIjoiNjQwOTExOTcxOTQ2LXA0aWVidmtsNDN0NDNvZ3RzOWc5MGl1bjBnZXJhMzE3LmFwcHMuZ29vZ2xldXNlcmNvbnRlbnQuY29tIiwiZW1haWwiOiJnYXJ5ZGFjY2FydGVyQGdtYWlsLmNvbSIsImlhdCI6MTQzOTU2Mjg3MCwiZXhwIjoxNDM5NTY2NDcwLCJuYW1lIjoiR2FyeSBDYXJ0ZXIiLCJwaWN0dXJlIjoiaHR0cHM6Ly9saDUuZ29vZ2xldXNlcmNvbnRlbnQuY29tLy1NaWpPdEFwekpTay9BQUFBQUFBQUFBSS9BQUFBQUFBQUFIcy9nTS1SZHNWbFVncy9zOTYtYy9waG90by5qcGciLCJnaXZlbl9uYW1lIjoiR2FyeSIsImZhbWlseV9uYW1lIjoiQ2FydGVyIiwibG9jYWxlIjoiZW4tR0IifQ.HgO1PNG8nYGTBQaBNAcoKYuWcYSX0gBSDh32FAZqWaQeKYD3jd232JyzPoIkyU9JMtX0StJ8yiiT4P90m0W7tqe1_bJ8ULV8iM565-ltZ6GseoIRX9AnPS4G8kciOGWwkrHFeAHTyqpgoXVdemzHQAxCc454v3Arm-BHcVebhtQtFY6bGHIZIsapb5ppLf6aO9A_s4hdcCT5FxYH6f04y9NtOKqbrveoUskxFuY2hPmfSDiigx6N1EmDY7-kb1GIDEbLftkYWxTcEKDnTUvyVXj2r-HJDBpXBo7Cntgx3YHc-pV69v-tL4kFBgoZ9_NVgx3aqYrJTlvV6Jsu8pEmWw", "GET");


echo ( $req->method);
echo ( $req->port);
echo ( $req->url_info['scheme']);

$req->headers["Connection"] = "close";
$req->send() or die("Couldn't send!");
echo( $req->getResponseBody() );
echo( $req->getStatus() );
print_r( $req->getHeaders() );
echo ( $req->url);
echo ("After");
echo( $req->getResponseBody() );
?>