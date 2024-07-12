/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = "./blocks/main.js");
/******/ })
/************************************************************************/
/******/ ({

/***/ "./blocks/main.js":
/*!************************!*\
  !*** ./blocks/main.js ***!
  \************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _modules_inspector__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./modules/inspector */ "./blocks/modules/inspector.js");
/* harmony import */ var _modules_awsm_team_server_side_render__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./modules/awsm-team-server-side-render */ "./blocks/modules/awsm-team-server-side-render.js");
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function ownKeys(e, r) { var t = Object.keys(e); if (Object.getOwnPropertySymbols) { var o = Object.getOwnPropertySymbols(e); r && (o = o.filter(function (r) { return Object.getOwnPropertyDescriptor(e, r).enumerable; })), t.push.apply(t, o); } return t; }
function _objectSpread(e) { for (var r = 1; r < arguments.length; r++) { var t = null != arguments[r] ? arguments[r] : {}; r % 2 ? ownKeys(Object(t), !0).forEach(function (r) { _defineProperty(e, r, t[r]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(t)) : ownKeys(Object(t)).forEach(function (r) { Object.defineProperty(e, r, Object.getOwnPropertyDescriptor(t, r)); }); } return e; }
function _defineProperty(obj, key, value) { key = _toPropertyKey(key); if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }
function _toPropertyKey(arg) { var key = _toPrimitive(arg, "string"); return _typeof(key) === "symbol" ? key : String(key); }
function _toPrimitive(input, hint) { if (_typeof(input) !== "object" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || "default"); if (_typeof(res) !== "object") return res; throw new TypeError("@@toPrimitive must return a primitive value."); } return (hint === "string" ? String : Number)(input); }
/**
 * BLOCK: AWSM Team
 *
 * Registering a basic block with Gutenberg.
 */



var __ = wp.i18n.__; // Import __() from wp.i18n
var registerBlockType = wp.blocks.registerBlockType; // Import registerBlockType() from wp.blocks
var _wp$components = wp.components,
  ServerSideRender = _wp$components.ServerSideRender,
  Placeholder = _wp$components.Placeholder,
  Button = _wp$components.Button;

/**
 * Register: a Gutenberg Block.
 *
 * @param  {string}   name     Block name.
 * @param  {Object}   settings Block settings.
 * @return {?WPBlock}          The block, if it has been successfully
 *                             registered; otherwise `undefined`.
 */
registerBlockType('gutenberg-awsm/awsm-team-dynamic', {
  title: __('AWSM Team', 'awsm-team-pro'),
  // Block title.
  description: __('Select your team', 'awsm-team-pro'),
  // Block description
  icon: 'admin-users',
  // Block icon
  category: 'common',
  // Block category,
  keywords: [__('team', 'awsm-team-pro'), __('awsm team', 'awsm-team-pro'), __('member', 'awsm-team-pro')],
  // Access the block easily with keyword aliases
  /**
   * The edit function describes the structure of the block in the context of the editor.
   * This represents what the editor will render when the block is used.
   */
  edit: function edit(props) {
    var attributes = props.attributes,
      setAttributes = props.setAttributes;
    var shortcode = attributes.shortcode;
    var blockProps = null;
    var setBlockProps = function setBlockProps() {
      blockProps = props;
      blockProps.activeAtpBlock = true;
    };
    jQuery('body').on('click', '#awsm-block-popup #awsm-insert-team', function () {
      var shortcodeText = jQuery('#awsm-block-popup #atp-shortcode').val();
      if (blockProps !== null) {
        if (blockProps.activeAtpBlock === true) {
          blockProps.activeAtpBlock = false;
          blockProps.setAttributes({
            shortcode: shortcodeText
          });
        }
      }
    });
    if (typeof shortcode !== 'undefined') {
      return [wp.element.createElement(_modules_inspector__WEBPACK_IMPORTED_MODULE_0__["default"], _objectSpread({
        setAttributes: setAttributes
      }, props)), wp.element.createElement(_modules_awsm_team_server_side_render__WEBPACK_IMPORTED_MODULE_1__["default"], {
        block: "gutenberg-awsm/awsm-team-dynamic",
        attributes: attributes
      })];
    } else {
      return wp.element.createElement(Placeholder, {
        label: __('AWSM Team', 'awsm-team-pro'),
        instructions: __('Pick a team to add to your page.', 'awsm-team-pro'),
        icon: "admin-users",
        className: "atp-block-wrapper"
      }, wp.element.createElement(Button, {
        className: "awsm-team-btn",
        onClick: setBlockProps,
        isSecondary: true,
        isLarge: true
      }, __('Select Team', 'awsm-team-pro')));
    }
  },
  /**
   * The save function defines the way in which the different attributes should be combined into the final markup, which is then serialized by Gutenberg into post_content.
   */
  save: function save(props) {
    var shortcode = props.attributes.shortcode;
    return shortcode;
  }
});

/***/ }),

/***/ "./blocks/modules/awsm-team-server-side-render.js":
/*!********************************************************!*\
  !*** ./blocks/modules/awsm-team-server-side-render.js ***!
  \********************************************************/
/*! exports provided: rendererPath, default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "rendererPath", function() { return rendererPath; });
/* harmony import */ var _icon__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./icon */ "./blocks/modules/icon.js");
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _extends() { _extends = Object.assign ? Object.assign.bind() : function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; }; return _extends.apply(this, arguments); }
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }
function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, _toPropertyKey(descriptor.key), descriptor); } }
function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }
function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function"); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, writable: true, configurable: true } }); Object.defineProperty(subClass, "prototype", { writable: false }); if (superClass) _setPrototypeOf(subClass, superClass); }
function _setPrototypeOf(o, p) { _setPrototypeOf = Object.setPrototypeOf ? Object.setPrototypeOf.bind() : function _setPrototypeOf(o, p) { o.__proto__ = p; return o; }; return _setPrototypeOf(o, p); }
function _createSuper(Derived) { var hasNativeReflectConstruct = _isNativeReflectConstruct(); return function _createSuperInternal() { var Super = _getPrototypeOf(Derived), result; if (hasNativeReflectConstruct) { var NewTarget = _getPrototypeOf(this).constructor; result = Reflect.construct(Super, arguments, NewTarget); } else { result = Super.apply(this, arguments); } return _possibleConstructorReturn(this, result); }; }
function _possibleConstructorReturn(self, call) { if (call && (_typeof(call) === "object" || typeof call === "function")) { return call; } else if (call !== void 0) { throw new TypeError("Derived constructors may only return object or undefined"); } return _assertThisInitialized(self); }
function _assertThisInitialized(self) { if (self === void 0) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return self; }
function _isNativeReflectConstruct() { if (typeof Reflect === "undefined" || !Reflect.construct) return false; if (Reflect.construct.sham) return false; if (typeof Proxy === "function") return true; try { Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], function () {})); return true; } catch (e) { return false; } }
function _getPrototypeOf(o) { _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf.bind() : function _getPrototypeOf(o) { return o.__proto__ || Object.getPrototypeOf(o); }; return _getPrototypeOf(o); }
function ownKeys(e, r) { var t = Object.keys(e); if (Object.getOwnPropertySymbols) { var o = Object.getOwnPropertySymbols(e); r && (o = o.filter(function (r) { return Object.getOwnPropertyDescriptor(e, r).enumerable; })), t.push.apply(t, o); } return t; }
function _objectSpread(e) { for (var r = 1; r < arguments.length; r++) { var t = null != arguments[r] ? arguments[r] : {}; r % 2 ? ownKeys(Object(t), !0).forEach(function (r) { _defineProperty(e, r, t[r]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(t)) : ownKeys(Object(t)).forEach(function (r) { Object.defineProperty(e, r, Object.getOwnPropertyDescriptor(t, r)); }); } return e; }
function _defineProperty(obj, key, value) { key = _toPropertyKey(key); if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }
function _toPropertyKey(arg) { var key = _toPrimitive(arg, "string"); return _typeof(key) === "symbol" ? key : String(key); }
function _toPrimitive(input, hint) { if (_typeof(input) !== "object" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || "default"); if (_typeof(res) !== "object") return res; throw new TypeError("@@toPrimitive must return a primitive value."); } return (hint === "string" ? String : Number)(input); }

var _wp$i18n = wp.i18n,
  __ = _wp$i18n.__,
  sprintf = _wp$i18n.sprintf;
var _wp$element = wp.element,
  Component = _wp$element.Component,
  createRef = _wp$element.createRef;
var apiFetch = wp.apiFetch;
var addQueryArgs = wp.url.addQueryArgs;
var _wp$components = wp.components,
  Placeholder = _wp$components.Placeholder,
  Spinner = _wp$components.Spinner;
function rendererPath(block) {
  var attributes = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : null;
  var urlQueryArgs = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : {};
  return addQueryArgs("/wp/v2/block-renderer/".concat(block), _objectSpread(_objectSpread({
    context: "edit"
  }, null !== attributes ? {
    attributes: attributes
  } : {}), urlQueryArgs));
}
var ATServerSideRender = /*#__PURE__*/function (_Component) {
  _inherits(ATServerSideRender, _Component);
  var _super = _createSuper(ATServerSideRender);
  function ATServerSideRender(props) {
    var _this;
    _classCallCheck(this, ATServerSideRender);
    _this = _super.call(this, props);
    _this.state = {
      response: null
    };
    _this.atpRef = createRef();
    return _this;
  }
  _createClass(ATServerSideRender, [{
    key: "componentDidMount",
    value: function componentDidMount() {
      this.isStillMounted = true;
      this.fetch(this.props);
    }
  }, {
    key: "fetch",
    value: function fetch(props) {
      var _this2 = this;
      if (!this.isStillMounted) {
        return;
      }
      if (null !== this.state.response) {
        this.setState({
          response: null
        });
      }
      var block = props.block,
        _props$attributes = props.attributes,
        attributes = _props$attributes === void 0 ? null : _props$attributes,
        _props$urlQueryArgs = props.urlQueryArgs,
        urlQueryArgs = _props$urlQueryArgs === void 0 ? {} : _props$urlQueryArgs;
      var path = rendererPath(block, attributes, urlQueryArgs);
      // Store the latest fetch request so that when we process it, we can
      // check if it is the current request, to avoid race conditions on slow networks.
      var fetchRequest = this.currentFetchRequest = apiFetch({
        path: path
      }).then(function (response) {
        if (_this2.isStillMounted && fetchRequest === _this2.currentFetchRequest && response) {
          _this2.setState({
            response: response.rendered
          });
        }
      })["catch"](function (error) {
        if (_this2.isStillMounted && fetchRequest === _this2.currentFetchRequest) {
          _this2.setState({
            response: {
              error: true,
              errorMsg: error.message
            }
          });
        }
      });
      return fetchRequest;
    }
  }, {
    key: "render",
    value: function render() {
      var response = this.state.response;
      var _this$props = this.props,
        className = _this$props.className,
        EmptyResponsePlaceholder = _this$props.EmptyResponsePlaceholder,
        ErrorResponsePlaceholder = _this$props.ErrorResponsePlaceholder,
        LoadingResponsePlaceholder = _this$props.LoadingResponsePlaceholder;
      if (response === "") {
        return wp.element.createElement(EmptyResponsePlaceholder, _extends({
          response: response
        }, this.props));
      } else if (!response) {
        return wp.element.createElement(LoadingResponsePlaceholder, _extends({
          response: response
        }, this.props));
      } else if (response.error) {
        return wp.element.createElement(ErrorResponsePlaceholder, _extends({
          response: response
        }, this.props));
      }
      var wrapperClass = typeof className !== "undefined" && className ? "awsm-team-block-content-wrapper " + className : "awsm-team-block-content-wrapper";
      return wp.element.createElement("div", {
        ref: this.atpRef,
        className: wrapperClass,
        dangerouslySetInnerHTML: {
          __html: response
        }
      });
    }
  }]);
  return ATServerSideRender;
}(Component);
ATServerSideRender.defaultProps = {
  EmptyResponsePlaceholder: function EmptyResponsePlaceholder(_ref) {
    var className = _ref.className;
    return wp.element.createElement(Placeholder, {
      label: __("AWSM Team", "awsm-team-pro"),
      icon: _icon__WEBPACK_IMPORTED_MODULE_0__["default"].block,
      className: className
    }, __("No Team found!", "awsm-team-pro"));
  },
  ErrorResponsePlaceholder: function ErrorResponsePlaceholder(_ref2) {
    var response = _ref2.response,
      className = _ref2.className;
    var errorMessage = sprintf(
    // translators: %s: error message describing the problem
    __("Error loading the Team: %s", "awsm-team-pro"), response.errorMsg);
    return wp.element.createElement(Placeholder, {
      label: __("Team", "awsm-team-pro"),
      icon: _icon__WEBPACK_IMPORTED_MODULE_0__["default"].block,
      className: className
    }, errorMessage);
  },
  LoadingResponsePlaceholder: function LoadingResponsePlaceholder(_ref3) {
    var className = _ref3.className;
    return wp.element.createElement(Placeholder, {
      className: className
    }, wp.element.createElement(Spinner, null));
  }
};
/* harmony default export */ __webpack_exports__["default"] = (ATServerSideRender);

/***/ }),

/***/ "./blocks/modules/icon.js":
/*!********************************!*\
  !*** ./blocks/modules/icon.js ***!
  \********************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
var icon = {
  block: wp.element.createElement("svg", {
    "aria-hidden": "true",
    role: "img",
    focusable: "false",
    "class": "dashicon dashicons-media-document",
    xmlns: "http://www.w3.org/2000/svg",
    width: "20",
    height: "20",
    viewBox: "0 0 20 20"
  }, wp.element.createElement("path", {
    d: "M12 2l4 4v12H4V2h8zM5 3v1h6V3H5zm7 3h3l-3-3v3zM5 5v1h6V5H5zm10 3V7H5v1h10zM5 9v1h4V9H5zm10 3V9h-5v3h5zM5 11v1h4v-1H5zm10 3v-1H5v1h10zm-3 2v-1H5v1h7z"
  }))
};
/* harmony default export */ __webpack_exports__["default"] = (icon);

/***/ }),

/***/ "./blocks/modules/inspector.js":
/*!*************************************!*\
  !*** ./blocks/modules/inspector.js ***!
  \*************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }
function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, _toPropertyKey(descriptor.key), descriptor); } }
function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }
function _toPropertyKey(arg) { var key = _toPrimitive(arg, "string"); return _typeof(key) === "symbol" ? key : String(key); }
function _toPrimitive(input, hint) { if (_typeof(input) !== "object" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || "default"); if (_typeof(res) !== "object") return res; throw new TypeError("@@toPrimitive must return a primitive value."); } return (hint === "string" ? String : Number)(input); }
function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function"); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, writable: true, configurable: true } }); Object.defineProperty(subClass, "prototype", { writable: false }); if (superClass) _setPrototypeOf(subClass, superClass); }
function _setPrototypeOf(o, p) { _setPrototypeOf = Object.setPrototypeOf ? Object.setPrototypeOf.bind() : function _setPrototypeOf(o, p) { o.__proto__ = p; return o; }; return _setPrototypeOf(o, p); }
function _createSuper(Derived) { var hasNativeReflectConstruct = _isNativeReflectConstruct(); return function _createSuperInternal() { var Super = _getPrototypeOf(Derived), result; if (hasNativeReflectConstruct) { var NewTarget = _getPrototypeOf(this).constructor; result = Reflect.construct(Super, arguments, NewTarget); } else { result = Super.apply(this, arguments); } return _possibleConstructorReturn(this, result); }; }
function _possibleConstructorReturn(self, call) { if (call && (_typeof(call) === "object" || typeof call === "function")) { return call; } else if (call !== void 0) { throw new TypeError("Derived constructors may only return object or undefined"); } return _assertThisInitialized(self); }
function _assertThisInitialized(self) { if (self === void 0) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return self; }
function _isNativeReflectConstruct() { if (typeof Reflect === "undefined" || !Reflect.construct) return false; if (Reflect.construct.sham) return false; if (typeof Proxy === "function") return true; try { Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], function () {})); return true; } catch (e) { return false; } }
function _getPrototypeOf(o) { _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf.bind() : function _getPrototypeOf(o) { return o.__proto__ || Object.getPrototypeOf(o); }; return _getPrototypeOf(o); }
var __ = wp.i18n.__;
var Component = wp.element.Component;
var InspectorControls = wp.editor.InspectorControls;
var _wp$components = wp.components,
  PanelBody = _wp$components.PanelBody,
  ExternalLink = _wp$components.ExternalLink;
var ATPInspector = /*#__PURE__*/function (_Component) {
  _inherits(ATPInspector, _Component);
  var _super = _createSuper(ATPInspector);
  function ATPInspector() {
    var _this;
    _classCallCheck(this, ATPInspector);
    _this = _super.apply(this, arguments);
    var _this$props$attribute = _this.props.attributes,
      download = _this$props$attribute.download,
      viewer = _this$props$attribute.viewer;
    return _this;
  }
  _createClass(ATPInspector, [{
    key: "render",
    value: function render() {
      var setAttributes = this.props.setAttributes;
      var shortcodeText = jQuery('#awsm-block-popup #atp-shortcode').val();
      if(!shortcodeText) {
        var shortcodeText = jQuery('.awsm-grid-wrapper #atb-shortcode').val();
      }
      var link = "post.php?post=" + shortcodeText + "&action=edit";
      return wp.element.createElement(InspectorControls, null, wp.element.createElement(PanelBody, null, wp.element.createElement(ExternalLink, {
        href: link
      }, __('Edit Team', 'awsm-team-pro'))));
    }
  }]);
  return ATPInspector;
}(Component);
/* harmony default export */ __webpack_exports__["default"] = (ATPInspector);

/***/ })

/******/ });
//# sourceMappingURL=team-block.js.map