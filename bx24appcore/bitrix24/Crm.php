<?php

namespace Bitrix24;

class Crm
{
    private $webhook = '';

    function __construct($webhook)
    {
        return $this->webhook = $webhook;
    }

    private function restCommand($method, $params = array()) //$fp=false)
    {
        if (!$params['AUTH_ID']) {
            $queryUrl  = $this->webhook . $method;
        } else {
            $queryUrl = $method;
        }

        // echo '<pre>';
        // print_r($params);
        // echo '<pre>';
        // echo 'queryUrl ===>>>'.$queryUrl;

        $queryData = http_build_query($params);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_POST           => 1,
            CURLOPT_HEADER         => 0,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL            => $queryUrl,
            CURLOPT_POSTFIELDS     => $queryData,
        ));

        $result = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($result, 1);
        return $result;
    }

    public function getUser()
    {
        return $this->restCommand('user.current', array());
    }
	
	function getUsers($params = array()){
        $resUsers = $this->restCommand('user.get', $params);

        foreach ($resUsers['result'] as $user){
            $arUsers[$user['ID']] = $user;
        }

        return $arUsers;
    }

    public function getContactList($params = array())
    {
        return $this->restCommand('crm.contact.list', $params);
    }

    public function ContactAdd($params = array())
    {
        return $this->restCommand('crm.contact.add',     array(
            "fields" => $params,
            'params' => ['REGISTER_SONET_EVENT' => 'Y']
        ));
    }

    public function ContactUpdate($id, $params = array())
    {
        return $this->restCommand(
            'crm.contact.update',
            array(
                'id' => intval($id),
                'fields' => $params,
                'params' => ['REGISTER_SONET_EVENT' => 'Y']
            )
        );
    }

    public function ContactDelete($id)
    {
        return $this->restCommand('crm.contact.delete', array('id' => $id));
    }

    public function getContactUserFields($params = array())
    {
        return $this->restCommand('crm.contact.userfield.list', $params);
    }

    public function getCompanyList($params = array())
    {
        return $this->restCommand('crm.company.list', $params);
    }

    public function getCompanyById($id)
    {
        return $this->restCommand('crm.company.get', $params = array(
            'id' => $id
        ));
    }

    public function CompanyAdd($params = array())
    {
        return $this->restCommand('crm.company.add',     array(
            "fields" => $params,
            'params' => ['REGISTER_SONET_EVENT' => 'Y']
        ));
    }

    public function CompanyUpdate($id, $params = array())
    {
        return $this->restCommand(
            'crm.company.update',
            array(
                'id' => intval($id),
                'fields' => $params,
                'params' => ['REGISTER_SONET_EVENT' => 'Y']
            )
        );
    }

    public function CompanyDelete($id)
    {
        return $this->restCommand('crm.company.delete', array('id' => $id));
    }

    public function getCompanFields()
    {
        return $this->restCommand('crm.company.fields');
    }   


    public function getCompanyUserFields($params = array())
    {
        return $this->restCommand('crm.company.userfield.list', $params);
    }

    public function getDealList($params = array())
    {
        return $this->restCommand('crm.deal.list', $params);
    }

    public function DealAdd($params = array())
    {
        return $this->restCommand('crm.deal.add',    array(
            "fields" => $params,
            'params' => ['REGISTER_SONET_EVENT' => 'Y']
        ));
    }

    public function DealUpdate($id, $params = array())
    {
        return $this->restCommand(
            'crm.deal.update',
            array(
                'id' => intval($id),
                'fields' => $params,
                'params' => ['REGISTER_SONET_EVENT' => 'Y']
            )
        );
    }

    public function DealDelete($id)
    {
        return $this->restCommand('crm.deal.delete', array('id' => $id));
    }

    public function getDealFields()
    {
        return $this->restCommand('crm.deal.fields');
    }
    

    public function getDealUserFields()
    {
        return $this->restCommand('crm.deal.userfield.list');
    }

    public function getLeadList($params = array())
    {
        return $this->restCommand('crm.lead.list', $params);
    }
    public function LeadAdd($params = array())
    {
        return $this->restCommand('crm.lead.add',     array(
            "fields" => $params,
            'params' => ['REGISTER_SONET_EVENT' => 'Y']
        ));
    }

    public function LeadUpdate($id, $params = array())
    {
        return $this->restCommand(
            'crm.lead.update',
            array(
                'id' => intval($id),
                'fields' => $params,
                'params' => ['REGISTER_SONET_EVENT' => 'Y']
            )
        );
    }

    public function LeadDelete($id)
    {
        return $this->restCommand('crm.lead.delete', array('id' => $id));
    }

    public function getLeadUserFields($params = array())
    {
        return $this->restCommand('crm.lead.userfield.list', $params);
    }

    public function getLeadFields()
    {
        return $this->restCommand('crm.lead.fields');
    }
    


    public function getProductList($params = array())
    {
        return $this->restCommand('crm.product.list', $params); //example array('order'=> array( "NAME" => "ASC" ),'filter'=> array( "CATALOG_ID" => 1 ),'select' => array( "ID", "NAME", "CURRENCY_ID", "PRICE"))
    }

    public function ProductAdd($params = array())
    {
        return $this->restCommand(
            'crm.product.add',
            array(
                "fields" => $params
            )
        );
    }

    public function ProductUpdate($id, $params = array())
    {
        return $this->restCommand(
            'crm.product.update',
            array(
                'id' => intval($id),
                'fields' => $params
            )
        );
    }

    public function ProductDelete($id)
    {
        return $this->restCommand('crm.product.delete', array('id' => $id));
    }

    public function getUserfields($params = array())
    {
        return $this->restCommand('crm.userfield.fields', $params);
    }

    public function getRequisites($params = array())
    {
        return $this->restCommand('crm.requisite.list', $params);
    }

    public function AttachContactToCompany($contactId, $companyId)
    {
        return $this->restCommand('crm.company.contact.add', [
            'id' => $companyId,
            'fields' => [
                "CONTACT_ID" => $contactId,
            ],
            'params' => ['REGISTER_SONET_EVENT' => 'Y']
        ]);
    }

    public function getListElement($params)
    {
        return $this->restCommand('lists.element.get', $params = array());
    }

    public function ListElementAdd($params = array())
    {
        return $this->restCommand('lists.element.add',  array(
            "fields" => $params
        ));
    }

    public function ListElementUpdate($id, $elCode, $params = array())
    {
        return $this->restCommand('lists.element.update', array(
            'IBLOCK_TYPE_ID' => 'lists',
            'IBLOCK_ID' => $id,
            'ELEMENT_CODE' => $elCode,
            'fields' => $params,
        ));
    }

    public function ListsElementDelete($id, $elCode)
    {
        return $this->restCommand(
            'lists.element.delete',
            array(
                'IBLOCK_TYPE_ID' => 'lists',
                'IBLOCK_ID' => $id,
                'ELEMENT_CODE' => $elCode,
            )
        );
    }

    public function getListFields($params = array())
    {
        return $this->restCommand('lists.field.get', $params);
    }
    
    

    public function getActivityList( $params = array())
    {
        return $this->restCommand('bizproc.activity.list', $params = array());
    }

    public function ActivityAdd($params)
    {
        return $this->restCommand('bizproc.activity.add',     array(
            "fields" => $params
        ));
    }

    public function getListElementById($id)
    {
        return $this->restCommand('lists.element.get', $params = array(
            'IBLOCK_TYPE_ID' => 'lists',
            'IBLOCK_ID' => $id
        ));
    }

    public function CreateFile()
    {
        $file = $_FILES['file']['tmp_name'];
        $filename = $_FILES['file']['name'];
        return $this->restCommand('disk.storage.uploadfile', $params = array(
            'id' => 1,
            'data' => array(
                'NAME' => $filename,
            ),
            'fileContent' => base64_encode(file_get_contents($_FILES['file']['tmp_name'])),
        ));
    }

    public function getContactById($id)
    {
        return $this->restCommand('crm.contact.get', array(
            'id' => $id
        ));
    }

    public function getDealById($id)
    {
        return $this->restCommand('crm.deal.get', array(
            'id' => $id
        ));
    }

    public function getLeadById($id)
    {
        return $this->restCommand('crm.lead.get', $params = array(
            'id' => $id
        ));
    }

    public function getRequisiteById($id)
    {
        return $this->restCommand('crm.requisite.get', $params = array(
            'id' => $id
        ));
    }

    public function getProductById($id)
    {
        return $this->restCommand(
            'crm.product.get',
            $params = array(
                'id' => $id,
            )
        );
    }

    public function ProviderAdd($code, $handler, $name)
    {
        return $this->restCommand(
            'messageservice.sender.add',
            array(
                'CODE' => $code,
                'TYPE' => 'SMS',
                'HANDLER' => $handler,
                'NAME' => $name,
                'DESCRIPTION' => $name
            )
        );
    }


    function getTaskFieds(){
        return $this->restCommand('tasks.task.getFields', array() );
    }    

    function getTasksList($params=array()){
        return $this->restCommand('tasks.task.list', $params );
    }

    function taskAdd($params){
        return $this->restCommand('tasks.task.add', array("fields"=>$params));
    }

    function taskUpdate($id, $fields=array()){
        return $this->restCommand('tasks.task.update', $id, array("fields"=>$fields) );
    }    

    function getEntityItems($params=array() ){
        return $this->restCommand('entity.item.get', $params);
    }


    function getEntityDelete($params=array()){
        return $this->restCommand('entity.item.delete', $params);
    }     

    function bizproc_start( $params = array() ){
        return $this->restCommand('bizproc.workflow.start', $params);	   
    }

     
    function bizproc_activity_list( $params = array() ){
        return $this->restCommand('bizproc.activity.list', $params);	   
    }  

    function bizproc_activity_add( $params = array() ){
        return $this->restCommand('bizproc.activity.add', $params);	   
    }  

    function bizproc_activity_delete( $params = array() ){
        return $this->restCommand('bizproc.activity.delete', $params);	   
    } 
    
    function bizproc_activity_update( $params = array() ){
        return $this->restCommand('bizproc.activity.update', $params);	   
    } 
    

    function bizproc_provider_add( $params = array() ){
        return $this->restCommand('bizproc.provider.add', $params);	   
    }

    function bizproc_provider_list( $params = array() ){
        return $this->restCommand('bizproc.provider.list', $params);	   
    } 
    
    function bizproc_provider_delete( $params = array() ){
        return $this->restCommand('bizproc.provider.delete', $params);	   
    }    
    

   function bizproc_event_send( $params = array() ){
	  return $this->restCommand('bizproc.event.send', $params);	   
   }


  function im_notify( $params = array() ){
    return $this->restCommand('im.notify', $params);	   
  }  

  function bizproc_robot_list( $params = array() ){
    return $this->restCommand('bizproc.robot.list', $params);	   
  }

  function bizproc_robot_add( $params = array() ){
    return $this->restCommand('bizproc.robot.add', $params);	   
  }


  function bizproc_robot_delete( $params = array() ){
    return $this->restCommand('bizproc.robot.delete', $params);	   
  }

  function bizproc_robot_update( $params = array() ){
    return $this->restCommand('bizproc.robot.update', $params);	   
  }


}
