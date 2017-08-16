ANY ***
<?xml version="1.0" encoding="iso-8859-2"?>
<xsd:schema>
    <xsd:element name="person">
      <xsd:complexType>
        <xsd:sequence>
          <xsd:element name="firstname" type="xsd:string"/>
          <xsd:element name="lastname" type="xsd:string"/>
          <xsd:any minOccurs="1" maxOccurs="2"/>
        </xsd:sequence>
      </xsd:complexType>
    </xsd:element>
    <xsd:element name="country" type="xsd:string"/>
    <xsd:element name="adress" type="xsd:string"/>
</xsd:schema>

***

<?xml version="1.0" encoding="utf-8"?>
<person>
  <firstname>Jakub</firstname>
  <lastname>Pelikan</lastname>
</person>
***


