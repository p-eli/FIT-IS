ALL ***
<?xml version="1.0" encoding="iso-8859-2"?>
<xsd:schema >
	<xsd:element name="person">
      <xsd:complexType>
        <xsd:all minOccurs="0">
          <xsd:element name="firstname" type="xsd:string"/>
          <xsd:element name="lastname" type="xsd:string"/>
        </xsd:all>
      </xsd:complexType>
	</xsd:element>
</xsd:schema>
***
<?xml version="1.0" encoding="utf-8"?>
<person>
  <firstname>Jakub</firstname>
</person>
***
TAG: person ATTRIB: None TEXT: None CHILD: [' TAG: firstname ATTRIB: None TEXT: Jakub']
