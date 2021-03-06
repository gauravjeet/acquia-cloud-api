<?php

require './vendor/autoload.php';

class GetSolrIndexes implements CloudApiOpsInterface {

  /**
   * @var IdentityProvider
   */
  private $idp;

  /**
   * @var SendRequest
   */
  public $sendRequest;

  /**
   * @var Vars
   */
  public $vars;

  /**
   * Constructor class
   * @param IdentityProvider $idp
   */
  public function __construct(IdentityProvider $idp) {
    $this->idp = $idp;
    $this->sendRequest = new SendRequest();
    $this->vars = new Vars();
  }

  /**
   * Gets solr core indexes from Acquia Cloud
   */
  public function sendRequest($options = [], $print_output = TRUE) {
    $output = [];
    $request = $this->idp->getProvider()->getAuthenticatedRequest(
      'GET',
      $this->vars->getUri() . '/environments/' . $this->vars->getEnvId() . '/search/indexes',
      $this->idp->getAuthToken()
    );

    if ($print_output) {
      echo 'RESPONSE : ';
      print_r($this->sendRequest->send($request));
    }
    else {
      $output[] = $this->sendRequest->send($request);
    }

    return $output;
  }
}
