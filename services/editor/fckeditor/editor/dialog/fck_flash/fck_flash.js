var dialog=window.parent;var oEditor=dialog.InnerDialogLoaded();var FCK=oEditor.FCK;var FCKLang=oEditor.FCKLang;var FCKConfig=oEditor.FCKConfig;var FCKTools=oEditor.FCKTools;dialog.AddTab("Info",oEditor.FCKLang.DlgInfoTab);if(FCKConfig.FlashUpload){dialog.AddTab("Upload",FCKLang.DlgLnkUpload)}if(!FCKConfig.FlashDlgHideAdvanced){dialog.AddTab("Advanced",oEditor.FCKLang.DlgAdvancedTag)}function OnDialogTabChange(A){ShowE("divInfo",(A=="Info"));ShowE("divUpload",(A=="Upload"));ShowE("divAdvanced",(A=="Advanced"))}var oFakeImage=dialog.Selection.GetSelectedElement();var oEmbed;if(oFakeImage){if(oFakeImage.tagName=="IMG"&&oFakeImage.getAttribute("_fckflash")){oEmbed=FCK.GetRealElement(oFakeImage)}else{oFakeImage=null}}window.onload=function(){oEditor.FCKLanguageManager.TranslatePage(document);LoadSelection();GetE("tdBrowse").style.display=FCKConfig.FlashBrowser?"":"none";if(FCKConfig.FlashUpload){GetE("frmUpload").action=FCKConfig.FlashUploadURL}dialog.SetAutoSize(true);dialog.SetOkButton(true);SelectField("txtUrl")};function LoadSelection(){if(!oEmbed){return}GetE("txtUrl").value=GetAttribute(oEmbed,"src","");GetE("txtWidth").value=GetAttribute(oEmbed,"width","");GetE("txtHeight").value=GetAttribute(oEmbed,"height","");GetE("txtAttId").value=oEmbed.id;GetE("chkAutoPlay").checked=GetAttribute(oEmbed,"play","true")=="true";GetE("chkLoop").checked=GetAttribute(oEmbed,"loop","true")=="true";GetE("chkMenu").checked=GetAttribute(oEmbed,"menu","true")=="true";GetE("cmbScale").value=GetAttribute(oEmbed,"scale","").toLowerCase();GetE("txtAttTitle").value=oEmbed.title;if(oEditor.FCKBrowserInfo.IsIE){GetE("txtAttClasses").value=oEmbed.getAttribute("className")||"";GetE("txtAttStyle").value=oEmbed.style.cssText}else{GetE("txtAttClasses").value=oEmbed.getAttribute("class",2)||"";GetE("txtAttStyle").value=oEmbed.getAttribute("style",2)||""}UpdatePreview()}function Ok(){if(GetE("txtUrl").value.length==0){dialog.SetSelectedTab("Info");GetE("txtUrl").focus();alert(oEditor.FCKLang.DlgAlertUrl);return false}oEditor.FCKUndo.SaveUndoStep();if(!oEmbed){oEmbed=FCK.EditorDocument.createElement("EMBED");oFakeImage=null}UpdateEmbed(oEmbed);if(!oFakeImage){oFakeImage=oEditor.FCKDocumentProcessor_CreateFakeImage("FCK__Flash",oEmbed);oFakeImage.setAttribute("_fckflash","true",0);oFakeImage=FCK.InsertElement(oFakeImage)}oEditor.FCKEmbedAndObjectProcessor.RefreshView(oFakeImage,oEmbed);return true}function UpdateEmbed(A){SetAttribute(A,"type","application/x-shockwave-flash");SetAttribute(A,"pluginspage","http://www.macromedia.com/go/getflashplayer");SetAttribute(A,"src",GetE("txtUrl").value);SetAttribute(A,"width",GetE("txtWidth").value);SetAttribute(A,"height",GetE("txtHeight").value);SetAttribute(A,"id",GetE("txtAttId").value);SetAttribute(A,"scale",GetE("cmbScale").value);SetAttribute(A,"play",GetE("chkAutoPlay").checked?"true":"false");SetAttribute(A,"loop",GetE("chkLoop").checked?"true":"false");SetAttribute(A,"menu",GetE("chkMenu").checked?"true":"false");SetAttribute(A,"title",GetE("txtAttTitle").value);if(oEditor.FCKBrowserInfo.IsIE){SetAttribute(A,"className",GetE("txtAttClasses").value);A.style.cssText=GetE("txtAttStyle").value}else{SetAttribute(A,"class",GetE("txtAttClasses").value);SetAttribute(A,"style",GetE("txtAttStyle").value)}}var ePreview;function SetPreviewElement(A){ePreview=A;if(GetE("txtUrl").value.length>0){UpdatePreview()}}function UpdatePreview(){if(!ePreview){return}while(ePreview.firstChild){ePreview.removeChild(ePreview.firstChild)}if(GetE("txtUrl").value.length==0){ePreview.innerHTML="&nbsp;"}else{var A=ePreview.ownerDocument||ePreview.document;var B=A.createElement("EMBED");SetAttribute(B,"src",GetE("txtUrl").value);SetAttribute(B,"type","application/x-shockwave-flash");SetAttribute(B,"width","100%");SetAttribute(B,"height","100%");ePreview.appendChild(B)}}function BrowseServer(){OpenFileBrowser(FCKConfig.FlashBrowserURL,FCKConfig.FlashBrowserWindowWidth,FCKConfig.FlashBrowserWindowHeight)}function SetUrl(B,C,A){GetE("txtUrl").value=B;if(C){GetE("txtWidth").value=C}if(A){GetE("txtHeight").value=A}UpdatePreview();dialog.SetSelectedTab("Info")}function OnUploadCompleted(C,A,D,B){window.parent.Throbber.Hide();GetE("divUpload").style.display="";switch(C){case 0:alert("Your file has been successfully uploaded");break;case 1:alert(B);return;case 101:alert(B);break;case 201:alert('A file with the same name is already available. The uploaded file has been renamed to "'+D+'"');break;case 202:alert("Invalid file type");return;case 203:alert("Security error. You probably don't have enough permissions to upload. Please check your server.");return;case 500:alert("The connector is disabled");break;default:alert("Error on file upload. Error number: "+C);return}SetUrl(A);GetE("frmUpload").reset()}var oUploadAllowedExtRegex=new RegExp(FCKConfig.FlashUploadAllowedExtensions,"i");var oUploadDeniedExtRegex=new RegExp(FCKConfig.FlashUploadDeniedExtensions,"i");function CheckUpload(){var A=GetE("txtUploadFile").value;if(A.length==0){alert("Please select a file to upload");return false}if((FCKConfig.FlashUploadAllowedExtensions.length>0&&!oUploadAllowedExtRegex.test(A))||(FCKConfig.FlashUploadDeniedExtensions.length>0&&oUploadDeniedExtRegex.test(A))){OnUploadCompleted(202);return false}window.parent.Throbber.Show(100);GetE("divUpload").style.display="none";return true};