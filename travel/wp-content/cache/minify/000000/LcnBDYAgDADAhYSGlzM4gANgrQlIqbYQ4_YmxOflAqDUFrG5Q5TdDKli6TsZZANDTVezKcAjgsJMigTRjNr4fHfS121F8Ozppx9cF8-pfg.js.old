(function($) {

	if (typeof _wpcf7 == 'undefined' || _wpcf7 === null) {
		_wpcf7 = {};
	}

	_wpcf7 = $.extend({
		cached: 0
	}, _wpcf7);

	$.fn.wpcf7InitForm = function() {
		this.ajaxForm({
			beforeSubmit: function(arr, $form, options) {
				$form.wpcf7ClearResponseOutput();
				$form.find('[aria-invalid]').attr('aria-invalid', 'false');
				$form.find('img.ajax-loader').css({ visibility: 'visible' });
				return true;
			},
			beforeSerialize: function($form, options) {
				$form.find('[placeholder].placeheld').each(function(i, n) {
					$(n).val('');
				});
				return true;
			},
			data: { '_wpcf7_is_ajax_call': 1 },
			dataType: 'json',
			success: $.wpcf7AjaxSuccess,
			error: function(xhr, status, error, $form) {
				var e = $('<div class="ajax-error"></div>').text(error.message);
				$form.after(e);
			}
		});

		if (_wpcf7.cached) {
			this.wpcf7OnloadRefill();
		}

		this.wpcf7ToggleSubmit();

		this.find('.wpcf7-submit').wpcf7AjaxLoader();

		this.find('.wpcf7-acceptance').click(function() {
			$(this).closest('form').wpcf7ToggleSubmit();
		});

		this.find('.wpcf7-exclusive-checkbox').wpcf7ExclusiveCheckbox();

		this.find('.wpcf7-list-item.has-free-text').wpcf7ToggleCheckboxFreetext();

		this.find('[placeholder]').wpcf7Placeholder();

		if (_wpcf7.jqueryUi && ! _wpcf7.supportHtml5.date) {
			this.find('input.wpcf7-date[type="date"]').each(function() {
				$(this).datepicker({
					dateFormat: 'yy-mm-dd',
					minDate: new Date($(this).attr('min')),
					maxDate: new Date($(this).attr('max'))
				});
			});
		}

		if (_wpcf7.jqueryUi && ! _wpcf7.supportHtml5.number) {
			this.find('input.wpcf7-number[type="number"]').each(function() {
				$(this).spinner({
					min: $(this).attr('min'),
					max: $(this).attr('max'),
					step: $(this).attr('step')
				});
			});
		}

		this.find('.wpcf7-character-count').wpcf7CharacterCount();

		this.find('.wpcf7-validates-as-url').change(function() {
			$(this).wpcf7NormalizeUrl();
		});
	};

	$.wpcf7AjaxSuccess = function(data, status, xhr, $form) {
		if (! $.isPlainObject(data) || $.isEmptyObject(data)) {
			return;
		}

		var $responseOutput = $form.find('div.wpcf7-response-output');

		$form.wpcf7ClearResponseOutput();

		$form.find('.wpcf7-form-control').removeClass('wpcf7-not-valid');
		$form.removeClass('invalid spam sent failed');

		if (data.captcha) {
			$form.wpcf7RefillCaptcha(data.captcha);
		}

		if (data.quiz) {
			$form.wpcf7RefillQuiz(data.quiz);
		}

		if (data.invalids) {
			$.each(data.invalids, function(i, n) {
				$form.find(n.into).wpcf7NotValidTip(n.message);
				$form.find(n.into).find('.wpcf7-form-control').addClass('wpcf7-not-valid');
				$form.find(n.into).find('[aria-invalid]').attr('aria-invalid', 'true');
			});

			$responseOutput.addClass('wpcf7-validation-errors');
			$form.addClass('invalid');

			$(data.into).trigger('wpcf7:invalid');
			$(data.into).trigger('invalid.wpcf7'); // deprecated

		} else if (1 == data.spam) {
			$responseOutput.addClass('wpcf7-spam-blocked');
			$form.addClass('spam');

			$(data.into).trigger('wpcf7:spam');
			$(data.into).trigger('spam.wpcf7'); // deprecated

		} else if (1 == data.mailSent) {
			$responseOutput.addClass('wpcf7-mail-sent-ok');
			$form.addClass('sent');

			if (data.onSentOk) {
				$.each(data.onSentOk, function(i, n) { eval(n) });
			}

			$(data.into).trigger('wpcf7:mailsent');
			$(data.into).trigger('mailsent.wpcf7'); // deprecated

		} else {
			$responseOutput.addClass('wpcf7-mail-sent-ng');
			$form.addClass('failed');

			$(data.into).trigger('wpcf7:mailfailed');
			$(data.into).trigger('mailfailed.wpcf7'); // deprecated
		}

		if (data.onSubmit) {
			$.each(data.onSubmit, function(i, n) { eval(n) });
		}

		$(data.into).trigger('wpcf7:submit');
		$(data.into).trigger('submit.wpcf7'); // deprecated

		if (1 == data.mailSent) {
			$form.resetForm();
		}

		$form.find('[placeholder].placeheld').each(function(i, n) {
			$(n).val($(n).attr('placeholder'));
		});

		$responseOutput.append(data.message).slideDown('fast');
		$responseOutput.attr('role', 'alert');

		$.wpcf7UpdateScreenReaderResponse($form, data);
	};

	$.fn.wpcf7ExclusiveCheckbox = function() {
		return this.find('input:checkbox').click(function() {
			var name = $(this).attr('name');
			$(this).closest('form').find('input:checkbox[name="' + name + '"]').not(this).prop('checked', false);
		});
	};

	$.fn.wpcf7Placeholder = function() {
		if (_wpcf7.supportHtml5.placeholder) {
			return this;
		}

		return this.each(function() {
			$(this).val($(this).attr('placeholder'));
			$(this).addClass('placeheld');

			$(this).focus(function() {
				if ($(this).hasClass('placeheld'))
					$(this).val('').removeClass('placeheld');
			});

			$(this).blur(function() {
				if ('' == $(this).val()) {
					$(this).val($(this).attr('placeholder'));
					$(this).addClass('placeheld');
				}
			});
		});
	};

	$.fn.wpcf7AjaxLoader = function() {
		return this.each(function() {
			var loader = $('<img class="ajax-loader" />')
				.attr({ src: _wpcf7.loaderUrl, alt: _wpcf7.sending })
				.css('visibility', 'hidden');

			$(this).after(loader);
		});
	};

	$.fn.wpcf7ToggleSubmit = function() {
		return this.each(function() {
			var form = $(this);

			if (this.tagName.toLowerCase() != 'form') {
				form = $(this).find('form').first();
			}

			if (form.hasClass('wpcf7-acceptance-as-validation')) {
				return;
			}

			var submit = form.find('input:submit');
			if (! submit.length) return;

			var acceptances = form.find('input:checkbox.wpcf7-acceptance');
			if (! acceptances.length) return;

			submit.removeAttr('disabled');
			acceptances.each(function(i, n) {
				n = $(n);
				if (n.hasClass('wpcf7-invert') && n.is(':checked')
				|| ! n.hasClass('wpcf7-invert') && ! n.is(':checked')) {
					submit.attr('disabled', 'disabled');
				}
			});
		});
	};

	$.fn.wpcf7ToggleCheckboxFreetext = function() {
		return this.each(function() {
			var $wrap = $(this).closest('.wpcf7-form-control');

			if ($(this).find(':checkbox, :radio').is(':checked')) {
				$(this).find(':input.wpcf7-free-text').prop('disabled', false);
			} else {
				$(this).find(':input.wpcf7-free-text').prop('disabled', true);
			}

			$wrap.find(':checkbox, :radio').change(function() {
				var $cb = $('.has-free-text', $wrap).find(':checkbox, :radio');
				var $freetext = $(':input.wpcf7-free-text', $wrap);

				if ($cb.is(':checked')) {
					$freetext.prop('disabled', false).focus();
				} else {
					$freetext.prop('disabled', true);
				}
			});
		});
	};

	$.fn.wpcf7CharacterCount = function() {
		return this.each(function() {
			var $count = $(this);
			var name = $count.attr('data-target-name');
			var down = $count.hasClass('down');
			var starting = parseInt($count.attr('data-starting-value'), 10);
			var maximum = parseInt($count.attr('data-maximum-value'), 10);
			var minimum = parseInt($count.attr('data-minimum-value'), 10);

			var updateCount = function($target) {
				var length = $target.val().length;
				var count = down ? starting - length : length;
				$count.attr('data-current-value', count);
				$count.text(count);

				if (maximum && maximum < length) {
					$count.addClass('too-long');
				} else {
					$count.removeClass('too-long');
				}

				if (minimum && length < minimum) {
					$count.addClass('too-short');
				} else {
					$count.removeClass('too-short');
				}
			};

			$count.closest('form').find(':input[name="' + name + '"]').each(function() {
				updateCount($(this));

				$(this).keyup(function() {
					updateCount($(this));
				});
			});
		});
	};

	$.fn.wpcf7NormalizeUrl = function() {
		return this.each(function() {
			var val = $.trim($(this).val());

			if (val && ! val.match(/^[a-z][a-z0-9.+-]*:/i)) { // check the scheme part
				val = val.replace(/^\/+/, '');
				val = 'http://' + val;
			}

			$(this).val(val);
		});
	};

	$.fn.wpcf7NotValidTip = function(message) {
		return this.each(function() {
			var $into = $(this);

			$into.find('span.wpcf7-not-valid-tip').remove();
			$into.append('<span role="alert" class="wpcf7-not-valid-tip">' + message + '</span>');

			if ($into.is('.use-floating-validation-tip *')) {
				$('.wpcf7-not-valid-tip', $into).mouseover(function() {
					$(this).wpcf7FadeOut();
				});

				$(':input', $into).focus(function() {
					$('.wpcf7-not-valid-tip', $into).not(':hidden').wpcf7FadeOut();
				});
			}
		});
	};

	$.fn.wpcf7FadeOut = function() {
		return this.each(function() {
			$(this).animate({
				opacity: 0
			}, 'fast', function() {
				$(this).css({'z-index': -100});
			});
		});
	};

	$.fn.wpcf7OnloadRefill = function() {
		return this.each(function() {
			var url = $(this).attr('action');

			if (0 < url.indexOf('#')) {
				url = url.substr(0, url.indexOf('#'));
			}

			var id = $(this).find('input[name="_wpcf7"]').val();
			var unitTag = $(this).find('input[name="_wpcf7_unit_tag"]').val();

			$.getJSON(url,
				{ _wpcf7_is_ajax_call: 1, _wpcf7: id, _wpcf7_request_ver: $.now() },
				function(data) {
					if (data && data.captcha) {
						$('#' + unitTag).wpcf7RefillCaptcha(data.captcha);
					}

					if (data && data.quiz) {
						$('#' + unitTag).wpcf7RefillQuiz(data.quiz);
					}
				}
			);
		});
	};

	$.fn.wpcf7RefillCaptcha = function(captcha) {
		return this.each(function() {
			var form = $(this);

			$.each(captcha, function(i, n) {
				form.find(':input[name="' + i + '"]').clearFields();
				form.find('img.wpcf7-captcha-' + i).attr('src', n);
				var match = /([0-9]+)\.(png|gif|jpeg)$/.exec(n);
				form.find('input:hidden[name="_wpcf7_captcha_challenge_' + i + '"]').attr('value', match[1]);
			});
		});
	};

	$.fn.wpcf7RefillQuiz = function(quiz) {
		return this.each(function() {
			var form = $(this);

			$.each(quiz, function(i, n) {
				form.find(':input[name="' + i + '"]').clearFields();
				form.find(':input[name="' + i + '"]').siblings('span.wpcf7-quiz-label').text(n[0]);
				form.find('input:hidden[name="_wpcf7_quiz_answer_' + i + '"]').attr('value', n[1]);
			});
		});
	};

	$.fn.wpcf7ClearResponseOutput = function() {
		return this.each(function() {
			$(this).find('div.wpcf7-response-output').hide().empty().removeClass('wpcf7-mail-sent-ok wpcf7-mail-sent-ng wpcf7-validation-errors wpcf7-spam-blocked').removeAttr('role');
			$(this).find('span.wpcf7-not-valid-tip').remove();
			$(this).find('img.ajax-loader').css({ visibility: 'hidden' });
		});
	};

	$.wpcf7UpdateScreenReaderResponse = function($form, data) {
		$('.wpcf7 .screen-reader-response').html('').attr('role', '');

		if (data.message) {
			var $response = $form.siblings('.screen-reader-response').first();
			$response.append(data.message);

			if (data.invalids) {
				var $invalids = $('<ul></ul>');

				$.each(data.invalids, function(i, n) {
					if (n.idref) {
						var $li = $('<li></li>').append($('<a></a>').attr('href', '#' + n.idref).append(n.message));
					} else {
						var $li = $('<li></li>').append(n.message);
					}

					$invalids.append($li);
				});

				$response.append($invalids);
			}

			$response.attr('role', 'alert').focus();
		}
	};

	$.wpcf7SupportHtml5 = function() {
		var features = {};
		var input = document.createElement('input');

		features.placeholder = 'placeholder' in input;

		var inputTypes = ['email', 'url', 'tel', 'number', 'range', 'date'];

		$.each(inputTypes, function(index, value) {
			input.setAttribute('type', value);
			features[value] = input.type !== 'text';
		});

		return features;
	};

	$(function() {
		_wpcf7.supportHtml5 = $.wpcf7SupportHtml5();
		$('div.wpcf7 > form').wpcf7InitForm();
	});

})(jQuery);

;/*!
 * jQuery blockUI plugin
 * Version 2.70.0-2014.11.23
 * Requires jQuery v1.7 or later
 *
 * Examples at: http://malsup.com/jquery/block/
 * Copyright (c) 2007-2013 M. Alsup
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 *
 * Thanks to Amir-Hossein Sobhi for some excellent contributions!
 */
!function(){"use strict";function a(a){function b(b,d){var f,p,q=b==window,r=d&&void 0!==d.message?d.message:void 0;if(d=a.extend({},a.blockUI.defaults,d||{}),!d.ignoreIfBlocked||!a(b).data("blockUI.isBlocked")){if(d.overlayCSS=a.extend({},a.blockUI.defaults.overlayCSS,d.overlayCSS||{}),f=a.extend({},a.blockUI.defaults.css,d.css||{}),d.onOverlayClick&&(d.overlayCSS.cursor="pointer"),p=a.extend({},a.blockUI.defaults.themedCSS,d.themedCSS||{}),r=void 0===r?d.message:r,q&&n&&c(window,{fadeOut:0}),r&&"string"!=typeof r&&(r.parentNode||r.jquery)){var s=r.jquery?r[0]:r,t={};a(b).data("blockUI.history",t),t.el=s,t.parent=s.parentNode,t.display=s.style.display,t.position=s.style.position,t.parent&&t.parent.removeChild(s)}a(b).data("blockUI.onUnblock",d.onUnblock);var u,v,w,x,y=d.baseZ;u=a(k||d.forceIframe?'<iframe class="blockUI" style="z-index:'+y++ +';display:none;border:none;margin:0;padding:0;position:absolute;width:100%;height:100%;top:0;left:0" src="'+d.iframeSrc+'"></iframe>':'<div class="blockUI" style="display:none"></div>'),v=a(d.theme?'<div class="blockUI blockOverlay ui-widget-overlay" style="z-index:'+y++ +';display:none"></div>':'<div class="blockUI blockOverlay" style="z-index:'+y++ +';display:none;border:none;margin:0;padding:0;width:100%;height:100%;top:0;left:0"></div>'),d.theme&&q?(x='<div class="blockUI '+d.blockMsgClass+' blockPage ui-dialog ui-widget ui-corner-all" style="z-index:'+(y+10)+';display:none;position:fixed">',d.title&&(x+='<div class="ui-widget-header ui-dialog-titlebar ui-corner-all blockTitle">'+(d.title||"&nbsp;")+"</div>"),x+='<div class="ui-widget-content ui-dialog-content"></div>',x+="</div>"):d.theme?(x='<div class="blockUI '+d.blockMsgClass+' blockElement ui-dialog ui-widget ui-corner-all" style="z-index:'+(y+10)+';display:none;position:absolute">',d.title&&(x+='<div class="ui-widget-header ui-dialog-titlebar ui-corner-all blockTitle">'+(d.title||"&nbsp;")+"</div>"),x+='<div class="ui-widget-content ui-dialog-content"></div>',x+="</div>"):x=q?'<div class="blockUI '+d.blockMsgClass+' blockPage" style="z-index:'+(y+10)+';display:none;position:fixed"></div>':'<div class="blockUI '+d.blockMsgClass+' blockElement" style="z-index:'+(y+10)+';display:none;position:absolute"></div>',w=a(x),r&&(d.theme?(w.css(p),w.addClass("ui-widget-content")):w.css(f)),d.theme||v.css(d.overlayCSS),v.css("position",q?"fixed":"absolute"),(k||d.forceIframe)&&u.css("opacity",0);var z=[u,v,w],A=a(q?"body":b);a.each(z,function(){this.appendTo(A)}),d.theme&&d.draggable&&a.fn.draggable&&w.draggable({handle:".ui-dialog-titlebar",cancel:"li"});var B=m&&(!a.support.boxModel||a("object,embed",q?null:b).length>0);if(l||B){if(q&&d.allowBodyStretch&&a.support.boxModel&&a("html,body").css("height","100%"),(l||!a.support.boxModel)&&!q)var C=i(b,"borderTopWidth"),D=i(b,"borderLeftWidth"),E=C?"(0 - "+C+")":0,F=D?"(0 - "+D+")":0;a.each(z,function(a,b){var c=b[0].style;if(c.position="absolute",2>a)q?c.setExpression("height","Math.max(document.body.scrollHeight, document.body.offsetHeight) - (jQuery.support.boxModel?0:"+d.quirksmodeOffsetHack+') + "px"'):c.setExpression("height",'this.parentNode.offsetHeight + "px"'),q?c.setExpression("width",'jQuery.support.boxModel && document.documentElement.clientWidth || document.body.clientWidth + "px"'):c.setExpression("width",'this.parentNode.offsetWidth + "px"'),F&&c.setExpression("left",F),E&&c.setExpression("top",E);else if(d.centerY)q&&c.setExpression("top",'(document.documentElement.clientHeight || document.body.clientHeight) / 2 - (this.offsetHeight / 2) + (blah = document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop) + "px"'),c.marginTop=0;else if(!d.centerY&&q){var e=d.css&&d.css.top?parseInt(d.css.top,10):0,f="((document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop) + "+e+') + "px"';c.setExpression("top",f)}})}if(r&&(d.theme?w.find(".ui-widget-content").append(r):w.append(r),(r.jquery||r.nodeType)&&a(r).show()),(k||d.forceIframe)&&d.showOverlay&&u.show(),d.fadeIn){var G=d.onBlock?d.onBlock:j,H=d.showOverlay&&!r?G:j,I=r?G:j;d.showOverlay&&v._fadeIn(d.fadeIn,H),r&&w._fadeIn(d.fadeIn,I)}else d.showOverlay&&v.show(),r&&w.show(),d.onBlock&&d.onBlock.bind(w)();if(e(1,b,d),q?(n=w[0],o=a(d.focusableElements,n),d.focusInput&&setTimeout(g,20)):h(w[0],d.centerX,d.centerY),d.timeout){var J=setTimeout(function(){q?a.unblockUI(d):a(b).unblock(d)},d.timeout);a(b).data("blockUI.timeout",J)}}}function c(b,c){var f,g=b==window,h=a(b),i=h.data("blockUI.history"),j=h.data("blockUI.timeout");j&&(clearTimeout(j),h.removeData("blockUI.timeout")),c=a.extend({},a.blockUI.defaults,c||{}),e(0,b,c),null===c.onUnblock&&(c.onUnblock=h.data("blockUI.onUnblock"),h.removeData("blockUI.onUnblock"));var k;k=g?a(document.body).children().filter(".blockUI").add("body > .blockUI"):h.find(">.blockUI"),c.cursorReset&&(k.length>1&&(k[1].style.cursor=c.cursorReset),k.length>2&&(k[2].style.cursor=c.cursorReset)),g&&(n=o=null),c.fadeOut?(f=k.length,k.stop().fadeOut(c.fadeOut,function(){0===--f&&d(k,i,c,b)})):d(k,i,c,b)}function d(b,c,d,e){var f=a(e);if(!f.data("blockUI.isBlocked")){b.each(function(a,b){this.parentNode&&this.parentNode.removeChild(this)}),c&&c.el&&(c.el.style.display=c.display,c.el.style.position=c.position,c.el.style.cursor="default",c.parent&&c.parent.appendChild(c.el),f.removeData("blockUI.history")),f.data("blockUI.static")&&f.css("position","static"),"function"==typeof d.onUnblock&&d.onUnblock(e,d);var g=a(document.body),h=g.width(),i=g[0].style.width;g.width(h-1).width(h),g[0].style.width=i}}function e(b,c,d){var e=c==window,g=a(c);if((b||(!e||n)&&(e||g.data("blockUI.isBlocked")))&&(g.data("blockUI.isBlocked",b),e&&d.bindEvents&&(!b||d.showOverlay))){var h="mousedown mouseup keydown keypress keyup touchstart touchend touchmove";b?a(document).bind(h,d,f):a(document).unbind(h,f)}}function f(b){if("keydown"===b.type&&b.keyCode&&9==b.keyCode&&n&&b.data.constrainTabKey){var c=o,d=!b.shiftKey&&b.target===c[c.length-1],e=b.shiftKey&&b.target===c[0];if(d||e)return setTimeout(function(){g(e)},10),!1}var f=b.data,h=a(b.target);return h.hasClass("blockOverlay")&&f.onOverlayClick&&f.onOverlayClick(b),h.parents("div."+f.blockMsgClass).length>0?!0:0===h.parents().children().filter("div.blockUI").length}function g(a){if(o){var b=o[a===!0?o.length-1:0];b&&b.focus()}}function h(a,b,c){var d=a.parentNode,e=a.style,f=(d.offsetWidth-a.offsetWidth)/2-i(d,"borderLeftWidth"),g=(d.offsetHeight-a.offsetHeight)/2-i(d,"borderTopWidth");b&&(e.left=f>0?f+"px":"0"),c&&(e.top=g>0?g+"px":"0")}function i(b,c){return parseInt(a.css(b,c),10)||0}a.fn._fadeIn=a.fn.fadeIn;var j=a.noop||function(){},k=/MSIE/.test(navigator.userAgent),l=/MSIE 6.0/.test(navigator.userAgent)&&!/MSIE 8.0/.test(navigator.userAgent),m=(document.documentMode||0,a.isFunction(document.createElement("div").style.setExpression));a.blockUI=function(a){b(window,a)},a.unblockUI=function(a){c(window,a)},a.growlUI=function(b,c,d,e){var f=a('<div class="growlUI"></div>');b&&f.append("<h1>"+b+"</h1>"),c&&f.append("<h2>"+c+"</h2>"),void 0===d&&(d=3e3);var g=function(b){b=b||{},a.blockUI({message:f,fadeIn:"undefined"!=typeof b.fadeIn?b.fadeIn:700,fadeOut:"undefined"!=typeof b.fadeOut?b.fadeOut:1e3,timeout:"undefined"!=typeof b.timeout?b.timeout:d,centerY:!1,showOverlay:!1,onUnblock:e,css:a.blockUI.defaults.growlCSS})};g();f.css("opacity");f.mouseover(function(){g({fadeIn:0,timeout:3e4});var b=a(".blockMsg");b.stop(),b.fadeTo(300,1)}).mouseout(function(){a(".blockMsg").fadeOut(1e3)})},a.fn.block=function(c){if(this[0]===window)return a.blockUI(c),this;var d=a.extend({},a.blockUI.defaults,c||{});return this.each(function(){var b=a(this);d.ignoreIfBlocked&&b.data("blockUI.isBlocked")||b.unblock({fadeOut:0})}),this.each(function(){"static"==a.css(this,"position")&&(this.style.position="relative",a(this).data("blockUI.static",!0)),this.style.zoom=1,b(this,c)})},a.fn.unblock=function(b){return this[0]===window?(a.unblockUI(b),this):this.each(function(){c(this,b)})},a.blockUI.version=2.7,a.blockUI.defaults={message:"<h1>Please wait...</h1>",title:null,draggable:!0,theme:!1,css:{padding:0,margin:0,width:"30%",top:"40%",left:"35%",textAlign:"center",color:"#000",border:"3px solid #aaa",backgroundColor:"#fff",cursor:"wait"},themedCSS:{width:"30%",top:"40%",left:"35%"},overlayCSS:{backgroundColor:"#000",opacity:.6,cursor:"wait"},cursorReset:"default",growlCSS:{width:"350px",top:"10px",left:"",right:"10px",border:"none",padding:"5px",opacity:.6,cursor:"default",color:"#fff",backgroundColor:"#000","-webkit-border-radius":"10px","-moz-border-radius":"10px","border-radius":"10px"},iframeSrc:/^https/i.test(window.location.href||"")?"javascript:false":"about:blank",forceIframe:!1,baseZ:1e3,centerX:!0,centerY:!0,allowBodyStretch:!0,bindEvents:!0,constrainTabKey:!0,fadeIn:200,fadeOut:400,timeout:0,showOverlay:!0,focusInput:!0,focusableElements:":input:enabled:visible",onBlock:null,onUnblock:null,onOverlayClick:null,quirksmodeOffsetHack:4,blockMsgClass:"blockMsg",ignoreIfBlocked:!1};var n=null,o=[]}"function"==typeof define&&define.amd&&define.amd.jQuery?define(["jquery"],a):a(jQuery)}();