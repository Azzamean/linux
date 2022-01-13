/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./src/components/panel/index.js":
/*!***************************************!*\
  !*** ./src/components/panel/index.js ***!
  \***************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
var SalientCustomizerPanel = function SalientCustomizerPanel(_ref) {
  var title = _ref.title;
  return /*#__PURE__*/React.createElement("div", {
    "class": ".nectar-customizer__panels__panel"
  });
};

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (SalientCustomizerPanel);

/***/ }),

/***/ "./src/components/slider/index.js":
/*!****************************************!*\
  !*** ./src/components/slider/index.js ***!
  \****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
var SalientCustomizerSliderControl = function SalientCustomizerSliderControl(_ref) {
  var title = _ref.title;
  return /*#__PURE__*/React.createElement("div", {
    "class": ".nectar-customizer__slider"
  });
};

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (SalientCustomizerSliderControl);

/***/ }),

/***/ "./src/customizer-backbone.js":
/*!************************************!*\
  !*** ./src/customizer-backbone.js ***!
  \************************************/
/***/ (() => {

/*
( function( $ ) {

const api = wp.customize;

api.bind( 'pane-contents-reflowed', () => {
  // Reflow sections
  var sections = [];

  api.section.each( ( section )  => {
    console.log(section);
    if (
      'nectar_section' !== section.params.type ||
      'undefined' === typeof section.params.section
    ) {
      return;
    }

    sections.push( section );
  });

  sections.sort( api.utils.prioritySort ).reverse();

  $.each( sections, function( i, section ) {
    var parentContainer = $( '#sub-accordion-section-' + section.params.section );
    parentContainer.children( '.section-meta' ).after( section.headContainer );
  });

  // Reflow panels
  var panels = [];

  api.panel.each( function( panel ) {
    if ( 'nectar_panel' !== panel.params.type ||
         'undefined' === typeof panel.params.panel ) {
      return;
    }
    panels.push( panel );
  });

  panels.sort( api.utils.prioritySort ).reverse();

  $.each( panels, function( i, panel ) {
    var parentContainer = $( '#sub-accordion-panel-' + panel.params.panel );
    parentContainer.children( '.panel-meta' ).after( panel.headContainer );
  });

});


// Extend Panel
const _panelEmbed = wp.customize.Panel.prototype.embed;
const _panelIsContextuallyActive = wp.customize.Panel.prototype.isContextuallyActive;
const _panelAttachEvents = wp.customize.Panel.prototype.attachEvents;

wp.customize.Panel = wp.customize.Panel.extend({
  attachEvents: function() {

    if (
      'nectar_panel' !== this.params.type ||
      'undefined' === typeof this.params.panel
    ) {
      _panelAttachEvents.call( this );
      return;
    }

    _panelAttachEvents.call( this );

    var panel = this;
    panel.expanded.bind( function( expanded ) {
      var parent = api.panel( panel.params.panel );

      if ( expanded ) {
        parent.contentContainer.addClass( 'current-panel-parent' );
      } else {
        parent.contentContainer.removeClass( 'current-panel-parent' );
      }

    });

    panel.container.find( '.customize-panel-back' )
      .off( 'click keydown' )
      .on( 'click keydown', function( event ) {

        if ( api.utils.isKeydownButNotEnterEvent( event ) ) {
          return;
        }

        event.preventDefault(); // Keep this AFTER the key filter above

        if ( panel.expanded() ) {
          api.panel( panel.params.panel ).expand();
        }

      });

  },

  embed: function() {

    if (
      'salient_panel' !== this.params.type ||
      'undefined' === typeof this.params.panel
    ) {
      _panelEmbed.call( this );
      return;
    }

    _panelEmbed.call( this );

    var panel = this;
    var parentContainer = $( '#sub-accordion-panel-' + this.params.panel );

    parentContainer.append( panel.headContainer );

  },

  isContextuallyActive: function() {

    if (
      'salient_panel' !== this.params.type
    ) {
      return _panelIsContextuallyActive.call( this );
    }

    var panel = this;
    var children = this._children( 'panel', 'section' );

    api.panel.each( function( child ) {

      if ( ! child.params.panel ) {
        return;
      }

      if ( child.params.panel !== panel.id ) {
        return;
      }

      children.push( child );
    });

    children.sort( api.utils.prioritySort );

    var activeCount = 0;

    _( children ).each( function ( child ) {
      if ( child.active() && child.isContextuallyActive() ) {
        activeCount += 1;
      }
    });

    return ( activeCount !== 0 );
  }

});


// Extend Section
const _sectionEmbed = wp.customize.Section.prototype.embed;
const _sectionIsContextuallyActive = wp.customize.Section.prototype.isContextuallyActive;
const _sectionAttachEvents = wp.customize.Section.prototype.attachEvents;

wp.customize.Section = wp.customize.Section.extend({
  attachEvents: function() {

    if (
      'nectar_section' !== this.params.type ||
      'undefined' === typeof this.params.section
    ) {
      _sectionAttachEvents.call( this );
      return;
    }

    _sectionAttachEvents.call( this );

    var section = this;

    section.expanded.bind( function( expanded ) {

      var parent = api.section( section.params.section );

      if ( expanded ) {
        parent.contentContainer.addClass( 'current-section-parent' );
      } else {
        parent.contentContainer.removeClass( 'current-section-parent' );
      }

    });

    section.container.find( '.customize-section-back' )
      .off( 'click keydown' )
      .on( 'click keydown', function( event ) {

        if ( api.utils.isKeydownButNotEnterEvent( event ) ) {
          return;
        }

        event.preventDefault(); // Keep this AFTER the key filter above

        if ( section.expanded() ) {
          api.section( section.params.section ).expand();
        }

      });

  },

  embed: function() {

    if (
      'nectar_section' !== this.params.type ||
      'undefined' === typeof this.params.section
    ) {
      _sectionEmbed.call( this );
      return;
    }

    _sectionEmbed.call( this );

    var section = this;
    var parentContainer = $( '#sub-accordion-section-' + this.params.section );
    parentContainer.append( section.headContainer );
  },

  isContextuallyActive: function() {

    if ( 'nectar_section' !== this.params.type ) {
      return _sectionIsContextuallyActive.call( this );
    }

    var section = this;
    var children = this._children( 'section', 'control' );

    api.section.each( function( child ) {

      if ( ! child.params.section ) {
        return;
      }

      if ( child.params.section !== section.id ) {
        return;
      }

      children.push( child );
    });

    children.sort( api.utils.prioritySort );

    var activeCount = 0;

    _( children ).each( function ( child ) {

      if ( 'undefined' !== typeof child.isContextuallyActive ) {
        if ( child.active() && child.isContextuallyActive() ) {
          activeCount += 1;
        }
      } else {
        if ( child.active() ) {
          activeCount += 1;
        }
      }

    });

    return ( activeCount !== 0 );
  }

});

})( jQuery );
*/

/***/ }),

/***/ "./src/index.scss":
/*!************************!*\
  !*** ./src/index.scss ***!
  \************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be in strict mode.
(() => {
"use strict";
/*!**********************!*\
  !*** ./src/index.js ***!
  \**********************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _index_scss__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./index.scss */ "./src/index.scss");
/* harmony import */ var _customizer_backbone__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./customizer-backbone */ "./src/customizer-backbone.js");
/* harmony import */ var _customizer_backbone__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_customizer_backbone__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _components_panel__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./components/panel */ "./src/components/panel/index.js");
/* harmony import */ var _components_slider__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./components/slider */ "./src/components/slider/index.js");
// Top level scss
 // Backbone JS support

 // Custom components



})();

/******/ })()
;
//# sourceMappingURL=customizer.build.js.map