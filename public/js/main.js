/* ========================================
    Declare all global variables of document 
    and spell check
   ====================================== */
var myDoc;
var sentences;
var words;
var startPosition;
var endPosition;
var isrequest = true;
var lastLength = 0;
var promtWords;
var endMarks;

/* ========================================
    Debug post request
   ====================================== */
function debug(response) {
	console.log(response);
}
/* ========================================
    Change the name of the title
   ====================================== */
$('.doc-title').change(() => {
	const title = $('.doc-title').val();
	$('#webpage-title').html(title);
	post_request('/saveuser', title, 'debug');
});

function key_events(key, callback) {
	$('#mydocument').keydown((e) => {
		const code = e.keyCode || e.which;
	if (code === key) {
		e.preventDefault();
		window[callback]();
	}
	});
}

/* ========================================
    Get positon of pointer on the document
   ====================================== */
$('#mydocument').click(function () {
	startPosition = this.selectionStart;
	endPosition = this.selectionEnd;
	// Check if you've selected text
	if (startPosition == endPosition) {
		console.log(`The position of the cursor is (${startPosition}/${$(this).val().length})`);
	} else {
		console.log(`Selected text from (${startPosition} to ${endPosition} of ${$(this).val().length})`);
	}
});
/* ========================================
    Update on every change of text
   ====================================== */
$('#mydocument').on('input', () => {
	myDoc = $('#mydocument').val();
	$('#mypage').html(myDoc);
	words = $('#mydocument').val().split(/([, ])/g);
	let no_words = $.trim($('#mydocument').val()).split(' ').filter(function(w){return w!==''}).length;
	$('#docstat_words').text(`${no_words} сөз`);
	animateLoading(true);
	if (isrequest && words.length > 1) {
		check_question_mark(myDoc);
		lastLength = myDoc.length;
		animateLoading(false);
	}
	if ($('#mydocument').val().length == 0) {
		$('.word-promt__words').empty();
		animateLoading(false);
	}
	if (words[words.length - 1].length > 0) {
		check_promtWords();
		lastLength = myDoc.length;
		animateLoading(false);
	}
});

/* ========================================
    Promted words
   ====================================== */
function check_promtWords() {
	post_request('/promtwords', words, 'suggest_promtWords');
}
function suggest_promtWords(promtWords) {
	$('.word-promt__words').empty();
	$.each(promtWords, (index, item) => {
		$('.word-promt__words').append(`<li class="word-promt__words_${index}"><a href="">${item.word}</a><span>${item.description}</span></li>`);
	});
}

/* ========================================
    Check the end mark for correctness
   ====================================== */
function check_question_mark() {
	sentences = myDoc.split(/([\.\!\?])/g);
	console.log();
	let no_sentences = sentences.length;
	$('#docstat_sentences').text(`${no_sentences} сүйлөм`);
	const response = post_request('/isquestionmark', sentences, 'suggest_end_marks');
}
function suggest_end_marks(end_marks) {
	$('.mistakes__table').empty();
	$.each(end_marks.fixes, (index, item) => {
		$('.mistakes__table').append(`<li><a href="#">Тыныш белги: ${item[2]}</a></li>`);
		applyHighlights(item[1]);
	});
}

/* ========================================
    Post request function
   ====================================== */
function post_request(end_point, post_arr, callback='') {
	isrequest = false;
	post_arr = JSON.stringify(post_arr);
	setTimeout(() => {
		isrequest = true;
	}, 3000);
	$.post(end_point, { data: post_arr }, (response) => {
		response = JSON.parse(response);
		window[callback](response);
	});
}

/* ========================================
    Mark as an error
   ====================================== */
function applyHighlights(mark) {
	const re = new RegExp(`\\${mark}`);
	const replace = `<mark>${mark}</mark>`;
	const marked_text = myDoc.replace(re, replace);
	$('#mypage').html(marked_text);
}
/* ========================================
    Toggle animation
   ====================================== */
function animateLoading(isLoading){
	if(isLoading){
		$('.loading-title').removeClass('hidden');
		$('.lds-ellipsis div:nth-child(1)').addClass('loading-animate-1');
		$('.lds-ellipsis div:nth-child(2)').addClass('loading-animate-2');
		$('.lds-ellipsis div:nth-child(3)').addClass('loading-animate-3');
		$('.lds-ellipsis div:nth-child(4)').addClass('loading-animate-4');
	}else{
		$('.loading-title').addClass('hidden');
		$('.lds-ellipsis div:nth-child(1)').removeClass('loading-animate-1');
		$('.lds-ellipsis div:nth-child(2)').removeClass('loading-animate-2');
		$('.lds-ellipsis div:nth-child(3)').removeClass('loading-animate-3');
		$('.lds-ellipsis div:nth-child(4)').removeClass('loading-animate-4');
	}
}
/* ========================================
    Check every 5 sec. if something is missing
   ====================================== */
window.setInterval(() => {
	myDoc = $('#mydocument').val();
	animateLoading(false);
	if (myDoc.length > 0 && lastLength != myDoc.length) {
		check_question_mark();
	}
}, 5000);
