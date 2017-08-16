LIST ***
<?xml version="1.0"?>
<xsd:schema xmlns:xsd="http://www.w3.org/2001/XMLSchema">

<xsd:element name="intvalues" type="valuelist"/>

<xsd:simpleType name="valuelist">
  <xsd:list itemType="xsd:integer"/>
</xsd:simpleType>

</xsd:schema>
***
<?xml version="1.0" encoding="utf-8"?>
<intvalues>100 34 56 -23 1567</intvalues>
***
[" TAG: intvalues ATRIBB: {} TEXT: ['100', '34', '56', '-23', '1567']"]

