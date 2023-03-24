
function filterProducts($precioMenor, $precioMayor) {

	$precioMenor = parseInt($precioMenor);
	$precioMayor = parseInt($precioMayor);

	// Remove any previous search
	$productsList.removeClass('match-search');
	// If pervious search show no matches message remove it.
	jQuery('.no-matches').remove();

	// Check if not empty search input value filter students.
	// Else show all students.
	if($precioMenor < $precioMayor){

		// Hide all students list.
		$productsList.hide();
		// Loop through students details and check if any text (name, email) match search input value.
		$productDetails.each(function () {
			if($precioMenor <= parseInt(jQuery(this).find('.product-precio').html()) && parseInt(jQuery(this).find('.product-precio').html()) <= $precioMayor){

				// Show match list.
				jQuery(this).parent().show();
				// Add new class to match list to collect all students to pass them to paginate function.
				jQuery(this).parent().addClass('match-search');
			}
		});
		// Select all lists that have .match-search class.
		$productsList = jQuery('.match-search');
		$productsCount = $productsList.length;

		// Check if students count is 0 show no result message.
		if($productsCount === 0){
			var $noResultMessage = '<p class="no-matches">No se encontraron productos</p>';
			jQuery('#lista_productos').append($noResultMessage);
		}
	}
	else{
		// Hide all students list.
		$productsList.hide();
		// Loop through students details and check if any text (name, email) match search input value.
		$productDetails.each(function () {
			if(jQuery(this).find('.product-precio').html() == $precioMayor){
				// Show match list.
				jQuery(this).parent().show();
				// Add new class to match list to collect all students to pass them to paginate function.
				jQuery(this).parent().addClass('match-search');
			}
		});
		// Select all lists that have .match-search class.
		$productsList = jQuery('.product-container .match-search');
		$productsCount = $productsList.length;
		// Check if students count is 0 show no result message.
		if($productsCount === 0){
			var $noResultMessage = '<p class="no-matches">Sorry, there are no matches!</p>';
			jQuery('.product-container').append($noResultMessage);
		}
	}
	// Call paginate function and pass currentPage which equal 1 and the new students lists.
	paginate(1, $productsList);
}

/*
* Add pagination links to page.
*/
function addPaginationLinks($numberOfPages) {
	// Remove any previous pagination.
	jQuery('.div-pagination').remove();
	if($numberOfPages > 1){
		var $pagination = '';
		$pagination += '<div class="col s12 div-pagination">';
		$pagination += '<ul class="pagination right">';
		for (var i = 1; i <= $numberOfPages; i++) {
			$pagination += '<li><a href="javascript:void(0)" class="page">'+i+'</a></li>';
		}
		$pagination += '</ul>';

		$page.append($pagination);
	}
}

/*
* Paginate through current page and current students lists.
*/
function paginate($currentPage, $productsList) {
	// Hide students lists
	$productsList.hide();
	// Show current page data.
	$productsList.slice(($currentPage -1) * itemsPerPage, $currentPage * itemsPerPage).show();
	// Check if current page is page one call addPaginationLinks and clickPage functions.
	if($currentPage === 1){
		$numberOfPages = Math.ceil($productsCount / itemsPerPage);
		addPaginationLinks($numberOfPages);
		clickPage();
	}
	// set active class
	jQuery('.div-pagination ul li').removeClass("active");
	jQuery('.div-pagination ul li:nth-child('+ ($currentPage) +')').addClass("active");
}

/*
* On click search pagination li.
* Get currentPage and pass it and current students lists to paginate function.
*/
function clickPage() {
	jQuery('.div-pagination ul li').on("click", function(){
		$currentPage = parseInt(jQuery(this).text());
		paginate($currentPage, $productsList);
	});
}


function filterProducts2($precioMenor, $precioMayor) {

	$precioMenor = parseInt($precioMenor);
	$precioMayor = parseInt($precioMayor);

	// Remove any previous search
	$productsList.removeClass('match-search');
	// If pervious search show no matches message remove it.
	jQuery('.no-matches').remove();

	// Check if not empty search input value filter students.
	// Else show all students.
	if($precioMenor < $precioMayor){

		// Hide all students list.
		$productsList.hide();
		// Loop through students details and check if any text (name, email) match search input value.
		$productDetails.each(function () {
			if($precioMenor <= parseInt(jQuery(this).find('.product-precio').html()) && parseInt(jQuery(this).find('.product-precio').html()) <= $precioMayor){

				// Show match list.
				jQuery(this).parent().show();
				// Add new class to match list to collect all students to pass them to paginate function.
				jQuery(this).parent().addClass('match-search');
			}
		});
		// Select all lists that have .match-search class.
		$productsList = jQuery('.match-search');
		$productsCount = $productsList.length;

		// Check if students count is 0 show no result message.
		if($productsCount === 0){
			var $noResultMessage = '<p class="no-matches">No se encontraron productos</p>';
			jQuery('#lista_productos').append($noResultMessage);
		}
	}
	else{
		// Hide all students list.
		$productsList.hide();
		// Loop through students details and check if any text (name, email) match search input value.
		$productDetails.each(function () {
			if(jQuery(this).find('.product-precio').html() == $precioMayor){
				// Show match list.
				jQuery(this).parent().show();
				// Add new class to match list to collect all students to pass them to paginate function.
				jQuery(this).parent().addClass('match-search');
			}
		});
		// Select all lists that have .match-search class.
		$productsList = jQuery('.product-container .match-search');
		$productsCount = $productsList.length;
		// Check if students count is 0 show no result message.
		if($productsCount === 0){
			var $noResultMessage = '<p class="no-matches">Sorry, there are no matches!</p>';
			jQuery('.product-container').append($noResultMessage);
		}
	}
	// Call paginate function and pass currentPage which equal 1 and the new students lists.
	paginate2(1, $productsList);
}

/*
* Add pagination links to page.
*/
function addPaginationLinks2($numberOfPages) {
	// Remove any previous pagination.
	jQuery('.div-pagination2').remove();
	if($numberOfPages > 1){
		var $pagination = '';
		$pagination += '<div class="col s12 div-pagination2">';
		$pagination += '<ul class="pagination2 right">';
		for (var i = 1; i <= $numberOfPages; i++) {
			$pagination += '<li><a href="javascript:void(0)" class="page">'+i+'</a></li>';
		}
		$pagination += '</ul>';

		$page.append($pagination);
	}
}

/*
* Paginate through current page and current students lists.
*/
function paginate2($currentPage, $productsList) {
	// Hide students lists
	$productsList.hide();
	// Show current page data.
	$productsList.slice(($currentPage -1) * itemsPerPage, $currentPage * itemsPerPage).show();
	// Check if current page is page one call addPaginationLinks and clickPage functions.
	if($currentPage === 1){
		$numberOfPages = Math.ceil($productsCount / itemsPerPage);
		addPaginationLinks2($numberOfPages);
		clickPage2();
	}
	// set active class
	jQuery('.div-pagination2 ul li').removeClass("active");
	jQuery('.div-pagination2 ul li:nth-child('+ ($currentPage) +')').addClass("active");
}

/*
* On click search pagination li.
* Get currentPage and pass it and current students lists to paginate function.
*/
function clickPage2() {
	jQuery('.div-pagination2 ul li').on("click", function(){
		$currentPage2 = parseInt(jQuery(this).text());
		paginate2($currentPage2, $productsList2);
	});
}