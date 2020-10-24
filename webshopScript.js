discount = 0;


if (localStorage.discount) 
{
	retrievedDiscount = localStorage.getItem("discount");
	discount = Number(retrievedDiscount);
}

if (!sessionStorage.filter) 
{
	var filter = ["All", 0] 
	sessionStorage.setItem("filter", JSON.stringify(filter));		
}

function clearVouchers()
{
	localStorage.removeItem('discount');
}

function clearOrder()
{
	sessionStorage.removeItem('basket');
}


function myFunction() 
{
	var x = document.getElementById("topNav");
	if (x.className === "nav") 
	{
		x.className += " responsive";
	} 
	else 
	{
		x.className = "nav";
	}
}


function showOrder()
{
	if (sessionStorage.basket && sessionStorage.getItem('basket') != '[]') 
	{
		location.reload();		
	}
	else
	{
		document.getElementById("orderdetails").innerHTML = "No items present";	
	}	
}

function addBasket(shoeID)
{
	var itemQuantity = document.getElementById("quantity").value;
	var orderItem = [shoeID, itemQuantity];
	var order = [orderItem];
	var itemPresent = false;
	if (sessionStorage.basket) 
	{
		retrievedObject = sessionStorage.getItem('basket');
		var orderItemsArray = JSON.parse(retrievedObject);
		for (var i = 0; i < orderItemsArray.length; i++)
		{
			var temp = orderItemsArray[i];			
			if(temp[0] == shoeID)
			{
				temp[1] = temp[1] + itemQuantity;
				orderItemsArray[i] = temp; 
				itemPresent = true;				
			}


		}
		if(itemPresent == false)
		{
			orderItemsArray.push(orderItem);
		}
		sessionStorage.setItem("basket", JSON.stringify(orderItemsArray));
		
	}
	else
	{
		sessionStorage.setItem("basket", JSON.stringify(order));
	}
	alert("Item added to basket.");
}

function removeBasket(shoeID, itemQuantity)
{
	if (sessionStorage.basket) 
	{
		retrievedObject = sessionStorage.getItem('basket');
		var orderItemsArray = JSON.parse(retrievedObject);
		for (var i = 0; i < orderItemsArray.length; i++)
		{
			var temp = orderItemsArray[i];
			var tempArray
			if(temp[0] == shoeID)
			{
				orderItemsArray.splice(i, 1);				
			}
		}
		sessionStorage.setItem("basket", JSON.stringify(orderItemsArray));
		showOrder();
	}
}

function showTiles()
{
	var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() 
	{
		if (this.readyState == 4 && this.status == 200) 
		{
			document.getElementById("tiles").innerHTML = this.responseText;
        }
		else{
			document.getElementById("tiles").innerHTML = "failed2";
		}
    };
    xmlhttp.open("GET", "./php/ImagesTiles.php", true);
    xmlhttp.send();	
}

function addFilter()
{
	var retrievedFilter = sessionStorage.getItem('filter');
	var filter = JSON.parse(retrievedFilter);
	var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() 
	{
		if (this.readyState == 4 && this.status == 200) 
		{
			document.getElementById("filter").innerHTML = this.responseText;
        }
		else{
			document.getElementById("filter").innerHTML = "failed2";
		}
    };
    xmlhttp.open("GET", "./php/ShoeFilter.php?filter=" + filter , true);
    xmlhttp.send();	
}

function applyFilters()
{
	var size = document.getElementById("Sizes").value;
	var category = document.getElementById("Category").value;
	var filter = [category, size];
	sessionStorage.setItem("filter", JSON.stringify(filter));	
}

function showShopTiles()
{
		var xmlhttp = new XMLHttpRequest();
		var retrievedFilter = sessionStorage.getItem('filter');
		var filter = JSON.parse(retrievedFilter);
		
		document.getElementById("tiles").innerHTML = "failed";
		xmlhttp.onreadystatechange = function() 
		{
			if (this.readyState == 4 && this.status == 200) 
			{
				document.getElementById("tiles").innerHTML = this.responseText;
			}
			else{
				document.getElementById("tiles").innerHTML = "failed2";
			}
		};
		xmlhttp.open("GET", "./php/ShopTiles.php?filter=" + filter, true);
		xmlhttp.send();
		setFilter(filter);
	
}

function setFilter(filter) 
{    
    document.getElementById("cLabel").innerHTML = "Filter by category: Male Shoes";
}


function addFooter()
{
	var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() 
	{
		if (this.readyState == 4 && this.status == 200) 
		{
			document.getElementById("footer").innerHTML = this.responseText;
        }
		else{
			document.getElementById("footer").innerHTML = "failed to load footer";
		}
    };
    xmlhttp.open("GET", "./php/Footer.php", true);
    xmlhttp.send();	
}



function addTop()
{
	var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() 
	{
		if (this.readyState == 4 && this.status == 200) 
		{
			document.getElementById("top").innerHTML = this.responseText;
        }
		else{
			document.getElementById("top").innerHTML = "failed to load navigation";
		}
    };
    xmlhttp.open("GET", "./php/Top.php", true);
    xmlhttp.send();	
}

function callProductInfo(shoeID)
{
	var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() 
	{
		if (this.readyState == 4 && this.status == 200) 
		{
			document.getElementById("tiles").innerHTML = this.responseText;
        }
		else{
			document.getElementById("tiles").innerHTML = "failed to load product details";
		}
    };
    xmlhttp.open("GET", "./php/ProductInfo.php?ID=" + shoeID, true);
    xmlhttp.send();	
}

function showOrderDetails()
{
	if (sessionStorage.basket && sessionStorage.getItem('basket') != '[]') 
	{
		retrievedObject = sessionStorage.getItem('basket');
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() 
		{
			if (this.readyState == 4 && this.status == 200) 
			{
				document.getElementById("orderdetails").innerHTML = this.responseText;
			}
			else{
				document.getElementById("orderdetails").innerHTML = "failed to load order details";
			}
		};
		xmlhttp.open("GET", "./php/OrderDetails.php?order=" + retrievedObject + "&totaldiscount=" + discount, true);
		xmlhttp.send();
	}
	else
	{
		document.getElementById("orderdetails").innerHTML = "No items present";	
	}
}

function checkDifferentSize()
{
	var id = document.getElementById("shoeSize").value;
	callProductInfo(id);
}

function applyVoucher()
{
	var code = document.getElementById("vCode").value;	
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() 
	{
		if (this.readyState == 4 && this.status == 200) 
		{					
			document.getElementById("vouchers").innerHTML = this.responseText;
			discount = discount + Number(document.getElementById("vdiscount").value);
			localStorage.setItem("discount", discount);
			location.reload();
		}
		else{						
			document.getElementById("vStatus").innerHTML = "Failed to add voucher";
		}
	};
	xmlhttp.open("GET", "./php/Voucher.php?code=" + code, true);
	xmlhttp.send();	
}

function placeOrder(amount)
{
	if(document.getElementById("name").value)
	{
		var name = document.getElementById("name").value;
	}
	else
	{
		document.getElementById("lname").innerHTML = '<span class="missing">' + document.getElementById("lname").innerHTML + '</span>';
	}
	
	if(document.getElementById("address").value)
	{
		var address = document.getElementById("address").value;
	}
	else
	{
		document.getElementById("laddress").innerHTML = '<span class="missing">' + document.getElementById("laddress").innerHTML + '</span>';
	}
	
	
	if(document.getElementById("postcode").value)
	{
		var postcode = document.getElementById("postcode").value;
	}
	else
	{
		document.getElementById("lpostcode").innerHTML = '<span class="missing">' + document.getElementById("lpostcode").innerHTML + '</span>';
	}
	
	
	if(document.getElementById("city").value)
	{
		var city = document.getElementById("city").value;
	}
	else
	{
		document.getElementById("lcity").innerHTML = '<span class="missing">' + document.getElementById("lcity").innerHTML + '</span>';
	}
	
	if(document.getElementById("country").value)
	{
		var country = document.getElementById("country").value;
	}
	else
	{
		document.getElementById("lcountry").innerHTML = '<span class="missing">' + document.getElementById("lcountry").innerHTML + '</span>';
	}
	
	if(document.getElementById("phone").value)
	{
		var phone = document.getElementById("phone").value;
	}
	else
	{
		document.getElementById("lphone").innerHTML = '<span class="missing">' + document.getElementById("lphone").innerHTML + '</span>';
	}
	
	if(document.getElementById("email").value)
	{
		var email = document.getElementById("email").value;
	}
	else
	{
		document.getElementById("lemail").innerHTML = '<span class="missing">' + document.getElementById("lemail").innerHTML + '</span>';
	}
	
	var cardtype = document.getElementById("cardtype").value;
	
	if(document.getElementById("cname").value)
	{
		var cname = document.getElementById("cname").value;
	}
	else
	{
		document.getElementById("lcname").innerHTML = '<span class="missing">' + document.getElementById("lcname").innerHTML + '</span>';
	}
	
	if(document.getElementById("cdate").value)
	{
		var cdate = document.getElementById("cdate").value;
	}
	else
	{
		document.getElementById("lcdate").innerHTML = '<span class="missing">' + document.getElementById("lcdate").innerHTML + '</span>';
	}
	
	if(document.getElementById("caddress").value)
	{
		var caddress = document.getElementById("caddress").value;
	}
	else
	{
		document.getElementById("lcaddress").innerHTML = '<span class="missing">' + document.getElementById("lcaddress").innerHTML + '</span>';
	}
	
	if(document.getElementById("cardnumber").value)
	{
		var cardnumber = document.getElementById("cardnumber").value;
	}
	else
	{
		document.getElementById("lcardnumber").innerHTML = '<span class="missing">' + document.getElementById("lcardnumber").innerHTML + '</span>';
	}
	
	if(document.getElementById("securitycode").value)
	{
		var securitycode = document.getElementById("securitycode").value;
	}
	else
	{
		document.getElementById("lsecuritycode").innerHTML = '<span class="missing">' + document.getElementById("lsecuritycode").innerHTML + '</span>';
	}
	
	var retrievedBasket = sessionStorage.getItem('basket');
	if(retrievedBasket && amount && name && address && postcode && city && country && phone && email && cardtype && cname && caddress && cardnumber && cdate && securitycode)
	{
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() 
		{
			if (this.readyState == 4 && this.status == 200) 
			{
				document.getElementById("orderdetails").innerHTML = this.responseText;
				clearOrder();
				clearVouchers();
			}
			else{
				document.getElementById("orderdetails").innerHTML = "Failed to place order";
			}
		};
		xmlhttp.open("GET", "./php/PlaceOrder.php?order=" + retrievedBasket
		+ "&amount=" + amount	
		+ "&name=" + name
		+ "&address=" + address
		+ "&postcode=" + postcode
		+ "&city=" + city
		+ "&country=" + country
		+ "&phone=" + phone
		+ "&email=" + email
		+ "&cardtype=" + cardtype
		+ "&cname=" + cname
		+ "&caddress=" + caddress
		+ "&cardnumber=" + cardnumber
		+ "&cdate=" + cdate 
		+ "&securitycode=" + securitycode 	
		, true);
		xmlhttp.send();	
	}
}





