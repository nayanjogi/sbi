/*
errMsgId~NOBLANK~Name
errMsgId~LENGTH~Name~4~ALLOWBLANK (3rd must be number of digit)
errMsgId~CAPTCHA~Security Code
errMsgId~EMAIL~Contact Email~ALLOWBLANK 
errMsgId~WEBSITE~Site URL~ALLOWBLANK 
errMsgId~SEOPAGE~Page URL~ALLOWBLANK 
errMsgId~PHONE~Site URL~ALLOWBLANK 
errMsgId~PRICE~Site URL~ALLOWBLANK 
errMsgId~NUMERIC~Number
errMsgId~NUMERICNONZERO~Number
errMsgId~ALPHANUMERIC~Alpha
errMsgId~IMAGEFILE~Product Photo~ALLOWBLANK
errMsgId~USERNAME~Username
errMsgId~PASSWORD~Password
errMsgId~CONFIRMPWD~password(name of password)
errMsgId~CHECKBOX
errMsgId~RADIO~Gender
*/
var OldId,oldObj,first=0;
var strMsg='';


function validate(frm, confirmation)
{
	if(!validateForm(frm,confirmation)){
      return false;
	}else{
	  return true;	 
	}
}

function validateFormNew(formValObj){
strMsg='';
	OldId='';
	oldObj='';
	first=0;
	errormsg=0;
for(var i=0;i<formValObj.elements.length;i++)
	 {
		keyAll = (formValObj.elements[i].getAttribute('class')); 		
	  	if(keyAll != 'button')
		{ 
			if(keyAll)
			{ 
					keyOneArray = keyAll.split("~");						
					keyOneErrId = keyOneArray[0]; 
					keyOneRule = keyOneArray[1]; 
					keyOneMessage = (keyOneArray[2])?(keyOneArray[2]):('');
					keyOneName = formValObj.elements[i].getAttribute('name');					
					keyOneValue = formValObj.elements[i].value;
					keyOneObj = formValObj.elements[i];
					if(!isVisible(keyOneObj))
					{
						continue;
					}		

					switch(keyOneRule)
					{							
                         case "NOBLANK" :							   
                              if(keyOneValue=="")
							  { 
								   showKeyMessage(keyOneObj,keyOneErrId,"Please Enter "+keyOneMessage);					   
								   errormsg+=1;                                   
                              }
							  else
							  { 
								  showKeyMessage(keyOneObj,keyOneErrId,'');
							  }							  
                              break;							  
                       case "LENGTH" :
					   		if(keyOneValue=="" && !inArray('ALLOWBLANK',keyOneArray))
							{
								showKeyMessage(keyOneObj,keyOneErrId,"Please Enter "+keyOneMessage);								   
								errormsg+=1;
							}
							else
							{
							   if(keyOneValue.length!=keyOneArray[3] && keyOneValue!="")
							   {
								   showKeyMessage(keyOneObj,keyOneErrId,"Please Enter "+ keyOneArray[3] +" letters for "+keyOneMessage);	   
								   errormsg+=1;                                   
                               }
							   else
							   {
								  showKeyMessage(keyOneObj,keyOneErrId,'');
							   }	
							}
                            break;	
					   case "DUALCAPTCHA" :							
							if(keyOneValue=="")
							{
								showKeyMessage(keyOneObj,keyOneErrId,"Please Enter "+keyOneMessage);						   
								errormsg+=1;
							}
							else
							{ 								
								var output = $.ajax({									   
								  url: "capcha/request.php",
								  async: false,
								  data: "capcha="+keyOneValue								 
								});									
								var captchamsg = output.responseText;
								//alert(captchamsg);
								if(captchamsg=='E')
								{											
									 showKeyMessage(keyOneObj,keyOneErrId,"Please Enter valid security code");	
									errormsg+=1;										
								}
								if(captchamsg=='S')
								{
									showKeyMessage(keyOneObj,keyOneErrId,'');
								}								
							}
                            break;	
					   case "CAPTCHA" :
					   		if(keyOneValue=="")
							{
								showKeyMessage(keyOneObj,keyOneErrId,"Please Enter "+keyOneMessage);								   
								errormsg+=1;
							}
							else // errMsgId~CAPTCHA~Security Code
							{
							   var validCaptcha;
							   // call ajax
							   $.ajax({
								  url: SITE_URL+"ajax.php",
								  data: "action=validate_captcha&code="+keyOneValue,
								  async: false,
								  success: function(msg){
									 if(msg == 'match')
									 {
										validCaptcha = true;
									 }
									 else
									 {
										 validCaptcha = false;
									 }
								  }
								});	
							   
							   if(keyOneValue!="" && !validCaptcha)
							   {
								   showKeyMessage(keyOneObj,keyOneErrId,"Please Enter valid security code");	   
								   errormsg+=1;                                   
                               }
							   else
							   {
								  showKeyMessage(keyOneObj,keyOneErrId,'');
							   }	
							}
                            break;	
					   case "EMAIL" :					   		
					   		if(keyOneValue=="" && !inArray('ALLOWBLANK',keyOneArray))
							{
								showKeyMessage(keyOneObj,keyOneErrId,"Please Enter "+keyOneMessage);								   
								errormsg+=1;
							}
							else
							{ 
							   if(!validateEmail(keyOneObj) && keyOneValue!="")
							   {
                                   showKeyMessage(keyOneObj,keyOneErrId,"Please Enter Valid "+keyOneMessage);	   
								   errormsg+=1;
                               }
							   else
							   {
								  showKeyMessage(keyOneObj,keyOneErrId,'');
							   }
							}
                            break;	 							  
						case "WEBSITE" :	
							if(keyOneValue=="" && !inArray('ALLOWBLANK',keyOneArray))
							{
								showKeyMessage(keyOneObj,keyOneErrId,"Please Enter "+keyOneMessage);								   
								errormsg+=1;
							}
							else
							{ 
							   if(!validURL(keyOneObj) && keyOneValue!="")
							   {
                                   showKeyMessage(keyOneObj,keyOneErrId,"Please Enter Valid "+keyOneMessage+" (start with http://www. ) ");	   
								   errormsg+=1;
                               }
							   else
							   {
								  showKeyMessage(keyOneObj,keyOneErrId,'');
							   }
							}
                       		break;
							
						case "SEOPAGE" :	
							if(keyOneValue=="" && !inArray('ALLOWBLANK',keyOneArray))
							{
								showKeyMessage(keyOneObj,keyOneErrId,"Please Enter "+keyOneMessage);								   
								errormsg+=1;
							}
							else
							{ 
							   if(!validSeoPage(keyOneObj) && keyOneValue!="" && keyOneValue!="#")
							   {
                                   showKeyMessage(keyOneObj,keyOneErrId,"Please Enter Valid "+keyOneMessage);	   
								   errormsg+=1;
                               }
							   else
							   {
								  showKeyMessage(keyOneObj,keyOneErrId,'');
							   }
							}
                       		break;
						
						case "PHONE" :	
							if(keyOneValue=="" && !inArray('ALLOWBLANK',keyOneArray))
							{
								showKeyMessage(keyOneObj,keyOneErrId,"Please Enter "+keyOneMessage);						   
								errormsg+=1;
							}
							else
							{ 								
							   if(!validPhone(keyOneObj) && keyOneValue!="")
							   {
                                   showKeyMessage(keyOneObj,keyOneErrId,"Please Enter Valid "+keyOneMessage);	   
								   errormsg+=1;
                               }
							   else
							   {
								  showKeyMessage(keyOneObj,keyOneErrId,'');
							   }
							}       
							break;
						case "PRICE" :	
							if(keyOneValue=="" && !inArray('ALLOWBLANK',keyOneArray))
							{
								showKeyMessage(keyOneObj,keyOneErrId,"Please Enter "+keyOneMessage);								   
								errormsg+=1;
							}
							else
							{ 
							   if(!validPrice(keyOneObj) && keyOneValue!="")
							   {
                                   showKeyMessage(keyOneObj,keyOneErrId,"Please Enter Valid "+keyOneMessage);	   
								   errormsg+=1;
                               }
							   else
							   {
								  showKeyMessage(keyOneObj,keyOneErrId,'');
							   }
							}
                        	break;
						case "NUMERIC" :	
							if(keyOneValue=="" && !inArray('ALLOWBLANK',keyOneArray))
							{
								showKeyMessage(keyOneObj,keyOneErrId,"Please Enter "+keyOneMessage);								   
								errormsg+=1;
							}
							else
							{ 
							   if(!validNumeric(keyOneObj) && keyOneValue!="")
							   {
                                   showKeyMessage(keyOneObj,keyOneErrId,"Please Enter Valid "+keyOneMessage);	   
								   errormsg+=1;
                               }
							   else
							   {
								  showKeyMessage(keyOneObj,keyOneErrId,'');
							   }
							}
                        	break;
						case "NUMERICNONZERO" :	
							if(keyOneValue=="" && !inArray('ALLOWBLANK',keyOneArray))
							{
								showKeyMessage(keyOneObj,keyOneErrId,"Please Enter "+keyOneMessage);								   
								errormsg+=1;
							}
							else
							{ 
							   if(!validNumericNonzero(keyOneObj) && keyOneValue!="")
							   {
                                   showKeyMessage(keyOneObj,keyOneErrId,"Please Enter Valid "+keyOneMessage);	   
								   errormsg+=1;
                               }
							   else
							   {
								  showKeyMessage(keyOneObj,keyOneErrId,'');
							   }
							}
                       		break;
						case "ALPHANUMERIC" :	
							if(keyOneValue=="" && !inArray('ALLOWBLANK',keyOneArray))
							{
								showKeyMessage(keyOneObj,keyOneErrId,"Please Enter "+keyOneMessage);								   
								errormsg+=1;
							}
							else
							{ 
							   if(!validAlphaNumeric(keyOneObj) && keyOneValue!="")
							   {
                                   showKeyMessage(keyOneObj,keyOneErrId,"Please Enter Valid "+keyOneMessage);	   
								   errormsg+=1;
                               }
							   else
							   {
								  showKeyMessage(keyOneObj,keyOneErrId,'');
							   }
							}
                        	break;
						
 					    case "IMAGEFILE" :							
								if(keyOneValue=="" && !inArray('ALLOWBLANK',keyOneArray))
								{
									showKeyMessage(keyOneObj,keyOneErrId,"Please Enter "+keyOneMessage);								   
									errormsg+=1;
								}
								else
								{
								   if(!checkPhoto(keyOneValue) && keyOneValue!="")
								   {
									   showKeyMessage(keyOneObj,keyOneErrId,"Please Select Only Image File(jpg, jpeg, png, gif) For "+keyOneMessage);	   
								   	   errormsg+=1;									   
								   }
								   else
								   {
									  showKeyMessage(keyOneObj,keyOneErrId,'');
								   }
								}
                              break;
						
						case "USERNAME" :
							if(keyOneValue=="")     
							{
								showKeyMessage(keyOneObj,keyOneErrId,"Please Enter "+keyOneMessage);								   
								errormsg+=1;
							}
							else
							{
								if(keyOneValue.length)
								{
									if(IFSpace(keyOneValue) != 1)
									{
										if(keyOneValue.length <6 || keyOneValue.length > 12 )
										{
											showKeyMessage(keyOneObj,keyOneErrId,"Please enter 6 to 12 character for "+keyOneMessage);	   
								   	   		errormsg+=1;											
										}
										else
									    {
										   showKeyMessage(keyOneObj,keyOneErrId,'');
									    }
									}
									else
									{
										showKeyMessage(keyOneObj,keyOneErrId,"Must not contain any blank/white space"+keyOneMessage);	   
								   	   	errormsg+=1;										
									}
								}
							}
							break;
						
						case "PASSWORD" :
							if(keyOneValue=="")     
							{
								showKeyMessage(keyOneObj,keyOneErrId,"Please Enter "+keyOneMessage);								   
								errormsg+=1;
							}
							else
							{
								if(keyOneValue.length)
								{
									if(IFSpace(keyOneValue) != 1)
									{
										if(keyOneValue.length <6 || keyOneValue.length > 12 )
										{
											showKeyMessage(keyOneObj,keyOneErrId,"Please enter 6 to 12 character for "+keyOneMessage);	   
								   	   		errormsg+=1;
										}
										else
									    {
										   showKeyMessage(keyOneObj,keyOneErrId,'');
									    }
									}
									else
									{
										showKeyMessage(keyOneObj,keyOneErrId,"Must not contain any blank/white space"+keyOneMessage);	   
								   	   	errormsg+=1;	
									}
								}
							}
							break;							
						case "CONFIRMPWD" :
							if(keyOneValue=="")     
							{
								showKeyMessage(keyOneObj,keyOneErrId,"Please Enter Confirm Password");								   
								errormsg+=1;
							}
							else
							{
								if(keyOneValue != eval("formValObj."+keyOneMessage+".value"))
								{
									showKeyMessage(keyOneObj,keyOneErrId,"Password and Confirm Password must be same");	   
									errormsg+=1;
								}
								else
								{
								   showKeyMessage(keyOneObj,keyOneErrId,'');
								}
							}
							break; 
							
						case "CHECKBOX" :	
							if(!IsCheckboxChecked(formValObj))
							{
								showKeyMessage(keyOneObj,keyOneErrId,"Please Select "+ keyOneMessage);	   
								errormsg+=1;
							}
							else
							{
							   showKeyMessage(keyOneObj,keyOneErrId,'');
							}
							// alert(1);
							break;	
							
						case "RADIO" :							
							if(!IsRadioChecked(document.getElementsByName(keyOneName)))
							{
								showKeyMessage(keyOneObj,keyOneErrId,"Please Select Atleast One "+ keyOneMessage);	   
								errormsg+=1;
							}
							else
							{
							   showKeyMessage(keyOneObj,keyOneErrId,'');
							}
							break;	
                    }
               }			  		
          
		}
	}

	 if(errormsg > 0)	 
		return false;		 
	 else
	 	return true;
}

function showKeyMessage(obj,id,msg)
{	
	if(msg == ''){
		$("#"+obj.id).css('border','1px solid #DFDFDF');
		$("#"+id).html(" ");
	}else{
		$("#"+obj.id).css('border','1px solid #FF0000');
		$("#"+id).html(msg);		
	}
 return true;
}
/*function hideKeyMessage(obj,id)
{
	//$(obj).nextAll("#"+id+":first").html('');
	$("#"+id).html('');
}*/
function inArray(needle, haystack) {
    var length = haystack.length;
    for(var i = 0; i < length; i++) {
        if(haystack[i] == needle) return true;
    }
    return false;
}
function isVisible(e) {
    //returns true is should be visible to user.
    if (typeof e == "string") {
        e = xGetElementById(e);
    }
    while (e.nodeName.toLowerCase() != 'body' && e.style.display.toLowerCase() != 'none' && e.style.visibility.toLowerCase() != 'hidden') {
        e = e.parentNode;
    }
    if (e.nodeName.toLowerCase() == 'body') {
        return true;
    } else{
        return false;
    }
}
function validateForm(formValObj,confirmation){
	strMsg='';
	OldId='';
	oldObj='';
	first=0;

	 var errormsg = 0;
   //  formValObj=eval(formValObj);
     for(var i=0;i<formValObj.elements.length;i++)
	 {
		keyAll = (formValObj.elements[i].getAttribute('class')); 		
	  	if(keyAll)
		{
            var keyOne = keyAll.split("::");
			for(j=0;j<keyOne.length;j++)
			{
					keyOneArray = keyOne[j].split("~");						
					keyOneErrId = keyOneArray[0]; 
					keyOneRule = keyOneArray[1]; 
					keyOneMessage = (keyOneArray[2])?(keyOneArray[2]):('');
					keyOneName = formValObj.elements[i].getAttribute('name');					
					keyOneValue = formValObj.elements[i].value;
					keyOneObj = formValObj.elements[i];
					if(!keyOneRule)
					{
						continue;
					}		

					switch(keyOneRule)
					{							
                        case "NOBLANK" :							   
                              if(keyOneValue=="")
							  {
								   showKeyMessage(keyOneObj,keyOneErrId,"Please Enter "+keyOneMessage);					   
								   errormsg+=1;                                   
                              }
							  else
							  {
								  showKeyMessage(keyOneObj,keyOneErrId,'');
							  }							  
                              break;							  
                       case "LENGTH" :
					   		if(keyOneValue=="" && !inArray('ALLOWBLANK',keyOneArray))
							{
								showKeyMessage(keyOneObj,keyOneErrId,"Please Enter "+keyOneMessage);								   
								errormsg+=1;
							}
							else
							{
							   if(keyOneValue.length!=keyOneArray[3] && keyOneValue!="")
							   {
								   showKeyMessage(keyOneObj,keyOneErrId,"Please Enter "+ keyOneArray[3] +" letters for "+keyOneMessage);	   
								   errormsg+=1;                                   
                               }
							   else
							   {
								  showKeyMessage(keyOneObj,keyOneErrId,'');
							   }	
							}
                            break;	
					   case "DUALCAPTCHA" :							
							if(keyOneValue=="")
							{
								showKeyMessage(keyOneObj,keyOneErrId,"Please Enter "+keyOneMessage);						   
								errormsg+=1;
							}
							else
							{ 								
								var output = $.ajax({									   
								  url: "capcha/request.php",
								  async: false,
								  data: "capcha="+keyOneValue								 
								});									
								var captchamsg = output.responseText;
								//alert(captchamsg);
								if(captchamsg=='E')
								{											
									 showKeyMessage(keyOneObj,keyOneErrId,"Please Enter valid security code");	
									errormsg+=1;										
								}
								if(captchamsg=='S')
								{
									showKeyMessage(keyOneObj,keyOneErrId,'');
								}								
							}
                            break;	
					   case "CAPTCHA" :
					   		if(keyOneValue=="")
							{
								showKeyMessage(keyOneObj,keyOneErrId,"Please Enter "+keyOneMessage);								   
								errormsg+=1;
							}
							else // errMsgId~CAPTCHA~Security Code
							{
							   var validCaptcha;
							   // call ajax
							   $.ajax({
								  url: SITE_URL+"ajax.php",
								  data: "action=validate_captcha&code="+keyOneValue,
								  async: false,
								  success: function(msg){
									 if(msg == 'match')
									 {
										validCaptcha = true;
									 }
									 else
									 {
										 validCaptcha = false;
									 }
								  }
								});	
							   
							   if(keyOneValue!="" && !validCaptcha)
							   {
								   showKeyMessage(keyOneObj,keyOneErrId,"Please Enter valid security code");	   
								   errormsg+=1;                                   
                               }
							   else
							   {
								  showKeyMessage(keyOneObj,keyOneErrId,'');
							   }	
							}
                            break;	
					   case "EMAIL" :					   		
					   		if(keyOneValue=="" && !inArray('ALLOWBLANK',keyOneArray))
							{
								showKeyMessage(keyOneObj,keyOneErrId,"Please Enter "+keyOneMessage);								   
								errormsg+=1;
							}
							else
							{ 
							   if(!validateEmail(keyOneObj) && keyOneValue!="")
							   {
                                   showKeyMessage(keyOneObj,keyOneErrId,"Please Enter Valid "+keyOneMessage);	   
								   errormsg+=1;
                               }
							   else
							   {
								  showKeyMessage(keyOneObj,keyOneErrId,'');
							   }
							}
                            break;	 							  
						case "WEBSITE" :	
							if(keyOneValue=="" && !inArray('ALLOWBLANK',keyOneArray))
							{
								showKeyMessage(keyOneObj,keyOneErrId,"Please Enter "+keyOneMessage);								   
								errormsg+=1;
							}
							else
							{ 
							   if(!validURL(keyOneObj) && keyOneValue!="")
							   {
                                   showKeyMessage(keyOneObj,keyOneErrId,"Please Enter Valid "+keyOneMessage+" (start with http://www. ) ");	   
								   errormsg+=1;
                               }
							   else
							   {
								  showKeyMessage(keyOneObj,keyOneErrId,'');
							   }
							}
                       		break;
							
						case "SEOPAGE" :	
							if(keyOneValue=="" && !inArray('ALLOWBLANK',keyOneArray))
							{
								showKeyMessage(keyOneObj,keyOneErrId,"Please Enter "+keyOneMessage);								   
								errormsg+=1;
							}
							else
							{ 
							   if(!validSeoPage(keyOneObj) && keyOneValue!="" && keyOneValue!="#")
							   {
                                   showKeyMessage(keyOneObj,keyOneErrId,"Please Enter Valid "+keyOneMessage);	   
								   errormsg+=1;
                               }
							   else
							   {
								  showKeyMessage(keyOneObj,keyOneErrId,'');
							   }
							}
                       		break;
						
						case "PHONE" :	
							if(keyOneValue=="" && !inArray('ALLOWBLANK',keyOneArray))
							{
								showKeyMessage(keyOneObj,keyOneErrId,"Please Enter "+keyOneMessage);						   
								errormsg+=1;
							}
							else
							{ 								
							   if(!validPhone(keyOneObj) && keyOneValue!="")
							   {
                                   showKeyMessage(keyOneObj,keyOneErrId,"Please Enter Valid "+keyOneMessage);	   
								   errormsg+=1;
                               }
							   else
							   {
								  showKeyMessage(keyOneObj,keyOneErrId,'');
							   }
							}       
							break;
						case "PRICE" :	
							if(keyOneValue=="" && !inArray('ALLOWBLANK',keyOneArray))
							{
								showKeyMessage(keyOneObj,keyOneErrId,"Please Enter "+keyOneMessage);								   
								errormsg+=1;
							}
							else
							{ 
							   if(!validPrice(keyOneObj) && keyOneValue!="")
							   {
                                   showKeyMessage(keyOneObj,keyOneErrId,"Please Enter Valid "+keyOneMessage);	   
								   errormsg+=1;
                               }
							   else
							   {
								  showKeyMessage(keyOneObj,keyOneErrId,'');
							   }
							}
                        	break;
						case "NUMERIC" :	
							if(keyOneValue=="" && !inArray('ALLOWBLANK',keyOneArray))
							{
								showKeyMessage(keyOneObj,keyOneErrId,"Please Enter "+keyOneMessage);								   
								errormsg+=1;
							}
							else
							{ 
							   if(!validNumeric(keyOneObj) && keyOneValue!="")
							   {
                                   showKeyMessage(keyOneObj,keyOneErrId,"Please Enter Valid "+keyOneMessage);	   
								   errormsg+=1;
                               }
							   else
							   {
								  showKeyMessage(keyOneObj,keyOneErrId,'');
							   }
							}
                        	break;
						case "NUMERICNONZERO" :	
							if(keyOneValue=="" && !inArray('ALLOWBLANK',keyOneArray))
							{
								showKeyMessage(keyOneObj,keyOneErrId,"Please Enter "+keyOneMessage);								   
								errormsg+=1;
							}
							else
							{ 
							   if(!validNumericNonzero(keyOneObj) && keyOneValue!="")
							   {
                                   showKeyMessage(keyOneObj,keyOneErrId,"Please Enter Valid "+keyOneMessage);	   
								   errormsg+=1;
                               }
							   else
							   {
								  showKeyMessage(keyOneObj,keyOneErrId,'');
							   }
							}
                       		break;
						case "ALPHANUMERIC" :	
							if(keyOneValue=="" && !inArray('ALLOWBLANK',keyOneArray))
							{
								showKeyMessage(keyOneObj,keyOneErrId,"Please Enter "+keyOneMessage);								   
								errormsg+=1;
							}
							else
							{ 
							   if(!validAlphaNumeric(keyOneObj) && keyOneValue!="")
							   {
                                   showKeyMessage(keyOneObj,keyOneErrId,"Please Enter Valid "+keyOneMessage);	   
								   errormsg+=1;
                               }
							   else
							   {
								  showKeyMessage(keyOneObj,keyOneErrId,'');
							   }
							}
                        	break;
						
 					    case "IMAGEFILE" :							
								if(keyOneValue=="" && !inArray('ALLOWBLANK',keyOneArray))
								{
									showKeyMessage(keyOneObj,keyOneErrId,"Please Enter "+keyOneMessage);								   
									errormsg+=1;
								}
								else
								{
								   if(!checkPhoto(keyOneValue) && keyOneValue!="")
								   {
									   showKeyMessage(keyOneObj,keyOneErrId,"Please Select Only Image File(jpg, jpeg, png, gif) For "+keyOneMessage);	   
								   	   errormsg+=1;									   
								   }
								   else
								   {
									  showKeyMessage(keyOneObj,keyOneErrId,'');
								   }
								}
                              break;
						
						case "USERNAME" :
							if(keyOneValue=="")     
							{
								showKeyMessage(keyOneObj,keyOneErrId,"Please Enter "+keyOneMessage);								   
								errormsg+=1;
							}
							else
							{
								if(keyOneValue.length)
								{
									if(IFSpace(keyOneValue) != 1)
									{
										if(keyOneValue.length <6 || keyOneValue.length > 12 )
										{
											showKeyMessage(keyOneObj,keyOneErrId,"Please enter 6 to 12 character for "+keyOneMessage);	   
								   	   		errormsg+=1;											
										}
										else
									    {
										   showKeyMessage(keyOneObj,keyOneErrId,'');
									    }
									}
									else
									{
										showKeyMessage(keyOneObj,keyOneErrId,"Must not contain any blank/white space"+keyOneMessage);	   
								   	   	errormsg+=1;										
									}
								}
							}
							break;
						
						case "PASSWORD" :
							if(keyOneValue=="")     
							{
								showKeyMessage(keyOneObj,keyOneErrId,"Please Enter "+keyOneMessage);								   
								errormsg+=1;
							}
							else
							{
								if(keyOneValue.length)
								{
									if(IFSpace(keyOneValue) != 1)
									{
										if(keyOneValue.length <6 || keyOneValue.length > 12 )
										{
											showKeyMessage(keyOneObj,keyOneErrId,"Please enter 6 to 12 character for "+keyOneMessage);	   
								   	   		errormsg+=1;
										}
										else
									    {
										   showKeyMessage(keyOneObj,keyOneErrId,'');
									    }
									}
									else
									{
										showKeyMessage(keyOneObj,keyOneErrId,"Must not contain any blank/white space"+keyOneMessage);	   
								   	   	errormsg+=1;	
									}
								}
							}
							break;							
						case "CONFIRMPWD" :
							if(keyOneValue=="")     
							{
								showKeyMessage(keyOneObj,keyOneErrId,"Please Enter Confirm Password");								   
								errormsg+=1;
							}
							else
							{
								if(keyOneValue != eval("formValObj."+keyOneMessage+".value"))
								{
									showKeyMessage(keyOneObj,keyOneErrId,"Password and Confirm Password must be same");	   
									errormsg+=1;
								}
								else
								{
								   showKeyMessage(keyOneObj,keyOneErrId,'');
								}
							}
							break; 
							
						case "CHECKBOX" :	
							if(!IsCheckboxChecked(formValObj))
							{
								showKeyMessage(keyOneObj,keyOneErrId,"Please Select "+ keyOneMessage);	   
								errormsg+=1;
							}
							else
							{
							   showKeyMessage(keyOneObj,keyOneErrId,'');
							}
							// alert(1);
							break;	
							
						case "RADIO" :							
							if(!IsRadioChecked(document.getElementsByName(keyOneName)))
							{
								showKeyMessage(keyOneObj,keyOneErrId,"Please Select Atleast One "+ keyOneMessage);	   
								errormsg+=1;
							}
							else
							{
							   showKeyMessage(keyOneObj,keyOneErrId,'');
							}
							break;	
                    }
               }			  		
          }
     } 
	 if(errormsg > 0)	 
		return false;		 
	 else
	 	return true;
}

function Trim(s) 
{
// Remove leading spaces and carriage returns
  while ((s.substring(0,1) == ' ') || (s.substring(0,1) == '\n') || (s.substring(0,1) == '\r'))
  {
    s = s.substring(1,s.length);
  }
  // Remove trailing spaces and carriage returns

  while ((s.substring(s.length-1,s.length) == ' ') || (s.substring(s.length-1,s.length) == '\n') || (s.substring(s.length-1,s.length) == '\r'))
  {
    s = s.substring(0,s.length-1);
  }  
  return s;
}

function IFSpace(s)
{
	var flg = 0;
	var illegalChars= /[\ ]/ ;
	if(s.match(illegalChars))
	{
		flg = 1;
	}
	return flg;	
}

function checkVideo(filePath) 
{		
   var pathLength = filePath.length;
   var lastDot = filePath.lastIndexOf(".");
   var fileType = filePath.substring(lastDot,pathLength).toLowerCase();

   if((fileType == ".mp3") || (fileType == ".MP3") || (fileType == ".mp4") || (fileType == ".MP4") || (fileType == ".flv") || (fileType == ".FLV") || (fileType == ".aac")|| (fileType == ".AAC")) 
   {
       return true;
   } 
   else 
   {
       return false;
   }
}

function checkPhoto(imagePath) 
{		
   var pathLength = imagePath.length;
   var lastDot = imagePath.lastIndexOf(".");
   var fileType = imagePath.substring(lastDot,pathLength).toLowerCase();
   if((fileType == ".gif") || (fileType == ".jpg") || (fileType == ".jpeg") || (fileType == ".png") || (fileType == ".GIF") || (fileType == ".JPG") || (fileType == ".PNG")) 
   {
       return true;
   } 
   else 
   {
       return false;
   }
}

function validateEmail(fld) 
{	
    var error="";
    var tfld = Trim(fld.value);                        // value of field with whitespace trimmed off
    var emailFilter = /^[^@]+@[^@.]+\.[^@]*\w\w$/ ;
    var illegalChars= /[\(\)\<\>\,\;\:\\\"\[\]]/ ;

    if (!emailFilter.test(tfld))
	{     
		return false;
    } 
	else if (fld.value.match(illegalChars))
	{  
		return false;
    }
	else
	{			
		return true;
	}   
}

function validPhone(fld)
{
	var tomatch= /^[01]?[- .]?\(?[2-9]\d{2}\)?[- .]?\d{3}[- .]?\d{4}$/			
	if(tomatch.test(fld.value))    
		return true;
	else
    	return false;
}

function validURL(fld)
{
	var tomatch= /http:\/\/[A-Za-z0-9\.-]{3,}\.[A-Za-z]{3}/			
	if(tomatch.test(fld.value))
    	return true;
	else
	  	return false;
}

function validSeoPage(fld)
{
	var tomatch= /^[A-Za-z0-9\-]+$/;		
	if(tomatch.test(fld.value))
    	return true;
	else
	  	return false;
}

function validPrice(fld)
{
	var tomatch= /^[0-9]*(\.)?[0-9]*$/			
	if(tomatch.test(fld.value))    
		return true;	
	else
		return false;    
}
function validNumeric(fld)
{
	var tomatch= /^[0-9]+$/		
	if(tomatch.test(fld.value))    
		return true;	
	else
		return false;    
}
function validNumericNonzero(fld)
{
	var tomatch= /^[1-9]+$/			
	if(tomatch.test(fld.value))    
		return true;	
	else
		return false;    
}
function validAlphaNumeric(fld)
{
	var tomatch= /^[a-zA-Z0-9]+$/			
	if(tomatch.test(fld.value))    
		return true;	
	else
		return false;    
}
function RemoveLTSpace(elemval)
{
     var val=elemval.replace(/\s*/,"")
     var val=val.replace(/\s*$/,"")
     return val;
}

function limitMe(fld,title,limit)
{		
	var len = fld.value.length;
	if(len > limit)
	{
		fld.value = fld.value.substring(0,limit);
		alert(title+ ' is limited to '+ limit +' characters');
		return false;
	}		
}
function IsRadioChecked(obj) {	
    var cnt = -1;
	if(obj.length)
	{
		for (var i=obj.length-1; i > -1; i--) {
			if (obj[i].checked) {cnt = i; i = -1;}
		}
	}
	else
	{
		if(obj.checked)
			cnt++;
	}
    if (cnt > -1)		
		return true;		
    else 		
		return false;	
	  
}
function IsCheckboxChecked(obj) {	
    var cnt = -1;
	if(obj.length)
	{
		for (var i=obj.length-1; i > -1; i--) {
			if (obj[i].checked) {cnt = i; i = -1;}
		}
	}
	else
	{
		if(obj.checked)
			cnt++;
	}
    if (cnt > -1)		
		return true;		
    else 		
		return false;	
	  
}
