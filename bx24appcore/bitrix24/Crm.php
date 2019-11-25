<?php

namespace Bitrix24;

class Crm
{
    private $webhook = '';

    function __construct($webhook)
    {
        return $this->webhook = $webhook;
    }

    private function restCommand($method, $params = array())
    {

        $queryUrl  = $this->webhook . $method;
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


    public function getContactList($params = array())
    {
        return $this->restCommand('crm.contact.list', $params);
    }

    public function ContactAdd($params = array())
    {
        return $this->restCommand('crm.contact.add', $params);
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

    public function getCompanieList($params = array())
    {
        return $this->restCommand('crm.company.list', $params);
    }

    public function CompanieAdd($params = array())
    {
        return $this->restCommand('crm.company.add', $params);
    }

    public function CompanieUpdate($id, $params = array())
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

    public function CompanieDelete($id)
    {
        return $this->restCommand('crm.company.delete', array('id' => $id));
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
        return $this->restCommand('crm.deal.add', $params);
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

    public function DealContactAdd($dealId, $contactId)
    {
        return $this->restCommand('crm.deal.contact.add', array(
            'id' => $dealId,
            'fields' => array(
                'CONTACT_ID' => $contactId
            ),
        ));
    }

    public function getDealUserFields()
    {
        return $this->restCommand('crm.deal.userfield.list ');
    }

    public function getLeadList($params = array())
    {
        return $this->restCommand('crm.lead.list', $params);
    }
    public function LeadAdd($params = array())
    {
        return $this->restCommand('crm.lead.add', $params);
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


    public function getProductList($params = array())
    {
        return $this->restCommand('crm.product.list', $params); //example array('order'=> array( "NAME" => "ASC" ),'filter'=> array( "CATALOG_ID" => 1 ),'select' => array( "ID", "NAME", "CURRENCY_ID", "PRICE"))
    }

    public function ProductAdd($params = array())
    {
        return $this->restCommand('crm.product.add', $params);
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

    public function getUserfields()
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
        return $this->restCommand('lists.element.add', $params);
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

    public function getActivityList($params)
    {
        return $this->restCommand('bizproc.activity.list', $params = array());
    }

    public function ActivityAdd($params)
    {
        return $this->restCommand('bizproc.activity.add', $params = array());
    }

    public function getListElementById($id)
    {
        return $this->restCommand('lists.element.get', $params = array(
            'IBLOCK_TYPE_ID' => 'lists',
            'IBLOCK_ID' => $id
        ));
    }



    public function getContactById($id)
    {
        return $this->restCommand('crm.contact.get', $params = array(
            'id' => $id
        ));
    }

    public function getDealById($id)
    {
        return $this->restCommand('crm.deal.get', $params = array(
            'id' => $id
        ));
    }

    public function getCompanyById($id)
    {
        return $this->restCommand('crm.company.get', $params = array(
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
}
