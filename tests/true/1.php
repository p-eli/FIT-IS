ALL ***
<?xml version="1.0" encoding="iso-8859-2"?>
<xsd:schema xmlns="http://www.fit.vutbr.cz/study/courses"
targetNamespace="http://www.fit.vutbr.cz/study/courses"
xmlns:xsd="http://www.w3.org/2001/XMLSchema">
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
  <firstname>Jakub</firstname>
  <lastname>Pelikan</lastname>
</person>
***
[[' TAG: firstname ATRIBB: {} TEXT: Jakub', ' TAG: lastname ATRIBB: {} TEXT: Pelikan']]