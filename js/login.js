/*
 * SimpleModal login Style Modal Dialog
 * http://www.ericmmartin.com/projects/simplemodal/
 * http://code.google.com/p/simplemodal/
 *
 * Copyright (c) 2010 Eric Martin - http://ericmmartin.com
 *
 * Licensed under the MIT license:
 *   http://www.opensource.org/licenses/mit-license.php
 *
 * Revision: $Id: login.js 238 2010-03-11 05:56:57Z emartin24 $
 */

jQuery(function ($) {
	var login = {
		container1: null,
		init: function () {
			$("input.login, a.login").click(function (e) {
				e.preventDefault();	

				$("#login-modal-content1").modal({
					overlayId: 'login-overlay',
					container1Id: 'login-container1',
					closeHTML: null,
					minHeight: 80,
					opacity: 65, 
					position: ['0',],
					overlayClose: true,
					onOpen: login.open,
					onClose: login.close
				});
			});
		},
		open: function (d) {
			var self = this;
			self.container1 = d.container1[0];
			d.overlay.fadeIn('slow', function () {
				$("#login-modal-content1", self.container1).show();
				var title = $("#login-modal-title", self.container1);
				title.show();
				d.container1.slideDown('slow', function () {
					setTimeout(function () {
						var h = $("#login-modal-data", self.container1).height()
							+ title.height()
							+ 20; // padding
						d.container1.animate(
							{height: h}, 
							200,
							function () {
								$("div.close", self.container1).show();
								$("#login-modal-data", self.container1).show();
							}
						);
					}, 300);
				});
			})
		},
		close: function (d) {
			var self = this; // this = SimpleModal object
			d.container1.animate(
				{top:"-" + (d.container1.height() + 20)},
				500,
				function () {
					self.close(); // or $.modal.close();
				}
			);
		}
	};

	login.init();

});