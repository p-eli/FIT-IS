COMPLEX CONTENT ***
<?xml version="1.0" encoding="iso-8859-2"?>
<xsd:schema>
<xsd:element name="employee" type="fullpersoninfo"/>

<xsd:complexType name="personinfo">
  <xsd:sequence>
    <xsd:element name="firstname" type="xsd:string"/>
    <xsd:element name="lastname" type="xsd:string"/>
  </xsd:sequence>
</xsd:complexType>

<xsd:complexType name="fullpersoninfo">
  <xsd:complexContent>
    <xsd:extension base="personinfo">
      <xsd:sequence>
        <xsd:element name="address" type="xsd:string"/>
        <xsd:element name="city" type="xsd:string"/>
        <xsd:element name="country" type="xsd:string"/>
      </xsd:sequence>
    </xsd:extension>
  </xsd:complexContent>
</xsd:complexType>
</xsd:schema>
***
<?xml version="1.0" encoding="utf-8"?>
<employee>
  <firstname>firstname</firstname>
  <lastname>lastname</lastname>
  <address>address</address>
  <city>city</city>
  <country>country</country>
</employee>
***
[[' TAG: firstname ATRIBB: {} TEXT: firstname', ' TAG: lastname ATRIBB: {} TEXT: lastname', ' TAG: address ATRIBB: {} TEXT: address', ' TAG: city ATRIBB: {} TEXT: city', ' TAG: country ATRIBB: {} TEXT: country']]

