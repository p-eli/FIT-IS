ALL ***
<?xml version="1.0" encoding="iso-8859-2"?>
<xsd:schema >
	<xsd:element name="person">
      <xsd:complexType>
        <xsd:all minOccurs="1">
          <xsd:element name="firstname" type="xsd:string"/>
          <xsd:element name="lastname" type="xsd:string"/>
        </xsd:all>
      </xsd:complexType>
	</xsd:element>
</xsd:schema>
***
<?xml version="1.0" encoding="utf-8"?>
<person>
  <lastname>Pelikan</lastname>
  <lastname>Pelikan</lastname>
</person>

