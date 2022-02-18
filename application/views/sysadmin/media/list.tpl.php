<?php include("app/view/admin/header.inc.php"); ?>
<link href="http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700" rel='stylesheet' />
<link href="css/media-style.css?" rel="stylesheet" />
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
<tr>
  <td width="180" valign="top" class="rightBorder menuBackground"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center" width="180"><?php include("app/view/admin/left-menu.inc.php");?></td>
      </tr>
      <tr>
        <td width="23">&nbsp;</td>
      </tr>
    </table>
    <br />
    <br /></td>
  <td width="1"><img src="images/spacer.gif" width="1" height="1" /></td>
  <td width="1"><img src="images/spacer.gif" width="1" height="1" /></td>
  <td height="400" align="center" valign="top"><table width="98%"  border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="21" align="left" class="txt"><table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" class="title">
        <tr>
          <td width="73%" height="25" class="txt2 pad-left12"><img src="images/admin.png" width="27" height="24" align="absmiddle" />Manage Users</td>
          <td width="27%" align="right" style="padding-right:20px; ">
		 </td>
          <div id="media-upload-container">
			<form id="upload" method="post" action="<?php echo $this->buildUrl('media/upload'); ?>" enctype="multipart/form-data">
			  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
              <div id="drop"> Drop Here <br /><a>Browse</a>
				<input type="file" name="upl" multiple id="file-input"/>
			  </div>
			  <ul id="file-list">
				<!-- The file uploads will be shown here -->
			  </ul>
			</form>
			<?php echo $this->tempVars['media_browser']; ?>
			 <div id="event_pics">
		  
		  </div>
         </div>
</tr>
</table>
</td>
</tr>
<tr>
  <td height="400" align="center" valign="top"><table width="100%" border="0" cellpadding="5" cellspacing="0">
    </table></td>
</tr>
</table>
</td>
</tr>
</table>
<?php include("app/view/admin/footer.inc.php");?>
