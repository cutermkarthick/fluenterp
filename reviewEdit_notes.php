
 <table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF">
        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Order Stage Details</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Review refno</font></td>
            <td><span class="tabletext"><input type="text" name="refno"  style=";background-color:#DDDDDD;"
                    readonly="readonly" size=30 value="<?php echo $myrow4review["refno"] ?>"></td>
            <td colspan=2>&nbsp;</td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Order Type</td>
            <td><span class="tabletext"><input type="text" name="ordertype" size=30 value="<?php echo htmlspecialchars($myrow4review["ordertype"]) ?>" readonly></td>
             <td><span class="labeltext"><span class='asterisk'>*</span>Contact Person</font></td>
            <td><span class="tabletext"><input type="text" name="person" size=30 value="<?php echo $myrow4review["person"] ?>" readonly></td>
            <input type="hidden" name="reviewrecnum" value="<?php echo $myrow4review["recnum"]  ?>">
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Order Stored in the form of</td>
            <td><span class="tabletext"><input type="text" name="data_store" size=30 value="<?php echo $myrow4review["data_store"] ?>" readonly></td>
            <td><span class="labeltext">Filename/Path</font></td>
            <td><span class="tabletext"><input type="text" name="path" size=30 value="<?php echo $myrow4review["path"] ?>" readonly></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Order for</td>
            <td><span class="tabletext"><input type="text" name="orderfor" size=30 value="<?php echo htmlspecialchars($myrow4review["orderfor"]) ?>" readonly></td>
            <td><span class="labeltext">Attachments</font></td>
            <td><span class="tabletext"><input type="text" name="attachment1" size=30 value="<?php echo $myrow4review["attachment1"] ?>" readonly></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">No. of Parts</p></font></td>
            <td><span class="tabletext"><input type="text" name="numofparts" size=30 value="<?php echo $myrow4review["numofparts"] ?>" readonly></td>
            <td><span class="labeltext">Classification of Parts</td>
            <td><span class="tabletext"><input type="text" name="parts_class" size=30 value="<?php echo $myrow4review["class"] ?>" readonly></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Raw material supplied by Customer or to be Procured</font></td>
            <td><span class="tabletext"><input type="text" name="rawmaterial" size=30 value="<?php echo $myrow4review["rawmaterial"] ?>" readonly></td>
            <td><span class="labeltext">Source of Raw Material planned</td>
            <td><span class="tabletext"><input type="text" name="source" size=30 value="<?php echo $myrow4review["source"] ?>" readonly></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Create Date</p></font></td>
            <td><span class="tabletext"><input type="text" name="create_date" size=20 value="<?php echo $myrow4review["create_date"] ?>" readonly="readonly" style="background-color:#DDDDDD;">
			<!--
                                 <img src="images/bu-getdate.gif" alt="Get BookDate" onclick="GetDate('create_date')">--></td>
            <td><span class="labeltext">Created By</td>
            <td><span class="tabletext"><input type="text" name="created_by" size=30 value="<?php echo $myrow4review["fname"] ?>" readonly="readonly" style="background-color:#DDDDDD;"></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Engineering Approved</font></td>
            <input type="hidden" name="userid" id="userid" value="<?php echo $userid;?>"></td>
   <?php
     $checked="checked";
     $_SESSION['pagename'];
   ?>
        <td bgcolor="#FFFFFF"><input type="checkbox" <?php echo $myrow4review["engineering_approved"] == 'yes'?$checked:"" ?>  name="engineering_approved" disabled>
                         <input type="hidden" name="eng_app" value="<?php echo $myrow4review["engineering_approved"]?>" id="eng_app">
                         <input type="hidden" name="eng_app_by" id="eng_app_by" value="<?php echo $myrow4review["engg_app_by"]?>"></td></td>


        <td><span class="labeltext">QA Approved</td>
        <td bgcolor="#FFFFFF"><input type="checkbox" <?php echo $myrow4review["qa_approved"] == 'yes'?$checked:"" ?> name="qa_approved" disabled>
                         <input type="hidden" name="qa_app" value="<?php echo $myrow4review["qa_approved"]?>" id="qa_app">
                         <input type="hidden" name="qa_app_by" id="qa_app_by" value="<?php echo $myrow4review["qa_app_by"]?>"></td>
    </tr>
   </tr>
    <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Engg Approved By</p></font></td>
            <td><span class="tabletext"><input type="text" size=20 value="<?php echo $myrow4review["engg_app_by"] ?>" readonly="readonly" style="background-color:#DDDDDD;"></td>
            <td><span class="labeltext">QA Approved By</td>
            <td><span class="tabletext"><input type="text" size=30 value="<?php echo $myrow4review["qa_app_by"] ?>" readonly="readonly" style="background-color:#DDDDDD;"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
    <td><span class="labeltext">Validation Status</font></td>
    <td><span class="tabletext"><input type="text" name="val_status" size=30 value="<?php echo $myrow4review["val_status"]?>" readonly="readonly" style="background-color:#DDDDDD;"></td>
    <td colspan=2>&nbsp;</td>
    </tr>


      <?php	 
         printf('<tr  bgcolor="#DDDEDD"><td colspan=4><span class="heading"><b>Notes for %s</b></center></td></tr>',$myrow[16]);
         $result = $newreview->getNotes($reviewrecnum);
         printf('<tr bgcolor="#FFFFFF"><td colspan=8><textarea name="notes1" rows="6" cols="88"  readonly="readonly">');
         while ($mynotes = mysql_fetch_row($result))
         {
          print("\n");
          print("********Added by $mynotes[2] on $mynotes[1]*********** ");
          print("\n");
          print($mynotes[0]);
          print("   \n");
         }
      ?>
      </textarea></td>
      </tr>

     <?php 
	  if($_SESSION['department'] =='Sales')
	  {
	 printf('<tr bgcolor="#DDDEDD"><td colspan=4><span class="heading"><b>Add Notes</b></center></td></tr>'); ?>
      <tr bgcolor="#FFFFFF">
       <td colspan=4><textarea name="notes" rows="3" cols="88%" value=""></textarea>
       </td> </tr>
	   <?}?>



	    <?php
         printf('<tr  bgcolor="#DDDEDD"><td colspan=4><span class="heading"><b>Notes for Production</b></center></td></tr>',$myrow[16]);
         $result = $newreview->getNotes_type($reviewrecnum,'prodn');
         printf('<tr bgcolor="#FFFFFF"><td colspan=8><textarea name="notes1" rows="6" cols="88"  readonly="readonly">');
         while ($mynotes = mysql_fetch_row($result))
         {
          print("\n");
          print("********Added by $mynotes[2] on $mynotes[1]*********** ");
          print("\n");
          print($mynotes[0]);
          print("   \n");
         }
      ?>
      </textarea></td>
      </tr>

     <?php 
	  if($_SESSION['department'] =='Production')
	  {
	 printf('<tr bgcolor="#DDDEDD"><td colspan=4><span class="heading"><b>Add Prodn. Notes</b></center></td></tr>'); ?>
      <tr bgcolor="#FFFFFF">
       <td colspan=4><textarea name="notes" rows="3" cols="88%" value=""></textarea>
       </td></tr>
	   <?php }
         printf('<tr  bgcolor="#DDDEDD"><td colspan=4><span class="heading"><b>Notes for QA</b></center></td></tr>',$myrow[16]);
         $result = $newreview->getNotes_type($reviewrecnum,'qa');
         printf('<tr bgcolor="#FFFFFF"><td colspan=8><textarea name="notes1" rows="6" cols="88"  readonly="readonly">');
         while ($mynotes = mysql_fetch_row($result))
         {
          print("\n");
          print("********Added by $mynotes[2] on $mynotes[1]*********** ");
          print("\n");
          print($mynotes[0]);
          print("   \n");
         }
      ?>
      </textarea></td>
      </tr>
     <?php 
	 if($_SESSION['department'] =='QA')
	  {
	 printf('<tr bgcolor="#DDDEDD"><td colspan=4><span class="heading"><b>Add QA Notes</b></center></td></tr>'); ?>
      <tr bgcolor="#FFFFFF">
       <td colspan=4><textarea name="notes" rows="3" cols="88%" value=""></textarea>
       </td> </tr>
	   	  <?php }
         printf('<tr  bgcolor="#DDDEDD"><td colspan=4><span class="heading"><b>Notes for Eng.</b></center></td></tr>',$myrow[16]);
         $result = $newreview->getNotes_type($reviewrecnum,'eng');
         printf('<tr bgcolor="#FFFFFF"><td colspan=8><textarea name="notes1" rows="6" cols="88"  readonly="readonly">');
         while ($mynotes = mysql_fetch_row($result))
         {
          print("\n");
          print("********Added by $mynotes[2] on $mynotes[1]*********** ");
          print("\n");
          print($mynotes[0]);
          print("   \n");
         }
      ?>
      </textarea></td>
      </tr>
     <?php 	
	  if($_SESSION['department'] =='CAD' || $_SESSION['department'] =='ENGAPP')
	  {
	  printf('<tr bgcolor="#DDDEDD"><td colspan=4><span class="heading"><b>Add Eng Notes</b></center></td></tr>'); ?>
      <tr bgcolor="#FFFFFF">
      <td colspan=4><textarea name="notes" rows="3" cols="88%" value=""></textarea>
      </td></tr>
	  <?}?>

        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Purchase Order Requirements</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Any resources required apart from the existing for this enquiry?
                         <br>Provide Details</td>
            <td colspan=2><span class="tabletext"><input type="text" name="resources" size=90 value="<?php echo $myrow4review["resources"] ?>" readonly></td>
        </tr>
        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Quality</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Are quality requirements clear?
                       <br><b>Is it In-line with Organization or Specific</td>
            <td colspan=2><span class="tabletext"><input type="text" name="qualityreq" size=90 value="<?php echo $myrow4review["qualityreq"] ?>" readonly></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Comments on Specific Requirements</font></td>
            <td colspan=2><span class="tabletext"><input type="text" name="saliant" size=90 value="<?php echo $myrow4review["saliant"] ?>" readonly></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Any additional resources required for quality<br>
                in terms of Resources/Equipment/Infrastructure? Explain.</td>
            <td colspan=2><span class="tabletext"><input type="text" name="aditional_resources" size=90 value="<?php echo $myrow4review["aditional_resources"] ?>" readonly></td>
        </tr>

        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Outsourcing Activity</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Any Outsourcing/Subcontracting activity needs to be planned?<br>
                   If yes, provide details</font></td>
            <td colspan=2><span class="tabletext"><input type="text" name="subcontract" size=90 value="<?php echo $myrow4review["subcontract"] ?>" readonly></td>
        </tr>
        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Special Processes</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Is there any special process involved?<br>If yes, provide details</font></td>
            <td colspan=2><span class="tabletext"><input type="text" name="special_process" size=90 value="<?php echo $myrow4review["special_process"] ?>" readonly></td>
        </tr>
        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Delivery Requirements</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Are delivery requirements of the Enquiry Clear?</font></td>
            <td colspan=2><span class="tabletext"><input type="text" name="delivery_req" size=90 value="<?php echo $myrow4review["delivery_req"] ?>" readonly></td>
        </tr>
        <tr bgcolor="#DDDEDD">
            <td colspan=5><span class="heading"><center><b>Risk Analysis</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Do you foresee any Risk as to the requirements of this<br>
                        Enquiry? If YES, state the probable Risk factor</td>
            <td colspan=2><span class="tabletext"><input type="text" name="risk_factors" size=90 value="<?php echo $myrow4review["risk_factors"] ?>" readonly></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Explain the Risk Factor</td>
            <td colspan=2><span class="tabletext"><input type="text" name="explain_risk_factors" size=90 value="<?php echo $myrow4review["explain_risk_factors"] ?>" readonly></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Are any statutory or regulatory requirements applicable? If yes explain</font></td>
            <td colspan=2><span class="tabletext"><input type="text" name="requirements" size=90 value="<?php echo $myrow4review["requirements"] ?>" readonly></td>
        </tr>
        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Quotation Details</b></center></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Quote Reference No.</font></td>
            <td><span class="tabletext"><input type="text" name="quotation" size=30 value="<?php echo $myrow4review["quotation"] ?>" readonly></td>
            <td><span class="labeltext">Quote Sent by</td>
            <td><span class="tabletext"><input type="text" name="quote_sentby" size=30 value="<?php echo $myrow4review["quote_sentby"] ?>" readonly></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Details of Quotation/Estimation stored in</td>
            <td colspan=2><span class="tabletext"><input type="text" name="quotation_det_store" size=90 value="<?php echo $myrow4review["quotation_det_store"] ?>" readonly></td>
        </tr>

        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Data Storage</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Data related to Enquiry stored in</td>
            <td colspan=2><span class="tabletext"><input type="text" name="data_for_enquiry" size=90 value="<?php echo $myrow4review["data_for_enquiry"] ?>" readonly></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Mention the Filename/Path</td>
            <td colspan=2><span class="tabletext"><input type="text" name="enquiry_path" size=90 value="<?php echo $myrow4review["enquiry_path"] ?>"readonly></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Data related to Quote stored in</td>
            <td colspan=2><span class="tabletext"><input type="text" name="data_for_quote" size=90 value="<?php echo $myrow4review["data_for_quote"] ?>"  readonly></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Mention Filename/Path</td>
            <td colspan=2><span class="tabletext"><input type="text" name="quote_path" size=90 value="<?php echo $myrow4review["quote_path"] ?>" readonly></td>
        </tr>
