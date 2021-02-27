function sw_popup(url) {
	Aimeos.createOverlay();
	$.ajax({
		url: url,
		dataType: 'html',
		headers: {
			"X-Requested-With": "jQuery"
		}
	}).done(function (data) {
		if (data.length <= 0) {
			data = 'Error';
		}
		Aimeos.createContainer(data);
	});
	return false;
};
$(document).ready(function () {
	$('a.sw_popup').on('click', function (e) {
		e.preventDefault();
		sw_popup($(this).attr('href'));
		return false;
	});
	$('body').on('click', '.sw_confirm', function (e) {
		e.preventDefault();
		Aimeos.createOverlay();
		var data = '<div class="popup-message">' + $(this).data('message') + '<br><a class="action-' + $(this).data('action') + '" href="' + $(this).attr('href') + '">' + $(this).data('text') + '</a>';
		Aimeos.createContainer(data);
		return false;
	});
	$(".checkout-standard-address-billing,.checkout-standard-address-delivery").off();
	$(".checkout-standard-address-billing,.checkout-standard-address-delivery").on("click", ".header input",
		function (ev) {

			// $(".form-list", ev.delegateTarget).slideToggle( "slow" );
			// $(".item-address", ev.delegateTarget).has(this).find(".form-list").slideDown(400);
			$(".item-address", ev.delegateTarget).has(this).find(".form-list").slideToggle("slow");

		});

	$(".checkout-standard-delivery, .checkout-standard-payment").off();
	$(".checkout-standard-delivery, .checkout-standard-payment").on("click", ".option", function (ev) {

		/*$(".form-list", ev.delegateTarget).slideUp(400);

		$(".item-service", ev.delegateTarget).has(this).find(".form-list").slideDown(400);*/
		$(".item-service", ev.delegateTarget).has(this).find(".form-list").slideToggle("slow");

	});


	$(".account-history .history-item").off();

	$(".account-history .action a.btn").on("click", function (ev) {

		ev.delegateTarget = $(this).parents(".history-item");
		var details = $(".account-history-order", ev.delegateTarget);
		var process_table = ev.delegateTarget.find(".process-table");
		if (details.length === 0) {
			$.get($(this).attr("href"), function (data) {
				var doc = document.createElement("html");
				doc.innerHTML = data;
				var node = $(".account-history-order", doc);
				node.css("display", "none");
				$(ev.delegateTarget).append(node);
				node.slideToggle();
				process_table.slideToggle();
			});
		} else {
			details.slideToggle();
			process_table.slideToggle();
		}
		return false;
	});





});



