<?

namespace armsoft;

class Armsoft
{

    private $soapUrl = '';
    private $username = '';
    private $password = '';
    private $dbName = '';
    function __construct($soapUrl)
    {
        return $this->soapUrl = $soapUrl; // must contain wsdl in the end
        return $this->username = $username;
        return $this->password = $password;
        return $this->dbName = $dbName;
    }

    public function getProducts()
    {
        $aHTTP['http']['header'] = "User-Agent: PHP-SOAP/5.5.11\r\n";
        $context = stream_context_create($aHTTP);
        $client = new SoapClient($this->soapUrl, array('trace' => 1, "stream_context" => $context));

        $result = $client->__soapCall(
            "StartSession",
            array(
                "parameters" => array(
                    "UserName" => $this->username, "Password" => $this->password, "DBName" => $this->dbName
                )
            )
        );

        $resMat = $client->__soapCall(
            "GetMaterialsList",
            array(
                "parameters" => array(
                    "sessionId" => $result->StartSessionResult,
                    "seqNumber" => 1
                    //"UserName"=>"ADMIN", "Password"=>"", "DBName"=>"Sample_70" 
                )
            )
        );

        print_r($resMat);
    }
}
