$(function(){
	$("#MarkupPriceOnOtherSite, #MarkupMarkup").keypress(function(e){
		if(e.which == 13){
			e.preventDefault();
			calculate();
		}
	});
	
	function calculate(){
		var price = parseFloat($("#MarkupPriceOnOtherSite").val());
		var markup = parseFloat($("#MarkupMarkup").val()) + 1;
		
		var total = (price * markup).toFixed(2);
		var boxngocut = (total * .1).toFixed(2);
		var stripefees = ((total * .029) + .3).toFixed(2);
		var boxngoprofit = (boxngocut - stripefees).toFixed(2);
		var sellerprofit = (total - boxngocut - price).toFixed(2);
		
		//Total Price
		$("b#totalprice").text(total);
		
		//BOXNGO Cut
		$("b#boxngocut").text(boxngocut);
		
		//Stripe Fees
		$("b#stripefees").text(stripefees);
		
		//BOXNGO Profit
		$("b#boxngoprofit").text(boxngoprofit);
		
		//Seller Profit
		$("b#sellerprofit").text(sellerprofit);
	}
});