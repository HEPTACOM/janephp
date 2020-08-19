<?php

namespace Github\Endpoint;

class ActionsGetSelfHostedRunnerForRepo extends \Jane\OpenApiRuntime\Client\BaseEndpoint implements \Jane\OpenApiRuntime\Client\Endpoint
{
    protected $owner;
    protected $repo;
    protected $runner_id;
    /**
     * Gets a specific self-hosted runner. You must authenticate using an access token with the `repo` scope to use this endpoint.
     *
     * @param string $owner 
     * @param string $repo 
     * @param int $runnerId runner_id parameter
     */
    public function __construct(string $owner, string $repo, int $runnerId)
    {
        $this->owner = $owner;
        $this->repo = $repo;
        $this->runner_id = $runnerId;
    }
    use \Jane\OpenApiRuntime\Client\EndpointTrait;
    public function getMethod() : string
    {
        return 'GET';
    }
    public function getUri() : string
    {
        return str_replace(array('{owner}', '{repo}', '{runner_id}'), array($this->owner, $this->repo, $this->runner_id), '/repos/{owner}/{repo}/actions/runners/{runner_id}');
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null) : array
    {
        return array(array(), null);
    }
    public function getExtraHeaders() : array
    {
        return array('Accept' => array('application/json'));
    }
    /**
     * {@inheritdoc}
     *
     *
     * @return null|\Github\Model\Runner
     */
    protected function transformResponseBody(string $body, int $status, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        if (200 === $status && mb_strpos($contentType, 'application/json') !== false) {
            return $serializer->deserialize($body, 'Github\\Model\\Runner', 'json');
        }
    }
    public function getAuthenticationScopes() : array
    {
        return array();
    }
}