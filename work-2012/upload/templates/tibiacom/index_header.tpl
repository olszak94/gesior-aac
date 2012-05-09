<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>{$title}</title>
		<meta http-equiv="content-language" content="en" />
		<meta http-equiv="content-type" content="text/html; charset={$charset}"/>
		<meta name="description" content="{$description}" />
		<meta name="keywords" content="{$keywords}" />
		<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
		<link href="/public/templates/tibiacom/basic.css" rel="stylesheet" type="text/css">
		<script type="text/javascript"> var IMAGES=0; IMAGES='/public/templates/tibiacom/images'; var g_FormField=''; var LINK_ACCOUNT=0; LINK_ACCOUNT='';</script>
		<script type="text/javascript">
			<!-- // Framekiller
			setTimeout ("changePage()", 6000);
			function changePage()
			{
				if (parent.frames.length > 2)
				{
					if (browserTyp == "ie")
					{
						parent.location=document.location;
					} else {
						self.top.location=document.location;
					}
				}
			}
		// -->
		</script>
		<script type="text/javascript">
			state = new Array("0", "0", "0", "0", "0");
			function TickerAction(id)
			{
				var line = id.substr(12, 1);
				if(state[line] == "0")
				{
					state[line] = "1";
					OpenNews(id);
				}
				else
				{
					state[line] = "0";
					CloseNews(id);
				}
			}
			function OpenNews(id)
			{
				var div = document.getElementById(id)
				var idShort = id.concat("-ShortText");
				var idMore = id.concat("-FullText");
				var idButton = id.concat("-Button");
				document.getElementById(idShort).style.display = "none";
				document.getElementById(idMore).style.display = "block";
				document.getElementById(idButton).style.backgroundImage = "url('/public/templates/tibiacom/images/general/plus.gif')";
			}
                        function InitializePage()
                        {
                                LoadLoginBox();
                                LoadMenu();
                        }


                        // initialisation of the loginbox status by the value of the variable 'loginStatus' which is provided to the HTML-document by PHP in the file 'header.inc'
                        function LoadLoginBox()
                        {
                                if(loginStatus == "false")
                                {
                                        document.getElementById('LoginstatusText_1').style.backgroundImage = "url('<?PHP echo $layout_name; ?>/images/loginbox/loginbox-font-you-are-not-logged-in.gif')";
                                        document.getElementById('ButtonText').style.backgroundImage = "url('<?PHP echo $layout_name; ?>/images/buttons/_sbutton_login.gif')";
                                        document.getElementById('LoginstatusText_2').style.backgroundImage = "url('<?PHP echo $layout_name; ?>/images/loginbox/loginbox-font-create-account.gif')";
                                        document.getElementById('LoginstatusText_2_1').style.backgroundImage = "url('<?PHP echo $layout_name; ?>/images/loginbox/loginbox-font-create-account.gif')";
                                        document.getElementById('LoginstatusText_2_2').style.backgroundImage = "url('<?PHP echo $layout_name; ?>/images/loginbox/loginbox-font-create-account-over.gif')";
                                }
                                else
                                {
                                        document.getElementById('LoginstatusText_1').style.backgroundImage = "url('<?PHP echo $layout_name; ?>/images/loginbox/loginbox-font-welcome.gif')";
                                        document.getElementById('ButtonText').style.backgroundImage = "url('<?PHP echo $layout_name; ?>/images/buttons/_sbutton_myaccount.gif')";
                                        document.getElementById('LoginstatusText_2').style.backgroundImage = "url('<?PHP echo $layout_name; ?>/images/loginbox/loginbox-font-logout.gif')";
                                        document.getElementById('LoginstatusText_2_1').style.backgroundImage = "url('<?PHP echo $layout_name; ?>/images/loginbox/loginbox-font-logout.gif')";
                                        document.getElementById('LoginstatusText_2_2').style.backgroundImage = "url('<?PHP echo $layout_name; ?>/images/loginbox/loginbox-font-logout-over.gif')";
                                }
                        }

                        // mouse-over and click events of the loginbox
                        function MouseOverLoginBoxText(source)
                        {
                                source.lastChild.style.visibility = "visible";
                                source.firstChild.style.visibility = "hidden";
                        }
                        function MouseOutLoginBoxText(source)
                        {
                                source.firstChild.style.visibility = "visible";
                                source.lastChild.style.visibility = "hidden";
                        }
                        function LoginButtonAction()
                        {
                                if(loginStatus == "false")
                                {
                                        window.location = LINK_ACCOUNT + "?subtopic=accountmanagement";
                                }
                                else
                                {
                                        window.location = LINK_ACCOUNT + "?subtopic=accountmanagement";
                                }
                        }
                        function LoginstatusTextAction(source)
                        {
                                if(loginStatus == "false")
                                {
                                        window.location = LINK_ACCOUNT + "?subtopic=createaccount";
                                }
                                else
                                {
                                        window.location = LINK_ACCOUNT + "?subtopic=accountmanagement&action=logout";
                                }
                        }

                        var menu = new Array();
                        menu[0] = new Object();
                        var unloadhelper = false;

                        // load the menu and set the active submenu item by using the variable 'activeSubmenuItem' (provided to HTML-document by PHP in the file 'header.inc'
                        function LoadMenu()
                        {
                                document.getElementById("submenu_"+activeSubmenuItem).style.color = "white";
                                document.getElementById("ActiveSubmenuItemIcon_"+activeSubmenuItem).style.visibility = "visible";
                                if(self.name.lastIndexOf("&") == -1)
                                {
                                        self.name = "news=1&library=0&community=0&forum=0&account=0&support=0<?PHP if($config['site']['shop_system'] == 1) echo "&shops=0"; ?>&";
                                }
                                FillMenuArray();
                                InitializeMenu();
                        }

                        function SaveMenu()
                        {
                                if(unloadhelper == false)
                                {
                                        SaveMenuArray();
                                        unloadhelper = true;
                                }
                        }

                        // store the values of the variable 'self.name' in the array menu
                        function FillMenuArray()
                        {
                                while(self.name.length > 0 )
                                {
                                        var mark1 = self.name.indexOf("=");
                                        var mark2 = self.name.indexOf("&");
                                        var menuItemName = self.name.substr(0, mark1);
                                        menu[0][menuItemName] = self.name.substring(mark1 + 1, mark2);
                                        self.name = self.name.substr(mark2 + 1, self.name.length);
                                }
                        }

                        // hide or show the corresponding submenus
                        function InitializeMenu()
                        {
                                for(menuItemName in menu[0])
                                {
                                        if(menu[0][menuItemName] == "0")
                                        {
                                                document.getElementById(menuItemName+"_Submenu").style.visibility = "hidden";
                                                document.getElementById(menuItemName+"_Submenu").style.display = "none";
                                                document.getElementById(menuItemName+"_Lights").style.visibility = "visible";
                                                document.getElementById(menuItemName+"_Extend").style.backgroundImage = "url('<?PHP echo $layout_name; ?>/images/general/plus.gif')";
                                        }
                                        else
                                        {
                                                document.getElementById(menuItemName+"_Submenu").style.visibility = "visible";
                                                document.getElementById(menuItemName+"_Submenu").style.display = "block";
                                                document.getElementById(menuItemName+"_Lights").style.visibility = "hidden";
                                                document.getElementById(menuItemName+"_Extend").style.backgroundImage = "url('<?PHP echo $layout_name; ?>/images/general/minus.gif')";
                                        }
                                }
                        }

                        // reconstruct the variable "self.name" out of the array menu
                        function SaveMenuArray()
                        {
                                var stringSlices = "";
                                var temp = "";
                                for(menuItemName in menu[0])
                                {
                                        stringSlices = menuItemName + "=" + menu[0][menuItemName] + "&";
                                        temp = temp + stringSlices;
                                }
                                self.name = temp;
                        }

                        // onClick open or close submenus
                        function MenuItemAction(sourceId)
                        {
                                if(menu[0][sourceId] == 1)
                                {
                                        CloseMenuItem(sourceId);
                                }
                                else
                                {
                                        OpenMenuItem(sourceId);
                                }
                        }
                        function OpenMenuItem(sourceId)
                        {
                                menu[0][sourceId] = 1;
                                document.getElementById(sourceId+"_Submenu").style.visibility = "visible";
                                document.getElementById(sourceId+"_Submenu").style.display = "block";
                                document.getElementById(sourceId+"_Lights").style.visibility = "hidden";
                                document.getElementById(sourceId+"_Extend").style.backgroundImage = "url('<?PHP echo $layout_name; ?>/images/general/minus.gif')";
                        }
                        function CloseMenuItem(sourceId)
                        {
                                menu[0][sourceId] = 0;
                                document.getElementById(sourceId+"_Submenu").style.visibility = "hidden";
                                document.getElementById(sourceId+"_Submenu").style.display = "none";
                                document.getElementById(sourceId+"_Lights").style.visibility = "visible";
                                document.getElementById(sourceId+"_Extend").style.backgroundImage = "url('<?PHP echo $layout_name; ?>/images/general/plus.gif')";
                        }

                        // mouse-over effects of menubuttons and submenuitems
                        function MouseOverMenuItem(source)
                        {
                                source.firstChild.style.visibility = "visible";
                        }
                        function MouseOutMenuItem(source)
                        {
                                source.firstChild.style.visibility = "hidden";
                        }
                        function MouseOverSubmenuItem(source)
                        {
                                source.style.backgroundColor = "#14433F";
                        }
                        function MouseOutSubmenuItem(source)
                        {
                                source.style.backgroundColor = "#0D2E2B";
                        }
                </script>
	</head>
	<body onBeforeUnLoad="SaveMenu();" onUnload="SaveMenu();">












