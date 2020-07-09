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
/******/ 	return __webpack_require__(__webpack_require__.s = "./blocks/blocks.js");
/******/ })
/************************************************************************/
/******/ ({

/***/ "./blocks/banner/block-init.js":
/*!*************************************!*\
  !*** ./blocks/banner/block-init.js ***!
  \*************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _block__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./block */ "./blocks/banner/block.js");
/* harmony import */ var _block__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_block__WEBPACK_IMPORTED_MODULE_0__);
var __ = wp.i18n.__;
var registerBlockType = wp.blocks.registerBlockType; // Import Block logic


registerBlockType("memberlite/banner", {
  title: __("Banner", "memberlite-elements"),
  icon: "dashicons-flag",
  category: "memberlite",
  description: __("Display a Memberlite banner.", "memberlite-elements"),
  keywords: [__("member", "memberlite-elements"), __("memberlite", "memberlite-elements"), __("banner", "memberlite-elements")],
  supports: {
    align: ["wide", "full", "center"],
    anchor: true,
    html: false
  },
  example: {
    attributes: {
      preview: true
    }
  },
  edit: _block__WEBPACK_IMPORTED_MODULE_0___default.a,
  save: function save() {
    return null;
  }
});

/***/ }),

/***/ "./blocks/banner/block.js":
/*!********************************!*\
  !*** ./blocks/banner/block.js ***!
  \********************************/
/*! no static exports found */
/***/ (function(module, exports) {

throw new Error("Module build failed (from ./node_modules/babel-loader/lib/index.js):\nSyntaxError: /Applications/MAMP/htdocs/pmpro/wp-content/plugins/memberlite-elements/blocks/banner/block.js: Support for the experimental syntax 'classProperties' isn't currently enabled (27:9):\n\n\u001b[0m \u001b[90m 25 | \u001b[39m\t}\u001b[0m\n\u001b[0m \u001b[90m 26 | \u001b[39m\u001b[0m\n\u001b[0m\u001b[31m\u001b[1m>\u001b[22m\u001b[39m\u001b[90m 27 | \u001b[39m\trender \u001b[33m=\u001b[39m () \u001b[33m=>\u001b[39m {\u001b[0m\n\u001b[0m \u001b[90m    | \u001b[39m\t       \u001b[31m\u001b[1m^\u001b[22m\u001b[39m\u001b[0m\n\u001b[0m \u001b[90m 28 | \u001b[39m\t\t\u001b[36mconst\u001b[39m { attributes\u001b[33m,\u001b[39m setAttributes } \u001b[33m=\u001b[39m \u001b[36mthis\u001b[39m\u001b[33m.\u001b[39mprops\u001b[33m;\u001b[39m\u001b[0m\n\u001b[0m \u001b[90m 29 | \u001b[39m\u001b[0m\n\u001b[0m \u001b[90m 30 | \u001b[39m\t\t\u001b[36mconst\u001b[39m { backgroundColor } \u001b[33m=\u001b[39m attributes\u001b[33m;\u001b[39m\u001b[0m\n\nAdd @babel/plugin-proposal-class-properties (https://git.io/vb4SL) to the 'plugins' section of your Babel config to enable transformation.\nIf you want to leave it as-is, add @babel/plugin-syntax-class-properties (https://git.io/vb4yQ) to the 'plugins' section to enable parsing.\n    at Object._raise (/Applications/MAMP/htdocs/pmpro/wp-content/plugins/memberlite-elements/node_modules/@babel/parser/lib/index.js:757:17)\n    at Object.raiseWithData (/Applications/MAMP/htdocs/pmpro/wp-content/plugins/memberlite-elements/node_modules/@babel/parser/lib/index.js:750:17)\n    at Object.expectPlugin (/Applications/MAMP/htdocs/pmpro/wp-content/plugins/memberlite-elements/node_modules/@babel/parser/lib/index.js:8839:18)\n    at Object.parseClassProperty (/Applications/MAMP/htdocs/pmpro/wp-content/plugins/memberlite-elements/node_modules/@babel/parser/lib/index.js:12232:12)\n    at Object.pushClassProperty (/Applications/MAMP/htdocs/pmpro/wp-content/plugins/memberlite-elements/node_modules/@babel/parser/lib/index.js:12192:30)\n    at Object.parseClassMemberWithIsStatic (/Applications/MAMP/htdocs/pmpro/wp-content/plugins/memberlite-elements/node_modules/@babel/parser/lib/index.js:12125:14)\n    at Object.parseClassMember (/Applications/MAMP/htdocs/pmpro/wp-content/plugins/memberlite-elements/node_modules/@babel/parser/lib/index.js:12062:10)\n    at withTopicForbiddingContext (/Applications/MAMP/htdocs/pmpro/wp-content/plugins/memberlite-elements/node_modules/@babel/parser/lib/index.js:12007:14)\n    at Object.withTopicForbiddingContext (/Applications/MAMP/htdocs/pmpro/wp-content/plugins/memberlite-elements/node_modules/@babel/parser/lib/index.js:11078:14)\n    at Object.parseClassBody (/Applications/MAMP/htdocs/pmpro/wp-content/plugins/memberlite-elements/node_modules/@babel/parser/lib/index.js:11984:10)\n    at Object.parseClass (/Applications/MAMP/htdocs/pmpro/wp-content/plugins/memberlite-elements/node_modules/@babel/parser/lib/index.js:11958:22)\n    at Object.parseStatementContent (/Applications/MAMP/htdocs/pmpro/wp-content/plugins/memberlite-elements/node_modules/@babel/parser/lib/index.js:11245:21)\n    at Object.parseStatement (/Applications/MAMP/htdocs/pmpro/wp-content/plugins/memberlite-elements/node_modules/@babel/parser/lib/index.js:11203:17)\n    at Object.parseBlockOrModuleBlockBody (/Applications/MAMP/htdocs/pmpro/wp-content/plugins/memberlite-elements/node_modules/@babel/parser/lib/index.js:11778:25)\n    at Object.parseBlockBody (/Applications/MAMP/htdocs/pmpro/wp-content/plugins/memberlite-elements/node_modules/@babel/parser/lib/index.js:11764:10)\n    at Object.parseTopLevel (/Applications/MAMP/htdocs/pmpro/wp-content/plugins/memberlite-elements/node_modules/@babel/parser/lib/index.js:11134:10)\n    at Object.parse (/Applications/MAMP/htdocs/pmpro/wp-content/plugins/memberlite-elements/node_modules/@babel/parser/lib/index.js:12836:10)\n    at parse (/Applications/MAMP/htdocs/pmpro/wp-content/plugins/memberlite-elements/node_modules/@babel/parser/lib/index.js:12889:38)\n    at parser (/Applications/MAMP/htdocs/pmpro/wp-content/plugins/memberlite-elements/node_modules/@babel/core/lib/parser/index.js:54:34)\n    at parser.next (<anonymous>)\n    at normalizeFile (/Applications/MAMP/htdocs/pmpro/wp-content/plugins/memberlite-elements/node_modules/@babel/core/lib/transformation/normalize-file.js:93:38)\n    at normalizeFile.next (<anonymous>)\n    at run (/Applications/MAMP/htdocs/pmpro/wp-content/plugins/memberlite-elements/node_modules/@babel/core/lib/transformation/index.js:31:50)\n    at run.next (<anonymous>)\n    at Function.transform (/Applications/MAMP/htdocs/pmpro/wp-content/plugins/memberlite-elements/node_modules/@babel/core/lib/transform.js:27:41)\n    at transform.next (<anonymous>)\n    at step (/Applications/MAMP/htdocs/pmpro/wp-content/plugins/memberlite-elements/node_modules/gensync/index.js:254:32)\n    at gen.next (/Applications/MAMP/htdocs/pmpro/wp-content/plugins/memberlite-elements/node_modules/gensync/index.js:266:13)\n    at async.call.value (/Applications/MAMP/htdocs/pmpro/wp-content/plugins/memberlite-elements/node_modules/gensync/index.js:216:11)");

/***/ }),

/***/ "./blocks/blocks.js":
/*!**************************!*\
  !*** ./blocks/blocks.js ***!
  \**************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _banner_block_init_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./banner/block-init.js */ "./blocks/banner/block-init.js");
/**
 * Begin Block inclusion and initialization.
 */


/***/ })

/******/ });
//# sourceMappingURL=blocks.build.js.map