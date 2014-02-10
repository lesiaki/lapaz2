//Get All Drinks belong to a category
function getDrinksJQ(cat_id){
	$.post('call.php',{cat_id:cat_id},function(data){
	$('#displayDrinks').html(data);
	
	disable_input();
	});
	
}
//Get all registerd drink in register page
function getRegisteredDrinksJQ(cat_id){
	$.post('call.php',{cat_id_for_register:cat_id},function(data){
		$('#registeredDrinksTable').html(data);
	});
	
}
//Add drink from register page
function addDrink(){
	var drink_input = $('#drink_input').val();
	var cat_selected = $('#cat_selected').val();
	var buy_price = $('#buy_price').val();
	var selling_price = $('#selling_price').val();
	
	
	if(selling_price==""){$('#alert').html("You must enter selling price");}
	if(buy_price ==""){$('#alert').html("You must enter the buy price");}
	if(drink_input ==""){$('#alert').html("You must enter the drink name");}
	
	if(cat_selected == "Select Category"){$('#alert').html("You must Select Category for a drink");}
	if(drink_input !="" && buy_price !="" && selling_price !="" && cat_selected != "Select Category"){
		
		$.post('call.php',{drink_input:drink_input,cat_selected:cat_selected,buy_price:buy_price,selling_price:selling_price},function(data){
			$('#registeredDrinksTable').html(data);
			$('#drink_input').val("");
			$('#buy_price').val("");
			$('#selling_price').val("");
			$('#alert').html("");
	
		});
	}
	
}
//Add Category from register page
function addRegisterCat(){
	var input_cat = $('#input_cat').val();
	if(input_cat ==""){$('#alertLeft').html("You must enter the category name");}
	if(input_cat !=""){
		$('#alertLeft').html("");
		$.post('call.php',{input_cat:input_cat},function(data){
			$('#registeredCategoryTable').html(data);
			$('#input_cat').val("");
		});
	}
}

function deleteCategory(cat_id){
	var delete_cat_id;
	$.post('call.php',{delete_cat_id:cat_id},function(data){
		$('#registeredCategoryTable').html(data);
	});
}
function deleteDrink(drink_id){
	var cat_sel = $('#cat_selected').val();
	$.post('call.php',{delete_drink_id:drink_id,cat_id_For_dlt:cat_sel},function(data){
		$('#registeredDrinksTable').html(data);
	});
}

// function updateSelect(){
	// $.post('call.php',{updateSelection:1},function(data){
		// $('#cat_selected').append(data);
		// //$("#cat_selected").append($("<option></option>").val("-1").html("Select V category"));
	// });
// }
function searchRecords(){
	var tarehe = $('#search_text').val();
	$.post('call.php',{displayRecordsView:tarehe},function(data){
		$('#searchDisplay').html(data);
	});
}
function addUser(){
	var status = $('#status_sel').val();
	var user = $('#user').val();
	var pass = $('#pass').val();
	
	if(user!="" && pass !="" && status != "select_status" && user!="admin" && pass !="admin"){
		$.post('call.php',{user:user,pass:pass,status:status},function(data){
			//Clear input
			$('#user').val("");
			$('#pass').val("");
			//Update user list
			$('#userList').html(data);
		})
	}
}

function deleteUser(user_id){
	$.post('call.php',{deleteUserID:user_id},function(data){
		$('#userList').html(data);
	});
}

function change(){
	var current_pass = $('#current_pass').val();
	var new_pass = $('#new_pass').val();
	$.post('call.php',{current_pass:current_pass,new_pass:new_pass},function(data){
		$('#pwd_fb').html(data);
		//Clear inpu
		$('#current_pass').val("");
		$('#new_pass').val(""); 
		
	});
	
}
//View Specific Stock For a Specific Drink
function viewStockDrink(drink_id){
	
	var caT_id = $('#selecter_basic').val();
	
	$.post('call.php',{specificStockDrink:drink_id,caT_id:caT_id},function(data){
		$('#displayDrinks').html(data);
	});
}
//Stock functions
function cal1(obj){
	var open_stock_store = parseInt($(obj).val());
	//obtain id from belonging row
	var closing_balance_store = parseInt($(obj).parent().parent().find('#4in').val());
	var new_stock = parseInt($(obj).parent().parent().find('#2in').val());
	//Calculate 
	var issued_counter;
	issued_counter = parseInt((new_stock + open_stock_store) - closing_balance_store);
	//Assign
	$(obj).parent().parent().find('#3in').val(issued_counter);
	//Assing to received from store
	$(obj).parent().parent().find('#6in').val(issued_counter);
	//update
	updateSold(obj);
	
}
function cal2(obj){
	var new_stock = parseInt($(obj).val());
	//obtain id from belonging row
	var closing_balance_store = parseInt($(obj).parent().parent().find('#4in').val());
	var open_stock_store = parseInt($(obj).parent().parent().find('#1in').val());
	//Calculate 
	var issued_counter;
	issued_counter = parseInt((new_stock + open_stock_store) - closing_balance_store);
	//Assign 
	$(obj).parent().parent().find('#3in').val(issued_counter);
	//Assing to received from store
	$(obj).parent().parent().find('#6in').val(issued_counter);
	//update
	updateSold(obj);
	
}
function cal4(obj){
	
	var closing_balance_store = parseInt($(obj).val());
	//obtain id from belonging row
	var new_stock = parseInt($(obj).parent().parent().find('#2in').val());
	var open_stock_store = parseInt($(obj).parent().parent().find('#1in').val());
	//Calculate 
	var issued_counter;
	issued_counter = parseInt((new_stock + open_stock_store) - closing_balance_store);
	//Assign
	$(obj).parent().parent().find('#3in').val(issued_counter);
	//Assing to received from store
	$(obj).parent().parent().find('#6in').val(issued_counter);
	//update
	updateSold(obj);
	
	
}
//Counter functions
function cal5(obj){
	var open_counter = parseInt($(obj).val());
	//obtain id from belonging row
	var received_from_store = parseInt($(obj).parent().parent().find('#6in').val());
	var closing_stock_counter = parseInt($(obj).parent().parent().find('#8in').val());
	//Calculate 
	var sold;
	sold = parseInt((open_counter + received_from_store) - closing_stock_counter);
	//Assign
	$(obj).parent().parent().find('#7in').val(sold);
	//Assing to received from store
	$(obj).parent().parent().find('#3in').val(received_from_store);
	updateSold(obj);
}
function cal8(obj){
	var closing_stock_counter = parseInt($(obj).val());
	//obtain id from belonging row
	var received_from_store = parseInt($(obj).parent().parent().find('#6in').val());
	var open_counter = parseInt($(obj).parent().parent().find('#5in').val());
	//Calculate 
	var sold;
	sold = parseInt((open_counter + received_from_store) - closing_stock_counter);
	//Assign
	$(obj).parent().parent().find('#7in').val(sold);
	//Assing to received from store
	//$(obj).parent().parent().find('#3in').val(received_from_store);
	updateSold(obj);
	
}

function updateSold(obj){
	var open_counter = parseInt($(obj).parent().parent().find('#5in').val());
	var received_from_store = parseInt($(obj).parent().parent().find('#6in').val());
	var closing_stock_counter = parseInt($(obj).parent().parent().find('#8in').val());
	var sold;
	//alert(open_counter+" "+received_from_store+" "+closing_stock_counter)
	sold = parseInt((open_counter + received_from_store) - closing_stock_counter);
	//Assign
	$(obj).parent().parent().find('#7in').val(sold);
	//Assing to received from store
	//$(obj).parent().parent().find('#3in').val(received_from_store);
	/* Update Sells*/
	var selling_price = parseInt($(obj).parent().parent().find('#selling_price').val());
	
	$(obj).parent().parent().find('#sells_value').html(calSells(sold,selling_price));
}

function calSells(sold,selling_price){
	var sells = sold*selling_price;
	return sells;
}
function setCursor(object){
		_this = $(object);
		
		//1in stand for first_input_value
		
		if(_this.find('#1in').val() == ""){
			_this.find('#1in').addClass('rangi');
			_this.find('#1in').prop('disabled', false);
			
		}else {
			_this.find('#2in').addClass('rangi');
			_this.find('#2in').prop('disabled', false);
		}
		if(_this.find('#2in').val() != ""){
			_this.find('#4in').addClass('rangi');
			_this.find('#4in').prop('disabled', false);
		}
		if(_this.find('#5in').val() == ""){
			_this.find('#5in').addClass('rangi');
			_this.find('#5in').prop('disabled', false);
		}
		if(_this.find('#5in').val() != ""){
			_this.find('#8in').addClass('rangi');
			_this.find('#8in').prop('disabled', false);
		}
		
		
}

function disable_input() {
  	
  	$('.1in').attr('disabled','disabled');
	$('.2in').attr('disabled','disabled');
	$('.3in').attr('disabled','disabled');
	$('.4in').attr('disabled','disabled');
	$('.5in').attr('disabled','disabled');
	$('.6in').attr('disabled','disabled');
	$('.7in').attr('disabled','disabled');
	$('.8in').attr('disabled','disabled');
	
  };

function anable_input() {
	$('#1in').prop('disabled', false);
	$('#2in').prop('disabled', false);
	$('#3in').prop('disabled', false);
	$('#4in').prop('disabled', false);
	$('#5in').prop('disabled', false);
	$('#6in').prop('disabled', false);
	$('#7in').prop('disabled', false);
	$('#8in').prop('disabled', false);
 };
function validate(){
	if($('#muuzaji_name').val() == ""){
	$('#validate_feedback').html("You must enter the name of the seller");
	return false;
	}
	if($('#siku').val() == ""){
	$('#validate_feedback').html("You must enter the day name");
	return false;
	}
	if($('#selecter_basic').val() == "Select Category"){
	$('#validate_feedback').html("You must select category");
	return false;
	}
	$.post('call.php',{checked_date:$('#trh').val()},function(data){
		if(data == 1){
		$('#validate_feedback').html("You must change date, that date already exit with another records");
		return false;
		}
	});
	
}
function trendy(drink_id){
	var date_from = $('#date_from').val();
	var date_to = $('#date_to').val();
	if(date_from =="date_from" && date_to=="date_to"){
		$('#showTrendy').html("You must select dates");
	}else{
		$.post('call.php',{date_from:date_from,date_to:date_to,drink_id:drink_id},function(data){
		$('#showTrendy').html(data);
	});
	}
	
}

function dltRow(sid,did){
	var cat = $("#selecter_basic").val();
	$.post('call.php',{sid:sid,did:did,cat:cat},function(data){
		$('#displayDrinks').html(data);
	});
}
/*
$(function() {
var fixadent = $("#fixadent"), pos = fixadent.offset();
$(window).scroll(function() {
if($(this).scrollTop() > (pos.top + 10) && fixadent.css('position') == 'static') { fixadent.addClass('fixed'); }
else if($(this).scrollTop() <= pos.top && fixadent.hasClass('fixed')){ fixadent.removeClass('fixed'); }
})
});
*/
function getTotalNumberOfRow(){};


