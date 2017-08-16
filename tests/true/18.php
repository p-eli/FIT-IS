GROUP ELEMENT ***
<?xml version="1.0"?>
<xsd:schema xmlns:xsd="http://www.w3.org/2001/XMLSchema">

<xsd:group name="custGroup">
  <xsd:sequence>
    <xsd:element name="customer" type="xsd:string"/>
    <xsd:element name="orderdetails" type="xsd:string"/>
    <xsd:element name="billto" type="xsd:string"/>
    <xsd:element name="shipto" type="xsd:string"/>
  </xsd:sequence>
</xsd:group>

<xsd:element name="order" type="ordertype"/>

<xsd:complexType name="ordertype">
  <xsd:group ref="custGroup"/>
  <xsd:attribute name="status" type="xsd:string"/>
</xsd:complexType>

</xsd:schema>
***
<?xml version="1.0" encoding="utf-8"?>
<order status="fine">
  <customer>customer</customer>
  <orderdetails>orderdetails</orderdetails>
  <billto>billto</billto>
  <shipto>shipto</shipto>
</order>
***
[[' TAG: customer ATRIBB: {} TEXT: customer', ' TAG: orderdetails ATRIBB: {} TEXT: orderdetails', ' TAG: billto ATRIBB: {} TEXT: billto', ' TAG: shipto ATRIBB: {} TEXT: shipto']]

