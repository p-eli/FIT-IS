SCHOLL ***
<?xml version="1.0" encoding="iso-8859-2"?>
<xsd:schema xmlns:xsd="http://www.w3.org/2001/XMLSchema">
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
    <xsd:sequence>
      <xsd:element name="title" type="xsd:string"/>
      <xsd:element name="accreditation" minOccurs="0" maxOccurs="1" type="CourseAccrType"/>
      <xsd:element name="examination" minOccurs="0" maxOccurs="1" type="CourseExamType"/>
    </xsd:sequence>
    <xsd:attribute name="abbrv" type="xsd:string"/>
    <xsd:attribute name="credits" type="xsd:nonNegativeInteger"/>
    <xsd:attribute name="type" type="CourseEntryType"/>
    <xsd:attribute name="completion" type="CourseCompletionType"/>
    <xsd:attribute name="points" type="CoursePointsType"/>
    <xsd:attribute name="upd_ts" type="xsd:dateTime"/>
    <xsd:attribute name="id" type="xsd:nonNegativeInteger"/>
  </xsd:complexType>
  <xsd:complexType name="CourseAccrType">
    <xsd:sequence>
      <xsd:element name="teacher" type="xsd:string"/>
    </xsd:sequence>
    <xsd:attribute name="status" type="CourseAccrStatusType"/>
    <xsd:attribute name="date" type="xsd:date"/>
  </xsd:complexType>
  <xsd:complexType name="CourseExamType">
    <xsd:sequence>
      <xsd:element name="teacher" type="xsd:string"/>
    </xsd:sequence>
    <xsd:attribute name="count" type="xsd:nonNegativeInteger"/>
    <xsd:attribute name="date" type="xsd:date"/>
    <xsd:attribute name="grade" type="CourseGradeType"/>
  </xsd:complexType>
  <xsd:simpleType name="CourseEntryType">
    <xsd:restriction base="xsd:string">
      <xsd:enumeration value="P">
        <xsd:annotation>
          <xsd:documentation xml:lang="cs">Povinný předmět</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="PV">
        <xsd:annotation>
          <xsd:documentation xml:lang="cs">Povinně volitelný předmět</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="V">
        <xsd:annotation>
          <xsd:documentation xml:lang="cs">Volitelný předmět</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="D">
        <xsd:annotation>
          <xsd:documentation xml:lang="cs">Doporučený předmět</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
    </xsd:restriction>
  </xsd:simpleType>
  <xsd:simpleType name="CourseCompletionType">
    <xsd:restriction base="xsd:string">
      <xsd:enumeration value="Za">
        <xsd:annotation>
          <xsd:documentation xml:lang="cs">Zápočet</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="Zk">
        <xsd:annotation>
          <xsd:documentation xml:lang="cs">Zkouka</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="ZaZk">
        <xsd:annotation>
          <xsd:documentation xml:lang="cs">Zápočet+zkouka</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="Klz">
        <xsd:annotation>
          <xsd:documentation xml:lang="cs">Klasifikovaný zápočet</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="-">
        <xsd:annotation>
          <xsd:documentation xml:lang="cs">-</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
    </xsd:restriction>
  </xsd:simpleType>
  <xsd:simpleType name="CourseAccrStatusType">
    <xsd:restriction base="xsd:string">
      <xsd:enumeration value="ano">
        <xsd:annotation>
          <xsd:documentation xml:lang="cs">Zápočet udělen</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="ne">
        <xsd:annotation>
          <xsd:documentation xml:lang="cs">Zápočet neudělen</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="-">
        <xsd:annotation>
          <xsd:documentation xml:lang="cs">Zápočet nezadán</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
    </xsd:restriction>
  </xsd:simpleType>
  <xsd:simpleType name="CourseGradeType">
    <xsd:restriction base="xsd:string">
      <xsd:enumeration value="1A">
        <xsd:annotation>
          <xsd:documentation>1.0</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="2B">
        <xsd:annotation>
          <xsd:documentation>1.5</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="2C">
        <xsd:annotation>
          <xsd:documentation>2.0</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="3D">
        <xsd:annotation>
          <xsd:documentation>2.5</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="3E">
        <xsd:annotation>
          <xsd:documentation>3.0</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="4F">
        <xsd:annotation>
          <xsd:documentation>4.0</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
    </xsd:restriction>
  </xsd:simpleType>
  <xsd:simpleType name="CoursePointsType">
    <xsd:restriction base="xsd:integer">
      <xsd:minInclusive value="0"/>
      <xsd:maxInclusive value="100"/>
    </xsd:restriction>
  </xsd:simpleType>
</xsd:schema>
***
<?xml version="1.0" encoding="utf-8"?>
<c:courses xmlns:c="http://www.fit.vutbr.cz/study/courses"
 xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
 xsi:schemaLocation="http://www.fit.vutbr.cz/study/courses http://www.fit.vutbr.cz/schemas/courses.xsd">
<course id="9974" abbrv="IIS" type="P" completion="ZaZk" points="0" credits="4" upd_ts="2014-10-07T08:24:52">
  <title>Informační systémy</title>
  <accreditation status="ne" date="2014-12-19">
    <teacher></teacher>
  </accreditation>
</course>
</c:courses>
***
[[[' TAG: title ATRIBB: {} TEXT: Informační systémy', [' TAG: teacher ATRIBB: {} TEXT: None']]]]
