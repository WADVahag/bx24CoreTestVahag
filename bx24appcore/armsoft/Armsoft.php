<?

namespace armsoft;

class Armsoft
{

    public $soapUrl = '';
    private $username = '';
    private $password = '';
    private $dbName = '';

    function __construct($soapUrl, $username, $password, $dbName)
    {
        $this->soapUrl = $soapUrl; // must contain wsdl in the end
        $this->username = $username;
        $this->password = $password;
        $this->dbName = $dbName;
    }

    public function getProducts($soapClient) //soapClient is given from level above in run php
    {

        $result = $soapClient->__soapCall(
            "StartSession",
            array(
                "parameters" => array(
                    "UserName" => $this->username, "Password" => $this->password, "DBName" => $this->dbName
                )
            )
        );

        $resMat = $soapClient->__soapCall( //soapClient is given from level above in run php
            "GetMaterialsList",
            array(
                "parameters" => array(
                    "sessionId" => $result->StartSessionResult,
                    "seqNumber" => 1
                    //"UserName"=>"ADMIN", "Password"=>"", "DBName"=>"Sample_70" 
                )
            )
        );

        return $resMat;
    }
}
