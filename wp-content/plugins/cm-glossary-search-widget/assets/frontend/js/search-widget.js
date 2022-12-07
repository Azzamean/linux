(function ($) {
    "use strict";
    var config = _cmsw_search_widget_config;
    var jqxhr1 = null;
    $(function () {

        function CMSW(config) {
            this.widget = null;
            this.jqxhr1 = null;
            this.config = config;
            this.templates = {};
            this.history = [];
        }

        CMSW.prototype.init = function () {
            var self = this;
            var html = self.templates.main({self: self});
            self.widget = $(html);
            $('body').append(self.widget);
        };
        
        CMSW.prototype.initBtn = function () {
            var self = this;
            var btn  = self.templates.button({self: self});
            self.btn = $(btn);
            $('body').append(self.btn);
            if (self.config.options.placement == 'BR') {
                $(self.btn).css({'left': 'auto', 'right': '4px'});
            }
            if (self.config.options.color) {
                $(self.btn).css({'border-color': self.config.options.icon_bg_color});
                $(self.btn).css({'background': self.config.options.icon_bg_color});
                $(self.btn).css({'width': self.config.options.icon_size});
                $(self.btn).css({'height': self.config.options.icon_size});
                $(self.btn).find('.has-background-image').css({'width': self.config.options.icon_size});
                $(self.btn).find('.has-background-image').css({'height': self.config.options.icon_size});
                $(self.widget).css({'bottom': parseInt(self.config.options.icon_size) + 10 + 'px' });
            }
            if (self.config.options.icon_color) {
                $(self.btn).find('span').css({'color': self.config.options.icon_color});
            }
        };

        CMSW.prototype.restoreStateFromCookie = function () {
            // state restore disabled
            return;
            var self = this;
            var c = self.cookie();
            try {
                self.searchValue(c.searchvalue);
                if (c.state == 'open') {
                    self.openWidget();
                }
                if (c.state == 'extended') {
                    self.extendWidget();
                }
                if (c.state == 'closed') {
                    self.closeWidget();
                }
            } catch (e) {
            }
        };

        CMSW.prototype._rating = function (i) {
            if (parseInt(i) > 0) {
                return '+' + i;
            }
            return i;
        };

        CMSW.prototype.cookie = function (data) {
            // state restore disabled
            return;
            var self = this;
            $.cookie.json = true;
            var c = $.cookie(self.config.cookiename);
            if (c === undefined || c.searchvalue === undefined || c.state === undefined) {
                c = {searchvalue: '', state: 'closed'};
            }
            if (data) {
                $.extend(c, data);
                $.cookie(self.config.cookiename, c, {path: self.config.cookiepath, expires: 365});
            }
            return $.cookie(self.config.cookiename);
        };

        CMSW.prototype.loadTemplate = function (name, callback) {
            var self = this;
            if ($.isArray(name)) {
                $.each(name, function (k, v) {
                    self.loadTemplate(v.name, v.callback);
                });
                return;
            }
            var url = "{baseurl}assets/frontend/tpl/{name}.html";
            url = url.replace("{baseurl}", this.config.baseurl);
            url = url.replace("{name}", name);
            $.get(url, function (data) {
                self.templates[name] = _.template(data);
                if (callback) {
                    callback();
                }
            });
        };
        CMSW.prototype.searchValue = function (s) {
            var self = this;
            if (s) {
                $(self.widget).find('.cmsw-sw-search-input').val(s);
                $(self.widget).find('.cmsw-sw-search-input').trigger('change');
                $(self.widget).find('.cmsw-sw-search-input').trigger('input');
            }
            var s = $(self.widget).find('.cmsw-sw-search-input').val();
            self.cookie({searchvalue: s});
            return s;
        };

        CMSW.prototype.hasSearchFocus = function () {
            var self = this;
            if ($(self.widget).find('.cmsw-sw-search-input:focus').length > 0) {
                return true;
            }
            return false;
        };

        CMSW.prototype.openWidget = function () {
            $(this.widget).removeClass('cmsw-sw-extended cmsw-sw-closed').addClass('cmsw-sw-open');
            this.cookie({state: 'open'});
        };

        CMSW.prototype.isWidgetOpen = function () {
            if ($(this.widget).hasClass('cmsw-sw-open')) {
                return true;
            }
            return false;
        };

        CMSW.prototype.closeWidget = function () {
            $(this.widget).removeClass('cmsw-sw-open cmsw-sw-extended').addClass('cmsw-sw-closed');
            this.cookie({state: 'closed'});
        };

        CMSW.prototype.isWidgetClosed = function () {
            if ($(this.widget).hasClass('cmsw-sw-closed')) {
                return true;
            }
            return false;
        };

        CMSW.prototype.extendWidget = function () {
            $(this.widget).removeClass('cmsw-sw-open cmsw-sw-closed').addClass('cmsw-sw-extended');
            //this.cookie({state: 'extended'});
        };

        CMSW.prototype.isWidgetExtended = function () {
            if ($(this.widget).hasClass('cmsw-sw-extended')) {
                return true;
            }
            return false;
        };
    
        CMSW.prototype.toggleWidget = function () {
            $(this.widget).toggleClass('cmsw-sw-widget-hidden');
            var $container =  $(document).find('#cmsw-sw-toggle-form');
            if ( $(this.widget).hasClass('cmsw-sw-widget-hidden') ){
                $container.find('#cmsw-sw-close-icon').css('display', 'none');
                $container.find('#cmsw-sw-open-icon').css('display', 'block');
                this.closeWidget();
            } else {
                $container.find('#cmsw-sw-open-icon').css('display', 'none');
                $container.find('#cmsw-sw-close-icon').css('display', 'block');
                this.openWidget();
            }
        };

        CMSW.prototype.applyOptions = function () {
            var self = this;
            if (self.config.options.color) {
                $(self.widget).css({'border-color': self.config.options.color});
                $(self.widget).find('.cmsw-sw-title').css({'background': self.config.options.color});
                $(self.widget).find('.cmsw-sw-content').css({'border-color': self.config.options.color});
            }
            if (self.config.options.placement == 'BR') {
                $(self.widget).css({'left': 'auto', 'right': '4px'});
            }
        };

        CMSW.prototype.bindEvent = function () {
            var self = this;

            $(self.widget).on('mouseenter', function () {
                if (self.isWidgetOpen()) {
                    return;
                }
                if (self.searchValue()) {
                    self.openWidget();
                    return;
                }
                self.extendWidget();
            });

            $(self.widget).on('mouseleave', function () {
                if (self.isWidgetOpen()) {
                    return;
                }
                self.closeWidget()
            });

            $(self.widget).on('focusout', '.cmsw-sw-search-input', function () {
                if (!$(self.widget).is(':hover')) {
                    $(self.widget).mouseleave();
                }
            });

            $(self.widget).on('click', '.cmsw-sw-btn-close', function () {
                self.closeWidget();
            });

            $(self.widget).on('keyup change', '.cmsw-sw-search-input', function () {
                var s = self.searchValue();
                if (s == '') {
                    $(self.widget).find('.cmsw-sw-content').empty();
                    //self.openWidget();
                }
                if (s) {
                    self.openWidget();
                }
            });

            $(self.widget).on('keyup change', '.cmsw-sw-search-input', $.debounce(250, function () {
                var s = self.searchValue();
                if (s) {
                    var params = {
                        action: 'cmsw_sw_search',
                        s: s
                    };
                    try {
                        self.jqxhr1.abort();
                    } catch (e) {
                    }
                    self.jqxhr1 = $.post(self.config.ajaxurl, params, function (data) {
                        self.jqxhr1 = null;
                        $(self.widget).find('.cmsw-sw-content').html(self.templates.suggestion({self: self, data: data}))
                    });
                }
            }));
            
            $( document ).on('click', '#cmsw-sw-toggle-form', function () {
                self.toggleWidget();
            });
        };

        var widgetInstance = new CMSW(config);
        widgetInstance.loadTemplate([{name: 'main', callback: function () {
                    widgetInstance.init();
                    widgetInstance.bindEvent();
                    widgetInstance.applyOptions();
                    widgetInstance.restoreStateFromCookie();
                }}, {name: 'suggestion'}, {name: 'button', callback: function(){
                    widgetInstance.initBtn();
            }}]);

        $(document).on('input', '.cmsw-clearable', function () {
            $(this)[tog(this.value)]('x');
        }).on('mousemove', '.x', function (e) {
            $(this)[tog(this.offsetWidth - 18 < e.clientX - this.getBoundingClientRect().left)]('onX');
        }).on('touchstart click', '.onX', function (ev) {
            ev.preventDefault();
            $(this).removeClass('x onX').val('').change();
        });
        $('.cmsw-clearable').trigger('input');
    });
    function tog(v) {
        return v ? 'addClass' : 'removeClass';
    }

})(jQuery);