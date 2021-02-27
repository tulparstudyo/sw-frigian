/**
 * Specific JS for the elegance theme
 * 
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2014
 */
var frigian = {
	"hello": function () {
		console.log('5e3f3a70f0e7e751bdf23ad726449141');
	},
	"getURLVar": function (key, url) {
		var value = [];

		var query = String(url).split('?');

		if (query[1]) {
			var part = query[1].split('&');

			for (i = 0; i < part.length; i++) {
				var data = part[i].split('=');

				if (data[0] && data[1]) {
					value[data[0]] = data[1];
				}
			}

			if (value[key]) {
				return value[key];
			} else {
				return '';
			}
		}
	},
	"loadLocaleImage": function (input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				let thumb = $(input).parents('frigian-img').find('.image');
				$(thumb).attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
}
$(document).ready(function () {
	frigian.hello();
	$('body').on('click', '.locale-select-language a', function (e) {
		e.preventDefault();
		document.cookie = "locale=" + frigian.getURLVar('locale', $(this).attr('href')) + ";  Path=/;expires=Fri, 31 Dec 9999 23:59:59 GMT";
		window.location.reload();
	});
	$('body').on('click', '.locale-select-currency a', function (e) {
		e.preventDefault();
		document.cookie = "currency=" + frigian.getURLVar('currency', $(this).attr('href')) + ";  Path=/;expires=Fri, 31 Dec 9999 23:59:59 GMT";
		window.location.reload();
	});
	$('body').on('change', '.frigian-img .image-file', function () {
		alert();
		frigian.loadLocaleImage(this);
	});


	$(".product__box form").on("submit", function (ev) {

		Aimeos.createOverlay();
		$.post($(this).attr("action"), $(this).serialize(), function (data) {
			Aimeos.createContainer(AimeosBasketStandard.updateBasket(data));
		});

		return false;
	});

	/*$(".menu-item a").hover(function () {
		$(this).toggleClass("hover");
	

		$(".menu-content .hover .dropdown").toggle();

	});*/

	$(".menu-item ").hover(function () {
		$(this).toggleClass("hover");
		$(".menu-item.hover .dropdown.frigian-dropdown").css("display","inline-block");
	}, function () {
		$(this).removeClass("hover");
		$(".menu-item  .dropdown.frigian-dropdown").css("display","none");
	});

	$(".dropdown.frigian-dropdown li").hover(function () {
		$(this).toggleClass("hover-frigian");
		$(".hover-frigian .dropdown.child-dropdown").css("display","inline-block");
	}, function () {
		$(this).removeClass("hover");
		$(".hover-frigian .dropdown.child-dropdown").css("display","none");
	});



	AimeosBasketMini.updateBasket = function (basket) {

		if (!(basket.data && basket.data.attributes)) {
			return;
		}

		var attr = basket.data.attributes;
		var price = Number.parseFloat(attr['order.base.price']);
		var delivery = Number.parseFloat(attr['order.base.costs']);


		var formatter = new Intl.NumberFormat([], {
			currency: attr['order.base.currencyid'],
			style: "currency"
		});

		$(".aimeos .basket-mini-main .value").html(formatter.format(price + delivery));
		$(".aimeos .basket-mini-product .total .price").html(formatter.format(price + delivery));
		$(".aimeos .basket-mini-product .delivery .price").html(formatter.format(delivery));

		if (basket.included) {

			var csrf = '';
			var count = 0;
			var body = $(".aimeos .basket-mini-product .basket-body");
			var prototype = $(".aimeos .basket-mini-product .product.prototype");

			if (basket.meta && basket.meta.csrf) {
				csrf = basket.meta.csrf.name + '=' + basket.meta.csrf.value;
			}

			$(".aimeos .basket-mini-product .product").not(".prototype").remove();

			for (var i = 0; i < basket.included.length; i++) {
				var entry = basket.included[i];

				if (entry.type === 'basket/product') {
					var product = prototype.clone();

					product.data("urldata", csrf);
					product.data("url", entry.links.self.href);
					console.log(entry.attributes);
					$(".name", product).html(entry.attributes['order.base.product.name']);
					$(".quantity", product).html(entry.attributes['order.base.product.quantity']);
					$(".price", product).html(formatter.format(entry.attributes['order.base.product.price']));
					$(".product-image", product).attr("src", "/" + entry.attributes['order.base.product.mediaurl']);
					body.append(product.removeClass("prototype"));

					count += Number.parseInt(entry.attributes["order.base.product.quantity"]);
				}
			}

			$(".aimeos .basket-mini-main .quantity").html(count);
		}
	}





});
$('.product-image--large-horizontal').slick({
	slidesToShow: 1,
	slidesToScroll: 1,
	arrows: false,
	fade: true,
});
$('.product-image--thumb-horizontal').slick({
	slidesToShow: 3,
	slidesToScroll: 1,
	focusOnSelect: true,
	prevArrow: '<button type="button" class="gallery__nav gallery__nav-horizontal gallery__nav-horizontal--left prevArrow"><i class="fas fa-chevron-left"></i></button>',
	nextArrow: '<button type="button"  class="gallery__nav gallery__nav-horizontal gallery__nav-horizontal--right nextArrow"><i class="fas fa-chevron-right"></i></button>'
});


$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
	console.log("tab shown...");
	localStorage.setItem('activeTab', $(e.target).attr('href'));
});

// read hash from page load and change tab
var activeTab = localStorage.getItem('activeTab');
if (activeTab) {
	$('.nav-tabs a[href="' + activeTab + '"]').tab('show');
}


