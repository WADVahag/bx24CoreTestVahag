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
        $resMat = json_decode(json_encode($resMat), true);
        echo '<pre>';
        $totalProducts = $resMat['GetMaterialsListResult']['Total'];
        $allProductsArray[1] = $resMat['GetMaterialsListResult']['Rows']['MaterialInfo'];;
        for ($i = 2; $i <= intval($totalProducts / 50 + 1); $i++) {
            //echo $totalProducts;
            $resMatAll = false;
            // echo $i;
            // echo '<br>';
            $resMatAll = $soapClient->__soapCall( //soapClient is given from level above in run php
                "GetMaterialsNextChunk",
                array(
                    "parameters" => array(
                        "sessionId" => $result->StartSessionResult,
                        "seqNumber" => $i
                    )
                )
            );
            $resMatAll = json_decode(json_encode($resMatAll), true);
            $totalProductFromCHunk = $resMatAll['GetMaterialsNextChunkResult']['Rows']['MaterialInfo'];
            $allProductsArray[$i] = $totalProductFromCHunk;

            $allProductsArray[] = $i;
        }
        $allProductsArray['totalProducts'] = $totalProducts;
        return $allProductsArray;
    }

    public function getPartners($soapClient) //soapClient is given from level above in run php
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
            "GetPartnersList",
            array(
                "parameters" => array(
                    "sessionId" => $result->StartSessionResult,
                    "seqNumber" => 1
                    //"UserName"=>"ADMIN", "Password"=>"", "DBName"=>"Sample_70" 
                )
            )
        );
        $resMat = json_decode(json_encode($resMat), true);
        echo '<pre>';
        $totalPartners = $resMat['GetPartnersListResult']['Total'];
        $allPartnersArray[1] = $resMat['GetPartnersListResult']['Rows']['PartnerInfo'];
        echo 'total Partners === '.$totalPartners;
        for ($i = 2; $i <= intval($totalPartners / 50 + 1); $i++) {
            //echo $totalProducts;
            $resMatAll = false;
            // echo $i;
            // echo '<br>';
            $resMatAll = $soapClient->__soapCall( //soapClient is given from level above in run php
                "GetPartnersNextChunk",
                array(
                    "parameters" => array(
                        "sessionId" => $result->StartSessionResult,
                        "seqNumber" => $i
                    )
                )
            );
            $resMatAll = json_decode(json_encode($resMatAll), true);
            $totalPartnerFromCHunk = $resMatAll['GetPartnersNextChunkResult']['Rows']['PartnerInfo'];
            $allPartnersArray[$i] = $totalPartnerFromCHunk;

            $allPartnersArray[] = $i;
        }
       $allPartnersArray['totalPartners'] = $totalPartners;
        return $allPartnersArray;
    }
}
