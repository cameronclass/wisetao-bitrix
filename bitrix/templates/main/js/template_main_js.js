
; /* Start:/bitrix/templates/bikecenter_main/script.js*/
function eshopOpenNativeMenu()
{
	var native_menu = BX("bx_native_menu");
	var is_menu_active = BX.hasClass(native_menu, "active");

	if (is_menu_active)
	{
		BX.removeClass(native_menu, "active");
		BX.removeClass(BX('bx_menu_bg'), "active");
		BX("bx_eshop_wrap").style.position = "";
		BX("bx_eshop_wrap").style.top = "";
		BX("bx_eshop_wrap").style.overflow = "";
	}
	else
	{
		BX.addClass(native_menu, "active");
		BX.addClass(BX('bx_menu_bg'), "active");
		var topHeight = document.body.scrollTop;
		BX("bx_eshop_wrap").style.position = "fixed";
		BX("bx_eshop_wrap").style.top = -topHeight+"px";
		BX("bx_eshop_wrap").style.overflow = "hidden";
	}

	var easing = new BX.easing({
		duration : 300,
		start : { left : (is_menu_active) ? 0 : -100 },
		finish : { left : (is_menu_active) ? -100 : 0 },
		transition : BX.easing.transitions.quart,
		step : function(state){
			native_menu.style.left = state.left + "%";
		}
	});
	easing.animate();
}

window.addEventListener('resize',
	function() {
		if (window.innerWidth >= 640 && BX.hasClass(BX("bx_native_menu"), "active"))
			eshopOpenNativeMenu();
	},
	false
);


$(document).ready(function() {
	$('.popup_window input[type="submit"]').click(function(){
		win = $(this).parents('.popup_window');
		box = win.find('.box-pos');
		checkbox = box.find('.jq-checkbox');
		err = box.find('.error_label2');
		if (box.length) {
			if (!checkbox.hasClass('checked')) {
				err.show();
				return false;
			}
		}
	});
	$('.popup_window .jq-checkbox').click(function(){
		win = $(this).parents('.popup_window');
		box = win.find('.box-pos');
		checkbox = box.find('.jq-checkbox');
		err = box.find('.error_label2');
		if ($(this).hasClass('checked')) err.hide();
	});
});

/* End */
;
; /* Start:/bitrix/templates/bikecenter_main/components/bitrix/sale.ajax.locations/city_serch/proceed.js*/
if (typeof oObject != "object")
	window.oObject = {};

function JsSuggestSale(oHandler, sParams, sParser, domain, ssubmit)
{
	var
		t = this,
		tmp = 0;

	t.oObj = oHandler;
	t.sParams = sParams;
	t.domain = domain;
	t.submit = ssubmit;

	// Arrays for data
	if (sParser)
	{
		t.sExp = new RegExp("["+sParser+"]+", "i");
	}
	else
	{
		t.sExp = new RegExp(",");
	}
	t.oLast = {"str":false, "arr":false};
	t.oThis = {"str":false, "arr":false};
	t.oEl = {"start":false, "end":false};
	t.oUnfinedWords = {};
	// Flags
	t.bReady = true, t.eFocus = true;
	// Array with results & it`s showing
	t.aDiv = null, t.oDiv = null;
	// Pointers
	t.oActive = null, t.oPointer = Array(), t.oPointer_default = Array(), t.oPointer_this = 'input_field';

	t.oObj.onblur = function(){t.eFocus = false;}
	t.oObj.onfocus = function(){if (!t.eFocus){t.eFocus = true; setTimeout(function(){t.CheckModif('focus')}, 500);}}

	t.oLast["arr"] = t.oObj.value.split(t.sExp);
	t.oLast["str"] = t.oLast["arr"].join(":");

	setTimeout(function(){t.CheckModif('this')}, 500);

	this.CheckModif = function(__data)
	{
		var
			sThis = false, tmp = 0,
			bUnfined = false, word = "",
			cursor = {};

		if (!t.eFocus)
			return;

		if (t.bReady && t.oObj.value.length > 0)
		{
			// Preparing input data
			t.oThis["arr"] = t.oObj.value.split(t.sExp);
			t.oThis["str"] = t.oThis["arr"].join(":");

			// Getting modificated element
			if (t.oThis["str"] && (t.oThis["str"] != t.oLast["str"]))
			{
				cursor['position'] = TCJsUtils.getCursorPosition(t.oObj);
				if (cursor['position']['end'] > 0 && !t.sExp.test(t.oObj.value.substr(cursor['position']['end']-1, 1)))
				{
					cursor['arr'] = t.oObj.value.substr(0, cursor['position']['end']).split(t.sExp);
					sThis = t.oThis["arr"][cursor['arr'].length - 1];

					t.oEl['start'] = cursor['position']['end'] - cursor['arr'][cursor['arr'].length - 1].length;
					t.oEl['end'] = t.oEl['start'] + sThis.length;
					t.oEl['content'] = sThis;

					t.oLast["arr"] = t.oThis["arr"];
					t.oLast["str"] = t.oThis["str"];
				}
			}
			if (sThis)
			{
				// Checking for UnfinedWords
				for (tmp = 2; tmp <= sThis.length; tmp++)
				{
					word = sThis.substr(0, tmp);
					if (t.oUnfinedWords[word] == '!fined')
					{
						bUnfined = true;
						break;
					}
				}
				if (!bUnfined)
					t.Send(sThis);
			}
		}
		setTimeout(function(){t.CheckModif('this')}, 500);
	},

	t.Send = function(sSearch)
	{
		if (!sSearch)
			return false;

		var TID = null, oError = Array();
		t.bReady = false;
		PShowWaitMessage('wait_container', true);
		TID = CPHttpRequest.InitThread();
		CPHttpRequest.SetAction(
			TID,
			function(data)
			{
				var result = {};
				t.bReady = true;

				try
				{
					eval("result = " + data + ";");
				}
				catch(e)
				{
					oError['result_unval'] = e;
				}

				if (TCJsUtils.empty(result))
					oError['result_empty'] = 'Empty result';

				try
				{
					if (TCJsUtils.empty(oError) && (typeof result == 'object'))
					{
						if (!(result.length == 1 && result[0]['NAME'] == t.oEl['content']))
						{
							t.Show(result);
							return;
						}
					}
					else
					{
						t.oUnfinedWords[t.oEl['content']] = '!fined';
					}
				}
				catch(e)
				{
					oError['unknown_error'] = e;
				}

				PCloseWaitMessage('wait_container', true);
				return;
			}
		);
		url = '/bitrix/components/bitrix/sale.ajax.locations/search.php';
		if(t.domain)
			url = domain + '/bitrix/components/bitrix/sale.ajax.locations/search.php';
		CPHttpRequest.Send(TID, url, {"search":sSearch, "params":t.sParams});
	},

	t.Show = function(result)
	{
		t.Destroy();
		t.oDiv = document.body.appendChild(document.createElement("DIV"));
		t.oDiv.id = t.oObj.id+'_div';

		t.oDiv.className = "search-popup";
		t.oDiv.style.position = 'absolute';

		t.aDiv = t.Print(result);
		var pos = TCJsUtils.GetRealPos(t.oObj);
		//t.oDiv.style.width = parseInt(pos["width"]) + "px";
		t.oDiv.style.width = "auto";
		TCJsUtils.show(t.oDiv, pos["left"], pos["bottom"]);
		TCJsUtils.addEvent(document, "click", t.CheckMouse);
		TCJsUtils.addEvent(document, "keydown", t.CheckKeyword);
	},

	t.Print = function(aArr)
	{
		var
			aEl = null, sPrefix = '', sColumn = '',
			aResult = Array(), aRes = Array(),
			iCnt = 0, tmp = 0, tmp_ = 0, bFirst = true,
			oDiv = null, oSpan = null;

		sPrefix = t.oDiv.id;

		for (tmp_ in aArr)
		{
			// Math
			aEl = aArr[tmp_];
			aRes = Array();
			aRes['ID'] = (aEl['ID'] && aEl['ID'].length > 0) ? aEl['ID'] : iCnt++;
			aRes['GID'] = sPrefix + '_' + aRes['ID'];
			
			locName = aEl['NAME'];
			if (aEl['REGION_NAME'].length > 0 && locName.length <= 0)
				locName = aEl['REGION_NAME'];
			else if (aEl['REGION_NAME'].length > 0)
				locName = locName +', '+ aEl['REGION_NAME'];
			
			if (aEl['COUNTRY_NAME'].length > 0 && locName.length <= 0)
				locName = aEl['COUNTRY_NAME'];
			else if (aEl['COUNTRY_NAME'].length > 0)
				locName = locName +', '+ aEl['COUNTRY_NAME'];
				
			aRes['NAME'] = TCJsUtils.htmlspecialcharsEx(locName);

			//aRes['CNT'] = aEl['CNT'];
			aResult[aRes['GID']] = aRes;
			t.oPointer.push(aRes['GID']);
			// Graph
			oDiv = t.oDiv.appendChild(document.createElement("DIV"));
			oDiv.id = aRes['GID'];
			oDiv.name = sPrefix + '_div';

			oDiv.className = 'search-popup-row';

			oDiv.onmouseover = function(){t.Init(); this.className='search-popup-row-active';};
			oDiv.onmouseout = function(){t.Init(); this.className='search-popup-row';};
			oDiv.onclick = function(){t.oActive = this.id};

			//oSpan = oDiv.appendChild(document.createElement("DIV"));
			//oSpan.id = oDiv.id + '_NAME';
			//oSpan.className = "search-popup-el search-popup-el-cnt";
			//oSpan.innerHTML = aRes['CNT'];

			oSpan = oDiv.appendChild(document.createElement("DIV"));
			oSpan.id = oDiv.id + '_NAME';
			oSpan.className = "search-popup-el search-popup-el-name";
			oSpan.innerHTML = aRes['NAME'];
		}
		t.oPointer.push('input_field');
		t.oPointer_default = t.oPointer;
		return aResult;
	},

	t.Destroy = function()
	{
		try
		{
			TCJsUtils.hide(t.oDiv);
			t.oDiv.parentNode.removeChild(t.oDiv);
		}
		catch(e)
		{}
		t.aDiv = Array();
		t.oPointer = Array(), t.oPointer_default = Array(), t.oPointer_this = 'input_field';
		t.bReady = true, t.eFocus = true, oError = {},
		t.oActive = null;

		TCJsUtils.removeEvent(document, "click", t.CheckMouse);
		TCJsUtils.removeEvent(document, "keydown", t.CheckKeyword);
	},

	t.Replace = function()
	{
		if (typeof t.oActive == 'string')
		{
			var tmp = t.aDiv[t.oActive];
			var tmp1 = '';
			if (typeof tmp == 'object')
			{
				var elEntities = document.createElement("span");
				elEntities.innerHTML = TCJsUtils.htmlspecialcharsback(tmp['NAME']);
				tmp1 = elEntities.innerHTML;
				//document.getElementById(t.oObj.name+'_val').value = tmp['ID'];
				var n = t.oObj.name.substr(0, (t.oObj.name.length - 4));
				document.getElementById(n).value = tmp['ID'];
				
				if(t.submit && t.submit.length > 0)
					eval(t.submit);
				//submit form
				// submitForm();	
			}
			//this preserves leading spaces
			var start = t.oEl['start'];
			while(start < t.oObj.value.length && t.oObj.value.substring(start, start+1) == " ")
				start++;

			t.oObj.value = t.oObj.value.substring(0, start) + tmp1 + t.oObj.value.substr(t.oEl['end']);
			TCJsUtils.setCursorPosition(t.oObj, start + tmp1.length);
		}
		return;
	},

	t.Init = function()
	{
		t.oActive = false;
		t.oPointer = t.oPointer_default;
		t.Clear();
		t.oPointer_this = 'input_pointer';
	},

	t.Clear = function()
	{
		var oEl = {}, ii = '';
		oEl = t.oDiv.getElementsByTagName("div");
		if (oEl.length > 0 && typeof oEl == 'object')
		{
			for (ii in oEl)
			{
				var oE = oEl[ii];
				if (oE && (typeof oE == 'object') && (oE.name == t.oDiv.id + '_div'))
				{
					oE.className = "search-popup-row";
				}
			}
		}
		return;
	},

	t.CheckMouse = function()
	{
		t.Replace();
		t.Destroy();
	},

	t.CheckKeyword = function(e)
	{
		if (!e)
			e = window.event;
		var
			oP = null,
			oEl = null,
			ii = null;
		if ((37 < e.keyCode && e.keyCode <41) || (e.keyCode == 13))
		{
			t.Clear();

			switch (e.keyCode)
			{
				case 38:
					oP = t.oPointer.pop();
					if (t.oPointer_this == oP)
					{
						t.oPointer.unshift(oP);
						oP = t.oPointer.pop();
					}

					if (oP != 'input_field')
					{
						t.oActive = oP;
						oEl = document.getElementById(oP);
						if (typeof oEl == 'object')
						{
							oEl.className = "search-popup-row-active";
						}
					}
					t.oPointer.unshift(oP);
					break;
				case 40:
					oP = t.oPointer.shift();
					if (t.oPointer_this == oP)
					{
						t.oPointer.push(oP);
						oP = t.oPointer.shift();
					}
					if (oP != 'input_field')
					{
						t.oActive = oP;
						oEl = document.getElementById(oP);
						if (typeof oEl == 'object')
						{
							oEl.className = "search-popup-row-active";
						}
					}
					t.oPointer.push(oP);
					break;
				case 39:
					t.Replace();
					t.Destroy();
					break;
				case 13:
					t.Replace();
					t.Destroy();
					break;
			}
			t.oPointer_this	= oP;
		}
		else
		{
			t.Destroy();
		}
//		return false;
	}
}

var TCJsUtils =
{
	arEvents: Array(),

	addEvent: function(el, evname, func)
	{
		if(el.attachEvent) // IE
			el.attachEvent("on" + evname, func);
		else if(el.addEventListener) // Gecko / W3C
			el.addEventListener(evname, func, false);
		else
			el["on" + evname] = func;
		this.arEvents[this.arEvents.length] = {'element': el, 'event': evname, 'fn': func};
	},

	removeEvent: function(el, evname, func)
	{
		if(el.detachEvent) // IE
			el.detachEvent("on" + evname, func);
		else if(el.removeEventListener) // Gecko / W3C
			el.removeEventListener(evname, func, false);
		else
			el["on" + evname] = null;
	},

	getCursorPosition: function(oObj)
	{
		var result = {'start': 0, 'end': 0};
		if (!oObj || (typeof oObj != 'object'))
			return result;
		try
		{
			if (document.selection != null && oObj.selectionStart == null)
			{
				oObj.focus();
				var
					oRange = document.selection.createRange(),
					oParent = oRange.parentElement(),
					sBookmark = oRange.getBookmark(),
					sContents = sContents_ = oObj.value,
					sMarker = '__' + Math.random() + '__';

				while(sContents.indexOf(sMarker) != -1)
				{
					sMarker = '__' + Math.random() + '__';
				}

				if (!oParent || oParent == null || (oParent.type != "textarea" && oParent.type != "text"))
				{
					return result;
				}

				oRange.text = sMarker + oRange.text + sMarker;
				sContents = oObj.value;
				result['start'] = sContents.indexOf(sMarker);
				sContents = sContents.replace(sMarker, "");
				result['end'] = sContents.indexOf(sMarker);
				oObj.value = sContents_;
				oRange.moveToBookmark(sBookmark);
				oRange.select();
				return result;
			}
			else
			{
				return {
				 	'start': oObj.selectionStart,
					'end': oObj.selectionEnd
				};
			}
		}
		catch(e){}
		return result;
	},

	setCursorPosition: function(oObj, iPosition)
	{
		var result = false;
		if (typeof oObj != 'object')
			return false;

		oObj.focus();

		try
		{
			if (document.selection != null && oObj.selectionStart == null)
			{
				var oRange = document.selection.createRange();
				oRange.select();
			}
			else
			{
				oObj.selectionStart = iPosition;
				oObj.selectionEnd = iPosition;
			}
			return true;
		}
		catch(e)
		{
			return false;
		}

	},

	printArray: function (oObj, sParser, iLevel)
	{
	    try
	    {
	        var result = '',
	        	space = '',
	        	i=null, j=0;

	        if (iLevel==undefined)
	            iLevel = 0;
	        if (!sParser)
	        	sParser = "\n";

	        for (j=0; j<=iLevel; j++)
	            space += '  ';

	        for (i in oObj)
	        {
	            if (typeof oObj[i] == 'object')
	                result += space+i + " = {"+ sParser + TCJsUtils.printArray(oObj[i], sParser, iLevel+1) + ", " + sParser + "}" + sParser;
	            else
	                result += space+i + " = " + oObj[i] + "; " + sParser;
	        }
	        return result;
	    }
	    catch(e)
	    {
	        return;
	    }
	},

	empty: function(oObj)
	{
		var result = true;
		if (oObj)
		{
		    for (i in oObj)
		    {
		    	 result = false;
		    	 break;
		    }
		}
		return result;
	},

	show: function(oDiv, iLeft, iTop)
	{
		if (typeof oDiv != 'object')
			return;
		var zIndex = parseInt(oDiv.style.zIndex);
		if(zIndex <= 0 || isNaN(zIndex))
			zIndex = 100;
		oDiv.style.zIndex = zIndex;
		oDiv.style.left = iLeft + "px";
		oDiv.style.top = iTop + "px";

		return oDiv;
	},

	hide: function(oDiv)
	{
		if(oDiv)
			oDiv.style.display = 'none';
	},

	GetRealPos: function(el)
	{
		if(!el || !el.offsetParent)
			return false;
		var res=Array();
		var objParent = el.offsetParent;
		res["left"] = el.offsetLeft;
		res["top"] = el.offsetTop;
		while(objParent && objParent.tagName != "BODY")
		{
			res["left"] += objParent.offsetLeft;
			res["top"] += objParent.offsetTop;
			objParent = objParent.offsetParent;
		}
		res["right"]=res["left"] + el.offsetWidth;
		res["bottom"]=res["top"] + el.offsetHeight;
		res["width"]=el.offsetWidth;
		res["height"]=el.offsetHeight;
		return res;
	},

	htmlspecialcharsEx: function(str)
	{
		res = str.replace(/&amp;/g, '&amp;amp;').replace(/&lt;/g, '&amp;lt;').replace(/&gt;/g, '&amp;gt;').replace(/&quot;/g, '&amp;quot;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
		return res;
	},

	htmlspecialcharsback: function(str)
	{
		res = str.replace(/&lt;/g, '<').replace(/&gt;/g, '>').replace(/&quot;;/g, '"').replace(/&amp;/g, '&');
		return res;
	}
}
SuggestLoadedSale = true;
/* End */
;
; /* Start:/bitrix/templates/bikecenter_main/components/bitrix/search.suggest.input/.default/script.js*/
function JsSuggest(oHandler, sParams, sParser)
{
	var t = this;

	t.oObj = oHandler;
	t.sParams = sParams;
	// Arrays for data
	if (sParser)
	{
		t.sExp = new RegExp("["+sParser+"]+", "i");
	}
	else
	{
		t.sExp = new RegExp(",");
	}
	t.oLast = {"str":false, "arr":false};
	t.oThis = {"str":false, "arr":false};
	t.oEl = {"start":false, "end":false};
	t.oUnfinedWords = {};
	// Flags
	t.bReady = true;
	t.eFocus = true;
	// Array with results & it`s showing
	t.aDiv = null;
	t.oDiv = null;
	// Pointers
	t.oActive = null;
	t.oPointer = [];
	t.oPointer_default = [];
	t.oPointer_this = 'input_field';

	t.oObj.onblur = function()
	{
		t.eFocus = false;
	};

	t.oObj.onfocus = function()
	{
		if (!t.eFocus)
		{
			t.eFocus = true;
			setTimeout(function(){t.CheckModif('focus')}, 500);
		}
	};

	t.oLast["arr"] = t.oObj.value.split(t.sExp);
	t.oLast["str"] = t.oLast["arr"].join(":");

	setTimeout(function(){t.CheckModif('this')}, 500);

	this.CheckModif = function(__data)
	{
		var
			sThis = false, tmp = 0,
			bUnfined = false, word = "",
			cursor = {};

		if (!t.eFocus)
			return;

		if (t.bReady && t.oObj.value.length > 0)
		{
			// Preparing input data
			t.oThis["arr"] = t.oObj.value.split(t.sExp);
			t.oThis["str"] = t.oThis["arr"].join(":");

			// Getting modificated element
			if (t.oThis["str"] && (t.oThis["str"] != t.oLast["str"]))
			{
				cursor['position'] = TCJsUtils.getCursorPosition(t.oObj);
				if (cursor['position']['end'] > 0 && !t.sExp.test(t.oObj.value.substr(cursor['position']['end']-1, 1)))
				{
					cursor['arr'] = t.oObj.value.substr(0, cursor['position']['end']).split(t.sExp);
					sThis = t.oThis["arr"][cursor['arr'].length - 1];

					t.oEl['start'] = cursor['position']['end'] - cursor['arr'][cursor['arr'].length - 1].length;
					t.oEl['end'] = t.oEl['start'] + sThis.length;
					t.oEl['content'] = sThis;

					t.oLast["arr"] = t.oThis["arr"];
					t.oLast["str"] = t.oThis["str"];
				}
			}
			if (sThis)
			{
				// Checking for UnfinedWords
				for (tmp = 2; tmp <= sThis.length; tmp++)
				{
					word = sThis.substr(0, tmp);
					if (t.oUnfinedWords[word] == '!fined')
					{
						bUnfined = true;
						break;
					}
				}
				if (!bUnfined)
					t.Send(sThis);
			}
		}
		setTimeout(function(){t.CheckModif('this')}, 500);
	};

	t.Send = function(sSearch)
	{
		if (!sSearch)
			return false;

		var oError = [];
		t.bReady = false;
		if (BX('wait_container'))
		{
			BX('wait_container').innerHTML = BX.message('JS_CORE_LOADING');
			BX.show(BX('wait_container'));
		}
		BX.ajax.post(
			'/bitrix/components/bitrix/search.suggest.input/search.php',
			{"search":sSearch, "params":t.sParams},
			function(data)
			{
				var result = {};
				t.bReady = true;

				try
				{
					eval("result = " + data + ";");
				}
				catch(e)
				{
					oError['result_unval'] = e;
				}

				if (TCJsUtils.empty(result))
					oError['result_empty'] = 'Empty result';

				try
				{
					if (TCJsUtils.empty(oError) && (typeof result == 'object'))
					{
						if (!(result.length == 1 && result[0]['NAME'] == t.oEl['content']))
						{
							t.Show(result);
							return;
						}
					}
					else
					{
						t.oUnfinedWords[t.oEl['content']] = '!fined';
					}
				}
				catch(e)
				{
					oError['unknown_error'] = e;
				}

				if(BX('wait_container'))
					BX.hide(BX('wait_container'));
			}
		);
	};

	t.Show = function(result)
	{
		t.Destroy();
		t.oDiv = document.body.appendChild(document.createElement("DIV"));
		t.oDiv.id = t.oObj.id+'_div';

		t.oDiv.className = "search-popup";
		t.oDiv.style.position = 'absolute';

		t.aDiv = t.Print(result);
		var pos = TCJsUtils.GetRealPos(t.oObj);
		t.oDiv.style.width = parseInt(pos["width"]) + "px";
		TCJsUtils.show(t.oDiv, pos["left"], pos["bottom"]);
		TCJsUtils.addEvent(document, "click", t.CheckMouse);
		TCJsUtils.addEvent(document, "keydown", t.CheckKeyword);
	};

	t.Print = function(aArr)
	{
		var aEl = null;
		var aResult = {};
		var iCnt = 0;
		var oDiv = null;
		var oSpan = null;
		var sPrefix = t.oDiv.id;

		for (var tmp_ in aArr)
		{
			if (aArr.hasOwnProperty(tmp_))
			{
				// Math
				aEl = aArr[tmp_];
				var aRes = {
					'ID': (aEl['ID'] && aEl['ID'].length > 0) ? aEl['ID'] : iCnt++,
					'GID': sPrefix + '_' + aRes['ID'],
					'NAME': TCJsUtils.htmlspecialcharsEx(aEl['NAME']),
					'CNT': aEl['CNT']
				};
				aResult[aRes['GID']] = aRes;
				t.oPointer.push(aRes['GID']);
				// Graph
				oDiv = t.oDiv.appendChild(document.createElement("DIV"));
				oDiv.id = aRes['GID'];
				oDiv.name = sPrefix + '_div';

				oDiv.className = 'search-popup-row';

				oDiv.onmouseover = function(){t.Init(); this.className='search-popup-row-active';};
				oDiv.onmouseout = function(){t.Init(); this.className='search-popup-row';};
				oDiv.onclick = function(){t.oActive = this.id};

				oSpan = oDiv.appendChild(document.createElement("DIV"));
				oSpan.id = oDiv.id + '_NAME';
				oSpan.className = "search-popup-el search-popup-el-cnt";
				oSpan.innerHTML = aRes['CNT'];

				oSpan = oDiv.appendChild(document.createElement("DIV"));
				oSpan.id = oDiv.id + '_NAME';
				oSpan.className = "search-popup-el search-popup-el-name";
				oSpan.innerHTML = aRes['NAME'];
			}
		}
		t.oPointer.push('input_field');
		t.oPointer_default = t.oPointer;
		return aResult;
	};

	t.Destroy = function()
	{
		try
		{
			TCJsUtils.hide(t.oDiv);
			t.oDiv.parentNode.removeChild(t.oDiv);
		}
		catch(e)
		{}

		t.aDiv = [];
		t.oPointer = [];
		t.oPointer_default = [];
		t.oPointer_this = 'input_field';
		t.bReady = true;
		t.eFocus = true;
		t.oActive = null;

		TCJsUtils.removeEvent(document, "click", t.CheckMouse);
		TCJsUtils.removeEvent(document, "keydown", t.CheckKeyword);
	};

	t.Replace = function()
	{
		if (typeof t.oActive == 'string')
		{
			var tmp = t.aDiv[t.oActive];
			var tmp1 = '';
			if (typeof tmp == 'object')
			{
				var elEntities = document.createElement("span");
				elEntities.innerHTML = tmp['NAME'].replace(/&quot;/g, '"').replace(/&amp;/g, '&');
				tmp1 = elEntities.innerHTML;
			}
			//this preserves leading spaces
			var start = t.oEl['start'];
			while(start < t.oObj.value.length && t.oObj.value.substring(start, start+1) == " ")
				start++;

			t.oObj.value = t.oObj.value.substring(0, start) + tmp1.replace(/&lt;/g, '<').replace(/&gt;/g, '>') + t.oObj.value.substr(t.oEl['end']);
			TCJsUtils.setCursorPosition(t.oObj, start + tmp1.length);
		}
	};

	t.Init = function()
	{
		t.oActive = false;
		t.oPointer = t.oPointer_default;
		t.Clear();
		t.oPointer_this = 'input_pointer';
	};

	t.Clear = function()
	{
		var oEl = t.oDiv.getElementsByTagName("div");
		if (oEl.length > 0 && typeof oEl == 'object')
		{
			for (var ii in oEl)
			{
				if (oEl.hasOwnProperty(ii))
				{
					var oE = oEl[ii];
					if (oE && (typeof oE == 'object') && (oE.name == t.oDiv.id + '_div'))
					{
						oE.className = "search-popup-row";
					}
				}
			}
		}
	};

	t.CheckMouse = function()
	{
		t.Replace();
		t.Destroy();
	};

	t.CheckKeyword = function(e)
	{
		if (!e)
			e = window.event;

		var oP = null;
		var oEl = null;

		if ((37 < e.keyCode && e.keyCode <41) || (e.keyCode == 13))
		{
			t.Clear();

			switch (e.keyCode)
			{
				case 38:
					oP = t.oPointer.pop();
					if (t.oPointer_this == oP)
					{
						t.oPointer.unshift(oP);
						oP = t.oPointer.pop();
					}

					if (oP != 'input_field')
					{
						t.oActive = oP;
						oEl = document.getElementById(oP);
						if (typeof oEl == 'object')
						{
							oEl.className = "search-popup-row-active";
						}
					}
					t.oPointer.unshift(oP);
					break;
				case 40:
					oP = t.oPointer.shift();
					if (t.oPointer_this == oP)
					{
						t.oPointer.push(oP);
						oP = t.oPointer.shift();
					}
					if (oP != 'input_field')
					{
						t.oActive = oP;
						oEl = document.getElementById(oP);
						if (typeof oEl == 'object')
						{
							oEl.className = "search-popup-row-active";
						}
					}
					t.oPointer.push(oP);
					break;
				case 39:
					t.Replace();
					t.Destroy();
					break;
				case 13:
					t.Replace();
					t.Destroy();
					break;
			}
			t.oPointer_this = oP;
		}
		else
		{
			t.Destroy();
		}
	};
}

var TCJsUtils =
{
	arEvents: [],

	addEvent: function(el, evname, func)
	{
		if(el.attachEvent) // IE
			el.attachEvent("on" + evname, func);
		else if(el.addEventListener) // Gecko / W3C
			el.addEventListener(evname, func, false);
		else
			el["on" + evname] = func;
		this.arEvents[this.arEvents.length] = {'element': el, 'event': evname, 'fn': func};
	},

	removeEvent: function(el, evname, func)
	{
		if(el.detachEvent) // IE
			el.detachEvent("on" + evname, func);
		else if(el.removeEventListener) // Gecko / W3C
			el.removeEventListener(evname, func, false);
		else
			el["on" + evname] = null;
	},

	getCursorPosition: function(oObj)
	{
		var result = {'start': 0, 'end': 0};
		if (!oObj || (typeof oObj != 'object'))
			return result;
		try
		{
			if (document.selection != null && oObj.selectionStart == null)
			{
				oObj.focus();
				var oRange = document.selection.createRange();
				var oParent = oRange.parentElement();
				var sBookmark = oRange.getBookmark();
				var sContents = oObj.value;
				var sContents_ = oObj.value;
				var sMarker = '__' + Math.random() + '__';

				while(sContents.indexOf(sMarker) != -1)
				{
					sMarker = '__' + Math.random() + '__';
				}

				if (!oParent || oParent == null || (oParent.type != "textarea" && oParent.type != "text"))
				{
					return result;
				}

				oRange.text = sMarker + oRange.text + sMarker;
				sContents = oObj.value;
				result['start'] = sContents.indexOf(sMarker);
				sContents = sContents.replace(sMarker, "");
				result['end'] = sContents.indexOf(sMarker);
				oObj.value = sContents_;
				oRange.moveToBookmark(sBookmark);
				oRange.select();
				return result;
			}
			else
			{
				return {
					'start': oObj.selectionStart,
					'end': oObj.selectionEnd
				};
			}
		}
		catch(e){}
		return result;
	},

	setCursorPosition: function(oObj, iPosition)
	{
		if (typeof oObj != 'object')
			return false;

		oObj.focus();

		try
		{
			if (document.selection != null && oObj.selectionStart == null)
			{
				var oRange = document.selection.createRange();
				oRange.select();
			}
			else
			{
				oObj.selectionStart = iPosition;
				oObj.selectionEnd = iPosition;
			}
			return true;
		}
		catch(e)
		{
			return false;
		}

	},

	printArray: function (oObj, sParser, iLevel)
	{
		try
		{
			var result = '';
			var space = '';

			if (iLevel==undefined)
				iLevel = 0;
			if (!sParser)
				sParser = "\n";

			for (var j = 0; j <= iLevel; j++)
				space += '  ';

			for (var i in oObj)
			{
				if (oObj.hasOwnProperty(i))
				{
					if (typeof oObj[i] == 'object')
						result += space+i + " = {"+ sParser + TCJsUtils.printArray(oObj[i], sParser, iLevel+1) + ", " + sParser + "}" + sParser;
					else
						result += space+i + " = " + oObj[i] + "; " + sParser;
				}
			}
			
			return result;
		}
		catch(e)
		{
		}
	},

	empty: function(oObj)
	{
		var result = true;
		if (oObj)
		{
			for (var i in oObj)
			{
				if (oObj.hasOwnProperty(i))
				{
					result = false;
					break;
				}
			}
		}
		return result;
	},

	show: function(oDiv, iLeft, iTop)
	{
		if (typeof oDiv != 'object')
			return;
		var zIndex = parseInt(oDiv.style.zIndex);
		if(zIndex <= 0 || isNaN(zIndex))
			zIndex = 100;
		oDiv.style.zIndex = zIndex;
		oDiv.style.left = iLeft + "px";
		oDiv.style.top = iTop + "px";

		return oDiv;
	},

	hide: function(oDiv)
	{
		if(oDiv)
			oDiv.style.display = 'none';
	},

	GetRealPos: function(el)
	{
		if(!el || !el.offsetParent)
			return false;

		var res = {};
		var objParent = el.offsetParent;
		res["left"] = el.offsetLeft;
		res["top"] = el.offsetTop;
		while(objParent && objParent.tagName != "BODY")
		{
			res["left"] += objParent.offsetLeft;
			res["top"] += objParent.offsetTop;
			objParent = objParent.offsetParent;
		}
		res["right"]=res["left"] + el.offsetWidth;
		res["bottom"]=res["top"] + el.offsetHeight;
		res["width"]=el.offsetWidth;
		res["height"]=el.offsetHeight;

		return res;
	},

	htmlspecialcharsEx: function(str)
	{
		return str.replace(/&amp;/g, '&amp;amp;').replace(/&lt;/g, '&amp;lt;').replace(/&gt;/g, '&amp;gt;').replace(/&quot;/g, '&amp;quot;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
	},

	htmlspecialcharsback: function(str)
	{
		return str.replace(/&lt;/g, '<').replace(/&gt;/g, '>').replace(/&quot;/g, '"').replace(/&amp;/g, '&');
	}
};

/* End */
;
; /* Start:/bitrix/js/main/cphttprequest.js*/
function PShowWaitMessage(container_id, bHide)
{
	if (bHide == null) bHide = false;
	PCloseWaitMessage(container_id, bHide);

	var obContainer = document.getElementById(container_id);

	if (obContainer)
	{
		if (window.ajaxMessages == null) window.ajaxMessages = {};
		if (!window.ajaxMessages.wait) window.ajaxMessages.wait = 'Wait...';

		obContainer.innerHTML = window.ajaxMessages.wait;

		if (bHide) obContainer.style.display = 'inline';
	}
}

function PCloseWaitMessage(container_id, bHide)
{
	if (bHide == null) bHide = false;

	var obContainer = document.getElementById(container_id);

	if (obContainer)
	{
		obContainer.innerHTML = '';

		if (bHide) obContainer.style.display = 'none';
	}

}

function JCPHttpRequest()
{
	this.Action = {}; //{TID:function(result){}}

	this.InitThread = function()
	{
		while (true)
		{
			var TID = 'TID' + Math.floor(Math.random() * 1000000);
			if (!this.Action[TID]) break;
		}

		return TID;
	}

	this.SetAction = function(TID, actionHandler)
	{
		this.Action[TID] = actionHandler;
	}

	this._Close = function(TID, httpRequest)
	{
		if (this.Action[TID]) this.Action[TID] = null;
//		httpRequest.onreadystatechange = null;
		httpRequest = null;
	}

	this._OnDataReady = function(TID, result)
	{
		if(this.Action[TID])
		{
			this.Action[TID](result);
		}
	}

	this._CreateHttpObject = function()
	{
		var obj = null;
		if(window.XMLHttpRequest)
		{
			try {obj = new XMLHttpRequest();} catch(e){}
		}
        else if(window.ActiveXObject)
        {
            try {obj = new ActiveXObject("Microsoft.XMLHTTP");} catch(e){}
            if(!obj)
            	try {obj = new ActiveXObject("Msxml2.XMLHTTP");} catch (e){}
        }
        return obj;
	}

	this._SetHandler = function(TID, httpRequest)
	{
		var _this = this;

		function __handlerReadyStateChange()
		{
			//alert(httpRequest.readyState);
			if(httpRequest.readyState == 4)
			{
//				try
//				{
					var s = httpRequest.responseText;
					var code = [];
					var start;
					
					while((start = s.indexOf('<script>')) != -1)
					{
						var end = s.indexOf('</script>', start);
						if(end != -1)
						{
							code[code.length] = s.substr(start+8, end-start-8);
							s = s.substr(0, start) + s.substr(end+9);
						}
						else
						{
							s = s.substr(0, start) + s.substr(start+8);
						}
					}
					
					_this._OnDataReady(TID, s);

					for(var i in code)
						if(code[i] != '')
							eval(code[i]);
//				}
//				catch (e)
//				{
//					var w = window.open("about:blank");
//					w.document.write(httpRequest.responseText);
//					//w.document.close();
//				}

				_this._Close(TID, httpRequest);
			}
			//alert('done');
		}

		httpRequest.onreadystatechange = __handlerReadyStateChange;
	}

	this._MyEscape = function(str)
	{
		return escape(str).replace(/\+/g, '%2B');
	}

	this._PrepareData = function(arData, prefix)
	{
		var data = '';
		if (arData != null)
		{
			for(var i in arData)
			{
				if (data.length > 0) data += '&';
				var name = this._MyEscape(i);
				if(prefix)
					name = prefix + '[' + name + ']';
				if(typeof arData[i] == 'object')
					data += this._PrepareData(arData[i], name)
				else
					data += name + '=' + this._MyEscape(arData[i])
			}
		}
		return data;
	}

	this.Send = function(TID, url, arData)
	{
		if (arData != null)
			var data = this._PrepareData(arData);

		if (data.length > 0)
		{
			if (url.indexOf('?') == -1)
		 		url += '?' + data;
		 	else
				url += '&' + data;	
		}

		var httpRequest = this._CreateHttpObject();
		if(httpRequest)
		{
			httpRequest.open("GET", url, true);
			this._SetHandler(TID, httpRequest);
			return httpRequest.send("");
  		}
  		return false;
	}

	this.Post = function(TID, url, arData)
	{
		var data = '';

		if (arData != null)
			data = this._PrepareData(arData);

		var httpRequest = this._CreateHttpObject();
		if(httpRequest)
		{
			httpRequest.open("POST", url, true);
			this._SetHandler(TID, httpRequest);
			httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
			return httpRequest.send(data);
  		}
  		return false;
	}

	this.__migrateSetHandler = function(obForm, obFrame, handler)
	{
		function __formResultHandler()
		{
			if (!obFrame.contentWindow.document || obFrame.contentWindow.document.body.innerHTML.length == 0) return;
			if (null != handler) 
				handler(obFrame.contentWindow.document.body.innerHTML);
			
			// uncomment next to return form back after first query
			
			/*
			obForm.target = '';
			obForm.removeChild(obForm.lastChild);
			document.body.removeChild(obFrame);
			*/
		}
		
		if (obFrame.addEventListener) 
		{
			obFrame.addEventListener("load", __formResultHandler, false);
		}
		else if (obFrame.attachEvent) 
		{
			obFrame.attachEvent("onload", __formResultHandler);
		}
	}
	
	this.MigrateFormToAjax = function(obForm, handler)
	{
		if (!obForm) 
			return;
		if (obForm.target && obForm.target.substring(0, 5) == 'AJAX')
			return;
		
		var obAJAXIndicator = document.createElement('INPUT');
		obAJAXIndicator.type = 'hidden';
		obAJAXIndicator.name = 'AJAX_CALL';
		obAJAXIndicator.value = 'Y';
		
		obForm.appendChild(obAJAXIndicator);
		
		var frameName = 'AJAX_' + Math.round(Math.random() * 100000);
		
		if (document.getElementById('frameName'))
			var obFrame = document.getElementById('frameName');
		else
		{
			if (currentBrowserDetected == 'IE')
				var obFrame = document.createElement('<iframe name="' + frameName + '"></iframe>');
			else
				var obFrame = document.createElement('IFRAME');
			
			obFrame.style.display = 'none';
			obFrame.src = '';
			obFrame.id = frameName;
			obFrame.name = frameName;
			
			document.body.appendChild(obFrame);
		}
		
		obForm.target = frameName;
		
		this.__migrateSetHandler(obForm, obFrame, handler);
	}
}

var CPHttpRequest = new JCPHttpRequest();

var currentBrowserDetected = "";
if (window.opera)
	currentBrowserDetected = "Opera";
else if (navigator.userAgent)
{
	if (navigator.userAgent.indexOf("MSIE") != -1)
		currentBrowserDetected = "IE";
	else if (navigator.userAgent.indexOf("Firefox") != -1)
		currentBrowserDetected = "Firefox";
}
		

/* End */
;; /* /bitrix/templates/bikecenter_main/script.js*/
; /* /bitrix/templates/bikecenter_main/components/bitrix/sale.ajax.locations/city_serch/proceed.js*/
; /* /bitrix/templates/bikecenter_main/components/bitrix/search.suggest.input/.default/script.js*/
; /* /bitrix/js/main/cphttprequest.js*/
