ATTRIBUTE ***
<?xml version="1.0" encoding="iso-8859-2"?>
<xsd:schema xmlns="http://www.fit.vutbr.cz/study/courses" 
   targetNamespace="http://www.fit.vutbr.cz/study/courses" 
   xmlns:xsd="http://www.w3.org/2001/XMLSchema">
  <xsd:element name="courses" type="CoursesType">
    <xsd:unique name="course_id">
      <xsd:selector xpath="course"/>
      <xsd:field xpath="@id"/>
    </xsd:unique>
  </xsd:element>
  <xsd:complexType name="CoursesType">
    <xsd:sequence>
      <xsd:element name="course" type="CourseType" minOccurs="0" maxOccurs="999"/>
    </xsd:sequence>
  </xsd:complexType>
  <xsd:complexType name="CourseType">
    <xsd:attribute name="abbrv" type="xsd:string"/>
    <xsd:attribute name="credits" type="xsd:nonNegativeInteger"/>
    <xsd:attribute name="upd_ts" type="xsd:dateTime"/>
    <xsd:attribute name="id" type="xsd:nonNegativeInteger"/>
    <xsd:attribute name="csid" type="xsd:nonNegativeInteger"/>
  </xsd:complexType>

</xsd:schema>

***
<courses >
<course csid="550780" abbrv="IIS" credits="4" upd_ts="2015-01-19T11:24:36">
</course>
</courses>
***
[[" TAG: course ATRIBB: {'upd_ts': '2015-01-19T11:24:36', 'csid': '550780', 'abbrv': 'IIS', 'credits': '4'} TEXT: None"]]




