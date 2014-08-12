jQuery(document).ready(function ($) {
	// msc namespace
	var msc = {};

	//msc setup
	(function () {
		msc.foldout = function (articles, links, height) {
			var $articles = $(articles),
				swing = '<div class="swing"><div class="plus sign">+</div><div class="minus sign">-</div><div class="null sign">.</div></div>',
				fade = '<div class="fade"></div>',
				duration = 200;

			$articles.each(function (e) {
				var $article = $(this),
					$link = $article.find(links);

				if ($article.outerHeight() > height) {
					$article.stop().animate({
						height: height
					}, duration);

					$article.addClass('foldout folded');

					$link.click(function (e) {
						var $fade = $article.find('.fade');

						$article.toggleClass('folded');

						if ($article.hasClass('folded')) {
							$article.stop().animate({
								height: height
							}, duration);
							$fade.stop().slideDown(duration);
						} else {
							$article.stop().animate({
								height: $article[0].scrollHeight
							}, duration);
							$fade.stop().slideUp(duration);
						}

						return false;
					});

					$article.append($(fade));
				} else {
					$article.addClass('foldout null').click(function (e) {
						return false;
					});
				}

				$link.prepend($(swing));
			});
		}
	}());

	msc.foldout('article.portfolio', 'h1 a', 150);
});
