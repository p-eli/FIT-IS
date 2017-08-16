SCHOLL ***
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
    <xsd:sequence>
      <xsd:element name="title" minOccurs="0" maxOccurs="2" type="TitleType"/>
      <xsd:element name="accreditation" minOccurs="0" maxOccurs="1" type="CourseAccrType"/>
      <xsd:element name="examination" minOccurs="0" maxOccurs="1" type="CourseExamType"/>
      <xsd:element name="item" minOccurs="0" maxOccurs="999" type="ItemType"/>
    </xsd:sequence>
    <xsd:attribute name="abbrv" type="xsd:string"/>
    <xsd:attribute name="credits" type="xsd:nonNegativeInteger"/>
    <xsd:attribute name="type" type="CourseEntryType"/>
    <xsd:attribute name="completion" type="CourseCompletionType"/>
    <xsd:attribute name="points" type="CoursePointsType"/>
    <xsd:attribute name="upd_ts" type="xsd:dateTime"/>
    <xsd:attribute name="id" type="xsd:nonNegativeInteger"/>
    <xsd:attribute name="csid" type="xsd:nonNegativeInteger"/>
    <xsd:attribute name="sem" type="SemesterType"/>
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
          <xsd:documentation xml:lang="en">Compulsory courses</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="PV">
        <xsd:annotation>
          <xsd:documentation xml:lang="cs">Povinně volitelný předmět</xsd:documentation>
          <xsd:documentation xml:lang="en">Compulsory-Elective courses</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="V">
        <xsd:annotation>
          <xsd:documentation xml:lang="cs">Volitelný předmět</xsd:documentation>
          <xsd:documentation xml:lang="en">Elective courses</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="D">
        <xsd:annotation>
          <xsd:documentation xml:lang="cs">Doporučený předmět</xsd:documentation>
          <xsd:documentation xml:lang="en">Recommended courses</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="PVH"> 
        <xsd:annotation>
          <xsd:documentation xml:lang="cs">Povinně volitelný humanitní předmět</xsd:documentation>
          <xsd:documentation xml:lang="en">Compulsory-Elective course - group H</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="PVC"> 
        <xsd:annotation>
          <xsd:documentation xml:lang="cs">Povinně volitelný - skupina C</xsd:documentation>
          <xsd:documentation xml:lang="en">Compulsory-Elective course - group C</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="PVO"> 
        <xsd:annotation>
          <xsd:documentation xml:lang="cs">Povinně volitelný - skupina O</xsd:documentation>
          <xsd:documentation xml:lang="en">Compulsory-Elective course - group O</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="PVS"> 
        <xsd:annotation>
          <xsd:documentation xml:lang="cs">Povinně volitelný - skupina S</xsd:documentation>
          <xsd:documentation xml:lang="en">Compulsory-Elective course - group S</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="PVB"> 
        <xsd:annotation>
          <xsd:documentation xml:lang="cs">Povinně volitelný - skupina B</xsd:documentation>
          <xsd:documentation xml:lang="en">Compulsory-Elective course - group B</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="PVM"> 
        <xsd:annotation>
          <xsd:documentation xml:lang="cs">Povinně volitelný - skupina M</xsd:documentation>
          <xsd:documentation xml:lang="en">Compulsory-Elective course - group M</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="PVI"> 
        <xsd:annotation>
          <xsd:documentation xml:lang="cs">Povinně volitelný - skupina I</xsd:documentation>
          <xsd:documentation xml:lang="en">Compulsory-Elective course - group I</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="PVF"> 
        <xsd:annotation>
          <xsd:documentation xml:lang="cs">Povinně volitelný - skupina F</xsd:documentation>
          <xsd:documentation xml:lang="en">Compulsory-Elective course - group F</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="PVN"> 
        <xsd:annotation>
          <xsd:documentation xml:lang="cs">Povinně volitelný - skupina N</xsd:documentation>
          <xsd:documentation xml:lang="en">Compulsory-Elective course - group N</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="PVL"> 
        <xsd:annotation>
          <xsd:documentation xml:lang="cs">Povinně volitelný - skupina L</xsd:documentation>
          <xsd:documentation xml:lang="en">Compulsory-Elective course - group L</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="PVD"> 
        <xsd:annotation>
          <xsd:documentation xml:lang="cs">Povinně volitelný - skupina D</xsd:documentation>
          <xsd:documentation xml:lang="en">Compulsory-Elective course - group D</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="PVG"> 
        <xsd:annotation>
          <xsd:documentation xml:lang="cs">Povinně volitelný - skupina G</xsd:documentation>
          <xsd:documentation xml:lang="en">Compulsory-Elective course - group G</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="PVE"> 
        <xsd:annotation>
          <xsd:documentation xml:lang="cs">Povinně volitelný - skupina E</xsd:documentation>
          <xsd:documentation xml:lang="en">Compulsory-Elective course - group E</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
    </xsd:restriction>
  </xsd:simpleType>
  <xsd:simpleType name="CourseCompletionType">
    <xsd:restriction base="xsd:string">
      <xsd:enumeration value="Za">
        <xsd:annotation>
          <xsd:documentation xml:lang="cs">Zápočet</xsd:documentation>
          <xsd:documentation xml:lang="en">Accreditation</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="Zk">
        <xsd:annotation>
          <xsd:documentation xml:lang="cs">Zkouška</xsd:documentation>
          <xsd:documentation xml:lang="en">Examination</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="ZaZk">
        <xsd:annotation>
          <xsd:documentation xml:lang="cs">Zápočet+zkouška</xsd:documentation>
          <xsd:documentation xml:lang="en">Accreditation+exam</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="Klz">
        <xsd:annotation>
          <xsd:documentation xml:lang="cs">Klasifikovaný zápočet</xsd:documentation>
          <xsd:documentation xml:lang="en">Classified accreditation</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="-">
        <xsd:annotation>
          <xsd:documentation xml:lang="cs">-</xsd:documentation>
          <xsd:documentation xml:lang="en">-</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
    </xsd:restriction>
  </xsd:simpleType>
  <xsd:simpleType name="CourseAccrStatusType">
    <xsd:restriction base="xsd:string">
      <xsd:enumeration value="yes">
        <xsd:annotation>
          <xsd:documentation xml:lang="cs">Zápočet udělen</xsd:documentation>
          <xsd:documentation xml:lang="en">Accreditation Yes</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="no">
        <xsd:annotation>
          <xsd:documentation xml:lang="cs">Zápočet neudělen</xsd:documentation>
          <xsd:documentation xml:lang="en">Accreditation No</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="-">
        <xsd:annotation>
          <xsd:documentation xml:lang="cs">Zápočet nezadán</xsd:documentation>
          <xsd:documentation xml:lang="en">Accreditation not entered</xsd:documentation>
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
    <xsd:restriction base="xsd:double">
      <xsd:minInclusive value="0"/>
      <xsd:maxInclusive value="100"/>
    </xsd:restriction>
  </xsd:simpleType>
  <xsd:simpleType name="SemesterType">
    <xsd:restriction base="xsd:string">
      <xsd:enumeration value="Z">
        <xsd:annotation>
          <xsd:documentation xml:lang="cs">Zimní semester</xsd:documentation>
          <xsd:documentation xml:lang="en">Winter Term</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="L">
        <xsd:annotation>
          <xsd:documentation xml:lang="cs">Letní semester</xsd:documentation>
          <xsd:documentation xml:lang="en">Summer Term</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
    </xsd:restriction>
  </xsd:simpleType>
  <xsd:complexType name="ItemType">
    <xsd:sequence>
      <xsd:element name="title" minOccurs="0" maxOccurs="2"  type="TitleType"/>
      <xsd:element name="entry" minOccurs="0" maxOccurs="1" type="EntryType"/>
      <xsd:element name="variant" minOccurs="0" maxOccurs="999"  type="VariantType"/>
    </xsd:sequence>
    <xsd:attribute name="id" type="xsd:nonNegativeInteger"/>
    <xsd:attribute name="num" type="xsd:nonNegativeInteger"/>
    <xsd:attribute name="type" type="ItemTypeType"/>
    <xsd:attribute name="start" type="xsd:date"/>
    <xsd:attribute name="end" type="xsd:date"/>
    <xsd:attribute name="registered" type="xsd:nonNegativeInteger"/>
    <xsd:attribute name="max" type="xsd:nonNegativeInteger"/>
    <xsd:attribute name="min" type="xsd:nonNegativeInteger"/>
    <xsd:attribute name="entry" type="ItemEntryType"/>
    <xsd:attribute name="upd_ts" type="xsd:dateTime"/>
    <xsd:attribute name="reg_start" type="xsd:dateTime"/>
    <xsd:attribute name="reg_end" type="xsd:dateTime"/>
    <xsd:attribute name="bonus" type="xsd:nonNegativeInteger"/>
    <xsd:attribute name="limit" type="xsd:nonNegativeInteger"/>
  </xsd:complexType>
  <xsd:complexType name="VariantType">
    <xsd:sequence>
      <xsd:element name="title" minOccurs="0" maxOccurs="2" type="TitleType"/>
      <xsd:element name="entry" minOccurs="0" maxOccurs="1" type="EntryType"/>
    </xsd:sequence>
    <xsd:attribute name="id" type="xsd:nonNegativeInteger"/>
    <xsd:attribute name="registered" type="xsd:nonNegativeInteger"/>
    <xsd:attribute name="upd_ts" type="xsd:dateTime"/>
    <xsd:attribute name="limit" type="xsd:nonNegativeInteger"/>
    <xsd:attribute name="date" type="xsd:date"/>
    <xsd:attribute name="entry" type="ItemEntryType"/>
  </xsd:complexType>
  <xsd:complexType name="EntryType">
    <xsd:attribute name="reg_type" type="EntryRegType"/>
    <xsd:attribute name="reg_time" type="xsd:dateTime"/>
    <xsd:attribute name="upd_ts" type="xsd:dateTime"/>
    <xsd:attribute name="points" type="CoursePointsType"/>
    <xsd:attribute name="who" type="xsd:string"/>
    <xsd:attribute name="date" type="xsd:date"/>
  </xsd:complexType>
  <xsd:simpleType name="ItemTypeType"> 
    <xsd:restriction base="xsd:string">
      <xsd:enumeration value="single">
        <xsd:annotation>
          <xsd:documentation xml:lang="cs">Výběr z jedné varianty</xsd:documentation>
          <xsd:documentation xml:lang="en">Single choice</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="select">
        <xsd:annotation>
          <xsd:documentation xml:lang="cs">Výběr jedné z variant</xsd:documentation>
          <xsd:documentation xml:lang="en">Select</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="accr">
        <xsd:annotation>
          <xsd:documentation xml:lang="cs">Zápočet</xsd:documentation>
          <xsd:documentation xml:lang="en">Accreditation</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="multi">
        <xsd:annotation>
          <xsd:documentation xml:lang="cs">Výběr více variant</xsd:documentation>
          <xsd:documentation xml:lang="en">Multiple choice</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
    </xsd:restriction>
  </xsd:simpleType>
  <xsd:simpleType name="EntryRegType">
    <xsd:restriction base="xsd:string">
      <xsd:enumeration value="all">
        <xsd:annotation>
          <xsd:documentation xml:lang="cs">Zapsán automaticky</xsd:documentation>
          <xsd:documentation xml:lang="en">Auto</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="stud">
        <xsd:annotation>
          <xsd:documentation xml:lang="cs">Zapsán sám</xsd:documentation>
          <xsd:documentation xml:lang="en">Stud</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="allz">
        <xsd:annotation>
          <xsd:documentation xml:lang="cs">Zapsán automaticky se zápočtem</xsd:documentation>
          <xsd:documentation xml:lang="en">Accra</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
    </xsd:restriction>
  </xsd:simpleType>
  <xsd:simpleType name="ItemEntryType">
    <xsd:restriction base="xsd:string">
      <xsd:enumeration value="listed">
        <xsd:annotation>
          <xsd:documentation xml:lang="cs">Přihlašuje učitel</xsd:documentation>
          <xsd:documentation xml:lang="en">Adm</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="all">
        <xsd:annotation>
          <xsd:documentation xml:lang="cs">Automaticky jsou všichni přihlášeni</xsd:documentation>
          <xsd:documentation xml:lang="en">All</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="allz">
        <xsd:annotation>
          <xsd:documentation xml:lang="cs">Automaticky jsou všichni se zápočtem přihlášeni</xsd:documentation>
          <xsd:documentation xml:lang="en">Accra</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="login">
        <xsd:annotation>
          <xsd:documentation xml:lang="cs">Přihlašuje se student</xsd:documentation>
          <xsd:documentation xml:lang="en">Stud</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="loginz">
        <xsd:annotation>
          <xsd:documentation xml:lang="cs">Přihlašuje se student se zápočtem</xsd:documentation>
          <xsd:documentation xml:lang="en">Stud accr</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
    </xsd:restriction>
  </xsd:simpleType>
  <xsd:complexType name="TitleType">
    <xsd:simpleContent>
          <xsd:extension base="xsd:string">
              <xsd:attribute name="lang" type="xsd:string"/>
          </xsd:extension>
        </xsd:simpleContent>
  </xsd:complexType>
</xsd:schema>
***
<c:courses xmlns:c="http://www.fit.vutbr.cz/study/courses" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.fit.vutbr.cz/study/courses http://www.fit.vutbr.cz/schemas/courses.xsd">
<course id="9974" csid="550780" abbrv="IIS" type="P" completion="ZaZk" points="77" credits="4" sem="Z" upd_ts="2015-01-19T11:24:36">
<title lang="cs">Informační systémy</title>
<title lang="en">Information Systems</title>
<accreditation status="yes" date="2014-12-19">
<teacher>Bárta Jakub, Ing.</teacher>
</accreditation>
<examination grade="2C" date="2015-01-05">
<teacher>Burget Radek, Ing., Ph.D.</teacher>
</examination>
<item id="49579" num="5" type="single" start="2014-09-30" end="2014-12-08" registered="392" max="30" entry="all" upd_ts="2014-10-04T04:03:20">
<title lang="cs">Projekt</title>
<entry reg_type="all" reg_time="2014-09-30T10:01:30" points="30" who="ibarta" date="2014-12-25" upd_ts="2014-12-25T15:55:35"/>
</item>
<item id="49715" num="50" type="select" start="2014-10-21" end="2014-10-21" reg_start="2014-10-07T09:27:52" reg_end="2014-10-20T23:59:59" max="19" entry="login" upd_ts="2014-10-07T08:27:52">
<title lang="cs">Půlsemestrální test</title>
<variant id="49716" registered="191" limit="200" upd_ts="2014-10-07T08:30:55">
<title lang="cs">Půlsemestrální test 1. 9:00-9:50</title>
</variant>
<variant id="49717" registered="200" limit="200" upd_ts="2014-10-07T08:30:21">
<title lang="cs">Půlsemestrální test 2. 10:00-10:50</title>
<entry reg_type="stud" reg_time="2014-10-07T09:28:37" points="11" who="burgetr" date="2014-11-07" upd_ts="2014-11-07T10:41:15"/>
</variant>
</item>
<item id="49907" num="60" type="single" start="2014-09-22" registered="392" max="19" bonus="1" entry="all" upd_ts="2014-11-03T11:12:03">
<title lang="cs">Aktivita během semestru</title>
<entry reg_type="all" reg_time="2014-11-03T11:08:12" upd_ts="2014-11-03T11:08:12"/>
</item>
<item id="49713" num="70" type="accr" start="2014-12-19" registered="392" min="25" entry="all" upd_ts="2014-11-03T11:03:18">
<title lang="cs">Zápočet</title>
</item>
<item id="49714" num="100" type="multi" min="20" max="51" upd_ts="2014-10-07T08:26:18">
<title lang="cs">Semestrální zkouška</title>
<variant id="50955" date="2014-12-09" entry="listed" registered="2" upd_ts="2014-12-09T13:42:05">
<title lang="cs">předetermín pro odjíždějící</title>
</variant>
<variant id="50992" date="2015-01-05" entry="allz" registered="336" upd_ts="2015-01-19T04:03:31">
<title lang="cs">řádný</title>
<entry reg_type="allz" reg_time="2014-12-26T04:03:29" points="36" who="burgetr" date="2015-01-19" upd_ts="2015-01-19T11:24:36"/>
</variant>
<variant id="50993" date="2015-01-23" entry="allz" registered="336" upd_ts="2015-01-19T04:03:30">
<title lang="cs">1. opravný</title>
<entry reg_type="allz" reg_time="2014-12-26T04:03:29" upd_ts="2014-12-26T04:03:29"/>
</variant>
<variant id="50994" date="2015-01-29" entry="allz" registered="336" upd_ts="2015-01-19T04:03:31">
<title lang="cs">2. opravný</title>
<entry reg_type="allz" reg_time="2014-12-26T04:03:29" upd_ts="2014-12-26T04:03:29"/>
</variant>
</item>
</course>
<course id="9982" csid="550781" abbrv="IMP" type="P" completion="ZaZk" points="63" credits="6" sem="Z" upd_ts="2015-01-15T11:10:40">
<title lang="cs">Mikroprocesorové a vestavěné systémy</title>
<title lang="en">Microprocessors and Embedded Systems</title>
<accreditation status="yes" date="2015-01-08">
<teacher>Bidlo Michal, Ing., Ph.D.</teacher>
</accreditation>
<examination grade="3D" date="2015-01-12">
<teacher>Schwarz Josef, doc. Ing., CSc.</teacher>
</examination>
<item id="50312" num="0" type="select" start="2015-01-05" end="2015-01-07" reg_start="2014-12-15T21:00:00" reg_end="2015-01-04T23:59:59" entry="login" upd_ts="2014-12-04T17:12:08">
<title lang="cs">Prezentace projektů u M. Bidla</title>
<variant id="50313" registered="12" limit="20" upd_ts="2014-12-04T17:49:11">
<title lang="cs">1 - pondělí 5.1.2015 od 14:00 v L314</title>
</variant>
<variant id="50314" registered="18" limit="20" upd_ts="2014-12-04T17:49:11">
<title lang="cs">2 - pondělí 5.1.2015 od 15:00 v L314</title>
</variant>
<variant id="50315" registered="8" limit="20" upd_ts="2014-12-04T17:49:11">
<title lang="cs">3 - pondělí 5.1.2015 od 16:00 v L314</title>
</variant>
<variant id="50316" registered="10" limit="20" upd_ts="2014-12-04T17:49:11">
<title lang="cs">4 - úterý 6.1.2015 od 14:00 v L314</title>
</variant>
<variant id="50317" registered="7" limit="20" upd_ts="2014-12-04T17:49:11">
<title lang="cs">5 - úterý 6.1.2015 od 15:00 v L314</title>
</variant>
<variant id="50319" registered="14" limit="20" upd_ts="2014-12-04T17:49:11">
<title lang="cs">6 - středa 7.1.2015 od 14:00 v L314</title>
</variant>
<variant id="50320" registered="10" limit="20" upd_ts="2014-12-04T17:49:11">
<title lang="cs">7 - středa 7.1.2015 od 15:00 v L314</title>
</variant>
</item>
<item id="51085" num="0" type="select" start="2015-01-05" end="2015-01-07" reg_start="2015-01-02T22:00:00" reg_end="2015-01-06T12:00:00" entry="login" upd_ts="2015-01-02T20:29:57">
<title lang="cs">Obhajoby projektů - Z. Vašíček</title>
<variant id="51086" registered="9" limit="10" upd_ts="2015-01-02T20:25:13">
<title lang="cs">Po 5.1.2015, 12:00-13:00</title>
</variant>
<variant id="51087" registered="4" limit="10" upd_ts="2015-01-02T20:26:10">
<title lang="cs">Po 5.1.2015, 13:00-14:00</title>
</variant>
<variant id="51088" registered="3" limit="10" upd_ts="2015-01-02T20:27:04">
<title lang="cs">Po 5.1.2015, 14:00-15:00</title>
</variant>
<variant id="51089" registered="5" limit="10" upd_ts="2015-01-02T20:27:48">
<title lang="cs">Út 6.1.2015, 11:00-12:00</title>
</variant>
<variant id="51090" registered="7" limit="10" upd_ts="2015-01-02T20:28:01">
<title lang="cs">Út 6.1.2015, 12:00-13:00</title>
</variant>
</item>
<item id="48510" num="1" type="select" start="2014-10-20" end="2014-12-18" reg_start="2014-09-29T20:15:00" reg_end="2014-10-17T20:00:00" entry="login" upd_ts="2014-09-29T13:36:58">
<title lang="cs">Termíny PC laboratoří</title>
<variant id="48511" registered="20" limit="20" upd_ts="2014-09-18T14:44:29">
<title lang="cs">L306, sudé Po 09:00-10:50, vede Strnadel J.</title>
</variant>
<variant id="48512" registered="20" limit="20" upd_ts="2014-09-18T14:43:31">
<title lang="cs">L306, liché Út 11:00-12:50, vede Růžička R.</title>
</variant>
<variant id="48514" registered="20" limit="20" upd_ts="2014-09-22T13:37:15">
<title lang="cs">L306, lichá St 11:00-12:50, vede Šimek V.</title>
</variant>
<variant id="48515" registered="20" limit="20" upd_ts="2014-09-25T15:14:05">
<title lang="cs">L306, liché Po 09:00-10:50, vede Strnadel J.</title>
</variant>
<variant id="48516" registered="20" limit="20" upd_ts="2014-09-18T14:44:44">
<title lang="cs">L306, sudé Út 11:00-12:50, vede Růžička R.</title>
</variant>
<variant id="48517" registered="17" limit="20" upd_ts="2014-09-28T19:21:22">
<title lang="cs">L306, lichý Po 13:00-14:50, vede Bidlo M.</title>
</variant>
<variant id="48518" registered="20" limit="20" upd_ts="2014-09-18T14:44:11">
<title lang="cs">L306, sudá St 13:00-14:50, vede Šimek V.</title>
</variant>
<variant id="48519" registered="20" limit="20" upd_ts="2014-09-18T14:44:37">
<title lang="cs">L306, sudé Po 11:00-12:50, vede Strnadel J.</title>
</variant>
<variant id="48520" registered="20" limit="20" upd_ts="2014-09-18T14:43:39">
<title lang="cs">L306, liché Út 13:00-14:50, vede Růžička R.</title>
</variant>
<variant id="48521" registered="20" limit="20" upd_ts="2014-09-18T14:44:05">
<title lang="cs">L306, sudá St 11:00-12:50, vede Šimek V.</title>
</variant>
<variant id="48522" registered="21" limit="21" upd_ts="2014-09-22T13:27:04">
<title lang="cs">L306, lichá St 13:00-14:50, vede Šimek V.</title>
</variant>
<variant id="48523" registered="20" limit="20" upd_ts="2014-09-28T19:22:23">
<title lang="cs">L306, liché Po 11:00-12:50, vede Strnadel J.</title>
</variant>
<variant id="48525" registered="20" limit="20" upd_ts="2014-09-28T12:52:01">
<title lang="cs">L306, lichý Po 15:00-16:50, vede Bidlo M.</title>
</variant>
<variant id="48526" registered="20" limit="20" upd_ts="2014-09-29T13:41:03">
<title lang="cs">L306, lichá St 15:00-16:50, vede Šimek V.</title>
</variant>
<variant id="48527" registered="21" limit="21" upd_ts="2014-10-14T12:41:39">
<title lang="cs">L306, sudé Út 13:00-14:50, vede Růžička R.</title>
<entry reg_type="stud" reg_time="2014-09-29T20:15:03" upd_ts="2014-09-29T20:15:03"/>
</variant>
<variant id="48536" registered="20" limit="20" upd_ts="2014-09-18T14:44:20">
<title lang="cs">L306, sudá St 15:00-16:50, vede Šimek V.</title>
</variant>
<variant id="48605" registered="20" limit="20" upd_ts="2014-09-22T13:37:35">
<title lang="cs">L306, lichý Po 17:00-18:50, vede Bidlo M.</title>
</variant>
<variant id="48606" registered="20" limit="20" upd_ts="2014-09-18T14:45:26">
<title lang="cs">L306, sudý Po 13:00-14:50, vede Bidlo M.</title>
</variant>
<variant id="48607" registered="20" limit="20" upd_ts="2014-09-18T14:45:33">
<title lang="cs">L306, sudý Po 15:00-16:50, vede Bidlo M.</title>
</variant>
</item>
<item id="48528" num="2" type="single" start="2014-11-13" end="2014-11-13" registered="389" max="19" entry="all" upd_ts="2014-10-04T04:03:11">
<title lang="cs">Půlsemestrální test</title>
<entry reg_type="all" reg_time="2014-08-25T13:33:40" points="17.3" who="schwarz" date="2014-11-17" upd_ts="2014-11-17T20:01:49"/>
</item>
<item id="48529" num="3" type="accr" start="2015-01-08" registered="389" min="5" entry="all" upd_ts="2014-12-09T10:35:20">
<title lang="cs">Zápočet</title>
</item>
<item id="48537" num="4" type="select" start="2014-10-13" end="2014-12-18" reg_start="2014-10-06T20:00:00" reg_end="2014-10-12T20:00:00" min="5" max="14" entry="login" upd_ts="2015-01-06T13:29:08">
<title lang="cs">Projekt</title>
<variant id="48538" registered="30" limit="30" upd_ts="2014-10-09T09:27:44">
<title lang="cs">
Simulace v CW: Řízení výtahu ve vícepodlažní budově, S
</title>
</variant>
<variant id="48539" registered="30" limit="30" upd_ts="2014-10-09T09:27:36">
<title lang="cs">Simulace v CW: Konfigurovatelný čítač, S</title>
</variant>
<variant id="48541" registered="20" limit="20" upd_ts="2014-09-12T09:57:59">
<title lang="cs">
MSP430: Řízení provozu na světelné křižovatce (lze využít port uC/OS-II či FreeRTOS), S
</title>
</variant>
<variant id="48542" registered="20" limit="20" upd_ts="2014-09-12T09:58:37">
<title lang="cs">
MSP430: Algoritmus pro řízení robota na výrobní lince (lze využít port uC/OS-II či FreeRTOS), S
</title>
</variant>
<variant id="48544" registered="4" limit="4" upd_ts="2014-09-12T09:09:55">
<title lang="cs">
ARM Cortex-M4: Architektura instrukčního souboru (skupinové zadání pro max. 2-členné týmy), S
</title>
</variant>
<variant id="48545" registered="4" limit="4" upd_ts="2014-09-12T09:10:07">
<title lang="cs">
ARM Cortex-M4: Základní dokumentace k architektuře a tvorbě firmware (skupinové zadání pro max. 2-členné týmy), S
</title>
</variant>
<variant id="48546" registered="30" limit="30" upd_ts="2014-09-19T16:19:58">
<title lang="cs">MSP430: Jednoduchý cyklocomputer, B</title>
</variant>
<variant id="48548" registered="30" limit="30" upd_ts="2014-09-19T15:59:34">
<title lang="cs">MSP430: Digitální hodiny s budíkem přes VGA, B</title>
</variant>
<variant id="48549" registered="6" limit="10" upd_ts="2014-09-19T13:36:22">
<title lang="cs">MSP430: Řízení modelů pomocí FITkitu, B</title>
</variant>
<variant id="48550" registered="30" limit="30" upd_ts="2014-09-19T16:19:04">
<title lang="cs">MSP430: Hra HAD na maticovém displeji, B</title>
</variant>
<variant id="48551" registered="20" limit="20" upd_ts="2014-09-25T17:29:46">
<title lang="cs">
MSP430: Voltmetr s vizualizací průběhu napětí pomocí VGA, V
</title>
</variant>
<variant id="48552" registered="10" limit="10" upd_ts="2014-10-08T12:06:39">
<title lang="cs">
MSP430: Světelné noviny pomocí maticového displeje, V
</title>
</variant>
<variant id="48553" registered="30" limit="30" upd_ts="2014-09-19T13:56:39">
<title lang="cs">MSP430: Otáčkoměr s výstupem na VGA, B</title>
<entry reg_type="stud" reg_time="2014-10-06T20:00:50" points="14" who="bidlom" date="2015-01-08" upd_ts="2015-01-08T12:32:32"/>
</variant>
<variant id="48554" registered="10" limit="10" upd_ts="2014-10-06T12:18:22">
<title lang="cs">
IMP-lab: GUI pro prohlížení a správu obsahu SD karty, Š
</title>
</variant>
<variant id="48555" registered="10" limit="10" upd_ts="2014-10-06T12:18:05">
<title lang="cs">
IMP-lab: Komunikace mikrokontrolérů MC9S08JM60 přes IIC, Š
</title>
</variant>
<variant id="48556" registered="11" limit="11" upd_ts="2014-10-10T07:43:22">
<title lang="cs">
IMP-lab: Záznamník a přehrávač melodií s vnitřní pamětí pro skladby a vizualizací, Š
</title>
</variant>
<variant id="48557" registered="40" limit="40" upd_ts="2014-10-09T09:27:49">
<title lang="cs">Simulace v CW: Světelné noviny, Š</title>
</variant>
<variant id="49270" registered="1" limit="10" upd_ts="2014-10-30T14:20:59">
<title lang="cs">
IMP-lab: Identifikace zařízení na základě unikátnosti jejich vlastností (experimentálně-výzkumné téma), S
</title>
</variant>
<variant id="49287" registered="30" limit="30" upd_ts="2014-09-25T17:30:06">
<title lang="cs">MSP430: Dekodér Morseovy abecedy, V</title>
</variant>
<variant id="49288" registered="4" limit="4" upd_ts="2014-10-06T10:48:04">
<title lang="cs">
ARM Cortex-M4: Zprovoznění a využití systému FreeRTOS, V
</title>
</variant>
<variant id="49311" registered="6" limit="6" upd_ts="2014-10-23T10:24:39">
<title lang="cs">
Vestavný vícekanálový osciloskop pomalých dějů s interakcí přes PC (skupinové zadání pro max. 2-členné týmy), S
</title>
</variant>
<variant id="49637" registered="1" limit="1" upd_ts="2014-10-07T15:42:19">
<title lang="cs">
Vlastní téma: řídicí jednotka pro solární ohřev vody, B
</title>
</variant>
<variant id="49722" registered="1" limit="1" upd_ts="2014-10-07T15:42:02">
<title lang="cs">
Vlastní téma: binární puzzle na maticovém displeji, B
</title>
</variant>
<variant id="49725" registered="1" limit="1" upd_ts="2014-10-07T15:42:11">
<title lang="cs">Vlastní téma: hodiny s budíkem na FITkitu 2.0, B</title>
</variant>
<variant id="49726" registered="1" limit="1" upd_ts="2014-10-07T15:41:51">
<title lang="cs">
Vlastní téma: barevné efekty na maticovém displeji pomocí PWM, B
</title>
</variant>
<variant id="49727" registered="1" limit="1" upd_ts="2014-10-07T21:07:43">
<title lang="cs">
Vlastní téma: otáčkoměr realizovaný na desce DEMOJM JM60, B
</title>
</variant>
<variant id="49728" registered="1" limit="1" upd_ts="2014-10-07T21:18:27">
<title lang="cs">
Vlastní téma: otáčkoměr na FITkitu s maticovým displejem, B
</title>
</variant>
<variant id="49730" registered="1" limit="1" upd_ts="2014-10-08T13:34:52">
<title lang="cs">
Vlastní téma: Tetris na maticovém displeji s FITkitem, B
</title>
</variant>
<variant id="49731" registered="1" limit="1" upd_ts="2014-10-08T15:22:07">
<title lang="cs">Vlastní téma: teploměr na platformě Arduino, B</title>
</variant>
<variant id="49737" registered="1" limit="1" upd_ts="2014-10-10T12:42:45">
<title lang="cs">Vlastní téma: budík na desce DEMOJM JM60, B</title>
</variant>
<variant id="49738" registered="1" limit="1" upd_ts="2014-10-10T12:49:48">
<title lang="cs">Vlastní téma: stopky na desce DEMOJM JM60, B</title>
</variant>
<variant id="49739" registered="1" limit="1" upd_ts="2014-10-10T12:56:35">
<title lang="cs">Vlastní téma: cyklopočítač na desce DEMOJM JM60, B</title>
</variant>
<variant id="49889" registered="1" limit="1" upd_ts="2014-10-30T14:27:57">
<title lang="cs">Vlastní téma: USB klíč na bázi MC9S08JM60</title>
</variant>
</item>
<item id="48560" num="5" type="single" start="2014-10-03" end="2014-10-03" registered="154" limit="154" entry="login" reg_start="2014-09-26T20:00:00" reg_end="2014-10-01T20:00:00" upd_ts="2014-09-02T13:19:42">
<title lang="cs">
Dem. cv. č.1 ve 2. výukovém týdnu (základy práce v CodeWarrior)
</title>
<entry reg_type="stud" reg_time="2014-09-26T20:00:00" upd_ts="2014-09-26T20:00:00"/>
</item>
<item id="48561" num="6" type="single" start="2014-10-10" end="2014-10-10" registered="154" limit="154" entry="login" reg_start="2014-09-26T20:00:00" reg_end="2014-10-08T20:00:00" upd_ts="2014-09-02T13:28:32">
<title lang="cs">
Dem. cv. č.1 ve 3. výukovém týdnu (základy práce v CodeWarrior)
</title>
</item>
<item id="48562" num="7" type="single" start="2014-10-17" end="2014-10-17" registered="154" limit="154" entry="login" reg_start="2014-09-29T20:00:00" reg_end="2014-10-15T20:00:00" upd_ts="2014-09-25T16:10:10">
<title lang="cs">
Dem. cv. č.2 ve 4. výukovém týdnu (pokročilá práce v CodeWarrior)
</title>
<entry reg_type="stud" reg_time="2014-09-29T20:00:00" upd_ts="2014-09-29T20:00:00"/>
</item>
<item id="48563" num="8" type="single" start="2014-10-24" end="2014-10-24" registered="154" limit="154" entry="login" reg_start="2014-09-29T20:00:00" reg_end="2014-10-22T20:00:00" upd_ts="2014-09-25T16:10:28">
<title lang="cs">
Dem. cv. č.2 ve 5. výukovém týdnu (pokročilá práce v CodeWarrior)
</title>
</item>
<item id="49282" num="9" type="single" start="2014-10-30" end="2014-10-30" registered="154" limit="154" entry="login" reg_start="2014-09-29T20:00:00" reg_end="2014-10-29T20:00:00" upd_ts="2014-09-25T16:10:47">
<title lang="cs">
Dem. cv. č.3 v 6. výukovém týdnu (Programování FITKITu I)
</title>
<entry reg_type="stud" reg_time="2014-09-29T20:00:03" upd_ts="2014-09-29T20:00:03"/>
</item>
<item id="49283" num="10" type="single" start="2014-11-06" end="2014-11-06" registered="154" limit="154" entry="login" reg_start="2014-09-29T20:00:00" reg_end="2014-11-05T20:00:00" upd_ts="2014-09-28T13:22:53">
<title lang="cs">
Dem. cv. č.4 v 7. výukovém týdnu (Programování FITKITu II)
</title>
<entry reg_type="stud" reg_time="2014-09-29T20:00:05" upd_ts="2014-09-29T20:00:05"/>
</item>
<item id="49284" num="11" type="single" start="2014-11-20" end="2014-11-20" registered="154" limit="154" entry="login" reg_start="2014-09-29T20:00:00" reg_end="2014-11-19T20:00:00" upd_ts="2014-09-25T16:12:30">
<title lang="cs">
Dem. cv. č.5 ve 9. výukovém týdnu (ladicí prostředky, ICE, BDM)
</title>
<entry reg_type="stud" reg_time="2014-09-29T20:00:06" upd_ts="2014-09-29T20:00:06"/>
</item>
<item id="49285" num="12" type="single" start="2014-11-27" end="2014-11-27" registered="153" limit="154" entry="login" reg_start="2014-09-29T20:00:00" reg_end="2014-11-26T20:00:00" upd_ts="2014-09-25T16:11:08">
<title lang="cs">
Dem. cv. č.6 ve 10. výukovém týdnu (vývojové prostředky)
</title>
<entry reg_type="stud" reg_time="2014-09-29T20:00:07" upd_ts="2014-09-29T20:00:07"/>
</item>
<item id="49280" num="14" type="select" start="2014-09-26" end="2014-10-03" max="16" bonus="1" entry="listed" upd_ts="2014-09-25T15:54:59">
<title lang="cs">Uznané body z předchozího roku-laboratoře</title>
<variant id="49281" registered="11" limit="12" upd_ts="2014-09-25T14:58:07">
<title lang="cs">laboratoře z loňska</title>
</variant>
</item>
<item id="49286" num="16" type="single" start="2014-10-20" end="2014-11-16" registered="389" max="4" entry="all" upd_ts="2014-11-03T10:29:39">
<title lang="cs">Bodové hodnocení laboratoře č. 1</title>
<entry reg_type="all" reg_time="2014-09-25T16:04:22" points="4" who="ruzicka" date="2014-11-18" upd_ts="2014-11-18T10:29:37"/>
</item>
<item id="49773" num="17" type="single" start="2014-11-03" end="2014-11-16" registered="389" max="4" entry="all" upd_ts="2014-10-21T08:49:12">
<title lang="cs">Bodové hodnocení laboratoře č. 2</title>
<entry reg_type="all" reg_time="2014-10-21T08:49:12" points="4" who="ruzicka" date="2014-11-18" upd_ts="2014-11-18T10:56:20"/>
</item>
<item id="49774" num="18" type="single" start="2014-11-17" end="2014-12-07" registered="389" max="4" entry="all" upd_ts="2014-12-01T09:45:42">
<title lang="cs">Bodové hodnocení laboratoře č. 3</title>
<entry reg_type="all" reg_time="2014-10-21T08:49:45" points="4" who="ruzicka" date="2014-12-09" upd_ts="2014-12-09T11:41:53"/>
</item>
<item id="49775" num="19" type="single" start="2014-12-01" end="2014-12-21" registered="389" max="4" entry="all" upd_ts="2014-12-08T08:40:56">
<title lang="cs">Bodové hodnocení laboratoře č. 4</title>
<entry reg_type="all" reg_time="2014-10-21T08:50:10" points="4" who="ruzicka" date="2014-12-18" upd_ts="2014-12-18T10:43:08"/>
</item>
<item id="50949" num="20" type="multi" max="51" upd_ts="2014-12-09T10:38:20">
<title lang="cs">Finální zkouška</title>
<variant id="50950" date="2015-01-12" entry="all" registered="387" upd_ts="2015-01-07T11:18:20">
<title lang="cs">Řádná zkouška</title>
<entry reg_type="all" reg_time="2014-12-09T10:43:06" points="15.2" who="schwarz" date="2015-01-15" upd_ts="2015-01-15T11:10:40"/>
</variant>
<variant id="51043" date="2014-12-18" entry="listed" registered="2" upd_ts="2014-12-20T17:44:47">
<title lang="cs">předtermín Erasmus</title>
</variant>
<variant id="51259" date="2015-01-21" entry="allz" registered="96" upd_ts="2015-01-15T13:13:31">
<title lang="cs">1.opravná zkouška</title>
</variant>
</item>
<item id="49748" num="50" type="single" start="2014-10-13" end="2014-12-19" registered="389" bonus="1" entry="all" upd_ts="2014-10-13T09:47:15">
<title lang="cs">Licence k projektům založeným na simulátoru v CW</title>
<entry reg_type="all" reg_time="2014-10-13T09:06:42" upd_ts="2014-10-13T09:06:42"/>
</item>
</course>
<course id="9983" csid="550782" abbrv="IMS" type="P" completion="ZaZk" points="27" credits="5" sem="Z" upd_ts="2015-01-02T13:56:00">
<title lang="cs">Modelování a simulace</title>
<title lang="en">Modelling and Simulation</title>
<accreditation status="yes" date="2015-01-15">
<teacher>Hrubý Martin, Ing., Ph.D.</teacher>
</accreditation>
<item id="49534" num="0" type="single" start="2014-09-29" end="2014-10-31" registered="21" entry="login" reg_start="2014-09-29T11:33:56" reg_end="2014-10-30T00:00:00" upd_ts="2014-09-29T10:34:36">
<title lang="cs">Uznání projektů z akad. roku 2013/14</title>
</item>
<item id="49779" num="1" type="single" start="2014-11-18" registered="436" max="10" entry="all" upd_ts="2014-10-21T16:31:57">
<title lang="cs">Půlesemestrální písemka</title>
<entry reg_type="all" reg_time="2014-10-21T16:31:42" points="7" who="hrubym" date="2014-12-03" upd_ts="2014-12-03T17:47:39"/>
</item>
<item id="49724" num="2" type="single" start="2014-10-07" end="2014-12-08" registered="436" max="20" entry="all" upd_ts="2014-11-30T20:16:42">
<title lang="cs">Projekt</title>
<entry reg_type="all" reg_time="2014-10-07T14:16:22" points="20" who="hrubym" date="2015-01-02" upd_ts="2015-01-02T13:56:00"/>
</item>
<item id="50996" num="3" type="accr" start="2015-01-15" registered="436" min="10" entry="all" upd_ts="2014-12-15T19:21:40">
<title lang="cs">Zápočet</title>
</item>
<item id="49776" num="4" type="multi" min="30" max="70" upd_ts="2014-10-21T13:42:49">
<title lang="cs">Zkouška</title>
<variant id="50042" date="2015-01-14" entry="all" registered="436" upd_ts="2014-11-21T15:57:15">
<title lang="cs">řádný (T1)</title>
<entry reg_type="all" reg_time="2014-11-21T15:49:34" upd_ts="2014-11-21T15:49:34"/>
</variant>
<variant id="50043" date="2015-01-27" entry="loginz" registered="44" upd_ts="2014-11-21T15:51:46">
<title lang="cs">opravný (T2)</title>
</variant>
<variant id="50044" date="2015-02-04" entry="loginz" upd_ts="2014-11-21T15:53:44">
<title lang="cs">poslední opravný (T3)</title>
</variant>
</item>
</course>
<course id="10004" csid="550783" abbrv="IPZ" type="P" completion="Zk" points="72" credits="4" sem="Z" upd_ts="2015-01-13T12:37:42">
<title lang="cs">Periferní zařízení</title>
<title lang="en">Peripheral Devices</title>
<examination grade="2C" date="2015-01-07">
<teacher>Kotásek Zdeněk, doc. Ing., CSc.</teacher>
</examination>
<item id="49446" num="1" type="select" start="2014-10-13" end="2014-11-07" reg_start="2014-09-29T20:30:00" reg_end="2014-10-05T23:59:59" max="2" entry="login" upd_ts="2014-09-29T18:20:46">
<title lang="cs">Laboratorní cvičení 1</title>
<variant id="49447" registered="10" limit="10" upd_ts="2014-09-28T21:08:48">
<title lang="cs">2014-10-13 Pondělí 09:00-10:50</title>
</variant>
<variant id="49448" registered="9" limit="10" upd_ts="2014-09-28T21:08:59">
<title lang="cs">2014-10-13 Pondělí 11:00-12:50</title>
</variant>
<variant id="49449" registered="10" limit="10" upd_ts="2014-09-28T21:09:12">
<title lang="cs">2014-10-13 Pondělí 13:00-14:50</title>
</variant>
<variant id="49450" registered="10" limit="10" upd_ts="2014-09-28T21:09:24">
<title lang="cs">2014-10-13 Pondělí 15:00-16:50</title>
</variant>
<variant id="49451" registered="9" limit="10" upd_ts="2014-09-28T21:09:34">
<title lang="cs">2014-10-13 Pondělí 17:00-18:50</title>
</variant>
<variant id="49452" registered="10" limit="10" upd_ts="2014-09-28T21:09:44">
<title lang="cs">2014-10-15 Středa 09:00-10:50</title>
</variant>
<variant id="49453" registered="10" limit="10" upd_ts="2014-09-28T21:09:53">
<title lang="cs">2014-10-15 Středa 11:00-12:50</title>
</variant>
<variant id="49454" registered="10" limit="10" upd_ts="2014-09-28T21:10:01">
<title lang="cs">2014-10-15 Středa 13:00-14:50</title>
</variant>
<variant id="49455" registered="10" limit="10" upd_ts="2014-09-28T21:10:10">
<title lang="cs">2014-10-15 Středa 15:00-16:50</title>
</variant>
<variant id="49456" registered="10" limit="10" upd_ts="2014-09-28T21:10:18">
<title lang="cs">2014-10-15 Středa 17:00-18:50</title>
</variant>
<variant id="49457" registered="10" limit="10" upd_ts="2014-09-28T21:10:53">
<title lang="cs">2014-10-20 Pondělí 09:00-10:50</title>
</variant>
<variant id="49458" registered="10" limit="10" upd_ts="2014-09-28T21:11:02">
<title lang="cs">2014-10-20 Pondělí 11:00-12:50</title>
</variant>
<variant id="49459" registered="10" limit="10" upd_ts="2014-09-28T21:11:15">
<title lang="cs">2014-10-20 Pondělí 13:00-14:50</title>
</variant>
<variant id="49460" registered="9" limit="10" upd_ts="2014-09-28T21:11:25">
<title lang="cs">2014-10-20 Pondělí 15:00-16:50</title>
</variant>
<variant id="49461" registered="9" limit="10" upd_ts="2014-09-28T21:11:34">
<title lang="cs">2014-10-20 Pondělí 17:00-18:50</title>
</variant>
<variant id="49462" registered="10" limit="10" upd_ts="2014-09-28T21:11:44">
<title lang="cs">2014-10-22 Středa 09:00-10:50</title>
</variant>
<variant id="49463" registered="9" limit="10" upd_ts="2014-09-28T21:11:54">
<title lang="cs">2014-10-22 Středa 11:00-12:50</title>
</variant>
<variant id="49464" registered="10" limit="10" upd_ts="2014-09-28T21:12:02">
<title lang="cs">2014-10-22 Středa 13:00-14:50</title>
</variant>
<variant id="49465" registered="10" limit="10" upd_ts="2014-09-28T21:12:09">
<title lang="cs">2014-10-22 Středa 15:00-16:50</title>
</variant>
<variant id="49466" registered="10" limit="10" upd_ts="2014-09-28T21:12:17">
<title lang="cs">2014-10-22 Středa 17:00-18:50</title>
</variant>
<variant id="49467" registered="10" limit="10" upd_ts="2014-09-28T21:14:25">
<title lang="cs">2014-10-27 Pondělí 09:00-10:50</title>
</variant>
<variant id="49468" registered="10" limit="10" upd_ts="2014-09-28T21:14:33">
<title lang="cs">2014-10-27 Pondělí 11:00-12:50</title>
</variant>
<variant id="49469" registered="10" limit="10" upd_ts="2014-09-28T21:14:41">
<title lang="cs">2014-10-27 Pondělí 13:00-14:50</title>
<entry reg_type="stud" reg_time="2014-09-29T20:30:24" points="2" who="ikrcma" date="2014-11-10" upd_ts="2014-11-10T14:17:18"/>
</variant>
<variant id="49470" registered="10" limit="10" upd_ts="2014-09-28T21:14:50">
<title lang="cs">2014-10-27 Pondělí 15:00-16:50</title>
</variant>
<variant id="49471" registered="10" limit="10" upd_ts="2014-09-28T21:14:57">
<title lang="cs">2014-10-27 Pondělí 17:00-18:50</title>
</variant>
<variant id="49472" registered="10" limit="10" upd_ts="2014-09-28T21:15:04">
<title lang="cs">2014-10-29 Středa 09:00-10:50</title>
</variant>
<variant id="49473" registered="10" limit="10" upd_ts="2014-09-28T21:15:14">
<title lang="cs">2014-10-29 Středa 11:00-12:50</title>
</variant>
<variant id="49474" registered="10" limit="10" upd_ts="2014-09-28T21:15:22">
<title lang="cs">2014-10-29 Středa 13:00-14:50</title>
</variant>
<variant id="49475" registered="9" limit="10" upd_ts="2014-09-28T21:15:29">
<title lang="cs">2014-10-29 Středa 15:00-16:50</title>
</variant>
<variant id="49476" registered="9" limit="10" upd_ts="2014-09-28T21:15:38">
<title lang="cs">2014-10-29 Středa 17:00-18:50</title>
</variant>
<variant id="49477" registered="9" limit="10" upd_ts="2014-09-28T21:15:49">
<title lang="cs">2014-11-03 Pondělí 09:00-10:50</title>
</variant>
<variant id="49478" registered="10" limit="10" upd_ts="2014-09-28T21:15:56">
<title lang="cs">2014-11-03 Pondělí 11:00-12:50</title>
</variant>
<variant id="49479" registered="10" limit="10" upd_ts="2014-09-28T21:16:04">
<title lang="cs">2014-11-03 Pondělí 13:00-14:50</title>
</variant>
<variant id="49480" registered="10" limit="10" upd_ts="2014-09-28T21:16:11">
<title lang="cs">2014-11-03 Pondělí 15:00-16:50</title>
</variant>
<variant id="49481" registered="10" limit="10" upd_ts="2014-09-28T21:16:19">
<title lang="cs">2014-11-05 Středa 09:00-10:50</title>
</variant>
<variant id="49482" registered="10" limit="10" upd_ts="2014-09-28T21:16:27">
<title lang="cs">2014-11-05 Středa 11:00-12:50</title>
</variant>
<variant id="49483" registered="10" limit="10" upd_ts="2014-09-28T21:16:35">
<title lang="cs">2014-11-05 Středa 13:00-14:50</title>
</variant>
</item>
<item id="49484" num="2" type="select" start="2014-11-18" end="2014-12-12" reg_start="2014-09-29T20:30:00" reg_end="2014-10-05T23:59:59" max="2" entry="login" upd_ts="2014-09-29T18:20:57">
<title lang="cs">Laboratorní cvičení 2</title>
<variant id="49485" registered="3" limit="10" upd_ts="2014-09-28T21:19:22">
<title lang="cs">2014-11-18 Úterý 09:00-10:50</title>
</variant>
<variant id="49486" registered="10" limit="10" upd_ts="2014-09-28T21:19:29">
<title lang="cs">2014-11-18 Úterý 11:00-12:50</title>
</variant>
<variant id="49487" registered="10" limit="10" upd_ts="2014-09-28T21:19:39">
<title lang="cs">2014-11-19 Středa 09:00-10:50</title>
</variant>
<variant id="49488" registered="9" limit="10" upd_ts="2014-09-28T21:19:46">
<title lang="cs">2014-11-19 Středa 11:00-12:50</title>
</variant>
<variant id="49489" registered="10" limit="10" upd_ts="2014-09-28T21:19:53">
<title lang="cs">2014-11-19 Středa 13:00-14:50</title>
</variant>
<variant id="49490" registered="10" limit="10" upd_ts="2014-09-28T21:20:01">
<title lang="cs">2014-11-19 Středa 15:00-16:50</title>
</variant>
<variant id="49491" registered="10" limit="10" upd_ts="2014-09-28T21:20:11">
<title lang="cs">2014-11-19 Středa 17:00-18:50</title>
</variant>
<variant id="49492" registered="10" limit="10" upd_ts="2014-09-28T21:20:23">
<title lang="cs">2014-11-24 Pondělí 09:00-10:50</title>
</variant>
<variant id="49493" registered="10" limit="10" upd_ts="2014-09-28T21:20:33">
<title lang="cs">2014-11-24 Pondělí 11:00-12:50</title>
</variant>
<variant id="49494" registered="10" limit="10" upd_ts="2014-09-28T21:20:40">
<title lang="cs">2014-11-24 Pondělí 13:00-14:50</title>
</variant>
<variant id="49495" registered="10" limit="10" upd_ts="2014-09-28T21:20:47">
<title lang="cs">2014-11-24 Pondělí 15:00-16:50</title>
</variant>
<variant id="49496" registered="10" limit="10" upd_ts="2014-09-28T21:20:56">
<title lang="cs">2014-11-24 Pondělí 17:00-18:50</title>
</variant>
<variant id="49497" registered="10" limit="10" upd_ts="2014-09-28T21:21:49">
<title lang="cs">2014-11-26 Středa 09:00-10:50</title>
</variant>
<variant id="49498" registered="10" limit="10" upd_ts="2014-09-28T21:21:56">
<title lang="cs">2014-11-26 Středa 11:00-12:50</title>
</variant>
<variant id="49499" registered="10" limit="10" upd_ts="2014-09-28T21:22:03">
<title lang="cs">2014-11-26 Středa 13:00-14:50</title>
</variant>
<variant id="49500" registered="10" limit="10" upd_ts="2014-09-28T21:22:10">
<title lang="cs">2014-11-26 Středa 15:00-16:50</title>
</variant>
<variant id="49501" registered="10" limit="10" upd_ts="2014-09-28T21:22:17">
<title lang="cs">2014-11-26 Středa 17:00-18:50</title>
</variant>
<variant id="49502" registered="10" limit="10" upd_ts="2014-09-28T21:22:27">
<title lang="cs">2014-12-01 Pondělí 09:00-10:50</title>
</variant>
<variant id="49503" registered="9" limit="10" upd_ts="2014-09-28T21:22:35">
<title lang="cs">2014-12-01 Pondělí 11:00-12:50</title>
</variant>
<variant id="49504" registered="10" limit="10" upd_ts="2014-09-28T21:22:41">
<title lang="cs">2014-12-01 Pondělí 13:00-14:50</title>
</variant>
<variant id="49505" registered="10" limit="10" upd_ts="2014-09-28T21:22:49">
<title lang="cs">2014-12-01 Pondělí 15:00-16:50</title>
</variant>
<variant id="49506" registered="10" limit="10" upd_ts="2014-09-28T21:22:56">
<title lang="cs">2014-12-01 Pondělí 17:00-18:50</title>
</variant>
<variant id="49507" registered="10" limit="10" upd_ts="2014-09-28T21:23:03">
<title lang="cs">2014-12-03 Středa 09:00-10:50</title>
</variant>
<variant id="49508" registered="10" limit="10" upd_ts="2014-09-28T21:23:11">
<title lang="cs">2014-12-03 Středa 11:00-12:50</title>
</variant>
<variant id="49509" registered="10" limit="10" upd_ts="2014-09-28T21:23:19">
<title lang="cs">2014-12-03 Středa 13:00-14:50</title>
</variant>
<variant id="49510" registered="10" limit="10" upd_ts="2014-09-28T21:23:27">
<title lang="cs">2014-12-03 Středa 15:00-16:50</title>
</variant>
<variant id="49511" registered="10" limit="10" upd_ts="2014-09-28T21:23:34">
<title lang="cs">2014-12-03 Středa 17:00-18:50</title>
</variant>
<variant id="49512" registered="10" limit="10" upd_ts="2014-09-28T21:23:47">
<title lang="cs">2014-12-08 Pondělí 09:00-10:50</title>
</variant>
<variant id="49513" registered="9" limit="10" upd_ts="2014-09-28T21:23:53">
<title lang="cs">2014-12-08 Pondělí 11:00-12:50</title>
</variant>
<variant id="49514" registered="10" limit="10" upd_ts="2014-09-28T21:24:01">
<title lang="cs">2014-12-08 Pondělí 13:00-14:50</title>
<entry reg_type="stud" reg_time="2014-09-29T20:30:18" points="2" who="ikrcma" date="2014-12-08" upd_ts="2014-12-08T13:59:05"/>
</variant>
<variant id="49515" registered="9" limit="10" upd_ts="2014-09-28T21:24:07">
<title lang="cs">2014-12-08 Pondělí 15:00-16:50</title>
</variant>
<variant id="49516" registered="10" limit="10" upd_ts="2014-09-28T21:24:14">
<title lang="cs">2014-12-08 Pondělí 17:00-18:50</title>
</variant>
<variant id="49517" registered="10" limit="10" upd_ts="2014-09-28T21:24:20">
<title lang="cs">2014-12-10 Středa 09:00-10:50</title>
</variant>
<variant id="49518" registered="10" limit="10" upd_ts="2014-09-28T21:24:28">
<title lang="cs">2014-12-10 Středa 11:00-12:50</title>
</variant>
<variant id="49519" registered="10" limit="10" upd_ts="2014-09-28T21:24:35">
<title lang="cs">2014-12-10 Středa 13:00-14:50</title>
</variant>
<variant id="49520" registered="10" limit="10" upd_ts="2014-09-28T21:24:42">
<title lang="cs">2014-12-10 Středa 15:00-16:50</title>
</variant>
<variant id="49521" registered="10" limit="10" upd_ts="2014-09-28T21:24:50">
<title lang="cs">2014-12-10 Středa 17:00-18:50</title>
</variant>
</item>
<item id="49898" num="3" type="single" start="2014-11-07" registered="364" max="30" entry="all" upd_ts="2014-10-31T12:05:33">
<title lang="cs">Půlsemestrální test</title>
<entry reg_type="all" reg_time="2014-10-31T12:05:33" points="17.5" who="kotasek" date="2014-11-21" upd_ts="2014-11-21T16:21:22"/>
</item>
<item id="51021" num="4" type="multi" min="25" max="66" upd_ts="2014-12-17T10:56:27">
<title lang="cs">Semestrální zkouška</title>
<variant id="51022" date="2015-01-07" entry="all" registered="364" upd_ts="2014-12-17T10:57:39">
<title lang="cs">Semestrální zkouška - řádný termín</title>
<entry reg_type="all" reg_time="2014-12-17T10:57:39" points="50" who="kotasek" date="2015-01-13" upd_ts="2015-01-13T12:37:42"/>
</variant>
<variant id="51231" date="2015-01-19" entry="all" registered="137" upd_ts="2015-01-15T22:23:29">
<title lang="cs">Semestrální zkouška - 1. opravný termín</title>
</variant>
</item>
</course>
<course id="10006" csid="550785" abbrv="ISA" type="P" completion="ZaZk" points="78" credits="5" sem="Z" upd_ts="2015-01-12T16:52:14">
<title lang="cs">Síťové aplikace a správa sítí</title>
<title lang="en">Network Applications and Network Administration</title>
<accreditation status="yes" date="2014-12-15">
<teacher>Pluskal Jan, Ing.</teacher>
</accreditation>
<examination grade="2C" date="2015-01-09">
<teacher>Matoušek Petr, Ing., Ph.D.</teacher>
</examination>
<item id="49756" num="0" type="select" start="2014-11-12" end="2014-11-19" reg_start="2014-10-20T20:03:00" reg_end="2014-10-26T00:00:00" entry="login" upd_ts="2014-10-16T16:32:19">
<title lang="cs">
Půlsemestrální test - přihlašování pro opakující studenty
</title>
<variant id="49758" registered="18" limit="20" upd_ts="2014-10-16T16:30:54">
<title lang="cs">Středa 12.11. ve 13:00</title>
</variant>
<variant id="49759" registered="20" limit="20" upd_ts="2014-10-16T16:31:02">
<title lang="cs">Středa 19.11. ve 13:00</title>
</variant>
</item>
<item id="48665" num="1" type="select" start="2014-09-29" end="2014-12-17" reg_start="2014-09-22T20:05:00" reg_end="2014-09-26T08:00:00" max="10" entry="login" upd_ts="2014-09-09T10:49:23">
<title lang="cs">Cvičení v laboratoři</title>
<variant id="48680" registered="15" limit="20" upd_ts="2014-09-09T11:22:41">
<title lang="cs">Skupina č.02, pondělí 10:00-11:50 (Ing. Marek)</title>
</variant>
<variant id="48681" registered="20" limit="20" upd_ts="2014-09-09T11:22:53">
<title lang="cs">Skupina č.03, pondělí 12:00-13:50 (Ing. Pluskal)</title>
</variant>
<variant id="48682" registered="18" limit="20" upd_ts="2014-09-09T11:23:07">
<title lang="cs">Skupina č.04, pondělí 14:00-15:50 (Ing. Pluskal)</title>
</variant>
<variant id="48683" registered="19" limit="20" upd_ts="2014-09-09T11:23:23">
<title lang="cs">Skupina č.05, pondělí 16:00-17:50 (Ing. Kmeť)</title>
</variant>
<variant id="48684" registered="11" limit="20" upd_ts="2014-09-09T11:23:37">
<title lang="cs">Skupina č.06, pondělí 18:00-19:50 (Ing. Kmeť)</title>
</variant>
<variant id="48685" registered="19" limit="20" upd_ts="2014-09-09T11:12:52">
<title lang="cs">Skupina č.11, pondělí 8:00-9:50 (Ing. Marek)</title>
</variant>
<variant id="48686" registered="19" limit="20" upd_ts="2014-09-09T11:13:47">
<title lang="cs">Skupina č.12, pondělí 10:00-11:50 (Ing. Marek)</title>
</variant>
<variant id="48687" registered="20" limit="20" upd_ts="2014-09-09T11:17:05">
<title lang="cs">Skupina č.13, pondělí 12:00-13:50 (Ing. Pluskal)</title>
</variant>
<variant id="48688" registered="20" limit="20" upd_ts="2014-09-09T11:18:59">
<title lang="cs">Skupina č.14, pondělí 14:00-15:50 (Ing. Pluskal)</title>
<entry reg_type="stud" reg_time="2014-09-22T20:05:02" points="8.25" who="ipluskal" date="2014-12-15" upd_ts="2014-12-15T15:36:38"/>
</variant>
<variant id="48689" registered="20" limit="20" upd_ts="2014-09-09T11:19:58">
<title lang="cs">Skupina č.15, pondělí 16:00-17:50 (Ing. Kmeť)</title>
</variant>
<variant id="48690" registered="20" limit="20" upd_ts="2014-09-09T11:20:28">
<title lang="cs">Skupina č.16, pondělí 18:00-19:50 (Ing. Kmeť)</title>
</variant>
<variant id="48691" registered="20" limit="20" upd_ts="2014-09-09T11:26:08">
<title lang="cs">Skupina č.07, středa 8:00-9:50 (Ing. Lichtner)</title>
</variant>
<variant id="48692" registered="20" limit="20" upd_ts="2014-09-09T11:26:31">
<title lang="cs">Skupina č.08, středa 10:00-11:50 (Ing. Lichtner)</title>
</variant>
<variant id="48693" registered="20" limit="20" upd_ts="2014-09-09T11:27:16">
<title lang="cs">Skupina č.09, středa 12:00-13:50 (Ing. Marek)</title>
</variant>
<variant id="48694" registered="20" limit="20" upd_ts="2014-09-09T11:28:02">
<title lang="cs">Skupina č.10, středa 14:00-15:50 (Ing. Polčák)</title>
</variant>
<variant id="48695" registered="20" limit="20" upd_ts="2014-09-09T11:29:09">
<title lang="cs">Skupina č.21, středa 16:00-17:50 (Ing. Polčák)</title>
</variant>
<variant id="48696" registered="19" limit="20" upd_ts="2014-09-09T11:31:21">
<title lang="cs">Skupina č.17, středa 8:00-9:50 (Ing. Lichtner)</title>
</variant>
<variant id="48697" registered="20" limit="20" upd_ts="2014-09-09T11:32:01">
<title lang="cs">Skupina č.18, středa 10:00-11:50 (Ing. Lichtner)</title>
</variant>
<variant id="48698" registered="20" limit="20" upd_ts="2014-09-09T11:33:39">
<title lang="cs">Skupina č.19, středa 12:00-13:50 (Ing. Marek)</title>
</variant>
<variant id="48699" registered="20" limit="20" upd_ts="2014-09-09T11:35:11">
<title lang="cs">Skupina č.20, středa 14:00-15:50 (Ing. Polčák)</title>
</variant>
<variant id="48700" registered="36" limit="50" upd_ts="2014-09-11T17:28:16">
<title lang="cs">Uznání hodnocení z laboratoří z loňského roku</title>
</variant>
</item>
<item id="48666" num="2" type="single" start="2014-11-10" end="2014-11-19" registered="419" max="15" entry="all" upd_ts="2014-10-04T04:03:21">
<title lang="cs">Půlsemestrální test</title>
<entry reg_type="all" reg_time="2014-09-08T16:54:59" points="14" who="imarek" date="2014-11-10" upd_ts="2014-11-10T15:52:33"/>
</item>
<item id="48667" num="3" type="select" start="2014-09-29" end="2014-11-30" reg_start="2014-09-26T20:03:00" reg_end="2014-10-03T00:00:00" max="15" entry="login" upd_ts="2014-12-03T02:48:45">
<title lang="cs">Programování síťové služby</title>
<variant id="48701" registered="52" limit="53" upd_ts="2014-12-03T03:20:33">
<title lang="cs">
IRC bot s logováním přes SYSLOG protokol (Ing. Marek)
</title>
</variant>
<variant id="48702" registered="53" limit="53" upd_ts="2014-09-24T12:56:25">
<title lang="cs">XMPP/Jabber klient (Ing. Pluskal)</title>
<entry reg_type="stud" reg_time="2014-09-26T20:03:00" points="11.5" who="ipluskal" date="2014-12-08" upd_ts="2014-12-08T21:37:42"/>
</variant>
<variant id="48703" registered="53" limit="53" upd_ts="2014-09-25T11:20:14">
<title lang="cs">Analyzátor VoIP signalizácie SIP (Ing. Kmeť)</title>
</variant>
<variant id="48704" registered="53" limit="53" upd_ts="2014-10-28T15:39:21">
<title lang="cs">Jednoduchý IRC klient (Ing. Lichtner)</title>
</variant>
<variant id="48705" registered="53" limit="53" upd_ts="2014-10-22T22:51:08">
<title lang="cs">TFTP Server (Ing. Veselý)</title>
</variant>
<variant id="48706" registered="53" limit="53" upd_ts="2014-10-22T22:51:14">
<title lang="cs">TFTP Klient (Ing. Veselý)</title>
</variant>
<variant id="48707" registered="47" limit="53" upd_ts="2014-09-24T12:56:01">
<title lang="cs">Multicast to unicast (Ing. Grégr)</title>
</variant>
<variant id="48708" registered="53" limit="53" upd_ts="2014-10-06T10:21:15">
<title lang="cs">Monitorování hlaviček HTTP (Ing. Polčák)</title>
</variant>
</item>
<item id="48668" num="4" type="accr" start="2014-12-15" registered="419" min="20" entry="all" upd_ts="2014-10-04T04:03:12">
<title lang="cs">Zápočet</title>
</item>
<item id="48669" num="5" type="multi" min="20" max="60" upd_ts="2014-09-08T16:58:25">
<title lang="cs">Semestrální zkouška ISA</title>
<variant id="50072" date="2015-01-08" entry="loginz" registered="107" limit="150" upd_ts="2015-01-07T13:01:24">
<title lang="cs">Termín 1 (písemný)</title>
</variant>
<variant id="50073" date="2015-01-09" entry="loginz" registered="227" limit="227" upd_ts="2015-01-07T17:00:58">
<title lang="cs">Termín 2 (písemný)</title>
<entry reg_type="stud" reg_time="2014-12-15T20:02:00" points="44" who="matousp" date="2015-01-12" upd_ts="2015-01-12T16:52:14"/>
</variant>
<variant id="50074" date="2015-01-16" entry="loginz" registered="60" limit="114" upd_ts="2015-01-15T08:07:32">
<title lang="cs">Termín 3 (písemný)</title>
</variant>
<variant id="50075" date="2015-01-22" entry="loginz" registered="99" limit="100" upd_ts="2015-01-07T13:01:46">
<title lang="cs">Termín 4 (písemný)</title>
</variant>
<variant id="50076" date="2015-01-28" entry="loginz" registered="6" limit="24" upd_ts="2014-11-26T12:35:50">
<title lang="cs">Termín 5 (ústní)</title>
</variant>
<variant id="50077" date="2015-01-29" entry="loginz" registered="14" limit="24" upd_ts="2014-12-12T12:29:11">
<title lang="cs">Termín 6 (ústní)</title>
</variant>
<variant id="50978" date="2014-12-12" entry="listed" registered="3" upd_ts="2014-12-12T06:37:27">
<title lang="cs">Předtermín pro studenty Erasmus</title>
</variant>
</item>
</course>
<course id="10011" csid="550784" abbrv="ISP" type="P" completion="Za" points="0" credits="2" sem="Z" upd_ts="2014-08-20T09:18:39">
<title lang="cs">Semestrální projekt</title>
<title lang="en">Term Project</title>
<item id="51083" num="1" type="single" start="2014-12-12" end="2015-02-06" registered="373" entry="all" upd_ts="2015-01-02T12:49:44">
<title lang="cs">1) Obhajoba SP</title>
<entry reg_type="all" reg_time="2015-01-02T12:48:06" upd_ts="2015-01-02T12:48:06"/>
</item>
</course>
<course id="10021" csid="550786" abbrv="ITU" type="P" completion="Klz" points="85" credits="4" sem="Z" upd_ts="2014-12-19T22:03:53">
<title lang="cs">Tvorba uživatelských rozhraní</title>
<title lang="en">User Interface Programming</title>
<accreditation status="yes" date="2015-01-31">
<teacher>Beran Vítězslav, Ing., Ph.D.</teacher>
</accreditation>
<item id="48307" num="0" type="select" start="2014-09-22" end="2014-11-07" reg_start="2014-09-30T21:30:00" reg_end="2014-10-10T00:00:00" entry="login" upd_ts="2014-09-25T11:57:08">
<title lang="cs">Cvičení - termín</title>
<variant id="48308" registered="9" limit="20" upd_ts="2014-07-25T14:04:09">
<title lang="cs">O203 Po 09:00</title>
</variant>
<variant id="48309" registered="19" limit="20" upd_ts="2014-07-25T14:04:09">
<title lang="cs">O203 Po 11:00</title>
</variant>
<variant id="48310" registered="20" limit="20" upd_ts="2014-07-25T14:04:09">
<title lang="cs">O203 Po 15:00</title>
</variant>
<variant id="48311" registered="17" limit="20" upd_ts="2014-07-25T14:04:09">
<title lang="cs">O203 Po 07:00</title>
</variant>
<variant id="48312" registered="14" limit="20" upd_ts="2014-07-25T14:04:09">
<title lang="cs">O204 Po 09:00</title>
</variant>
<variant id="48313" registered="13" limit="20" upd_ts="2014-07-25T14:04:09">
<title lang="cs">O204 Po 11:00</title>
</variant>
<variant id="48314" registered="20" limit="20" upd_ts="2014-07-25T14:04:09">
<title lang="cs">O204 Po 13:00</title>
</variant>
<variant id="48315" registered="20" limit="20" upd_ts="2014-07-25T14:04:09">
<title lang="cs">O204 Po 15:00</title>
</variant>
<variant id="48316" registered="11" limit="20" upd_ts="2014-07-25T14:04:09">
<title lang="cs">O204 Po 07:00</title>
</variant>
<variant id="48317" registered="20" limit="20" upd_ts="2014-07-25T14:04:09">
<title lang="cs">O203 Út 07:00</title>
<entry reg_type="stud" reg_time="2014-09-30T21:30:01" upd_ts="2014-09-30T21:30:01"/>
</variant>
<variant id="48318" registered="20" limit="20" upd_ts="2014-07-25T14:04:09">
<title lang="cs">O203 Út 09:00</title>
</variant>
<variant id="48319" registered="20" limit="20" upd_ts="2014-07-25T14:17:23">
<title lang="cs">O203 Po 17:00</title>
</variant>
<variant id="48320" registered="20" limit="20" upd_ts="2014-07-25T14:04:09">
<title lang="cs">O203 Út 13:00</title>
</variant>
<variant id="48321" registered="20" limit="20" upd_ts="2014-07-25T14:04:09">
<title lang="cs">O203 Út 15:00</title>
</variant>
<variant id="48322" registered="20" limit="20" upd_ts="2014-07-25T14:04:09">
<title lang="cs">O203 Po 13:00</title>
</variant>
<variant id="48323" registered="20" limit="20" upd_ts="2014-07-25T14:04:09">
<title lang="cs">O204 Út 07:00</title>
</variant>
<variant id="48324" registered="20" limit="20" upd_ts="2014-07-25T14:04:09">
<title lang="cs">O204 Út 09:00</title>
</variant>
<variant id="48325" registered="19" limit="20" upd_ts="2014-07-25T14:17:36">
<title lang="cs">O204 Po 17:00</title>
</variant>
<variant id="48326" registered="20" limit="20" upd_ts="2014-07-25T14:04:09">
<title lang="cs">O204 Út 13:00</title>
</variant>
<variant id="48327" registered="20" limit="20" upd_ts="2014-07-25T14:04:09">
<title lang="cs">O204 Út 15:00</title>
</variant>
</item>
<item id="48330" num="0" type="select" start="2014-12-08" end="2014-12-16" reg_start="2014-11-13T21:45:00" reg_end="2014-12-15T00:00:00" entry="login" upd_ts="2014-12-12T09:50:15">
<title lang="cs">Obhajoba projektu - termín</title>
<variant id="48331" registered="12" limit="12" upd_ts="2014-07-25T14:57:03">
<title lang="cs">Den II. 13:00</title>
</variant>
<variant id="48332" registered="12" limit="12" upd_ts="2014-07-25T14:56:43">
<title lang="cs">Den II. 11:00</title>
</variant>
<variant id="48333" registered="12" limit="12" upd_ts="2014-07-25T14:56:57">
<title lang="cs">Den II. 09:00</title>
</variant>
<variant id="48334" registered="12" limit="12" upd_ts="2014-07-25T14:56:50">
<title lang="cs">Den II. 07:00</title>
</variant>
<variant id="48335" registered="12" limit="12" upd_ts="2014-07-25T14:56:00">
<title lang="cs">Den I. 09:00</title>
</variant>
<variant id="48336" registered="12" limit="12" upd_ts="2014-07-25T14:56:10">
<title lang="cs">Den I. 11:00</title>
</variant>
<variant id="48337" registered="12" limit="12" upd_ts="2014-07-25T14:56:18">
<title lang="cs">Den I. 13:00</title>
</variant>
<variant id="48338" registered="12" limit="12" upd_ts="2014-07-25T14:55:55">
<title lang="cs">Den I. 07:00</title>
</variant>
<variant id="48339" registered="12" limit="12" upd_ts="2014-12-12T09:46:56">
<title lang="cs">Den III. 08:00</title>
</variant>
<variant id="48340" registered="12" limit="12" upd_ts="2014-07-25T14:56:24">
<title lang="cs">Den I. 15:00</title>
</variant>
<variant id="48341" registered="12" limit="12" upd_ts="2014-11-20T08:28:30">
<title lang="cs">Den I. 17:00</title>
</variant>
<variant id="48342" registered="12" limit="12" upd_ts="2014-07-25T14:57:09">
<title lang="cs">Den II. 15:00</title>
</variant>
<variant id="50041" registered="6" limit="3" upd_ts="2014-12-12T09:46:56">
<title lang="cs">Den III. 12:00</title>
</variant>
</item>
<item id="48357" num="1" type="single" start="2014-09-29" end="2014-09-30" entry="listed" upd_ts="2014-07-25T15:12:52">
<title lang="cs">Cvičení ITU 0.</title>
</item>
<item id="48359" num="2" type="single" start="2014-10-06" end="2014-10-07" registered="363" max="5" entry="all" upd_ts="2014-10-06T08:49:21">
<title lang="cs">Cvičení ITU 1. (WinAPI)</title>
<entry reg_type="all" reg_time="2014-10-05T19:45:07" points="5" who="imusilpetr" date="2014-10-07" upd_ts="2014-10-07T12:41:22"/>
</item>
<item id="48358" num="3" type="single" start="2014-10-13" end="2014-10-14" registered="363" max="5" entry="all" upd_ts="2014-10-06T10:31:06">
<title lang="cs">Cvičení ITU 2. (Qt)</title>
<entry reg_type="all" reg_time="2014-10-06T10:31:06" points="5" who="ijurzy" date="2014-10-14" upd_ts="2014-10-14T16:46:08"/>
</item>
<item id="48360" num="4" type="single" start="2014-10-20" end="2014-10-21" registered="363" max="5" entry="all" upd_ts="2014-10-06T10:31:16">
<title lang="cs">Cvičení ITU 3. (WPF)</title>
<entry reg_type="all" reg_time="2014-10-06T10:31:16" points="5" who="izacharias" date="2014-10-29" upd_ts="2014-10-29T14:05:35"/>
</item>
<item id="48361" num="5" type="single" start="2014-10-27" end="2014-11-12" registered="363" max="5" entry="all" upd_ts="2014-11-10T13:46:04">
<title lang="cs">Cvičení ITU 4. (Web)</title>
<entry reg_type="all" reg_time="2014-10-06T10:31:24" points="5" who="iklicnar" date="2014-11-07" upd_ts="2014-11-07T23:50:43"/>
</item>
<item id="48362" num="6" type="single" start="2014-11-03" end="2014-11-12" registered="363" max="5" entry="all" upd_ts="2014-11-10T08:56:34">
<title lang="cs">Cvičení ITU 5. (Návrh)</title>
<entry reg_type="all" reg_time="2014-10-06T10:31:31" points="5" who="beranv" date="2014-11-11" upd_ts="2014-11-11T09:00:59"/>
</item>
<item id="48486" num="10" type="single" start="2014-09-22" end="2014-10-26" registered="363" entry="all" upd_ts="2014-11-12T10:25:01">
<title lang="cs">Analýza zadání a návrh řešení projektu</title>
<entry reg_type="all" reg_time="2014-10-22T14:56:27" upd_ts="2014-10-22T14:56:27"/>
</item>
<item id="48329" num="11" type="single" start="2014-11-03" end="2014-11-24" registered="363" entry="all" upd_ts="2014-11-12T10:25:22">
<title lang="cs">Popis řešení, implementace a návrh testování</title>
<entry reg_type="all" reg_time="2014-09-01T04:03:10" upd_ts="2014-09-01T04:03:10"/>
</item>
<item id="48328" num="12" type="single" start="2014-11-24" end="2014-12-01" registered="363" entry="all" upd_ts="2014-11-25T07:57:39">
<title lang="cs">Revize technické zprávy</title>
<entry reg_type="all" reg_time="2014-11-12T10:25:36" upd_ts="2014-11-12T10:25:36"/>
</item>
<item id="48343" num="21" type="single" start="2014-11-13" registered="363" max="20" entry="all" upd_ts="2014-11-12T10:38:11">
<title lang="cs">Test</title>
<entry reg_type="all" reg_time="2014-09-01T04:03:10" points="16" who="beranv" date="2014-11-18" upd_ts="2014-11-18T14:41:06"/>
</item>
<item id="48363" num="22" type="select" start="2014-10-13" end="2014-12-18" reg_start="2014-09-30T21:45:00" reg_end="2014-10-09T00:00:00" min="5" max="55" entry="login" upd_ts="2014-12-05T21:41:31">
<title lang="cs">Projekt</title>
<variant id="48364" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">
Uživatelské rozhraní informačního systému pro správu projektů
</title>
</variant>
<variant id="48365" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Demonstrace lokálních světelných modelů</title>
</variant>
<variant id="48366" registered="18" limit="21" upd_ts="2014-10-03T16:16:52">
<title lang="cs">Vlastní zadání</title>
</variant>
<variant id="48367" registered="4" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Hodiny</title>
</variant>
<variant id="48368" registered="6" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Automatické vypínání počítače</title>
</variant>
<variant id="48369" registered="2" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Program pro procvičování psaní všemi deseti prsty</title>
</variant>
<variant id="48370" registered="5" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Výukový program na zkoušení slovíček</title>
</variant>
<variant id="48371" registered="5" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">
Výukový program na zkoušení slovíček pro mobilní telefon
</title>
</variant>
<variant id="48372" registered="6" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Test krátkodobé paměti</title>
</variant>
<variant id="48373" registered="2" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Vyhodnocování zvuků</title>
</variant>
<variant id="48374" registered="6" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">
Chat s podporou klientů na dvou různých platformách
</title>
</variant>
<variant id="48375" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Demonstrace textur a aliasingu</title>
</variant>
<variant id="48376" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Demonstrace konzistence v uživatelských rozhraních</title>
</variant>
<variant id="48377" registered="6" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Demonstrace křivek v počítačové grafice</title>
</variant>
<variant id="48378" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Sada komponentů pro práci s videem</title>
</variant>
<variant id="48379" registered="1" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Pozicování pomocí klávesnice</title>
</variant>
<variant id="48380" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Testování výkonnosti menu a klávesových zkratek</title>
</variant>
<variant id="48381" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Testování struktury menu</title>
</variant>
<variant id="48382" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Syndromy znesnadňující práci s počítačem</title>
</variant>
<variant id="48383" registered="2" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Simulace psaní textu mobilním telefonem</title>
</variant>
<variant id="48384" registered="6" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Kalkulátor a experimentální vyhodnocení</title>
</variant>
<variant id="48385" registered="1" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Editor tabulek databáze</title>
</variant>
<variant id="48386" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Kapacita krátkodobé paměti</title>
</variant>
<variant id="48387" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Zpracování a generování událostí ve Windows</title>
</variant>
<variant id="48388" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">
Simulace čtení dokumentu na PC, PDA a mobilním telefonu
</title>
</variant>
<variant id="48389" registered="5" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">
Databáze filmů nebo nahrávek s experimentálním vyhodnocením
</title>
</variant>
<variant id="48390" registered="1" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Offline prohlížení webových serverů</title>
</variant>
<variant id="48391" registered="3" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">
Demonstrace uživatelského rozhraní mobilního zařízení
</title>
</variant>
<variant id="48392" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Demonstrace uživatelského rozhraní Windows XP</title>
</variant>
<variant id="48393" registered="2" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Komponenty pro zachytávání videa</title>
</variant>
<variant id="48394" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Komponenty pro zachytávání zvuku</title>
</variant>
<variant id="48395" registered="1" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Nástroj pro tvorbu videoprezentací</title>
</variant>
<variant id="48396" registered="5" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Elektronický kalendář</title>
</variant>
<variant id="48397" registered="5" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Webová fotogalerie</title>
</variant>
<variant id="48398" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Ovládání leteckého simulátoru</title>
</variant>
<variant id="48399" registered="2" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">RSS a ATOM kanály</title>
</variant>
<variant id="48400" registered="6" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Sledování bezdrátových sítí</title>
</variant>
<variant id="48401" registered="5" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Editor 3D terénu</title>
</variant>
<variant id="48402" registered="5" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Webové rozhraní pro správu publikací</title>
</variant>
<variant id="48403" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Bezdotykové ovládání</title>
</variant>
<variant id="48404" registered="5" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Hra "Pexeso"</title>
</variant>
<variant id="48405" registered="6" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Editor zdrojových textů</title>
</variant>
<variant id="48406" registered="5" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Evidence zaměstnanců</title>
</variant>
<variant id="48407" registered="6" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">GUI strategické hry</title>
</variant>
<variant id="48408" registered="4" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">GUI pro práci s maticemi a vektory</title>
</variant>
<variant id="48409" registered="4" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Hra "Bomberman"</title>
</variant>
<variant id="48410" registered="6" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Správce souborů</title>
</variant>
<variant id="48411" registered="6" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Hra "Had"</title>
</variant>
<variant id="48412" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Sdílený adresář ve 3D</title>
</variant>
<variant id="48413" registered="5" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Jednoduché účetnictví</title>
</variant>
<variant id="48414" registered="5" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Hra "Piškvorky"</title>
</variant>
<variant id="48415" registered="2" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Aplikace pro tvorbu testů</title>
</variant>
<variant id="48416" registered="2" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Správce disků</title>
</variant>
<variant id="48417" registered="3" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">SVN klient</title>
</variant>
<variant id="48418" registered="6" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">MP3 přehrávač s databází skladeb</title>
</variant>
<variant id="48419" registered="6" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Evidence zboží</title>
</variant>
<variant id="48420" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Návrh jednoduchého řídícího systému robota</title>
</variant>
<variant id="48421" registered="2" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Demonstrace semínkového vyplňování</title>
</variant>
<variant id="48422" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Program pro správu zdrojů</title>
</variant>
<variant id="48423" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Sledování změn v dokumentech</title>
</variant>
<variant id="48424" registered="2" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Hra "15"</title>
</variant>
<variant id="48425" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Raytracer GUI</title>
</variant>
<variant id="48426" registered="5" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Plánovací kalendář a minidiář</title>
</variant>
<variant id="48427" registered="5" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Správce digitálních fotografií</title>
</variant>
<variant id="48428" registered="4" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Kniha jízd</title>
</variant>
<variant id="48429" registered="3" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Telefon VoIP</title>
</variant>
<variant id="48430" registered="2" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Tvorba křížovek</title>
</variant>
<variant id="48431" registered="3" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">TODO list</title>
</variant>
<variant id="48432" registered="2" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Prostředí pro spolupráci více uživatelů</title>
</variant>
<variant id="48433" registered="5" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">
Grafický editor podporující spolupráci více uživatelů
</title>
<entry reg_type="stud" reg_time="2014-09-30T22:01:28" points="44" who="beranv" date="2014-12-19" upd_ts="2014-12-19T22:03:53"/>
</variant>
<variant id="48434" registered="6" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Elektronická kuchařka</title>
</variant>
<variant id="48435" registered="4" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Jednoduchý WiFi lokátor</title>
</variant>
<variant id="48436" registered="5" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Letiště - rezervace letenek</title>
</variant>
<variant id="48437" registered="3" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Hra "Šachy"</title>
</variant>
<variant id="48438" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Pozicování pomocí směru pohledu uživatele</title>
</variant>
<variant id="48439" registered="2" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Nástroj pro prezentaci fotek</title>
</variant>
<variant id="48440" registered="5" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Hra "Kakuro"</title>
</variant>
<variant id="48441" registered="5" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Autoškola</title>
</variant>
<variant id="48442" registered="6" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Administratorské rozhraní pro CMS</title>
</variant>
<variant id="48443" registered="2" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Mind mapper</title>
</variant>
<variant id="48444" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Manažer víkendových aktivit</title>
</variant>
<variant id="48445" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Hra "3D Had"</title>
</variant>
<variant id="48446" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Editor UML</title>
</variant>
<variant id="48447" registered="5" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Rozhraní pro internetové bankovnictví</title>
</variant>
<variant id="48448" registered="4" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Hra "Dáma"</title>
</variant>
<variant id="48449" registered="6" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Čtenářský klub</title>
</variant>
<variant id="48450" registered="6" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Evidence výpočetní techniky</title>
</variant>
<variant id="48451" registered="2" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Správa hostingu</title>
</variant>
<variant id="48452" registered="2" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Hra "Žolík"</title>
</variant>
<variant id="48453" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Jednoduchý správce oken</title>
</variant>
<variant id="48454" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Vizualizace workflow</title>
</variant>
<variant id="48455" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Kreslící modul pro video přehrávač ve Flash</title>
</variant>
<variant id="48456" registered="4" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Metronom</title>
</variant>
<variant id="48457" registered="4" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Výukový program na znalost ptáků ČR</title>
</variant>
<variant id="48458" registered="3" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Monitorovací systém (elektronický vrátný)</title>
</variant>
<variant id="48459" registered="6" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Editor fotografií</title>
</variant>
<variant id="48460" registered="5" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Evidence vozidel, řidičů a přestupků</title>
</variant>
<variant id="48461" registered="5" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Hra "Lodě"</title>
</variant>
<variant id="48462" registered="2" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Rezervace místností</title>
</variant>
<variant id="48463" registered="2" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">
Editace obsahu tabulek s využitím webových technologií
</title>
</variant>
<variant id="48464" registered="3" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Inteligentní zadávání časových údajů</title>
</variant>
<variant id="48465" registered="1" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Interaktivní tvorba tvaru tabulky</title>
</variant>
<variant id="48466" registered="1" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Prohlížeč fotografií</title>
</variant>
<variant id="48467" registered="6" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Hra "Sudoku"</title>
</variant>
<variant id="48468" registered="3" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Grafický editor</title>
</variant>
<variant id="48469" registered="1" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Hra "3D Pexeso"</title>
</variant>
<variant id="48470" registered="3" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Hra "3D Piškvorky"</title>
</variant>
<variant id="48471" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Správce souborů ve 3D</title>
</variant>
<variant id="48472" registered="3" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Výukový program na znalost rostlin ČR</title>
</variant>
<variant id="48473" registered="3" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Výukový program na znalost savců ČR</title>
</variant>
<variant id="48474" registered="5" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Modul fotogalerie pro web</title>
</variant>
<variant id="48475" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">2D editor pomocí detekce rukou</title>
</variant>
<variant id="48476" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Interakce se školním informačním systémem</title>
</variant>
<variant id="48477" registered="3" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Systém pro správu konzultačních schůzek</title>
<title lang="en">Consultation meetings manager</title>
</variant>
<variant id="48478" registered="2" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Time tracker</title>
</variant>
<variant id="48479" registered="6" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Hra "Dostihy a sázky"</title>
</variant>
<variant id="48480" registered="1" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Editor číslicových obvodů</title>
</variant>
<variant id="48481" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Sdíleny víceuživatelský vektorový editor</title>
</variant>
<variant id="48482" registered="2" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Půjčovna sportovního vybavení</title>
</variant>
<variant id="48483" registered="6" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">
Uživatelské rozhraní aplikace pro organizování úkolů
</title>
<title lang="en">User interface for tasks organization</title>
</variant>
<variant id="48484" registered="6" limit="6" upd_ts="2014-10-03T15:46:40">
<title lang="cs">Hra "Červi"</title>
</variant>
</item>
<item id="48485" num="99" type="accr" start="2015-01-31" registered="363" min="50" entry="all" upd_ts="2014-10-04T04:03:20">
<title lang="cs">Zápočet</title>
</item>
</course>
<course id="9950" csid="550787" abbrv="HPO" type="PVH" completion="Za" points="0" credits="3" sem="Z" upd_ts="2014-12-19T11:23:51">
<title lang="cs">Psychologie osobnosti</title>
<title lang="en">Personality Psychology</title>
<accreditation status="yes" date="2014-12-19">
<teacher>Růžička Richard, doc. Ing., Ph.D.</teacher>
</accreditation>
<item id="49201" num="1" type="select" start="2014-09-22" end="2014-12-19" reg_start="2014-09-22T19:00:00" reg_end="2014-10-07T00:00:00" entry="login" upd_ts="2014-09-22T10:59:03">
<title lang="cs">cvičení</title>
<variant id="49202" registered="20" limit="20" upd_ts="2014-09-22T11:03:28">
<title lang="cs">Úterý 12:00 - sudé týdny - čtěte popis!</title>
</variant>
<variant id="49203" registered="20" limit="20" upd_ts="2014-09-22T11:05:19">
<title lang="cs">Pondělí 8:00 - sudé týdny - čtěte popis!</title>
<entry reg_type="stud" reg_time="2014-09-22T19:00:00" upd_ts="2014-09-22T19:00:00"/>
</variant>
</item>
</course>
<course id="9987" csid="550791" abbrv="INI" type="V" completion="Klz" points="62" credits="4" sem="Z" upd_ts="2014-12-19T16:49:34">
<title lang="cs">Návrh a implementace IT služeb</title>
<title lang="en">IT Service Design and Implementation</title>
<accreditation status="yes" date="2014-12-22">
<teacher>Rychlý Marek, RNDr., Ph.D.</teacher>
</accreditation>
<item id="48885" num="0" type="select" start="2014-10-15" reg_start="2014-09-24T19:40:00" reg_end="2014-10-14T23:59:59" entry="login" upd_ts="2014-09-18T21:40:10">
<title lang="cs">Téma projektu</title>
<title lang="en">Project's Topic</title>
<variant id="48886" limit="1" upd_ts="2014-09-18T21:40:55">
<title lang="cs">01: Tvorba a hosting webových aplikací</title>
</variant>
<variant id="48887" registered="1" limit="1" upd_ts="2014-09-18T21:41:06">
<title lang="cs">02: Cestovní agentura</title>
</variant>
<variant id="48888" registered="1" limit="1" upd_ts="2014-09-18T21:41:14">
<title lang="cs">03: Velkoobchodní prodej léků a léčiv</title>
</variant>
<variant id="48889" registered="1" limit="1" upd_ts="2014-09-18T21:41:25">
<title lang="cs">04: Síť lékaren</title>
</variant>
<variant id="48890" registered="1" limit="1" upd_ts="2014-09-18T21:41:33">
<title lang="cs">05: Studijní oddělení</title>
</variant>
<variant id="48891" limit="1" upd_ts="2014-09-18T21:41:41">
<title lang="cs">06: Realitní kancelář</title>
</variant>
<variant id="48892" limit="1" upd_ts="2014-09-18T21:41:50">
<title lang="cs">07: Zubní ordinace</title>
</variant>
<variant id="48893" registered="1" limit="1" upd_ts="2014-09-18T21:41:56">
<title lang="cs">08: Ubytovací zařízení</title>
</variant>
<variant id="48894" registered="1" limit="1" upd_ts="2014-09-18T21:42:05">
<title lang="cs">09: Odbavení na letišti</title>
<entry reg_type="stud" reg_time="2014-09-24T19:40:01" upd_ts="2014-09-24T19:40:01"/>
</variant>
<variant id="48895" registered="1" limit="1" upd_ts="2014-09-18T21:42:12">
<title lang="cs">10: Vědecká knihovna</title>
</variant>
<variant id="48896" limit="1" upd_ts="2014-09-18T21:42:19">
<title lang="cs">11: Školící středisko</title>
</variant>
<variant id="48897" registered="1" limit="1" upd_ts="2014-09-18T21:42:27">
<title lang="cs">14: Továrna na automobily</title>
</variant>
<variant id="48898" registered="1" limit="1" upd_ts="2014-09-18T21:42:34">
<title lang="cs">18: Lokální poskytovatel internetového připojení</title>
</variant>
</item>
<item id="48899" num="1" type="select" start="2014-10-15" end="2014-12-10" reg_start="2014-09-24T19:50:00" reg_end="2014-10-14T23:59:59" max="10" entry="login" upd_ts="2014-09-18T21:45:03">
<title lang="cs">Prezentace vybrané části projektu</title>
<title lang="en">Presentation of a selected part of the project</title>
<variant id="48900" registered="14" limit="3" upd_ts="2014-09-18T21:51:38">
<title lang="cs">2014-10-15 -- Portfolio služeb</title>
<title lang="en">2014-10-15 -- Service Portfolio</title>
<entry reg_type="stud" reg_time="2014-09-24T19:50:01" points="8" who="rychly" date="2014-10-15" upd_ts="2014-10-15T20:54:11"/>
</variant>
<variant id="48901" registered="5" limit="2" upd_ts="2014-09-18T21:47:57">
<title lang="cs">2014-10-29 -- Finanční analýza</title>
<title lang="en">2014-10-29 -- Financial Analysis</title>
</variant>
<variant id="48902" registered="10" limit="2" upd_ts="2014-09-18T21:49:15">
<title lang="cs">
2014-11-12 -- Dohoda o úrovni provozních služeb/Podpůrná smlouva + Dohoda o úrovních služeb
</title>
<title lang="en">
2014-11-12 -- Operational Level Agreement/Underpinning Contract + Service Level Agreement
</title>
</variant>
<variant id="48903" registered="8" limit="2" upd_ts="2014-09-18T21:50:04">
<title lang="cs">2014-11-26 -- Balíček návrhu služby</title>
<title lang="en">2014-11-26 -- Service Design Package</title>
</variant>
<variant id="48904" registered="4" limit="1" upd_ts="2014-09-18T21:50:45">
<title lang="cs">
2014-12-10 -- Hodnotící zpráva o službě + Plán na zlepšení služby + Požadavek na změnu
</title>
<title lang="en">
2014-12-10 -- Service Evaluation Report + Service Improvement Plan + Request for Change
</title>
</variant>
</item>
<item id="48905" num="2" type="single" start="2014-10-01" end="2014-10-14" registered="43" max="10" entry="all" upd_ts="2014-09-26T04:03:10">
<title lang="cs">Projekt, 1. část</title>
<title lang="en">Project, 1st part</title>
<entry reg_type="all" reg_time="2014-09-18T21:54:46" points="7" who="rychly" date="2014-10-31" upd_ts="2014-10-31T17:00:17"/>
</item>
<item id="48906" num="3" type="single" start="2014-10-08" end="2014-10-28" registered="43" max="10" entry="all" upd_ts="2014-09-26T04:03:11">
<title lang="cs">Projekt, 2. část</title>
<title lang="en">Project, 2nd part</title>
<entry reg_type="all" reg_time="2014-09-18T21:56:24" points="8" who="rychly" date="2014-10-31" upd_ts="2014-10-31T21:28:17"/>
</item>
<item id="48907" num="4" type="single" start="2014-10-29" end="2014-11-11" registered="43" max="10" entry="all" upd_ts="2014-09-26T04:03:11">
<title lang="cs">Projekt, 3. část</title>
<title lang="en">Project, 3rd part</title>
<entry reg_type="all" reg_time="2014-09-18T21:58:24" points="7" who="rychly" date="2014-11-28" upd_ts="2014-11-28T21:36:37"/>
</item>
<item id="48908" num="5" type="single" start="2014-11-12" end="2014-11-25" registered="43" max="10" entry="all" upd_ts="2014-09-26T04:03:11">
<title lang="cs">Projekt, 4. část</title>
<title lang="en">Project, 4th part</title>
<entry reg_type="all" reg_time="2014-09-18T21:59:52" points="10" who="rychly" date="2014-11-30" upd_ts="2014-11-30T23:09:09"/>
</item>
<item id="48909" num="6" type="single" start="2014-11-26" end="2014-12-09" registered="43" max="10" entry="all" upd_ts="2014-09-26T04:03:11">
<title lang="cs">Projekt, 5. část</title>
<title lang="en">Project, 5th part</title>
<entry reg_type="all" reg_time="2014-09-18T22:01:01" points="10" who="rychly" date="2014-12-15" upd_ts="2014-12-15T18:15:29"/>
</item>
<item id="48910" num="7" type="single" start="2014-12-17" registered="43" max="40" entry="all" upd_ts="2014-09-26T04:03:11">
<title lang="cs">Zápočtový test</title>
<title lang="en">Final test</title>
<entry reg_type="all" reg_time="2014-09-18T22:02:25" points="12" who="rychly" date="2014-12-19" upd_ts="2014-12-19T16:49:34"/>
</item>
<item id="48911" num="8" type="accr" start="2014-12-22" registered="43" min="50" entry="all" upd_ts="2014-09-26T04:03:13">
<title lang="cs">Zápočet</title>
</item>
</course>
<course id="9960" csid="550788" abbrv="IBP" type="P" completion="Za" points="0" credits="9" sem="L" upd_ts="2014-08-20T09:18:39">
<title lang="cs">Bakalářská práce</title>
<title lang="en">Bachelor's Thesis</title>
</course>
<course id="10014" csid="550789" abbrv="ISZ" type="P" completion="Zk" points="0" credits="0" sem="L" upd_ts="2014-08-20T09:18:39">
<title lang="cs">Státní závěrečná zkouška</title>
<title lang="en">State Final Examination</title>
</course>
<course id="10023" csid="550790" abbrv="ITW" type="V" completion="Klz" points="0" credits="5" sem="L" upd_ts="2014-08-20T09:18:39">
<title lang="cs">Tvorba webových stránek</title>
<title lang="en">Web Design</title>
</course>
<course id="10029" csid="550792" abbrv="IVS" type="V" completion="Klz" points="0" credits="5" sem="L" upd_ts="2014-08-20T09:18:39">
<title lang="cs">Praktické aspekty vývoje software</title>
<title lang="en">Practical Aspects of Software Design</title>
<item id="51170" num="0" type="single" start="2015-05-05" entry="login" reg_start="2015-03-10T20:07:00" reg_end="2015-05-04T23:59:59" upd_ts="2015-01-08T16:38:14">
<title lang="cs">Veřejná prezentace a obhajoba týmových projektů</title>
</item>
<item id="51171" num="1" type="single" start="2015-02-17" end="2015-03-09" registered="21" max="17" entry="all" upd_ts="2015-01-08T16:41:43">
<title lang="cs">Projekt 1 - Testování Softwaru</title>
<entry reg_type="all" reg_time="2015-01-08T16:41:43" upd_ts="2015-01-08T16:41:43"/>
</item>
<item id="51172" num="2" type="single" start="2015-02-24" end="2015-04-13" registered="21" max="23" entry="all" upd_ts="2015-01-08T16:44:57">
<title lang="cs">
Projekt 2 - git, knihovny, make, debugging, profiling, dokumentace
</title>
<entry reg_type="all" reg_time="2015-01-08T16:44:57" upd_ts="2015-01-08T16:44:57"/>
</item>
<item id="51173" num="3" type="single" start="2015-03-10" end="2015-05-04" registered="21" max="30" entry="all" upd_ts="2015-01-08T16:50:56">
<title lang="cs">Projekt 3 - týmová spolupráce</title>
<entry reg_type="all" reg_time="2015-01-08T16:50:56" upd_ts="2015-01-08T16:50:56"/>
</item>
<item id="51174" num="4" type="single" start="2015-04-07" registered="21" max="30" entry="all" upd_ts="2015-01-08T16:53:22">
<title lang="cs">Půlsemestrální test</title>
<entry reg_type="all" reg_time="2015-01-08T16:53:22" upd_ts="2015-01-08T16:53:22"/>
</item>
</course>
</c:courses>
***
[[[' TAG: title ATRIBB: {} TEXT: Informační systémy', [' TAG: teacher ATRIBB: {} TEXT: None']]]]
