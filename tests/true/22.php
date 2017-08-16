SIMPLETYPE ***
<?xml version="1.0"?>
<xsd:schema xmlns:xsd="http://www.w3.org/2001/XMLSchema">
<xsd:element name="age">
  <xsd:simpleType>
    <xsd:restriction base="xsd:integer">
      <xsd:minInclusive value="0"/>
      <xsd:maxInclusive value="100"/>
    </xsd:restriction>
  </xsd:simpleType>
</xsd:element>
</xsd:schema>
***
<?xml version="1.0" encoding="utf-8"?>
<age>35</age>
***
[' TAG: age ATRIBB: {} TEXT: 35']


