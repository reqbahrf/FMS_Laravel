
<style type="text/css">
  .tg {
    border-collapse: collapse;
    border-spacing: 0;
    margin: 0px auto;
  }

  .tg td {
    border-color: black;
    border-style: solid;
    border-width: 1px;
    font-family: Arial, sans-serif;
    font-size: 12px;
    overflow: hidden;
    padding: 10px 5px;
    word-break: normal;
  }

  .tg th {
    border-color: black;
    border-style: solid;
    border-width: 1px;
    font-family: Arial, sans-serif;
    font-size: 12px;
    font-weight: normal;
    overflow: hidden;
    padding: 10px 5px;
    word-break: normal;
  }

  .tg .tg-cly1 {
    text-align: left;
    vertical-align: middle
  }

  .tg .tg-1wig {
    font-weight: bold;
    text-align: left;
    vertical-align: top
  }

  .tg .tg-baqh {
    text-align: center;
    vertical-align: top
  }

  .tg .tg-wa1i {
    font-weight: bold;
    text-align: center;
    vertical-align: middle
  }

  .tg .tg-vkv7 {
    background-color: #FF0;
    font-weight: bold;
    text-align: left;
    vertical-align: middle
  }

  .tg .tg-j6zm {
    font-weight: bold;
    text-align: left;
    vertical-align: bottom
  }

  .tg .tg-7zrl {
    text-align: left;
    vertical-align: bottom
  }

  .tg .tg-8d8j {
    text-align: center;
    vertical-align: bottom
  }

  .tg .tg-nrix {
    text-align: center;
    vertical-align: middle
  }

  .tg .tg-0lax {
    text-align: left;
    vertical-align: top
  }

  .tg .tg-yla0 {
    font-weight: bold;
    text-align: left;
    vertical-align: middle
  }

  .form-group {
    font-family: Arial, sans-serif;
    font-size: 12px;
  }

  #dataSheetHeader img {
    width: 100%;
    height: auto;
  }
  @media screen and (max-width: 767px) {
    .tg {
      width: auto !important;
    }

    .tg col {
      width: auto !important;
    }

    .tg-wrap {
      overflow-x: auto;
      -webkit-overflow-scrolling: touch;
      margin: auto 0px;
    }
  }

  #containerSize {
    width: 794px;
    margin: auto;
    padding: 5%;
    /* or any specific width */
  }

  @media print {
    body * {
      visibility: hidden;
    }

    .tg-vkv7 {
      background-color: #FF0;
      /* Yellow background */
    }

    #containerSize,
    #containerSize * {
      visibility: visible;
    }

    #containerSize {
      position: absolute;
      left: 0;
      top: 0;
    }

    .tg {
      width: 100%;
      /* Adjust the width as necessary */
      box-sizing: border-box;
      /* Include padding and borders in the width */
      max-width: 100%;
      /* Ensure it doesn't exceed the page width */
      font-size: 10px;
      /* Reduce font size to fit content */
    }

    .tg td,
    .tg th {
      padding: 5px;
      /* Reduce padding to save space */
    }

  }
</style>
<div id="containerSize">
  <div id=dataSheetHeader>
    <img src="/assets/img/projectsheetsHeader.png" alt="header">
  </div>
  <div>
    <!-- Create a textfield for the following; Project Title:, Name of Firm:, Address:, the Contact person: and Designation: should be in the same horizontal line then Contact Details such as landline:, Mobile Phone: and Email Address should also in the same line. note that the textfield should utilize bootstrap -->
    <div class="form-group row">
      <label for="project_title" class="col-sm-2 col-form-label">Project Title:</label>
      <div class="col-sm-10">
        <p class="" id="project_title"><u>[Project Title Value]</u></p>
      </div>
    </div>
    <div class="form-group row">
      <label for="firm_name" class="col-sm-2 col-form-label">Name of Firm:</label>
      <div class="col-sm-10">
        <p class="" id="firm_name"><u>[Firm Name Value]</u></p>
      </div>
    </div>
    <div class="form-group row">
      <label for="address" class="col-sm-2 col-form-label">Address:</label>
      <div class="col-sm-10">
        <p class="" id="address"><u>[Address Value]</u></p>
      </div>
    </div>
    <div class="form-group row">
      <label for="contact_person" class="col-sm-2 col-form-label">Contact Person:</label>
      <div class="col-sm-4">
        <p class="" id="contact_person"><u>[Contact Person Value]</u></p>
      </div>
      <label for="designation" class="col-sm-2 col-form-label">Designation:</label>
      <div class="col-sm-4">
        <p class="" id="designation"><u>[Designation Value]</u></p>
      </div>
    </div>
    <div class="form-group row">
      <label for="landline" class="col-sm-2 col-form-label">Landline:</label>
      <div class="col-sm-2">
        <p class="" id="landline"><u>[Landline Value]</u></p>
      </div>
      <label for="mobile_phone" class="col-sm-2 col-form-label">Mobile Phone:</label>
      <div class="col-sm-2">
        <p class="" id="mobile_phone"><u>[Mobile Phone Value]</u></p>
      </div>
      <label for="email" class="col-sm-2 col-form-label">Email Address:</label>
      <div class="col-sm-2">
        <p class="" id="email"><u>[Email Address Value]</u></p>
      </div>
    </div>
  </div>
  <div class="tg-wrap">
    <table class="tg">
      <!-- <thead>
    <tr>
      <th class="tg-j6zm" colspan="8">1.0&nbsp;&nbsp;&nbsp;ASSETS</th>
    </tr>
  </thead> -->
      <tbody>
        <tr>
          <td class="tg-7zrl">1.1 Building</td>
          <td class="tg-8d8j" colspan="4"> &nbsp;&nbsp;&nbsp;</td>
          <td class="tg-8d8j" colspan="3" rowspan="3"> &nbsp;&nbsp;<br>&nbsp;&nbsp;<br>&nbsp;&nbsp;</td>
        </tr>
        <tr>
          <td class="tg-7zrl">1.2 Equipment</td>
          <td class="tg-8d8j" colspan="4"> &nbsp;&nbsp;&nbsp;</td>
        </tr>
        <tr>
          <td class="tg-7zrl">1.3 Working&nbsp;&nbsp;&nbsp;Capital</td>
          <td class="tg-8d8j" colspan="4"> &nbsp;&nbsp;&nbsp;</td>
        </tr>
        <tr>
          <td class="tg-wa1i" rowspan="4">Classification of Enterprise: </td>
          <td class="tg-nrix" colspan="2" rowspan="4">Micro(assets&nbsp;&nbsp;&nbsp;Less than 3M)</td>
          <td class="tg-nrix" colspan="2" rowspan="4">Small(assets&nbsp;&nbsp;&nbsp;of 3M to 15M)</td>
          <td class="tg-nrix" colspan="3" rowspan="4">Medium(assets&nbsp;&nbsp;&nbsp;15M to 100M)</td>
        </tr>
        <tr>
        </tr>
        <tr>
        </tr>
        <tr>
        </tr>
        <tr>
          <td class="tg-j6zm" colspan="7">2.0 Total Employment&nbsp;&nbsp;&nbsp;For The Quarter </td>
          <td class="tg-7zrl"> </td>
        </tr>
        <tr>
          <td class="tg-8d8j" rowspan="3"> <br><br></td>
          <td class="tg-baqh" colspan="2" rowspan="3">No. of Personnel </td>
          <td class="tg-baqh" rowspan="4">Total&nbsp;&nbsp;&nbsp;Work Days of the Personnel for the Quarter</td>
          <td class="tg-baqh" colspan="2" rowspan="4">Total&nbsp;&nbsp;&nbsp;Man-Month=no. of Work Days/20 x no Personnel)</td>
          <td class="tg-baqh" colspan="2" rowspan="4">Remarks</td>
        </tr>
        <tr>
        </tr>
        <tr>
        </tr>
        <tr>
          <td class="tg-7zrl"> </td>
          <td class="tg-nrix">Male </td>
          <td class="tg-nrix">Female </td>
        </tr>
        <tr>
          <td class="tg-7zrl" rowspan="2">2.1 Direct Labor Force(Production)</td>
          <td class="tg-8d8j" rowspan="2"> <br></td>
          <td class="tg-8d8j" rowspan="2"> <br></td>
          <td class="tg-8d8j" rowspan="2"> <br></td>
          <td class="tg-8d8j" colspan="2" rowspan="2"> <br> </td>
          <td class="tg-8d8j" colspan="2" rowspan="2"> <br> </td>
        </tr>
        <tr>
        </tr>
        <tr>
          <td class="tg-cly1" rowspan="2">2.1a&nbsp;&nbsp;&nbsp;Regular</td>
          <td class="tg-8d8j" rowspan="2"> <br></td>
          <td class="tg-8d8j" rowspan="2"> <br></td>
          <td class="tg-8d8j" rowspan="2"> <br></td>
          <td class="tg-8d8j" colspan="2" rowspan="2"> <br> </td>
          <td class="tg-8d8j" colspan="2" rowspan="2"> <br> </td>
        </tr>
        <tr>
        </tr>
        <tr>
          <td class="tg-cly1" rowspan="2">2.1b&nbsp;&nbsp;&nbsp;Part-time </td>
          <td class="tg-8d8j" rowspan="2"> <br></td>
          <td class="tg-8d8j" rowspan="2"> <br></td>
          <td class="tg-8d8j" rowspan="2"> <br></td>
          <td class="tg-8d8j" colspan="2" rowspan="2"> <br> </td>
          <td class="tg-8d8j" colspan="2" rowspan="2"> <br> </td>
        </tr>
        <tr>
        </tr>
        <tr>
          <td class="tg-7zrl" rowspan="3">2.2 Indirect Labor Force(Admin and Marketing)</td>
          <td class="tg-8d8j" rowspan="3"> <br><br></td>
          <td class="tg-8d8j" rowspan="3"> <br><br></td>
          <td class="tg-8d8j" rowspan="3"> <br><br></td>
          <td class="tg-8d8j" colspan="2" rowspan="3"> <br> <br> </td>
          <td class="tg-8d8j" colspan="2" rowspan="3"> <br> <br> </td>
        </tr>
        <tr>
        </tr>
        <tr>
        </tr>
        <tr>
          <td class="tg-cly1" rowspan="2">2.2a&nbsp;&nbsp;&nbsp;Regular </td>
          <td class="tg-8d8j" rowspan="2"> <br></td>
          <td class="tg-8d8j" rowspan="2"> <br></td>
          <td class="tg-8d8j" rowspan="2"> <br></td>
          <td class="tg-8d8j" colspan="2" rowspan="2"> <br> </td>
          <td class="tg-8d8j" colspan="2" rowspan="2"> <br> </td>
        </tr>
        <tr>
        </tr>
        <tr>
          <td class="tg-cly1" rowspan="2">2.2b&nbsp;&nbsp;&nbsp;Part-time</td>
          <td class="tg-8d8j" rowspan="2"> <br></td>
          <td class="tg-8d8j" rowspan="2"> <br></td>
          <td class="tg-8d8j" rowspan="2"> <br></td>
          <td class="tg-8d8j" colspan="2" rowspan="2"> <br> </td>
          <td class="tg-8d8j" colspan="2" rowspan="2"> <br> </td>
        </tr>
        <tr>
        </tr>
        <tr>
          <td class="tg-0lax" colspan="3" rowspan="2">Total Employment for this Quarter: </td>
          <td class="tg-cly1" colspan="2" rowspan="2">No. of Personnel: </td>
          <td class="tg-cly1" colspan="3" rowspan="2">No. of Man-Months:</td>
        </tr>
        <tr>
        </tr>
        <tr>
          <td class="tg-1wig" colspan="8" rowspan="2">3.0&nbsp;&nbsp;&nbsp;Production And Sales Data For The Quanter</td>
        </tr>
        <tr>
        </tr>
        <tr>
          <td class="tg-8d8j" rowspan="3"> <br><br></td>
          <td class="tg-baqh" rowspan="3">Name of&nbsp;&nbsp;&nbsp;Product </td>
          <td class="tg-baqh" rowspan="3">Packaging&nbsp;&nbsp;&nbsp;Details</td>
          <td class="tg-baqh" rowspan="3">Volume&nbsp;&nbsp;&nbsp;of Production</td>
          <td class="tg-baqh" colspan="2" rowspan="3">Gross Sales </td>
          <td class="tg-baqh" rowspan="3">Estimated&nbsp;&nbsp;&nbsp;Cost of Production</td>
          <td class="tg-baqh" rowspan="3">Net Sales</td>
        </tr>
        <tr>
        </tr>
        <tr>
        </tr>
        <tr>
          <td class="tg-0lax" rowspan="6">3.1 Export Market</td>
          <td class="tg-8d8j" rowspan="2"> <br></td>
          <td class="tg-8d8j" rowspan="2"> <br></td>
          <td class="tg-8d8j" rowspan="2"> <br></td>
          <td class="tg-8d8j" colspan="2" rowspan="2"> <br> </td>
          <td class="tg-8d8j" rowspan="2"> <br></td>
          <td class="tg-8d8j" rowspan="2"> <br></td>
        </tr>
        <tr>
        </tr>
        <tr>
          <td class="tg-8d8j" rowspan="2"> <br></td>
          <td class="tg-8d8j" rowspan="2"> <br></td>
          <td class="tg-8d8j" rowspan="2"> <br></td>
          <td class="tg-8d8j" colspan="2" rowspan="2"> <br> </td>
          <td class="tg-8d8j" rowspan="2"> <br></td>
          <td class="tg-8d8j" rowspan="2"> <br></td>
        </tr>
        <tr>
        </tr>
        <tr>
          <td class="tg-8d8j" rowspan="2"> <br></td>
          <td class="tg-8d8j" rowspan="2"> <br></td>
          <td class="tg-8d8j" rowspan="2"> <br></td>
          <td class="tg-8d8j" colspan="2" rowspan="2"> <br> </td>
          <td class="tg-8d8j" rowspan="2"> <br></td>
          <td class="tg-8d8j" rowspan="2"> <br></td>
        </tr>
        <tr>
        </tr>
        <tr>
          <td class="tg-0lax" rowspan="6">3.2 Local Market</td>
          <td class="tg-8d8j" rowspan="2"> <br></td>
          <td class="tg-8d8j" rowspan="2"> <br></td>
          <td class="tg-8d8j" rowspan="2"> <br></td>
          <td class="tg-8d8j" colspan="2" rowspan="2"> <br> </td>
          <td class="tg-8d8j" rowspan="2"> <br></td>
          <td class="tg-8d8j" rowspan="2"> <br></td>
        </tr>
        <tr>
        </tr>
        <tr>
          <td class="tg-8d8j" rowspan="2"> <br></td>
          <td class="tg-8d8j" rowspan="2"> <br></td>
          <td class="tg-8d8j" rowspan="2"> <br></td>
          <td class="tg-8d8j" colspan="2" rowspan="2"> <br> </td>
          <td class="tg-8d8j" rowspan="2"> <br></td>
          <td class="tg-8d8j" rowspan="2"> <br></td>
        </tr>
        <tr>
        </tr>
        <tr>
          <td class="tg-8d8j" rowspan="2"> <br></td>
          <td class="tg-8d8j" rowspan="2"> <br></td>
          <td class="tg-8d8j" rowspan="2"> <br></td>
          <td class="tg-8d8j" colspan="2" rowspan="2"> <br> </td>
          <td class="tg-8d8j" rowspan="2"> <br></td>
          <td class="tg-8d8j" rowspan="2"> <br></td>
        </tr>
        <tr>
        </tr>
        <tr>
          <td class="tg-cly1" colspan="4" rowspan="2">TOTAL </td>
          <td class="tg-8d8j" colspan="2" rowspan="2"> <br> </td>
          <td class="tg-8d8j" rowspan="2"> <br></td>
          <td class="tg-8d8j" rowspan="2"> <br></td>
        </tr>
        <tr>
        </tr>
        <tr>
          <td class="tg-yla0" colspan="8" rowspan="2">4.0 MARKET&nbsp;&nbsp;&nbsp;OUTLETS</td>
        </tr>
        <tr>
        </tr>
        <tr>
          <td class="tg-cly1" rowspan="2">4.1&nbsp;&nbsp;&nbsp;Export</td>
          <td class="tg-8d8j" colspan="7" rowspan="2"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        </tr>
        <tr>
        </tr>
        <tr>
          <td class="tg-cly1" rowspan="2">4.2&nbsp;&nbsp;&nbsp;Local</td>
          <td class="tg-8d8j" colspan="7" rowspan="2"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        </tr>
        <tr>
        </tr>
        <br>
        <tr>
          <td colspan="8" style="height: 10px; border-left: none; border-right: none;">&nbsp;</td>
        </tr>
        <tr>
          <td class="tg-vkv7" colspan="8" rowspan="2">TO BE&nbsp;&nbsp;&nbsp;ACCOMPLISHED BY DOST XI</td>
        </tr>
        <tr>
        </tr>
        <tr>
          <td class="tg-baqh" colspan="2" rowspan="4">Gross Sales Generated = Gross Sales Q4 - Gross Sales Q3</td>
          <td class="tg-baqh" colspan="2" rowspan="3">Gross Sales&nbsp;&nbsp;&nbsp;Q4(for the reporting period)</td>
          <td class="tg-baqh" colspan="2" rowspan="3">Cross Sales&nbsp;&nbsp;&nbsp;Q3(Previous Quarter)</td>
          <td class="tg-baqh" colspan="2" rowspan="3">TOTAL GROSS&nbsp;&nbsp;&nbsp;SALES GENERATED</td>
        </tr>
        <tr>
        </tr>
        <tr>
        </tr>
        <tr>
          <td class="tg-8d8j" colspan="2"> </td>
          <td class="tg-8d8j" colspan="2"> </td>
          <td class="tg-8d8j" colspan="2"> </td>
        </tr>
        <tr>
          <td class="tg-0lax" colspan="2" rowspan="4">% Increase in Productivity Generated = ((Gross Sales Q4 - Gross&nbsp;&nbsp;&nbsp;Sales Q3)/Gross Sales) X 100 </td>
          <td class="tg-8d8j" colspan="6" rowspan="4"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        </tr>
        <tr>
        </tr>
        <tr>
        </tr>
        <tr>
        </tr>
        <tr>
          <td class="tg-0lax" colspan="2" rowspan="3">Employment Generated = Employment Q4 - Employment Q3</td>
          <td class="tg-8d8j" colspan="2" rowspan="2">Total&nbsp;&nbsp;&nbsp;Employment Q4(For the reporting period)</td>
          <td class="tg-8d8j" colspan="2" rowspan="2">Total&nbsp;&nbsp;&nbsp;Employment Q3 (previous quarter)</td>
          <td class="tg-baqh" colspan="2" rowspan="2">EMPLOYMENT&nbsp;&nbsp;&nbsp;GENERATED </td>
        </tr>
        <tr>
        </tr>
        <tr>
          <td class="tg-8d8j" colspan="2"> </td>
          <td class="tg-8d8j" colspan="2"> </td>
          <td class="tg-8d8j" colspan="2"> </td>
        </tr>
        <tr>
          <td class="tg-8d8j" colspan="2" rowspan="3">% Increase in Employment Generated = ((Employment Q4 -&nbsp;&nbsp;&nbsp;Employment Q3)/Employment Q3) X 100 </td>
          <td class="tg-8d8j" colspan="6" rowspan="3"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        </tr>
        <tr>
        </tr>
        <tr>
        </tr>
      </tbody>
    </table>
  </div>
</div>

