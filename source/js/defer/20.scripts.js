/**
 * DMS Child - Scripts Defer
 */

console.log("DMS Parent Scripts - Defer");


// Init Offcanvas Elements
var offcanvasElementList = [].slice.call(document.querySelectorAll('.offcanvas'))
var offcanvasList = offcanvasElementList.map(function (offcanvasEl) {
  return new bootstrap.Offcanvas(offcanvasEl)
})

// Watch for sticky element triggering
function watch_sticky_top() {
	const el = document.querySelector(".sticky-top");
	if ( typeof el !== "undefined" && el !== null ) {
		const observer = new IntersectionObserver(
		  ([e]) => e.target.classList.toggle("is-pinned", e.intersectionRatio < 1),
		  { threshold: [1] }
		);
		observer.observe(el);
	}
}
watch_sticky_top();

// Watch for Top
function watch_body_top() {
	const el = document.querySelector("#dms_detect_top");
	if ( typeof el !== "undefined" && el !== null ) {
		const observer = new IntersectionObserver(e => {
			  let body = document.getElementsByTagName("BODY")[0];
			  body.classList.toggle("is-top", e[0].boundingClientRect.y > 0);
			  body.classList.toggle("past-top", e[0].boundingClientRect.y <= 0);
			},
			{ threshold: [1] }
		);
		observer.observe(el);
	}
}
watch_body_top();


jQuery(document).ready(function($) {

	// Tooltips
	$(function () {
	  $('[data-bs-toggle="tooltip"]').tooltip()
	})

	// Offcanvas show
	$("[data-dms-toggle=offcanvas]").on("click", function(event) {
		offcanvasList[0].show();
	});

	// Offcanvas close on menu click
	$(".offcanvas").on("click", "a", function(event) {
		if ( this.hasAttribute("data-bs-target") == false ) {
			offcanvasList[0].hide();
		}
	});

	// Yoast FAQ Open
	$(".schema-faq-question").on("click", function(event) {
		var $question = $(this);
		var $answer = $question.siblings(".schema-faq-answer");
		if ( $answer.length ) {
			if ( $answer.is(":visible") ) {
				$question.removeClass("show");
				$answer.slideUp();
			} else {
				$question.addClass("show");
				$answer.slideDown();
			}
		}
	});

});
